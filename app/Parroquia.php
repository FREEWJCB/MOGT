<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parroquia extends Model
{
  protected $fillable=[
      'parroquia',
      'municipio_id',
  ];

  public function municipio(){
      return $this->belongsTo('App\Municipio','municipio_id'); //Pertenece a un Tipo de Discapacidad.
  }
}
