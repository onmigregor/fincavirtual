<?php
/************************************************
 *    Creado por Omar Ramirez
 *    Fecha: 21/12/2016
 *    Clase: TipoEstatusController.php
 ************************************************/

namespace App\Http\Controllers\Wsbackfv;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Wsgeneric\Dal\GenericDAL;
use App\Wsgeneric\Model\EntityResponse;
use App\Wsfincavirtual\Dal\TipoEstatusDAL;

use Validator;

class TipoEstatusController extends Controller
{
    private $GenericDAL;
    private $EntityResponse;
    private $TipoEstatusDAL;
    private $DB;

    public function __construct()
    {
        $this->GenericDAL = new GenericDAL();
        $this->EntityResponse = new EntityResponse();
        $this->TipoEstatusDAL = new TipoEstatusDAL();
        $this->DB = "bd_fincavirtual";
    }

    private function setMensaje($codigoMsg)
    {
        $Msg = $this->GenericDAL->getMessage($codigoMsg, $this->DB);
        $this->EntityResponse = $Msg[0];
    }

    public function getTipoEstatus(Request $request)
    {

        
        $params = $request->all('rol');


        $reglas = Validator::make($request->all(),
            [
                'cod_TipoEstatus' => 'string'
            ]);

        if ($reglas->fails()) {
            // CODE_002: LOS PARAMETROS INGRESADOS NO SON CORRECTOS (y muestra ademas los errores de la validación)
            $this->setMensaje("CODE_002");
            $this->EntityResponse->entidadRespuesta = $reglas->errors();
        } else {

            $result = $this->TipoEstatusDAL->getTipoEstatus($params['rol']);

            if (count($result) > 0) {
                $this->setMensaje("COD_000");
                $this->EntityResponse->entidadRespuesta = $result;
            } else {
                $this->EntityResponse->entidadRespuesta = 'NO HAY TIPO ESTATUS PARA MOSTRAR';
            }
        }

        return response()->json($this->EntityResponse);
    }
}