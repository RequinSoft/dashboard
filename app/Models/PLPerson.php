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

    public function pl_avg()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        return $this->hasMany(PL::class, 'PERSONA', 'name')
            ->where('ANIO', $currentYear)
            ->orderBy('MONTH', 'ASC');
    }
}
