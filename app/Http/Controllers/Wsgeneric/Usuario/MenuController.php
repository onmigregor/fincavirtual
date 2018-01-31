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

class MenuController extends Controller {

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
            'id_modulos_sistemas' => 'required|integer',
            'id_menupadre' => 'required|integer',
			'ruta_vista' => 'required',
			'inactivo' => 'required|boolean',
			'fecha' => 'required',
			'codusuario' => 'required|integer',
        ]);
    }

   
	
	
	/**
	  * Vista Insertar Menus
	  *
	  * @return string
	  */
	public function getinsertMenu()
    {
		$token=Session::get('entidadRespuesta.token');
		//SE CONSUME A MODULOS DEL SISTEMA
		$parametros_modulos = "";
		$modulo_webservice='getInfoModuloSistemaWs';
		$modulos=$this->consumirws->consumirPorGet($modulo_webservice,$parametros_modulos,$url='customs.url_baaszoom',$this->rutaSession."/");
		
		//SE CONSUME A Perfiles DEL SISTEMA
		$parametros_perfil = "";
		$perfil_webservice='getInfoPerfilWs';
		$perfiles=$this->consumirws->consumirPorGet($perfil_webservice,$parametros_perfil,$url='customs.url_baaszoom',$this->rutaSession."/");
		return view('Wsgeneric/Perfiles/menu',compact('token','modulos','perfiles'));
    }
	
	/**
	  * Post Insertar Menus
	  *
	  * @return json
	  */
	public function postinsertMenu(Request $request){
		$parametros = array(
			'nombre'=>$request->get('nombre'),
			'inactivo[]'=>$request->get('inactivo'),
			'id_modulos_sistemas[]'=>$request->get('id_modulos_sistemas')
		);
		$webservice='getInfoMenuWs';
		$consultaModulo=$this->consumirws->consumirPorGet($webservice,$parametros,$url='customs.url_baaszoom',$this->rutaSession."/");
		//dd($consultaModulo);
		if($consultaModulo['codrespuesta'] != 'COD_000'){
			//se crea un arreglo con los parametros a ingresar 
			$parametrosInsertar = array(
				'id_modulos_sistemas'=>$request->get('id_modulos_sistemas'),
				'id_menupadre'=>$request->get('id_menupadre'),
				'nombre'=>$request->get('nombre'),
				'ruta_vista'=>$request->get('ruta_vista'),
				'fecha'=>$request->get('fecha'),
				'codusuario'=>$request->get('codusuario'),
				'inactivo'=>$request->get('inactivo'),
				'id_perfil'=>$request->get('id_perfil')
			);
			//dump($parametrosInsertar);
			$webservice='addMenuWs';
			$response=$this->consumirws->consumirPorPost($webservice,$parametrosInsertar,$url='customs.url_baaszoom',$this->rutaSession."/");
			return redirect($this->rutaSession.'/'.'listMenuWs')->with('alert-success', $response['codrespuesta'].' - '.$response['mensaje']);
			//return view('Wsgeneric/Perfiles/menuList',compact('response'))->with('alert-success', 'EL REGISTRO HA SIDO INGRESADO EXITOSAMENTE');
		}else{
			return Redirect::back()
					->with('alert-danger', 'ESTE REGISTRO YA SE ENCUENTRA REGISTRADO. VERIFIQUE NOMBRE DEL MENU');
			//return redirect($this->rutaSession.'/'.'getinsertMenu')->with('alert-danger', 'ESTE REGISTRO YA SE ENCUENTRA REGISTRADO. VERIFIQUE NOMBRE DEL MENU');
		}
	}
	
	/*****************************
		* Listado de Menus
	*****************************/
	public function listMenuWs(){
		
		$parametros = "";
		$webservice='getInfoMenuWs';
		$response=$this->consumirws->consumirPorGet($webservice,$parametros,$url='customs.url_baaszoom',$this->rutaSession."/");
		
		return view('Wsgeneric/Perfiles/menuList',compact('response'))->with('alert-success', 'EL REGISTRO HA SIDO INGRESADO EXITOSAMENTE');
	}
	
	/*****************************
		* Eliminar de Menus
	*****************************/
	public function eliminarMenu(Request $request){
		$parametros = array(
			'id_menu'=>$request->get('id_menu')
		);
		$webservice='eliminarMenuWs';
		$response=$this->consumirws->consumirPorPost($webservice,$parametros,$url='customs.url_baaszoom',$this->rutaSession."/");
		
		if(!empty($response)){
			return redirect($this->rutaSession.'/'.'listMenuWs')->with('alert-success', $response['codrespuesta'].' - '.$response['mensaje']);
		}else{
			return redirect($this->rutaSession.'/'.'listMenuWs')->with('alert-danger', 'NO EXISTEN REGISTROS A ELIMINAR. VERIFIQUE');
		}
	}
	
	
}
