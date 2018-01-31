<?php
/************************************************/
/*	Creado por Fabiola Rodriguez
/*	Fecha: 21/12/2016
/*  Clase: EstadoDAL.php
/************************************************/

namespace App\Wsfincavirtual\Dal;


use Illuminate\Support\Facades\DB;
use App\Wsfincavirtual\Model\Rubro;


class RubroDAL
{
    public function getRubro($cod_tipo)
    {

                $respuesta = Rubro::select    ('cod_rubro', 'nombre')
                                ->where('cod_tipo','=',$cod_tipo)
                                
                                //->join('estado', 'empresa.codestado', '=', 'estado.codestado')
                                ->get();
              

             
       return $respuesta;
    }

    public function getDescripcionRubro($cod_rubro)
    {

                $respuesta = Rubro::select    ('nombre')
                                ->where('cod_rubro','=',$cod_rubro)
                                
                                //->join('estado', 'empresa.codestado', '=', 'estado.codestado')
                                ->first();
              

             
       return $respuesta;
    }
}