<?php

namespace App;
use Curl;




class ConsumirWS
{

    public function consumirPorGet($webservice,$parametros){

		//$url=config($url);
		$url= config('customs.url_finca');
		$pagina= config('customs.pagina');
		//dump($url.$pagina.$webservice,$parametros);
		$response = Curl::to($url.$pagina.$webservice)
		->withData($parametros)
		//->withOption('FAILONERROR', false)
		//->enableDebug('/var/www/html/cubesum/logFile.txt')
		->asJson(true)
		->withContentType('application/json')
		->get();
		//$ruta="RUTA:".$url.$pagina.$webservice;
//		print_r($ruta);
		//dd($response);
		return $response;
	}

	public function consumirPorPost($webservice,$parametros){
		//$url=config($url);
		//dump()
		$url= config('customs.url_finca');
		$pagina= config('customs.pagina');
		$response = Curl::to($url.$pagina.$webservice)
		->withData($parametros)
		//->withOption('FAILONERROR', false)
		//->enableDebug('/var/www/html/cubesum/logFile.txt')
		->asJson(true)
		->withContentType('application/json')
		->post();
		//$ruta="RUTA:".$url.$pagina.$webservice;
		//return $ruta;
		return $response;
	}

	public function consumirPorPut($webservice,$parametros,$url='http://localhost/desarrollo.fincavirtual/',$pagina='public'){
		//$url=config($url);
		$response = Curl::to($url.'/'.$pagina.'/'.$webservice)
		->withData($parametros)
		//->withOption('FAILONERROR', false)
		//->enableDebug('/var/www/html/cubesum/logFile.txt')
		->asJson(true)
		->withContentType('application/json')
		->put();
		
		return $response;
	}

	public function consumirPorDelete($webservice,$parametros,$url='http://localhost/desarrollo.fincavirtual/',$pagina='public'){
		//$url=config($url);
		$response = Curl::to($url.'/'.$pagina.'/'.$webservice)
		->withData($parametros)
		//->withOption('FAILONERROR', false)
		//->enableDebug('/var/www/html/cubesum/logFile.txt')
		->asJson(true)
		->withContentType('application/json')
		->delete();
		
		return $response;
	}
	
}
