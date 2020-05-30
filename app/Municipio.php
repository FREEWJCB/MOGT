<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $fillable=[
        'municipio',
        'estado_id',
    ];

    public function estados(){
        return $this->belongsTo('App\Estado','estado_id'); //Pertenece a un Tipo de Discapacidad.
    }

    public function parroquia(){
        return $this->hasMany(Parroquia::class);
    }
}
