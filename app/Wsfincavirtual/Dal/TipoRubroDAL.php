<?php
/************************************************/
/*	Creado por Fabiola Rodriguez
/*	Fecha: 21/12/2016
/*  Clase: EstadoDAL.php
/************************************************/

namespace App\Wsfincavirtual\Dal;


use Illuminate\Support\Facades\DB;
use App\Wsfincavirtual\Model\TipoRubro;


class TipoRubroDAL
{
    public function getTipoRubro()
    {
         /*  $respuesta = DB::table('estado')
               ->select('codestado', 'nombre')
               ->orderBy('nombre')
               ->get();*/


                $respuesta = TipoRubro::select    ('cod_tipo', 'nombre')
                                
                                //->with('estado')
                                //->join('estado', 'empresa.codestado', '=', 'estado.codestado')
                                ->get();
              

             
       return $respuesta;
    }
}