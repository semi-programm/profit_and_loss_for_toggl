<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Review extends Model
{
    protected $fillable = [
        'id',
        'self_comment',
        'other_comment',
        'self_user',
        'other_user',
        'created_at',
        'updated_at',
    ];

    public function project()
    {
        return $this->hasOne('App\Models\Project');
    }

    public function selfUser()
    {
        return $this->haOne('App\Models\User', 'self_user_id');
    }

    public function otherUser()
    {
        return $this->haOne('App\Models\User', 'other_user_id');
    }
}
