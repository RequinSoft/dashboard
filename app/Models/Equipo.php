<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Equipo extends Model
{
    protected $table = 'equipos';

    protected $fillable = [
        'name',
        'tipo',
        'activo',
        'image'
    ];

    public function drill_plan()
    {
        return $this->hasMany(BarrenosPlan::class, 'equipo_id')
            ->where('fecha', Carbon::now()->toDateString());
    }

    public function drill_executed()
    {
        return $this->hasMany(Barrenos::class, 'equipo', 'name')
            ->whereDate('fecha', Carbon::now()->toDateString());
    }
}
