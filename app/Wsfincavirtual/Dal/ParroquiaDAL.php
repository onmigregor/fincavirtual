<?php
/************************************************/
/*  Creado por Fabiola Rodriguez
/*  Fecha: 21/12/2016
/*  Clase: EstadoDAL.php
/************************************************/

namespace App\Wsfincavirtual\Dal;


use Illuminate\Support\Facades\DB;


class ParroquiaDAL
{
    public function getParroquia($request)
    {
           $respuesta = DB::table('parroquia')
               ->select('codparroquia', 'nombre')
               ->where('codmunicipio','=',$request)
               ->orderBy('nombre')
               ->get();
       return $respuesta;
    }
}