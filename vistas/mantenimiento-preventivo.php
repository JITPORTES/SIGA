<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/archivosComunes.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/biomedica/rutinas/rutinas.class.php");
$rutinasClass = new rutinas();
$sigaRutinas = $rutinasClass->sigaRutinas();
?>
<!-- ================================================================================================================================================================================= -->
<!-- ================================================================================================================================================================================= -->

	<input type="hidden" id="Area_inventario_regresar" value="<?php echo $_GET["area"]; ?>">
	<input type="hidden" id="Area_perfil_regresar" value="<?php echo $_GET["perfil"]; ?>">
	<style>
		.datepicker{z-index:1151 !important;}
		.table-fixed thead { width: 97%; }
		.table-fixed tbody { height: 230px; overflow-y: auto; width: 100%; }
		.table-fixed thead, .table-fixed tbody, .table-fixed tr, .table-fixed td, .table-fixed th { display: block; }
		.table-fixed tbody td, .table-fixed thead > tr> th { float: left; border-bottom-width: 0; }

.tooltip {
        position: fixed;
        z-index: 9999;
        background:rgb(207, 212, 214);
        color: white;
        width: 150px;
        border-radius: 3px;
        box-shadow: 0 0 2px rgba(0, 0, 0, 0.5);
        padding: 5px;
        text-align: center;
    }

</style>
	
	<link rel="stylesheet" href="/siga/dist/css/spinner.css">

<!-- ================================================================================================================================================================================= -->
<!-- ================================================================================================================================================================================= -->

<div class="loadingState" id="loadingState">
  <div class="loader"></div>
</div>
<input type="hidden" id="agnioGlobal">
<!-- ================================================================================================================================================================================= -->
<!-- ================================================================================================================================================================================= -->

	<div class="row">
		<div class="col-md-7 col-sm-12 col-xs-12">
			<ul class="nav nav-tabs azulf" role="tablist">
				<li role="presentation" onclick="fnMtoPreventivoNuevo();"; class="active" title="Mantenimientos Programados"><a href="#mantenimientoMensual" aria-controls="mantenimientoMensual" role="tab" data-toggle="tab">Mtos. Programados</a></li>
				<li role="presentation" onclick="limpiar_global(); global(); sigaTablaGlobal();"><a href="#global" aria-controls="global" role="tab" data-toggle="tab">Global</a></li>
				<li role="presentation"><a href="#calendario" aria-controls="calendario" role="tab" data-toggle="tab" onclick="calendarioNuevo();borrarModalMtoPreventivo();">Calendarios</a></li>
			</ul>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box azul">
				<a href="#" data-toggle="modal" data-target="#Actividades_Activo_Fijo" id="abrir_popup" onclick="borrarModalMtoPreventivo();">
					<span class="info-box-icon bg-aqua"><i class="fa fa-check-circle-o"></i></span>
					<div class="info-box-content"><h3 class="info-box-text">Nuevo Mant. Preventivo</h3></div>
				</a>
			</div>
		</div>
	</div>

<!-- ================================================================================================================================================================================= -->
<!-- ================================================================================================================================================================================= -->

<div class="row">
	<div class="tab-content">

<!-- ================================================================================================================================================================================= -->
<!-- ================================================================================================================================================================================= -->

<!-- tab#2 -->
	<div id="calendario" role="tabpanel" class="tab-pane">

<!-- ======================================================================================================================================================================================================= -->
<!-- ======================================================================================================================================================================================================= -->

			<div class="row">
				<div class="col-md-10 col-md-offset-1">

				<div class="box box-primary">
					<div class="box-body">

					<div class="row">

						<div class="col-md-4">
							<div class="form-group">
								<label  class="control-label" style="font-size: 11px;">AF/BC</label>
								<select id="activoCalendario"></select>
							</div>
						</div>

						<!-- <div class="col-md-4">
							<div class="form-group">
								<label  class="control-label" style="font-size: 11px;">AF/BC</label>


								<div id="muestro_select">
									<select id="select-activos-search" class="demo-default" placeholder="AF/BC" style="display:none"></select>
								</div>
								<div id="gifcargando-search" style="display:none" align="center">
									<img src="../dist/img/cargando-loading.gif" style="max-width: 25px; max-height: 25px" alt="cargando-loading-037.gif">
								</div>
							</div>
						</div> -->

						<div class="col-md-4">
							<div class="form-group">
								<label  class="control-label" style="font-size: 11px;">Rutina</label>
								<input rows="2" class="form-control" placeholder="Rutina" id="txt_Rutina_Search">
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label  class="control-label" style="font-size: 11px;">Descripción Corta</label>
								<input class="form-control" placeholder="Descripción Corta" id="txt_Desc_Corta_Search">
							</div>
						</div>

					</div>

					<div class="row">

						<!-- <div class="col-md-2" id="div_gestores_Search">
							<div class="form-group">
								<label  class="control-label" style="font-size: 11px;">Gestores</label>
								<select class="form-control" id="cmb_gestores_Search"></select>
							</div>
						</div> -->

						<div class="col-md-4">
							<div class="form-group">
								<label  class="control-label" style="font-size: 11px;">Año</label>
								<select id="agnio_vigente"></select>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label  class="control-label" style="font-size: 11px;">Ubicación Primaria</label>
								<select id="ubi_primaria_calendario"></select>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label  class="control-label" style="font-size: 11px;">Ubicación Secundaria</label>
								<select class="form-control" id="ubi_Secundaria_calendario"></select>
							</div>
						</div>

					</div>

					<div class="row">

						<!-- <div class="col-md-2" id="div_gestores_Search">
							<div class="form-group">
								<label  class="control-label" style="font-size: 11px;">Gestores</label>
								<select class="form-control" id="cmb_gestores_Search"></select>
							</div>
						</div> -->

						<div class="col-md-4">
							<div class="form-group">
								<label  class="control-label" style="font-size: 11px;">Mes</label>
								<select id="meses_vigente"></select>
							</div>
						</div>

						<div class="col-md-4">
							<!-- <div class="form-group">
								<label  class="control-label" style="font-size: 11px;">Ubicación Primaria</label>
								<select id="ubi_primaria_calendario"></select>
							</div> -->
						</div>

						<div class="col-md-4">
							<!-- <div class="form-group">
								<label  class="control-label" style="font-size: 11px;">Ubicación Secundaria</label>
								<select class="form-control" id="ubi_Secundaria_calendario"></select>
							</div> -->
						</div>

					</div>

					<div class="row">
						<div class="row" align="center">
							<!-- <button type="button" class="btn chs" id="btn_buscar_full_calendar">Buscar</button> -->
							<button type="button" class="btn chs" id="btn_buscar_full_calendar" onclick="busqueda_full_calendar(2);">Buscar</button>
							<button type="button" class="btn chs" id="btn_mostrar_full_calendar" onclick="calendarioNuevo();" style="display:none">Mostrar Calendario</button>
						</div>						
					</div>

					</div>
				</div>

				</div>
			</div>
	
<!-- ======================================================================================================================================================================================================= -->
<!-- ======================================================================================================================================================================================================= -->

		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="box box-primary">
					<div class="box-body">
						<ul class="acoat">
							<li>Estatus:</li>
							<li>Sin Asignación<span style="background: #717d7e; width: 1.2em; height: 1.2em;"></span></li>
							<li>Realizado y cerrado<span style="background: #448aff; width: 1.2em; height: 1.2em;"></span></li>
							<li>Realizado en espera de cierre<span style="background: #35a61e;width: 1.2em;height: 1.2em;"></span></li>
							<li>En seguimiento Mesa de Ayuda <span style="background: #ecc93b;width: 1.2em;height: 1.2em;"></span></li>
							<li>No Realizado <span style="background: #D90505;width: 1.2em;height: 1.2em;"></span></li>
						</ul>

						<div width="100%" align="right">
							<input type="hidden" id="btn_anio" />
							<input type="hidden" id="btn_mes" />
							<input type="hidden" id="btn_semana" />
							<input type="hidden" id="btn_dia" />
							<input type="hidden" id="btn_mes_lista" />
							
							<div id="calendarioNuevo" name="calendarioNuevo"></div>

						</div>

					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div id="respuestaBusquedaNueva" class="col-md-10 col-md-offset-1"></div>
		</div>

		<!-- <div class="row">
			<div id="respuesta_busqueda" class="col-md-10 col-md-offset-1"></div>
		</div> -->
		
	</div>

<!-- ================================================================================================================================================================================= -->
<!-- ================================================================================================================================================================================= -->

<!-- tab#4 -->
	<div id="global" role="tabpanel" class="tab-pane">

		<div class="gray">
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="row">
						<!-- Ignacio/Mauricio -->
						<div class="col-md-6">
							<div class="form-group">
								<label  class="control-label" style="font-size: 11px;">AF/BC</label>
								<div id="muestro_select_global">
									<select id="select-activos-search-global" class="demo-default" placeholder="AF/BC" style="display:none"></select>
								</div>
								<div id="gifcargando-search-global" style="display:none" align="center">
									<img src="../dist/img/cargando-loading.gif" style="max-width: 25px; max-height: 25px" alt="cargando-loading-037.gif">
								</div>
							</div>
						</div>
						<!--Fin Ignacio/Mauricio -->
						<div class="col-md-3">
							<div class="form-group">
								<span><font color="red">*</font></span><label class="control-label" style="font-size: 11px;">Ubicación Primaria(348)</label>
								<select class="form-control" id="cmbubicacionprim" data-combo-ubicacion-secundaria="cmbubicacionsec" onchange="cambioUbicacionPrimaria(this);"></select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<span><font color="red">*</font></span><label class="control-label" style="font-size: 11px;">Ubicación Secundaria</label>
								<select class="form-control" id="cmbubicacionsec">
									<option value="-1">--Ubicación Secundaria--</option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<span><font color="red">*</font></span><label class="control-label" style="font-size: 11px;">Clase</label>
								<select class="form-control" id="cmbclase" data-combo-clasificacion="cmbclasificacion"></select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<span><font color="red">*</font></span><label class="control-label" style="font-size: 11px;">Clasificación</label>
								<select class="form-control" id="cmbclasificacion">
									<option value="-1">--Clasificación--</option>		
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<span><font color="red">*</font></span><label class="control-label" style="font-size: 11px;">Familia</label>
								<select class="form-control" id="cmbfamilia" data-combo-familia="cmbsubfamilia"></select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<span><font color="red">*</font></span><label class="control-label" style="font-size: 11px;">Subfamilia</label>
								<select class="form-control" id="cmbsubfamilia">
									<option value="-1">--Subfamilia--</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<div id="muestro_select">
									<span><font color="red">*</font></span>
									<label  class="control-label"  style="font-size: 11px;">Usuario Resguardo</label>
									<select id="select-usuarios" class="demo-default" placeholder="Usuarios" style="display:none"></select>
								</div>
								<div id="gifcargando-usuarios" style="display:none" align="center">
									<img src="../dist/img/cargando-loading.gif" style="max-width: 25px; max-height: 25px" alt="cargando-loading-037.gif">
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<span><font color="red">*</font></span><label class="control-label" style="font-size: 11px;">Modelo</label>
								<input type="text" class="form-control" placeholder="Modelo" id="text_Modelo_Global">
							</div>
						</div>
						<!-- Ignacio/Mauricio -->
						<div class="col-md-3">
							<div class="form-group">
								<span><font color="red">*</font></span><label class="control-label" style="font-size: 11px;">Marca</label>
								<input type="text" class="form-control" placeholder="Marca" id="text_Marca_Global">
							</div>
						</div>
						<!--Fin Ignacio/Mauricio -->
						<div class="col-md-3">
							<div class="form-group">
								<span><font color="red">*</font></span><label class="control-label" style="font-size: 11px;">Nombre Rutina</label>
								<input type="text" class="form-control" placeholder="Nombre Rutina" id="text_Nombre_Rutina">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<span><font color="red">*</font></span><label class="control-label" style="font-size: 11px;">Nombre Equipo</label>
								<input type="text" class="form-control" placeholder="Descripción Corta" id="text_Descripcion_Corta">
							</div>
						</div>
						<div class="col-md-3" style="display:none">
							<div class="form-group">
								<span><font color="red">*</font></span><label class="control-label" style="font-size: 11px;">Mostrar</label>
								<select class="form-control" id="Slc_Mostrar">
									<option value="1">Primera Actividad</option>
									<option value="2">Detalle Actividades</option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<span><font color="red">*</font></span><label class="control-label" style="font-size: 11px;">Gestor</label>
								<select class="form-control" id="cmbGestor">															
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<span><font color="red">*</font></span><label class="control-label" style="font-size: 11px;">Asc/Desc</label>
								<select class="form-control" id="cmbOdernAscDesc">
									<option value="Asc">Ascendente</option>
									<option value="Desc">Descendente</option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<span><font color="red">*</font></span><label class="control-label" style="font-size: 11px;">Buscar / Limpiar(288)</label>
								<br>
								<!-- <button type="button" class="btn chs"  onclick="global()">Buscar</button> -->
								<button type="button" class="btn chs"  onclick="sigaTablaGlobal();">Buscar</button>
								<button type="button" class="btn chs"  onclick="limpiar_global('1')">Limpiar</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="col-md-12">
			<div class="box">
				<div class="box-body">

					<ul class="nav-time">						
						<li><a href="#noir" onclick="global_anterior_nuevo();"><span><i class="fa fa-chevron-left" aria-hidden="true"></i></span></a></li>
						<li id="agnioGlobalLi"></li>
						<li><a href="#noir" onclick="global_siguiente_nuevo();"><span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a></li>
						<li class="export"><a href="#excel" onclick="return ExcellentExport.excel(this, 'sigaTableGlobal', 'ActividadesSiga');"><i class="fa fa-file-excel-o" aria-hidden="true"></i></a></li>
					</ul>

				<table class="table table-bordered table-striped" id="sigaTableGlobal">
					<thead>
						<tr><td style="font-size:14px" colspan="10" class="text-center"><span id="spanFechaGlobal"></span></td>	

							<td style="font-size:11px" colspan="2" class="text-center">Ene</td>
							<td style="font-size:11px" colspan="2" class="text-center">Feb</td>
							<td style="font-size:11px" colspan="2" class="text-center">Mar</td>
							<td style="font-size:11px" colspan="2" class="text-center">Abr</td>
							<td style="font-size:11px" colspan="2" class="text-center">May</td>
							<td style="font-size:11px" colspan="2" class="text-center">Jun</td>
							<td style="font-size:11px" colspan="2" class="text-center">Jul</td>
							<td style="font-size:11px" colspan="2" class="text-center">Ago</td>
							<td style="font-size:11px" colspan="2" class="text-center">Sep</td>
							<td style="font-size:11px" colspan="2" class="text-center">Oct</td>
							<td style="font-size:11px" colspan="2" class="text-center">Nov</td>
							<td style="font-size:11px" colspan="2" class="text-center">Dic</td>			
						</tr>
						<tr>
							<th style="color:#fff;font-size:11px;" class="text-center">Ubic. Primaria</th>
							<th style="color:#fff;font-size:11px;" class="text-center">Usuario Resguardo</th>		  
							<th style="color:#fff;font-size:11px;" class="text-center">Gestor</th>	
							<th style="color:#fff;font-size:11px;" class="text-center">Realiza</th>
							<th style="color:#fff;font-size:11px;" class="text-center">AF/BC</th>
							<th style="color:#fff;font-size:11px;" class="text-center">Equipo</th>	
							<th style="color:#fff;font-size:11px;" class="text-center">Modelo</th>	
							<th style="color:#fff;font-size:11px;" class="text-center">No. Serie</th>		  	  					
							<th style="color:#fff;font-size:11px;" class="text-center">Periodo</th>
							<th style="color:#fff;font-size:11px;" class="text-center">Rutina</th>
							<td style="font-size:11px" class="text-center">P</td>
							<td style="font-size:11px" class="text-center">R</td>
							<td style="font-size:11px" class="text-center">P</td>
							<td style="font-size:11px" class="text-center">R</td>
							<td style="font-size:11px" class="text-center">P</td>
							<td style="font-size:11px" class="text-center">R</td>
							<td style="font-size:11px" class="text-center">P</td>
							<td style="font-size:11px" class="text-center">R</td>
							<td style="font-size:11px" class="text-center">P</td>
							<td style="font-size:11px" class="text-center">R</td>
							<td style="font-size:11px" class="text-center">P</td>
							<td style="font-size:11px" class="text-center">R</td>
							<td style="font-size:11px" class="text-center">P</td>
							<td style="font-size:11px" class="text-center">R</td>
							<td style="font-size:11px" class="text-center">P</td>
							<td style="font-size:11px" class="text-center">R</td>
							<td style="font-size:11px" class="text-center">P</td>
							<td style="font-size:11px" class="text-center">R</td>
							<td style="font-size:11px" class="text-center">P</td>
							<td style="font-size:11px" class="text-center">R</td>
							<td style="font-size:11px" class="text-center">P</td>
							<td style="font-size:11px" class="text-center">R</td>
							<td style="font-size:11px" class="text-center">P</td>
							<td style="font-size:11px" class="text-center">R</td>
						</tr>
					</thead>
					<tbody id="sigaTableGlobalTbody"></tbody>
				</table>

				</div>
			</div>
		</div>

	</div>

<!-- ================================================================================================================================================================================= -->
<!-- ================================================================================================================================================================================= -->

	<div id="mantenimientoMensual" role="tabpanel" class="tab-pane active">
		<div class="gray">
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<input type="hidden" id="PeriodoTiempoInicio" name="PeriodoTiempoInicio" value="<?php echo(date('01/m/Y')); ?>" />
					<input type="hidden" id="PeriodoTiempoFinal" name="PeriodoTiempoFinal" value="<?php echo(date('t/m/Y')); ?>" />
					<input type="hidden" id="cmbubicacionprim_mensual_tmp" name="cmbubicacionprim_mensual_tmp" />
					<input type="hidden" id="cmbubicacionsec_mensual_tmp" name="cmbubicacionsec_mensual_tmp" />
					<input type="hidden" id="cmbclase_mensual_tmp" name="cmbclase_mensual_tmp" />
					<input type="hidden" id="cmbclasificacion_mensual_tmp" name="cmbclasificacion_mensual_tmp" />
					<input type="hidden" id="cmbfamilia_mensual_tmp" name="cmbfamilia_mensual_tmp" />
					<input type="hidden" id="cmbsubfamilia_mensual_tmp" name="cmbsubfamilia_mensual_tmp" />
					<input type="hidden" id="lstFiltrosMantenimiento_tmp" name="lstFiltrosMantenimiento_tmp" />
					<input type="hidden" id="select-activos-search-mensual_tmp" name="select-activos-search-mensual_tmp" />

					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label">Ubicación Primaria(396)</label>
								<select class="form-control" id="cmbubicacionprim_mensual" data-combo-ubicacion-secundaria="cmbubicacionsec_mensual" onchange="cambioUbicacionPrimaria(this);"></select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label">Ubicación Secundaria</label>
								<select class="form-control" id="cmbubicacionsec_mensual">
									<option value="-1">--Ubicación Secundaria--</option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label">Clase</label>
								<select class="form-control" id="cmbclase_mensual" data-combo-clasificacion="cmbclasificacion_mensual" onchange="cambioClase(this);"></select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label">Clasificación</label>
								<select class="form-control" id="cmbclasificacion_mensual">
									<option value="-1">--Clasificación--</option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label">Familia</label>
								<select class="form-control" id="cmbfamilia_mensual" data-combo-familia="cmbsubfamilia_mensual" onchange="cambioFamilia(this);"></select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label">Activo</label>
								<select class="form-control" id="cmbsubfamilia_mensual">
									<option value="-1">--Subfamilia--</option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label">AF/BC</label>
								<div id="muestro_select"><select id="select-activos-search-mensual" class="demo-default" placeholder="AF/BC" style="display:none"></select></div>
								<div id="gifcargando-search-mensual" style="display:none" align="center"><img src="../dist/img/cargando-loading.gif" style="max-width: 25px; max-height: 25px" alt="cargando-loading-037.gif"></div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label">Buscar / Limpiar</label>
								<br>
								<!-- <button type="button" class="btn chs" onclick="reporteMantenimientoMes(); reporteMantenimientoPendiente(); fnMtoPreventivoNuevo();">Buscar</button> -->
								<button type="button" class="btn chs" onclick="reporteMantenimientoPendiente(); fnMtoPreventivoNuevo();">Buscar</button>
								<button type="button" class="btn chs" onclick="restablecerFiltros();">Limpiar</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="box">
					<div class="box-body">
						<div class="row">
							<div class="col-md-12">
								<ul class="acoat">
									<li>Estatus:(461) </li>
									<li>Sin Asignación<span style="background: #717d7e; width: 1.2em; height: 1.2em;"></span></li>
									<li>Realizado y cerrado<span style="background: #448aff; width: 1.2em; height: 1.2em;"></span></li>
									<li>Realizado en espera de cierre<span style="background: #35a61e;width: 1.2em; height: 1.2em;"></span></li>
									<li>En seguimiento Mesa de Ayuda <span style="background: #ecc93b;width: 1.2em; height: 1.2em;"></span></li>
									<li>No Realizado <span style="background: #D90505;width: 1.2em; height: 1.2em;"></span></li>
								</ul>
							</div>
						</div>
						<div class="row" id="mantenimientos_mes">
							<div class="col-md-12">

								<ul class="nav nav-tabs">									
									<li class="active"><a data-toggle="tab" href="#mantenimientoMesActualTab">Mantenimientos del mes</a></li>
									<li><a data-toggle="tab" href="#mantenimientoPendientesTab">Mantenimientos pendientes</a></li>
								</ul>
								<div class="tab-content">
									<!-- ==== Mantenimientos del mes ==== -->
										<div id="mantenimientoMesActualTab" class="tab-pane active">
											<div class="row">
												<h3><div class="text-center" id="fechaVigente">Fecha:</div></h3>
												<div class="col-md-12 text-right" style="padding: 1em;">
													
													<button class="btn btn-default" onclick="fnMtoPreventivoNuevo(-1);"><span class="glyphicon glyphicon-chevron-left">&nbsp;</span>Mes anterior</button>
													<button class="btn btn-default" onclick="fnMtoPreventivoNuevo(1);">Siguiente mes&nbsp;<span class="glyphicon glyphicon-chevron-right"></button>
													&nbsp;&nbsp;
													<button class="btn btn-default" onclick="fnMtoPreventivoNuevo();">Mes actual&nbsp;<span class="glyphicon glyphicon-calendar"></button>
												</div>
											</div>
											<div id="mtoPreventivoNuevo"></div>
										</div>

										<div id="mantenimientoPendientesTab" class="tab-pane">
											<div class="row">
												<h3><div class="text-center" id="fechaVigente">Mantenimientos Pendientes:</div></h3>
												<div class="col-md-12 text-left" style="padding: 1em;">

														<div id="mtoPreventivoNuevoPendientes"></div>

												</div>
											</div>
											
										</div>





								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<style>
			#mantenimientos_mes .nav-tabs { border-bottom: 1px solid #ddd !important; }
			#mantenimientos_mes .nav-tabs li { display: table-cell !important; bottom: -1px !important; position: relative; }
			#mantenimientos_mes .nav-tabs a { color: initial !important; border-radius: 4px 4px 0 0 !important; }
		</style>
	</div>

<!-- ================================================================================================================================================================================= -->
<!-- ================================================================================================================================================================================= -->

<!-- /.row -->		
	</div>
</div>
<!-- ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->


<!-- ==== Sección Modal Mto Preventivo Inicio ==================================================================================================================================== -->
<!-- ==== Sección Modal Mto Preventivo Inicio ==================================================================================================================================== -->

<div class="modal fade modalchs" id="Actividades_Activo_Fijo" data-backdrop="false" >
	<div class="modal-dialog modal-xl">
		<div class="modal-content">

				<div class="modal-header azul">
					<button type="button" class="close" onclick="confirmacion_cerrar_mant_prev('Actividades_Activo_Fijo');"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Mantenimiento Preventivo(468)</h4>
				</div>
				
				<div class="modal-body nopsides">

					<form>
					<div class="gray nm">
						<div class="row">
							<div class="col-md-10 col-md-offset-1">
								<input type="hidden"  id="Id_Actividad" readonly="readonly">
								<input type="hidden" id="Estatus_Realizado">
								<input type="hidden" id="Estatus_Guardar">
								<input type="hidden" id="Fecha_Calendario">

								<div class="col-md-8">
									<div class="form-group">
										<div id="muestro_select">
											<span><font color="red">*</font></span>
											<label for="cmbareas" class="control-label" id="cmbareasLabel" style="font-size: 11px;">AF/BC</label>
											<select id="select-activos" class="demo-default" placeholder="AF/BC" style="display:none"></select>
										</div>
										<div id="gifcargando1" style="display:none" align="center">
											<img src="../dist/img/cargando-loading.gif" style="max-width: 25px; max-height: 25px" alt="cargando-loading-037.gif">
										</div>
									</div>
								</div>

								<div class="col-md-12"></div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="cmbareas" class="control-label" id="cmbareasLabel" style="font-size: 11px;">Ubicación primaria(571)</label>
										<input type="text" class="form-control" placeholder="Ubicación primaria" id="txt_ubic_primaria" readonly="readonly">
									</div>
									<div class="form-group">
										<label for="cmbareas" class="control-label" id="cmbareasLabel" style="font-size: 11px;">Ubicación secundaria</label>	
										<input type="text" class="form-control" placeholder="Ubicación secundaria" id="txt_ubic_secundaria" readonly="readonly">
									</div>
									<div class="form-group">
										<label for="cmbareas" class="control-label" id="cmbareasLabel" style="font-size: 11px;">Marca</label>		
										<input type="text" class="form-control" placeholder="Marca" id="txt_marca" readonly="readonly">
									</div>
									<div class="form-group">
										<label for="cmbareas" class="control-label" id="cmbareasLabel" style="font-size: 11px;">Modelo</label>
										<input type="text" class="form-control" placeholder="Modelo" id="text_Modelo" readonly="readonly">
									</div>


								</div><!-- columna#1 -->
								<input type="hidden" class="form-control" id="txt_Id_Activo" readonly="readonly">	
								<div class="col-md-4">
									<div class="form-group">
										<label for="cmbareas" class="control-label" id="cmbareasLabel" style="font-size: 11px;">Nombre Activo</label>	
										<input type="text" class="form-control" placeholder="Nombre" id="txt_Nom_Activo" readonly="readonly">
									</div>
									<div class="form-group">
										<label for="cmbareas" class="control-label" id="cmbareasLabel" style="font-size: 11px;">No. Serie</label>	
										<input type="text" class="form-control" placeholder="No. de serie" id="text_No_Serie" readonly="readonly">
									</div>
									<div class="form-group">
										<label for="cmbareas" class="control-label" id="cmbareasLabel" style="font-size: 11px;">Nombre Equipo</label>
										<textarea rows="1" class="form-control" placeholder="Descripción Corta" id="text_Desc_Corta" readonly="readonly"></textarea>
									</div>
									<div class="form-group">
										<label for="cmbareas" class="control-label" id="cmbareasLabel" style="font-size: 11px;">Ubicación</label>
										<textarea rows="1" class="form-control" placeholder="Ubicación Especifica" id="text_Ubicacion_Especifica" readonly="readonly"></textarea>
									</div>
									<div class="form-group" style="display:none">
										<label class="control-label" id="cmbareasLabel" style="font-size: 11px;">AF/BC</label>
										<input type="text" class="form-control" placeholder="AF/BC" id="text_AFBC" readonly="readonly">
									</div>
									<div class="form-group" style="display:none">
										<label class="control-label" id="cmbareasLabel" style="font-size: 11px;">Usuario Responsable</label>
										<input type="text" class="form-control" placeholder="Usuario Resp." id="text_Usr_Resp" readonly="readonly">
									</div>
									<div class="form-group" style="display:none">
										<label class="control-label" id="cmbareasLabel" style="font-size: 11px;">Id Usuario</label>
										<input type="text" class="form-control" placeholder="Id Usuario" id="text_Id_Usuario" readonly="readonly">
									</div>
								</div><!-- columna#2 -->
								<div class="col-md-4">
									<label for="cmbareas" class="control-label" id="cmbareasLabel" style="font-size: 11px;">Foto</label>
									<div class="form-group" id="Imagen_Activo">
										<img src="../dist/img/no-camera.png" style="width: 150px; height: 150px;">
									</div>
								</div><!-- columna#2 -->
							</div>
						</div>
					</div>

					<div class="row gray nm">
						<div class="col-md-12">

							<div class="col-md-4">
								<div class="form-group">
									<label for="siga_rutinasGet" class="control-label" style="font-size: 11px;">Rutina:639</label><br>
										<select id="cmbRutinas"></select>
								</div>
							</div>

							<div class="col-md-2">
								<div class="form-group">
									<label for="cmbareas" class="control-label" id="cmbareasLabel" style="font-size: 11px;">Fecha:</label>									
									<input type="date" class="form-control" name="siga_fecha_programada" id="siga_fecha_programada" min="<?php echo date('Y-m-d', strtotime("+1 day"));?>">
								</div>
							</div>

							<div class="col-md-2">
								<div class="form-group">
									<label for="cmbareas" class="control-label" id="cmbareasLabel" style="font-size: 11px;">Frecuencia</label>
									<select class="form-control" id="siga_frecuencia">
										<option value="2">Mensual</option>
										<option value="3">Bimestral</option>
										<option value="4">Trimestral</option>
										<option value="5">Cuatrimestral</option>
										<option value="6">Semestral</option>
										<option value="7">Anual</option>
									</select>
								</div>								
							</div>

							<div class="col-md-2">
								<div class="form-group">
										<label for="cmbareas" class="control-label" id="cmbareasLabel" style="font-size: 11px;">Realiza</label>
										<select class="form-control" id="siga_realiza">
											<option value="0">Interno</option>
											<option value="1">Externo</option>
										</select>
								</div>
							</div>

							<div class="col-md-2">
								<div class="form-group">
									<center>
										<label for="cmbareas" class="control-label" id="cmbareasLabel" style="font-size: 11px;">Vincular Mesa</label><br>
										<input type="checkbox" class="form-checkbox" name="vincular_a_mesa_ayuda" id="vincular_a_mesa_ayuda">
									</center>
								</div>
							</div>

						</div>
					</div>

				</form>	
			</div>

			<div class="modal-footer">
				<center><button type="button" class="btn chs" id="btn_guardar">Guardar(691)</button></center>
			<br>
				<table id="tablaDetalleActividades" width="100%" class="table table-striped" style="text-align: left;">
					<thead>
						<tr>
							<th width="2%" data-orderable="false">Orden</th>
							<th width="45%" data-orderable="false">Actividad</th>
							<th width="35%" data-orderable="false">Valor Referencia</th>
							<th width="10%" data-orderable="false">Valor Medio</th>
							<th width="10%" data-orderable="false">Adjunto</th>
						</tr>
					</thead>
				</table>
			</div>

		</div>
	</div>
</div>

<!-- ==== Sección Modal Mto Preventivo Reprogramar Inicio ======================================================================================================================== -->
<!-- ==== Sección Modal Mto Preventivo Reprogramar Inicio ======================================================================================================================== -->

<div class="modal fade modalchs" id="modalCalendarioDetalle" data-backdrop="false" >
	<div class="modal-dialog modal-xl">
		<div class="modal-content">

				<div class="modal-header azul">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>					
					<h4 class="modal-title">Mantenimiento Preventivo(719)</h4>
				</div>
				
				<div class="modal-body nopsides">

					<form>
					<div class="gray nm">
						<div class="row">
							<div class="col-md-10 col-md-offset-1">

								<div class="col-md-8">
									<div class="form-group">
										<div id="muestro_select">
											<span><font color="red">*</font></span>
											<label for="cmbareas" class="control-label" id="cmbareasLabel" style="font-size: 11px;">AF/BC-Activo</label>											
											<input type="text" class="form-control" placeholder="Activo" id="AF_BC_detalle" readonly="readonly">
										</div>
										<div id="gifcargando1" style="display:none" align="center">
											<img src="../dist/img/cargando-loading.gif" style="max-width: 25px; max-height: 25px" alt="cargando-loading-037.gif">
										</div>
									</div>
								</div>

								<div class="col-md-12"></div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="cmbareas" class="control-label" id="cmbareasLabel" style="font-size: 11px;">Ubicación primaria</label>
										<input type="text" class="form-control" placeholder="Ubicación primaria" id="ubic_primaria_detalle" readonly="readonly">
									</div>
									<div class="form-group">
										<label for="cmbareas" class="control-label" id="cmbareasLabel" style="font-size: 11px;">No. Serie</label>	
										<input type="text" class="form-control" placeholder="No. de serie" id="No_Serie_detalle" readonly="readonly">
									</div>

									<div class="form-group">
										<label for="cmbareas" class="control-label" id="cmbareasLabel" style="font-size: 11px;">Marca</label>		
										<input type="text" class="form-control" placeholder="Marca" id="marca_detalle" readonly="readonly">
									</div>

									<div class="form-group">
										<label for="cmbareas" class="control-label" id="cmbareasLabel" style="font-size: 11px;">Fecha Programada</label>
										<input type="date" class="form-control" name="siga_fecha_programada" id="fecha_programada_detalle" readonly="readonly" >
									</div>

									<div class="form-group">
										<label for="cmbareas" class="control-label" id="cmbareasLabel" style="font-size: 11px;">Rutina</label>
										<input type="text" class="form-control" placeholder="Rutina" id="rutina_detalle" readonly="readonly">
									</div>

								</div><!-- columna#1 -->
								<input type="hidden" class="form-control" id="txt_Id_Activo" readonly="readonly">	
								<div class="col-md-4">
									<div class="form-group">
										<label for="cmbareas" class="control-label" id="cmbareasLabel" style="font-size: 11px;">Ubicación secundaria</label>	
										<input type="text" class="form-control" placeholder="Ubicación secundaria" id="ubic_secundaria_detalle" readonly="readonly">
									</div>
									<div class="form-group">
										<label for="cmbareas" class="control-label" id="cmbareasLabel" style="font-size: 11px;">Modelo</label>
										<input type="text" class="form-control" placeholder="Modelo" id="modelo_detalle" readonly="readonly">
									</div>
									<div class="form-group">
										<label for="cmbareas" class="control-label" id="cmbareasLabel" style="font-size: 11px;">Ubicación</label>
										<textarea rows="1" class="form-control" placeholder="Ubicación Especifica" id="ubicacion_especifica_detalle" readonly="readonly"></textarea>
									</div>
									<div class="form-group">
										<label for="cmbareas" class="control-label" id="cmbareasLabel" style="font-size: 11px;">Fecha a reprogramada</label>									
										<input type="date" class="form-control" name="fecha_reprogramada_detalle" id="fecha_reprogramada_detalle" onkeypress="return false;" min="<?php echo date('Y-m-d', strtotime("+1 day"));?>">
									</div>
									<div class="form-group">
										<label for="cmbareas" class="control-label" id="cmbareasLabel" style="font-size: 11px;">Id Actividad</label>									
										<input type="text" class="form-control" placeholder="Id Operación" id="id_actividad_detalle" readonly="readonly">
									</div>
								</div>
								<div class="col-md-4">
									<label for="cmbareas" class="control-label" id="cmbareasLabel" style="font-size: 11px;">Foto</label>
									<div class="form-group" id="Imagen_Activo_detalle">
										<img src="../dist/img/no-camera.png" style="width: 150px; height: 150px;">
									</div>
								</div>
							</div>
						</div>						
					</div>
				</form>	
			</div>

			<div class="modal-footer">
				<center>
					<button type="button" class="btn chs" id="btnActividadReprogramar">Guardar nueva fecha</button>
					<button type="button" class="btn btn-danger" id="btnActividadCancelar">Cancelar Actividad</button>
				</center>
			<br>
				<table id="modalDetalleActividades" width="100%" class="table table-striped" style="text-align: left;">
					<thead>
						<tr>
							<th width="2%" data-orderable="false">Orden</th>
							<th width="43%" data-orderable="false">Actividad</th>
							<th width="35%" data-orderable="false">Valor Referencia</th>
							<th width="10%" data-orderable="false">Valor Medio</th>
							<th width="10%" data-orderable="false">Adjunto</th>
						</tr>
					</thead>
				</table>
			</div>

		</div>
	</div>
</div>

<!-- ==== Sección Modal Mto Preventivo Reprogramar Inicio ======================================================================================================================== -->
<!-- ==== Sección Modal Mto Preventivo Reprogramar Inicio ======================================================================================================================== -->

<div class="modal fade modalchs" id="modalDetalleRutina" data-backdrop="false" >
	<div class="modal-dialog modal-xl">
		<div class="modal-content">

				<div class="modal-header azul">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>					
					<h4 class="modal-title">Mantenimiento Preventivo(763)</h4>
				</div>
				
				<div class="modal-body nopsides"></div>

			<div class="modal-footer">
				<table id="tablaSoloDetalleActividades" width="100%" class="table table-striped" style="text-align: left;">
					<thead>
						<tr>
							<th width="2%" 	data-orderable="false">Orden</th>
							<th width="43%" data-orderable="false">Actividad</th>
							<th width="35%" data-orderable="false">Valor Referencia</th>
							<th width="10%" data-orderable="false">Valor Medio</th>
							<th width="10%" data-orderable="false">Adjunto</th>
						</tr>
					</thead>
				</table>
			</div>

		</div>
	</div>
</div>

<!-- ==== Sección Modal Mto Preventivo Reprogramar Inicio ======================================================================================================================== -->
<!-- ==== Sección Modal Mto Preventivo Reprogramar Inicio ======================================================================================================================== -->

<script src="funciones_actividades.js"></script>

	<script type="text/javascript">
		let Id_area = $("#idareasesion").val();
		$(document).ready(function(){

			$('#agnioGlobal').val(<?php echo date("Y"); ?>);
			fnMtoPreventivoNuevo();
			fnMtoPreventivoNuevoPendientes();
			
			$('#loadingState').hide();
			cmbGestorFuncion();
			cmbRutinasArea();

			url_direccion = "../Archivos/Archivos-Actividades/Mantenimiento-Preventivo";
			Estatus_Tipo_Actividad = 2;
			autocomplete_activos();
			/*Inicia Controles Busqueda*/
			autocomplete_activos_search();
			/*Fin*/
			//cmb_rutina(2);
			//cmb_frecuencia();
			cmb_gestores();
			cmb_ejecutantes();
			cmbUbiPrimaria(Id_area);
			cmbAgnioVigentes(Id_area);
			cmbActivosArea(Id_area);
			cmbMesesVigentes();
			//generarUnicamenteCalendario();
			// Genera la consulta del mantenimento del mes
			//reporteMantenimientoMes();
			//reporteMantenimientoPendiente();

//============================================================================================================================================================================================//
//============================================================================================================================================================================================//

$('#btnActividadReprogramar').on('click',function(){

let fecha_reprogramada_detalle	= $('#fecha_reprogramada_detalle').val();
let id_actividad_detalle				= $('#id_actividad_detalle').val();
let validar 										= true;
let Id_Usuario 									= $('#usuariosesion').val();

if(fecha_reprogramada_detalle == ''){
	$.alert({
    title: 'Campo Obligatorio',
    content: 'Fecha a reprogramada',
		type: 'red',
		icon: 'fa fa-warning',
	})
	validar = false;
} else if(id_actividad_detalle=='' && fecha_reprogramada_detalle==''){
	$.alert({
    title: 'Operación sin éxito',
    content: 'Contacte a sistemas',
		type: 'red',
		icon: 'fa fa-warning',
	})
	validar = false;
}

if(validar){

	$.confirm({
					title: 'Confirmar cambio de fecha',
					content: '¿Deseas cambiar la fecha de la actividad?',
					type: 'dark',
					icon: 'fa fa-warning',
					buttons: {						
						Confirmar: function () {

							$.ajax({
								type: "POST",
								url: "/siga/class/biomedica/mtoPreventivo/mtoPreventivo.ajax.php",
								data: {accion:6,
											fecha_reprogramada_detalle:fecha_reprogramada_detalle,
											id_actividad_detalle:id_actividad_detalle,
											Id_Usuario:Id_Usuario},
								dataType: "JSON",
								beforeSend: function(){
									jsShowWindowLoad('Procesando...');
								},
								success: function (response) {									
									$('#calendarioNuevo').fullCalendar('destroy');
									calendarioNuevo();
									$('#modalCalendarioDetalle').modal('hide');										
									jsRemoveWindowLoad();
									fnMtoPreventivoNuevo();
								},
								error:function(response){									
									alert(response);
									jsRemoveWindowLoad();
								}
							});

						},
						Cerrar: function () {

						}
					}
				});

		}
});

//============================================================================================================================================================================================//
//============================================================================================================================================================================================//

$('#btnActividadCancelar').on('click',function(){

	let fecha_reprogramada_detalle 	= $('#fecha_reprogramada_detalle').val();
	let id_actividad_detalle				= $('#id_actividad_detalle').val();
	let validar 									= true;
	let Id_Usuario 								= $('#usuariosesion').val();

	$.confirm({
			title: 'SIGA',
			content: '¿Deseas cancelar la fecha de la actividad?',
			type: 'red',
			icon: 'fa fa-warning',
			buttons: {						
				Confirmar: function () {
					
					$.ajax({
						type: "POST",
						url: "/siga/class/biomedica/mtoPreventivo/mtoPreventivo.ajax.php",
						data: {accion:7,
									texto_fecha_programada:fecha_reprogramada_detalle,
									texto_id_actividad:id_actividad_detalle,
									Id_Usuario:Id_Usuario
						},
						dataType: "JSON",
						beforeSend: function(){
							jsShowWindowLoad('Procesando');
						},
						success: function (response) {
							$('#calendarioNuevo').fullCalendar('destroy');
							calendarioNuevo();
							sigaTablaGlobal();
							fnMtoPreventivoNuevo();
							$('#modalCalendarioDetalle').modal('hide');										
							jsRemoveWindowLoad();
						},
						error:function(){
							jsRemoveWindowLoad();
						}
					});

				},
				Cerrar: function () {
				}
			}
		});

});

//============================================================================================================================================================================================//
//============================================================================================================================================================================================//

	$('#btn_guardar').on('click', function(){	

		$("#btn_guardar").prop("disabled", true);

		let validar 							= true;
		let select_activos 				= $('#select-activos').val();
		let siga_rutinasGet 			= $('#cmbRutinas').val();
		let siga_rutinasGetNombre = $('#cmbRutinas').text();
		let siga_fecha_programada	= $('#siga_fecha_programada').val();
		let siga_frecuencia				= $('#siga_frecuencia').val();
		let siga_realiza					= $('#siga_realiza').val();
		let vincular_a_mesa_ayuda	= $('#vincular_a_mesa_ayuda').is(':checked');
		let Id_Usuario 						= $('#usuariosesion').val();		
		
		if(select_activos == ''){
			alerta('error', 'Obligatorio: seleccionar activo.');						
			validar = false;
		} else if(siga_rutinasGet == -1){
			alerta('error', 'Obligatorio: seleccionar Rutina.');						
			validar = false;
		} else if(siga_fecha_programada == ''){
			alerta('error', 'Obligatorio: Seleccionar Fecha a programar.');						
			validar = false;
		} 
		
		if(vincular_a_mesa_ayuda == false){
			vincular_a_mesa_ayuda=0;
		} else {
			vincular_a_mesa_ayuda=1;
		}

		if(validar){

			$.ajax({
				type: "POST",
				url: "/siga/class/biomedica/rutinas/rutinas.ajax.php",
				data: {accion:10, select_activos:select_activos, 
							siga_rutinasGet:siga_rutinasGet,
							siga_fecha_programada:siga_fecha_programada, 
							siga_frecuencia:siga_frecuencia, siga_realiza:siga_realiza, 
							vincular_a_mesa_ayuda:vincular_a_mesa_ayuda,
							siga_rutinasGetNombre:siga_rutinasGetNombre,
							Id_Usuario:Id_Usuario},
				dataType: "JSON",
				cache: false,
				async: false,
				beforeSend:function(){
					$('#loadingState').show();
				},
				success: function (response) {					
					$('#Actividades_Activo_Fijo').modal('hide');
					$('#loadingState').hide();
					calendarioNuevo();
					sigaTablaGlobal();
					fnMtoPreventivoNuevo();
				},
				error: function(response){
					$('#loadingState').hide();
					alert('error: Contacte a Sistemas.');
				}
			});

		}

	});

//============================================================================================================================================================================================//
//============================================================================================================================================================================================//

$('#cmbRutinas').on('change', function(){

	let idRutina = $('#cmbRutinas').val();

	$.ajax({
		type: "POST",
		url: "/siga/class/catalogos/catalogos.ajax.php",
		data: {accion: 3, idRutina:idRutina},
		dataType: "JSON",
		cache: false,
		async: false,
		beforeSend: function (){

		},
		success: function (response) {

  $('#tablaDetalleActividades').dataTable( {
                data : response,
                destroy:true,
                processing: true,
								pageLength: 10,
								lengthMenu: [[10, 10, 20, -1], [10, 10, 20, "Todos"]],
                columns: [
										{"data" : "siga_cat_sort"},
                    {"data" : "siga_cat_rutinas_act_desc"},
                    {"data" : "siga_cat_rutinas_act_valor_ref"},
                    {"data" : "valor"},
                    {"data" : "adjunto"},
                ],
                language: {
									        "sProcessing": "Procesando...",
									        "sLengthMenu": "Mostrar _MENU_ registros",
									        "sZeroRecords": "No se encontraron resultados",
									        "sEmptyTable": "Ningún dato disponible en esta tabla",
									        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
									        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
									        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
									        "sInfoPostFix": "",
									        "sSearch": "Buscar:",
									        "sUrl": "",
									        "sInfoThousands": ",",
									        "sLoadingRecords": "Cargando...",
									        "oPaginate": {
									        "sFirst": "Primero",
									        "sLast": "Último",
									        "sNext": "Siguiente",
									        "sPrevious": "Anterior"
									        },
									        "oAria": {
									        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
									        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
									        }
									    },
            
            });

		},
		error: function(){

		}
	});

});

//============================================================================================================================================================================================//
//============================================================================================================================================================================================//

$('#cmbclase').on('change', function(){

	let idClase = $('#cmbclase').val();

	$.ajax({
		type: "POST",
		url: "/siga/class/catalogos/catalogos.ajax.php",
		data: {accion: 4, idClase:idClase},
		dataType: "JSON",
		cache: false,
		async: false,
		beforeSend: function (){

		},
		success: function (response) {
			$('#cmbclasificacion').html(response);
		},
		error: function(){

		}
	});

});

//============================================================================================================================================================================================//
//============================================================================================================================================================================================//

$('#cmbfamilia').on('change', function(){

	let idFamilia = $('#cmbfamilia').val();

	$.ajax({
		type: "POST",
		url: "/siga/class/catalogos/catalogos.ajax.php",
		data: {accion: 5, idFamilia:idFamilia},
		dataType: "JSON",
		cache: false,
		async: false,
		beforeSend: function (){
		},
		success: function (response) {
			$('#cmbsubfamilia').html(response);
		},
		error: function(){
		}
	});

});

//============================================================================================================================================================================================//
//============================================================================================================================================================================================//

$('#ubi_primaria_calendario').on('change', function(){

	let Id_Ubic_Prim = $('#ubi_primaria_calendario').val();

		$.ajax({
			type: "POST",
			url: "/siga/class/catalogos/catalogos.ajax.php",
			data: {accion: 7, Id_Ubic_Prim:Id_Ubic_Prim},
			dataType: "JSON",
			cache: false,
			async: false,
			beforeSend: function (){
			},
			success: function (response) {			
				$('#ubi_Secundaria_calendario').html(response);
			},
			error: function(){
			}
		});

});

//============================================================================================================================================================================================//
//============================================================================================================================================================================================//

$('#btn_buscar_full_calendar').on('click', function(){

let id_activo									= $('#activoCalendario').val();
let txt_Rutina_Search					= $('#txt_Rutina_Search').val();
let txt_Desc_Corta_Search			= $('#txt_Desc_Corta_Search').val();
let agnio_vigente							= $('#agnio_vigente').val();
let mes_vigente 							= $("#meses_vigente").val();
let ubi_primaria_calendario		= $('#ubi_primaria_calendario').val();
let ubi_Secundaria_calendario	= $('#ubi_Secundaria_calendario').val();
let Id_area 									= $("#idareasesion").val();


		$.ajax({
			type: "POST",
			url: "/siga/class/admin/mantenimientoPreventivo/mantenimientoPreventivo.ajax.php",
			data: {accion: 7, 
						id_activo:id_activo, txt_Rutina_Search:txt_Rutina_Search, 
						txt_Desc_Corta_Search:txt_Desc_Corta_Search, agnio_vigente:agnio_vigente, 
						ubi_primaria_calendario:ubi_primaria_calendario, ubi_Secundaria_calendario:ubi_Secundaria_calendario,
						mes_vigente:mes_vigente, Id_area:Id_area},
			dataType: "JSON",
			cache: false,
			async: false,
			beforeSend: function (){
			},
			success: function (response) {							
				$('#respuestaBusquedaNueva').html(response);
				$('#respuestaBusquedaNueva').show();
			},
			error: function(){
			}
		});

	});

//============================================================================================================================================================================================//
//============================================================================================================================================================================================//

});//END

//============================================================================================================================================================================================//
//============================================================================================================================================================================================//

		confirmacion_cerrar_mant_prev = function(id_modal) {
			let cmbRutinas = $('#cmbRutinas').val();

			<?php if (isset($_GET["abriractivo"])) {?>
				mensajesalerta("SIGA:", "Debes Crear el mantenimiento Preventivo.", "error", "dark");
			<?php }
			else { ?>
				$.confirm({
					icon: 'fa fa-warning',
					title: 'Confirmar',
					type: 'red',					
					content: '¿Deseas salir sin guardar la información?',
					buttons: {
						Aceptar: function () {
							$('.modal-backdrop').remove();//eliminamos el backdrop del modal
							$('#'+id_modal+'').modal('hide');
							$('#Estatus_Guardar').val("");
							$('#texto_fecha_reprogramada').val('');
						},
						cancel: function () {

						}
					}
				});
			<?php	} ?>
			
		}

//============================================================================================================================================================================================//
//============================================================================================================================================================================================//

		// Función que carga el Mantenimiento pendiente del mes anterior hacia atrás
		function reporteMantenimientoPendiente() {
			// // Calcula las nuevas fechas para generar la consulta
			// // Fecha de inicio y fin del mes actual
			// var PeriodoTiempoInicio = "<?php echo(date('01/m/Y')); ?>"; //$("#PeriodoTiempoInicio").val();
			// var PeriodoTiempoFinal = "<?php echo(date('t/m/Y')); ?>"; //$("#PeriodoTiempoFinal").val();
			
			// // Calcula el periodo de tiempo desde el ultimo día del mes anterior hasta 6 meses atrás
			// PeriodoTiempoInicio = moment(PeriodoTiempoInicio, "DD/MM/YYYY").add(-6, "M").format("DD/MM/YYYY");
			// PeriodoTiempoFinal = moment(PeriodoTiempoFinal, "DD/MM/YYYY").add(-1, "M").format("DD/MM/YYYY");

			// // Recolecta los parametros a enviar
			// var strJsonParametros = { "accion": "mantenimientoPendiente", "Id_Area": $("#idareasesion").val(), "PeriodoTiempoInicio": PeriodoTiempoInicio, "PeriodoTiempoFinal": PeriodoTiempoFinal, "Modo_Opcion": 2, "lstFiltrosMantenimiento_tmp":  $("#lstFiltrosMantenimiento_tmp").val() };
			// // Recupera los filtros guarados previamente en los campos hidden
			// if($("#cmbubicacionprim_mensual_tmp").val() != -1) { strJsonParametros.Id_Ubic_Prim = $("#cmbubicacionprim_mensual_tmp").val(); }				// Ubicación Primaria
			// if($("#cmbubicacionsec_mensual_tmp").val() != -1) { strJsonParametros.Id_Ubic_Sec = $("#cmbubicacionsec_mensual_tmp").val(); }					// Ubicación Secundaria
			// if($("#cmbclase_mensual_tmp").val() != -1) { strJsonParametros.Id_Clase = $("#cmbclase_mensual_tmp").val(); }									// Clase
			// if($("#cmbclasificacion_mensual_tmp").val() != -1) { strJsonParametros.Id_Clasificacion = $("#cmbclasificacion_mensual_tmp").val(); }			// Clasificación
			// if($("#cmbfamilia_mensual_tmp").val() != -1) { strJsonParametros.Id_Familia = $("#cmbfamilia_mensual_tmp").val(); }								// Familia
			// if($("#cmbsubfamilia_mensual_tmp").val() != -1) { strJsonParametros.Id_Subfamilia = $("#cmbsubfamilia_mensual_tmp").val(); }					// SubFamilia
			// if($.trim($("#select-activos-search-mensual_tmp").val()) != "") { strJsonParametros.Id_Activo = $("#select-activos-search-mensual_tmp").val(); }	// Activo
			
			// // Genera la consulta
			// jQuery("#mantenimientoPendientesContenedor").html('<div style="padding: 2em 1em;"><div class="progress"><div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width:100%"></div></div></div>');
			// jQuery("#mantenimientoPendientesContenedor").load("../controladores/simple_mvc/ActivoActividadesController.Class.php", strJsonParametros, function (response, status, xhr) {
			// 	if (status == "error") {
			// 		var msg = "Sorry but there was an error: ";
			// 		mensajesalerta("Informaci&oacute;n", msg + xhr.status + " " + xhr.statusText, "error", "dark");
			// 	}
			// });
		}


//============================================================================================================================================================================================//
//============================================================================================================================================================================================//

		function restablecerFiltros() {
			// Restablece los combos select primarios
			$("#cmbubicacionprim_mensual").val(-1);
			$("#cmbclase_mensual").val(-1);
			$("#cmbfamilia_mensual").val(-1);
			$("#select-activos-search-mensual")[0].selectize.clear();
			// Restablece los combos select dependientes
			cambioUbicacionPrimaria($("#cmbubicacionprim_mensual"));
			cambioClase($("#cmbclase_mensual"));
			cambioFamilia($("#cmbfamilia_mensual"));
			fnMtoPreventivoNuevo();
		}

//============================================================================================================================================================================================//
//============================================================================================================================================================================================//

function sigaTablaGlobal(agnioActual=""){
		$('#sigaTableGlobalTbody').html('');
		$("#agnioGlobalLi").html($('#agnioGlobal').val());
		$('#spanFechaGlobal').html(<?php echo date("Y"); ?>);

		let Id_Area 								= $("#idareasesion").val();
		let id_Activo 							= $('#select-activos-search-global').val();
		let cmbubicacionprim 				= $('#cmbubicacionprim').val();
		let cmbubicacionsec 				= $('#cmbubicacionsec').val();
		let cmbclase 								= $('#cmbclase').val();
		let cmbclasificacion  			= $('#cmbclasificacion').val();
		let cmbfamilia 							= $('#cmbfamilia').val();
		let cmbsubfamilia 					= $('#cmbsubfamilia').val();
		let selectUsuarios    			= $('#select-usuarios').val();
		let text_Modelo_Global 			= $('#text_Modelo_Global').val();
		let text_Marca_Global 			= $('#text_Marca_Global').val();
		let text_Nombre_Rutina 			= $('#text_Nombre_Rutina').val();
		let textDescripcionCorta 		= $('#text_Descripcion_Corta').val();
		let cmbOdernAscDesc 				= $('#cmbOdernAscDesc').val();
		let cmbGestor 							= $('#cmbGestor').val();
		let validar 								= true;

		if(agnioActual==""){
			agnioActual = $("#agnioGlobal").val();
		}

		// if(agnioActual==""){
		// 	if($("#agnioGlobal").val()==""){				
		// 		$("#agnioGlobal").val(anio_global_actual);
		// 		$("#agnioGlobalLi").html(anio_global_actual);
		// 	} else {
		// 		agnioActual = $("#agnioGlobal").val();
		// 		$("#agnioGlobalLi").html(anio_global_actual);
		// 	}
		// }

		$.ajax({
			type: "POST",
			url: "/siga/class/admin/mantenimientoPreventivo/mantenimientoPreventivo.ajax.php",
			data: {	accion:1, agnioActual:agnioActual, id_Activo:id_Activo,
							cmbubicacionprim:cmbubicacionprim, cmbubicacionsec:cmbubicacionsec,
							cmbclase:cmbclase, cmbclasificacion:cmbclasificacion, cmbfamilia:cmbfamilia,
							cmbsubfamilia:cmbsubfamilia, selectUsuarios:selectUsuarios, text_Modelo_Global:text_Modelo_Global,
							text_Marca_Global:text_Marca_Global, text_Nombre_Rutina:text_Nombre_Rutina, textDescripcionCorta:textDescripcionCorta,
							cmbGestor:cmbGestor, cmbOdernAscDesc:cmbOdernAscDesc,Id_Area:Id_Area},
			dataType: "JSON",
			async: false,
			cache: false,
			beforeSend: function(){
				$('#loadingState').show();
			},
			success: function (response) {
				$('#sigaTableGlobalTbody').html(response);
				$('#loadingState').hide();
			},
			error: function(response){
				$('#loadingState').hide();
			}
		});

}

//============================================================================================================================================================================================//
//============================================================================================================================================================================================//

	global_siguiente_nuevo=function(){ 
		var val_actual=$("#agnioGlobal").val();
		if(val_actual!=""){
			val_actual=parseInt(val_actual)+1;
			$("#agnioGlobal").val(val_actual);
			$("#agnioGlobalLi").html(val_actual);
			sigaTablaGlobal(val_actual);
		}
	}

//============================================================================================================================================================================================//
//============================================================================================================================================================================================//

	global_anterior_nuevo=function(){		
		var val_actual=$("#agnioGlobal").val();
		if(val_actual!=""){
			val_actual=val_actual-1;
			$("#agnioGlobal").val(val_actual);
			$("#agnioGlobalLi").html(val_actual);
			sigaTablaGlobal(val_actual);
		}
	}

//============================================================================================================================================================================================//
//============================================================================================================================================================================================//

	function cmbGestorFuncion(){
		let Id_Area=$("#idareasesion").val();

		$.ajax({
			type: "POST",
			url: "/siga/class/catalogos/catalogos.ajax.php",
			data: {accion:1, Id_Area:Id_Area},
			dataType: "JSON",
			cache:false,
			async: false,			
			success: function (response) {
				$('#cmbGestor').html(response);				
			},
			error: function(response){
				alert('SIGA: No se cargo de manera adecuada los gestores'+response);
			}

		});

	}

//============================================================================================================================================================================================//
//============================================================================================================================================================================================//

function cmbRutinasArea(){

	let Id_Area=$("#idareasesion").val();

		$.ajax({
			type: "POST",
			url: "/siga/class/catalogos/catalogos.ajax.php",
			data: {accion:2, Id_Area:Id_Area},
			dataType: "JSON",
			cache:false,
			async: false,			
			success: function (response) {
				$('#cmbRutinas').html(response);
				$('#cmbRutinas').selectize();
			},
			error: function(response){
				alert('SIGA: No se cargo de manera adecuada las rutinas'+response);
			}

		});
}

//============================================================================================================================================================================================
//============================================================================================================================================================================================

	function calendarioNuevo() {

	let activoCalendarioSel = $('#activoCalendario')[0].selectize;
  		activoCalendarioSel.setValue('-1');

	let ubi_primariaSel 		= $('#ubi_primaria_calendario')[0].selectize;
			ubi_primariaSel.setValue('-1');
	
		// let ubi_SecundariaSel 		= $('#ubi_Secundaria_calendario')[0].selectize;
		// 	ubi_SecundariaSel.setValue('-1');

	let agnio_vigenteSel 		= $('#agnio_vigente')[0].selectize;
			agnio_vigenteSel.setValue('-1');	

		$('#respuesta_busqueda').hide();
		$('#calendarioNuevo').show();
		$('#fecha_reprogramada_detalle').val('');
	
	let tgl 	= $('#calendarioNuevo').fullCalendar('getDate');
	let agnio	= moment(tgl).format('YYYY');
		
	setTimeout(function() {

				 $('#calendarioNuevo').fullCalendar({				
					header: {
						left: 'prev,next today',
						center: 'title',
						right: 'year,month,basicWeek,basicDay',
						editable: false,
					},
					buttonText: {
						today: 'Actual',
						year: 'Año',
						month: 'Mes',
						basicWeek: 'Semana',
						basicDay: 'Dia'
					},
//============================================================================================================================================================================================
					events:function(start, end, timezone, callback) {
						
							let tgl 		= $('#calendarioNuevo').fullCalendar('getDate');
							let agnio		= moment(tgl).format('YYYY');
							let Id_Area = $("#idareasesion").val();	

								$.ajax({
										type: "POST",
										url: "/siga/class/admin/mantenimientoPreventivo/mantenimientoPreventivo.ajax.php",
										data: {accion:2, agnio:agnio, Id_Area:Id_Area},
										dataType: "JSON",
										cache: false,
										async: false,
										success: function (response) {
											callback(response);
										},
										error: function(){
											alert('SIGA: Error al cargar la actividad');
										}
									});

						},
//============================================================================================================================================================================================
				eventRender: function(event, element) {           
					$(element).tooltip({title: event.title});
				},

//============================================================================================================================================================================================
					eventClick:function(calEvent,jsEvent,view){		

						$.confirm({
							title: 'SIGA:',
							type: 'red',
							icon: 'fa fa-warning',
							content: '¿Desea modificar la actividad?',
							buttons: {

								Modificar: function () {

									$.ajax({
										type: "POST",
										url: "/siga/class/admin/mantenimientoPreventivo/mantenimientoPreventivo.ajax.php",
										data: {accion:3, idActividad:calEvent.idActividad},
										dataType: "JSON",
										cache: false,
										async: false,
										beforeSend:function(){
											$('#loadingState').show();
										},
										success: function (response) {
											$('#AF_BC_detalle').val(response.activo);
											$('#ubic_primaria_detalle').val(response.uPrimaria);
											$('#ubic_secundaria_detalle').val(response.uSecundaria);
											$('#No_Serie_detalle').val(response.NumSerie);
											$('#marca_detalle').val(response.Marca);
											$('#fecha_programada_detalle').val(response.fechaProgramada);
											$('#rutina_detalle').val(response.rutina);							
											$('#modelo_detalle').val(response.Modelo);
											$('#ubicacion_especifica_detalle').val(response.Especifica);
											$('#id_actividad_detalle').val(response.idActividad);
											$('#Imagen_Activo_detalle').val(response.Foto);
											detalleRutina(response.idRutina);
											$('#loadingState').hide();
											$('#modalCalendarioDetalle').modal('show');
											if(response.Estatus_Proceso != 0){
												$('#btnActividadReprogramar').attr("disabled", true);
												$('#btnActividadCancelar').attr("disabled", true);
											}else{
												$('#btnActividadReprogramar').attr("disabled", false);
												$('#btnActividadCancelar').attr("disabled", false);
											}
																				
										},
										error: function(){
											$('#loadingState').hide();										
											alert('SIGA: Error al cargar la actividad');
										}
									});

									
								},
								Cerrar: function () {
							},
							}
						});
					},
					
//============================================================================================================================================================================================
				showNonCurrentDates: false,
				height: 650,//"auto"
				eventLimit: true,
				defaultView: 'year',
				}
				
			),100});
		
	}
//============================================================================================================================================================================================//
//============================================================================================================================================================================================//

function modalDetalleDeRutina(idRutina){
	$.ajax({
		type: "POST",
		url: "/siga/class/catalogos/catalogos.ajax.php",
		data: {accion: 3, idRutina:idRutina},
		dataType: "JSON",
		cache: false,
		async: false,
		beforeSend: function (){$('#loadingState').show();},
		success: function (response) {
	$('#loadingState').hide();

  $('#tablaSoloDetalleActividades').dataTable( {
                data : response,
                destroy:true,
                processing: true,
								pageLength: 10,
								lengthMenu: [[10, 10, 20, -1], [10, 10, 20, "Todos"]],
                columns: [									
										{"data" : "siga_cat_sort"},
                    {"data" : "siga_cat_rutinas_act_desc"},
                    {"data" : "siga_cat_rutinas_act_valor_ref"},
                    {"data" : "valor"},
                    {"data" : "adjunto"},
                ],
                language: {
									        "sProcessing": "Procesando...",
									        "sLengthMenu": "Mostrar _MENU_ registros",
									        "sZeroRecords": "No se encontraron resultados",
									        "sEmptyTable": "Ningún dato disponible en esta tabla",
									        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
									        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
									        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
									        "sInfoPostFix": "",
									        "sSearch": "Buscar:",
									        "sUrl": "",
									        "sInfoThousands": ",",
									        "sLoadingRecords": "Cargando...",
									        "oPaginate": {
									        "sFirst": "Primero",
									        "sLast": "Último",
									        "sNext": "Siguiente",
									        "sPrevious": "Anterior"
									        },
									        "oAria": {
									        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
									        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
									        }
									    },
            
            });

		},
		error: function(){
			$('#loadingState').hide();
		}
	});
	$('#modalDetalleRutina').modal('show');
}

//============================================================================================================================================================================================//
//============================================================================================================================================================================================//

function detalleRutina(idRutina){

		$.ajax({
		type: "POST",
		url: "/siga/class/catalogos/catalogos.ajax.php",
		data: {accion: 3, idRutina:idRutina},
		dataType: "JSON",
		cache: false,
		async: false,
		beforeSend: function (){$('#loadingState').show();},
		success: function (response) {
	$('#loadingState').hide();

  $('#modalDetalleActividades').dataTable( {
                data : response,
                destroy:true,
                processing: true,
								pageLength: 10,
								lengthMenu: [[10, 10, 20, -1], [10, 10, 20, "Todos"]],
                columns: [
										{"data" : "siga_cat_sort"},
                    {"data" : "siga_cat_rutinas_act_desc"},
                    {"data" : "siga_cat_rutinas_act_valor_ref"},
                    {"data" : "valor"},
                    {"data" : "adjunto"},
                ],
                language: {
									        "sProcessing": "Procesando...",
									        "sLengthMenu": "Mostrar _MENU_ registros",
									        "sZeroRecords": "No se encontraron resultados",
									        "sEmptyTable": "Ningún dato disponible en esta tabla",
									        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
									        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
									        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
									        "sInfoPostFix": "",
									        "sSearch": "Buscar:",
									        "sUrl": "",
									        "sInfoThousands": ",",
									        "sLoadingRecords": "Cargando...",
									        "oPaginate": {
									        "sFirst": "Primero",
									        "sLast": "Último",
									        "sNext": "Siguiente",
									        "sPrevious": "Anterior"
									        },
									        "oAria": {
									        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
									        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
									        }
									    },
            
            });

		},
		error: function(){
			$('#loadingState').hide();
		}
	});
}

//============================================================================================================================================================================================//
//============================================================================================================================================================================================//

function fnMtoPreventivoNuevo(incrementoTiempo = null){

	let cmbubicacionprim_mensual 			= $('#cmbubicacionprim_mensual').val();
	let cmbubicacionsec_mensual				= $('#cmbubicacionsec_mensual').val();
	let cmbclase_mensual 							= $('#cmbclase_mensual').val();
	let cmbclasificacion_mensual 			= $('#cmbclasificacion_mensual').val();
	let cmbfamilia_mensual 						= $('#cmbfamilia_mensual').val();
	let cmbsubfamilia_mensual 				= $('#cmbsubfamilia_mensual').val();
	let selectActivosSearchMensual 		= $('#select-activos-search-mensual').val();
	let Id_Area 											= $("#idareasesion").val();
	var PeriodoTiempoInicio 					= $("#PeriodoTiempoInicio").val();
	var PeriodoTiempoFinal 						= $("#PeriodoTiempoFinal").val();
	
	//alert(cmbclasificacion_mensual);

	if (incrementoTiempo != null) {
		PeriodoTiempoInicio = moment(PeriodoTiempoInicio, "DD/MM/YYYY").add(incrementoTiempo, "M").format("DD/MM/YYYY");				
		PeriodoTiempoFinal = moment(PeriodoTiempoFinal, "DD/MM/YYYY").add(incrementoTiempo, "M").endOf("month").format("DD/MM/YYYY");
	}
	else {				
		PeriodoTiempoInicio = moment().startOf('month').format("DD/MM/YYYY");
		PeriodoTiempoFinal 	= moment().endOf('month').format("DD/MM/YYYY");
	}

	$("#PeriodoTiempoInicio").val(PeriodoTiempoInicio);
	$("#PeriodoTiempoFinal").val(PeriodoTiempoFinal);

	const fechaInicial 	= $("#PeriodoTiempoInicio").val();
	const momentObject 	= moment(fechaInicial, "DD/MM/YYYY");
	const formatoMes 		= momentObject.format("MMMM/YYYY");
	$('#fechaVigente').html(formatoMes);

	$.ajax({
			type: "POST",
			url: "/siga/class/admin/mantenimientoPreventivo/mantenimientoPreventivo.ajax.php",
			data: {accion:4,Id_Area:Id_Area, fchInicio:PeriodoTiempoInicio, cmbubicacionprim_mensual:cmbubicacionprim_mensual, 
						cmbubicacionsec_mensual:cmbubicacionsec_mensual, cmbclase_mensual:cmbclase_mensual, cmbclasificacion_mensual:cmbclasificacion_mensual,
						cmbfamilia_mensual:cmbfamilia_mensual, cmbsubfamilia_mensual:cmbsubfamilia_mensual, selectActivosSearchMensual:selectActivosSearchMensual},
			dataType: "JSON",
			cache: false,
			async: false,
			success: function (response) {
				$('#mtoPreventivoNuevo').html(response);					
			},
			error: function(){
				alert('SIGA: Error al cargar la actividad');
			}
		});

}

//============================================================================================================================================================================================//
//============================================================================================================================================================================================//

function fnMtoPreventivoNuevoPendientes(incrementoTiempo = null){

	let cmbubicacionprim_mensual 			= $('#cmbubicacionprim_mensual').val();
	let cmbubicacionsec_mensual				= $('#cmbubicacionsec_mensual').val();
	let cmbclase_mensual 							= $('#cmbclase_mensual').val();
	let cmbclasificacion_mensual 			= $('#cmbclasificacion_mensual').val();
	let cmbfamilia_mensual 						= $('#cmbfamilia_mensual').val();
	let cmbsubfamilia_mensual 				= $('#cmbsubfamilia_mensual').val();
	let selectActivosSearchMensual 		= $('#select-activos-search-mensual').val();
	let Id_Area 											= $("#idareasesion").val();
	var PeriodoTiempoInicio 					= $("#PeriodoTiempoInicio").val();
	var PeriodoTiempoFinal 						= $("#PeriodoTiempoFinal").val();
	
	if (incrementoTiempo != null) {
		PeriodoTiempoInicio = moment(PeriodoTiempoInicio, "DD/MM/YYYY").add(incrementoTiempo, "M").format("DD/MM/YYYY");				
		PeriodoTiempoFinal = moment(PeriodoTiempoFinal, "DD/MM/YYYY").add(incrementoTiempo, "M").endOf("month").format("DD/MM/YYYY");
	}
	else {				
		PeriodoTiempoInicio = moment().startOf('month').format("DD/MM/YYYY");
		PeriodoTiempoFinal 	= moment().endOf('month').format("DD/MM/YYYY");
	}

	$("#PeriodoTiempoInicio").val(PeriodoTiempoInicio);
	$("#PeriodoTiempoFinal").val(PeriodoTiempoFinal);

	const fechaInicial 	= $("#PeriodoTiempoInicio").val();
	const momentObject 	= moment(fechaInicial, "DD/MM/YYYY");
	const formatoMes 		= momentObject.format("MMMM/YYYY");
	//$('#fechaVigente').html(formatoMes);

	$.ajax({
			type: "POST",
			url: "/siga/class/admin/mantenimientoPreventivo/mantenimientoPreventivo.ajax.php",
			data: {accion:6,Id_Area:Id_Area, fchInicio:PeriodoTiempoInicio, cmbubicacionprim_mensual:cmbubicacionprim_mensual, 
						cmbubicacionsec_mensual:cmbubicacionsec_mensual, cmbclase_mensual:cmbclase_mensual, cmbclasificacion_mensual:cmbclasificacion_mensual,
						cmbfamilia_mensual:cmbfamilia_mensual, cmbsubfamilia_mensual:cmbsubfamilia_mensual, selectActivosSearchMensual:selectActivosSearchMensual},
			dataType: "JSON",
			cache: false,
			async: false,
			success: function (response) {				
				$('#mtoPreventivoNuevoPendientes').html(response);					
			},
			error: function(){
				alert('SIGA: Error al cargar la actividad Pendientes');
			}
		});

}

//============================================================================================================================================================================================//
//============================================================================================================================================================================================//

function mtoPreventivo(idActividad){
	$('#modalCalendarioDetalle').modal('show');

			$.ajax({
				type: "POST",
				url: "/siga/class/admin/mantenimientoPreventivo/mantenimientoPreventivo.ajax.php",
				data: {accion:3, idActividad:idActividad},
				dataType: "JSON",
				cache: false,
				async: false,
				beforeSend:function(){
					$('#loadingState').show();
				},
				success: function (response) { 
					$('#AF_BC_detalle').val(response.activo);
					$('#ubic_primaria_detalle').val(response.uPrimaria);
					$('#ubic_secundaria_detalle').val(response.uSecundaria);
					$('#No_Serie_detalle').val(response.NumSerie);
					$('#marca_detalle').val(response.Marca);
					$('#fecha_programada_detalle').val(response.fechaProgramada);
					$('#rutina_detalle').val(response.rutina);							
					$('#modelo_detalle').val(response.Modelo);
					$('#ubicacion_especifica_detalle').val(response.Especifica);
					$('#id_actividad_detalle').val(response.idActividad);
					$('#Imagen_Activo_detalle').val(response.Foto);
					detalleRutina(response.idRutina);
					$('#loadingState').hide();
					$('#modalCalendarioDetalle').modal('show');						
						
						$('#btnActividadReprogramar').attr("disabled", false);						
						$('#btnActividadCancelar').attr("disabled", false);

						if(response.tkEstatus_Reg == 0){
								$('#btnActividadReprogramar').attr("disabled", false);
								$('#btnActividadCancelar').attr("disabled", false);
						}
													
				},
				error: function(){
					$('#loadingState').hide();										
					alert('SIGA: Error al cargar la actividad');
				}
		});

}

//============================================================================================================================================================================================//
//============================================================================================================================================================================================//

function borrarModalMtoPreventivo(){
	$("#btn_guardar").prop("disabled", false);
	$('#txt_ubic_primaria').val('');
	$('#txt_ubic_secundaria').val('');
	$('#txt_marca').val('');
	$('#text_Modelo').val('');
	$('#txt_Nom_Activo').val('');
	$('#text_No_Serie').val('');
	$('#text_Desc_Corta').val('');
	$('#text_Ubicacion_Especifica').val('');
	$('#text_AFBC').val('');
	$('#siga_fecha_programada').val('');
	$('#Imagen_Activo').html('<img src="../dist/img/no-camera.png" style="width: 150px; height: 150px;">');
  let selectizeInstance = $('#cmbRutinas')[0].selectize;
  selectizeInstance.setValue('-1');
  let selectizeIns = $('#select-activos')[0].selectize;
  selectizeIns.setValue('-1');
	let selectizeMes = $('#meses_vigente')[0].selectize;
  selectizeMes.setValue('-1');
	
}

//============================================================================================================================================================================================//
//============================================================================================================================================================================================//

function cmbUbiPrimaria(Id_area){

	$.ajax({
		type: "POST",
		url: "/siga/class/catalogos/catalogos.ajax.php",
		data: {accion: 6, Id_area:Id_area},
		dataType: "JSON",
		cache: false,
		async: false,
		beforeSend: function (){
		},
		success: function (response) {			
			$('#ubi_primaria_calendario').html(response);
			$('#ubi_primaria_calendario').selectize({});
		},
		error: function(){
		}
	});

}

//============================================================================================================================================================================================//
//============================================================================================================================================================================================//

function cmbActivosArea(Id_area){

	$.ajax({
		type: "POST",
		url: "/siga/class/catalogos/catalogos.ajax.php",
		data: {accion: 8, Id_area:Id_area},
		dataType: "JSON",
		cache: false,
		async: false,
		beforeSend: function (){
		},
		success: function (response) {			
			$('#activoCalendario').html(response);
			$('#activoCalendario').selectize({});
		},
		error: function(){
		}
	});

}

//============================================================================================================================================================================================//
//============================================================================================================================================================================================//
function cmbAgnioVigentes(Id_area){

	$.ajax({
		type: "POST",
		url: "/siga/class/catalogos/catalogos.ajax.php",
		data: {accion: 9, Id_area:Id_area},
		dataType: "JSON",
		cache: false,
		async: false,
		beforeSend: function (){
		},
		success: function (response) {			
			$('#agnio_vigente').html(response);
			$('#agnio_vigente').selectize({});
		},
		error: function(){
		}
	});

}

//============================================================================================================================================================================================//
//============================================================================================================================================================================================//
function cmbMesesVigentes(){

	$.ajax({
		type: "POST",
		url: "/siga/class/catalogos/catalogos.ajax.php",
		data: {accion: 10},
		dataType: "JSON",
		cache: false,
		async: false,
		beforeSend: function (){
		},
		success: function (response) {			
			$('#meses_vigente').html(response);
			$('#meses_vigente').selectize({});			
		},
		error: function(){
		}
	});

}

//============================================================================================================================================================================================//
//============================================================================================================================================================================================//
</script>