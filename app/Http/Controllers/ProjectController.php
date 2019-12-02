<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index (Request $request)
    {
        $projects = Project::all();
        return view ('project.index', ['projects' => $projects]);
    }

    public function view ()
    {
        $projects = Project::all();
        return view('project.view', $projects);
    }
}
