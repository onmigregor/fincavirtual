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
use App\Wsfincavirtual\Dal\ParroquiaDAL;

use Validator;

class ParroquiaController extends Controller
{
    private $GenericDAL;
    private $EntityResponse;
    private $ParroquiaDAL;
    private $DB;

    public function __construct()
    {
        $this->GenericDAL = new GenericDAL();
        $this->EntityResponse = new EntityResponse();
        $this->ParroquiaDAL = new ParroquiaDAL();
        $this->DB = "bd_fincavirtual";
    }

    private function setMensaje($codigoMsg)
    {
        $Msg = $this->GenericDAL->getMessage($codigoMsg, $this->DB);
        $this->EntityResponse = $Msg[0];
    }

    public function getParroquia(Request $request)
    {
        $params = $request->only('codmunicipio');

        $reglas = Validator::make($request->all(),
            [
                'codmunicipio' => 'integer|required|min:01|max:462'
            ]);

        if ($reglas->fails()) {
            // CODE_002: LOS PARAMETROS INGRESADOS NO SON CORRECTOS (y muestra ademas los errores de la validación)
            $this->setMensaje("CODE_002");
            $this->EntityResponse->entidadRespuesta = $reglas->errors();
        } else {

            $result = $this->ParroquiaDAL->getParroquia($params['codmunicipio']);

            if (count($result) > 0) {
                $this->setMensaje("COD_000");
                $this->EntityResponse->entidadRespuesta = $result;
            } else {
                $this->EntityResponse->entidadRespuesta = 'NO HAY PARROQUIAS PARA MOSTRAR';
            }
        }

        return response()->json($this->EntityResponse);
    }
}