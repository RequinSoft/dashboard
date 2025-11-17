<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Molienda extends Model
{
    protected $table = 'molienda_turno';

    protected $fillable = [
        'fecha',
        'plan',
        'primer_turno',
        'segundo_turno'
    ];
}
