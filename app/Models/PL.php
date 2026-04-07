<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PL extends Model
{
    protected $table = 'p_l_s';

    protected $fillable = [
        'PERSONA',
        'PORCENTAJE_TOTAL',
        'ANIO',
        'MES',
        'MONTH',
    ];

    public function person()
    {
        return $this->belongsTo(PLPerson::class, 'PERSONA', 'name');
    }
}
