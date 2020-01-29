<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;



class TimeEntries extends Model
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
}
