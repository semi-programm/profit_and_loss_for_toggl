<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;

class Usercontroller extends Controller
{
    public function index (Request $request)
    {
        $users = User::all();
        return view ('user.index', ['users' => $users]);
    }

    public function view ()
    {
        $users = User::all();
        return view('user.view', $users);
    }
}
