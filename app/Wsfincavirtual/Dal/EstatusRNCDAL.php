<?php
/************************************************/
/*	Creado por Fabiola Rodriguez
/*	Fecha: 21/12/2016
/*  Clase: EstadoDAL.php
/************************************************/

namespace App\Wsfincavirtual\Dal;


use Illuminate\Support\Facades\DB;


class EstatusRNCDAL
{
    public function getEstaRNC($request)
    {

           $respuesta = DB::table('estatusRNC')
               ->select('codestatusRCN', 'nombre','habilitada')
               ->where('nombre','=',$request)
               //->orderBy('nombre')
               ->get();

       		return $respuesta;
    }
}