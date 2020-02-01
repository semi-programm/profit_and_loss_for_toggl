<?php

namespace App\Model;

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
