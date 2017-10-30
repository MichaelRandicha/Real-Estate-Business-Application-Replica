<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index(){
    	return view('branch.index');
    }

    public function search(Request $request){

    	return view('branch.index');
    }

    public function add(){
    	return view('branch.add');
    }

    public function register(Request $request){
        
        return redirect('branch');
    }

    public function view($id){
    	if(!is_numeric($id)){
    		return redirect('branch');
    	}
    	return view('branch.view');
    }

    public function edit($id){
    	if(!is_numeric($id)){
    		return redirect('branch');
    	}
    	return view('branch.edit');
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
