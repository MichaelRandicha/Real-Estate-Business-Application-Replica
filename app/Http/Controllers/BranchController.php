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

    public function view($id){

    	return view('login.branch.view');
    }

    public function edit($id){
    	return view('login.branch.edit');
    }
}
