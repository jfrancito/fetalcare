<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class DetalleDiagnosticoExamen extends Model
{
    protected $table = 'detallediagnosticoexamen';
    public $timestamps=false;

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

    public function examen()
    {
        return $this->hasOne('App\Modelos\Examen', 'id','examen_id');
    }

    public function diagnosticoexamen()
    {
        return $this->belongsTo('App\Modelos\DiagnosticoExamen', 'diagnosticoexamen_id','id');
    }


    


}
