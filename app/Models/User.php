<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

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
        return $this->hasMany('App\Models\TimeEntry');
    }
}
