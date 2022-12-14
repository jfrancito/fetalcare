<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Cie extends Model
{
    protected $table = 'cies';
    public $timestamps=false;

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';



}
