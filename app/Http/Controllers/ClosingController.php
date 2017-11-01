<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Closing;

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

    public function add(){
    	return view('closing.add');
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

    public function register(){

        return redirect('closing');
    }
}
