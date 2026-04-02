<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AVGMes extends Model
{
    protected $connection = 'ssmarc';
    protected $table = 'CONSULTA_PORCENTAJE_TOTAL_MES';

    protected $fillable = [
        'PERSONA',
        'MES',
        'ANIO',
        'PORCENTAJE_TOTAL',
    ];
}
