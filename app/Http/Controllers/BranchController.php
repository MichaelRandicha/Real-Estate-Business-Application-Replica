<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index(){
    	return view('login.branch');
    }

    public function search(Request $request){

    	return view('login.branch');
    }

    public function add(){
    	return view('login.branch.add');
    }

    public function register(Request $request){
        
        return redirect('branch');
    }

    public function view($id){
    	if(!is_numeric($id)){
    		return redirect('branch');
    	}
    	return view('login.branch.view');
    }

    public function edit($id){
    	if(!is_numeric($id)){
    		return redirect('branch');
    	}
    	return view('login.branch.edit');
    }

    public function change(Request $request, $id){
        if(!is_numeric($id)){
            return redirect('branch');
        }
        
        return redirect('branch/view/'.$id);
    }

    public function delete($id){

        return redirect('branch');
    }
}
