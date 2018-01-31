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
use App\Wsfincavirtual\Dal\Repre_LegalDAL;
use App\Wsfincavirtual\Dal\EmpresaDAL;
////////////////// añadir1
use Validator;

class EmpresaController extends Controller
{
    private $GenericDAL;
    private $EntityResponse;
    private $Repre_LegalDAL;
    private $EmpresaDAL;
    private $DB;
///////////////////////////////// añadir 2
    public function __construct()
    {
        $this->GenericDAL = new GenericDAL();
        $this->EntityResponse = new EntityResponse();
        $this->Repre_LegalDAL = new Repre_LegalDAL();
        $this->EmpresaDAL     = new EmpresaDAL();
        $this->DB = "bd_fincavirtual";
    }
////////////////////////////////////añadir 3
    private function setMensaje($codigoMsg)
    {
        $Msg = $this->GenericDAL->getMessage($codigoMsg, $this->DB);
        $this->EntityResponse = $Msg[0];
    }

    public function RegEmpresa(Request $request)
    {

       
        $params = $request->all();


                $reglas = Validator::make($request->all(),
                    [
                        'cedula_repre' => 'required|unique:repre_legal,cedula',
                        'rif'          => 'required|unique:empresa,cod_rif',
                    ]);

        if ($reglas->fails()) 
        {
            // CODE_002: LOS PARAMETROS INGRESADOS NO SON CORRECTOS (y muestra ademas los errores de la validación)
            $this->setMensaje("CODE_002");
            $this->EntityResponse->entidadRespuesta = $reglas->errors();
        } 
        else 
        {
            $datos_repre   = array  (
                                        'cedula'            => $params['cedula_repre'], 
                                        'nombre'            => $params['nombre_repre'],
                                        'apellido'          => $params['apellido_repre'],
                                        'cod_tipcargo'      => $params['cargo_repre'],
                                        'tlfcelular'        => $params['tlf_repre'],
                                        'correo_repre'      => $params['correo_repre'],
                                    );

            $cod_repre = $this->Repre_LegalDAL->RegRepreLegal($datos_repre);

            if ($cod_repre!=$datos_repre['cedula']) 
            {
                
            }
            else
            {     
                $datos_empresa = array  (
                                            'cod_rif'           => $params['rif'],
                                            'rnc'               => $params['estatusRNC'],
                                            'nombre'            => $params['razonsocial'],
                                            'cod_repre_legal'   => $cod_repre,
                                            'correo'            => $params['correo_empresa'],
                                            'telefono'          => $params['tlf_empresa'],
                                            'telefono2'         => $params['tle2_empresa'],
                                            //'cod_region'        => $params[''],
                                            'codestado'        => $params['codestado'], 
                                            'codmunicipio'     => $params['codmunicipio'],
                                            'codparroquia'     => $params['codparroquia'],
                                            'codparroquia'     => $params['codparroquia'],
                                            'codciudad'        => $params['codciudad'],
                                            'dirrecion'         => $params['dirrecion'],
                                            //'fecha_ing'        => $params[''],
                                            'visto'             => FALSE,
                                        );
                //dd($datos_empresa);
                $cod_empresa = $this->EmpresaDAL->RegEmpresa($datos_empresa);

                if ($cod_empresa!=$datos_empresa['cod_rif']) 
                {
                   
                }
                else
                {
                    $this->setMensaje("COD_001");
                }

            }

        }
        return response()->json($this->EntityResponse);
    }

    public function getEmpresas(Request $request)
    {       
        $params = $request->only('rif');
                $reglas = Validator::make($request->all(),
                    [
                        'rif'          => 'string'
                    ]);

        if ($reglas->fails()) 
        {
            // CODE_002: LOS PARAMETROS INGRESADOS NO SON CORRECTOS (y muestra ademas los errores de la validación)
            $this->setMensaje("CODE_002");
            $this->EntityResponse->entidadRespuesta = $reglas->errors();
        } 
        else 
        {

            $result = $this->EmpresaDAL->getempresas($params['rif']);

            
            if (count($result) > 0) 
            {
                if (!empty($params['rif'])&&$result[0]->visto==0) 
                {
                    $this->EmpresaDAL->cambiarvisto($params['rif']);
                }
                $this->setMensaje("COD_000");
                $this->EntityResponse->entidadRespuesta = $result;
            } 
            else 
            {
                $this->setMensaje("COD_000");
                $this->EntityResponse->entidadRespuesta = 'NO HAY EMPRESAS PARA MOSTRAR';
            }


        }
        return response()->json($this->EntityResponse);
    }
}