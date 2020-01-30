<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use Carbon\Carbon;

class Usercontroller extends Controller
{
    public function index ()
    {
        $users = User::all();

        $this_month = Carbon::now()->month;

        $users->each(function($user) use ($this_month){
            $times = $user->timeEntries()->whereMonth('start', '=' ,$this_month)->get();
            $sum_time = $times->sum('duration'); //単位はms
            $user['sum_time'] = $sum_time/(1000*60*60);
        });



        return view ('user.index', ['users' => $users]);
    }

    public function view ()
    {
        $users = User::all();
        return view('user.view', $users);
    }
}
