<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PLPerson extends Model
{
    protected $table = 'p_l_people';

    protected $fillable = [
        'name',
        'position',
        'image',
    ];

    public function pls()
    {
        return $this->hasMany(PL::class, 'pl_person_id', 'id');
    }
}
