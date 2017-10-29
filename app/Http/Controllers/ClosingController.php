<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClosingController extends Controller
{
    public function index(){
    	return view('login.closing');
    }
}
