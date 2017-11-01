<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agent;
use App\Cabang;
use JavaScript;

class AgentController extends Controller
{
    public function index(){
        $agents = Agent::where('id', '>', 1)->paginate(5);
        return view('agent.index', compact('agents'));
    }

    public function search(Request $request){
        $agents = Agent::where('nama', 'like',  $request->input('search').'%')->where('id','>', 1)->paginate(5);
        $agents->appends(['search' => $request->input('search')]);

        return view('agent.index', compact('agents'));
    }

    public function add(Request $request){
        if(Cabang::all()->count() == 0){
            $request->session()->flash('status', 'Please Make a New Branch First Before Adding New Agent');
            return redirect('agent');
        }
        $agents = Agent::where('id', '>', 1)->where('status', true)->get();
        $cabangs = Cabang::all();

        return view('agent.add', compact('agents', 'cabangs'));
    }

    public function register(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'location' => 'required', 
            'phone' => 'required|numeric|digits_between:10,12',
            'branch' => 'required']);
        if(Agent::all()->count() > 2){
            $this->validate($request, [
                'upline' => 'required|not_in:0,1']);
            if($request->input('upline') == 0){
                return redirect('agent/add')->withErrors(['upline', 'The selected upline is invalid.']);;
            }
        }
        $agent = new Agent;
        $agent->nama = $request->input('name');
        $agent->lokasi = $request->input('location');
        $agent->telepon = $request->input('phone');
        $agent->cabang_id = $request->input('branch');
        if($request->input('upline') > 1){
            $agent->upline_id = $request->input('upline');
        }
        $agent->save();

        return redirect('agent/view/'.$agent->id);
    }

    public function view($id){
    	if(!is_numeric($id)){
    		return redirect('agent');
    	}else if ($id == 1){
            return redirect('agent');
        }

        $agent = Agent::find($id);
        
        if($agent == null){
            return redirect('agent');
        }

        $button = 'btn btn-outline-primary';

        if(!Agent::find(2)->isEmployed){
            $button = 'btn btn-outline-danger';
        }

        if($id == 2){
            $button = $button .' this-agent';
            if(!Agent::find(2)->isEmployed){
                $button = $button .' dipecat';
            }
        }else {
            if(!Agent::find(2)->isEmployed){
                $button = $button .' outline-dipecat';
            }
        }

        $tree = [
            'chart' => [
                'container' => '#agent-tree',
                'connectors' => [
                    'type' => 'step'
                ]
            ],
            'nodeStructure' => [
                'text' => [
                    'name' => Agent::find(2)->nama,
                    'title' => Agent::find(2)->cabang->nama
                ],
                'link' => [
                    'href' => route('viewAgent', ['id' => 2])
                ],
                'HTMLclass' => $button,
                'children' => $this->getAllDownlines(2, $id)
            ]
        ];

        JavaScript::put([
            'agent_tree' => json_encode($tree),
            'nama' => $agent->nama
        ]);

        return view('agent.view', compact('agent'));
    }

    private function getAllDownlines($upline_id, $selectedId){
        $upline = Agent::find($upline_id);

        $children = array();

        foreach ($upline->downline as $downline) {
            $button = 'btn btn-outline-primary';

            if(!$downline->isEmployed){
                $button = 'btn btn-outline-danger';
            }

            if($selectedId == $downline->id){
                $button = $button.' this-agent';
                if(!$downline->isEmployed){
                    $button = $button .' dipecat';
                }
            }else {
                if(!$downline->isEmployed){
                    $button = $button .' outline-dipecat';
                }
            }
            
            if($downline->downline->count() == 0){
                $children[] = [
                    'text' => [
                        'name' => $downline->nama,
                        'title' => $downline->cabang->nama
                    ],
                    'link' => [
                        'href' => route('viewAgent', ['id' => $downline->id])
                    ],
                    'HTMLclass' => $button
                ];
            }else{
                $children[] = [
                    'text' => [
                        'name' => $downline->nama,
                        'title' => $downline->cabang->nama
                    ],
                    'link' => [
                        'href' => route('viewAgent', ['id' => $downline->id])
                    ],
                    'HTMLclass' => $button,
                    'children' => $this->getAllDownlines($downline->id, $selectedId)
                ];
            }
        }

        return $children;
    }

    public function edit($id){
    	if(!is_numeric($id)){
    		return redirect('agent');
    	}else if ($id == 1){
            return redirect('agent');
        }

        $agent = Agent::find($id);
        
        if($agent == null){
            return redirect('agent');
        }

        $cabangs = Cabang::all();

        return view('agent.edit', compact('agent', 'cabangs'));
    }

    public function change(Request $request, $id){
        if(!is_numeric($id)){
            return redirect('agent');
        }else if ($id == 1){
            return redirect('agent');
        }
        
        $agent = Agent::find($id);
        
        if($agent == null){
            return redirect('agent');
        }

        $this->validate($request,[
            'name' => 'required',
            'location' => 'required', 
            'phone' => 'required|numeric|digits_between:10,12',
            'branch' => 'required']);

        $agent->nama = $request->input('name');
        $agent->lokasi = $request->input('location');
        $agent->telepon = $request->input('phone');
        if($agent->isPrincipal || $agent->isVice){
            if($agent->cabang_id != $request->input('branch')){
                if($agent->isPrincipal){
                    $agent->cabang->principal_id = null;
                }else if ($agent->isVice){
                    $agent->cabang->vice_id = null;
                }
            }
        }
        $agent->cabang_id = $request->input('branch');
        $agent->push();

        return redirect('agent/view/'.$id);
    }

    public function changeStatus($id){
        if(!is_numeric($id)){
            return redirect('agent');
        }else if ($id == 1){
            return redirect('agent');
        }
        
        $agent = Agent::find($id);
        
        if($agent == null){
            return redirect('agent');
        }

        if($agent->isEmployed){
            if($agent->isPrincipal){
                $agent->cabang->principal_id = null;
            }else if($agent->isVice){
                $agent->cabang->vice_id = null;
            }
        }

        $agent->status = !$agent->status;
        $agent->push();
        
        return redirect('agent/view/'.$id);
    }
}
