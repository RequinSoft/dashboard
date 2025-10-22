<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversion extends Model
{
    protected $table = 'conversiones';

    protected $fillable = [
        'usd',
        'au',
        'ag',
    ];
}
