<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class configKw extends Model
{
    protected $table = 'config_kw';

    protected $fillable = [
        'name',
        'ip',
        'port',
        'setpoint',
    ];
}
