<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;



class User extends Model
{
    protected $fillable = [
        'id',
        'name',
        'mail',
        'created_at_toggl',
        'workspace_id',
        'password',
        'created_at',
        'updated_at',
    ];

    public function timeEntries()
    {
        return $this->hasMany('App\Model\TimeEntry');
    }
}
