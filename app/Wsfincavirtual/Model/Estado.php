<?php
/************************************************/
/*	Creado por Omar Ramirez
/*	Fecha: 06/12/2016
/*  Clase: Estado.php
/************************************************/

namespace App\Wsfincavirtual\Model;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
   // protected $connection = 'canguroazul'; // Nombre de la conexion a la base de datos
    protected $table = 'estado'; // Nombre de la tabla
    protected $primaryKey = 'codestado'; // Campo de clave primaria

    /* Cuando el valor es false, NO se actualizan los valores en los
       campos: 'created_at' y 'updated_at' (en caso que existan) */
    public $timestamps = false;




}