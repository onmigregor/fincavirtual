<?php namespace App\Http\Controllers\Wsgeneric\Usuario;


use DB;
use View;
use Input;
use Session;
use Response;
use Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\ConsumirWS;

class ModulosController extends Controller {

	var $consumirws;
	var $rutaSession;
	public function  __construct(){
        $this->consumirws=new ConsumirWS();
		$this->rutaSession=Session::get('conexion');
    }
	
	/**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => 'required|max:255',
            'id_sistema' => 'required|integer',
            'fecha_hora' => 'required',
			'codusuario' => 'required|integer',
        ]);
    }

   
	
	
	/**
	  * Vista Insertar Menus
	  *
	  * @return string
	  */
	public function addModulos()
    {
		$token=Session::get('entidadRespuesta.token');
		//SE CONSUME A ICONOS  DE BOOSTRAP
		$parametros_iconos = "";
		$Icono_webservice='getInfoIconosBoostrapWs';
		$iconosBoostrap=$this->consumirws->consumirPorGet($Icono_webservice,$parametros_iconos,$url='customs.url_baaszoom',$this->rutaSession."/");
		
		//SE CONSUME A SISTEMAS segun PREFIJO
		$parametros_sistema = array('prefijo[]'=>$this->rutaSession);
		$sistema_webservice='getInfoSistemaWs';
		$sistema=$this->consumirws->consumirPorGet($sistema_webservice,$parametros_sistema,$url='customs.url_baaszoom',$this->rutaSession."/");
		
		return view('Wsgeneric/Perfiles/addModulos',compact('token','iconosBoostrap','sistema'));
    }
	
	/**
	  * Post Insertar Menus
	  *
	  * @return json
	  */
	public function postinsertModulos(Request $request){
		
		$parametros = array(
			'nombre'=>$request->get('nombre'),
			'id_sistema'=>$request->get('id_sistema')
		);
		$webservice='getInfoModuloSistemaWs';
		$consultaModulo=$this->consumirws->consumirPorGet($webservice,$parametros,$url='customs.url_baaszoom',$this->rutaSession."/");
		
		if($consultaModulo['codrespuesta'] != 'COD_000'){
			//se crea un arreglo con los parametros a ingresar 
			$parametrosInsertar = array(
				'nombre'=>$request->get('nombre'),
				'id_sistema'=>$request->get('id_sistema'),
				'fecha_hora'=>$request->get('fecha_hora'),
				'codusuario'=>$request->get('codusuario'),
				'icono'=>$request->get('icono')
			);
			
			$webservice='addModulosWs';
			$response=$this->consumirws->consumirPorPost($webservice,$parametrosInsertar,$url='customs.url_baaszoom',$this->rutaSession."/");
			return redirect($this->rutaSession.'/'.'listModulosWs')->with('alert-success', $response['codrespuesta'].' - '.$response['mensaje']);
			//return view('Wsgeneric/Perfiles/modulosList',compact('response'))->with('alert-success', 'EL REGISTRO HA SIDO INGRESADO EXITOSAMENTE');
		}else{
			return redirect($this->rutaSession.'/'.'addModulos')->with('alert-danger', 'ESTE REGISTRO YA SE ENCUENTRA REGISTRADO. VERIFIQUE NOMBRE DEL MODULO');
		}
	}
	
	
	
	public function listModulosWs(){
		
		$parametros = "";
		$webservice='getInfoModuloSistemaWs';
		$response=$this->consumirws->consumirPorGet($webservice,$parametros,$url='customs.url_baaszoom',$this->rutaSession."/");
		
		return view('Wsgeneric/Perfiles/modulosList',compact('response'))->with('alert-success', 'EL REGISTRO HA SIDO INGRESADO EXITOSAMENTE');
	}
	
	
	public function eliminarModulos(Request $request){
		$parametros = array(
			'id_modulo'=>$request->get('id_modulo')
		);
		$webservice='eliminarModuloWs';
		$response=$this->consumirws->consumirPorPost($webservice,$parametros,$url='customs.url_baaszoom',$this->rutaSession."/");
		
		if(!empty($response)){
			return redirect($this->rutaSession.'/'.'listModulosWs')->with('alert-success', $response['codrespuesta'].' - '.$response['mensaje']);
		}else{
			return redirect($this->rutaSession.'/'.'listModulosWs')->with('alert-danger', 'NO EXISTEN REGISTROS A ELIMINAR. VERIFIQUE');
		}
	}
	
}
