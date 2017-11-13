<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Closing;

class ReportController extends Controller
{
    public function branch(Request $request){
        return view('report.branch');
    }

    public function commission(Request $request){
    	return view('report.commission');
    }

    public function closing(Request $request){
    	$closings = null;
        if(!empty($request->dateFrom) || !empty($request->dateTo)){
            $no = 5;
            if(!empty($request->no)){
                $no = $request->no;
            }else{
                $request->request->no = $no;
            }
            $closings = Closing::where('tanggal', '>=', $request->dateFrom)->where('tanggal', '<=', $request->dateTo)->orderBy('tanggal')->orderBy('id')->paginate($no);
            $closings->appends(['dateFrom' => $request->dateFrom, 'dateTo' => $request->dateTo, 'no' => $no]);
            return view('report.closing', compact('closings'));
        }else{
            return view('report.closing');
        }
    }

    public function closingList(Request $request){
        if(empty($request->dateFrom) || empty($request->dateTo)){
            return redirect('report/closing');
        }
        $closings = Closing::where('tanggal', '>=', $request->dateFrom)->where('tanggal', '<=', $request->dateTo)->orderBy('tanggal')->orderBy('id')->get();
        return view('report.list.closing', compact('closings'));
    }
}
