<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Demanda extends Model
{
    protected $table = 'demanda'; // Nombre de la tabla en la base de datos
    
    protected $fillable = [
        'kw',
        'factor_potencia',
    ]; // Campos que se pueden asignar masivamente
}
