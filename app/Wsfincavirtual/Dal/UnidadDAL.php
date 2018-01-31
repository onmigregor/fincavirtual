<?php
/************************************************/
/*	Creado por Fabiola Rodriguez
/*	Fecha: 21/12/2016
/*  Clase: EstadoDAL.php
/************************************************/

namespace App\Wsfincavirtual\Dal;


use Illuminate\Support\Facades\DB;
use App\Wsfincavirtual\Model\Unidad;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Hash;
 
//NOTA.. EL MODELO ELLOQUETN TIENE EL TIMESTAMP "TRUE" 
class UnidadDAL
{
    public function guardar_unidad($unidad)
    {
        $pgSQL = new Unidad;
        $pgSQL->codusuario    = $unidad['codusuario'] ;
        $pgSQL->tipo_unidad   = $unidad['tipo_unidad'];
        $pgSQL->rif           = $unidad['rif'];
        $pgSQL->codestado     = $unidad['codestado'];
        $pgSQL->codmunicipio  = $unidad['codmunicipio'];
        $pgSQL->codparroquia  = $unidad['codparroquia'];
        $pgSQL->codciudad     = $unidad['codciudad'];
        $pgSQL->avenida       = $unidad['avenida'];
        $pgSQL->casa          = $unidad['casa'];
        $pgSQL->sector        = $unidad['sector'];
        //$pgSQL->save(); 
        return $pgSQL->save();

    }

}