<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class DetalleControl extends Model
{
    protected $table = 'detallecontroles';
    public $timestamps=false;

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';


    public function receta()
    {
        return $this->hasOne('App\Modelos\Receta', 'id','diagnostico_id');
    }


    public function cie()
    {
        return $this->hasOne('App\Modelos\Cie', 'id','cie_id');
    }
}

