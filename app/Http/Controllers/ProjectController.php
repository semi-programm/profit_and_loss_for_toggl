<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Model\Project;

class ProjectController extends Controller
{
    public function index ()
    {
        $projects = Project::all();
        return view('project.index', compact('projects'));
    }

    public function view ()
    {
        $projects = Project::all();
        return view('project.view', $projects);
    }
}
