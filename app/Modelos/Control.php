<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Control extends Model
{
    protected $table = 'controles';
    public $timestamps=false;

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

    public function paciente()
    {
        return $this->belongsTo('App\Modelos\Paciente', 'paciente_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'doctor_id', 'id');
    }

}
