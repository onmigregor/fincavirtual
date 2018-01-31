<?php
/************************************************/
/*	Creado por Fabiola Rodriguez
/*	Fecha: 21/12/2016
/*  Clase: EstadoDAL.php
/************************************************/

namespace App\Wsfincavirtual\Dal;


use Illuminate\Support\Facades\DB;
use App\Wsfincavirtual\Model\TipoEstatus;
use Carbon\Carbon;
 

class TipoEstatusDAL
{
 
    public function getTipoEstatus($rol)

    {

        $pgSQL = TipoEstatus::select    ('cod_tipo_estatus','nombre_seleccion')   
                              ->where('cod_rol','=',$rol)
                              ->where('seleccion','=',TRUE)
                              ->get();
      //dd($pgSQL);
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