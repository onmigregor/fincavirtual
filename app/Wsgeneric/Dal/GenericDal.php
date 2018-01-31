<?php namespace App\Wsgeneric\Dal;

use DB;

class GenericDAL
{
    /**
     * Busca información de la respuesta de servicio
     * Modificado por: Victor Poeta, Fecha: 18/10/2016
     * Se agrego 3er parámetro para el idioma (1: español, 2: english) opcional, si no se envía, queda predeterminado 1
    **/
    public function getMessage($codrespuesta,$conexion,$idioma=1) {
        /*$pgSQL=DB::connection($conexion)->select('SELECT ws_respuesta.codrespuesta,ws_respuesta.mensaje  FROM ws_respuesta WHERE ws_respuesta.codrespuesta=:codrespuesta',array ('codrespuesta'=>"$codrespuesta"));*/
        
        //print "'SELECT ws_respuesta.codrespuesta,ws_respuesta.mensaje  FROM ws_respuesta WHERE ws_respuesta.codrespuesta=:codrespuesta',array ('codrespuesta'=>'$codrespuesta')";
        
/*        if ($conexion=='canguroazul') {
        	$pgSQL = DB::connection($conexion)->table('ws_respuesta')
        		   ->select(['codrespuesta', 'mensaje'])
        		   ->where('codrespuesta', '=', $codrespuesta)
        		   ->where('id_language','=',$idioma)->get();
        } else {
        	$pgSQL = DB::connection($conexion)->table('ws_respuesta')
        		   ->select(['codrespuesta', 'mensaje'])
        		   ->where('codrespuesta', '=', $codrespuesta)
                   ->where('id_language','=',1)->get();
        }*/

        $respuesta = DB::connection($conexion)->table('ws_respuesta')
                   ->select(['codrespuesta', 'mensaje'])
                   ->where('codrespuesta', '=', $codrespuesta)
                   //->where('id_language','=', $idioma)
                   ->get();
        return $respuesta; 
        
    } 
    
    
} // END class GenericDal 
