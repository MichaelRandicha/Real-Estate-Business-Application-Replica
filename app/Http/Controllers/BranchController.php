<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cabang;
use App\Agent;

class BranchController extends Controller
{
    public function index(Request $request){
        $cabangs = null;
        if(empty($request->search)){
            $cabangs = Cabang::paginate(5);
        }else {
            $cabangs = Cabang::where('nama', 'like',  $request->search.'%')->paginate(5);
            $cabangs->appends(['search' => $request->search]);    
        }
    	return view('branch.index', compact('cabangs'));
    }

    public function add(){
    	return view('branch.add');
    }

    public function register(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'location' => 'required', 
            'phone' => 'required|numeric|digits_between:10,12']);
        
        $cabang = new Cabang;
        $cabang->nama = $request->name;
        $cabang->lokasi = $request->location;
        $cabang->telepon = $request->phone;
        $cabang->save();

        return redirect('branch/view/'.$cabang->id);
    }

    public function view($id){
    	if(!is_numeric($id)){
    		return redirect('branch');
    	}

        $cabang = Cabang::find($id);

        if($cabang == null){
            return redirect('branch');
        }
    	return view('branch.view', compact('cabang'));
    }

    public function edit($id){
    	if(!is_numeric($id)){
    		return redirect('branch');
    	}

        $cabang = Cabang::find($id);

        if($cabang == null){
            return redirect('branch');
        }

    	return view('branch.edit', compact('cabang'));
    }

    public function change(Request $request, $id){
        if(!is_numeric($id)){
            return redirect('branch');
        }

        $cabang = Cabang::find($id);

        if($cabang == null){
            return redirect('branch');
        }

        $this->validate($request,[
            'name' => 'required',
            'location' => 'required', 
            'phone' => 'required|numeric|digits_between:10,12']);

        $cabang->nama = $request->name;
        $cabang->lokasi = $request->location;
        $cabang->telepon = $request->phone;

        if($request->principal > 1){
            $cabang->principal_id = $request->principal;
        }else {
            $cabang->principal_id = null;
        }

        if($request->vice > 1){
            $cabang->vice_id = $request->vice;
        }else{
            $cabang->vice_id = null;
        }
        $cabang->save();
        
        return redirect('branch/view/'.$id);
    }

    public function delete($id){

        return redirect('branch');
    }
}
