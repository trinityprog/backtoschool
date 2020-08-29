<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use DateInterval;
use DatePeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Check;

class AdminController extends Controller
{
    public function home()
    {
        if (Auth::user()->type == 'user') { return redirect('/'); }

        if (Auth::user()->type == 'admin') {
            return redirect('admin/dashboard');
        }
    }
    public function restrict(){
        return view('pages.restrict');
    }
    public function index(){
        $counts = '[';
        $dates = '[';
        $count = 0;
        $interval = new DateInterval('P1D');
        if(count(Check::all()) != 0) {
            $first = Check::oldest()->first()->created_at;
            $last = Check::latest()->first()->created_at;
            $daterange = new DatePeriod($first, $interval, $last);
            foreach ($daterange as $date) {
                $counts .= Check::whereBetween('created_at', [$date->format('Y-m-d') . ' 00:00:00', $date->format('Y-m-d') . ' 23:59:59'])->count();
                $dates .= "'" . $date->format('d.m') . "'";
                if (!($date->format('Y-m-d') == $last->format('Y-m-d'))) {
                    $counts .= ', ';
                    $dates .= ', ';
                }
            }
        }
        $counts .= ']';
        $dates .= ']';
        // users
        $counts_user = '[';
        $dates_user = '[';
        $count = 0;
        $first_user = User::oldest()->first()->created_at;
        $last_user = User::latest()->first()->created_at;
        $daterange_user = new DatePeriod($first_user, $interval ,$last_user);
        foreach ($daterange_user as $date) {
            $counts_user .= User::whereBetween('created_at', [$date->format('Y-m-d').' 00:00:00', $date->format('Y-m-d').' 23:59:59'])->count();
            $dates_user .= "'" . $date->format('d.m') . "'";
            if(!($date->format('Y-m-d') == $last_user->format('Y-m-d'))){
                $counts_user .= ', ';
                $dates_user .= ', ';
            }
        }
        $counts_user .= ']';
        $dates_user .= ']';
        return view('admin/dashboard', compact('counts', 'dates', 'counts_user', 'dates_user'));
    }
}
