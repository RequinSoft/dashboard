<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ldap extends Model
{
    protected $table = 'ldap_configs';

    protected $fillable = [
        'ip',
        'port',
        'domain',
        'base_dn',
        'user',
        'password',
        'version',
        'status',
    ];
}
