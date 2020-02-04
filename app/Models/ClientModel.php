<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Clientだと、namespaceが重複するので、ClientModelという名称で扱う。
 */
class ClientModel extends Model
{
    protected $table = 'clients';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'workspace_id',

        'created_at',
        'updated_at',
    ];

    public function projects()
    {
        return $this->hasMany('App\Models\Project', 'client_id');
    }

    public function workspace()
    {
        return $this->belongsTo('App\Models\Project');
    }
}
