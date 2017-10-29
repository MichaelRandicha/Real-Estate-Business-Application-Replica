<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClosingController extends Controller
{
    public function index(){
    	return view('login.closing');
    }

    public function search(Request $request){

    	return view('login.closing');
    }

    public function add(){
    	return view('login.closing.add');
    }

    public function view($id){
    	if(!is_numeric($id)){
    		return redirect('closing');
    	}
    	return view('login.closing.view');
    }
}
