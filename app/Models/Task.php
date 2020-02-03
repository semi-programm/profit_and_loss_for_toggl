<?php

namespace App\Models;

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
        return $this->belongsTo('App\Models\Project');
    }

    public function workspace()
    {
        return $this->belongsTo('App\Models\Workspace');
    }

    public function timeEntries()
    {
        return $this->belongsTo('App\Models\TimeEntry');
    }
}
