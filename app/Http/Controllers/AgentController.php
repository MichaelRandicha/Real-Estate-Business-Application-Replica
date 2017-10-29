<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index(){
        return view('login.agent');
    }

    public function search(Request $request){

    	return view('login.agent');
    }

    public function add(){
    	return view('login.agent.add');
    }

    public function register(Request $request){
        
        return redirect('agent');
    }

    public function view($id){
    	if(!is_numeric($id)){
    		return redirect('agent');
    	}
    	return view('login.agent.view');
    }

    public function edit($id){
    	if(!is_numeric($id)){
    		return redirect('agent');
    	}
    	return view('login.agent.edit');
    }

    public function change(Request $request, $id){
        if(!is_numeric($id)){
            return redirect('agent');
        }
        
        return redirect('agent/view/'.$id);
    }

    public function delete($id){

        return redirect('agent');
    }
}
