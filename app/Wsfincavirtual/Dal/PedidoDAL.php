<?php
/************************************************/
/*	Creado por Fabiola Rodriguez
/*	Fecha: 21/12/2016
/*  Clase: EstadoDAL.php
/************************************************/

namespace App\Wsfincavirtual\Dal;


use Illuminate\Support\Facades\DB;
use App\Wsfincavirtual\Model\Pedido;
use Carbon\Carbon;
use Session;
 

class PedidoDAL
{
    public function RegPedido($pedido)
    {
     //dd($pedido);

        $pgSQL = new Pedido;
        $pgSQL->codpedido        = $pedido['codpedido'];
        $pgSQL->descripcion      = $pedido['rubro'];
        $pgSQL->estatus_actual   = $pedido['estatus_actual'];
        $pgSQL->save();
        return $pgSQL['attributes']['codpedido']; 
    }


     public function cambiarvisto($pedido)
    {
      $pgSQL =Pedido::find($pedido);
      $pgSQL->visto_produccion = TRUE;
      $pgSQL->save();

    }

    public function EditPedido($pedido)
    {
      $now = Carbon::now();

      $pgSQL =Pedido::find($pedido['codpedido']);
      $pgSQL->descripcion      = $pedido['rubro'];
      $pgSQL->estatus_actual   = $pedido['estatus_actual'];
      if ($pedido['estatus_actual']==1) 
      {
      $pgSQL->visto_produccion =false;
      }
      //$pgSQL->produccion              = TRUE;
      //$pgSQL->fecha_produccion        = $now->toDateTimeString();
      
     //dd($pgSQL['attributes']['codpedido']);
      $pgSQL->save();

      return $pgSQL['attributes']['codpedido']; 
       
    }

    public function getPedido($pedido=null)
    {  
        if (!isset($pedido['pedido'])) 
        {       
                $pgSQL = Pedido::select    ('pedido.codpedido', 'pedido.fecha_registro','visto_produccion')   
                          ->orderBy('pedido.fecha_registro', 'desc')
                          ->with('estatus');
                          if($pedido['rol']=='RL03')
                          {
                          $pgSQL=$pgSQL->where('estatus_actual', 4)
                                      ->orWhere('estatus_actual', 5)
                                      ->orWhere('estatus_actual', 6);
                          }
                          $pgSQL=$pgSQL->get();
        }
        else
        {
               $pgSQL = Pedido::select    ('codpedido','descripcion','fecha_registro','visto_produccion','estatus_actual') 
                        ->where('codpedido', '=', $pedido)
                        ->with('estatus_individual')
                        ->get();

                                //dd($pgSQL['0']);
        }

        return $pgSQL;
    }


    public function cambiarestatus()
    {

      $pgSQL =Pedido::where('estatus_actual', 2)
                      ->select('codpedido')
                      // ->update(['delayed' => 1]);
                      ->get();
      $cambio =Pedido::where('estatus_actual', 2)
                      ->update(['estatus_actual' => 4]);          
      //dd($pgSQL);
      return($pgSQL);
    }

    public function Regcompras($pedido)
    {
      $pgSQL =Pedido::find($pedido['codpedido']);
      $pgSQL->estatus_actual= $pedido['estatus_actual'];
      $pgSQL->save();
      
      return($pgSQL);
    }

     public function getAprobados($pedido)
    {

      if ($pedido==null) 
      {
                $pgSQL = Pedido::select    ('pedido.codpedido', 'pedido.fecha_registro','visto_produccion')
                          ->where('estatus_actual', 5)   //aprobado por compras
                          ->orderBy('pedido.fecha_registro', 'desc')
                          ->with('estatus')
                          ->get();
      }
      return($pgSQL);
    }
}