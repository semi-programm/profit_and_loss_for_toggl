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
}
