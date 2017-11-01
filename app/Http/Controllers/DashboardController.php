<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agent;

class DashboardController extends Controller
{
    public function index(){
    	$agents = Agent::has('closing')->withCount('closing')->orderBy('closing_count', 'desc')->paginate(5);
    	return view('dashboard.index', compact('agents'));
    }
}
