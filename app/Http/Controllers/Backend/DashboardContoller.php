<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardContoller extends Controller
{
    function index()
    {
        return view('dashboard.dashboard');    
    }
}
