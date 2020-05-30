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
        return $this->belongsTo('App\tipo_discapacidad','tipoDiscapacidad_id'); //Pertenece a un Tipo de Discapacidad.
    }
}
