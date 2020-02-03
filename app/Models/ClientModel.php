<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Clientだと、namespaceが重複するので、ClientModelという名称で扱う。c
 */
class ClientModel extends Model
{
    protected $table = 'clients';
    protected $fillable = [
        'id',
        'name',
        'workspace_id',

        'created_at',
        'updated_at',
    ];

    public function project()
    {
        return $this->hasOne('App\Models\Project');
    }

    public function workspace()
    {
        return $this->belongsTo('App\Models\Project');
    }
}
