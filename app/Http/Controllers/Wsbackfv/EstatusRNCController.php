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
use App\Wsfincavirtual\Dal\EstatusRNCDAL;

use Validator;

class EstatusRNCController extends Controller
{
    private $GenericDAL;
    private $EntityResponse;
    //private $EstatusRNCDAL;
    private $DB;

    public function __construct()
    {
        $this->GenericDAL = new GenericDAL();
        $this->EntityResponse = new EntityResponse();
        $this->EstatusRNCDAL = new EstatusRNCDAL();
        $this->DB = "bd_fincavirtual";
    }

    private function setMensaje($codigoMsg)
    {
        $Msg = $this->GenericDAL->getMessage($codigoMsg, $this->DB);
        $this->EntityResponse = $Msg[0];
    }

    public function getEstaRNC(request $request)
    {
        $params = $request->only('nomestatusRNC');

        $reglas = Validator::make($request->all(),
            [
                'nomestatusRNC' => 'string|required'
            ]);
        if ($reglas->fails()) {
            // CODE_002: LOS PARAMETROS INGRESADOS NO SON CORRECTOS (y muestra ademas los errores de la validación)
            $this->setMensaje("CODE_002");
            $this->EntityResponse->entidadRespuesta = $reglas->errors();
        } 
        else 
        {
            $result = $this->EstatusRNCDAL->getEstaRNC($params['nomestatusRNC']);
            if(!empty($result) && isset($result) && count($result) != 0)
            {
                $this->setMensaje("COD_000");
                $this->EntityResponse->entidadRespuesta = $result;
            }
            else
            {
                $dbResultMess=$this->GenericDAL->getMessage("CODE_000","bd_fincavirtual");
                $this->EntityResponse = $dbResultMess[0];
            }
        }

        return response()->json($this->EntityResponse);
    }
}