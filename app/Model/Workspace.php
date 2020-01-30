<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;



class Workspace extends Model
{
    protected $fillable = [
        'id',
        'created_at',
        'updated_at',
        // 'name',
        // 'est_time_high',
        // 'est_time_low',
        // 'est_price',
        // 'm_price',
        // 'progress',
        // 'out_price',
        // 'unit_price',
        // 'finished_time',
        // 'is_finished',
        // 'is_skip_rank',
        // 'client_id',
        // 'workspace_id',
    ];

    public function projects()
    {
        return $this->hasMany('App\Model\Project');
    }

    public function clients()
    {
        return $this->hasMany('App\Model\ClientModel');
    }

    public function tags()
    {
        return $this->hasMany('App\Model\Tag');
    }

    public function tasks()
    {
        return $this->hasMany('App\Model\Task');
    }

    public function timeEntries()
    {
        return $this->hasMany('App\Model\TimeEntry');
    }
}
