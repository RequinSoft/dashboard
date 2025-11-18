<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarrenosPlan extends Model
{
    protected $table = 'barrenos_plan';

    protected $fillable = [
        'id',
        'fecha',
        'equipo_id',
        'barrenos_plan',
        'created_at',
        'updated_at'
    ];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'equipo_id');
    }
}
