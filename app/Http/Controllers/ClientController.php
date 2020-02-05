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
            $client['sum_work_time'] = $projects->sum('sum_work_time');
            $client['sum_est_time'] = $projects->sum('est_time');
            $client['sum_est_price'] = $projects->sum('est_price');
            $client['sum_profit_time'] = $projects->sum('profit_time');
            $client['sum_profit_price'] = $projects->sum('profit_price');
        });

        return view('client.index', compact('clients'));
    }
}
