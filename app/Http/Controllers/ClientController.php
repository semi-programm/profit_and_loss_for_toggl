<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientModel;
use Carbon\CarbonImmutable as Carbon;
use App\Http\Controllers\ProjectController;

class ClientController extends Controller
{
    public function index()
    {
        $clients = ClientModel::all();
        $clients->each(function($client)
        {
            $projects = $client->projects()->get();
            $project_func = new ProjectController;
            $projects = $project_func->sumTimeEntries($projects);
            $client['time_sum'] = $projects->sum('sum');
            $client['est_time_sum'] = $projects->sum('sum');
            $client['est_price_sum'] = $projects->sum('sum');

        });
    }
}
