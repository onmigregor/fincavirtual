<?php
/************************************************/
/*	Creado por Víctor Poeta
/*	Fecha: 01/12/2016
/*  Clase: Tracking.php
/************************************************/

namespace App\Wsfincavirtual\Model;

use Illuminate\Database\Eloquent\Model;

class Repre_legal extends Model
{
	//protected $connection = 'canguroazul'; // Nombre de la conexion a la base de datos
    protected $table = 'repre_legal'; // Nombre de la tabla
    //protected $repre_legal;
    protected $primaryKey = 'cedula';
     // Campo de clave primaria

    /* Cuando el valor es false, NO se actualizan los valores en los
       campos: 'created_at' y 'updated_at' (en caso que existan) */
    public $timestamps = false;
    public $incrementing = false;
}
