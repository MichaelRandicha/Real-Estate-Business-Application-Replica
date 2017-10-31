<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agent;
use App\Cabang;
use JavaScript;

class AgentController extends Controller
{
    public function index(){
        $agents = Agent::where('id', '!=', 1)->paginate(5);
        return view('agent.index', compact('agents'));
    }

    public function search(Request $request){
        $agents = Agent::where('nama', 'like',  $request->input('search').'%')->where('id','!=', 1)->paginate(5);
        $agents->appends(['search' => $request->input('search')]);

        return view('agent.index', compact('agents'));
    }

    public function add(){
        $agents = Agent::where('id', '>', 1)->get();
        $cabangs = Cabang::all();

        return view('agent.add', compact('agents', 'cabangs'));
    }

    public function register(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'location' => 'required', 
            'phone' => 'required|numeric|digits_between:10,12',
            'branch' => 'required']);
        if(count(Agent::all()) > 2){
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

        JavaScript::put([
            'agent_tree' => Agent::all()
        ]);

        return view('agent.view', compact('agent'));
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
                $cabang = Cabang::find($agent->cabang_id);
                if($agent->isPrincipal){
                    $cabang->principal_id = null;
                }else if ($agent->isVice){
                    $cabang->vice_id = null;
                }
                $cabang->save();
            }
        }
        $agent->cabang_id = $request->input('branch');
        $agent->save();

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

        $agent->status = !$agent->status;
        $agent->save();
        
        return redirect('agent/view/'.$id);
    }
}
