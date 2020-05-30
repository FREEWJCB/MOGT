<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_discapacidad extends Model
{
    protected $fillable=[
        'tipo_d',
    ];

    public function discapacidad(){
        return $this->hasMany(Discapacidad::class);
    }
}
