<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Tag extends Model
{
    protected $fillable = [
        'id',
        'workspace_id',

        'created_at',
        'updated_at',
    ];

    public function workspace()
    {
        return $this->belongsTo('App\Models\Workspace');
    }
}
