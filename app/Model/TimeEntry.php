<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;



class TimeEntry extends Model
{
    protected $fillable = [
        'id',
        'workspace_id',
        'user_id',
        'start',
        'stop',
        'duration',
        'description',
        'task_id',
        'project_id',

        'created_at',
        'updated_at',
    ];

    public function project()
    {
        return $this->belongsTo('App\Model\Project');
    }

    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }

    public function tasks()
    {
        return $this->hasOne('App\Model\Task');
    }

    public function workspace()
    {
        return $this->belongsTo('App\Model\Workspace');
    }

}
