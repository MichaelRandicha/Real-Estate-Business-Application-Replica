<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Closing;
use App\Agent;
use App\AgentClosing;

class ClosingController extends Controller
{
    public function index(){
        $closings = Closing::paginate(5);
    	return view('closing.index', compact('closings'));
    }

    public function search(Request $request){
        $closings = Closing::where('nama', 'like',  $request->input('search').'%')->paginate(5);
        $closings->appends(['search' => $request->input('search')]);

    	return view('closing.index', compact('closings'));
    }

    public function add(Request $request){
        if(Agent::where('status', true)->count() == 0){
            $request->session()->flash('status', 'Please Make a New Agent That is Employed First Before Adding New Closing');
            return redirect('closing');
        }

        $agents = Agent::where('id', '>', 1)->where('status', true)->get();
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
        $closing = new Closing();
        $closing->nama = $request->input('name');
        $closing->harga = $request->input('price');
        $closing->tanggal = $request->input('date');
        $closing->save();

        $count = 0;

        foreach ($request->input('agent') as $id){
            if($id > 1){
                $count++;
            }
        }

        $iteration = 0;

        foreach ($request->input('agent') as $id) {
            if($id > 1){
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
                    $upline1 = Agent::find(1);
                }else{
                    if($upline1->isEmployed){
                        if($agent->cabang->id == $upline1->cabang->id){
                            if($upline1->isPrincipal || $upline1->isVice){
                                $upline1 = Agent::find(1);
                            }
                        }
                    }else{
                        $upline1 = Agent::find(1);
                    }
                }
                $agentClosing->upline1_id = $upline1->id;
                $agentClosing->upline1_komisi = $closing->harga * 7 / 100;
                $upline1->pendapatan += $agentClosing->upline1_komisi;

                $upline1->save();

                $upline2 = $upline1->upline;
                if($upline2 == null){
                    $upline2 = Agent::find(1);
                }else{
                    if($upline2->isEmployed){
                        if($agent->cabang->id == $upline2->cabang->id){
                            if($upline2->isPrincipal || $upline2->isVice){
                                $upline2 = Agent::find(1);
                            }
                        }
                    }else{
                        $upline2 = Agent::find(1);
                    }
                }
                $agentClosing->upline2_id = $upline2->id;
                $agentClosing->upline2_komisi = $closing->harga * 2 / 100;
                $upline2->pendapatan += $agentClosing->upline2_komisi;

                $upline2->save();

                $upline3 = $upline2->upline;
                if($upline3 == null){
                    $upline3 = Agent::find(1);
                }else{
                    if($upline3->isEmployed){
                        if($agent->cabang->id == $upline3->cabang->id){
                            if($upline3->isPrincipal || $upline3->isVice){
                                $upline3 = Agent::find(1);
                            }
                        }
                    }else{
                        $upline3 = Agent::find(1);
                    }
                }
                $agentClosing->upline3_id = $upline3->id;
                $agentClosing->upline3_komisi = $closing->harga * 1 / 100;
                $upline3->pendapatan += $agentClosing->upline3_komisi;

                $upline3->save();

                $principal = $agent->cabang->principal;
                if($principal == null){
                    $principal = Agent::find(1);
                }else{
                    if(!$principal->isEmployed){
                        $principal = Agent::find(1);
                    }else if ($agent->id == $principal->id){
                        $principal = Agent::find(1);
                    }
                }
                $agentClosing->principal_id = $principal->id;
                $agentClosing->principal_komisi = $closing->harga * 6 / 100;
                $principal->pendapatan += $agentClosing->principal_komisi;

                $principal->save();

                $vice = $agent->cabang->vice;
                if($vice == null){
                    $vice = Agent::find(1);
                }else{
                    if(!$vice->isEmployed){
                        $vice = Agent::find(1);
                    }else if ($agent->id == $vice->id){
                        $vice = Agent::find(1);
                    }
                }
                $agentClosing->vice_id = $vice->id;
                $agentClosing->vice_komisi = $closing->harga * 4 / 100;
                $vice->pendapatan += $agentClosing->vice_komisi;

                $vice->save();

                $agentClosing->save();
            }
        }

        return redirect('closing/view'.$closing->id);
    }
}
