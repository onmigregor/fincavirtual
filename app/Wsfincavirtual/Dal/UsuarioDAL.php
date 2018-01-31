<?php
/************************************************/
/*	Creado por Fabiola Rodriguez
/*	Fecha: 21/12/2016
/*  Clase: EstadoDAL.php
/************************************************/

namespace App\Wsfincavirtual\Dal;


use Illuminate\Support\Facades\DB;
use App\Wsfincavirtual\Model\Usuario;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Hash;
 
//NOTA.. EL MODELO ELLOQUETN TIENE EL TIMESTAMP "TRUE" 
class UsuarioDAL
{
    public function guardar_usuario($usuario)
    {

        $pgSQL = new Usuario;
        $pgSQL->nombre        = $usuario['nombre'];
        $pgSQL->email         = $usuario['email'];
        $pgSQL->password      = Hash::make($usuario['password']);
        $pgSQL->rol           = 'RL01';
        $pgSQL->save(); 

        
      $pgSQL2 =Usuario::find($pgSQL['original']['id']);
      $pgSQL2->codusuario = "US".str_pad($pgSQL['original']['id'], 3, "0", STR_PAD_LEFT);
      $pgSQL2->save();

      if ( $pgSQL->save()==TRUE && $pgSQL2->save()==TRUE ) 
      {     
        return $pgSQL2['original']['codusuario']; 
      }

      return false;

 
    }

}