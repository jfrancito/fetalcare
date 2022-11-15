<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class DetalleReceta extends Model
{
    protected $table = 'detallerecetas';
    public $timestamps=false;

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

    public function medicamento()
    {
        return $this->hasOne('App\Modelos\Medicamento', 'id','medicamento_id');
    }

    public function receta()
    {
        return $this->belongsTo('App\Modelos\Receta', 'receta_id','id');
    }


    public function dosificaciondetalle()
    {
        $valor ='';
        switch ($this->dosificacion) {
            case 0:
                $valor = 'NINGUNO';
                break;
            case 1:
                $valor = 'C / 8 HORAS';
                break;
            case 2:
                $valor = 'C / 12 HORAS';
                break;
            case 3:
                $valor = 'C / 24 HORAS';
                break;
        }
        return $valor;
    }


}
