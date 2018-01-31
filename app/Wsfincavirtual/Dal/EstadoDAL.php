<?php
/************************************************/
/*	Creado por Fabiola Rodriguez
/*	Fecha: 21/12/2016
/*  Clase: EstadoDAL.php
/************************************************/

namespace App\Wsfincavirtual\Dal;


use Illuminate\Support\Facades\DB;
use App\Wsfincavirtual\Model\Estado;


class EstadoDAL
{
    public function getEstado()
    {
         /*  $respuesta = DB::table('estado')
               ->select('codestado', 'nombre')
               ->orderBy('nombre')
               ->get();*/


                $respuesta = Estado::select    ('codestado', 'nombre')
                                
                                //->with('estado')
                                //->join('estado', 'empresa.codestado', '=', 'estado.codestado')
                                ->get();
              

             
       return $respuesta;
    }
}