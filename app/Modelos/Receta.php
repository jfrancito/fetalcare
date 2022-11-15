<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    protected $table = 'recetas';
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

    public function diagnostico()
    {
        return $this->hasOne('App\Modelos\DetalleControl', 'id','diagnostico_id');
    }
    

    public function detallereceta()
    {
        return $this->hasMany('App\Modelos\DetalleReceta', 'id','receta_id');
    }
    
}
