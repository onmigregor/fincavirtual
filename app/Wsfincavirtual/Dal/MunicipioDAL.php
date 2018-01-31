<?php
/************************************************/
/*  Creado por Fabiola Rodriguez
/*  Fecha: 21/12/2016
/*  Clase: EstadoDAL.php
/************************************************/

namespace App\Wsfincavirtual\Dal;


use Illuminate\Support\Facades\DB;


class MunicipioDAL
{
    public function getMunicipio($request)
    {
        
           $respuesta = DB::table('municipio')
               ->select('codmunicipio', 'nombre')
               ->where('codestado','=',$request)
               ->orderBy('nombre')
               ->get();
       return $respuesta;
    }
}