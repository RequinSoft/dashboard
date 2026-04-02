<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PL extends Model
{
    protected $table = 'p_l_s';

    protected $fillable = [
        'pl_person_id',
        'pl',
        'year',
        'month',
    ];

    public function person()
    {
        return $this->belongsTo(PLPerson::class, 'pl_person_id', 'id');
    }
}
