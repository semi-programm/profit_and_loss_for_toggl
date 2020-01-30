<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


/**
 * Clientだと、namespaceが重複するので、ClientModelという名称で扱う。c
 */
class ClientModel extends Model
{
    protected $table = 'clients';
    protected $fillable = [
        'id',
        'created_at',
        'updated_at',
        'name',
        // 'est_time_high',
        // 'est_time_low',
        // 'est_price',
        // 'm_price',
        // 'progress',
        // 'out_price',
        // 'unit_price',
        // 'finished_time',
        // 'is_finished',
        // 'is_skip_rank',
        // 'client_id',
        'workspace_id',
    ];

    public function project()
    {
        return $this->hasOne('App\Model\Project');
    }

    public function workspace()
    {
        return $this->belongsTo('App\Model\Project');
    }
}
