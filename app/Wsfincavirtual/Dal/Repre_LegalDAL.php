<?php
/************************************************/
/*	Creado por Fabiola Rodriguez
/*	Fecha: 21/12/2016
/*  Clase: EstadoDAL.php
/************************************************/

namespace App\Wsfincavirtual\Dal;


use Illuminate\Support\Facades\DB;
use App\Wsfincavirtual\Model\Repre_legal;

class Repre_LegalDAL
{
    public function RegRepreLegal($repre_legal)
    {

    	

           /*$respuesta = DB::table('repre_legal')
               ->insertGetId([
               					'cedula'		=>	$repre_legal['cedula'],
               					'nombre'		=>	$repre_legal['nombre'],
               					'apellido'		=>	$repre_legal['apellido'],
               					'cod_tipcargo'	=>	$repre_legal['cod_tipcargo'],
               					'tlfcelular'	=>	$repre_legal['tlfcelular'],
               					'correo_repre'	=>	$repre_legal['correo_repre'],
               					]	
    					);*/

       // return "V1622744";               
              
        $pgSQL = new Repre_legal;
        $pgSQL->cedula      = $repre_legal['cedula'];
        $pgSQL->nombre      = $repre_legal['nombre'];
        $pgSQL->apellido    = $repre_legal['apellido'];
        $pgSQL->cod_tipcargo  = $repre_legal['cod_tipcargo'];
        $pgSQL->tlfcelular    = $repre_legal['tlfcelular'];
        $pgSQL->correo_repre  = $repre_legal['correo_repre'];
        $pgSQL->save();
               
        return $pgSQL['attributes']['cedula'];

       //return $respuesta;
    }
}