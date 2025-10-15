<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemandaAlarma extends Model
{
    protected $table = 'demanda_alarma';

    protected $fillable = [
        'kw',
        'activa',
        'criticidad'
    ];
}
