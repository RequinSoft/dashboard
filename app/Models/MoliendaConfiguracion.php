<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoliendaConfiguracion extends Model
{
    protected $table = 'molienda_configuracion';

    protected $fillable = [
        'plan',
    ];
}
