<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'pacientes';
    public $timestamps=false;

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

    public function control()
    {
        return $this->hasMany('App\Modelos\Control', 'paciente_id', 'id');
    }


}
