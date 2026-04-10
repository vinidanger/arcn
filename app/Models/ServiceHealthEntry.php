<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceHealthEntry extends Model
{
    protected $primaryKey = 'service_key';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'service_key',
        'name',
        'group_label',
        'check_type',
        'target',
        'status',
        'latency_ms',
        'detail',
        'raw_status',
        'checked_at',
    ];

    protected function casts(): array
    {
        return [
            'checked_at' => 'datetime',
        ];
    }
}
