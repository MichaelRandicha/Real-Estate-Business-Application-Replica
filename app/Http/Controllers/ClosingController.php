<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Closing;
use App\Agent;
use App\AgentClosing;

class ClosingController extends Controller
{
    public function index(Request $request){
        $closings = null;
        if($request->search == null){
            $closings = Closing::paginate(5);
        }else{
            $closings = Closing::where('nama', 'like',  $request->search.'%')->paginate(5);
            $closings->appends(['search' => $request->search]);
        }
        return view('closing.index', compact('closings'));
    }

    public function add(Request $request){
        if(Agent::where('nama', 'not like', 'kantor%')->where('status', true)->count() == 0){
            $request->session()->flash('status', 'You Need At Least One Employed Agent Before Adding New Closing');
            return redirect('closing');
        }

        $agents = Agent::where('nama', 'not like', 'kantor%')->where('status', true)->get();
        return view('closing.add', compact('agents'));
    }

    public function view($id){
    	if(!is_numeric($id)){
    		return redirect('closing');
    	}

        $closing = Closing::find($id);

        if($closing == null){
            return redirect('closing');
        }

        return view('closing.view', compact('closing'));
    }

    public function register(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'date' => 'required|date', 
            'price' => 'required|numeric|min:1']);

        foreach ($request->agent as $id){
            if($id > 0){
                foreach (Agent::where('nama', 'like', 'kantor%')->get() as $kantor) {
                    if($id == $kantor->id){
                        $request->session()->flash('status', 'You Should Not Edit The ID of Dropdown');
                        return redirect('addClosing');
                    }
                }
            }
        }

        $closing = new Closing();
        $closing->nama = $request->name;
        $closing->harga = $request->price;
        $closing->tanggal = $request->date;
        $closing->save();


        $count = 0;

        foreach ($request->agent as $id){
            if($id > 0){
                $count++;
            }
        }

        $iteration = 0;
        foreach ($request->agent as $id){
            if($id > 0){
                $iteration++;

                $agent = Agent::find($id);

                $agentClosing = new AgentClosing;
                $agentClosing->agent_id = $id;
                $agentClosing->closing_id = $closing->id;
                switch($count){
                    case 1:
                    $agentClosing->komisi = $closing->harga;
                    $agent->pendapatan += $agentClosing->komisi;
                    break;
                    case 2:
                    $agentClosing->komisi = $closing->harga / 2;
                    $agent->pendapatan += $agentClosing->komisi;
                    break;
                    case 3:
                    switch ($iteration) {
                        case 1:
                        $agentClosing->komisi = $closing->harga / 2;
                        break;

                        default:
                        $agentClosing->komisi = $closing->harga / 4;
                        break;
                    }
                    $agent->pendapatan += $agentClosing->komisi;
                    break;
                    case 4:
                    $agentClosing->komisi = $closing->harga / 4;
                    $agent->pendapatan += $agentClosing->komisi;
                    break;
                }

                $agent->save();

                $upline1 = $agent->upline;
                if($upline1 == null){
                    $upline1 = Agent::find($agent->cabang->kantor_id);
                }else{
                    if($upline1->isEmployed){
                        if($agent->cabang->id == $upline1->cabang->id){
                            if($upline1->isPrincipal || $upline1->isVice){
                                $upline1 = Agent::find($agent->cabang->kantor_id);
                            }
                        }
                    }else{
                        $upline1 = Agent::find($agent->cabang->kantor_id);
                    }
                }
                $agentClosing->upline1_id = $upline1->id;
                $agentClosing->upline1_komisi = $agentClosing->komisi * 7 / 100;
                $upline1->pendapatan += $agentClosing->upline1_komisi;

                $upline1->save();

                $upline2 = null;
                if($agent->upline == null){
                    $upline2 = Agent::find($agent->cabang->kantor_id);
                }else{
                    $upline2 = $agent->upline->upline;
                    if($upline2 == null){
                        $upline2 = Agent::find($agent->cabang->kantor_id);
                    }else{
                        if($upline2->isEmployed){
                            if($agent->cabang->id == $upline2->cabang->id){
                                if($upline2->isPrincipal || $upline2->isVice){
                                    $upline2 = Agent::find($agent->cabang->kantor_id);
                                }
                            }
                        }else{
                            $upline2 = Agent::find($agent->cabang->kantor_id);
                        }
                    }
                }
                $agentClosing->upline2_id = $upline2->id;
                $agentClosing->upline2_komisi = $agentClosing->komisi * 2 / 100;
                $upline2->pendapatan += $agentClosing->upline2_komisi;

                $upline2->save();

                $upline3 = null;
                if($agent->upline == null || $agent->upline->upline == null){
                    $upline3 = Agent::find($agent->cabang->kantor_id);
                }else{
                    $upline3 = $agent->upline->upline->upline;
                    if ($upline3 == null) {
                        $upline3 = Agent::find($agent->cabang->kantor_id);
                    }else {
                        if($upline3->isEmployed){
                            if($agent->cabang->id == $upline3->cabang->id){
                                if($upline3->isPrincipal || $upline3->isVice){
                                    $upline3 = Agent::find($agent->cabang->kantor_id);
                                }
                            }
                        }else{
                            $upline3 = Agent::find($agent->cabang->kantor_id);
                        }
                    }
                }
                $agentClosing->upline3_id = $upline3->id;
                $agentClosing->upline3_komisi = $agentClosing->komisi * 1 / 100;
                $upline3->pendapatan += $agentClosing->upline3_komisi;

                $upline3->save();

                $principal = $agent->cabang->principal;
                if($principal == null){
                    $principal = Agent::find($agent->cabang->kantor_id);
                }else{
                    if(!$principal->isEmployed){
                        $principal = Agent::find($agent->cabang->kantor_id);
                    }else if ($agent->id == $principal->id){
                        $principal = Agent::find($agent->cabang->kantor_id);
                    }
                }
                $agentClosing->principal_id = $principal->id;
                $agentClosing->principal_komisi = $agentClosing->komisi * 6 / 100;
                $principal->pendapatan += $agentClosing->principal_komisi;

                $principal->save();

                $vice = $agent->cabang->vice;
                if($vice == null){
                    $vice = Agent::find($agent->cabang->kantor_id);
                }else{
                    if(!$vice->isEmployed){
                        $vice = Agent::find($agent->cabang->kantor_id);
                    }else if ($agent->id == $vice->id){
                        $vice = Agent::find($agent->cabang->kantor_id);
                    }
                }
                $agentClosing->vice_id = $vice->id;
                $agentClosing->vice_komisi = $agentClosing->komisi * 4 / 100;
                $vice->pendapatan += $agentClosing->vice_komisi;

                $vice->save();

                $agentClosing->save();
            }
        }

        return redirect('closing/view/'.$closing->id);
    }
}
