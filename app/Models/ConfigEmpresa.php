<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfigEmpresa extends Model
{
    protected $table = 'config_empresa';
    
    protected $fillable = [
        'nombre_empresa',
        'direccion',
        'telefono',
        'email',
        'logo',
    ];
}
