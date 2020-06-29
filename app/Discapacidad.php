<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discapacidad extends Model
{
    protected $fillable=[
        'discapacidad',
        'descripciones',
        'tipoDiscapacidad_id',
    ];

    public function tipo(){ 
        return $this->belongsTo(Tipo_discapacidad::class); //Pertenece a un Tipo de Discapacidad.
    }
}
