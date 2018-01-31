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
use App\Wsfincavirtual\Dal\UsuarioDAL;
use App\Wsfincavirtual\Dal\UnidadDAL;

use Validator;

class UsuarioController extends Controller
{
    private $GenericDAL;
    private $EntityResponse;
    private $UnidadDAL;
    private $DB;

    public function __construct()
    {
        $this->GenericDAL = new GenericDAL();
        $this->EntityResponse = new EntityResponse();
        $this->UsuarioDAL = new UsuarioDAL();
        $this->UnidadDAL = new UnidadDAL();

        $this->DB = "bd_fincavirtual";
    }

    private function setMensaje($codigoMsg)
    {
        $Msg = $this->GenericDAL->getMessage($codigoMsg, $this->DB);
        $this->EntityResponse = $Msg[0];
    }

    public function guardar_usuario(Request $request)
    {
        $params = $request->all();
        //dd($params);
        $reglas = Validator::make($request->all(),
            [
                'tipo_unidad'         => 'required|array',
                'usuario'             => 'required|alpha|unique:usuario,nombre',
                'correo'              => 'required|email|unique:usuario,email',
                'contrasena'          => 'required',
                'confirmar_contra'    => 'required',
                'rif'                 => 'required|unique:unidad,rif',
                'codestado'           => 'required|integer|min:01',
                'codmunicipio'        => 'required|integer|min:01',
                'codparroquia'        => 'required|integer|min:01',
                'codciudad'           => 'required|integer|min:01',
                'avenida'             => 'required',
                'casa'                => 'required',
                'sector'              => 'required',
                'tipo_registro'       => 'required',

               
            ]);

        if ($reglas->fails()) {
            // CODE_002: LOS PARAMETROS INGRESADOS NO SON CORRECTOS (y muestra ademas los errores de la validación)
            $this->setMensaje("CODE_002");
            $this->EntityResponse->entidadRespuesta = $reglas->errors();
        } else 
        {

            $datos = array(
                                'nombre'        => $params['usuario'], 
                                'email'         => $params ['correo'], 
                                'password'      => $params['contrasena'], 
                            );
            

            $result=$this->UsuarioDAL->guardar_usuario($datos);

            if ($result) 
            {
                if($params['tipo_registro'])
                {
                    $datos_unidad = array  (
                                            'codusuario'     =>  $result,
                                            'tipo_unidad'   =>  $params['tipo_unidad'][0], 
                                            'rif'           =>  $params['rif'] , 
                                            'codestado'     =>  $params['codestado'] , 
                                            'codmunicipio'  =>  $params['codmunicipio'] , 
                                            'codparroquia'  =>  $params['codparroquia'] , 
                                            'codciudad'     =>  $params['codciudad'] , 
                                            'avenida'       =>  $params['avenida'] , 
                                            'casa'          =>  $params['casa'] , 
                                            'sector'        =>  $params['sector'] , 
                                            );
                    $result=$this->UnidadDAL->guardar_unidad($datos_unidad);
                }

                    if ($result) 
                    {
                        $this->setMensaje("COD_001");
                        $this->EntityResponse->entidadRespuesta = "LA UNIDAD HA SIDO REGISTRADA EN EL SISTEMA, PUEDE INGRESAR ESCRIBIENDO SU CORREO DE REGISTRO Y CONTRASEÑA";
                    }

            }
        }

        return response()->json($this->EntityResponse);
    }
}