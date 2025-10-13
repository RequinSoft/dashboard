<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemandaActual extends Model
{
    protected $table = 'demanda_actual';
    
    protected $fillable = [
        'kw',
        'factor_potencia',
    ];
}
