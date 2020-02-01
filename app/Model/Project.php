<?php

namespace App\Model;

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
        return $this->hasMany('App\Model\TimeEntry');
    }

    public function client()
    {
        return $this->belongsTo('App\Model\ClientModel');
    }

    public function workspace()
    {
        return $this->belongsTo('App\Model\Workspace');
    }

    public function tasks()
    {
        return $this->hasMany('App\Model\Task');
    }

}
