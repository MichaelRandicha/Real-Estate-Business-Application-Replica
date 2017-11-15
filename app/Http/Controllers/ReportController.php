<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cabang;
use App\Closing;
use App\AgentClosing;

class ReportController extends Controller
{
    public function branch(Request $request){
        $cabangs = Cabang::all();
        
        if(empty($request->dateFrom) || empty($request->dateTo) || empty($request->branch)){
            return view('report.branch', compact('cabangs'));
        }

        $this->validate($request,[
            'dateFrom' => 'required|date',
            'dateTo' => 'required|date',
            'branch' => 'required']);

        $no = 5;
        if(!empty($request->no)){
            $no = $request->no;
        }
        
        $branchs = AgentClosing::join('closings', 'agent_closing.closing_id', '=', 'closings.id')
        ->where('closings.tanggal', '>=', $request->dateFrom)
        ->where('closings.tanggal', '<=', $request->dateTo)
        ->where('agent_closing.cabang_id', '=', $request->branch)
        ->orderBy('closings.tanggal')
        ->orderBy('agent_closing.closing_id')
        ->paginate($no);
        $branchs->appends(['dateFrom' => $request->dateFrom, 'dateTo' => $request->dateTo, 'no' => $no,'branch' => $request->branch]);
        
        return view('report.branch', compact('cabangs', 'branchs'));
    }

    public function branchList(Request $request){
        if(empty($request->dateFrom) || empty($request->dateTo) || empty($request->branch)){
            return redirect('report/branch');
        }
        
        $branchs = AgentClosing::join('closings', 'agent_closing.closing_id', '=', 'closings.id')
        ->where('closings.tanggal', '>=', $request->dateFrom)
        ->where('closings.tanggal', '<=', $request->dateTo)
        ->where('agent_closing.cabang_id', '=', $request->branch)
        ->orderBy('closings.tanggal')
        ->orderBy('agent_closing.closing_id')
        ->get();
        
        return view('report.list.branch', compact('branchs'));
    }

    public function commission(Request $request){
        if(empty($request->dateFrom) || empty($request->dateTo) || empty($request->filter)){
            return view('report.commission');
        }
        
        $this->validate($request,[
            'dateFrom' => 'required|date',
            'dateTo' => 'required|date']);
        
        $no = 5;
        if(!empty($request->no)){
            $no = $request->no;
        }
        
        $filter = "";
        if($request->filter == "agent"){
            $filter = "agent_id";
        }else if($request->filter == "branch"){
            $filter = "cabang_id";
        }

        $commissions = AgentClosing::groupBy('agent_closing.'.$filter)
        ->join('closings', 'agent_closing.closing_id', '=', 'closings.id')
        ->where('closings.tanggal', '>=', $request->dateFrom)
        ->where('closings.tanggal', '<=', $request->dateTo)
        ->selectRaw('*, sum(komisi) as total_komisi')
        ->orderBy('total_komisi', 'desc')
        ->paginate($no);
        $commissions->appends(['dateFrom' => $request->dateFrom, 'dateTo' => $request->dateTo, 'no' => $no,'filter' => $request->filter]);
        
        return view('report.commission', compact('commissions'));
    }

    public function commissionList(Request $request){
        if(empty($request->dateFrom) || empty($request->dateTo) || empty($request->filter)){
            return redirect('report/commission');
        }

        $filter = "";
        if($request->filter == "agent"){
            $filter = "agent_id";
        }else if($request->filter == "branch"){
            $filter = "cabang_id";
        }

        $commissions = AgentClosing::groupBy('agent_closing.'.$filter)
        ->join('closings', 'agent_closing.closing_id', '=', 'closings.id')
        ->where('closings.tanggal', '>=', $request->dateFrom)
        ->where('closings.tanggal', '<=', $request->dateTo)
        ->selectRaw('*, sum(komisi) as total_komisi')
        ->orderBy('total_komisi', 'desc')
        ->get();
        return view('report.list.commission', compact('commissions'));
    }

    public function point(Request $request){
        if(empty($request->dateFrom) || empty($request->dateTo) || empty($request->filter)){
            return view('report.point');
        }

        $this->validate($request,[
            'dateFrom' => 'required|date',
            'dateTo' => 'required|date']);
        
        $no = 5;
        if(!empty($request->no)){
            $no = $request->no;
        }

        $points = AgentClosing::groupBy('agent_closing.agent_id')
        ->join('closings', 'agent_closing.closing_id', '=', 'closings.id')
        ->where('closings.tanggal', '>=', $request->dateFrom)
        ->where('closings.tanggal', '<=', $request->dateTo)
        ->selectRaw('*, sum(point) as total_point')
        ->orderBy('total_point', 'desc')
        ->paginate($no);
        $points->appends(['dateFrom' => $request->dateFrom, 'dateTo' => $request->dateTo, 'no' => $no]);
        
        return view('report.point', compact('points'));
    }

    public function pointList(Request $request){
        if(empty($request->dateFrom) || empty($request->dateTo)){
            return redirect('report/point');
        }

        $points = AgentClosing::groupBy('agent_closing.agent_id')
        ->join('closings', 'agent_closing.closing_id', '=', 'closings.id')
        ->where('closings.tanggal', '>=', $request->dateFrom)
        ->where('closings.tanggal', '<=', $request->dateTo)
        ->selectRaw('*, sum(point) as total_point')
        ->orderBy('total_point', 'desc')
        ->get();

        return view('report.list.point', compact('points'));
    }

    public function closing(Request $request){
        if(empty($request->dateFrom) || empty($request->dateTo)){
            return view('report.closing');
        }
        
        $this->validate($request,[
            'dateFrom' => 'required|date',
            'dateTo' => 'required|date']);
        
        $no = 5;
        if(!empty($request->no)){
            $no = $request->no;
        }
        
        $closings = Closing::where('tanggal', '>=', $request->dateFrom)
        ->where('tanggal', '<=', $request->dateTo)
        ->orderBy('tanggal')
        ->orderBy('id')
        ->paginate($no);
        $closings->appends(['dateFrom' => $request->dateFrom, 'dateTo' => $request->dateTo, 'no' => $no]);
        
        return view('report.closing', compact('closings'));
    }

    public function closingList(Request $request){
        if(empty($request->dateFrom) || empty($request->dateTo)){
            return redirect('report/closing');
        }
        
        $closings = Closing::where('tanggal', '>=', $request->dateFrom)
        ->where('tanggal', '<=', $request->dateTo)
        ->orderBy('tanggal')
        ->orderBy('id')
        ->get();
        
        return view('report.list.closing', compact('closings'));
    }
}
