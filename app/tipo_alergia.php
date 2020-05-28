<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipo_alergia extends Model
{
    protected $fillable=[
        'name',
    ];

    public function alergia(){
        return $this->hasMany(Alergia::class);
    }

}