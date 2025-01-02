<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Robot as Model;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;



class Dashboard extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $links = "dashboard";
    public $title = "Dashboard";

    public function __invoke()
    {
        if(session()->get('client_id') > 0){ 
            return view('dashboard', [
                'total_robot' => Model::join('user_robots as ur', 'ur.robot_id', '=', 'robots.id')->where('ur.user_id', session()->get('user_id'))->where('ur.status', 1)->count(),
                'robot_aktif' => Model::join('user_robots as ur', 'ur.robot_id', '=', 'robots.id')->where('ur.user_id', session()->get('user_id'))->where('ur.status', 1)->where('robots.status', 1)->count(),
                'robot_proses' => Model::join('user_robots as ur', 'ur.robot_id', '=', 'robots.id')->where('ur.user_id', session()->get('user_id'))->where('ur.status', 1)->where('robots.status', 2)->count(),
                'robot_tidak_aktif' => Model::join('user_robots as ur', 'ur.robot_id', '=', 'robots.id')->where('ur.user_id', session()->get('user_id'))->where('ur.status', 1)->where('robots.status', 0)->count(),
            ]);
        }else{
            return view('dashboard', [
                'total_robot' => Model::count(),
                'robot_aktif' => Model::where('status', 1)->count(),
                'robot_proses' => Model::where('status', 2)->count(),
                'robot_tidak_aktif' => Model::where('status', 0)->count()
            ]);
        }

        
    }

}
