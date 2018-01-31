<?php
/************************************************/
/*	Creado por Víctor Poeta
/*	Fecha: 01/12/2016
/*  Clase: Tracking.php
/************************************************/

namespace App\Wsfincavirtual\Model;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
	//protected $connection = 'canguroazul'; // Nombre de la conexion a la base de datos
    protected $table = 'cargo'; // Nombre de la tabla
    //protected $repre_legal;
    protected $primaryKey = 'codtipcargo';
     // Campo de clave primaria

    /* Cuando el valor es false, NO se actualizan los valores en los
       campos: 'created_at' y 'updated_at' (en caso que existan) */
    public $timestamps = false;
    public $incrementing = false;


}