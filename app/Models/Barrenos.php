<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barrenos extends Model
{
    protected $table = 'barrenos';

    protected $fillable = [
        'fecha',
        'equipo',
        'barrenos',
    ];
}
