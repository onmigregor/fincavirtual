<?php
/************************************************
 *    Creado por Omar Ramirez
 *    Fecha: 21/12/2016
 *    Clase: EstadoController.php
 ************************************************/

namespace App\Http\Controllers\Wsbackfv;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Wsgeneric\Dal\GenericDAL;
use App\Wsgeneric\Model\EntityResponse;
use App\Wsfincavirtual\Dal\RIFDAL;
use App\Http\Controllers\Wsbackfv\EstatusRNCController;
use App\ConsumirWS;
use Curl;
use Validator;

class RIFController extends Controller
{
    private $GenericDAL;
    private $EntityResponse;
    private $RIFDAL;
    private $DB;

    public function __construct()
    {
        $this->GenericDAL = new GenericDAL();
        $this->EntityResponse = new EntityResponse();
       // $this->RIFDAL = new RIFDAL();
        $this->DB = "bd_fincavirtual";
        $this->EstatusRNCController=new EstatusRNCController;
        $this->consumirws = new ConsumirWS();
    }

    private function setMensaje($codigoMsg)
    {
        $Msg = $this->GenericDAL->getMessage($codigoMsg, $this->DB);
        $this->EntityResponse = $Msg[0];
    }

    public function getRIF(Request $request)
    {
        $params = $request->only('rif');

        $reglas = Validator::make($request->all(),
            [
                'rif' => 'string|required|min:10|max:10'
            ]);

        if ($reglas->fails()) 
        {
            // CODE_002: LOS PARAMETROS INGRESADOS NO SON CORRECTOS (y muestra ademas los errores de la validación)
            $this->setMensaje("CODE_002");
            $this->EntityResponse->entidadRespuesta = $reglas->errors();
        } else 
        {
            $parametros=$arrayName = array('rif' =>$params['rif']);
            //CONSULTAMOS LA PAGINA DEL SENIAT
            $response = Curl::to("http://contribuyente.seniat.gob.ve/getContribuyente/getrif")
            ->withData($parametros)
            ->returnResponseObject()
            ->get();
            //EN CASO DE NO HABER CONEXION MENSJAE DE ERROR
           if ($response->status==0)
            {
                $this->setMensaje("CODE_003");
                $this->EntityResponse->entidadRespuesta = isset($response->error)   ? $response->error: "ERROR DESCONOCIDO";
            }
            elseif (isset($response->content)&&isset($response->status))//ESTATUS 200 HUBO CONEXION
            {
                if($response->status==200)
                {
                    try
                    {
                        if(substr($response->content,0,1)!='<')
                        throw new Exception($response->content);
                        $xml = simplexml_load_string($response->content);
                        if(!is_bool($xml))  
                        {
                            $elements=$xml->children('rif');
                            $seniat=array();
                            foreach($elements as $indice => $node)
                            {
                                $index=strtolower($node->getName());
                                $seniat[$index]=(string)$node;
                            }
                        $response_json['seniat']=$seniat;
                       }
                    }
                    catch(Exception $e)
                    {
                       $result=explode(' ', $response->content, 2);
                       $response_json['code_result']=(int) $result[0];
                   }
                    
                    $nombrefiscal= explode( ' (', $response_json['seniat']['nombre']);
                    $response_json['seniat']['nombre']=$nombrefiscal[0].".";

                    $response->content=$response_json;
                    //dd($response_json);
                    $this->setMensaje("COD_000");
                    $this->EntityResponse->entidadRespuesta['consultaRIF']=$response;

                    $this->rnc=$this->consultarnc($params['rif']);//FUNCION PARA CONSULTAR ESTATUS DE LA EMPRESA EN EL  RNC
                    $this->EntityResponse->entidadRespuesta['consultaRNC']=$this->rnc;
                }
                if($response->status==452)//452 CLIENTE NO REGISTRA
                {
                    $this->setMensaje("COD_000");
                    $this->EntityResponse->entidadRespuesta['consultaRIF']['status']=$response->status;
                    $this->EntityResponse->entidadRespuesta['consultaRIF']['content']="El Contribuyente no está registrado";
                }

            }
        
    }
        return response()->json($this->EntityResponse);
    }

    public function consultarnc($rif)
    {
        $response2 = Curl::to("http://rncenlinea.snc.gob.ve/reportes/datos_basicos?mostrar=INF&p=3&rif=".$rif."")
            ->returnResponseObject()
            ->get();

        if ($response2->status==0)// ESTATUS DE NO CONEXION
        {
            $this->consultaRNC['status']=$response2->status;
            $this->consultaRNC['error']= isset($response2->error)   ? $response2->error: "ERROR DESCONOCIDO";
        } 
        elseif ($response2->status==200) 
        {      
            //VERIFICAMOS SI LA EMPRESA NO ESTA REGISTRADA
            $this->arrayrazonsocial = explode( '<p align="center" style="color: red"><b>El N&uacute;mero de RIF indicado no esta registrado en el sistema</b>', $response2->content);
            if(count($this->arrayrazonsocial)>1)//ARRAY  DEL CONTENIDO DONDE SI ES MAYOR A 1 ES LA PIGNA DE NO REGISTRO
            {
                $this->estatusrcn[0]="NO ESTA REGISTRADA EN EL SISTEMA";
                $this->consultaRNC=$this->getRCN($this->estatusrcn[0]);//CONSULTAMOS A LA BASE DE DATOS 
            }
            else
            {   
                //DEPURAMOS EL ESTATUS PARA COMPARAR 
                $this->arrayrazonsocial = explode( '<td width="40%" class="textoP_3">', $response2->content);
                $this->razonsocial=explode( '</td>', $this->arrayrazonsocial[2]);
                //dump($this->razonsocial);
                $this->arrayestatus = explode( 'class="textoP_3"><b> ', $response2->content);
                //dump($this->arrayestatus);
                $this->estatusrcn=explode( '</b>', $this->arrayestatus[1]);
                $this->estatusrcn[0]=rtrim ($this->estatusrcn[0]);
                //dd($this->estatusrcn[0]);
                $this->consultaRNC=$this->getRCN($this->estatusrcn[0]);//CONSULTAMOS A LA BASE DE DATOS  
            }   
        } 
            $this->consultaRNC['status']=$response2->status;
            return $this->consultaRNC;
    }

    public function getRCN($nomestatusRNC)
    {
        $estadows = 'getEstaRNC';
        $parametros_estados = array('nomestatusRNC' => $nomestatusRNC,);
        $result2= $this->consumirws->consumirPorGet($estadows, $parametros_estados);

        if(!empty($result2) && isset($result2) && count($result2) != 0)
        {    //SI EXISTE EL ESTATUS EN LA BASE DE DATTOS
            if($result2['codrespuesta']=="COD_000")
            {
                //$this->consultaRNC['content']['codRCN']=$result2['entidadRespuesta'][0]['codestatusRCN'];
                //$this->consultaRNC['content']['estatusRNC']=$result2['entidadRespuesta'][0]['nombre'];
                //$this->consultaRNC['content']['razonsocial']=rtrim($this->razonsocial[0]).".";
                if (isset($this->razonsocial[0]))
                {
                    $result2['entidadRespuesta']['0']['razonsocial']=rtrim($this->razonsocial[0]).".";
                }
                else
                {
                    $result2['entidadRespuesta']['0']['razonsocial']=null;
                }
                $this->consultaRNC=$result2;
            }
            else// SI NO EXISTE ESE ESTATUS EN LA BASE DE DATOS//
            {
                $result2['mensaje']=$result2['mensaje']." PARA ESTATUS RCN=".$this->estatusrcn[0];
                $this->consultaRNC=$result2;
            }
        }
        return $this->consultaRNC;
    }
}
