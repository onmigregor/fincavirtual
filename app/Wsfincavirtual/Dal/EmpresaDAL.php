<?php
/************************************************/
/*	Creado por Fabiola Rodriguez
/*	Fecha: 21/12/2016
/*  Clase: EstadoDAL.php
/************************************************/

namespace App\Wsfincavirtual\Dal;


use Illuminate\Support\Facades\DB;
use App\Wsfincavirtual\Model\Empresa;
use App\Wsfincavirtual\Model\Municipio;
use App\Wsfincavirtual\Model\Cargo;

class EmpresaDAL
{
    public function RegEmpresa($empresa)
    {

        $pgSQL = new Empresa;
        $pgSQL->cod_rif          = $empresa['cod_rif'];
        $pgSQL->rnc              = $empresa['rnc'];
        $pgSQL->nombre           = $empresa['nombre'];
        $pgSQL->codcedula        = $empresa['cod_repre_legal'];
        $pgSQL->correo           = $empresa['correo'];
        $pgSQL->telefono         = $empresa['telefono'];
        $pgSQL->telefono2        = $empresa['telefono2'];
        //$pgSQL->codregion      = $empresa['correo_repre'];
        $pgSQL->codestado        = $empresa['codestado'];
        $pgSQL->codmunicipio     = $empresa['codmunicipio'];
        $pgSQL->codparroquia     = $empresa['codparroquia'];
        $pgSQL->codciudad        = $empresa['codciudad'];
        $pgSQL->dirrecion        = $empresa['dirrecion'];
        //$pgSQL->fecha_ing        = $empresa['fecha_ing'];
        $pgSQL->visto            = FALSE;
        $pgSQL->save();
              
        return $pgSQL['attributes']['cod_rif'];

       //return $respuesta;
    }

     public function cambiarvisto($rif)
    {
      $pgSQL =Empresa::find($rif);
      $pgSQL->visto = TRUE;
      $pgSQL->save();

    }

    public function getempresas($rif=null)
    { 

          if ($rif==null) 
          {
              $respuesta = DB::table('empresa')
                          ->select    ('empresa.cod_rif','empresa.nombre as razon_social','empresa.rnc','empresa.correo','empresa.telefono','estado.nombre as estado','municipio.nombre as municipio','parroquia.nombre as parroquia','ciudad.nombre as ciudad','empresa.dirrecion','repre_legal.nombre as nombrerepre','repre_legal.apellido','empresa.visto')
                          ->join('estado', 'empresa.codestado', '=', 'estado.codestado')
                          ->join('municipio', 'empresa.codmunicipio', '=', 'municipio.codmunicipio')
                          ->join('parroquia', 'empresa.codparroquia', '=', 'parroquia.codparroquia')
                          ->join('ciudad', 'empresa.codciudad', '=', 'ciudad.codciudad')
                          ->join('repre_legal', 'empresa.codcedula', '=', 'repre_legal.cedula')
                          ->get();
                 // dd($respuesta);
          }
          else
          {
            $respuesta = Empresa::where       ('empresa.cod_rif','=',$rif)
                                ->select    ('empresa.cod_rif','empresa.nombre as razon_social','empresa.rnc','empresa.correo','empresa.telefono','estado.nombre as estado','municipio.nombre as municipio','parroquia.nombre as parroquia','ciudad.nombre as ciudad','empresa.dirrecion','empresa.visto','empresa.codcedula')
                                ->join('estado', 'empresa.codestado', '=', 'estado.codestado')
                                ->join('municipio', 'empresa.codmunicipio', '=', 'municipio.codmunicipio')
                                ->join('parroquia', 'empresa.codparroquia', '=', 'parroquia.codparroquia')
                                ->join('ciudad', 'empresa.codciudad', '=', 'ciudad.codciudad')
                                ->with('repre_legal')
                                ->get();
          }
      
              
                              //  dd($respuesta);
          return $respuesta;
    }
}