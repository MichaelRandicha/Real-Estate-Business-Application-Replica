<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function branch(Request $request){
    	$closings = null;
    	if(!empty($request->dateFrom) || !empty($request->dateTo)){
    		$this->validate($request, [
    			'dateTo' => 'required|date',
            	'dateFrom' => 'required|date',
    		]);
    		return $request;
    	}else{
    		return view('report.branch');
    	}
    }

    public function commission(Request $request){
    	return view('report.commission');
    }

    public function closing(Request $request){
    	return view('report.closing');
    }
}
