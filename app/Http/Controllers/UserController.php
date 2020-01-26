<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;

class Usercontroller extends Controller
{
    public function index ()
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
