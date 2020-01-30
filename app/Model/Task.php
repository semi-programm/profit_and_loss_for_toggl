<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;



class Task extends Model
{
    protected $fillable = [
        'id',
        'name',
        'project_id',
        'workspace_id',
        'est_sec',

        'created_at',
        'updated_at',
    ];

    public function project()
    {
        return $this->belongsTo('App\Model\Project');
    }

    public function workspace()
    {
        return $this->belongsTo('App\Model\Workspace');
    }

    public function timeEntries()
    {
        return $this->belongsTo('App\Model\TimeEntry');
    }
}
