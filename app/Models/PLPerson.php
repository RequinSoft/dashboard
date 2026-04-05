<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PLPerson extends Model
{
    protected $table = 'p_l_people';

    protected $fillable = [
        'name',
        'position',
        'image',
    ];

    public function pls_mesActual()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        return $this->hasMany(PL::class, 'PERSONA', 'name')
        ->orderBy('ANIO', 'desc')
        ->orderBy('MES', 'asc')
        ->where('ANIO', $currentYear);
    }

}
