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
use App\Wsfincavirtual\Dal\MunicipioDAL;

use Validator;

class MunicipioController extends Controller
{
    private $GenericDAL;
    private $EntityResponse;
    private $MunicipioDAL;
    private $DB;

    public function __construct()
    {
        $this->GenericDAL = new GenericDAL();
        $this->EntityResponse = new EntityResponse();
        $this->MunicipioDAL = new MunicipioDAL();
        $this->DB = "bd_fincavirtual";
    }

    private function setMensaje($codigoMsg)
    {
        $Msg = $this->GenericDAL->getMessage($codigoMsg, $this->DB);
        $this->EntityResponse = $Msg[0];
    }

    public function getMunicipio(Request $request)
    {
        $params = $request->only('codestado');

        $reglas = Validator::make($request->all(),
            [
                'codestado' => 'integer|required|min:01|max:24'
            ]);

        if ($reglas->fails()) {
            // CODE_002: LOS PARAMETROS INGRESADOS NO SON CORRECTOS (y muestra ademas los errores de la validación)
            $this->setMensaje("CODE_002");
            $this->EntityResponse->entidadRespuesta = $reglas->errors();
        } else {

            $result = $this->MunicipioDAL->getMunicipio($params['codestado']);

            if (count($result) > 0) {
                $this->setMensaje("COD_000");
                $this->EntityResponse->entidadRespuesta = $result;
            } else {
                $this->EntityResponse->entidadRespuesta = 'NO HAY MUNICIPIOS PARA MOSTRAR';
            }
        }

        return response()->json($this->EntityResponse);
    }
}