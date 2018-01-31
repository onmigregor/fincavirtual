<?php
/************************************************/
/*	Creado por Víctor Poeta
/*	Fecha: 01/12/2016
/*  Clase: Tracking.php
/************************************************/

namespace App\Wsfincavirtual\Model;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
	//protected $connection = 'canguroazul'; // Nombre de la conexion a la base de datos
    protected $table = 'pedido'; // Nombre de la tabla
    //protected $repre_legal;
    protected $primaryKey = 'codpedido';
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

    public function repre_legal() {
        return $this->belongsTo(Repre_legal::class, 'codcedula', 'cedula')
            ->select(['cedula','repre_legal.nombre','apellido','tlfcelular','correo_repre','cargo.nombre as cargo'])
            ->join('cargo', 'repre_legal.cod_tipcargo', '=', 'cargo.codtipcargo');
    }*/

    public function estatus() {
        return $this->belongsTo(Estatus::class,'codpedido','cod_pedido')
            ->select(['estatus.cod_pedido','descripcion','siglas','fecha_estatus','observaciones'])
            ->join('tipo_estatus', 'estatus.cod_tipo_estatus', '=', 'tipo_estatus.cod_tipo_estatus')
            ->orderBy('fecha_estatus');
    }

     public function estatus_individual() {
        return $this->hasMany(Estatus::class,'cod_pedido','codpedido')
            ->select(['estatus.cod_pedido','descripcion','siglas','fecha_estatus','observaciones'])
            ->join('tipo_estatus', 'estatus.cod_tipo_estatus', '=', 'tipo_estatus.cod_tipo_estatus')
            ->orderBy('fecha_estatus');
            //->last();
    }

}
