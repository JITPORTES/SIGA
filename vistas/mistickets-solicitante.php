<?php
	session_start();
		$Direccion_Ip_Sol="";
		$Direccion_Ip_Sol= $_SERVER["REMOTE_ADDR"];
		$Espacios="";
		include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/archivosComunes.php");
?>
	<input type="hidden" id="Direccion_Ip_Sol" value="<?php echo $Direccion_Ip_Sol;?>">
	<input type="hidden" id="No_Empleado_chat" >	
	<input type="hidden" id="Id_Solicitud">
	<input type="hidden" id="Id_Cirugia">

<!-- ============================================================================================================================================================================================================ -->
<!-- ============================================================================================================================================================================================================ -->
<?php
		include_once($_SERVER["DOCUMENT_ROOT"]."/siga/vistas/mistickets-solicitante/tablero01.com.php");
?>
<!-- ============================================================================================================================================================================================================ -->
<!-- ============================================================================================================================================================================================================ -->
<?php
		include_once($_SERVER["DOCUMENT_ROOT"]."/siga/vistas/mistickets-solicitante/tablero02.com.php");
?>
<!-- ============================================================================================================================================================================================================ -->
<!-- ============================================================================================================================================================================================================ -->

<?php
		include_once($_SERVER["DOCUMENT_ROOT"]."/siga/vistas/mistickets-solicitante/tablero03.com.php");
?>

<!-- ============================================================================================================================================================================================================ -->
<!-- ============================================================================================================================================================================================================ -->
		
<?php
		include_once($_SERVER["DOCUMENT_ROOT"]."/siga/vistas/mistickets-solicitante/tablero04.com.php");
?>

<!-- ============================================================================================================================================================================================================ -->
<!-- ============================================================================================================================================================================================================ -->

<?php
		include_once($_SERVER["DOCUMENT_ROOT"]."/siga/vistas/mistickets-solicitante/tablero05.com.php");
?>

<!-- ============================================================================================================================================================================================================ -->
<!-- ============================================================================================================================================================================================================ -->
	  
<?php
		include_once($_SERVER["DOCUMENT_ROOT"]."/siga/vistas/mistickets-solicitante/tablero06.com.php");
?>

<!-- ============================================================================================================================================================================================================ -->
<!-- ============================================================================================================================================================================================================ -->

<script>

	var archivos_adjuntos="";
	var imagenes_adjuntos="";
	var cont_ticket_biomedica=0;
	var cont_ticket_tic=0;
	var cont_ticket_mantenimiento=0;
	var cont_ticket_mob_equi=0;
	var cont_ticket_juridico=0;
	var array_img=["PNG", "JPG", "BMP", "GIF"];
	var array_arch=["PDF", "DOCX", "DOC", "XLS","XLSX", "PPT","PPTX"];

//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

	function imagenes_chat(){
		$("#url_documentos_adjuntos_chat").val("");
		$("#adjunto_imagenes").html('<input name="imagenes[]" type="file" multiple="multiple" class="file-loading" id="upload_adjuntos_chat">');
		carga_arch_mesa("upload_adjuntos_chat", "url_documentos_adjuntos_chat","../Archivos/Archivos-Chat/",true,false);
	}

//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

  $(".upload-files").fileinput({
    browseClass: "btn chs",
    language: 'es',
    allowedFileExtensions : ['jpg','png'],
  });

//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

  $(".upload-simple").fileinput({
    browseClass: "btn chs",
    language: 'es',
  });

//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

   function guardaRespuestaP1(valor)
   {
	  $("#hddP1").val(valor);
   }
   
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

   function guardaRespuestaP2(valor)
   {
	  $("#hddP2").val(valor);
   }
   
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

   function guardaRespuestaP3(valor)
   {
	  $("#hddP3").val(valor);
   }
  
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

   function carga_tabla_activos(Id_Area){
		var table = $('#tablaactivos').DataTable();
		
		table.destroy();
		$('#tablaactivos').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": { 
				"url": "../fachadas/activos/siga_activos/Siga_activosFacade.Class.php",
				"type": "POST",
				"data": {
					orden:'AF_BC',
					Num_Empleado: $("#nousuariosesion").val(),
					Id_Area:Id_Area
				}
			},
			"columns": [
				{ "data": "AF_BC", "visible": false},
				{ "data": "AF_BC"},
				{
					"data": function (obj) {
						var foto = '';
						if ($.trim(obj.Foto) != '')
						foto += '<img src="../Archivos/Archivos-Activos/' + obj.Foto + '">';
						return foto;
					}
				},
				{ "data": "Nombre_Activo"},
				{
					"data": function (obj) {
						var edicion = '';
						edicion += '<div align="center"><input type="radio" name="radio_activos" onclick="selec_activo_radio(\'radio'+obj.Id_Activo+'\',\''+obj.Id_Activo+'\')" id="radio'+obj.Id_Activo+'"></div>';
						return edicion;
					}
				}
				
			], "language": {
				"lengthMenu": "Mostrando _MENU_ registros por p&aacute;gina",
				"zeroRecords": "Sin Resultados",
				"info": "Monstrando p&aacute;gina _PAGE_ de _PAGES_ , total de registros: _MAX_",
				"infoEmpty": "Sin Resultados",
				"infoFiltered": "(Mostrando  _MAX_ del total de registros)",
				"search": "Busqueda: ",
				"paginate": {
					"first": "Primera",
					"last": "Ultima",
					"next": "Siguiente",
					"previous": "Anterior"
				}
			}
		});
	
	
	}

//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

	var estatus_activos=new Array();
	carga_estatus_activos();
	function carga_estatus_activos() {
		var Solo_Juridico="";
		data={
			accion: "consultar",
			Estatus_Reg:"1",
			Solo_Juridico:Solo_Juridico
			//,Id_Area:$("#idareasesion").val()
		};
		estatus_activos=cargo_cmb("../fachadas/activos/siga_cat_estatus/Siga_cat_estatusFacade.Class.php",false, data);
  }
		
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

   function carga_activos_vip(activos){
		var num_empleado="";
		
		if(activos=="mis_activos"){
			num_empleado=$("#nousuariosesion").val();
		}
		
		if(num_empleado!=0||activos!="mis_activos"){
		
			$.ajax({
				type: "POST",
				url: "../fachadas/activos/siga_activos/Siga_activosFacade.Class.php",     
				async: false,
				data: {
					Num_Empleado: num_empleado,
					Estatus_Reg:"1",
					Id_Area:$("#hddArea").val(),
					soloactivos:"1",
					accion: "Tabla_Activos_Asis_Esp"
				},
				dataType: "html",
				beforeSend: function (xhr) {
			
				},
				success: function (data) {
					data = eval("(" + data + ")");
					
					if (data.totalCount > 0) {
						$("#div_tablaactivos").html("");
						var tabla="";
						tabla+='<table id="tablaactivos" class="table table-bordered table-striped table-chs">';
						tabla+='	<thead>';
						tabla+='	<tr>';
						tabla+='		<th>AF/BC</th>';
						tabla+='		<th>Responsable Activo</th>';
						tabla+='		<th>Nombre Activo</th>';
						tabla+='		<th>Marca</th>';
						tabla+='		<th>Modelo</th>';
						tabla+='		<th>No. Serie</th>';
						tabla+='		<th>Ubic. Primaria</th>';
						tabla+='		<th>Ubic. Secundaria</th>';
						tabla+='		<th>Elegir y cambiar Estatus del Activo</th>';
						tabla+='	</tr>';
						tabla+='	</thead>'; 
						tabla+='	<tbody>';
						for(var i=0;i<data.totalCount; i++)
						{
							tabla+='<tr>';
							tabla+=' <td class=" ">'+data.data[i].AF_BC+'</td>';
							tabla+=' <td class=" ">'+data.data[i].Nombre_Responsable+'</td>';
							tabla+=' <td class=" ">'+data.data[i].Nombre_Activo+'</td>';
							tabla+=' <td class=" ">'+data.data[i].Marca+'</td>';
							tabla+=' <td class=" ">'+data.data[i].Modelo+'</td>';
							tabla+=' <td class=" ">'+data.data[i].NumSerie+'</td>';
							tabla+=' <td class=" ">'+data.data[i].Desc_Ubic_Prim+'</td>';
							tabla+=' <td class=" ">'+data.data[i].Desc_Ubic_Sec+'</td>';
							//tabla+=' <td class=" "><div align="center"><input type="radio" name="radio_activos" onclick="selec_activo_radio(\'radio'+data.data[i].Id_Activo+'\',\''+data.data[i].Id_Activo+'\')" id="radio'+data.data[i].Id_Activo+'"></div></td>';
							tabla+=' <td class=" "><div align="center"><input type="radio" name="radio_activos" onclick="selec_activo_radio(\'radio'+data.data[i].Id_Activo+'\',\''+data.data[i].Id_Activo+'\',\''+data.data[i].Id_Situacion_Activo+'\')" id="radio'+data.data[i].Id_Activo+'"><br><select style="display:none" class="form-control" name="EstatusActivocmb" id="cmbestatusActivo_'+data.data[i].Id_Activo+'"></select></div></td>';
							tabla+='</tr>';
						}
						tabla+='	</tbody>'; 
						tabla+='</table>';	
						
						$("#div_tablaactivos").html(tabla);
						
						$('#tablaactivos').DataTable({
							"language": {
								"lengthMenu": "Mostrando _MENU_ registros por p&aacute;gina",
								"zeroRecords": "Sin Resultados",
								"info": "Monstrando p&aacute;gina _PAGE_ de _PAGES_ , total de registros: _MAX_",
								"infoEmpty": "Sin Resultados",
								"infoFiltered": "(Monstrando  _MAX_ del total de registros)",
								"search": "Busqueda: ",
								"paginate": {
									"first": "Primera",
									"last": "Ultima",
									"next": "Siguiente",
									"previous": "Anterior"
								}
							}
						});	
					}else{
						$("#div_tablaactivos").html("<label>No se Encontraron Activos</label>");						
					}
										
				},
				error: function () {
					mensajesalerta("SIGA:", "Ocurrio un error al guardar.", "error", "dark");
				}
			});
		}else{
			$("#div_tablaactivos").html("<label>No se Encontraron Activos</label>");
		}
	}

//=======================================================================================================================================================================================================
//=======================================================================================================================================================================================================	

   $(document).ready(function(){		

		//Carga combobox tipo valde de resguardo
		cambiaArea(2);
		var tab_activex=0;
		var cont_recarga_dat_tabl=0;
		var estatus_tickets="";
		
		//Guardar Registros
		$("#solicitar").click(function () { 
			var Agregar = true;
			var mensaje_error = "";
			var strDatos="";			
			var Id_Solicitud=$.trim($("#Id_Solicitud").val());
			var Id_Activo=$("#hidden_seleccion_activo").val();
			var Id_Estatus_Activo=$("#cmbestatusActivo_"+Id_Activo).val();						
			var Id_Usuario=$("#usuariosesion").val();			
			var Id_Area=$("#hddArea").val();
			var Seccion="";
			var Titulo=$.trim($("#desc_titulo").val());
			//var Id_Categoria=$("#cmb_categoria").val();
			var Desc_Categoria=$.trim($("#Descripcion_ticket").val());
			var Prioridad="";
			var Url_archivo="";
			var Foto=$.trim($("#Url_Foto_Activo").val());			
			var Id_Solicitud_Correo="";
			 
			Seccion=$("#hddSeccion").val();				
			
			if(cont_ticket_biomedica>0&&Id_Area==1){
				Agregar = false;
				mensaje_error += " -Para generar un nuevo ticket, debes cerrar los que se encuentran en la pestaña por cerrar.<br />";
				$("#mensaje_cerrados").html("<h3><font color='red'>Para generar un nuevo ticket, debes cerrar los que se encuentran en la pestaña por cerrar.</font></h3>");
			}else{
				if(cont_ticket_tic>0&&Id_Area==2){
						Agregar = false;
						mensaje_error += " -Para generar un nuevo ticket, debes cerrar los que se encuentran en la pestaña por cerrar.<br />";
						$("#mensaje_cerrados").html("<h3><font color='red'>Para generar un nuevo ticket, debes cerrar los que se encuentran en la pestaña por cerrar.</font></h3>");
				}else{
					if(cont_ticket_mantenimiento>0&&Id_Area==3){
							Agregar = false;
							mensaje_error += " -Para generar un nuevo ticket, debes cerrar los que se encuentran en la pestaña por cerrar.<br />";
							$("#mensaje_cerrados").html("<h3><font color='red'>Para generar un nuevo ticket, debes cerrar los que se encuentran en la pestaña por cerrar.</font></h3>");
					}else{
						if(cont_ticket_mob_equi>0&&Id_Area==4){
								Agregar = false;
								mensaje_error += " -Para generar un nuevo ticket, debes cerrar los que se encuentran en la pestaña por cerrar.<br />";
								$("#mensaje_cerrados").html("<h3><font color='red'>Para generar un nuevo ticket, debes cerrar los que se encuentran en la pestaña por cerrar.</font></h3>");
						}else{
							if(cont_ticket_juridico>0&&Id_Area==6){
									Agregar = false;
									mensaje_error += " -Para generar un nuevo ticket, debes cerrar los que se encuentran en la pestaña por cerrar.<br />";
									$("#mensaje_cerrados").html("<h3><font color='red'>Para generar un nuevo ticket, debes cerrar los que se encuentran en la pestaña por cerrar.</font></h3>");
							}else{
								$("#mensaje_cerrados").html("");
								$("#desc_titulo").prop( "disabled", false );
								$("#Descripcion_ticket").prop( "disabled", false );
								$("#solicitar").prop( "disabled", false );
							
								if (Id_Area.length <= 0) {
									Agregar = false; 
									mensaje_error += " -Falta elegir el área (Biomedica, TIC, etc)<br />";									
								}
								
								if (Seccion.length <= 0) {
									Agregar = false; 
									mensaje_error += " -Falta elegir la sección<br />";
									$("#desc_titulo").focus();
								}
								
								if (Titulo.length <= 0) {
									Agregar = false; 
									mensaje_error += " -Falta agregar el T&iacute;tulo<br />";
									$("#desc_titulo").focus();
								}
								
								//if (Id_Categoria == "-1") {
								//	Agregar = false; 
								//	mensaje_error += " -Falta agregar el Motivo del Reporte<br />";
								//	$("#cmb_categoria").focus();
								//}
								
								if (Desc_Categoria.length <= 0) {
									Agregar = false; 
									mensaje_error += " -Falta agregar la descripci&oacute;n del Ticket<br />";
									$("#Descripcion_ticket").focus();
								}
								/////////
								if($("#Check_Alta").is(':checked')) {  
									Prioridad="1";
								}
								
								if($("#Check_Media").is(':checked')) {  
									Prioridad="2";
								}
								
								if($("#Check_Poca").is(':checked')) {  
									Prioridad="3";
								}
								
								if (Prioridad.length <= 0) {
									Agregar = false; 
									mensaje_error += " -Selecciona la Prioridad<br />";
								}
								/////////
							}
						}
					}
				}
			}
			
			
			if (!Agregar) {
				mensajesalerta("Informaci&oacute;n", mensaje_error, "", "dark");			
			}
			
			if(Agregar)
			{
				strDatos = "Id_Usuario="+Id_Usuario; 
				strDatos += "&Id_Area="+Id_Area;
				strDatos += "&Id_Activo="+Id_Activo;
							//Medio= 5 (Web)
				strDatos += "&Id_Medio=5";
				strDatos += "&Seccion="+Seccion;
				strDatos += "&Titulo="+Titulo;
				strDatos += "&Estatus_Proceso=1";
				//strDatos += "&Id_Categoria="+Id_Categoria;
				strDatos += "&Desc_Motivo_Reporte="+Desc_Categoria;
				strDatos += "&Prioridad="+Prioridad;
				//strDatos += "&Url_archivo="+Url_archivo;
				strDatos += "&Url_archivo="+Foto;
				strDatos += "&Direccion_Ip_Sol="+$("#Direccion_Ip_Sol").val();
				if(Id_Solicitud.length <= 0){
					strDatos += "&Usr_Inser="+Id_Usuario;
					strDatos += "&Estatus_Reg=1";				
					strDatos += "&accion=guardar";
				}else{
					strDatos += "&Id_Solicitud="+Id_Solicitud;
					strDatos += "&Usr_Mod="+Id_Usuario;
					strDatos += "&Estatus_Reg=2";				
					strDatos += "&accion=guardar";
				}
				
				$.ajax({
					type: "POST",
					url: "../fachadas/activos/siga_solicitud_tickets/Siga_solicitud_ticketsFacade.Class.php",        
					async: false,
					data: strDatos,
					dataType: "html",
					beforeSend: function (xhr) {
						$("#solicitar").hide();
					},
					success: function (datos) {
						var json;
						json = eval("(" + datos + ")"); //Parsear JSON
						limpiarcampos();
						mensajesalerta("&Eacute;xito", "Generado Correctamente.", "success", "dark");
						$("#tab_Sin_Respuesta").click();						
						//$('#myModal').modal('hide');
						$('#display_sin_respuesta').DataTable().ajax.reload();
						$('#display_seguimiento').DataTable().ajax.reload();
						$('#display_por_cerrar').DataTable().ajax.reload();
						Id_Solicitud_Correo=json.data[0].Id_Solicitud;
						$("#tap_sin_respuesta").click();
						limpiarcampos();
						$("#solicitar").show();
						
						if(Id_Activo!=""){
							cambio_estatus_activo(Id_Activo, Id_Estatus_Activo);
						}
						console.log(datos);
					},
					error: function () {
						$("#solicitar").show();
						mensajesalerta("SIGA:", "Ocurrio un error al guardar.", "error", "dark");
					}
				});

			}
		});
		
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

		function cambio_estatus_activo(Id_Activo, Id_Estatus_Activo){
			var strDatos="";
			//Usuario Sesion
			var Id_Usuario=$("#usuariosesion").val();
			strDatos += "Id_Activo="+Id_Activo;
			strDatos += "&Id_Situacion_Activo="+Id_Estatus_Activo;
			strDatos += "&Usr_Mod="+Id_Usuario;
			strDatos += "&accion=cambiarestatusactivo";
			$.ajax({
				type: "POST",
				url: "../fachadas/activos/siga_solicitud_tickets/Siga_solicitud_ticketsFacade.Class.php",        
				async: false,
				data: strDatos,
				dataType: "html",
				beforeSend: function (xhr) {
					
				},
				success: function (datos) {
					$('select[name="EstatusActivocmb"] option').remove();
					$('select[name="EstatusActivocmb"]').hide();
				},
				error: function () {
					mensajesalerta("SIGA:", "Ocurrio un error al cambiar el estatus.", "error", "dark");
					$('select[name="EstatusActivocmb"] option').remove();
					$('select[name="EstatusActivocmb"]').hide();
				}
			});
		}
		
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

		//Tabla Sin Respuesta
		$('#display_sin_respuesta').DataTable({
			// Esqueleto del datatable completo (B: botones; l: longitud de cuantos resultados va a mostrar; f: filtros; <: agrega un div; "table-responsive" agrega la clase al div; t: tabla; >:cierra el div; i: información ; p: paginación)
			"dom": '<"row"<".col-md-12 text-center"B>><"row"<"col-md-6"l><"col-md-6"f>><"table-responsive"t>ip',
			// Celdas a exportar en el documento Excel, empezando por el indice 0
			// Elimina también clases que definen el botón
			"buttons": [{
				text: '<i class="fa fa-file-excel-o"></i> Exportar a Excel',
				className: 'btn chs export',
				extend: 'excelHtml5',
				init: function (api, node, config) {
					jQuery(node).removeClass('dt-button buttons-excel buttons-html5')
				},
				exportOptions: { columns: ['.columna-exportar-excel'] },
			}],
			"ordering": false,
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "../fachadas/activos/siga_solicitud_tickets/Siga_solicitud_ticketsFacade.Class.php",
				"type": "POST",
				"dataSrc": function ( json ) {
					if(json.recordsTotal>0){
						$("#notificacion_nuevos_t").show();
						$("#notificacion_nuevos_t").html(json.recordsTotal);
						$("#notificacionNuevos").show();
						$("#notificacionNuevos").html(json.recordsTotal);
					}else{
						$("#notificacion_nuevos_t").hide();
						$("#notificacionNuevos").hide();
					}
					return json.data;
				},
				"data": {
					orden:'AF_BC',
					Id_Usuario:$("#usuariosesion").val(),
					//Id_Area:$("#idareasesion").val(),
					Estatus_Proceso:'1'
				}
			},
			"columns": [
				{ "width": "5%", "data": function (obj) {
						var seguimiento = '';
						seguimiento += '<a href="#" data-toggle="modal" data-target="#seguimientoReporte" onclick="pasarvalores('+obj.Id_Solicitud+',1)"><span><i class="fa fa-pencil" aria-hidden="true"></i></span></a>';
						return seguimiento;
					}
				},
				{ "width": "5%", "data": "Id_Solicitud"},
				{ "width": "6%", "data": "Fecha"},
				{ "width": "6%", "data": function (obj) {
						
					
						var Estatus = '';
						
						if(obj.Asist_Especial=="1"){
							Estatus += 'Enviado ('+obj.A_Especial+')';
							Estatus="<font color='green' >"+Estatus+"</span>"; 
						}else{
							Estatus += obj.Estatus_Proceso;
						}
						return Estatus;
					}
				},
				{ "width": "5%","data": "Desc_Prioridad"},
				{ "width": "5%", "data": "Nombre_Seccion"},
				{ "width": "10%", "data": "Desc_Categoria"},
			    { "width": "10%", "data": "Desc_Subcategoria"},
				{ "width": "15%", "data": function (obj) {
						var Desc = '';
						Desc=obj.Titulo;
						
						return Desc;
					}
				},
				{ "width": "15%", "data": function (obj) {
						var Desc = '';
						if(obj.Id_Actividad!=""){
							Desc='<a href="#noir" id="Ver_Act'+obj.Id_Solicitud+'" onclick="ver_actividades('+obj.Id_Solicitud+')">Ver Actividades</a><a href="#noir" id="Ocult_Act'+obj.Id_Solicitud+'" onclick="ocult_actividades('+obj.Id_Solicitud+')" style="display:none">Ocultar Actividades</a><div id="Desc_Motiv_Repor'+obj.Id_Solicitud+'" style="display:none">'+obj.Desc_Motivo_Reporte+"</div>";							
						}else{
							Desc=obj.Desc_Motivo_Reporte;
						}
						
						if(obj.Asist_Especial=="1"){
							if(obj.Gestor!=null){
								Desc+="<br><font color='green' >[Gestor Reasignado: "+obj.Gestor+"]</font>"; 
							}
						}
						
						if(obj.Id_Gestor_Reasignado!=null){
							Desc+="<br><font color='green' >[Reasignado: "+obj.Nom_usr_reasignado+"]</font>"; 
						}
						return Desc;
					}
				
				},
				{ "width": "10%", "data": "Nom_Area"},
				
				
			], "language": {
				"lengthMenu": "Mostrando _MENU_ registros por p&aacute;gina",
				"zeroRecords": "Sin Resultados",
				"info": "Monstrando p&aacute;gina _PAGE_ de _PAGES_ , total de registros: _MAX_",
				"infoEmpty": "Sin Resultados",
				"infoFiltered": "(Monstrando  _MAX_ del total de registros)",
				"search": "Busqueda: ",
				"paginate": {
					"first": "Primera",
					"last": "Ultima",
					"next": "Siguiente",
					"previous": "Anterior"
				}
			}
		});
		
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

		//Tabla Seguimiento
		$('#display_seguimiento').DataTable({
			// Esqueleto del datatable completo (B: botones; l: longitud de cuantos resultados va a mostrar; f: filtros; <: agrega un div; "table-responsive" agrega la clase al div; t: tabla; >:cierra el div; i: información ; p: paginación)
			"dom": '<"row"<".col-md-12 text-center"B>><"row"<"col-md-6"l><"col-md-6"f>><"table-responsive"t>ip',
			// Celdas a exportar en el documento Excel, empezando por el indice 0
			// Elimina también clases que definen el botón
			"buttons": [{
				text: '<i class="fa fa-file-excel-o"></i> Exportar a Excel',
				className: 'btn chs export',
				extend: 'excelHtml5',
				init: function (api, node, config) {
					jQuery(node).removeClass('dt-button buttons-excel buttons-html5')
				},
				exportOptions: { columns: ['.columna-exportar-excel'] },
			}],
			"ordering": false,
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "../fachadas/activos/siga_solicitud_tickets/Siga_solicitud_ticketsFacade.Class.php",
				"type": "POST",
				"data": {
					orden:'AF_BC',
					Id_Usuario:$("#usuariosesion").val(),
					//Id_Area:$("#idareasesion").val(),
					Estatus_Proceso:'2'
				},
				"dataSrc": function ( json ) {					
   					//cont_ticket_tic=0;
					if(json.recordsTotal>0){
						$("#notificacion_seguimiento_t").show();
						$("#notificacion_seguimiento_t").html(json.recordsTotal);

						$("#notificacionSeguimiento").show();
						$("#notificacionSeguimiento").html(json.recordsTotal);

					}else{
						$("#notificacion_seguimiento_t").hide();
						$("#notificacionSeguimiento").hide();
					}
					return json.data;
   				}
				
			},
			"columns": [
				{ "width": "5%","data": function (obj) {
						var seguimiento = '';
						
						if(obj.Id_Estatus_Proceso==2){
							seguimiento = '<a href="#" data-toggle="modal" data-target="#seguimientoReporte" onclick="pasarvalores('+obj.Id_Solicitud+', 2)" data-toggle="tooltip" title="Chat"> <strong>Contestar </strong></a>';
						}
						
						return seguimiento;
					}
				},
				{ "width": "5%","data": "Id_Solicitud"},
				{ "width": "5%","data": "Fecha_Seguimiento"},
				{ "width": "6%","data": function (obj) {
						var Estatus_Proceso="";
						if(obj.Id_Estatus_Proceso==2){
							Estatus_Proceso = '<font>'+obj.Estatus_Proceso;
							
							if(obj.Asist_Especial=="1"){
								Estatus_Proceso += ' ('+obj.A_Especial+')'; 
							}
							Estatus_Proceso+='</font>';
						}
						
						return Estatus_Proceso;
					}
				
				},
				{ "width": "8%", "data": "Gestor"},
				{ "width": "5%","data": "Desc_Prioridad"},
				{ "width": "5%", "data": "Nombre_Seccion"},
				{ "width": "10%", "data": "Desc_Categoria"},
				{ "width": "10%", "data": "Desc_Subcategoria"},
				{ "width": "15%", "data": function (obj) {
						var Desc = '';
						
						Desc=obj.Titulo;
						
						return Desc;
					}
				},
				{ "width": "15%", "data": function (obj) {
						var Desc = '';
						if(obj.Id_Actividad!=""){
							Desc='<a href="#noir" id="Ver_Act'+obj.Id_Solicitud+'" onclick="ver_actividades('+obj.Id_Solicitud+')">Ver Actividades</a><a href="#noir" id="Ocult_Act'+obj.Id_Solicitud+'" onclick="ocult_actividades('+obj.Id_Solicitud+')" style="display:none">Ocultar Actividades</a><div id="Desc_Motiv_Repor'+obj.Id_Solicitud+'" style="display:none">'+obj.Desc_Motivo_Reporte+"</div>";
						}else{
							Desc=obj.Desc_Motivo_Reporte;
						}
						return Desc;
					}
				
				},
				{ "width": "4%", "data": "Nom_Area"}
				
			], "language": {
				"lengthMenu": "Mostrando _MENU_ registros por p&aacute;gina",
				"zeroRecords": "Sin Resultados",
				"info": "Monstrando p&aacute;gina _PAGE_ de _PAGES_ , total de registros: _MAX_",
				"infoEmpty": "Sin Resultados",
				"infoFiltered": "(Monstrando  _MAX_ del total de registros)",
				"search": "Busqueda: ",
				"paginate": {
					"first": "Primera",
					"last": "Ultima",
					"next": "Siguiente",
					"previous": "Anterior"
				}
			}
		});
		
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

		//Tabla por cerrar
		$('#display_por_cerrar').DataTable({
			"lengthMenu": [[200, 300, 500, -1], [200, 300, 500, "All"]],
			// Esqueleto del datatable completo (B: botones; l: longitud de cuantos resultados va a mostrar; f: filtros; <: agrega un div; "table-responsive" agrega la clase al div; t: tabla; >:cierra el div; i: información ; p: paginación)
			"dom": '<"row"<".col-md-12 text-center"B>><"row"<"col-md-6"l><"col-md-6"f>><"table-responsive"t>ip',
			// Celdas a exportar en el documento Excel, empezando por el indice 0
			// Elimina también clases que definen el botón
			"buttons": [{
				text: '<i class="fa fa-file-excel-o"></i> Exportar a Excel',
				className: 'btn chs export',
				extend: 'excelHtml5',
				init: function (api, node, config) {
					jQuery(node).removeClass('dt-button buttons-excel buttons-html5')
				},
				exportOptions: { columns: ['.columna-exportar-excel'] },
			}],
			"async": false,
			"ordering": false,
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "../fachadas/activos/siga_solicitud_tickets/Siga_solicitud_ticketsFacade.Class.php",
				"type": "POST",
				"data": {
					orden:'AF_BC',
					Id_Usuario:$("#usuariosesion").val(),
					//Id_Area:$("#idareasesion").val(),
					Estatus_Proceso:'3'
				},
				"dataSrc": function ( json ) {
   				cont_ticket_biomedica=0;
					cont_ticket_tic=0;
					cont_ticket_mantenimiento=0;
					cont_ticket_mob_equi=0;
					cont_ticket_juridico=0;
					cont_recarga_dat_tabl=cont_recarga_dat_tabl+1;
					if(json.recordsTotal>0){
						$("#notificacion_porcerrar_t").show();
						$("#notificacion_porcerrar_t").html(json.recordsTotal);
						//cont_ticket_tic=json.recordsTotal;/////

						for(var i=0; i<json.recordsTotal;i++){
							if(json.data[i].Id_Estatus_Proceso==3&&json.data[i].Id_Area==1){
								cont_ticket_biomedica=cont_ticket_biomedica+1;
							}
							if(json.data[i].Id_Estatus_Proceso==3&&json.data[i].Id_Area==2){
								cont_ticket_tic=cont_ticket_tic+1;
							}
							if(json.data[i].Id_Estatus_Proceso==3&&json.data[i].Id_Area==3){
								cont_ticket_mantenimiento=cont_ticket_mantenimiento+1;
							}
							if(json.data[i].Id_Estatus_Proceso==3&&json.data[i].Id_Area==4){
								cont_ticket_mob_equi=cont_ticket_mob_equi+1;
							}
							if(json.data[i].Id_Estatus_Proceso==3&&json.data[i].Id_Area==6){
								cont_ticket_juridico=cont_ticket_juridico+1;
							}
						}
					
						
					}else{
						$("#notificacion_porcerrar_t").hide();
					}
					
					if(cont_recarga_dat_tabl==1){
						msjticketscerrar();
					}
					
					return json.data;
   				}
				
			},
			"columns": [
				{ "width": "5%","data": function (obj) {
						var seguimiento = '';
						
						if(obj.Id_Estatus_Proceso==3){
							seguimiento = '<a href="#" data-toggle="modal" data-target="#seguimientoReporte" onclick="pasarvalores('+obj.Id_Solicitud+', 3)" data-toggle="tooltip" title="Calificar"><strong> Calificar </strong></a>';
						}
						
						
						return seguimiento;
					}
				},
				{ "width": "5%","data": "Id_Solicitud"},
				{"width": "5%","data": "Fecha"},
				{ "width": "5%","data": "Fecha_Esp_Cierre"},
				{ "width": "6%", "data": function (obj) {
						var Estatus_Proceso="";
						if(obj.Id_Estatus_Proceso==3){
							Estatus_Proceso = '<font color="red">'+obj.Estatus_Proceso;
						
							if(obj.Asist_Especial=="1"){
								Estatus_Proceso += ' ('+obj.A_Especial+')'; 
							}
							
							Estatus_Proceso+='</font>';
						}
						
						return Estatus_Proceso;
					}
				
				},
				{ "width": "8%", "data": "Gestor"},
				{ "width": "5%","data": "Desc_Prioridad"},
				{ "width": "5%", "data": "Nombre_Seccion"},
				{ "width": "10%", "data": "Desc_Categoria"},
				{ "width": "10%", "data": "Desc_Subcategoria"},
				{ "width": "15%", "data": function (obj) {
						var Desc = '';						
							Desc=obj.Titulo;
						return Desc;
					}
				},
				{ "width": "15%", "data": function (obj) {
						var Desc = '';
						if(obj.Id_Actividad!=""){
							Desc='<a href="#noir" id="Ver_Act'+obj.Id_Solicitud+'" onclick="ver_actividades('+obj.Id_Solicitud+')">Ver Actividades</a><a href="#noir" id="Ocult_Act'+obj.Id_Solicitud+'" onclick="ocult_actividades('+obj.Id_Solicitud+')" style="display:none">Ocultar Actividades</a><div id="Desc_Motiv_Repor'+obj.Id_Solicitud+'" style="display:none">'+obj.Desc_Motivo_Reporte+"</div>";
						}else{
							Desc=obj.Desc_Motivo_Reporte;
						}						
						return Desc;
					}				
				},
				{ "data": "ComentarioCierre"},
				{ "data": "Nom_Area"}
				
			], "language": {
				"lengthMenu": "Mostrando _MENU_ registros por p&aacute;gina",
				"zeroRecords": "Sin Resultados",
				"info": "Monstrando p&aacute;gina _PAGE_ de _PAGES_ , total de registros: _MAX_",
				"infoEmpty": "Sin Resultados",
				"infoFiltered": "(Monstrando  _MAX_ del total de registros)",
				"search": "Busqueda: ",
				"paginate": {
					"first": "Primera",
					"last": "Ultima",
					"next": "Siguiente",
					"previous": "Anterior"
				}
			}
		});
		
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

		//Tabla Cerrados
		$('#tablacerrado').DataTable({
			// Esqueleto del datatable completo (B: botones; l: longitud de cuantos resultados va a mostrar; f: filtros; <: agrega un div; "table-responsive" agrega la clase al div; t: tabla; >:cierra el div; i: información ; p: paginación)
			"dom": '<"row"<".col-md-12 text-center"B>><"row"<"col-md-6"l><"col-md-6"f>><"table-responsive"t>ip',
			// Celdas a exportar en el documento Excel, empezando por el indice 0
			// Elimina también clases que definen el botón
			"buttons": [{
				text: '<i class="fa fa-file-excel-o"></i> Exportar a Excel',
				className: 'btn chs export',
				extend: 'excelHtml5',
				init: function (api, node, config) {
					jQuery(node).removeClass('dt-button buttons-excel buttons-html5')
				},
				exportOptions: { columns: ['.columna-exportar-excel'] },
			}],
			"ordering": false,
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "../fachadas/activos/siga_solicitud_tickets/Siga_solicitud_ticketsFacade.Class.php",
				"type": "POST",
				"data": {orden:'AF_BC',
					Id_Usuario: $("#usuariosesion").val(),
					Estatus_Proceso:'4',
					Todos_Tickets: function() { return estatus_tickets; }
					
					
				}
			},
			"columns": [
				{
					"data": function (obj) {
						var seguimiento = '';
						seguimiento += '<a href="#" data-toggle="modal" id="cerrados'+obj.Id_Solicitud+'" data-target="#seguimientoReporte" onclick="pasarvalores('+obj.Id_Solicitud+', 3)"><span><i class="fa fa-pencil" aria-hidden="true"></i></span></a>';
						return seguimiento;
					}
				},
				{
					"data": function (obj) {
						var clip = '';
						clip += '<a target="_blank"  href="../controladores/activos/siga_solicitud_tickets/Reporte-Ticket.php?Id_Solicitud='+obj.Id_Solicitud+'" class="fa fa-paperclip" aria-hidden="true"></a>';
						return clip;
					}
				},
				{ "data": "Id_Solicitud"},
				{ "data": "Fecha_Cierre"},
				{	
					"data": function (obj) {
						var Estatus_Proceso="";	
						if(obj.Id_Estatus_Proceso==4){
							Estatus_Proceso = '<font color="green">'+obj.Estatus_Proceso;
						}
						
						if(obj.Asist_Especial=="1"){
							Estatus_Proceso += ' ('+obj.A_Especial+')'; 
						}
						Estatus_Proceso+='</font>';
						
						return Estatus_Proceso;
					}
				
				},
				{ "data": "Gestor"},
				{ "width": "5%","data": "Desc_Prioridad"},
				{ "data": "Nombre_Seccion"},
				{ "data": "Desc_Categoria"},
				{ "data": "Desc_Subcategoria"},
				{
					"data": function (obj) {
						var Desc = '';
						Desc=obj.Titulo;
						
						return Desc;
					}
				},
				{
				"data": function (obj) {
					var Desc = '';
					if(obj.Id_Actividad!=""){
						Desc='<a href="#noir" id="Ver_Act'+obj.Id_Solicitud+'" onclick="ver_actividades('+obj.Id_Solicitud+')">Ver Actividades</a><a href="#noir" id="Ocult_Act'+obj.Id_Solicitud+'" onclick="ocult_actividades('+obj.Id_Solicitud+')" style="display:none">Ocultar Actividades</a><div id="Desc_Motiv_Repor'+obj.Id_Solicitud+'" style="display:none">'+obj.Desc_Motivo_Reporte+"</div>";
					}else{
						Desc=obj.Desc_Motivo_Reporte;
					}
					return Desc;
				}
			
			},
				{ "data": "ComentarioCierre"},
				{ "data": "Nom_Area"}
				
			], "language": {
				"lengthMenu": "Mostrando _MENU_ registros por p&aacute;gina",
				"zeroRecords": "Sin Resultados",
				"info": "Monstrando p&aacute;gina _PAGE_ de _PAGES_ , total de registros: _MAX_",
				"infoEmpty": "Sin Resultados",
				"infoFiltered": "(Monstrando  _MAX_ del total de registros)",
				"search": "Busqueda: ",
				"paginate": {
					"first": "Primera",
					"last": "Ultima",
					"next": "Siguiente",
					"previous": "Anterior"
				}
			}
		});

//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

		todos_tickets=function(){
			
			if($("#todos_tickets").prop('checked')){
				estatus_tickets=1;
			}else{
				estatus_tickets="";
			}
			
			$('#tablacerrado').DataTable().ajax.reload();
		}
		
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================
		
		ver_actividades=function(Id_Solicitud){
			$("#Desc_Motiv_Repor"+Id_Solicitud).show();
			$("#Ver_Act"+Id_Solicitud).hide();
			$("#Ocult_Act"+Id_Solicitud).show();
		}
		
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

		ocult_actividades=function(Id_Solicitud){
			$("#Desc_Motiv_Repor"+Id_Solicitud).hide();
			$("#Ver_Act"+Id_Solicitud).show();
			$("#Ocult_Act"+Id_Solicitud).hide();
		}
		
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================
		carga_activos_vip("mis_activos");	
		
		selec_activo_radio=function(nombre_radio, Id_Activo, Id_Situacion_Activo){
			console.log(estatus_activos);
			$('select[name="EstatusActivocmb"] option').remove();
			$('select[name="EstatusActivocmb"]').hide();
			$("#cmbestatusActivo_"+Id_Activo).show();
			$("#hidden_seleccion_activo").val(Id_Activo);

			if(estatus_activos.totalCount>0){
				for(var i = 0; i < estatus_activos.totalCount; i++)
				{ 			
					if(estatus_activos.data[i].Id_Estatus!="12"){
						if(Id_Situacion_Activo==estatus_activos.data[i].Id_Estatus){
							$("#cmbestatusActivo_"+Id_Activo).append($('<option selected>', { value: estatus_activos.data[i].Id_Estatus }).text(estatus_activos.data[i].Desc_Estatus));
						}else{
							$("#cmbestatusActivo_"+Id_Activo).append($('<option>', { value: estatus_activos.data[i].Id_Estatus }).text(estatus_activos.data[i].Desc_Estatus));
						}
					}
				}
			}
		}	

//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

		habilita_solicitudes_mant();

		function habilita_solicitudes_mant(){
			$.ajax({
					type: "POST",
					url: "../fachadas/activos/siga_usuarios/Siga_usuariosFacade.Class.php",        
					async: false,
					data: {
						No_Usuario: "<?php echo $_SESSION["No_Usuario"]; ?>",
						accion: "consultar_depto"
					},
					dataType: "html",
					beforeSend: function (xhr) {
					},
					success: function (datos) {
						var json;
						json = eval("(" + datos + ")"); //Parsear JSON
						
						if(json.totalCount>0){
							$("#div_mantenimiento_solicitudes").show();
						}
					},
					error: function () {
						mensajesalerta("SIGA:", "Ocurrio un error al consultar.", "error", "dark");
					}
				});
			
		}

//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

		//Pasar Valores al Editar
		pasarvalores=function(id, Estatus_Proceso) {
			$("#Id_Cirugia").val("");
			limpiarcampos_tabcalificacion();
			$("#botonEnviarCalificacion").attr("disabled", false);
			$("#botonNoSolucionado").attr("disabled", false);

			// Habilita los campos para evitar la edición
			$("div.tab-contenedor :input").attr("disabled", false);
			
			if(Estatus_Proceso=="1"){
				$("#tabChat").click();
				$("#tabChat").hide();
				$("#tab_adjuntos").hide();
				$("#tab_cerrar").hide();
				//Ocultamos div chat
				$("#div_box_chat").hide();
			}else{
				if(Estatus_Proceso=="2"){
					$("#tabChat").click();
					$("#tabChat").show();
					$("#tab_adjuntos").show();
					$("#tab_cerrar").hide();
					$("#div_box_chat").show();
				} else {
					// Tickets cerrados
					if (Estatus_Proceso == "3") {

						// Muestra las secciones
						$("#tab_cerrar").click();
						$("#tabChat").show();
						$("#tab_adjuntos").show();
						$("#tab_cerrar").show();
						$("#div_box_chat").show();
					}
				}			
			}
			
			limpiarcampos();
			if (id != "") {
				$.ajax({
					type: "POST",
					url: "../fachadas/activos/siga_solicitud_tickets/Siga_solicitud_ticketsFacade.Class.php",
					async: false,
					data: {
						Id_Solicitud: id,
						Estatus_Reg:'1',
						accion: "consultar"
					},
					dataType: "html",
					beforeSend: function (xhr) {
				
					},
					success: function (data) {
						data = eval("(" + data + ")");
						var Prioridad = "";
						
						if (data.totalCount > 0) 
						{
							if(data.data[0].Id_Subcategoria=="4484"||data.data[0].Id_Subcategoria=="4485"||data.data[0].Id_Subcategoria=="6487"||data.data[0].Id_Subcategoria=="8491"||data.data[0].Id_Subcategoria=="8492"||data.data[0].Id_Subcategoria=="8493"){
								//var formato_link='<a target="_blank" href="http://siga.hospitalsatelite.com:8080/gesjur/vistas/proveedores_doc_sol.asp?key='+id+'" type="button" class="btn btn-warning btn-xs">Ver Formato de Solicitud</a>';
								var formato_link='<a target="_blank" href="https://apps2.hospitalsatelite.com/gesjur/vistas/proveedores_doc_sol.asp?key='+id+'" type="button" class="btn btn-warning btn-xs">Ver Formato de Solicitud</a>';
								$("#format_solicitud_prov").html(formato_link);
							}else{
								if(data.data[0].Id_Subcategoria=="8499"||data.data[0].Id_Subcategoria=="8597"){
										//var formato_link='<a target="_blank" href="http://siga.hospitalsatelite.com:8080/gesjur/archivos/archivos_contratos_form_estandar/Solicitud Contractual.pdf" type="button" class="btn btn-warning btn-xs">Solicitud Contractual</a>';
										var formato_link='<a target="_blank" href="https://apps2.hospitalsatelite.com/gesjur/archivos/archivos_contratos_form_estandar/Solicitud Contractual.pdf" type="button" class="btn btn-warning btn-xs">Solicitud Contractual</a>';
										$("#format_solicitud_prov").html(formato_link);
								}else{
									$("#format_solicitud_prov").html("");
								}
							}
														
							//Limpiamos los divs y variables 
							$("#div_adjuntos_chat_archivos").html("");
							$("#div_adjuntos_chat_imagenes").html("");
							archivos_adjuntos="";
							imagenes_adjuntos="";
							
							var li_img="";
							var li_arch="";
							var archivos="";
							if(data.data[0].Url_archivo!=""){
								var url_cad_dinamic="";
								url_cad_dinamic=data.data[0].Url_archivo.toString().split("---");
								
								if(url_cad_dinamic.length<=0){
									archivos=data.data[0].Url_archivo.toString().split(".");
									for(var j=0; j<array_img.length;j++){
										if(array_img[j].toString()==archivos[1].toUpperCase()){
											li_img+='<li>';
											li_img+='  <a href="#">';
											li_img+='	<a href="../Archivos/Archivos-Mesa/'+data.data[0].Url_archivo+'" target="_blank">Ver Imágen</a>';
											//li_img+='	<span class="name">listadoProd.xls</span>';
											li_img+='  </a>';
											li_img+='</li>';
										}
									}
									
									for(var k=0; k<array_arch.length;k++){
										if(array_arch[k].toString()==archivos[1].toUpperCase()){
											li_arch+='<li>';
											li_arch+='  <a href="#">';
											li_arch+='	<a href="../Archivos/Archivos-Mesa/'+data.data[0].Url_archivo+'" target="_blank">Ver Archivo</a>';
											//li_img+='	<span class="name">listadoProd.xls</span>';
											li_arch+='  </a>';
											li_arch+='</li>';
										}
									}
								}else{
									for(var k1=0; k1<url_cad_dinamic.length;k1++){
										archivos=url_cad_dinamic[k1].toString().split(".");
										for(var j=0; j<array_img.length;j++){
											if(array_img[j].toString()==archivos[1].toUpperCase()){
												li_img+='<li>';
												li_img+='  <a href="#">';
												li_img+='	<a href="../Archivos/Archivos-Mesa/'+url_cad_dinamic[k1]+'" target="_blank">Ver Imágen</a>';
												//li_img+='	<span class="name">listadoProd.xls</span>';
												li_img+='  </a>';
												li_img+='</li>';
											}
										}
										
										for(var k=0; k<array_arch.length;k++){
											if(array_arch[k].toString()==archivos[1].toUpperCase()){
												li_arch+='<li>';
												li_arch+='  <a href="#">';
												li_arch+='	<a href="../Archivos/Archivos-Mesa/'+url_cad_dinamic[k1]+'" target="_blank">Ver Archivo</a>';
												//li_img+='	<span class="name">listadoProd.xls</span>';
												li_arch+='  </a>';
												li_arch+='</li>';
											}
										}
									}
								}	
							}
							
							archivos_adjuntos=li_arch;
							imagenes_adjuntos=li_img;
							
							$("#div_adjuntos_chat_archivos").html(archivos_adjuntos);
							$("#div_adjuntos_chat_imagenes").html(imagenes_adjuntos);
							
							
							if(data.data[0].Prioridad==1){
								Prioridad="Alta";
							}else{
								if(data.data[0].Prioridad==2){
									Prioridad="Mdia";
								}else{
									if(data.data[0].Prioridad==3){
										Prioridad="Baja";
									}
								}
							}
						    for (var i=1; i <=2; i++)
							{
							 var Estatus_Proce="";
							 Estatus_Proce=data.data[0].Estatus_Proceso;
							 if(data.data[0].Asist_Especial=="1"){
								Estatus_Proce+=" (Asistencia Especial)";
							 }
							
							 $("#spanNumsolicitud"+i).text(data.data[0].Id_Solicitud);
							 $("#Id_Solicitud").val(data.data[0].Id_Solicitud);
							 //Si existe la imagen, pasamos el numero del empleado
							 if(data.data[0].Existe_Imagen=="si"){
								$("#No_Empleado_chat").val(data.data[0].No_Gestor);
							 }
							 
							 $("#spanStatus"+i).text(Estatus_Proce);
							 if(data.data[0].Lo_Realiza=="0"){
								$("#spanLo_Realiza"+i).text("Interno");
							 }else{
								if(data.data[0].Lo_Realiza=="1"){
									$("#spanLo_Realiza"+i).text("Externo");
								 }
							 }
							 
							 
							 if(data.data[0].Activo_Externo=="1"){
								 $("#spanActivo"+i).html(data.data[0].AF_BC_Ext+' '+data.data[0].Nombre_Act_Ext+' <span class="label label-warning">Activo Externo</span>');
								 $("#spanMarca"+i).text(data.data[0].Marca_Act_Ext);
								 $("#spanModelo"+i).text(data.data[0].Modelo_Act_Ext);
								 $("#spanNo_Serie"+i).text(data.data[0].No_Serie_Act_Ext);
								 $("#spanUbic_Prim"+i).text(data.data[0].Desc_Ubic_Prim_Act_Ext);
								 $("#spanUbic_Sec"+i).text(data.data[0].Desc_Ubic_Sec_Act_Ext);
							}else{
								 $("#spanActivo"+i).text(data.data[0].AF_BC_Ext+' '+data.data[0].Nombre_Act_Ext);
								 $("#spanMarca"+i).text(data.data[0].Marca_Act_Ext);
								 $("#spanModelo"+i).text(data.data[0].Modelo_Act_Ext);
								 $("#spanNo_Serie"+i).text(data.data[0].No_Serie_Act_Ext);
								 $("#spanUbic_Prim"+i).text(data.data[0].Desc_Ubic_Prim_Act_Ext);
								 $("#spanUbic_Sec"+i).text(data.data[0].Desc_Ubic_Sec_Act_Ext);
							 }
							 
							 $("#spanArea"+i).text(data.data[0].Area);
							 $("#spanPrioridad"+i).text(Prioridad);
							 if(data.data[0].Desc_Medio!=null && data.data[0].Desc_Medio!=""){
								$("#spanMedio"+i).text(data.data[0].Desc_Medio);
								$("#liMedio"+i).show();
							 }else{
								$("#liMedio"+i).hide();
							 }
							 if(data.data[0].Id_Solicitud_Anterior!=null && data.data[0].Id_Solicitud_Anterior!=""){
							   $("#spanNumsolicitudAnterior"+i).text(data.data[0].Id_Solicitud_Anterior);
							   $("#liSolicitudAnterior"+i).show(); 
							 }else{
							   $("#liSolicitudAnterior"+i).hide(); 
							 }
							 
							$("#Id_Cirugia").val(data.data[0].Id_Cirugia);
							$("#spanSeccion"+i).text(data.data[0].NombreSeccion);
							$("#spanCategoria"+i).text(data.data[0].Categoria);
						  $("#spanSubcategoria"+i).text(data.data[0].Subcategoria);
							$("#spanMotivo"+i).text(data.data[0].Motivo);
							$("#spanSolicitud"+i).text(data.data[0].Usuario);
							$("#spanGestor"+i).text(data.data[0].Gestor);
							$("#spanFech_Solicitud"+i).text(data.data[0].Fech_Solicitud);
							
						}
							
							$("#hddEstatus_Proceso").val(data.data[0].Id_Estatus_Proceso);
							
							if(data.data[0].Id_Estatus_Proceso=="4"){
								$("#botonEnviarCalificacion").attr("disabled", true);
								$("#botonNoSolucionado").attr("disabled", true);
								
								cargar_calificacion(data.data[0].Id_Solicitud);

								// Deshabilita los campos para evitar la edición solo en caso de ticktes cerrados
								setTimeout(function () { $("div.tab-contenedor :input").attr("disabled", true); }, 100);
							}
							
							$("#Desc_Motivo_Aparente").html("");
							$("#Desc_Motivo_Real").html("");
							$("#Desc_Est_Equipo").html("");
							$("#Desc_Cierre").html("");
							$("#Desc_Motivo_Aparente").html(data.data[0].Desc_Motivo_Aparente);
							$("#Desc_Motivo_Real").html(data.data[0].Desc_Motivo_Real);
							$("#Desc_Est_Equipo").html(data.data[0].Desc_Est_Equipo);
							$("#Desc_Cierre").html(data.data[0].ComentarioCierre);
							
							//Titulo del chat
							$("#title_chat").html("<font FACE='Arial' style='font-size:13px'>"+data.data[0].Usuario+"</font>");
							
							//Activar el tab Actividades si el ticket viene de las Actividades
							 if(data.data[0].Id_Estatus_Proceso>1&& data.data[0].Id_Estatus_Proceso<5){								
								carga_actividades(data.data[0].Id_Solicitud);									
								$("#li_materiales").show();	
								if((data.data[0].Id_Actividad!="")){
									$("#li_actividades").show();
									
									
								}else{
									// $("#li_actividades").hide();
									// $("#li_materiales").hide();
								}
							 }else{
								// $("#li_actividades").hide();
								// $("#li_materiales").hide();
							 }
						}
					},
					error: function () {
						mensajesalerta("SIGA:", "Ocurrio un error al consultar.", "error", "dark");
					}
				});
			}
			cargachat();
		}
	
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

		function autocomplete_activos(){
			//Area
			var Id_Area=$("#idareasesion").val();
			var strdatos="";
			
			if(Id_Area!="5"){
				strdatos={
					Id_Area:Id_Area,
					Estatus_Reg:"1",
					accion: 'consultar'
				}
			}else{
				strdatos={
					Estatus_Reg:"1",
					accion: 'consultar'
				}
			}
				
			$.ajax({
				type: "POST",
				url: "../fachadas/activos/siga_activos/Siga_activosFacade.Class.php",
				data: {
					Id_Area:Id_Area,
					Estatus_Reg:"1",
					accion: 'consultar'
				},
				async: true,
				dataType: "html",
				beforeSend: function (objeto) {
					$("#gifcargando1").show();
				},
				success: function (datos) {
					var json = "";
						json = eval("(" + datos + ")"); //Parsear JSON

						if (json.totalCount > 0) {

							var activos='';
							activos+='<option></option>';
							activos+='<optgroup label="Activos">';

							for (var i = 0; i < json.totalCount; i++) {
								activos+='<option value="'+json.data[i].Id_Activo+'">'+json.data[i].AF_BC+' '+json.data[i].Nombre_Activo+' ('+json.data[i].Marca+'/'+json.data[i].Modelo+'/'+json.data[i].NumSerie+')</option>';
							}
							activos+='</optgroup>';
							$('#select-activos').html(activos);

							$("#gifcargando1").hide();
							$("#select-activos").show();
								
							$('#select-activos').selectize({
								//sortField: 'text'
							});
						}
						else {
							$('#select-activos').append($('<option>', { value: "" }).text("Sin resultados"));
						}

				},
				error: function (objeto, quepaso, otroobj) {
					mensajesalerta("SIGA:", "Ocurrio un error al consultar.", "error", "dark");
					$('#select-activos').append($('<option>', { value: "-1" }).text("Sin resultados"));
				}
			});
		}
		
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================
	
		$("#select-activos").change(function() {
			if(this.value!=""){
				$.ajax({
					type: "POST",
					url: "../fachadas/activos/siga_activos/Siga_activosFacade.Class.php",
					data: {
						Id_Activo:this.value,
						accion: 'activos'
					},
					async: false,
					dataType: "html",
					beforeSend: function (objeto) {
					},
					success: function (datos) {
						var json = "";
							json = eval("(" + datos + ")"); //Parsear JSON
	
							if (json.totalCount > 0) {
								/*$("#txt_Id_Activo").val(json.data[0].Id_Activo);
								$("#txt_Nom_Activo").val(json.data[0].Nombre_Activo);
								$("#txt_ubic_primaria").val(json.data[0].Desc_Ubic_Prim);
								$("#txt_ubic_secundaria").val(json.data[0].Desc_Ubic_Sec);
								$("#txt_marca").val(json.data[0].Marca);
								$("#text_Modelo").val(json.data[0].Modelo);*/
								$("#desc_corta_activo").val(json.data[0].DescLarga);
								//$("#text_No_Serie").val(json.data[0].NumSerie);
							}else {
								mensajesalerta("", "No se encontraron resultados", "error", "dark");
							}
	
					},
					error: function (objeto, quepaso, otroobj) {
						mensajesalerta("SIGA:", "Ocurrio un error al consultar.", "error", "dark");
					}
				});
			}
		});
		
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================
		
		$("#closeModal").click(function () {
			$("#No_Empleado_chat").val("");
			$("#Id_Solicitud").val("");
			$('#display_sin_respuesta').DataTable().ajax.reload();
			$('#display_seguimiento').DataTable().ajax.reload();
			$('#display_por_cerrar').DataTable().ajax.reload();
			$('#tablacerrado').DataTable().ajax.reload();
		});
						
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

		cargar_tablas=function(){
			$('#display_sin_respuesta').DataTable().ajax.reload();
			$('#display_seguimiento').DataTable().ajax.reload();
			$('#display_por_cerrar').DataTable().ajax.reload();
			$('#tablacerrado').DataTable().ajax.reload();
			$("#tickets_actuales").prop("checked", true);
		}
				
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

		cargachatentreintaseg=function(){
			var Id_Solicitud=$("#Id_Solicitud").val();
		
			if(Id_Solicitud!=""){
				cargachat();
			}
		}
		
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

		$("#botonNoSolucionado").click(function () {
			$.confirm({
				title: 'Confirm!',
				content: 'Al confirmar el ticket se pasara a seguimiento!',
				buttons: {
					confirm: function () {
						$.ajax({
							type: "POST",
							url: "../fachadas/activos/siga_solicitud_tickets/Siga_solicitud_ticketsFacade.Class.php",
							data: {
								Id_Solicitud: $("#Id_Solicitud").val(),
								accion: 'Por_cerrar_a_seguimiento'
							},
							async: false,
							dataType: "html",
							beforeSend: function (objeto) {
							},
							success: function (datos) {
								var json = "";
								json = eval("(" + datos + ")"); //Parsear JSON
			
								if (json.totalCount > 0) {
									mensajesalerta("&Eacute;xito", "La solicitud con el Folio: "+$("#Id_Solicitud").val()+", se paso a seguimiento", "success", "dark");
									//$("#closeModal").click();
									cargar_tablas();
									$('#seguimientoReporte').modal('show');
									pasarvalores($("#Id_Solicitud").val(), 2);
								}else {
									mensajesalerta("", "Ocurrio un error al cambiar el estatus", "error", "dark");
								}
			
							},
							error: function (objeto, quepaso, otroobj) {
								mensajesalerta("SIGA:", "Ocurrio un error al consultar.", "error", "dark");
							}
						});
					},
					cancel: function () {
					}
				}
			});
	
		});
				
		<?php
			if(!empty($_SESSION["url_id_solicitud"])&&!empty($_SESSION["url_est_proceso"])){
		?>
				carga_modal_url();
		<?php
			}
		?>
   });
   
//======================================================================================================================================================================================================================
//====================================================================================================================================================================================================================== 
	 
	 //Se carga la funcion al abrir el link de el correo electronico
	//carga_modal_url();
	function carga_modal_url(){
				
		<?php if($_SESSION["url_id_solicitud"]!=""&&($_SESSION["url_id_usuario"]==$_SESSION["Id_Usuario"])){?>
			var url_est_proceso="<?php echo $_SESSION["url_est_proceso"]; ?>";
			var url_id_solicitud="<?php echo $_SESSION["url_id_solicitud"]; ?>";			
			
			$.ajax({
				type: "POST",
				url: "../fachadas/activos/siga_solicitud_tickets/Siga_solicitud_ticketsFacade.Class.php",
				data: {
					Id_Solicitud: url_id_solicitud,
					Estatus_Proceso: url_est_proceso,
					accion: 'Consulta_Estatus_Proceso'
				},
				async: false,
				dataType: "html",
				beforeSend: function (objeto) {
				},
				success: function (datos) {
					var json = "";
					json = eval("(" + datos + ")"); //Parsear JSON
			
					if (json.totalCount > 0) {
						$('#seguimientoReporte').modal('show');
					
						if(json.Estatus_Proceso==url_est_proceso){
							pasarvalores(url_id_solicitud,"3");
							
							if(url_est_proceso==1){
								$("#li_tab_sin_respuesta").click();
							}else{
								if(url_est_proceso==2){
									$("#li_tab_seguimiento").click();
								}else{
									if(url_est_proceso==3){
										$("#li_tab_por_cerrar").click(); 
									}else{
										if(url_est_proceso==4){
											$("#li_tab_cerrados").click();
										}
									}
								}
							}
						}
					}else {
						mensajesalerta("Informaci&oacute;n", "-El ticket "+url_id_solicitud+" se encuentra en otro estatus", "", "dark");
					}
			
				},
				error: function (objeto, quepaso, otroobj) {
					mensajesalerta("SIGA:", "Ocurrio un error al consultar.", "error", "dark");
				}
			});
			//Se borran ls sesiones y campos
			$("#url_sistema").val("");
		<?php
			$_SESSION["url_est_proceso"]="";
			$_SESSION["url_sistema"]="";
			$_SESSION["url_id_solicitud"]="";
			$_SESSION["url_id_usuario"]="";
		}else{
			$_SESSION["url_est_proceso"]="";
			$_SESSION["url_sistema"]="";
			$_SESSION["url_id_solicitud"]="";
			$_SESSION["url_id_usuario"]="";
		}?>
	}
   
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

	function cambiaSeccion(idseccion){
	   //alert(idseccion);
	   $("#hddSeccion").val(idseccion);
	}

//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

    function carga_secciones(idarea) {
			var resultado=new Array();
			data={accion: "consultar",Id_Area:idarea};
			resultado=cargo_cmb("../fachadas/activos/siga_cat_ticket_seccion/Siga_cat_ticket_seccionFacade.Class.php",false, data);

			var htmlDiv = '<ul class="inline center">'+
                        '<li>Sección </li>';
						
						for(var i = 0; i < resultado.totalCount; i++)
						{
						var resultado2=new Array();
						data2={accion: "consultar",Id_Seccion:resultado.data[i].Id_Seccion};
						resultado2=cargo_cmb("../fachadas/activos/siga_cat_ticket_subseccion/Siga_cat_ticket_subseccionFacade.Class.php",false, data2);
	
                        htmlDiv +='<li>'+
                          '<div class="form-group">'+
                            '<div class="checkbox icheck">'+
                              '<label>'+
                                '<input type="radio" value="'+resultado.data[i].Id_Seccion+'" onChange="javascript:cambiaSeccion('+resultado.data[i].Id_Seccion+')" id="chkSoporte'+resultado.data[i].Id_Seccion+'" name="chkSoporte"> '+resultado.data[i].Desc_Seccion+
                              '</label>'+
                            '</div>'+
                          '</div>'+
                        '</li>'+

												'<li class="infotip">'+
													'<a href="#"><i class="fa fa-info-circle" aria-hidden="true"></i>'+

													'<div class="tooltip-login">'+
														'<div class="head">'+
															'<h5><font color="white">SERVICIOS QUE SE PUEDEN REPORTAR EN LA SECCIÓN DE '+resultado.data[i].Desc_Seccion+'</font></h5>'+

														'</div>'+											

														'<div class="body">';
														var desc_subseccion="";
															for(var j = 0; j < resultado2.totalCount; j++){
														desc_subseccion+="-"+resultado2.data[j].Desc_Subseccion+"<br>";
														}
															htmlDiv +='<div class="col-md-12">';
															htmlDiv +=desc_subseccion;
															htmlDiv +='</div>';
															htmlDiv +='</div>'+
														'</div>'+
													'</a>'+
												'</li>';
						}
  htmlDiv +='<button type="button" class="btn btn-sm" id="btn_requisitosAprovisionamiento" name="btn_requisitosAprovisionamiento" style="display:none" onclick="pre_requisitosAprovisionamiento();"> Pre requisitos para solicitar compra de insumos indirectos </button></ul>';
  htmlDiv +='<button type="button" class="btn btn-danger btn-sm " id="btn_prerequisitos" name="btn_prerequisitos" style="display:none" onclick="pre_requisitos();"> Pre requisitios para Contratos </button></ul>';

		$("#divSeccion").html(htmlDiv);
	}
   
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

	function carga_categorias(idarea) {
		var resultado=new Array();
		data={Estatus_Reg: "1",accion: "consultar",Id_Area:idarea};
		resultado=cargo_cmb("../fachadas/activos/siga_cat_ticket_categoria/Siga_cat_ticket_categoriaFacade.Class.php",false, data);
        $('#cmb_categoria').empty();
		if(resultado.totalCount>0){
			$('#cmb_categoria').append($('<option>', { value: "-1" }).text("--Categoria--"));
			for(var i = 0; i < resultado.totalCount; i++){
				$('#cmb_categoria').append($('<option>', { value: resultado.data[i].Id_Categoria }).text(resultado.data[i].Desc_Categoria));
			}
		}else{
			$('#cmb_categoria').append($('<option>', { value: "-1" }).text("--Sin Resultados--"));
		}
	}
		
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

    function limpiarcampos(){
			
			$("#No_Empleado_chat").val("");
			//Limpio radios seleccion activos empleados
			$("input:radio[name='radio_activos']").attr("checked",false);
			$("#hidden_seleccion_activo").val("");
			
			$("#Id_Solicitud").val("");
			//$("#hddArea").val("");
			$("#cmb_categoria").val("-1");
			$("#desc_titulo ").val("");
			$("#Descripcion_ticket").val("");
			$("#Check_Alta").is(':checked');
			//$("#chkSoporte").is(':checked');
			$("#Url_Foto_Activo").val("");
			//$('.upload-simple').fileinput('destroy');
			
			//Pinta nuevamente el control de adjuntos
			carga_control_adjuntos();
			
			//var $el4 = $('#documentos_adjuntos_FILE'), initPlugin = function() {
			//	$el4.fileinput({previewClass:''});
			//};
			//initPlugin();
			//
			//$el4.fileinput('clear');
	}		
    
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

	function msjticketscerrar(){
		var Id_Area_Nuevo=$("#hddArea").val();
		$('#display_por_cerrar').DataTable().ajax.reload();
		
		if(cont_ticket_biomedica>0&&Id_Area_Nuevo==1){
			mensajesalerta("Informaci&oacute;n", "-Para generar un nuevo ticket, debes cerrar los que se encuentran en la pestaña por cerrar.<br />", "", "dark");
			$("#mensaje_cerrados").html("<h3><font color='red'>Para generar un nuevo ticket, debes cerrar los que se encuentran en la pestaña por cerrar.</font></h3>");
			$("#desc_titulo").prop( "disabled", true );
			$("#Descripcion_ticket").prop( "disabled", true );
			$("#solicitar").prop( "disabled", true );
		}else{
			if(cont_ticket_tic>0&&Id_Area_Nuevo==2){
				mensajesalerta("Informaci&oacute;n", "-Para generar un nuevo ticket, debes cerrar los que se encuentran en la pestaña por cerrar.<br />", "", "dark");
				$("#mensaje_cerrados").html("<h3><font color='red'>Para generar un nuevo ticket, debes cerrar los que se encuentran en la pestaña por cerrar.</font></h3>");
				$("#desc_titulo").prop( "disabled", true );
				$("#Descripcion_ticket").prop( "disabled", true );
				$("#solicitar").prop( "disabled", true );
			}else{
				if(cont_ticket_mantenimiento>0&&Id_Area_Nuevo==3){
					mensajesalerta("Informaci&oacute;n", "-Para generar un nuevo ticket, debes cerrar los que se encuentran en la pestaña por cerrar.<br />", "", "dark");
					$("#mensaje_cerrados").html("<h3><font color='red'>Para generar un nuevo ticket, debes cerrar los que se encuentran en la pestaña por cerrar.</font></h3>");
					$("#desc_titulo").prop( "disabled", true );
					$("#Descripcion_ticket").prop( "disabled", true );
					$("#solicitar").prop( "disabled", true );
				}else{
					if(cont_ticket_mob_equi>0&&Id_Area_Nuevo==4){
						mensajesalerta("Informaci&oacute;n", "-Para generar un nuevo ticket, debes cerrar los que se encuentran en la pestaña por cerrar.<br />", "", "dark");
						$("#mensaje_cerrados").html("<h3><font color='red'>Para generar un nuevo ticket, debes cerrar los que se encuentran en la pestaña por cerrar.</font></h3>");
						$("#desc_titulo").prop( "disabled", true );
						$("#Descripcion_ticket").prop( "disabled", true );
						$("#solicitar").prop( "disabled", true );
					}else{
						if(cont_ticket_juridico>0&&Id_Area_Nuevo==6){
							mensajesalerta("Informaci&oacute;n", "-Para generar un nuevo ticket, debes cerrar los que se encuentran en la pestaña por cerrar.<br />", "", "dark");
							$("#mensaje_cerrados").html("<h3><font color='red'>Para generar un nuevo ticket, debes cerrar los que se encuentran en la pestaña por cerrar.</font></h3>");
							$("#desc_titulo").prop( "disabled", true );
							$("#Descripcion_ticket").prop( "disabled", true );
							$("#solicitar").prop( "disabled", true );
						}else{
							$("#mensaje_cerrados").html("");
							$("#desc_titulo").prop( "disabled", false );
							$("#Descripcion_ticket").prop( "disabled", false );
							$("#solicitar").prop( "disabled", false );
						}
					}
				}
			}
		}
	}
	
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

	function cambiaArea(idarea){
	   $("#Check_Mis_Activos").prop("checked", true); 	
	   limpiarcampos();
	   $("#hddArea").val(idarea);
	   $("#headerArea").removeAttr('class');
	   $("#headerArea").attr('class', '');
	   $('#headerArea')[0].className = '';
	   
	   $("#headerArea2").removeAttr('class');
	   $("#headerArea2").attr('class', '');
	   $('#headerArea2')[0].className = '';	   
	   
	   carga_secciones(idarea);
	   carga_categorias(idarea);
	   
	   if (idarea == 1){
		   $("#headerArea").addClass("box-header azul with-border");
		   $("#headerArea2").addClass("box-header azul with-border");
		   $("#h3Area").html("Solicitud de soporte Biomédica");
		   $("#solicitud_mis_activos").show();
			 $("#solicitar").html("Solicitar Soporte");
		 }

	   if (idarea == 2){	   
		   $("#headerArea").addClass("box-header verde with-border");
		   $("#headerArea2").addClass("box-header verde with-border");
		   $("#h3Area").html("Solicitud de soporte TIC");
		   $("#solicitud_mis_activos").show();
			 $("#solicitar").html("Solicitar Soporte");
		 }

	   if (idarea == 3){
		   $("#headerArea").addClass("box-header amarillo with-border");
		   $("#headerArea2").addClass("box-header amarillo with-border");
		   $("#h3Area").html("Solicitud de soporte Mantenimiento");
		   $("#solicitud_mis_activos").show();
			 $("#solicitar").html("Solicitar Soporte");
		 }

	   if (idarea == 7){
		   $("#headerArea").addClass("box-header informa with-border");
		   $("#headerArea2").addClass("box-header informa with-border");
		   $("#h3Area").html("Solicitud de soporte Aprovisionamiento");
		   $("#solicitud_mis_activos").show();
			 $("#solicitar").html("Solicitar Soporte");
			 $('#btn_requisitosAprovisionamiento').show();
			 $('#btn_requisitosAprovisionamiento').css('color','black');
			 $('#btn_requisitosAprovisionamiento').css('background-color','#39cccc');
		 }

	   if (idarea == 8){
		   $("#headerArea").addClass("box-header inteligencia with-border");
		   $("#headerArea2").addClass("box-header inteligencia with-border");
		   $("#h3Area").html("Solicitud de soporte Inteligencia de Negocios");
		   $("#solicitud_mis_activos").show();
			 $("#solicitar").html("Solicitar Soporte");
		 }


		 if (idarea == 6){
		   $("#headerArea").addClass("box-header rojo with-border");
		   $("#headerArea2").addClass("box-header rojo with-border");
		   $("#h3Area").html('<ul class="inline center" style="font-size:13px"><li class="infotip"><a href="#" onclick="muestro_info_juridico()" title="Ayuda"><i class="fa fa-info-circle" aria-hidden="true" title="Ayuda"></i></a></li></ul> Solicitud de servico Jurídico');
			 $("#solicitud_mis_activos").hide();
			 $("#solicitar").html("Solicitar Servicio");
			 $('#btn_prerequisitos').show();
	   }	      
   }
   
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

    $(".upload-files").fileinput({
		browseClass: "btn chs",
		language: 'es',
		allowedFileExtensions : ['jpg','png'],
	});

//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

	$(".upload-simple").fileinput({
		browseClass: "btn chs",
		language: 'es',
	});  

//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================
	
	muestro_info_juridico=function(){
		$("#info_juridico").modal("show");		
	}
	
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

	carga_control_adjuntos();		
	function carga_control_adjuntos(){
		var Adjuntos="";
		Adjuntos='<label for="documentos_adjuntos_FILE" class="control-label" id="documentos_adjuntos_FILELabel" style="font-size: 11px;">1.-Adjuntar Imagen</label>';			  
        Adjuntos+='<input id="documentos_adjuntos_FILE" name="imagenes[]" type="file" multiple="multiple" class="file-loading">';
		Adjuntos+='<input type="hidden" id="Url_Foto_Activo">';
	
		$("#Adjuntos_tickets").html(Adjuntos);
		carga_arch_mesa("documentos_adjuntos_FILE", "Url_Foto_Activo","../Archivos/Archivos-Mesa",true,false);
	}
	
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

	$("#botonEnviar").click(function(e){
		var Agregar = true;
		var mensaje_error = "";
		var strDatos="";		
		var Id_Solicitud=$.trim($("#Id_Solicitud").val());		
		var Id_Usuario=$("#usuariosesion").val();
		//Area de sesion
		//var Id_Area=$("#idareasesion").val();
		var Mensaje=$.trim($("#Mensaje").val());
		//var Estatus_Proceso = $("#hddEstatus_Proceso").val();		
		var url_documentos_adjuntos_chat=$.trim($("#url_documentos_adjuntos_chat").val());
		
		if(url_documentos_adjuntos_chat.length==0){
			if (Mensaje.length <= 0) {
				Agregar = false; 
				mensaje_error += " -El mensaje no puede ser vacio<br />";
				$("#Mensaje").focus();
			}
		}
				
		if (!Agregar) {
			mensajesalerta("Informaci&oacute;n", mensaje_error, "", "dark");			
		}
		
		if(Agregar){
		
			strDatos = "Id_Solicitud="+Id_Solicitud; 
			strDatos += "&Mensaje="+Mensaje;
			strDatos += "&Id_Usuario="+Id_Usuario;
			strDatos += "&Id_Estatus_Proceso=1";
			strDatos += "&Estatus_Reg=1";				
			strDatos += "&accion=guardar";
			//Archivos Adjuntos
			strDatos += "&Url_Adjunto="+url_documentos_adjuntos_chat;
			
			if(Id_Solicitud!=""){
				$.ajax({
					type: "POST",
					url: "../fachadas/activos/siga_ticket_chat/Siga_ticket_chatFacade.Class.php",        
					async: false,
					data: {
						Id_Solicitud: Id_Solicitud, 
						Mensaje: Mensaje,
						Id_Usuario: Id_Usuario,
						Id_Estatus_Proceso: 1,
						Estatus_Reg:1,				
						accion: "guardar",
						Url_Adjunto: url_documentos_adjuntos_chat
					},
					dataType: "html",
					beforeSend: function (xhr) {
				
					},
					success: function (datos) {
						var json;
						json = eval("(" + datos + ")"); //Parsear JSON
						$("#Mensaje").val('');
						mensajesalerta("&Eacute;xito", "Generado Correctamente.", "success", "dark");
						cargachat();
						$("#botonEnviar").html("Enviar");
						$("#url_documentos_adjuntos_chat").val("");
						//$("#tabProceso").click();						
						//$('#myModal').modal('hide');
						//$('#display_seguimiento').DataTable().ajax.reload();
						
					},
					error: function () {
						mensajesalerta("SIGA:", "Ocurrio un error al guardar.", "error", "dark");
					}
				});
			}
		}
	});
		
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================
	
	$('#Mensaje').keyup(function(e){
		if(e.keyCode == 13){
			$("#botonEnviar").click();
		}
	});

//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

	$("#botonEnviarCalificacion").click(function(e){
		var Agregar = true;
		var mensaje_error = "";
		var strDatos="";
		
		var Id_Solicitud=$.trim($("#Id_Solicitud").val());
		var Id_Cirugia=$.trim($("#Id_Cirugia").val());
		//Usuario Sesion
		var Id_Usuario=$("#usuariosesion").val();
		//Area de sesion
		//var Id_Area=$("#idareasesion").val();
		var Resp1=$.trim($("#Solucion").val());
		var Resp2=$.trim($("#Actitud").val());
		var Resp3=$.trim($("#TiempoRespuesta").val());
		var Estatus_Proceso = $("#hddEstatus_Proceso").val();
		var P1=$("#hddP1").val();
		var P2=$("#hddP2").val();
		var P3=$("#hddP3").val();
		//alert(Estatus_Proceso);
		
		if (Estatus_Proceso == 1 || Estatus_Proceso == 2 || Estatus_Proceso == '') {
			Agregar = false; 
			mensaje_error += " -El ticket debe estar cerrado por el gestor para ser calificado<br />";
			$("#Solucion").focus();
		}
		
		if (Resp1.length <= 0) {
			Agregar = false; 
			mensaje_error += " -El campo de Solución no puede ser vacio<br />";
			$("#Solucion").focus();
		}
		if (Resp2.length <= 0) {
			Agregar = false; 
			mensaje_error += " -El campo de Actitud no puede ser vacio<br />";
			$("#Actitud").focus();
		}
		if (Resp3.length <= 0) {
			Agregar = false; 
			mensaje_error += " -El campo de Tiempo de Respuesta no puede ser vacio<br />";
			$("#TiempoRespuesta").focus();
		}
		
		if (P1.length <= 0) {
			Agregar = false; 
			mensaje_error += " -La respuesta de la primera pregunta puede ser vacia<br />";
			$("#p11").focus();
		}
		if (P2.length <= 0) {
			Agregar = false; 
			mensaje_error += " -La respuesta de la segunda pregunta puede ser vacia<br />";
			$("#p21").focus();
		}
		if (P3.length <= 0) {
			Agregar = false; 
			mensaje_error += " -La respuesta de la tercera pregunta puede ser vacia<br />";
			$("#p31").focus();
		}
		
		if (!Agregar) {
			mensajesalerta("Informaci&oacute;n", mensaje_error, "", "dark");			
		}
		
		//alert(Agregar);
		if(Agregar)
		{
			strDatos = "Id_Solicitud="+Id_Solicitud; 
			strDatos += "&Id_Cirugia="+Id_Cirugia; 
			strDatos += "&Id_Pregunta1=1";
			strDatos += "&Id_Respuesta1="+P1;	
			strDatos += "&Desc_Comentario1="+Resp1;
			strDatos += "&Id_Pregunta2=2";
			strDatos += "&Id_Respuesta2="+P2;
			strDatos += "&Desc_Comentario2="+Resp2;
			strDatos += "&Id_Pregunta3=3";
			strDatos += "&Id_Respuesta3="+P3;	
			strDatos += "&Desc_Comentario3="+Resp3;
			strDatos += "&Usr_Inser="+Id_Usuario;
			strDatos += "&Estatus_Reg=1";
			strDatos += "&accion=guardar";
			
			$.ajax({
				type: "POST",
				url: "../fachadas/activos/siga_ticket_calificacion/Siga_ticket_calificacionFacade.Class.php",        
				async: false,
				data: strDatos,
				dataType: "html",
				beforeSend: function (xhr) {
			
				},
				success: function (datos) {
					var json;
					json = eval("(" + datos + ")"); //Parsear JSON
					
					limpiarcampos_tabcalificacion();
					cerrar_por_solicitante();
				},
				error: function () {
					mensajesalerta("SIGA:", "Ocurrio un error al guardar.", "error", "dark");
				}
			});	
		}
	});
		
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

	function cerrar_por_solicitante(){
		var Id_Solicitud=$.trim($("#Id_Solicitud").val());
		var strDatos="";
		strDatos = "Id_Solicitud="+Id_Solicitud; 
		strDatos += "&Estatus_Proceso=4";
		strDatos += "&accion=guardar";
		
		$.ajax({
			type: "POST",
			url: "../fachadas/activos/siga_solicitud_tickets/Siga_solicitud_ticketsFacade.Class.php",        
			async: false,
			data: strDatos,
			dataType: "html",
			beforeSend: function (xhr) {
		
			},
			success: function (datos) {
				var json;
				json = eval("(" + datos + ")"); //Parsear JSON
				if (json.totalCount > 0) {
					mensajesalerta("&Eacute;xito", "El ticket ha sido cerrado", "success", "dark");
					/*	
					//Envia Correo
					$.ajax({
						type: "POST",
						url: "../fachadas/activos/siga_solicitud_tickets/Siga_solicitud_ticketsCorreo.Class.php",        
						async: false,
						data: {
							tipocorreo:"cerrar",
							nombre:"Javier",
							telefono:"5514284951",
							email:"javjava@gmail.com",
							mensaje:"Hola",
							Id_Solicitud_Correo:Id_Solicitud
						},
						
						dataType: "html",
						beforeSend: function (xhr) {
					
						},
						success: function (datos) {
							var json;
							json = eval("(" + datos + ")"); //Parsear JSON
							limpiarcampos();
							mensajesalerta("&Eacute;xito", "Correo enviado Correctamente.", "success", "dark");
						
							
						},
						error: function () {
							mensajesalerta("SIGA:", "Ocurrio un error al guardar.", "error", "dark");
						}
					});
					*/
				}
				
				$('#display_seguimiento').DataTable().ajax.reload();
				$('#display_por_cerrar').DataTable().ajax.reload();	
				$('#tablacerrado').DataTable().ajax.reload();
				limpiarcampos_tabcalificacion();
				$(".close").click();
				
			},
			error: function () {
				mensajesalerta("SIGA:", "Ocurrio un error al guardar.", "error", "dark");
			}
		});
	
	}	
	
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

	function cargar_calificacion(Id_Solicitud){
		
		if(Id_Solicitud!=""){
			var strDatos="";
			strDatos="Id_Solicitud="+Id_Solicitud;
			strDatos+="&accion=consultar";
			
			$.ajax({
				type: "POST",
				url: "../fachadas/activos/siga_ticket_calificacion/Siga_ticket_calificacionFacade.Class.php",        
				async: false,
				data: strDatos,
				dataType: "html",
				beforeSend: function (xhr) {
			
				},
				success: function (datos) {
					var json;
					json = eval("(" + datos + ")"); //Parsear JSON
					if(json.totalCount>0){
						
								$("#Solucion").val(json.data[0].Desc_Comentario1);
								
								if(json.data[0].Id_Respuesta1==5){
									$("#faces-1-1").prop('checked', true); 
								}else{
									if(json.data[0].Id_Respuesta1==4){
										$("#faces-1-2").prop('checked', true); 
									}else{
										if(json.data[0].Id_Respuesta1==3){
											$("#faces-1-3").prop('checked', true); 
										}else{
											if(json.data[0].Id_Respuesta1==2){
												$("#faces-1-4").prop('checked', true); 
											}else{
												if(json.data[0].Id_Respuesta1==1){
													$("#faces-1-5").prop('checked', true); 
												}
											}
										}
									}	
								}
							
								$("#Actitud").val(json.data[0].Desc_Comentario2);								
								
								if(json.data[0].Id_Respuesta2==5){
									$("#faces-2-1").prop('checked', true); 
								}else{
									if(json.data[0].Id_Respuesta2==4){
										$("#faces-2-2").prop('checked', true); 
									}else{
										if(json.data[0].Id_Respuesta2==3){
											$("#faces-2-3").prop('checked', true); 
										}else{
											if(json.data[0].Id_Respuesta2==2){
												$("#faces-2-4").prop('checked', true); 
											}else{
												if(json.data[0].Id_Respuesta2==1){
													$("#faces-2-5").prop('checked', true); 
												}
											}
										}
									}	
								}
							
							
							
								$("#TiempoRespuesta").val(json.data[0].Desc_Comentario3);
								
								if(json.data[0].Id_Respuesta3==5){
									$("#faces-3-1").prop('checked', true); 
								}else{
									if(json.data[0].Id_Respuesta3==4){
										$("#faces-3-2").prop('checked', true); 
									}else{
										if(json.data[0].Id_Respuesta3==3){
											$("#faces-3-3").prop('checked', true); 
										}else{
											if(json.data[0].Id_Respuesta3==2){
												$("#faces-3-4").prop('checked', true); 
											}else{
												if(json.data[0].Id_Respuesta3==1){
													$("#faces-3-5").prop('checked', true); 
												}
											}
										}
									}	
								}
							
						
						
					}
					
				},
				error: function () {
					mensajesalerta("SIGA:", "Ocurrio un error al guardar.", "error", "dark");
				}
			});
		}
		
	}
	
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

	function limpiarcampos_tabcalificacion(){
		$("#faces-1-1").prop('checked', false); 
		$("#faces-1-2").prop('checked', false);
		$("#faces-1-3").prop('checked', false);
		$("#faces-1-4").prop('checked', false);
		$("#faces-1-5").prop('checked', false);
		$("#Solucion").val("");

		$("#faces-2-1").prop('checked', false); 
		$("#faces-2-2").prop('checked', false);
		$("#faces-2-3").prop('checked', false); 
		$("#faces-2-4").prop('checked', false);
		$("#faces-2-5").prop('checked', false);
		$("#Actitud").val("");
		
		$("#faces-3-1").prop('checked', false); 
		$("#faces-3-2").prop('checked', false);
		$("#faces-3-3").prop('checked', false);
		$("#faces-3-4").prop('checked', false);
		$("#faces-3-5").prop('checked', false);
		$("#TiempoRespuesta").val("");
	}
	    
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

	function cargachat() {
		$("#divChat").html("");
		var idsolicitud=$("#Id_Solicitud").val();
		if(idsolicitud!=""){
			if(idsolicitud!=undefined){
				var resultado=new Array();
				data={accion: "consultar",Id_Solicitud:idsolicitud};
				resultado=cargo_cmb("../fachadas/activos/siga_ticket_chat/Siga_ticket_chatFacade.Class.php",false, data);

				var htmlDiv = '';
				var li_img="";
				var li_img_chat="";
				var li_arch_chat="";
				for(var i = 0; i < resultado.totalCount; i++)
				{
					if(resultado.data[i].Url_Adjunto!=""){
						var arch_img_chat="";
						arch_img_chat=resultado.data[i].Url_Adjunto.toString().split(".");
						for(var k=0; k<array_img.length;k++){
							if(array_img[k].toString()==arch_img_chat[1].toUpperCase()){
								
								li_img_chat+='<li>';
								li_img_chat+='  <a href="#">';
								li_img_chat+='	<a href="../Archivos/Archivos-Chat/'+resultado.data[i].Url_Adjunto+'" target="_blank">Ver Imágen</a>';
								//li_img+='	<span class="name">listadoProd.xls</span>';
								li_img_chat+='  </a>';
								li_img_chat+='</li>';
							}
						}
						$("#div_adjuntos_chat_imagenes").html(imagenes_adjuntos+li_img_chat);
						//Fin Imagenes
						
						//Archivos
						var arch_arch_chat="";
						arch_arch_chat=resultado.data[i].Url_Adjunto.toString().split(".");
						for(var l=0; l<array_arch.length;l++){
							if(array_arch[l].toString()==arch_arch_chat[1].toUpperCase()){
								
								li_arch_chat+='<li>';
								li_arch_chat+='  <a href="#">';
								li_arch_chat+='	<a href="../Archivos/Archivos-Chat/'+resultado.data[i].Url_Adjunto+'" target="_blank">Ver Archivo</a>';
								//li_img+='	<span class="name">listadoProd.xls</span>';
								li_arch_chat+='  </a>';
								li_arch_chat+='</li>';
							}
						}
						$("#div_adjuntos_chat_archivos").html(archivos_adjuntos+li_arch_chat);
						//Fin Archivos
					}
				
				
							htmlDiv += '<!-- Message. Default to the left -->';
							if (resultado.data[i].Id_Estatus_Proceso == 1)
							{
								//Verifica si existe la ruta de la imagen (Solicitante)
								var existe_img=new Array();
								//var Url_img="http://192.168.1.234/Fotos/"+resultado.data[i].No_Empl_Solicitante+".jpg";
								var Url_img="/SIGA/fotos_empleados/"+resultado.data[i].No_Empl_Solicitante+".jpg";
								var Ruta="";
								data={accion: "existe_archivo",Url:Url_img};
								existe_img=cargo_cmb("../fachadas/activos/Existe_Archivo/Existe_ArchivoFacade.Class.php",false, data);	
								
														if(existe_img.totalCount){
								Ruta='<img class="direct-chat-img" src="'+Url_img+'" alt="message user image">';
								}else{
								Ruta='<img class="direct-chat-img" src="../dist/img/boxed-bg.jpg" alt="message user image">';
								}
							 //Fin
							 htmlDiv +='<div class="direct-chat-msg">'+
		'                        <div class="direct-chat-info clearfix">'+
		'                          <span class="direct-chat-name pull-left">'+resultado.data[i].Nombre_Usuario+'</span>'+
		'                          <span class="direct-chat-timestamp pull-right">'+resultado.data[i].Fecha_Alta+'</span>'+
		'                        </div>'+
								 Ruta+
								'<div class="direct-chat-text">';
								 if(resultado.data[i].Url_Adjunto!=""){
									if(resultado.data[i].Mensaje!="Archivo"){
										htmlDiv +=resultado.data[i].Mensaje+'<br>';
									}	
									htmlDiv+='	<a href="../Archivos/Archivos-Chat/'+resultado.data[i].Url_Adjunto+'" target="_blank">Ver Adjunto</a>';
								 }else{
									htmlDiv +=resultado.data[i].Mensaje;	
								 }
							htmlDiv +='</div>'+
		'                        <!-- /.direct-chat-text -->'+
		'                      </div>';
							}
							if (resultado.data[i].Id_Estatus_Proceso == 2)
							{
								//Verifica si existe la ruta de la imagen (Gestor)
								var existe_img_g=new Array();
								//var Url_img_g="http://192.168.1.234/Fotos/"+resultado.data[i].No_Empl_Gestor+".jpg";
								var Url_img_g="/SIGA/fotos_empleados/"+resultado.data[i].No_Empl_Gestor+".jpg";
								var Ruta_g="";
								data={accion: "existe_archivo",Url:Url_img_g};
								existe_img_g=cargo_cmb("../fachadas/activos/Existe_Archivo/Existe_ArchivoFacade.Class.php",false, data);	
								
														if(existe_img_g.totalCount){
								Ruta_g='<img class="direct-chat-img" src="'+Url_img_g+'" alt="message user image">';
								}else{
								Ruta_g='<img class="direct-chat-img" src="../dist/img/boxed-bg.jpg" alt="message user image">';
								}
							 //Fin
							 
							
								htmlDiv +='<!-- /.direct-chat-msg -->'+
		'                      <!-- Message to the right -->'+
		'                      <div class="direct-chat-msg right">'+
		'                        <div class="direct-chat-info clearfix">'+
		'                          <span class="direct-chat-name pull-right">'+resultado.data[i].Nombre_Gestor+'</span>'+
		'                          <span class="direct-chat-timestamp pull-left">'+resultado.data[i].Fecha_Alta+'</span>'+
		'                        </div>'+Ruta_g+'<div class="direct-chat-text">';
								 if(resultado.data[i].Url_Adjunto!=""){
									
									if(resultado.data[i].Mensaje!="Archivo"){
										htmlDiv +=resultado.data[i].Mensaje+'<br>';
									}	
									htmlDiv+='	<a href="../Archivos/Archivos-Chat/'+resultado.data[i].Url_Adjunto+'" target="_blank">Ver Adjunto</a>';
								 }else{
									htmlDiv +=resultado.data[i].Mensaje;	
								 }
								 htmlDiv +='</div>';
		'                        <!-- /.direct-chat-text -->'+
		'                      </div>';
							}
							
							if(resultado.data[i].Url_Adjunto!=""){
								archivos=resultado.data[i].Url_Adjunto.toString().split(".");
								for(var j=0; j<array_img.length;j++){
									if(array_img[j].toString()==archivos[1].toUpperCase()){
										li_img+='<li>';
										li_img+='  <a href="#">';
										li_img+='	<a href="../Archivos/Archivos-Chat/'+resultado.data[i].Url_Adjunto+'" target="_blank">Ver Imágen</a>';
										//li_img+='	<span class="name">listadoProd.xls</span>';
										li_img+='  </a>';
										li_img+='</li>';
									}
								}
							}
				}
				//$("#div_adjuntos_chat_imagenes").append(li_img);
				$("#divChat").html(htmlDiv);
			}
		}
	}	
	
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================
	
	carga_actividades=function(id) {

			$.ajax({
			type: "POST",
			url: "/siga/class/biomedica/mtoPreventivo/mtoPreventivo.ajax.php",
			data: {accion: 25, id:id},
			dataType: "JSON",
			async: false,
			cache: false,
			beforeSend: function(){
				$('#loadingState').show();
			},
			success: function (response) {			
				$('#loadingState').hide();
				$("#tablaActividadesSoloLectura").html(response);
				//$('#actividadesTicketrutinas').show();
			}, 
			error: function(response){
				$('#loadingState').hide();
			}
		});


			$.ajax({
			type: "POST",
			url: "/siga/class/biomedica/mtoPreventivo/mtoPreventivo.ajax.php",
			data: {accion: 26, id:id},
			dataType: "JSON",
			async: false,
			cache: false,
			beforeSend: function(){
				$('#loadingState').show();
			},
			success: function (response) {			
				$('#loadingState').hide();
				$("#tablaMaterialesSoloLectura").html(response);
				//$('#id_listaMateriales').show();
			}, 
			error: function(response){
				$('#loadingState').hide();
			}
		});

	}

//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

	function cargarimagenes(hidden_url, file_adjuntos, nombre_url, vista_imagen, Posicion){
		$("#"+hidden_url).val(nombre_url);
		$('#'+file_adjuntos).fileinput({
			uploadUrl: "../Archivos/upload.php?carpeta="+url_direccion_archivos+"",
			uploadAsync: true,
			showUpload: true,
			showRemove: false,
			showPreview: vista_imagen,
			maxFileCount: 0,
			minFileCount: 0,
			browseClass: "btn chs",
			validateInitialCount: true,
			language: 'es',
			
			initialPreviewConfig: [{
			caption: '' + nombre_url + '', 
			width: '100px',
			url: '../Archivos/borrar.php?carpeta='+url_direccion_archivos+'', 
			key: '' + nombre_url + '',  
			extra: { id: 100 }
			}]
			, initialPreview: [
			//NOMBRE IMAGEN CARGADA OBTENER EL NOMBRE DE LA CAJA DE TEXTO
			"<img src='"+url_direccion_archivos+"/" + nombre_url + "' class='kv-preview-data file-preview-image' style='width:auto;height:160px;' alt='Imagen Cargada' title='Imagen Cargada'>"
			]
		});
		
		//Cargar Archivo
		$('#'+file_adjuntos).on('fileuploaded', function (event, data, previewId, index) {
			var form = data.form, files = data.files, extra = data.extra,
				response = data.response, reader = data.reader;
			$('#'+hidden_url).val(response.initialPreviewConfig[0].caption);
			$('#divVer_Imagen'+Posicion).html('<a href="'+url_direccion_archivos+'/'+response.initialPreviewConfig[0].caption+'" target="_blank">Ver Im&aacute;gen</a>');
		});
		
		$('#'+file_adjuntos).on('filereset', function (event) {
			$('#'+hidden_url).val("");
			
			$('#divVer_Imagen'+Posicion).html("");
		});
		
	}
	
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

	function subirimagenes(file_adjuntos, url_hidden, vista_imagen, Posicion){
		//inicializar el file upload
		$('#'+file_adjuntos).fileinput({
			uploadUrl: "../Archivos/upload.php?carpeta="+url_direccion_archivos+"",
			uploadAsync: true,
			showUpload: true,
			showRemove: false,
			showPreview: vista_imagen,
			//showCaption: false,
			maxFileCount: 1,
			minFileCount: 0,
			browseClass: "btn chs",
			validateInitialCount: true,
			language: 'es'
		});
		//Cargar Archivo
		$('#'+file_adjuntos).on('fileuploaded', function (event, data, previewId, index) {
			
			var form = data.form, files = data.files, extra = data.extra,
				response = data.response, reader = data.reader;
			$('#'+url_hidden).val(response.initialPreviewConfig[0].caption);
			$('#divVer_Imagen'+Posicion).html('<a href="'+url_direccion_archivos+'/'+response.initialPreviewConfig[0].caption+'" target="_blank">Ver Im&aacute;gen</a>');
		});
		
		//Eliminar Archivo desde la imagen
		$('#'+file_adjuntos).on('filereset', function (event, data, previewId, index) {
			$('#'+url_hidden).val("");
			$('#divVer_Imagen'+Posicion).html("");
		});

	}
	
//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

	function pre_requisitos(){
		$('#modal_prerequisitos').modal('show');
	}

//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

	function pre_requisitosAprovisionamiento(){
		$('#modal_prerequisitosAprovisionamiento').modal('show');
	}

//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

	function cssBoton(boton) {
		if(boton == 0){
			$('#boton0').attr('class','btn btn-block btn-primary'); 
			$('#boton1').attr('class','btn btn-block btn-default'); 
			$('#boton2').attr('class','btn btn-block btn-default'); 
			$('#boton3').attr('class','btn btn-block btn-default'); 
			$('#boton4').attr('class','btn btn-block btn-default'); 			
		} else if(boton == 1){
			$('#boton0').attr('class','btn btn-block btn-default');
			$('#boton1').attr('class','btn btn-block btn-primary');
			$('#boton2').attr('class','btn btn-block btn-default');
			$('#boton3').attr('class','btn btn-block btn-default');
			$('#boton4').attr('class','btn btn-block btn-default');
		} else if(boton == 2){
			$('#boton0').attr('class','btn btn-block btn-default');
			$('#boton1').attr('class','btn btn-block btn-default');
			$('#boton2').attr('class','btn btn-block btn-primary');
			$('#boton3').attr('class','btn btn-block btn-default');
			$('#boton4').attr('class','btn btn-block btn-default');
		} else if(boton == 3){
			$('#boton0').attr('class','btn btn-block btn-default');
			$('#boton1').attr('class','btn btn-block btn-default');
			$('#boton2').attr('class','btn btn-block btn-default');
			$('#boton3').attr('class','btn btn-block btn-primary');
			$('#boton4').attr('class','btn btn-block btn-default');
		} else if(boton == 4){
			$('#boton0').attr('class','btn btn-block btn-default');
			$('#boton1').attr('class','btn btn-block btn-default');
			$('#boton2').attr('class','btn btn-block btn-default');
			$('#boton3').attr('class','btn btn-block btn-default');
			$('#boton4').attr('class','btn btn-block btn-primary');
		}
	}

//======================================================================================================================================================================================================================
//======================================================================================================================================================================================================================

</script>