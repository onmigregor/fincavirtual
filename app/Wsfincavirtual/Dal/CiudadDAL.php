<?php
/************************************************/
/*	Creado por Fabiola Rodriguez
/*	Fecha: 21/12/2016
/*  Clase: EstadoDAL.php
/************************************************/

namespace App\Wsfincavirtual\Dal;


use Illuminate\Support\Facades\DB;


class CiudadDAL
{
    public function getCiudad($request)
    {
           $respuesta = DB::table('ciudad')
               ->select('codciudad', 'nombre')
               ->where('codestado','=',$request)
               ->orderBy('nombre')
               ->get();
       return $respuesta;
    }
}