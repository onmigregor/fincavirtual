<?php
/************************************************/
/*	Creado por Víctor Poeta
/*	Fecha: 01/12/2016
/*  Clase: Tracking.php
/************************************************/

namespace App\Wsfincavirtual\Model;

use Illuminate\Database\Eloquent\Model;

class Tipo_estatus extends Model
{
	//protected $connection = 'canguroazul'; // Nombre de la conexion a la base de datos
    protected $table = 'tipo_estatus'; // Nombre de la tabla
    //protected $repre_legal;
    protected $primaryKey = 'cod_tipo_estatus';
     // Campo de clave primaria

    /* Cuando el valor es false, NO se actualizan los valores en los
       campos: 'created_at' y 'updated_at' (en caso que existan) */
    public $timestamps = false;
    public $incrementing = false;



    /* public function estado() {
        return $this->belongsTo(Estado::class, 'codestado', 'codestado')
            ->select(['codestado','nombre']);
    }

    public function municipio() {
        return $this->belongsTo(Municipio::class, 'codmunicipio', 'codmunicipio')
            ->select(['codmunicipio','nombre']);
    }

    public function tipo_estatus() {
        return $this->belongsTo(Repre_legal::class, 'cod_tipo_estatus', 'cod_tipo_estatus')
            ->select(['cedula','repre_legal.nombre','apellido','tlfcelular','correo_repre','cargo.nombre as cargo'])
            ->join('cargo', 'repre_legal.cod_tipcargo', '=', 'cargo.codtipcargo');
    }*/

}
