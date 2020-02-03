<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Project extends Model
{
    protected $fillable = [
        'id',
        'name',
        'client_id',
        'workspace_id',

        'est_time',
        'est_price',
        'm_price',
        'progress',
        'out_price',
        'unit_price',
        'finished_time',
        'is_finished',
        'is_skip_rank',
        'created_at',
        'updated_at',
    ];

    public function timeEntries()
    {
        return $this->hasMany('App\Models\TimeEntry');
    }

    public function latestTimeEntry()
    {
        return $this->hasOne('App\Models\TimeEntry')->orderBy('start', 'desc');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\ClientModel');
    }

    public function workspace()
    {
        return $this->belongsTo('App\Models\Workspace');
    }

    public function tasks()
    {
        return $this->hasMany('App\Models\Task');
    }

}
