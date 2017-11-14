<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Closing;
use App\AgentClosing;

class ReportController extends Controller
{
    public function branch(Request $request){
        return view('report.branch');
    }

    public function commission(Request $request){
    	return view('report.commission');
    }

    public function point(Request $request){
        $points = null;
        if(!empty($request->dateFrom) || !empty($request->dateTo)){
            $this->validate($request,[
            'dateFrom' => 'required|date',
            'dateTo' => 'required|date']);
            $no = 5;
            if(!empty($request->no)){
                $no = $request->no;
            }else{
                $request->request->no = $no;
            }
            $points = AgentClosing::groupBy('agent_closing.agent_id')->join('closings', 'agent_closing.closing_id', '=', 'closings.id')->where('closings.tanggal', '>=', $request->dateFrom)->where('closings.tanggal', '<=', $request->dateTo)->selectRaw('*, sum(point) as total_point')->orderBy('total_point', 'desc')->paginate($no);
            // ->join('closings', 'agent_closing.id', '=', 'closings.id')->where('closings.tanggal', '>=', $request->dateFrom)->where('closings.tanggal', '<=', $request->dateTo)
            // ->selectRaw('*, sum(point) as total_point')
            // ->selectRaw('*, sum(komisi) as komisi_total')
            $points->appends(['dateFrom' => $request->dateFrom, 'dateTo' => $request->dateTo, 'no' => $no]);
            return view('report.point', compact('points'));
        }else{
            return view('report.point');
        }
    }

    public function pointList(Request $request){
        if(empty($request->dateFrom) || empty($request->dateTo)){
            return redirect('report/closing');
        }
        $points = AgentClosing::groupBy('agent_closing.agent_id')->join('closings', 'agent_closing.closing_id', '=', 'closings.id')->where('closings.tanggal', '>=', $request->dateFrom)->where('closings.tanggal', '<=', $request->dateTo)->selectRaw('*, sum(point) as total_point')->orderBy('total_point', 'desc')->get();
        return view('report.list.point', compact('points'));
    }

    public function closing(Request $request){
    	$closings = null;
        if(!empty($request->dateFrom) || !empty($request->dateTo)){
            $this->validate($request,[
            'dateFrom' => 'required|date',
            'dateTo' => 'required|date']);
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
