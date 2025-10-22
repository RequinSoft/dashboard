<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfigPi extends Model
{
    protected $table = 'config_pi';

    protected $fillable = [
        'ip_pi',
        'port_pi',
        'ip_af',
        'port_af',
        'activo',
    ];
}
