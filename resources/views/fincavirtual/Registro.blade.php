  <style>
        .with-nav-tabs.panel-primary .nav-tabs > li > a,
        .with-nav-tabs.panel-primary .nav-tabs > li > a:hover,
        .with-nav-tabs.panel-primary .nav-tabs > li > a:focus {
            color: #fff;
        }
        .with-nav-tabs.panel-primary .nav-tabs > .open > a,
        .with-nav-tabs.panel-primary .nav-tabs > .open > a:hover,
        .with-nav-tabs.panel-primary .nav-tabs > .open > a:focus,
        .with-nav-tabs.panel-primary .nav-tabs > li > a:hover,
        .with-nav-tabs.panel-primary .nav-tabs > li > a:focus {
            color: #fff;
            background-color: #3071a9;
            border-color: transparent;
        }
        .with-nav-tabs.panel-primary .nav-tabs > li.active > a,
        .with-nav-tabs.panel-primary .nav-tabs > li.active > a:hover,
        .with-nav-tabs.panel-primary .nav-tabs > li.active > a:focus {
            color: #428bca;
            background-color: #fff;
            border-color: #428bca;
            border-bottom-color: transparent;
        }
    </style>

    


@extends('layouts/master')
@section('content')

<?php
$contestado=count($respuesta['estados']['entidadRespuesta']);
$contcargos=count($respuesta['cargos']['entidadRespuesta']);
?>
                <form role="form" action="{{ url('RegEmpresa') }}" id="RegistroForm" name="RegistroForm" method="POST">
               <!--  {{ csrf_field() }} -->
<div class="col-xs-12 col-sm-12" style="min-width: 300px; margin-top: -50px;">
  <div class="panel panel-primary" style="width:100%; text-align: center; margin-top: 55px;">
    <div class="panel-heading"><strong><h3 class="panel-title" style="text-transform: uppercase;"><span class="glyphicon glyphicon-lock"></span> Registro Nuevo Usuario</h3></strong></div>
    <span  class="glyphicon glyphicon-info-sign color" style="margin-top: 15px;"></span> <b>Nota:</b> Al posicionar el mouse sobre los iconos del formulario, podra ver una breve descripci&oacute;n del campo
  </div>

  <div class="col-xs-12 col-sm-12" >
    <div class="panel with-nav-tabs panel-primary">
      <div class="panel-heading">
        <ul class="nav nav-tabs">
        <li style="pointer-events: none;" id="tab-1" class="active"><a href="#tab1primary" data-toggle="tab">Verificar R.I.F.</a></li>
        <li style="pointer-events: none;" id="tab-2"><a data-toggle="tab">Datos de la Empresa</a></li>
        <li style="pointer-events: none;" id="tab-3"><a data-toggle="tab">Datos Representante Legal</a></li>
        <li style="pointer-events: none;" id="tab-4"><a data-toggle="tab">Rubros Empresa</a></li>
        </ul>
      </div>
      <div class="tab-content">
        <div class="tab-pane fade in active" id="tab1primary">
          <div class="panel panel-info" style="width:100%; text-align: left; margin-top: 15px;">
            <div class="panel-heading"><strong><h3 class="panel-title" style="text-transform: uppercase;"><span class="glyphicon glyphicon-lock"></span> Verificar RIF</h3></strong>
            </div>
            <div class="panel-body">
              <div class="row">
                   <div class="col-xs-10 col-sm-3">
                    <p align="left" style="padding-top: 15px;"><strong>R.I.F.</strong></p>
                    <div id="divrif" style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-4 form-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-lock" data-toggle="tooltip" data-placement="left" title='Inserte R.I.F. solo letras "J" o "G" seguido de los numeros sin espacios'></i></span>
                      <input type="text" class="form-control input-sm" name="rif" id="rif" placeholder="J1234567890" autofocus value="" autocomplete="off" 
                      maxlength="10"
                      data-container="body"
                      data-placement="right"
                      data-msg-required="Este campo es Requerido."
                      data-msg-minlength='Ejemplo RIF "J123456789"'
                      data-msg-minlength="Ejemplo J123456789"
                      data-rule-required="true"
                      data-rule-minlength="10"
                      pattern="/^[JGVEP][0-9]{9}$/"
                      onkeyup="this.value = this.value.toUpperCase();"
                      >
                    </div>
                  </div> 

                  <div id="gylrif" class="col-xs-1 col-sm-1">
                  </div>

                      <div class="col-xs-10 col-sm-3">
                        <p align="left" style="padding-top: 15px;"><strong>Certificado R.N.C.</strong></p>
                        <div id="divrnc" style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-4">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-folder-close" data-toggle="tooltip" data-placement="left" title='Este campo se llenara Automaticamente'></i></span>
                          <input type="number" class="form-control input-sm" name="estatusRNC" id="estatusRNC" placeholder="Certificacion RNC" autofocus value="" autocomplete="off" 
                          maxlength="15"
                          data-container="body"
                          data-placement="right"
                          data-msg-number="Este campo solo acepta Numeros."
                          data-msg-required="Este campo es Requerido."
                          data-msg-minlength="Debes ingresar al menos 15 caracteres."
                          data-rule-required="true"
                          data-rule-minlength="15"
                                                                     
                          >
                        </div>
                      </div>

                  <div id="gylrnc" class="col-xs-1 col-sm-1">
                  </div>

                    <div class="col-xs-10 col-sm-4">
                      <p align="left" style="padding-top: 15px;"><strong>Nombre de la Empresa</strong></p>
                      <div style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-4">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-folder-close" data-toggle="tooltip"  data-placement="left" title='Este campo se llenara Automaticamente'></i></span>
                        <input type="text" class="form-control input-sm" name="razonsocial" id="razonsocial" placeholder="Nombre de Empresa" autofocus value="" autocomplete="off" 
                        maxlength="80"
                        data-container="body"
                        data-placement="right"
                        data-msg-required="Este campo es Requerido."
                        data-msg-minlength="Debes ingresar al menos 3 caracteres."
                        data-rule-required="true"
                        data-rule-minlength="3"
                         
                        >
                      </div>
                    </div>

              </div>
                  <div id="mensaje" class="col-xs-12 col-sm-12" style="height: 75px; margin-top: 25px; padding-top: 10px; padding-left: 10px;">
                  </div>

                  <div class="col-xs-12 col-sm-12" style="height: 40px; margin-top: 25px;">
                    <div class="col-xs-6 col-sm-6">
                    <button type="button"  id="btn-valrif" name="btn-valrif" class="btn btn-warning center-block" onclick="getrif();"><span class="glyphicon glyphicon-search"></span>   VALIDAR R.I.F.</button>
                    </div>
                    <div class="col-xs-6 col-sm-6">
                      <button type="button"  id="btn1-tabadelante" name="btn1-tabadelante" class="btn btn-primary center-block">SIGUIENTE  <span class="glyphicon glyphicon-forward"></span></button>
                    </div>
                  </div>

            </div>
          </div>
        </div>


            <div class="tab-pane fade" id="tab2primary">
                 <div class="panel panel-info" style="width:100%; text-align: left; margin-top: 15px;">
                  <div class="panel-heading"><strong><h3 class="panel-title" style="text-transform: uppercase;"><span class="glyphicon glyphicon-lock"></span> Datos Empresa</h3></strong>
                  </div>
                  <div class="panel-body">

                    <div class="row">


                      <div class="col-xs-12 col-sm-3">
                        <p align="left" style="padding-top: 15px;"><strong>Telefono.</strong></p>
                        <div style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-4">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" data-toggle="tooltip" data-placement="left" title='Nombre de Usuario'></i></span>
                          <input type="text" class="form-control input-sm" name="tlf_empresa" id="tlf_empresa" placeholder="(0499)555-55-55" autofocus value="" autocomplete="off" 
                          maxlength="20"
                          data-container="body"
                          data-placement="right"
                          data-msg-required="Este campo es Requerido."
                          data-msg-minlength="Debes ingresar al menos 3 caracteres."
                          data-rule-required="true"
                          data-rule-minlength="3"

                          >
                        </div> 
                      </div>
                      <div class="col-xs-12 col-sm-3">
                        <p align="left" style="padding-top: 15px;"><strong>Telefono (Opcional)</strong></p>
                        <div style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-4">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-earphone " data-toggle="tooltip" data-placement="left" title='Nombre de Usuario'></i></span>
                          <input type="text" class="form-control input-sm" name="tle2_empresa" id="tle2_empresa" placeholder="(0499)555-55-55" autofocus value="" autocomplete="off" 
                          maxlength="20"
                          data-container="body"
                          data-placement="right"
                          data-msg-required="Este campo es Requerido."
                          data-msg-minlength="Debes ingresar al menos 3 caracteres."
                          data-rule-required="true"
                          data-rule-minlength="3"                                             
                          >
                        </div> 
                      </div>
                      <div class="col-xs-12 col-sm-4">
                        <p align="left" style="padding-top: 15px;"><strong>Correo Electronico</strong></p>
                        <div style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-4">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" data-toggle="tooltip" data-placement="left" title='Nombre de Usuario'></i></span>
                          <input type="email" class="form-control input-sm" name="correo_empresa" id="correo_empresa" placeholder=" correo@gmail.com" autofocus value="" autocomplete="off" 
                          maxlength="45"
                          data-container="body"
                          data-placement="right"
                          data-msg-required="Este campo es Requerido."
                          data-msg-minlength="Debes ingresar al menos 10 caracteres."
                          data-msg-email="Debe ingresar un Formato email Valido"                                         
                          data-rule-required="true"
                          data-rule-minlength="10" 
                          >
                        </div> 
                      </div>

                      <div class="col-xs-12 col-sm-3">
                        <p align="left" style="padding-top: 15px;"><strong>Estado</strong></p>
                        <div style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-4">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-th-list" data-toggle="tooltip" data-placement="left" title='Nombre de Usuario'></i></span>
                          <select class="form-control input-sm"  id="codestado" name="codestado" required="" onchange="getmunicipio();">
                            <option value=0 disabled="" selected>Seleccione Estado</option>
                            <?php for($i=0;$i<$contestado;$i++){ ?>
                            <option value="<?php echo $respuesta['estados']['entidadRespuesta'][$i]['codestado'];?>"><?php echo $respuesta['estados']['entidadRespuesta'][$i]['nombre'];?></option>
                            <?php }?>        
                          </select>
                        </div>
                      </div>

                      <div class="col-xs-12 col-sm-3">
                        <p align="left" style="padding-top: 15px;"><strong>Municipio</strong></p>
                        <div style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-4">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-th-list" data-toggle="tooltip"  data-placement="left" title='Nombre de Usuario'></i></span>
                          <select class="form-control input-sm"  id="codmunicipio" name="codmunicipio" required=""  onchange="getparroquia();">
                            <option value="0" disabled="disabled" selected="selected" >Seleccione Municipio</option>        
                          </select>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-3">
                        <p align="left" style="padding-top: 15px;"><strong>Parroquia</strong></p>
                        <div style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-4">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-th-list" data-toggle="tooltip" data-placement="left" title='Nombre de Usuario'></i></span>
                          <select class="form-control input-sm"  id="codparroquia" name="codparroquia" required="" onchange="libciudad();">
                           <option value="0" disabled="disabled" selected="selected" >Seleccione Parroquia</option>         
                         </select>
                       </div>
                     </div>

                     <div class="col-xs-12 col-sm-3">
                      <p align="left" style="padding-top: 15px;"><strong>Ciudad</strong></p>
                      <div style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-4">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-th-list" data-toggle="tooltip" data-placement="left"  title='Nombre de Usuario'></i></span>
                        <select class="form-control input-sm"  id="codciudad" name="codciudad" required="" onchange="">
                          <option value="0" disabled="disabled" selected="selected" >Seleccione Ciudad</option>             
                        </select>
                      </div>
                    </div>


                    <div class="col-xs-12 col-sm-3">
                      <p align="left" style="padding-top: 15px;"><strong>Avenida/Calle</strong></p>
                      <div style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-4">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user" data-toggle="tooltip" data-placement="left" title='Nombre de Usuario'></i></span>
                        <input type="text" class="form-control" name="avenida" id="avenida" placeholder="Direccion Fiscal" autofocus value="" autocomplete="off" 
                        maxlength="150"
                        data-container="body"
                        data-placement="right"
                        data-msg-required="Este campo es Requerido."
                        data-msg-minlength="Debes ingresar al menos 20 caracteres."
                        data-rule-required="true"
                        data-rule-minlength="20"                                             
                        >
                      </div> 
                    </div>

                    <div class="col-xs-12 col-sm-3">
                      <p align="left" style="padding-top: 15px;"><strong>Edificio/Casa/Quinta</strong></p>
                      <div style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-4">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user" data-toggle="tooltip" data-placement="left" title='Nombre de Usuario'></i></span>
                        <input type="text" class="form-control" name="edificio" id="edificio" placeholder="Direccion Fiscal" autofocus value="" autocomplete="off" 
                        maxlength="150"
                        data-container="body"
                        data-placement="right"
                        data-msg-required="Este campo es Requerido."
                        data-msg-minlength="Debes ingresar al menos 20 caracteres."
                        data-rule-required="true"
                        data-rule-minlength="20"                                             
                        >
                      </div> 
                    </div>

                    <div class="col-xs-12 col-sm-3">
                      <p align="left" style="padding-top: 15px;"><strong>Apartamento/Oficina</strong></p>
                      <div style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-4">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user" data-toggle="tooltip" data-placement="left" title='Nombre de Usuario'></i></span>
                        <input type="text" class="form-control" name="oficina" id="oficina" placeholder="Direccion Fiscal" autofocus value="" autocomplete="off" 
                        maxlength="150"
                        data-container="body"
                        data-placement="right"
                        data-msg-required="Este campo es Requerido."
                        data-msg-minlength="Debes ingresar al menos 20 caracteres."
                        data-rule-required="true"
                        data-rule-minlength="20"                                             
                        >
                      </div> 
                    </div>

                    <div class="col-xs-12 col-sm-3">
                      <p align="left" style="padding-top: 15px;"><strong>Sector</strong></p>
                      <div style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-4">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user" data-toggle="tooltip" data-placement="left" title='Nombre de Usuario'></i></span>
                        <input type="text" class="form-control" name="sector" id="sector" placeholder="Direccion Fiscal" autofocus value="" autocomplete="off" 
                        maxlength="150"
                        data-container="body"
                        data-placement="right"
                        data-msg-required="Este campo es Requerido."
                        data-msg-minlength="Debes ingresar al menos 20 caracteres."
                        data-rule-required="true"
                        data-rule-minlength="20"                                             
                        >
                      </div> 
                    </div>



                  </div>
                      <div class="col-xs-12 col-sm-12" style="height: 60px; margin-top: 25px; background-color: red;">
                      sdffsfsfsdfd
                      </div>

                      <div class="col-xs-12 col-sm-12" style="height: 40px; margin-top: 25px;">
                        <div class="col-xs-6 col-sm-6">
                        <a href="#tab1primary" data-toggle="tab">
                        <button type="button" id="btn2-tabregresar" class="btn btn-default center-block"><span class="glyphicon glyphicon-backward"></span>ANTERIOR</button>
                        </a>
                        </div>
                        <div class="col-xs-6 col-sm-6">
                        <a href="#tab3primary" data-toggle="tab">
                        <button type="button" id="btn2-tabadelante" class="btn btn-primary center-block">SIGUIENTE<span class="glyphicon glyphicon-forward"></span></button>
                        </a>
                        </div>
                      </div>
                </div>
              </div>
            </div>



          <div class="tab-pane fade" id="tab3primary">
             <div class="panel panel-info" style="width:100%; text-align: left; margin-top: 15px;">
              <div class="panel-heading"><strong><h3 class="panel-title" style="text-transform: uppercase;"><span class="glyphicon glyphicon-lock"></span> Datos Representante Legal</h3></strong>
              </div>
              <div class="panel-body">
               <div class="row">
                <div class="col-xs-12 col-sm-4">
                  <p align="left" style="padding-top: 15px;"><strong>Apellido Representante Legal</strong></p>
                  <div style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-4">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user" data-toggle="tooltip" data-placement="left" title='Nombre de Usuario'></i></span>
                    <input type="text" class="form-control" name="apellido_repre" id="apellido_repre" placeholder="Apellido Repre Legal" autofocus value="" autocomplete="off" 
                    maxlength="15"
                    data-container="body"
                    data-placement="right"
                    data-msg-required="Este campo es Requerido."
                    data-msg-minlength="Debes ingresar al menos 3 caracteres."
                    data-rule-required="true"
                    data-rule-minlength="3"
                    >
                  </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                  <p align="left" style="padding-top: 15px;"><strong>Nombre Representante Legal</strong></p>
                  <div style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-4">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user" data-toggle="tooltip" data-placement="left" title='Nombre de Usuario'></i></span>
                    <input type="text" class="form-control" name="nombre_repre" id="nombre_repre" placeholder="Nombre Repre Legal" autofocus value="" autocomplete="off" 
                    maxlength="15"
                    data-container="body"
                    data-placement="right"
                    data-msg-required="Este campo es Requerido."
                    data-msg-minlength="Debes ingresar al menos 3 caracteres."
                    data-rule-required="true"
                    data-rule-minlength="3"
                    >
                  </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                  <p align="left" style="padding-top: 15px;"><strong>Cedula Identidad</strong></p>
                  <div style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-4">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-credit-card" data-toggle="tooltip" data-placement="left" title='Nombre de Usuario'></i></span>
                    <input type="text" class="form-control" name="cedula_repre" id="cedula_repre" placeholder="V-12345677" autofocus value="" autocomplete="off" 
                    maxlength="9"
                    data-container="body"
                    data-placement="right"
                    data-msg-required="Este campo es Requerido."
                    data-msg-minlength="Debes ingresar al menos 3 caracteres."
                    data-rule-required="true"
                    data-rule-minlength="7"
                    >
                  </div>                    
                </div>
                <div class="col-xs-12 col-sm-3">
                  <p align="left" style="padding-top: 15px;"><strong>Cargo en Empresa</strong></p>
                  <div style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-3">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-th-list" data-toggle="tooltip" data-placement="left" title='Nombre de Usuario'></i></span>
                    <select class="form-control input-sm"  id="cargo_repre" name="cargo_repre" onchange="">
                       <option value=0 disabled="" selected>Seleccione Cargo</option>
                    <?php for($i=0;$i<$contcargos;$i++){ ?>
                        <option value="<?php echo $respuesta['cargos']['entidadRespuesta'][$i]['codtipcargo'];?>"><?php echo $respuesta['cargos']['entidadRespuesta'][$i]['nombre'];?></option>
                            <?php }?>         
                    </select>
                  </div>
                </div>

                <div class="col-xs-12 col-sm-3">
                  <p align="left" style="padding-top: 15px;"><strong>Telefono Celular (Opcional)</strong></p>
                  <div style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-4">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-phone" data-toggle="tooltip" data-placement="left" title='Nombre de Usuario'></i></span>
                    <input type="text" class="form-control" name="tlf_repre" id="tlf_repre" placeholder="(0499)555-55-55 Representante" autofocus value="" autocomplete="off" 
                    maxlength="15"
                    data-container="body"
                    data-placement="right"
                    data-msg-required="Este campo es Requerido."
                    data-msg-minlength="Debes ingresar al menos 3 caracteres."
                    data-rule-required="true"
                    data-rule-minlength="3"
                    >
                  </div>
                </div>

                <div class="col-xs-12 col-sm-6">
                  <p align="left" style="padding-top: 15px;"><strong>Correo Electronico (Opcional)</strong></p>
                  <div style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-4">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" data-toggle="tooltip" data-placement="left" title='Nombre de Usuario'></i></span>
                    <input type="email" class="form-control" name="correo_repre" id="correo_repre" placeholder="Correro Electronico Repre" autofocus value="" autocomplete="off" 
                    maxlength="40"
                    data-container="body"
                    data-placement="right"
                    data-msg-email="Debe ingresar un Formato email Valido" 
                    data-msg-required="Este campo es Requerido."
                    data-msg-minlength="Debes ingresar al menos 10 caracteres."
                    data-rule-required="true"
                    data-rule-minlength="10"
                    >
                  </div>
                </div>
              </div>
                      <div class="col-xs-12 col-sm-12" style="height: 60px; margin-top: 25px; background-color: red;">
                      sdffsfsfsdfd
                      </div>

                      <div class="col-xs-12 col-sm-12" style="height: 40px; margin-top: 25px;">
                        <div class="col-xs-6 col-sm-6">
                        <a href="#tab2primary" data-toggle="tab">
                        <button type="button" id="btn3-tabregresar" class="btn btn-default center-block"><span class="glyphicon glyphicon-backward"></span>  ANTERIOR</button>
                        </a>
                        </div>
                        <div class="col-xs-6 col-sm-6">
                        <a href="#tab4primary" data-toggle="tab">
                        <button type="button" id="btn3-tabadelante" class="btn btn-primary center-block">SIGUIENTE  <span class="glyphicon glyphicon-forward"></span></button>
                        </a>
                        </div>
                      </div>


            </div>
          </div>
        </div>


      <div class="tab-pane fade" id="tab4primary">                          
        <div class="panel panel-info" style="width:100%; text-align: left; margin-top: 15px;">
            <div class="panel-heading"><strong><h3 class="panel-title" style="text-transform: uppercase;"><span class="glyphicon glyphicon-lock"></span>Rubros</h3></strong>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-xs-6 col-sm-3">dsfsfsdfsdfsdfs
                </div>
                <div class="col-xs-6 col-sm-3">dsfsfsdfsdfsdfs
                </div>
                <div class="col-xs-6 col-sm-3">dsfsfsdfsdfsdfs
                </div>
                <div class="col-xs-6 col-sm-3">dsfsfsdfsdfsdfs
                </div>

            
              </div>
            </div>
                    <div class="col-xs-12 col-sm-12" style="height: 60px; margin-top: 25px; background-color: red;">
                      sdffsfsfsdfd
                      </div>

                      <div class="col-xs-12 col-sm-12" style="height: 40px; margin-top: 25px;">
                        <div class="col-xs-6 col-sm-6">
                        <a href="#tab3primary" data-toggle="tab">
                        <button type="button" id="btn4-tabregresar" class="btn btn-default center-block"><span class="glyphicon glyphicon-backward"></span>  ANTERIOR</button>
                        </a>
                        </div>
                        <div class="col-xs-6 col-sm-6">
                        <button type="button" id="btn_validar" class="btn btn-success center-block">REGISTRARSE  <span class="glyphicon glyphicon-floppy-save"></span></button>
                        </div>
                      </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</form>



<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="min-width: 450px;">
  <div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4" >
            <div class="col-md-12 col-xs-6">
            <p class="bg-primary" align="center"><strong>RIF</strong> </p>
            </div>
            <div class="col-md-12 col-xs-6" style="padding-bottom: 10px;" id="modal_RIF">
            
            </div>
          </div>

          <div class="col-md-4" >
            <div class="col-md-12 col-xs-6">
            <p class="bg-primary" align="center"><strong>RAZON SOCIAL</strong> </p>
            </div>
            <div class="col-md-12 col-xs-6" style="padding-bottom: 10px;" id="modal_rsocial">
            SDFSDDFFDSFDDFSFDDSFFDS
            </div>
          </div>

          <div class="col-md-4" >
            <div class="col-md-12 col-xs-6">
            <p class="bg-primary" align="center"><strong>TELEFONO</strong> </p>
            </div>
            <div class="col-md-12 col-xs-6" style="padding-bottom: 10px;" id="modal_tlf">
            SDFSDDFFDSFDDFSFDDSFFDS
            </div>
          </div>

          <div class="col-md-4" >
            <div class="col-md-12 col-xs-6">
            <p class="bg-primary" align="center"><strong>FAX (OPCIONAL)</strong> </p>
            </div>
            <div class="col-md-12 col-xs-6" style="padding-bottom: 10px;" id="modal_fax">
            SDFSDDFFDSFDDFSFDDSFFDS
            </div>
          </div>

           <div class="col-md-4" >
            <div class="col-md-12 col-xs-6">
            <p class="bg-primary" align="center"><strong>CORREO ELECTRONICO</strong> </p>
            </div>
            <div class="col-md-12 col-xs-6" style="padding-bottom: 10px;" id="modal_correo">
            SDFSDDFFDSFDDFSFDDSFFDS
            </div>
          </div>

          <div class="col-md-4" >
            <div class="col-md-12 col-xs-6">
            <p class="bg-primary" align="center"><strong>ESTADO</strong> </p>
            </div>
            <div class="col-md-12 col-xs-6" style="padding-bottom: 10px;" id="modal_estado">
            SDFSDDFFDSFD DFSFDDSFFDS
            </div>
          </div>

          <div class="col-md-4" >
            <div class="col-md-12 col-xs-6">
            <p class="bg-primary" align="center"><strong>MUNICIPIO</strong> </p>
            </div>
            <div class="col-md-12 col-xs-6" style="padding-bottom: 10px;" id="modal_municipio">
            SDFSDDFFDSF DDFSFDDSFFDS
            </div>
          </div>

          <div class="col-md-4" >
            <div class="col-md-12 col-xs-6">
            <p class="bg-primary" align="center"><strong>PARROQUIA</strong> </p>
            </div>
            <div class="col-md-12 col-xs-6" style="padding-bottom: 10px;" id="modal_parroquia">
            SDFSDDFFDSFD DFSFDDSFFDS
            </div>
          </div>

          <div class="col-md-4" >
            <div class="col-md-12 col-xs-6">
            <p class="bg-primary" align="center"><strong>CIUDAD</strong> </p>
            </div>
            <div class="col-md-12 col-xs-6" style="padding-bottom: 10px;" id="modal_ciudad">
            SDFSDDFFDSFD DFSFDDSFFDS
            </div>
          </div>

          <div class="col-md-12 col-xs-12">
            <div class="col-md-12 col-xs-12">
            <p class="bg-primary" align="center"><strong>DIRRECION FISCAL</strong> </p>
            </div>
            <div class="col-md-12 col-xs-12" style="padding-bottom: 10px; width: 100%" id="modal_dirreccion">
             SDFSDDFFDSFDDFSFDDSFFDSSD FSDDFFDSFDDFSFDDSFFDSSDFSDDFFDSFDDFSFDDSFF DSSDFSDDFFDSFDDFSFDDSFFDSSDFSDDFFDSFDDFSFDD SFFDSSDFSDDFFDSFDDFSFDDSFFDS
            </div>
          </div>

          <div class="col-md-4" >
            <div class="col-md-12 col-xs-6">
            <p class="bg-primary" align="center"><strong>APELLIDO REPRE LEGAL</strong> </p>
            </div>
            <div class="col-md-12 col-xs-6" style="padding-bottom: 10px;" id="modal_ap_repre">
            SDFSDDFFDSFDDFSFDDSFFDS
            </div>
          </div>

          <div class="col-md-4" >
            <div class="col-md-12 col-xs-6">
            <p class="bg-primary" align="center"><strong>NOMBRE REPRE LEGA</strong> </p>
            </div>
            <div class="col-md-12 col-xs-6" style="padding-bottom: 10px;" id="modal_nom_repre">
            SDFSDDFFDSFDDFSFDDSFFDS
            </div>
          </div>

          <div class="col-md-4" >
            <div class="col-md-12 col-xs-6">
            <p class="bg-primary" align="center"><strong>CEDULA IDENTIDAD</strong> </p>
            </div>
            <div class="col-md-12 col-xs-6" style="padding-bottom: 10px;" id="modal_cedula">
            SDFSDDFFDSFDDFSFDDSFFDS
            </div>
          </div>

          <div class="col-md-4" >
            <div class="col-md-12 col-xs-6">
            <p class="bg-primary" align="center"><strong>CARGO EMPRESA</strong> </p>
            </div>
            <div class="col-md-12 col-xs-6" style="padding-bottom: 10px;" id="modal_cargo">
            SDFSDDFFDSFDDFSFDDSFFDS
            </div>
          </div>

          <div class="col-md-4" >
            <div class="col-md-12 col-xs-6">
            <p class="bg-primary" align="center"><strong>TELEFONO CELULAR</strong> </p>
            </div>
            <div class="col-md-12 col-xs-6" style="padding-bottom: 10px;" id="modal_celular">
            SDFSDDFFDSFDDFSFDDSFFDS
            </div>
          </div>

          <div class="col-md-4" >
            <div class="col-md-12 col-xs-6">
            <p class="bg-primary" align="center"><strong>CORREO ELECTRONICO</strong> </p>
            </div>
            <div class="col-md-12 col-xs-6" style="padding-bottom: 10px;" id="modal_correo_repre">
            SDFSDDFFDSFDDFSFDDSFFDS
            </div>
          </div>
        
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btn-confirmar" class="btn btn-primary" onclick="enviar_form();">Save changes</button>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">
  $('document').ready(function () {
      $('#tlf_empresa').mask('(0999)999-99-99');
      $('#tle2_empresa').mask('(0999)999-99-99');
      $('#tlf_repre').mask('(0999)999-99-99');

            $("#RegistroForm").validate({

               ignore:"",
                showErrors: function(errorMap, errorList) {
                    //LIMPIAR LOS TOOLTIPS PARA LOS ELEMENTOS VÁLIDOS
                    $.each(this.validElements(), function (index, element) {
                        var $element = $(element);
                        $element.data("title", "") // BORRAR EL TITULO - NO HAY ERROR ASOCIADO
                            .removeClass("error")
                            .tooltip("destroy");
                    });

                    // CREAR LOS TOOLTIPS PARA ELEMENTOS INVÁLIDOS
                    $.each(errorList, function (index, error) {
                        var $element = $(error.element);
                        $element.tooltip("destroy") // DESTRUIR TODO TOOLTIP EXISTENTE PARA PODER CREAR UNO NUEVO
                            .data("title", error.message)
                            .addClass("error")
                            .tooltip(); // CREAR UN NUEVO TOOLTIP CON EL MENSAJE DE ERROR ASOCIADO AL TITULO AGREGADO
                    });
                }
            });

        $("#btn_validar").click(function(){  // capture the click
        if($("#RegistroForm").valid()){   // test for validity
            asignar_modal();
            $('#myModal').modal('show')
        } else {
            alert("no valido")
        }
    });


      $('#btn1-tabadelante').click(function(){
                $('#tab-1').removeClass("active");
                $('#tab-2').addClass("active");
                $('[href="#tab2primary"]').tab('show')
            });

      $('#btn2-tabregresar').click(function(){
                $('#tab-1').addClass("active");
                $('#tab-2').removeClass("active");
            });
       $('#btn2-tabadelante').click(function(){
                $('#tab-3').addClass("active");
                $('#tab-2').removeClass("active");
            });


      $('#btn3-tabregresar').click(function(){
                $('#tab-2').addClass("active");
                $('#tab-3').removeClass("active");
            });
       $('#btn3-tabadelante').click(function(){
                $('#tab-4').addClass("active");
                $('#tab-3').removeClass("active");
            });

      $('#btn4-tabregresar').click(function(){
                $('#tab-3').addClass("active");
                $('#tab-4').removeClass("active");
            });
    

     $("#rif").keydown(function() {
      //$( "#btn1-tabadelante" ).prop( "disabled", true ); OMAR  DESCOMENTAR LUEGO
      $("#razonsocial").val("");
      $("#estatusRNC").val("");
      $("#mensaje").html("");
      $("#mensaje").removeClass("error");

      $("#divrif").removeClass("form-group has-success");
      $("#divrif").removeClass("form-group has-error")
      $("#gylrif").html("");

      $("#divrnc").removeClass("form-group has-success");
      $("#divrnc").removeClass("form-group has-error");
      $("#gylrnc").html("");
        });


        });


function enviar_form()
{
  $("#RegistroForm").submit();
}
function getrif()
{    
   // $( "#btn1-tabadelante" ).prop( "disabled", true );// OMAR DESCOMENTAR LUEGO
    var getrif = $('#rif').val();

    if ((getrif.length==10)&&(getrif.match(/^[JGVEP][0-9]{9}$/)))
    {
    //Guardamos el select de proceso
    var webservice = "getRIF";
    var pagina = 'public/';
    var method = 'Get';
    var url = '{{route("getConsumirAjax")}}';
    var arrcampos = ['rif'];
    var arrvar = [getrif];
    var data = {webservice: webservice, pagina: pagina, method: method, campos: arrcampos, valores: arrvar};
        //console.log(data);
                $.ajax({
                    type: "GET",
                    //headers: {'X-CSRF-TOKEN': token},
                    url: url,
                    data: data,
                    datatype: 'JSON',
                   success: function (text) 
                   { 
                    console.log(text);
                      if (text.codrespuesta=="COD_000") 
                      { 
                        if (text.entidadRespuesta['consultaRIF']['status']==200)
                        {
                            var razonsocial = text.entidadRespuesta['consultaRIF']['content']['seniat']['nombre'];
                            $("#divrif").addClass("form-group has-success");
                            $("#gylrif").html("<p style='margin-top: 45px;'><i class='glyphicon glyphicon-ok-sign' style='font-size:25px;color:green'></i>");
                            $("#razonsocial").val(razonsocial);

                            if(text.entidadRespuesta['consultaRNC']['codrespuesta']=="COD_000")
                            {
                              if (text.entidadRespuesta['consultaRNC']['status']==200)
                              {
                                var estatusRNC = text.entidadRespuesta['consultaRNC']['entidadRespuesta'][0]['nombre'];
                                if (text.entidadRespuesta['consultaRNC']['entidadRespuesta'][0]['habilitada']==1)
                                {
                                $("#estatusRNC").val("HABILITADA");
                                $("#divrnc").addClass("form-group has-success");
                                $("#gylrnc").html("<p style='margin-top: 45px;'><i class='glyphicon glyphicon-ok-sign' style='font-size:25px;color:green'></i>");
                                $( "#btn1-tabadelante" ).prop( "disabled", false );

                                }
                                if (text.entidadRespuesta['consultaRNC']['entidadRespuesta'][0]['habilitada']==0)
                                {
                                $("#estatusRNC").val("NO HABILITADA");
                                $("#divrnc").addClass("form-group has-error");
                                $("#gylrnc").html("<p style='margin-top: 45px;'><i class='glyphicon glyphicon-remove-sign' style='font-size:25px;color:red'></i>");
                                $("#mensaje").addClass("error");
                                $("#mensaje").html("LA EMPRESA <strong>"+razonsocial+"</strong> TIENE EL ESTATUS DE <strong>"+estatusRNC+"</strong>. POR ENDE NO PUEDE REGISTRARSE EN EL SISTEMA </br> SI CONSIDERA QUE LA INFORMACION ES ERRONEA LE INVITAMOS A CONSULTAR SU ESTATUS EN WWW.RNC.COM");
                                }
                              }
                               else
                               {
                                $("#mensaje").addClass("error");
                                $("#mensaje").html("estatus= "+text.entidadRespuesta['consultaRNC']['status']+" "+text.entidadRespuesta['consultaRNC']['error']);
                               } 
                            }
                            else
                            {
                              $("#mensaje").addClass("error");
                              $("#mensaje").html("estatus= "+text.entidadRespuesta['consultaRNC']['status']+" "+text.entidadRespuesta['consultaRNC']['error']);
                            }
                        }
                        else if (text.entidadRespuesta['consultaRIF']['status']==452)
                        { 
                          $("#divrif").addClass("form-group has-error");
                          $("#gylrif").html("<p style='margin-top: 45px;'><i class='glyphicon glyphicon-remove-sign' style='font-size:25px;color:red'></i>");
                          $("#mensaje").addClass("error");
                          $("#mensaje").html(text.entidadRespuesta['consultaRIF']['content']+" el R.I.F. "+getrif+" NO esta registrado en el SENIAT" );
                        }
                      }
                      else
                      {
                        $("#mensaje").addClass("error");
                        $("#mensaje").html(text.codrespuesta+" "+text.mensaje);

                      }
                   }
                  });
    }

//^[JGVEP][0-9]{9}$

}


function getmunicipio()
{
    var codestado = $('#codestado').val();
    //alert(codestado);
    //Guardamos el select de proceso
    var webservice = "getMunicipio";
    var pagina = 'public/';
    var method = 'Get';
    var url = '{{route("getConsumirAjax")}}';
    var arrcampos = ['codestado'];
    var arrvar = [codestado];
    var data = {webservice: webservice, pagina: pagina, method: method, campos: arrcampos, valores: arrvar};
        //alert(data);
                $.ajax({
                    type: "GET",
                    //headers: {'X-CSRF-TOKEN': token},
                    url: url,
                    data: data,
                    datatype: 'JSON',
                   success: function (text) {
                    //alert('hola');
                    //alert(JSON.stringify(text)); //hacer alert de un json
                        if (text.codrespuesta == 'COD_000') {
                            // Limpiamos el select
                            $("#codmunicipio").find('option').remove();
                            $("#codmunicipio").append('<option value="0" disabled>Seleccione Municipio</option>');
                            var $entidadRespuesta = text.entidadRespuesta
                            var $count = $entidadRespuesta.length;
                            for (j = 0; j < $count; j++) {
                                $("#codmunicipio").append('<option value="' + $entidadRespuesta[j].codmunicipio + '">' + $entidadRespuesta[j].nombre + '</option>');
                            }
                       $("#codmunicipio").prop('disabled', false);
                       $("#codmunicipio").val(0)
                       

                       $("#codparroquia").find('option').remove();
                      // $("#parroquia").prop('disabled', true);
                       $("#codparroquia").append('<option value="0" disabled>Seleccione Parroquia</option>');

                       $("#codparroquia").val(0)





                      // $("#codciudad").prop('disabled', true);

                       getciudad();
                        }
                    },
                    error: function (e) {
                        alert("No se puede obtener la data. " + JSON.stringify(e));
                    }
                });
  


}

function getparroquia()
{
    var codmunicipio = $('#codmunicipio').val();
    //alert(codestado);
    //Guardamos el select de proceso
    var webservice = "getParroquia";
    var pagina = 'public/';
    var method = 'Get';
    var url = '{{route("getConsumirAjax")}}';
    var arrcampos = ['codmunicipio'];
    var arrvar = [codmunicipio];
    var data = {webservice: webservice, pagina: pagina, method: method, campos: arrcampos, valores: arrvar};
        //console.log(data);
                $.ajax({
                    type: "GET",
                    //headers: {'X-CSRF-TOKEN': token},
                    url: url,
                    data: data,
                    datatype: 'JSON',
                   success: function (text) {
//                      alert('hola');
//                      alert(JSON.stringify(text)); //hacer alert de un json
                        if (text.codrespuesta == 'COD_000') {
                            // Limpiamos el select
                            $("#codparroquia").find('option').remove();
                            $("#codparroquia").append('<option value="0" disabled >Seleccione parroquia</option>');
                            var $entidadRespuesta = text.entidadRespuesta
                            var $count = $entidadRespuesta.length;
                            for (j = 0; j < $count; j++) {
                                $("#codparroquia").append('<option value="' + $entidadRespuesta[j].codparroquia + '">' + $entidadRespuesta[j].nombre + '</option>');
                            }
                       $("#codparroquia").prop('disabled', false);
                       $("#codparroquia").val(0)

                       $("#codciudad").prop('disabled', true);
                        }
                    },
                    error: function (e) {
                        alert("No se puede obtener la data. " + JSON.stringify(e));
                    }
                });
  


}


function getciudad()
{
              var codestado = $('#codestado').val();
              var webservice = "getCiudad";
              var pagina = 'public/';
              var method = 'Get';
              var url = '{{route("getConsumirAjax")}}';
              var arrcampos = ['codestado'];
              var arrvar = [codestado];
              var data = {webservice: webservice, pagina: pagina, method: method, campos: arrcampos, valores: arrvar};
              $.ajax({
                    type: "GET",
                    //headers: {'X-CSRF-TOKEN': token},
                    url: url,
                    data: data,
                    datatype: 'JSON',
                   success: function (text) {
//                        alert('hola');
//                        alert(JSON.stringify(text)); //hacer alert de un json
                        if (text.codrespuesta == 'COD_000') {
                            // Limpiamos el select
                            $("#codciudad").find('option').remove();
                            $("#codciudad").append('<option value="0" disabled>Seleccione ciudad</option>');
                            var $entidadRespuesta = text.entidadRespuesta
                            var $count = $entidadRespuesta.length;
                            for (j = 0; j < $count; j++) {
                                $("#codciudad").append('<option value="' + $entidadRespuesta[j].codciudad + '">' + $entidadRespuesta[j].nombre + '</option>');
                            }
                      // $("#codciudad").prop('disabled', false);
                       $("#codciudad").val(0)
                        }
                    },
                    error: function (e) {
                        alert("No se puede obtener la data. " + JSON.stringify(e));
                    }
                });        
}

function libciudad()
{
  $("#codciudad").prop('disabled', false);
  $("#codciudad").val(0);
}



function asignar_modal()
{
  $("#modal_RIF")         .html("<strong>"+$("#tlf_empresa").val()+"</strong>");
  $("#modal_rsocial")     .html("<strong>"+$("#tlf_empresa").val()+"</strong>");
  $("#modal_tlf")         .html("<strong>"+$("#tlf_empresa").val()+"</strong>");
  $("#modal_fax")         .html("<strong>"+$("#tle2_empresa").val()+"</strong>");
  $("#modal_correo")      .html("<strong>"+$("#correo_empresa").val()+"</strong>");
  $("#modal_estado")      .html("<strong>"+$('#codestado option:selected').text()+"</strong>");
  $("#modal_municipio")   .html("<strong>"+$('#codmunicipio option:selected').text()+"</strong>");
  $("#modal_parroquia")   .html("<strong>"+$('#codparroquia option:selected').text()+"</strong>");
  $("#modal_ciudad")      .html("<strong>"+$('#codciudad option:selected').text()+"</strong>");
  $("#modal_dirreccion")  .html("<strong>"+$("#dirrecion").val()+"</strong>");
  $("#modal_ap_repre")    .html("<strong>"+$("#apellido_repre").val()+"</strong>");
  $("#modal_nom_repre")   .html("<strong>"+$("#nombre_repre").val()+"</strong>");
  $("#modal_cedula")      .html("<strong>"+$("#cedula_repre").val()+"</strong>");
  $("#modal_cargo")       .html("<strong>"+$("#cargo_repre").val()+"</strong>");
  $("#modal_celular")     .html("<strong>"+$("#tlf_repre").val()+"</strong>");
  $("#modal_correo_repre").html("<strong>"+$("#correo_repre").val()+"</strong>");
}
</script>
@endsection

