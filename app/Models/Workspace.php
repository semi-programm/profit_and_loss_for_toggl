<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Workspace extends Model
{
    protected $fillable = [
        'id',

        'created_at',
        'updated_at',
    ];

    public function projects()
    {
        return $this->hasMany('App\Models\Project');
    }

    public function clients()
    {
        return $this->hasMany('App\Models\ClientModel');
    }

    public function tags()
    {
        return $this->hasMany('App\Models\Tag');
    }

    public function tasks()
    {
        return $this->hasMany('App\Models\Task');
    }

    public function timeEntries()
    {
        return $this->hasMany('App\Models\TimeEntry');
    }
}
