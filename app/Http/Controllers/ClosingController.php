<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClosingController extends Controller
{
    public function index(){
    	return view('closing.index');
    }

    public function search(Request $request){

    	return view('closing.index');
    }

    public function add(){
    	return view('closing.add');
    }

    public function view($id){
    	if(!is_numeric($id)){
    		return redirect('closing');
    	}
    	return view('closing.view');
    }

    public function register(){

        return redirect('closing');
    }
}
