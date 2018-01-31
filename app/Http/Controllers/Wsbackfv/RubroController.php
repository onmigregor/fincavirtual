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
use App\Wsfincavirtual\Dal\RubroDAL;

use Validator;

class RubroController extends Controller
{
    private $GenericDAL;
    private $EntityResponse;
    private $RubroDAL;
    private $DB;

    public function __construct()
    {
        $this->GenericDAL = new GenericDAL();
        $this->EntityResponse = new EntityResponse();
        $this->RubroDAL = new RubroDAL();
        $this->DB = "bd_fincavirtual";
    }

    private function setMensaje($codigoMsg)
    {
        $Msg = $this->GenericDAL->getMessage($codigoMsg, $this->DB);
        $this->EntityResponse = $Msg[0];
    }

    public function getRubro(Request $request)
    {
        $params = $request->only('cod_tipo_rubro');

        $reglas = Validator::make($request->all(),
            [
                'cod_tipo_rubro' => 'integer'
            ]);

        if ($reglas->fails()) {
            // CODE_002: LOS PARAMETROS INGRESADOS NO SON CORRECTOS (y muestra ademas los errores de la validación)
            $this->setMensaje("CODE_002");
            $this->EntityResponse->entidadRespuesta = $reglas->errors();
        } else {
            //dd($params);
            $result = $this->RubroDAL->getRubro($params['cod_tipo_rubro']);

            if (count($result) > 0) {
                $this->setMensaje("COD_000");
                $this->EntityResponse->entidadRespuesta = $result;
            } else {
                $this->setMensaje("COD_002");
                $this->EntityResponse->entidadRespuesta = 'NO HAY RUBROS PARA MOSTRAR';
            }
        }

        return response()->json($this->EntityResponse);
    }


      public function getDescripcionRubro(Request $request)
    {
        $params = $request->only('producto');

        foreach ($params['producto'] as $key => $producto) {
       
            $result = $this->RubroDAL->getDescripcionRubro($producto['cod_producto']);
            $params['producto'][$key]['nombre']=$result['nombre'];
                   
        }

        return response()->json($params);        
        
    }
}