<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Live;
use App\Models\state;
use App\Models\Yesterday;
use Carbon\Carbon;
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
        $yesterdays = Yesterday::where('date', Carbon::today())->get();
        return view('dashboard.data.yesterday', compact('yesterdays'));
    }

    public function worldometer(){
        $worldometers = Yesterday::all();
        return view('dashboard.data.worldometer', compact('worldometers'));
    }

    public function jhpomber(){
        $datas = Data::all();
        return view('dashboard.data.jhpomber', compact('datas'));
    }

    public function bangladeshToday(){
        $bangladesh = state::where([
            'country' => 'Bangladesh',
            'date' => Carbon::today()
        ])->get();
        return view('dashboard.data.bangladeshToday', compact('bangladesh'));
    }

    public function bangladeshAll(){
        $bangladesh = state::where('country', 'Bangladesh')->get();
        return view('dashboard.data.bangladeshAll', compact('bangladesh'));
    }


}
