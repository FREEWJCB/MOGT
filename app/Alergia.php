<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alergia extends Model
{
    protected $fillable=[
        'nombre',
        'descripcion',
        'tipoAlergia_id',
    ];

    public function tipos(){
        return $this->belongsTo(Tipo_alergia::class); //Pertenece a un Tipo de Alergia.
    }
}
