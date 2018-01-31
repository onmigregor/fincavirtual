<?php
/************************************************/
/*	Creado por Omar Ramirez
/*	Fecha: 21/12/2016
/*  Clase: EstadoDAL.php
/************************************************/

namespace App\Wsfincavirtual\Dal;


use Illuminate\Support\Facades\DB;
use App\Wsfincavirtual\Model\Estatus;
use Carbon\Carbon;
 

class EstatusDAL
{
    public function NewEstatus($estatus)
    {
        $pgSQL = new Estatus;
        $pgSQL->cod_pedido         = $estatus['cod_pedido'];
        $pgSQL->cod_tipo_estatus   = $estatus['cod_tipo_estatus'];
        $pgSQL->cod_usuario        = $estatus['cod_usuario'];
        $pgSQL->observaciones      = $estatus['observaciones'];
        $pgSQL->save();
        return $pgSQL ;
    }

/*
     public function cambiarvisto($pedido)
    {
      $pgSQL =Pedido::find($pedido);
      $pgSQL->visto = TRUE;
      $pgSQL->save();

    }

    public function EditPedido($pedido)
    {
      $now = Carbon::now();

     
      $pgSQL =Pedido::find($pedido['codpedido']);
      $pgSQL->descripcion             = $pedido['rubro'];
      $pgSQL->produccion              = TRUE;
      $pgSQL->fecha_produccion        = $now->toDateTimeString();
      
      $pgSQL->save();
       
    }

    public function getPedido($pedido='null')
    {
        
        if ($pedido==null) 
        {
                $pgSQL = DB::table('pedido')
                          ->select    ('pedido.codpedido', 'pedido.fecha_registro','visto')
                          //->join('estado', 'empresa.codestado', '=', 'estado.codestado')
                          //->join('municipio', 'empresa.codmunicipio', '=', 'municipio.codmunicipio')
                          ->orderBy('pedido.fecha_registro', 'desc')
            
                          ->get();
                          //dd($pgSQL);
        }
        else
        {
            
                $pgSQL = DB::table('pedido')
                        ->where('codpedido', '=', $pedido)
                        ->get();

                                //dd($pgSQL['0']);
        }

        return $pgSQL;
    }

*/


}