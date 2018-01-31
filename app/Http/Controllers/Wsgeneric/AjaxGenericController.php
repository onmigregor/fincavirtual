<?php
/******************************
	* Creado por Diony Reveron
	* Fecha 12 Agosto 2016
	* Funcion para el uso de los AJAX a traves de cada vista para poder consumir el webservice
******************************/
namespace App\Http\Controllers\Wsgeneric;

use DB;
use Curl;
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

class AjaxGenericController extends Controller {
	
	var $consumirws;
	public function  __construct(){
        $this->consumirws=new ConsumirWS();
    }
	/*
	|--------------------------------------------------------------------------
	| Registrar y consumir a WEBSERVICES por AJAX Controller
	|--------------------------------------------------------------------------
	|
	| Agregar, Actualizar y listados
	|
	*/
	
	public function getConsumirAjax(Request $request){
		$token= $request->get('token');
		$page= $request->get('pagina');
		$method= $request->get('method');
		$webservice= $request->get('webservice');
		$campos= $request->get('campos');
		$valores= $request->get('valores');
		
		/*for($i=0;$i<count($campos);$i++){
			$param=array($campos[$i]=>$valores[$i],);
		}*/
		$param = array_combine($campos, $valores);

		if(!empty($token))
		{
			$pagina=$page;
			$param=array_merge($param,array('token'=>$token));
		}

		$pagina=(!empty($page)) ? $page : '';
		if(!empty($method)){
			$consumir='consumirpor'.$method;
		}
		//return $consumir;
		$response=$this->consumirws->$consumir($webservice,$param,$url='customs.url_baaszoom',$pagina);
		//dump($response);
        return $response;
	}

    /**
     * Función para subir el archivo al servidor, una vez guardado el mismo hace uso de fileInformation() para registrar los datos del archivo.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getConsumirAjaxFile(Request $request)
    {
        $credential = [
            'net_Host' => '10.8.16.9',
            'net_Port' => '22',
            'net_User' => 'gestioncalidad',
            'net_Pass' => base64_decode('MTIzNDU2'),
            'net_IniDir' => '/home/gestioncalidad/pruebasPagoTransf/'
        ];

        $obj = new \Net_SFTP($credential['net_Host'], $credential['net_Port'], 30);

        if (!$obj->login($credential['net_User'], $credential['net_Pass']) ) {
            return response()->json("No se pudo realizar la conexi&oacute;n con el servidor",422);

        } else {

            $file = $request->file('qqfilename');
            $name = str_replace(' ', '-', reemplazarCaracteres($file->getClientOriginalName()));
            $fileSize = $file->getSize();
            $wS = $request->get('ws');

            if ($request->has('number_pago')) {
                $obj->chdir($credential['net_IniDir']);
                $params = [
                    'token' => $request->get('token'),
                    'idpago' => $request->get('number_pago'),
                    'nombre' => 'compro_'.$request->get('type_ret').'_'.$request->get('number_pago').'_'.$request->get('number_doc').'.pdf',
                    'nombre_original' => $name,
                    'ruta' => $credential['net_IniDir'],
                    'tamano' => $fileSize
                ];
                $wS = 'createPagoArchivoWs';
                $name = $params['nombre'];
            }

            $save = $this->fileInformation(2,$wS, $params);
            if (array_has($save,'error_jwt')){
                return response()->json('Token ha expirado', 203);
            }

            if ($save['codrespuesta'] != 'COD_001') {
                return response()->json('Error al registrar el archivo', 422);
            }

            $subio = $obj->put($name, \File::get($file));
            if (!$subio) {
                return response()->json('No se pudo subir el archivo', 422);
            }

        }

        $obj->disconnect();

        return response()->json($subio, 200);
	}

    /**
     * Función para borrar el archivo del servidor, hace uso de fileInformation() para consultar el Ws correspondiente.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getConsumirAjaxFileD(Request $request)
    {
        $credential = [
            'net_Host' => '10.8.16.9',
            'net_Port' => '22',
            'net_User' => 'gestioncalidad',
            'net_Pass' => base64_decode('MTIzNDU2'),
            'net_IniDir' => '/home/gestioncalidad/pruebasPagoTransf/'
        ];

        $obj = new \Net_SFTP($credential['net_Host'], $credential['net_Port'], 30);

        if (!$obj->login($credential['net_User'], $credential['net_Pass']) ) {
            return response()->json("No se pudo realizar la conexi&oacute;n con el servidor",422);
        } else {

            $file = $request->file('qqfilename');
            $name = str_replace(' ', '-', reemplazarCaracteres($file->getClientOriginalName()));
            $wS = $request->get('ws');

            if ($request->has('number_pago')) {
                $params = [
                    'token' => $request->get('token'),
                    'idpago' => [$request->get('number_pago')]
                ];
                $wS = 'getInfoPagoWs';
            }

            $getFile = $this->fileInformation(1,$wS, $params);

            if ($getFile['codrespuesta'] == 'COD_000') {
                foreach ($getFile['entidadRespuesta'][0]['listpagoarchivo'] as $key =>  $value) {
                    if (array_search($name,$value)) {
                        $deleteFile = $obj->delete($value['ruta'].$value['nombre_archivo']);

                        $params['nombre_ori_archivo'] = $name;
                        $params['idpago'] = $request->get('number_pago');

                        $save = $this->fileInformation(2,'deletePagoArchivoWs', $params);

                        if (!$deleteFile) {
                            return response()->json('Error al borrar el archivo del servidor', 422);
                        }

                    }
                }
            }
        }

        $obj->disconnect();

        return response()->json('true', 200);
    }

    /**
     * Función para registrar que el archivo fue guardado en el servidor, igualmente se utiliza para consultar los datos del archivo.
     *
     * IF $operation == 1 consulta los datos del archivo ELSE registra los datos del archivo.
     *
     * @param $operation
     * @param $webService
     * @param array $params
     * @return mixed
     */
    private function fileInformation($operation, $webService, $params = array())
    {
        if ($operation == 1) {
            return $this->consumirws->consumirPorGet($webService, $params, $url='customs.url_baaszoom', '/canguroazul/');
        } else {
            return $this->consumirws->consumirPorPost($webService,$params, $url='customs.url_baaszoom');
        }

    }
}
