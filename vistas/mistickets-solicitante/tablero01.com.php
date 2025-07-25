<!-- ========================================================================================================================================================================================================== -->
<!-- ========================================================================================================================================================================================================== -->

<div class="box box-primary" style="background-color:rgb(255, 255, 255); display:none;">
  <div class="box-body">

    <div class="row" >
      <div class="col-md-1"></div>
      
      <div class="col-md-2">
        <a href="#nuevo" aria-controls="nuevo" role="tab" data-toggle="tab">
          <button type="button" class="btn btn-block btn-primary" onclick="cargar_tablas();limpiarcampos();msjticketscerrar();cssBoton(0);" id="boton0"><b>NUEVO</b></button>
        </a>
      </div>

      <div class="col-md-2">
        <a id="tap_sin_respuesta" href="#sin_respuesta" aria-controls="sin_respuesta" role="tab" data-toggle="tab">
          <button type="button" class="btn btn-block btn-default" onclick="cargar_tablas(); cssBoton(1);" id="boton1"><b>SIN RESPUESTA AÚN  <span class="label label-warning" id="notificacionNuevos" style="display:none"></span></b></h3><small class="label pull-right bg-green" id="smallSinRespuesta"></small></button>
        </a>
      </div>

      <div class="col-md-2">
        <a id="tab_seguimiento" href="#proceso" aria-controls="proceso" id="tabProceso" role="tab" data-toggle="tab">
          <button type="button" class="btn btn-block btn-default " onclick="cargar_tablas(); cssBoton(2);" id="boton2"><b>EN SEGUIMIENTO  <span class="label label-success" id="notificacionSeguimiento" style="display:none"></span></b></h3><small class="label pull-right bg-green" id="smallSeguimiento"></small></button>
        </a>
      </div>

      <div class="col-md-2">
        <a id="tab_por_cerrar" href="#por_cerrar" aria-controls="por_cerrar" id="tabPorCerrar" role="tab" data-toggle="tab">
          <button type="button" class="btn btn-block btn-default " onclick="cargar_tablas(); cssBoton(3);" id="boton3"><b>POR CERRAR</b></h3></button>
        </a>
      </div>

      <div class="col-md-2">
        <a id="tab_cerrados" href="#historico" aria-controls="historico" role="tab" data-toggle="tab">
          <button type="button" class="btn btn-block btn-default " onclick="cargar_tablas(); cssBoton(4);" id="boton4"><b>CERRADOS</b></button>
        </a>
      </div>

      <div class="col-md-1"></div>
    </div>
 	
  </div>
</div>

<!-- ========================================================================================================================================================================================================== -->
<!-- ========================================================================================================================================================================================================== -->

<div class="row">
		<ul class="nav nav-tabs azulf" role="tablist">
			<li role="presentation" onclick="cargar_tablas();limpiarcampos();msjticketscerrar();" class="active"><a href="#nuevo" aria-controls="nuevo" role="tab" data-toggle="tab">Nuevo</a></li>
			<li role="presentation" onclick="cargar_tablas()" id="li_tab_sin_respuesta"><span class="label label-warning" id="notificacion_nuevos_t" style="display:none"></span><a id="tap_sin_respuesta" href="#sin_respuesta" aria-controls="sin_respuesta" id="tab_Sin_Respuesta" role="tab" data-toggle="tab">Sin respuesta aún</a></li>
			<li role="presentation" onclick="cargar_tablas()" id="li_tab_seguimiento"><span class="label label-success" id="notificacion_seguimiento_t" style="display:none"></span><a id="tab_seguimiento" href="#proceso" aria-controls="proceso" id="tabProceso" role="tab" data-toggle="tab">En Seguimiento</a></li>
			<li role="presentation" onclick="cargar_tablas()" id="li_tab_por_cerrar"><span class="label label-info" id="notificacion_porcerrar_t" style="display:none"></span><a id="tab_por_cerrar" href="#por_cerrar" aria-controls="por_cerrar" id="tabPorCerrar" role="tab" data-toggle="tab">Por Cerrar</a></li>
			<li role="presentation" onclick="cargar_tablas()" id="li_tab_cerrados"><a id="tab_cerrados" href="#historico" aria-controls="historico" role="tab" data-toggle="tab">Cerrados</a></li>
		</ul>
</div>