<?php
/************************************************/
/*	Creado por Omar Ramirez
/*	Fecha: 21/12/2016
/*  Clase: EstadoDAL.php
/************************************************/

namespace App\Wsfincavirtual\Dal;


use Illuminate\Support\Facades\DB;


class CargoDAL
{
    public function getCargo($request)
    {
           $respuesta = DB::table('cargo')
               ->select('codtipcargo', 'nombre')
               //->where('codestado','=',$request)
               ->orderBy('nombre')
               ->get();
       return $respuesta;
    }
}