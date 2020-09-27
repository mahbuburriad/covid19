<?php

namespace App\Http\Controllers;

use App\Models\Live;
use App\Models\Yesterday;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('dashboard/index');
    }

    public function liveData(){
        $lives = Live::all();
        return view('dashboard.data.live', compact('lives'));
    }

    public function yesterdayData(){
        $yesterdays = Yesterday::all();
        return view('dashboard.data.yesterday', compact('yesterdays'));
    }
}
