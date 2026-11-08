<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PitramToken extends Model
{
    protected $fillable = ['id', 'access_token', 'expires_at'];

    protected $hidden = ['access_token'];

    protected function casts(): array
    {
        return [
            'access_token' => 'encrypted',
            'expires_at' => 'immutable_datetime',
        ];
    }
}
