<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $fillable=[
        'cedula',
        'nombres',
        'apellidos',
        'sexo',
        'telefono',
        'correo',
        'cargo_id',
    ];

    public function cargo(){ //$empleado->cargo->nombre
        return $this->belongsTo(Cargo::class); //Pertenece a un Género.
    }
}
