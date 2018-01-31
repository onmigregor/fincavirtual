<?php namespace App\Http\Controllers\Wsgeneric\Usuario;


use DB;
use Curl;
use Excel;
use View;
use Input;
use Session;
use File;
use Response;
use Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\ConsumirWS;

class UsuarioperfilController extends Controller {

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
            'id_perfil' => 'required|integer',
            'id_modulos_sistemas' => 'required|integer',
            'relacion_codusuario' => 'required|integer',
			'fecha' => 'required',
			'codusuario' => 'required|integer',
        ]);
    }

   
	
	
	/**
	  * Vista Insertar Menu Perfil
	  *
	  * @return string
	  */
	public function addUsuarioPerfil()
    { 
		$token=Session::get('entidadRespuesta.token');
		$parametros_perfil = "";
		$perfil_webservice='getInfoPerfilWs';
		$perfil=$this->consumirws->consumirPorGet($perfil_webservice,$parametros_perfil,$url='customs.url_baaszoom',$this->rutaSession."/");
		
		$parametros_modulos = "";
		$modulo_webservice='getInfoModuloSistemaWs';
		$modulos=$this->consumirws->consumirPorGet($modulo_webservice,$parametros_modulos,$url='customs.url_baaszoom',$this->rutaSession."/");
		return view('Wsgeneric/Perfiles/usuarioPerfil',compact('perfil','token','modulos'));
    }
	
	/**
	  * Vista Insertar Menu Perfil
	  *
	  * @return string
	  */
	public function postAddUsuarioPerfil(Request $request)
    { 
		//dump($request);
		//dd($request->get('id_menu'));
		//SE CONSULTA PARA VALIDAR QUE EL PERFIL NO ESTE REGISTRADO PARA DICHO USUARIO
		$parametrosConsultar = array(
			'id_perfil[]'=>$request->get('id_perfil'),
			'relacion_codusuario[]'=>$request->get('relacion_codusuario'),
			'id_modulos_sistemas[]'=>$request->get('id_modulos_sistemas'),
			'id_menu[]'=>$request->get('id_menu')
		);
		$webserviceConsultar='getInfoUsuarioperfilWs';
		$consulta=$this->consumirws->consumirPorGet($webserviceConsultar,$parametrosConsultar,$url='customs.url_baaszoom',$this->rutaSession."/");
		//dump($consulta);
		if((!empty($consulta)) and $consulta['codrespuesta']!='COD_000'){
			//SE REGISTRA EN USUARIOPERFIL A EL USUARIO EN PROCESO
			$parametros = array(
				'id_perfil'=>$request->get('id_perfil'),
				'relacion_codusuario'=>$request->get('relacion_codusuario'),
				'fecha'=>date('Y-m-d H:i:s'),
				'codusuario'=>$request->get('codusuario'),
				'id_modulos_sistemas'=>$request->get('id_modulos_sistemas'),
				'id_menu'=>$request->get('id_menu')
			);
			$webservice='addUsuarioPerfilWs';
			$response=$this->consumirws->consumirPorPost($webservice,$parametros,$url='customs.url_baaszoom',$this->rutaSession."/");
			//dd($response);
			if(!empty($response))
			{
				//return redirect($this->rutaSession.'/'.'addUsuarioPerfil')->with('alert-success', 'PERFIL DE USUARIO REGISTRADO CON &Eacute;XITO');
				$parametros = ['relacion_codusuario[]'=>$request->get('relacion_codusuario')];
				$webservice='getInfoUsuarioperfilWs';
				$data=$this->consumirws->consumirPorGet($webservice,$parametros,$url='customs.url_baaszoom',$this->rutaSession."/");
				return view('Wsgeneric/Perfiles/listUsuarioPerfil',compact('data'));
			}
			else
			{
				return redirect($this->rutaSession.'/'.'addUsuarioPerfil')->with('alert-danger', 'ERROR. EL USUARIO NO PUDO GUARDARSE. POR FAVOR INTENTELO MAS TARDE');
			}

		}
		else
		{
			return redirect($this->rutaSession.'/'.'addUsuarioPerfil')->with('alert-danger', 'ESTE USUARIO YA TIENE ASIGNADO ESTE PERFIL PARA EL MODULO Y/O MENU SELECCIONADO');
		}
    }
	/*
	public function eliminarUsuarioperfil(Request $request){
		dd($request);
		//SE REGISTRA EN USUARIOPERFIL A EL USUARIO EN PROCESO
		$parametros = array(
			'id_usuarioperfil'=>$id
		);
		$webservice='eliminarUsuarioPerfilWs';
		$response=$this->consumirws->consumirPorPost($webservice,$parametros,$url='customs.url_baaszoom',$this->rutaSession."/");
		dump($response);
	}
	*/
}
