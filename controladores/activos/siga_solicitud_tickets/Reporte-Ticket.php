<?php

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once(dirname(__FILE__)."/../../../modelos/activos/dto/siga_solicitud_tickets/Siga_solicitud_ticketsDTO.Class.php");
include_once(dirname(__FILE__)."/../../../modelos/activos/dao/siga_solicitud_tickets/Siga_solicitud_ticketsDAO.Class.php");
include_once(dirname(__FILE__)."/../../../fachadas/activos/siga_solicitud_tickets/Siga_solicitud_ticketsFacade.Class.php");

include_once(dirname(__FILE__)."/../../../modelos/activos/dto/siga_ticket_calificacion/Siga_ticket_calificacionDTO.Class.php");
include_once(dirname(__FILE__)."/../../../fachadas/activos/siga_ticket_calificacion/Siga_ticket_calificacionFacade.Class.php");

include_once(dirname(__FILE__)."/../../../fachadas/activos/Existe_Archivo/Existe_ArchivoFacade.Class.php");
include_once(dirname(__FILE__)."/../../../modelos/activos/dto/siga_ticket_chat/Siga_ticket_chatDTO.Class.php");
include_once(dirname(__FILE__)."/../../../fachadas/activos/siga_ticket_chat/Siga_ticket_chatFacade.Class.php");

//Actividades
include_once(dirname(__FILE__)."/../../../modelos/activos/dto/siga_actividades/Siga_actividadesDTO.Class.php");
include_once(dirname(__FILE__)."/../../../modelos/activos/dao/siga_actividades/Siga_actividadesDAO.Class.php");
include_once(dirname(__FILE__)."/../../../modelos/activos/dto/siga_det_actividades/Siga_det_actividadesDTO.Class.php");
include_once(dirname(__FILE__)."/../../../modelos/activos/dao/siga_det_actividades/Siga_det_actividadesDAO.Class.php");
include_once(dirname(__FILE__)."/../../../fachadas/activos/siga_actividades/Siga_actividadesFacade.Class.php");

include_once(dirname(__FILE__)."/../../../datos/connect/Proveedor.Class.php");
include_once(dirname(__FILE__)."/../../../datos/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__)."/../../../datos/json/JsonEncod.Class.php");
include_once(dirname(__FILE__)."/../../../datos/json/JsonDecod.Class.php");

include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/admin/reporteTicket/reporteTicket.class.php");

//Recibimos nuestra variable mediante GET
@$Id_Solicitud=$_GET["Id_Solicitud"];

$reporteTicketClass = new reporteTicket();

////////////////////////////// Solicitud Tickets
//Instanciamos un obbejeto de esta misma clase "Siga_vale_resguardoFacade";
$siga_solicitud_ticketsFacade = new Siga_solicitud_ticketsFacade();
$siga_solicitud_ticketsDto = new Siga_solicitud_ticketsDTO();
//Cargamos las variables mediante el metodo set
$siga_solicitud_ticketsDto->setEstatus_Reg("1");
$siga_solicitud_ticketsDto->setId_Solicitud($Id_Solicitud);
//Realizamos la consulta y le pasamos el objeto con las variables cargadas
$Respuesta=json_decode($siga_solicitud_ticketsFacade->selectSiga_solicitud_tickets($siga_solicitud_ticketsDto,""), true);
//Accesorios
$Accesorios_Nota_Salida=json_decode($siga_solicitud_ticketsFacade->accesorios_act_ext_nota_salida($Id_Solicitud), true);
$Imagenes_Chat=json_decode($siga_solicitud_ticketsFacade->Archivos_Chat($siga_solicitud_ticketsDto,""), true);
$Archivos_Chat_Otros=json_decode($siga_solicitud_ticketsFacade->Archivos_Chat_Otros($siga_solicitud_ticketsDto,""), true);

////////////////////////////// Chat
$siga_ticket_chatFacade = new Siga_ticket_chatFacade();
$siga_ticket_chatDto = new Siga_ticket_chatDTO();
$siga_ticket_chatDto->setId_Solicitud($Id_Solicitud);
$Chat=json_decode($siga_ticket_chatFacade->selectSiga_ticket_chat($siga_ticket_chatDto,""), true);
$existe_ArchivoFacade = new Existe_ArchivoFacade();

////////////////////////////// Calificacion Tickets
$siga_ticket_calificacionFacade = new Siga_ticket_calificacionFacade();
$siga_ticket_calificacionDto = new Siga_ticket_calificacionDTO();
//Cargamos las variables mediante el metodo set
$siga_ticket_calificacionDto->setId_Solicitud($Id_Solicitud);
//Realizamos la consulta y le pasamos el objeto con las variables cargadas
$Calificacion=json_decode($siga_ticket_calificacionFacade->selectSiga_ticket_calificacion($siga_ticket_calificacionDto,""), true);
$Res_Pregunta1="";
$Desc_Res_Pregunta1="";
$Res_Pregunta2="";
$Desc_Res_Pregunta2="";
$Res_Pregunta3="";
$Desc_Res_Pregunta3="";

$Firma_Base64="";

$Adjuntos_1="";
$Adjuntos_2="";
$Adjuntos_3="";
$Adjuntos_4="";
$Exis_Arch_Adj=false;
$Adjuntos=json_decode($siga_solicitud_ticketsFacade->Archivos_Adjuntos($siga_solicitud_ticketsDto,""), true);
if($Adjuntos["totalCount"]>0) {
	$Adjuntos_1 = $Adjuntos["data"][0]["Archivo_Binario"];
	$Adjuntos_2 = $Adjuntos["data"][0]["Archivo_Binario2"];
	$Adjuntos_3 = $Adjuntos["data"][0]["Archivo_Binario3"];
	$Adjuntos_4 = $Adjuntos["data"][0]["Archivo_Binario4"];

	if($Adjuntos_1!=""){
		$Exis_Arch_Adj=true;
	}
	if($Adjuntos_2!=""){
		$Exis_Arch_Adj=true;
	}
	if($Adjuntos_3!=""){
		$Exis_Arch_Adj=true;
	}
	if($Adjuntos_4!=""){
		$Exis_Arch_Adj=true;
	}
}

if($Calificacion["totalCount"]>0){
	$Res_Pregunta1=$Calificacion["data"][0]["Id_Respuesta1"];
	$Desc_Res_Pregunta1=$Calificacion["data"][0]["Desc_Comentario1"];

	$Res_Pregunta2=$Calificacion["data"][0]["Id_Respuesta2"];
	$Desc_Res_Pregunta2=$Calificacion["data"][0]["Desc_Comentario2"];

	$Res_Pregunta3=$Calificacion["data"][0]["Id_Respuesta3"];
	$Desc_Res_Pregunta3=$Calificacion["data"][0]["Desc_Comentario3"];

	$Firma_Base64=$Calificacion["data"][0]["Archivo_Binario"];
}

//=============================================================================================================================================================================================================
//=============================================================================================================================================================================================================

ob_start();
date_default_timezone_set('America/Mazatlan');
// Estilos css
require_once(dirname(__FILE__).'/../../../html2pdf/css.php');
include_once(dirname(__FILE__)."/../../../poo/cx.php");

$getActividades 		= $reporteTicketClass->getActividadesTicketLectura($Id_Solicitud);
$getMateriales 			= $reporteTicketClass->getMaterialesTicketLectura($Id_Solicitud);
$getActividadesImg	= $reporteTicketClass->getActividadesDetalleImg($Id_Solicitud);
//$getFileChatFil  		= $reporteTicketClass->getChatAdjuntos($Id_Solicitud,1);
// $getFileChatImg  		= $reporteTicketClass->getChatAdjuntos($Id_Solicitud,2);
//$getAdjSolicitudFil = $reporteTicketClass->getAdjuntosSolicitudFil($Id_Solicitud);
//$getAdjSolicitudImg = $reporteTicketClass->getAdjuntosSolicitudImg($Id_Solicitud);


$contador_img = 0;
$fecha_depende_id_actividad="";
$usuario_de_resguardo="";
$mi_id_activo=$Respuesta['data'][0]['Id_Activo'];

if(empty($mi_id_activo)){
	$usuario_de_resguardo=$Respuesta["data"][0]["Usuario"];
}else{
$usuario_de_resguardo_select="
		SELECT 	Nombre_Usuario
		FROM 		siga_usuarios
		WHERE 	No_Usuario=(SELECT b.Num_Empleado FROM siga_activos b WHERE b.Id_Activo=$mi_id_activo)
";

$usuario_de_resguardo_qry=$pdoConexion->query($usuario_de_resguardo_select);
$usuario_de_resguardo_res=$usuario_de_resguardo_qry->fetchAll(PDO::FETCH_COLUMN);
$usuario_de_resguardo=$usuario_de_resguardo_res[0];
}

if($Respuesta["data"][0]["Id_Actividad"]==''){

	$fecha_depende_id_actividad=date("d-m-Y H:i:s", strtotime($Respuesta["data"][0]["Fech_Espera_Cierre"]));
	$texto_de_fecha='Fec por cerrar:';
	$texto_de_cierre='Fec Cierre:';
}else{
		$id_actividad_del_ticket=$Respuesta['data'][0]['Id_Actividad'];

		$fecha_depende_id_actividad_select="
			SELECT TOP(1)	ISNULL(convert(date, a.Fecha_Realizada, 105), '') Fecha_Realizada
			FROM 				siga_det_actividades a WITH(nolock)
			LEFT JOIN 	siga_actividades b WITH(nolock) ON a.Id_Actividad = b.Id_Actividad
			WHERE 			a.Id_Actividad=$id_actividad_del_ticket
			AND 				b.Tipo_Actividad=2
			ORDER BY 		a.Fecha_Realizada DESC
		";
	$fecha_depende_id_actividad_select_qry=$pdoConexion->query($fecha_depende_id_actividad_select);
	$fecha_depende_id_actividad_select_sel=$fecha_depende_id_actividad_select_qry->fetchAll(PDO::FETCH_COLUMN);
	$fecha_depende_id_actividad=$fecha_depende_id_actividad=date("d-m-Y", strtotime($fecha_depende_id_actividad_select_sel[0]));
	$texto_de_fecha='Fec Servicio Concluido:';
	$texto_de_cierre='Fec califico:';
}

?>

<page backtop="28mm" backbottom="5mm" backleft="1mm" backright="1mm" orientation="portrait">

<page_header>

	<table class="tbl-encabezado">

			<tbody>
				<tr>
					<td class="td" style="width: 20%; text-align: left;"><img src="logo.png" alt="" /></td>
					<td class="td" style="width: 50%;"><h3>Formato<br />Tickets</h3></td>
					<td class="td" style="width: 30%; text-align: right;"><img src="../../../dist/img/LOGO-SIGA.PNG" alt="" /></td>
				</tr>
			</tbody>
		</table>
	</page_header>

<page_footer footer="page">
		<div class="div-footer">
			<table class="footer">
				<tfoot>
					<tr class="fila">
						<td><span><strong>Fecha y hora de impresi&oacute;n <?php echo date("d/m/Y H:i:s"); ?> </strong></span></td>
						<td><div><strong>P&aacute;gina [[page_cu]] de [[page_nb]]</strong></div></td>
					</tr>
				</tfoot>
			</table>
		</div>
</page_footer>

<!-- ================================================================================================================================================================================================================ -->
<!-- ================================================================================================================================================================================================================ -->



<div class="container">


 <nobreak>
		<table class="tbl-contenedor" cellpadding="10" cellspacing="0">
			<thead class="thead">
				<tr>
					<th colspan="6">DATOS DEL TICKET <?php echo formatoTextoValido($Respuesta["data"][0]["Id_Solicitud"]);?></th>
				</tr>
			</thead>
			<tbody class="tbody">
				<tr>
					<td class="td" style="width: 9%;<?php echo $style_td;?>">Área Gestora:</td>
					<td class="td" style="width: 20%;" valign="top"><?php  echo formatoTextoValido($Respuesta["data"][0]["Area"]); ?></td>
					<td class="td" style="width: 10%;<?php echo $style_td;?>">Sección:</td>
					<td class="td" style="width: 31%;" valign="top"><?php  echo formatoTextoValido($Respuesta["data"][0]["NombreSeccion"]); ?></td>
					<td class="td" style="width: 10%;<?php echo $style_td;?>">Fec Solicitud:</td>
					<td class="td" style="width: 20%;" valign="top"><?php echo date("d-m-Y H:i:s",strtotime($Respuesta["data"][0]["Fech_Inser"])); ?></td>
				</tr>
				<tr>
					<td class="td" style="width: 9%;<?php echo $style_td;?>">Categor&iacute;a:</td>
					<td class="td" style="width: 20%;" valign="top"><?php echo formatoTextoValido($Respuesta["data"][0]["Categoria"]); ?></td>
					<td class="td" style="width: 10%;<?php echo $style_td;?>">Subcategoria:</td>
					<td class="td" style="width: 31%;" valign="top"><?php echo formatoTextoValido($Respuesta["data"][0]["Subcategoria"]); ?></td>
					<td class="td" style="width: 10%;<?php echo $style_td;?>">Fec seguimiento:</td>
					<td class="td" style="width: 20%;" valign="top"><?php echo date("d-m-Y H:i:s",strtotime($Respuesta["data"][0]["Fech_Seguimiento"])); ?></td>
				</tr>
				<tr>
					<td class="td" style="width: 9%;<?php echo $style_td;?>">Usuario Solicitante:</td>
					<td class="td" style="width: 20%;" valign="top"><?php echo formatoTextoValido($Respuesta["data"][0]["Nombre_Usuario_Inicial"]); ?></td>
					<td class="td" style="width: 10%;<?php echo $style_td;?>">Usuario Resguardo:</td>
					<td class="td" style="width: 31%;" valign="top"><?php echo $usuario_de_resguardo; ?></td>
					<td class="td" style="width: 10%;<?php echo $style_td;?>"><?php echo $texto_de_fecha; ?></td>
					<td class="td" style="width: 20%;" valign="top"><?php  if($fecha_depende_id_actividad != ''){echo $fecha_depende_id_actividad;}else{ echo '';}  ?></td>
				</tr>
				<tr>
					<td class="td" style="width: 9%;<?php echo $style_td;?>">Gestor Seguimiento:</td>
					<td class="td" style="width: 20%;" valign="top"><?php echo formatoTextoValido($Respuesta["data"][0]["Gestor"]); ?></td>
					<td class="td" style="width: 10%;<?php echo $style_td;?>">Prioridad:</td>
					<td class="td" style="width: 31%;" valign="top">
						<?php if($Respuesta["data"][0]["Prioridad"]!=null){
							if($Respuesta["data"][0]["Prioridad"]=="1"){echo "ALTA";}
							else if($Respuesta["data"][0]["Prioridad"]=="2"){echo "MEDIA";}
							else if($Respuesta["data"][0]["Prioridad"]=="3"){echo "BAJA";}
						}?>
					</td>
					<td class="td" style="width: 10%;<?php echo $style_td;?>"><?php echo $texto_de_cierre; ?></td>
					<td class="td" style="width: 20%;" valign="top"><?php echo date("d-m-Y H:i:s",strtotime($Respuesta["data"][0]["Fech_Cierre"])); ?></td>
				</tr>
				<tr>
					<td class="td" style="width: 9%;<?php echo $style_td;?>">Titulo Reporte:</td>
					<td class="td" colspan="5" valign="top"><?php if($Respuesta["data"][0]["Titulo"]!=null){echo str_replace("] [", "]<br />[", $Respuesta["data"][0]["Titulo"]);} ?></td>

				</tr>
				<tr>
					<td class="td" style="width: 9%;<?php echo $style_td;?>">Descripcion detalle de lo reportado: </td>
					<td class="td" style="width: 91%;" colspan="5" valign="top">
						<?php
							if($Respuesta["data"][0]["Desc_Motivo_Reporte"]!=null) {
								// Elimina las etiquetas HTML de <font face> para evitar errores al generar el documento PDF
								/*$textoHtml = str_replace("] [", "]<br />[", $Respuesta["data"][0]["Desc_Motivo_Reporte"]);
								echo preg_replace("/<font face.*?>(.*)?<\/font>/im", "$1", $textoHtml);*/
								echo strip_tags($Respuesta["data"][0]["Desc_Motivo_Reporte"]);
							}
						?>
					</td>
				</tr>
			</tbody>
		</table>
	</nobreak>

<!-- ================================================================================================================================================================================================================ -->
<!-- ================================================================================================================================================================================================================ -->

	<nobreak>
		<br/>
		<table class="tbl-contenedor" cellpadding="10" cellspacing="0">
			<thead class="thead">
				<tr>
					<th colspan="6">DATOS GENERALES ACTIVO</th>
				</tr>
			</thead>
			<tbody class="tbody">
				<tr>
					<td class="td" style="width: 9%;<?php echo $style_td;?>">AF/BC:</td>
					<td class="td" style="width: 20%;" valign="top"><?php echo formatoTextoValido($Respuesta["data"][0]["AF_BC_Ext"]); ?></td>
					<td class="td" style="width: 10%;<?php echo $style_td;?>">Nombre:</td>
					<td class="td" style="width: 31%;" valign="top"><?php echo formatoTextoValido($Respuesta["data"][0]["Nombre_Act_Ext"]); ?></td>
					<td class="td" style="width: 30%;" rowspan="4" colspan="2" align="center">
						<div class="foto">
							<?php
								if($Respuesta["data"][0]["Foto"] != null && $Respuesta["data"][0]["Foto"] != "") {
									$Ruta_Archivo = "../../../Archivos/Archivos-Activos/" . $Respuesta["data"][0]["Foto"];
									if (file_exists($Ruta_Archivo)) { ?><img src="<?php echo $Ruta_Archivo;?>" style="width: 100%;" alt="" /><?php }
								}
								else {
									?>&nbsp;<?php
                                }
							?>
						</div>
					</td>
				</tr>
				<tr>
					<td class="td" style="width: 9%;<?php echo $style_td;?>">Marca:</td>
					<td class="td" style="width: 20%;" valign="top"><?php echo formatoTextoValido($Respuesta["data"][0]["Marca_Act_Ext"]); ?></td>
					<td class="td" style="width: 10%;<?php echo $style_td;?>" rowspan="3">Descripci&oacute;n:</td>
					<td class="td" style="width: 31%;" rowspan="3" valign="top"><?php echo formatoTextoValido($Respuesta["data"][0]["Desc_Lar_Activo"]); ?></td>
				</tr>
				<tr>
					<td class="td" style="width: 9%;<?php echo $style_td;?>">Modelo:</td>
					<td class="td" style="width: 20%;" valign="top"><?php echo formatoTextoValido($Respuesta["data"][0]["Modelo_Act_Ext"]); ?></td>
				</tr>
				<tr>
					<td class="td" style="width: 9%;<?php echo $style_td;?>">SN:</td>
					<td class="td" style="width: 20%;" valign="top"><?php echo formatoTextoValido($Respuesta["data"][0]["No_Serie_Act_Ext"]); ?></td>
				</tr>
				<tr>
					<td class="td" style="width: 9%;<?php echo $style_td;?>">Ubicaci&oacute;n Primaria:</td>
					<td class="td" style="width: 20%;" valign="top"><?php echo formatoTextoValido($Respuesta["data"][0]["Ubic_Prim"]); ?></td>
					<td class="td" style="width: 10%;<?php echo $style_td;?>">Ubicaci&oacute;n Secundaria:</td>
					<td class="td" style="width: 31%;" valign="top"><?php echo formatoTextoValido($Respuesta["data"][0]["Ubic_Sec"]); ?></td>
					<td class="td" style="width: 10%;<?php echo $style_td;?>">Ubicaci&oacute;n Espec&iacute;fica:</td>
					<td class="td" style="width: 20%;" valign="top"><?php echo formatoTextoValido($Respuesta["data"][0]["Ubic_Esp"]); ?></td>
				</tr>
			</tbody>
		</table>
	</nobreak>

	<!-- ================================================================================================================================================================================================================ -->
<!-- ================================================================================================================================================================================================================ -->

	<?php
		if($Chat["totalCount"]>0) { ?>
			<nobreak>
				<br />
				<table class="tbl-contenedor" cellpadding="10" cellspacing="0">
					<thead class="thead">
						<tr>
							<th colspan="2">SEGUIMIENTO CHAT</th>
						</tr>
					</thead>
					<tbody class="tbody">
						<?php
							for($ch=0; $ch<$Chat["totalCount"]; $ch++)
							{
								?><tr>
									<td class="td" style="width: 20%;text-align:center;<?php echo $style_td;?>">
										<?php
											if($Chat["data"][$ch]["Id_Estatus_Proceso"]==2) {
												$Ruta_foto_chat="http://192.168.1.234/Fotos/".$Chat["data"][$ch]["No_Empl_Gestor"].".jpg";
												$Existe_Archivo=json_decode($existe_ArchivoFacade->Existe_Archivo($Ruta_foto_chat), true);
												if($Existe_Archivo["totalCount"]==1){
													echo '<img src="'.$Ruta_foto_chat.'" style="width:40%;" alt="" /><br />';
												}else{
													echo '<img src="sinfoto.png" style="width:40%" alt="" /><br />';
												}
												echo "<span style='font-size:10px; font-weight: bold;'>" . formatoTextoValido($Chat["data"][$ch]["Nombre_Gestor"]) . "</span>";
											}
											else {
												$Ruta_foto_chat="http://192.168.1.234/Fotos/".$Chat["data"][$ch]["No_Empl_Solicitante"].".jpg";
												$Existe_Archivo=json_decode($existe_ArchivoFacade->Existe_Archivo($Ruta_foto_chat), true);
												if($Existe_Archivo["totalCount"]==1){
													echo '<img src="'. $Ruta_foto_chat. '" style="width:40%;" alt="" /><br />';
												}else{
													echo '<img src="sinfoto.png" style="width:40%" alt="" /><br />';
												}
												echo "<span style='font-size:10px; font-weight: bold;'>" . formatoTextoValido($Chat["data"][$ch]["Nombre_Usuario"]) . "</span>";
											}
										?>
									</td>
									<td class="td" style="width: 80%;" valign="top">
										<?php
											echo "<span style='font-size:10px; font-weight: bold'>" . formatoTextoValido($Chat["data"][$ch]["Fecha_Alta"]) . "</span>";
											echo "<br />";
											echo formatoTextoValido($Chat["data"][$ch]["Mensaje"]);
										?>
									</td>
								</tr>
								<?php
							}
						?>
					</tbody>
				</table>
			</nobreak>
			<?php
		}
	?>

<!-- ================================================================================================================================================================================================================ -->
<!-- ================================================================================================================================================================================================================ -->

		<?php
		if($Accesorios_Nota_Salida["totalCount"]>0) { ?>
		<nobreak>
				<br />
				<table class="tbl-contenedor" cellpadding="10" cellspacing="0" style="width: 100%;">
					<thead class="thead">
						<tr>
							<th colspan="6">EQUIPO Y ACCESORIOS ADICIONALES</th>
						</tr>
					</thead>
					<tbody class="tbody">
						<tr>
							<td class="td" style="width: 8%;<?php echo $style_td;?>">Cantidad:</td>
							<td class="td" style="width: 10%;<?php echo $style_td;?>">Unidad:</td>
							<td class="td" style="width: 10%;<?php echo $style_td;?>">Marca:</td>
							<td class="td" style="width: 20%;<?php echo $style_td;?>">Modelo:</td>
							<td class="td" style="width: 30%;<?php echo $style_td;?>">Descripción:</td>
							<td class="td" style="width: 22%;<?php echo $style_td;?>">No. Serie:</td>
						</tr>
						<?php
							for($n=0; $n<$Accesorios_Nota_Salida["totalCount"]; $n++) {
						?>
								<tr>
									<td class="td" style="width: 8px; word-wrap: break-word;overflow-wrap: break-word; white-space: normal; font-size:10px"><?php echo formatoTextoValido($Accesorios_Nota_Salida["data"][$n]["Cantidad_DNS"]); ?></td>
									<td class="td" style="width: 10px; word-wrap: break-word;overflow-wrap: break-word; white-space: normal; font-size:10px"><?php echo formatoTextoValido($Accesorios_Nota_Salida["data"][$n]["Unidad_DNS"]); ?></td>
									<td class="td" style="width: 10px; word-wrap: break-word;overflow-wrap: break-word; white-space: normal; font-size:10px"><?php echo formatoTextoValido($Accesorios_Nota_Salida["data"][$n]["Marca_DNS"]); ?></td>
									<td class="td" style="width: 20px; word-wrap: break-word;overflow-wrap: break-word; white-space: normal; font-size:10px"><?php echo formatoTextoValido($Accesorios_Nota_Salida["data"][$n]["Modelo_DNS"]); ?></td>
									<td class="td" style="width: 30px; word-wrap: break-word;overflow-wrap: break-word; white-space: normal; font-size:10px"><?php echo formatoTextoValido($Accesorios_Nota_Salida["data"][$n]["Descripcion_DNS"]); ?></td>
									<td class="td" style="width: 22px; word-wrap: break-word;overflow-wrap: break-word; white-space: normal; font-size:10px"><?php echo formatoTextoValido($Accesorios_Nota_Salida["data"][$n]["No_Serie_DNS"]); ?></td>
								</tr>
						<?php
							}
						?>
					</tbody>
				</table>
			</nobreak>

<!-- ================================================================================================================================================================================================================ -->
<!-- ================================================================================================================================================================================================================ -->

			<?php if($Respuesta["data"][0]["Nombre_Completo_Ext"]!='') { ?>
				<nobreak>
					<br />
					<table class="tbl-contenedor" cellpadding="10" cellspacing="0">
						<thead class="thead">
							<tr>
								<th colspan="6">DATOS DEL PROVEEDOR</th>
							</tr>
						</thead>
						<tbody class="tbody">
							<tr>
								<td class="td" style="width: 9%;<?php echo $style_td;?>">Empresa:</td>
								<td class="td" style="width: 20%;" valign="top"><?php echo formatoTextoValido($Respuesta["data"][0]["Empresa_Ext"]); ?></td>
								<td class="td" style="width: 10%;<?php echo $style_td;?>">Nombre Proveedor:</td>
								<td class="td" style="width: 31%;" valign="top"><?php echo formatoTextoValido($Respuesta["data"][0]["Nombre_Completo_Ext"]); ?></td>
								<td class="td" style="width: 10%;<?php echo $style_td;?>">Teléfono:</td>
								<td class="td" style="width: 20%;" valign="top"><?php echo formatoTextoValido($Respuesta["data"][0]["Telefono_Ext"]); ?></td>
							</tr>
							<tr>
								<td class="td" style="width: 9%;<?php echo $style_td;?>">Correo:</td>
								<td class="td" colspan="5" style="width: 91%;" valign="top"><a href="#"><?php echo formatoTextoValido($Respuesta["data"][0]["Correo_Ext"]); ?></a></td>
							</tr>
						</tbody>
					</table>
				</nobreak>
			<?php }
		}
		else {
			//
			$Accesorios_Mesa_Ayuda=json_decode($siga_solicitud_ticketsFacade->accesorios_act_ext_mesa_ayuda($Id_Solicitud), true);
			if($Accesorios_Mesa_Ayuda["totalCount"]>0) { ?>
				<nobreak>
					<br />
					<table class="tbl-contenedor" cellpadding="10" cellspacing="0">
						<thead class="thead">
							<tr>
								<th colspan="6">EQUIPO Y ACCESORIOS ADICIONALES</th>
							</tr>
						</thead>
						<tbody class="tbody">
							<tr>
								<td class="td" style="width: 14.28%;<?php echo $style_td;?>">Cantidad:</td>
								<td class="td" style="width: 14.28%;<?php echo $style_td;?>">Unidad:</td>
								<td class="td" style="width: 14.28%;<?php echo $style_td;?>">Marca:</td>
								<td class="td" style="width: 14.28%;<?php echo $style_td;?>">Modelo:</td>
								<td class="td" style="width: 14.28%;<?php echo $style_td;?>">Descripción:</td>
								<td class="td" style="width: 14.28%;<?php echo $style_td;?>">No. Serie:</td>
							</tr>
							<tr>
								<td class="td" style="width: 14.28%;">1</td>
								<td class="td" style="width: 14.28%;">EQU</td>
								<td class="td" style="width: 14.28%;"><?php echo formatoTextoValido($Respuesta["data"][0]["Marca_Act_Ext"]); ?></td>
								<td class="td" style="width: 14.28%;"><?php echo formatoTextoValido($Respuesta["data"][0]["Modelo_Act_Ext"]); ?></td>
								<td class="td" style="width: 14.28%;"><?php echo formatoTextoValido($Respuesta["data"][0]["Nombre_Act_Ext"]); ?></td>
								<td class="td" style="width: 14.28%;"><?php echo formatoTextoValido($Respuesta["data"][0]["No_Serie_Act_Ext"]); ?></td>
							</tr>
							<?php for($j=0; $j<$Accesorios_Mesa_Ayuda["totalCount"]; $j++) { ?>
								<tr>
									<td class="td" style="width: 14.28%;"><?php echo formatoTextoValido($Accesorios_Mesa_Ayuda["data"][$j]["Cantidad_Ext"]); ?></td>
									<td class="td" style="width: 14.28%;"><?php echo formatoTextoValido($Accesorios_Mesa_Ayuda["data"][$j]["Unidad_Ext"]); ?></td>
									<td class="td" style="width: 14.28%;"><?php echo formatoTextoValido($Accesorios_Mesa_Ayuda["data"][$j]["Marca_Ext"]); ?></td>
									<td class="td" style="width: 14.28%;"><?php echo formatoTextoValido($Accesorios_Mesa_Ayuda["data"][$j]["Modelo_Ext"]); ?></td>
									<td class="td" style="width: 14.28%;"><?php echo formatoTextoValido($Accesorios_Mesa_Ayuda["data"][$j]["Nombre_Ext"]); ?></td>
									<td class="td" style="width: 14.28%;"><?php echo formatoTextoValido($Accesorios_Mesa_Ayuda["data"][$j]["No_Serie_Ext"]); ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</nobreak>

<!-- ================================================================================================================================================================================================================ -->
<!-- ================================================================================================================================================================================================================ -->

				<?php if($Respuesta["data"][0]["Nombre_Completo_Ext"]!='') { ?>
					<nobreak>
						<br />

						<table class="tbl-contenedor" cellpadding="10" cellspacing="0">
							<thead class="thead">
								<tr>
									<th colspan="6">DATOS DEL PROVEEDOR</th>
								</tr>
							</thead>
							<tbody class="tbody">
								<tr>
									<td class="td" style="width: 9%;<?php echo $style_td;?>">Empresa:</td>
									<td class="td" style="width: 20%;" valign="top"><?php echo formatoTextoValido($Respuesta["data"][0]["Empresa_Ext"]); ?></td>
									<td class="td" style="width: 10%;<?php echo $style_td;?>">Nombre Proveedor:</td>
									<td class="td" style="width: 31%;" valign="top"><?php echo formatoTextoValido($Respuesta["data"][0]["Nombre_Completo_Ext"]); ?></td>
									<td class="td" style="width: 10%;<?php echo $style_td;?>">Teléfono:</td>
									<td class="td" style="width: 20%;" valign="top"><?php echo formatoTextoValido($Respuesta["data"][0]["Telefono_Ext"]); ?></td>
								</tr>
								<tr>
									<td class="td" style="width: 9%;<?php echo $style_td;?>">Correo:</td>
									<td class="td" colspan="5" style="width: 91%;" valign="top"><a href="#"><?php echo formatoTextoValido($Respuesta["data"][0]["Correo_Ext"]); ?></a></td>
								</tr>
							</tbody>
						</table>
					</nobreak>
					<?php
        }
			}
		}
	?>

<!-- ========================================================================================================================================================================================================= -->
<!-- ========================================================================================================================================================================================================= -->

<?php if($getActividades){?>
<nobreak>
	<br />

		<table style="width:100%; border: 1px solid black; border-collapse: collapse;" >
			<thead >
				<tr style="background-color: #19294a; color: white; border: none;">
					<th colspan="8" style="padding: 8px; text-align: center; width: 100%; border: 1px solid black; border-collapse: collapse;">ACTIVIDADES DE RUTINA</th>
				</tr>
				<tr style="background-color: #19294a; color: white;">
					<th style="width: 1%; font-size:12px; padding: 4px; text-align: center; border: 1px solid black; border-collapse: collapse;">#</th>
					<th style="width: 15%; font-size:12px; padding: 4px; text-align: center; border: 1px solid black; border-collapse: collapse;">Actividades</th>
					<th style="width: 20%; font-size:12px; text-align: center; border: 1px solid black; border-collapse: collapse;">Valor Referencia</th>
					<th style="width: 20%; font-size:12px; text-align: center; border: 1px solid black; border-collapse: collapse;">Valor medido</th>
					<th style="width: 6%; font-size:12px; text-align: center; border: 1px solid black; border-collapse: collapse;">Estatus</th>
					<th style="width: 20%; font-size:12px; text-align: center; border: 1px solid black; border-collapse: collapse;">Observaciones</th>
					<th style="width: 10%; font-size:12px; text-align: center; border: 1px solid black; border-collapse: collapse;">Fch Realizo</th>
					<th style="width: 5%; font-size:12px; text-align: center; border: 1px solid black; border-collapse: collapse;"></th>
				</tr>
			</thead>
			<tbody>

			<?php foreach($getActividades as $item){
				if($item['Estatus_Actividad']==1){$estatus='OK';}
					elseif($item['Estatus_Actividad']==2){$estatus='FALLO';}
					elseif($item['Estatus_Actividad']==3){$estatus='N/A';}
				?>
				<tr>

					<td style="width: 1%; font-size:11px; border: 1px solid #ddd;line-height: 1.42857143;"><?php echo $item['Num_Actividad'];?></td>
					<td style="width: 15%; font-size:11px; border: 1px solid #ddd;line-height: 1.42857143;"><?php echo $item['Nombre_Actividad'];?></td>
					<td style="width: 20%; font-size:11px; border: 1px solid #ddd;line-height: 1.42857143;"><?php echo htmlspecialchars($item['Valor_Referencia'], ENT_QUOTES, 'UTF-8');?></td>
					<td style="width: 20%; font-size:11px; border: 1px solid #ddd;line-height: 1.42857143;"><?php echo htmlspecialchars($item['Valor_Medido'], ENT_QUOTES, 'UTF-8');?></td>
					<td style="width: 6%; font-size:11px; border: 1px solid #ddd;line-height: 1.42857143; text-align: center;"><?php echo $estatus;?></td>
					<td style="width: 20%; font-size:11px; border: 1px solid #ddd;line-height: 1.42857143;"><?php echo $item['Observaciones'];?></td>
					<td style="width: 10%; font-size:11px; border: 1px solid #ddd;line-height: 1.42857143;text-align: center;"><?php echo date("d/m/Y", strtotime($item['Fecha_Realizada']));?></td>
					<td style="width: 5%; font-size:11px; border: 1px solid #ddd;line-height: 1.42857143; text-align: center;">
						<?php if($item['Url_Adjunto']){
						$extAutorizadas = array('pdf','xls','xlsx','doc','docx','ppt','pptx');
						$extension 			= pathinfo($item['Url_Adjunto'], PATHINFO_EXTENSION);

							if(in_array($extension,$extAutorizadas)){?>
								<a href="https://apps2.hospitalsatelite.com/siga/descargar.php?file=<?php echo urlencode($item['Url_Adjunto']);?>&url=/Archivos/Archivos-Actividades/Mantenimiento-Preventivo/" target="_blank">
									<img src="../../../dist/img/svg/download.png" alt="Adjunto">
								</a>
						<?php	echo $extension;} else { ?>
								<img src="../../../dist/img/svg/camara.png" alt="Adjunto">
						<?php	}
						}
					?>
					</td>
				</tr>
			<?php

		}?>

			</tbody>
		</table>

</nobreak>
<?php } ?>

<!-- ========================================================================================================================================================================================================= -->
<!-- ========================================================================================================================================================================================================= -->

<?php if($getActividadesImg){
$numArchivos = count($getActividadesImg);
?>
<nobreak>
	<br />

<!-- <div class="container">
  <div class="row">
    <div class="col">Column</div>
    <div class="col">Column</div>
    <div class="w-100"></div>
    <div class="col">Column</div>
    <div class="col">Column</div>
  </div>
</div> -->

		<table style="width:100%; border: 1px solid black; border-collapse: collapse;" >
			<thead>
				<tr style="background-color: #19294a; color: white; border: none;">
					<th colspan="2" style="padding: 8px; text-align: center; width: 100%; border: 1px solid black; border-collapse: collapse;">IMAGENES ACTIVIDADES</th>
				</tr>
			</thead>
			<tbody>

			<?php foreach($getActividades as $item){
					$extAutorizadas = array('pdf','xls','xlsx','doc','docx','ppt','pptx');
					$extension = pathinfo($item['Url_Adjunto'], PATHINFO_EXTENSION);
					if($item['Url_Adjunto']){
						if(!in_array($extension,$extAutorizadas)){
				?>

				<tr>
					<td style="width: 1%; font-size:11px; border: 1px solid #ddd;line-height: 1.42857143;"><?php echo $item['Num_Actividad'];?></td>
					<td style="font-size:11px; border: 1px solid #ddd; line-height: 1.42857143;">						
						<img src="../../../Archivos/Archivos-Actividades/Mantenimiento-Preventivo/<?php echo $item['Url_Adjunto']; ?>" alt="" width="200" height="200">
					</td>					
				</tr>

				<?php }					
				}
			} ?>

			</tbody>
		</table>

</nobreak>
<?php } ?>

<!-- ========================================================================================================================================================================================================= -->
<!-- ========================================================================================================================================================================================================= -->

<?php if($getMateriales){?>
<nobreak>
	<br/>

		<table style="width:100%; border: 1px solid black; border-collapse: collapse;" >
			<thead >
				<tr style="background-color: #19294a; color: white; border: none;">
					<th colspan="11" style="padding: 8px; text-align: center; width: 100%; border: 1px solid black; border-collapse: collapse;">MATERIALES</th>
				</tr>
				<tr style="background-color: #19294a; color: white;">
					<th style="width: 15%; font-size:11px; text-align: center; border: 1px solid black; border-collapse: collapse;">SKU</th>
					<th style="width: 20%; font-size:11px; text-align: center; border: 1px solid black; border-collapse: collapse;">Material</th>
					<th style="width: 5%; font-size:11px; text-align: center; border: 1px solid black; border-collapse: collapse;">Origen</th>
					<th style="width: 8%; font-size:11px; text-align: center; border: 1px solid black; border-collapse: collapse;">Folio Almacen</th>
					<th style="width: 5%; font-size:11px; text-align: center; border: 1px solid black; border-collapse: collapse;">Cve Mat</th>
					<th style="width: 5%; font-size:11px; text-align: center; border: 1px solid black; border-collapse: collapse;">Cve U/M</th>
					<th style="width: 10%; font-size:11px; text-align: center; border: 1px solid black; border-collapse: collapse;">Clave Num Parte</th>
					<th style="width: 10%; font-size:11px; text-align: center; border: 1px solid black; border-collapse: collapse;">Clave Referencia</th>
					<th style="width: 7%; font-size:11px; text-align: center; border: 1px solid black; border-collapse: collapse;">Costo</th>
					<th style="width: 5%; font-size:11px; text-align: center; border: 1px solid black; border-collapse: collapse;">Cant</th>
					<th style="width: 8%; font-size:11px; text-align: center; border: 1px solid black; border-collapse: collapse;">Total</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($getMateriales as $item){ $total = $total+$item['total']; ?>
				<tr>
					<td style="width: 15%; font-size:11px; border: 1px solid #ddd;line-height: 1.42857143; word-wrap: break-word;"><?php echo $item['sku_material'];?></td>
					<td style="width: 20%; font-size:11px; border: 1px solid #ddd;line-height: 1.42857143; word-wrap: break-word;"><?php echo $item['descripcion_material'];?></td>
					<td style="width: 5%; font-size:11px; border: 1px solid #ddd;line-height: 1.42857143; word-wrap: break-word;"><?php echo $item['Origen'];?></td>
					<td style="width: 8%; font-size:11px; border: 1px solid #ddd;line-height: 1.42857143; word-wrap: break-word;"><?php echo $item['folio_almacen_material'];?></td>
					<td style="width: 5%; font-size:11px; border: 1px solid #ddd;line-height: 1.42857143; word-wrap: break-word;"><?php echo $item['clase_material'];?></td>
					<td style="width: 5%; font-size:11px; border: 1px solid #ddd;line-height: 1.42857143; word-wrap: break-word; "><?php echo $item['unidad_material'];?></td>
					<td style="width: 10%; font-size:11px; border: 1px solid #ddd;line-height: 1.42857143; word-wrap: break-word; " ><?php echo $item['numDeParte'];?></td>
					<td style="width: 10%; font-size:11px; border: 1px solid #ddd;line-height: 1.42857143; word-wrap: break-word; " ><?php echo $item['referencia'];?></td>
					<td style="width: 7%; font-size:11px; border: 1px solid #ddd;line-height: 1.42857143; text-align: right; word-wrap: break-word;" ><?php echo number_format($item['costo_material'],2);?></td>
					<td style="width: 5%; font-size:11px; border: 1px solid #ddd;line-height: 1.42857143; text-align: center; word-wrap: break-word;" ><?php echo $item['cantidad_material'];?></td>
					<td style="width: 8%; font-size:11px; border: 1px solid #ddd;line-height: 1.42857143; text-align: right; word-wrap: break-word;" ><?php echo number_format($item['total'],2);?></td>
				</tr>
			<?php }?>
				<tr style="background-color: #19294a; color: white; border: none;">
					<td style="width: 15%; font-size:11px; border: 1px solid #ddd;line-height: 1.42857143; word-wrap: break-word;"></td>
					<td style="width: 20%; font-size:11px; border: 1px solid #ddd;line-height: 1.42857143; word-wrap: break-word;"></td>
					<td style="width: 5%; font-size:11px; border: 1px solid #ddd;line-height: 1.42857143; word-wrap: break-word;"></td>
					<td style="width: 8%; font-size:11px; border: 1px solid #ddd;line-height: 1.42857143; word-wrap: break-word;"></td>
					<td style="width: 5%; font-size:11px; border: 1px solid #ddd;line-height: 1.42857143; word-wrap: break-word;"></td>
					<td style="width: 5%; font-size:11px; border: 1px solid #ddd;line-height: 1.42857143; word-wrap: break-word; "></td>
					<td style="width: 10%; font-size:11px; border: 1px solid #ddd;line-height: 1.42857143; word-wrap: break-word; " ></td>
					<td style="width: 10%; font-size:11px; border: 1px solid #ddd;line-height: 1.42857143; word-wrap: break-word; " ></td>
					<td style="width: 7%; font-size:11px; border: 1px solid #ddd;line-height: 1.42857143; text-align: right; word-wrap: break-word;" ></td>
					<td style="width: 5%; font-size:11px; border: 1px solid #ddd;line-height: 1.42857143; text-align: center; word-wrap: break-word;" ></td>
					<td style="width: 8%; font-size:11px; border: 1px solid #ddd;line-height: 1.42857143; text-align: right; word-wrap: break-word;" ><?php echo number_format($total,2);?></td>
				</tr>
			</tbody>
		</table>

</nobreak>
<?php } ?>

<!-- ================================================================================================================================================================================================================ -->
<!-- ================================================================================================================================================================================================================ -->


<?php
	if($Imagenes_Chat != "" && $Imagenes_Chat["totalCount"] > 0) {
?>
<nobreak>
		<br />
			<table class="tbl-contenedor" cellpadding="10" cellspacing="0">
				<thead class="thead">
					<tr>
						<th colspan="2">ADJUNTOS CHAT</th>
					</tr>
				</thead>
				<tbody class="tbody">
					<?php
						if($Imagenes_Chat["totalCount"] > 0) {
							$contadoradjuntos_img = 0;
							$tablafoto = "";
							$tablafotolabel = "";
							// Indica si hay una fila abierta
							$trAbierto = false;

							for($m = 0; $m < $Imagenes_Chat["totalCount"]; $m++) {
								if($Imagenes_Chat["data"][$m]["Url_Adjunto"] != null && $Imagenes_Chat["data"][$m]["Url_Adjunto"] != "") {
									$contadoradjuntos_img = $contadoradjuntos_img + 1;

									// Abre una fila para pintar imagenes
									if($contadoradjuntos_img % 2 !=0){
										?><tr><?php
										$trAbierto = true;
									}

									// Escribe la imagen
									?><td class="td-imagen-adjunto">
										<img alt="" src="../../../Archivos/Archivos-Chat/<?php echo $Imagenes_Chat["data"][$m]["Url_Adjunto"]; ?>" width="260" height="260" />
										<br />
										Foto <?php echo $contadoradjuntos_img; ?>
									</td><?php
								}

								// Cierra la fila que posiblemente ha sido abierta
								$cerrarFila = false;
								if($m < ($Imagenes_Chat["totalCount"] - 1)){
									// Se debe cerrar la fila ya que se han completado las 2 imagenes por fila
									if($contadoradjuntos_img % 2 == 0) { $cerrarFila = true; }
                                }
								else{
									$cerrarFila = true;
                                }

								if($cerrarFila && $trAbierto) {
									// Rellena con celda (td) vacia para completar la fila
									if($contadoradjuntos_img % 2 != 0) { ?><td class="td-imagen-adjunto">&nbsp;</td><?php }
									// Cierra la fila
									?></tr><?php
									$trAbierto = false;
                  }
							}
						}
					?>
				</tbody>
			</table>
		<!-- </page> -->
</nobreak>
<?php
	}
?>

<!-- ================================================================================================================================================================================================================ -->
<!-- ================================================================================================================================================================================================================ -->

<nobreak>
		<br />
		<table class="tbl-contenedor" cellpadding="10" cellspacing="0">
			<thead class="thead">
				<tr>
					<th colspan="6">DATOS TICKET CERRADO</th>
				</tr>
			</thead>
			<tbody class="tbody">
				<tr>
					<td class="td" style="width: 9%;<?php echo $style_td;?>">Motivo Aparente (Reportado):</td>
					<td class="td" style="width: 20%;" valign="top"><?php echo formatoTextoValido($Respuesta["data"][0]["Desc_Motivo_Aparente"]);?></td>
					<td class="td" style="width: 10%;<?php echo $style_td;?>">Motivo Real Encontrado:</td>
					<td class="td" style="width: 31%;" valign="top"><?php echo formatoTextoValido($Respuesta["data"][0]["Desc_Motivo_Real"]);?></td>
					<td class="td" style="width: 10%;<?php echo $style_td;?>">Estatus Final del Equipo:</td>
					<td class="td" style="width: 20%;" valign="top"><?php echo formatoTextoValido($Respuesta["data"][0]["Desc_Est_Equipo"]);?></td>
				</tr>
				<tr>
					<td class="td" style="width: 9%;<?php echo $style_td;?>"  >Descripción de Acciones Realizadas:</td>
					<td class="td" colspan="5" style="width: 91%;" valign="top"><?php echo formatoTextoValido($Respuesta["data"][0]["ComentarioCierre"]); ?></td>
				</tr>
			</tbody>
		</table>
	</nobreak>


<!-- ================================================================================================================================================================================================================ -->
<!-- ================================================================================================================================================================================================================ -->

	<nobreak>
		<br />
		<table class="tbl-contenedor" cellpadding="10" cellspacing="0">
			<thead class="thead">
				<tr>
					<th colspan="5">SOLUCIÓN OFRECIDA</th>
				</tr>
			</thead>
			<tbody class="tbody">
				<tr>
					<td class="td-calificacion"><?php if($Res_Pregunta1 != "") { echo ($Res_Pregunta1 == "5" ? '<img src="../../../dist/img/05-face.png" alt="" />' : '<img  src="../../../dist/img/05-face-off.png" alt="" />'); } ?></td>
					<td class="td-calificacion"><?php if($Res_Pregunta1 != "") { echo ($Res_Pregunta1 == "4" ? '<img src="../../../dist/img/04-face.png" alt="" />' : '<img src="../../../dist/img/04-face-off.png" alt="" />'); } ?></td>
					<td class="td-calificacion"><?php if($Res_Pregunta1 != "") { echo ($Res_Pregunta1 == "3" ? '<img src="../../../dist/img/03-face.png" alt="" />' : '<img src="../../../dist/img/03-face-off.png" alt="" />'); } ?></td>
					<td class="td-calificacion"><?php if($Res_Pregunta1 != "") { echo ($Res_Pregunta1 == "2" ? '<img src="../../../dist/img/02-face.png" alt="" />' : '<img src="../../../dist/img/02-face-off.png" alt="" />'); } ?></td>
					<td class="td-calificacion"><?php if($Res_Pregunta1 != "") { echo ($Res_Pregunta1 == "1" ? '<img src="../../../dist/img/01-face.png" alt="" />' : '<img src="../../../dist/img/01-face-off.png" alt="" />'); } ?></td>
				</tr>
				<tr>
					<td class="comentarios" colspan="5">Comentarios: <?php echo formatoTextoValido($Desc_Res_Pregunta1); ?></td>
				</tr>
			</tbody>
		</table>
	</nobreak>

<!-- ================================================================================================================================================================================================================ -->
<!-- ================================================================================================================================================================================================================ -->

	<nobreak>
		<br />

		<table class="tbl-contenedor" cellpadding="10" cellspacing="0">
			<thead class="thead">
				<tr>
					<th colspan="5">ACTITUD DE LA SOLUCIÓN</th>
				</tr>
			</thead>
			<tbody class="tbody">
				<tr>
					<td class="td-calificacion"><?php if($Res_Pregunta2 != "") { echo($Res_Pregunta2 == "5" ? '<img src="../../../dist/img/05-face.png" alt="" />' : '<img src="../../../dist/img/05-face-off.png" alt="" />'); } ?></td>
					<td class="td-calificacion"><?php if($Res_Pregunta2 != "") { echo($Res_Pregunta2 == "4" ? '<img src="../../../dist/img/04-face.png" alt="" />' : '<img src="../../../dist/img/04-face-off.png" alt="" />'); } ?></td>
					<td class="td-calificacion"><?php if($Res_Pregunta2 != "") { echo($Res_Pregunta2 == "3" ? '<img src="../../../dist/img/03-face.png" alt="" />' : '<img src="../../../dist/img/03-face-off.png" alt="" />'); } ?></td>
					<td class="td-calificacion"><?php if($Res_Pregunta2 != "") { echo($Res_Pregunta2 == "2" ? '<img src="../../../dist/img/02-face.png" alt="" />' : '<img src="../../../dist/img/02-face-off.png" alt="" />'); } ?></td>
					<td class="td-calificacion"><?php if($Res_Pregunta2 != "") { echo($Res_Pregunta2 == "1" ? '<img src="../../../dist/img/01-face.png" alt="" />' : '<img src="../../../dist/img/01-face-off.png" alt="" />'); } ?></td>
				</tr>
				<tr>
					<td class="comentarios" colspan="5">Comentarios: <?php echo formatoTextoValido($Desc_Res_Pregunta2); ?></td>
				</tr>
			</tbody>
		</table>

	</nobreak>

<!-- ================================================================================================================================================================================================================ -->
<!-- ================================================================================================================================================================================================================ -->

	<nobreak>
		<br />
		<table class="tbl-contenedor" cellpadding="10"  cellspacing="0">
			<thead class="thead">
				<tr>
					<th colspan="5">TIEMPO DE RESPUESTA</th>
				</tr>
			</thead>
			<tbody class="tbody">
				<tr>
					<td class="td-calificacion"><?php if($Res_Pregunta3 != "") { echo($Res_Pregunta3 == "5" ? '<img src="../../../dist/img/05-face.png" alt="" />' : '<img src="../../../dist/img/05-face-off.png" alt="" />'); } ?></td>
					<td class="td-calificacion"><?php if($Res_Pregunta3 != "") { echo($Res_Pregunta3 == "4" ? '<img src="../../../dist/img/04-face.png" alt="" />' : '<img src="../../../dist/img/04-face-off.png" alt="" />'); } ?></td>
					<td class="td-calificacion"><?php if($Res_Pregunta3 != "") { echo($Res_Pregunta3 == "3" ? '<img src="../../../dist/img/03-face.png" alt="" />' : '<img src="../../../dist/img/03-face-off.png" alt="" />'); } ?></td>
					<td class="td-calificacion"><?php if($Res_Pregunta3 != "") { echo($Res_Pregunta3 == "2" ? '<img src="../../../dist/img/02-face.png" alt="" />' : '<img src="../../../dist/img/02-face-off.png" alt="" />'); } ?></td>
					<td class="td-calificacion"><?php if($Res_Pregunta3 != "") { echo($Res_Pregunta3 == "1" ? '<img src="../../../dist/img/01-face.png" alt="" />' : '<img src="../../../dist/img/01-face-off.png" alt="" />'); } ?></td>
				</tr>
				<tr>
					<td class="comentarios" colspan="5">Comentarios: <?php echo formatoTextoValido($Desc_Res_Pregunta3); ?></td>
				</tr>
			</tbody>
		</table>
	</nobreak>

<!-- ================================================================================================================================================================================================================ -->
<!-- ================================================================================================================================================================================================================ -->

	<nobreak>
		<br />
		<table class="tbl-contenedor" cellpadding="10"  cellspacing="0">
			<thead class="thead">
				<tr>
					<th colspan="2">NOMBRE DE USUARIO Y GESTOR INICIALES</th>
				</tr>
			</thead>
			<tbody class="tbody">
				<tr>
					<td class="td" style="width: 50%;">USUARIO SOLICITANTE</td>
					<td class="td" style="width: 50%;">GESTOR SEGUIMIENTO</td>
				</tr>
				<tr>
					<td class="td sign" style="width: 50%;">
						<?php
							echo "Firma<br /><br /><br /><br /><br /><br />";
							if($Respuesta["data"][0]["Usuario"] != null){
								echo formatoTextoValido($Respuesta["data"][0]["No_Usuario_Inicial"]);
								echo "&nbsp;&nbsp;";
								echo $Respuesta["data"][0]["Nombre_Usuario_Inicial"]; //formatoTextoValido($Respuesta["data"][0]["Nombre_Usuario_Inicial"]);
							}
							echo "<br />";
							//echo 'Fecha Alex:'.formatoTextoValido($Respuesta["data"][0]["Fech_Solicitud"]);
							echo date("d-m-Y H:i", strtotime($Respuesta["data"][0]["Fech_Solicitud"]));
						?>
					</td>
					<td class="td sign" style="width: 50%;">
						Firma<br /><br /><br /><br /><br /><br />
						<?php if($Respuesta["data"][0]["Gestor"] != null) {
							echo formatoTextoValido($Respuesta["data"][0]["No_Gestor"]);
							echo "&nbsp;&nbsp;";
							echo formatoTextoValido($Respuesta["data"][0]["Gestor"]);
						} ?>
						<br />
						<?php //echo formatoTextoValido($Respuesta["data"][0]["Fech_Seguimiento"]);
									echo date("d-m-Y H:i", strtotime($Respuesta["data"][0]["Fech_Seguimiento"]));
						?>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="th">USUARIO Y GESTOR FINALES</td>
				</tr>
				<tr>
					<td class="td" style="width: 50%;">FINAL QUE RECIBE</td>
					<td class="td" style="width: 50%;">GESTOR FINAL</td>
				</tr>
				<tr>
					<td class="td sign" style="width: 50%;">
						<?php
							if($Firma_Base64 != "") { ?>
							Firma
								<br>
								<?php
								// Si ya viene con prefijo, lo usas directamente
								if (strpos($Firma_Base64, 'data:image') === 0) { ?>
										<img src="<?php echo $Firma_Base64; ?>" width="120" height="60">
								<?php 
								} else { 
										// Si NO tiene prefijo, lo agregas
										$mime = 'image/jpeg'; // o image/png según tu caso real
										?>
										<img src="data:<?php echo $mime; ?>;base64,<?php echo $Firma_Base64; ?>" width="120" height="60">
								<?php 
								} ?>
								<br>
								FIRMADO POR:
								<br>

							<?php
									if($Respuesta["data"][0]["Usuario"] != null) {
										echo formatoTextoValido($Respuesta["data"][0]["No_Usuario"]);
										echo "&nbsp;&nbsp;";
										echo formatoTextoValido($Respuesta["data"][0]["Usuario"]);
									}
								?>

							<br />
								<?php //echo formatoTextoValido($Respuesta["data"][0]["Fech_Cierre"]);
											echo date("d-m-Y H:i", strtotime($Respuesta["data"][0]["Fech_Cierre"]));
								?>
							<?php
                            }
							else {
								echo "Firma<br /><br /><br /><br /><br /><br />FIRMADO POR:<br />";
								if($Respuesta["data"][0]["Usuario"]!=null){
									echo formatoTextoValido($Respuesta["data"][0]["No_Usuario"]);
									echo "&nbsp;&nbsp;";
									echo formatoTextoValido($Respuesta["data"][0]["Usuario"]);
								}
								echo "<br />";
								//echo formatoTextoValido($Respuesta["data"][0]["Fech_Cierre"]);
								echo date("d-m-Y H:i", strtotime($Respuesta["data"][0]["Fech_Cierre"]));
							}
						?>
					</td>
					<td class="td sign" style="width: 50%;">
						Firma<br /><br /><br /><br /><br /><br />
						FIRMADO DIGITALMENTE POR<br />
						<?php
							echo formatoTextoValido($Respuesta["data"][0]["Gestor_Finaliza"]);
							echo "<br />";
							//echo formatoTextoValido($Respuesta["data"][0]["Fech_Cierre"]);
							echo date("d-m-Y H:i", strtotime($Respuesta["data"][0]["Fech_Cierre"]));
						?>
					</td>
				</tr>
			</tbody>
		</table>
	</nobreak>

<!-- ================================================================================================================================================================================================================ -->
<!-- ================================================================================================================================================================================================================ -->

	<?php	
		if($Exis_Arch_Adj == true) {
	?>
			<nobreak>
				<br />
				<table class="tbl-contenedor" cellpadding="10" cellspacing="0">
					<thead class="thead">
						<tr>
							<th colspan="2" class="td" style="border-top: 1px solid #ddd;line-height: 1.42857143;padding: 8px;vertical-align: top;font-size:13px">ADJUNTOS APP</th>
						</tr>
					</thead>
					<tbody class="tbody">
						<tr>
							<td class="td" style="width: 50%;" align="center">
								<?php
									if($Adjuntos_1!=""){
										$baseFromJavascript = "data:image/jpeg;base64,".$Adjuntos_1.""; $baseFromJavascript=preg_replace('#^data:image/\w+;base64,#i', '', $baseFromJavascript);
										list($width, $height, $type, $attr) = getimagesize("data:image/png;base64,".$baseFromJavascript);
										if($width<$height) {
											echo '<img alt="" src="data:image/png;base64,' . $baseFromJavascript . '" width="260" height="370" />';
										} else {
											echo '<img alt="" src="data:image/png;base64,' . $baseFromJavascript . '" width="375" height="360" />';
										}
									}
								?>
							</td>
							<td class="td" style="width: 50%;" align="center">
								<?php
									if($Adjuntos_2!=""){
										$baseFromJavascript = "data:image/jpeg;base64,".$Adjuntos_2.""; $baseFromJavascript=preg_replace('#^data:image/\w+;base64,#i', '', $baseFromJavascript);
										list($width, $height, $type, $attr) = getimagesize("data:image/png;base64,".$baseFromJavascript);
										if($width<$height) {
											echo '<img alt="" src="data:image/png;base64,' . $baseFromJavascript . '" width="260" height="390" />';
										} else {
											echo '<img alt="" src="data:image/png;base64,' . $baseFromJavascript . '" width="375" height="260" />';
										}
									}
								?>
							</td>
						</tr>
						<tr>
							<td class="td" style="width: 50%;" align="center">
								<?php
									if($Adjuntos_3!=""){
										$baseFromJavascript = "data:image/jpeg;base64,".$Adjuntos_3.""; $baseFromJavascript=preg_replace('#^data:image/\w+;base64,#i', '', $baseFromJavascript);
										list($width, $height, $type, $attr) = getimagesize("data:image/png;base64,".$baseFromJavascript);
										if($width<$height) {
											echo '<img alt="" src="data:image/png;base64,' . $baseFromJavascript . '" width="260" height="390" />';
										} else {
											echo '<img alt="" src="data:image/png;base64,' . $baseFromJavascript . '" width="375" height="260" />';
										}
									}
								?>
							</td>
							<td class="td" style="width: 50%;" align="center">
								<?php
									if($Adjuntos_4!=""){
										$baseFromJavascript = "data:image/jpeg;base64,".$Adjuntos_4.""; $baseFromJavascript=preg_replace('#^data:image/\w+;base64,#i', '', $baseFromJavascript);
										list($width, $height, $type, $attr) = getimagesize("data:image/png;base64,".$baseFromJavascript);
										if($width<$height) {
											echo '<img alt="" src="data:image/png;base64,' . $baseFromJavascript . '" width="260" height="390" />';
										} else {
											echo '<img alt="" src="data:image/png;base64,' . $baseFromJavascript . '" width="375" height="260" />';
										}
									}
								?>
							</td>
						</tr>
					</tbody>
				</table>
			</nobreak>
			<?php
        }
	?>

<!-- ================================================================================================================================================================================================================ -->
<!-- ================================================================================================================================================================================================================ -->

<?php if($contador_img > 0) { ?>

		<nobreak>
			<table class="tbl-contenedor" cellpadding="10" cellspacing="0">
				<thead class="thead">
					<tr>
						<th colspan="2">ADJUNTOS</th>
					</tr>
				</thead>
				<tbody class="tbody">
					<?php
						if($Actividades["totalCountDetalle"]>0){
							$contadoradjuntos_img=0;
							$tablafoto="";
							$tablafotolabel="";

							for($m=0;$m<$Actividades["totalCountDetalle"];$m++){
								if($Actividades["data_det"][$m]["Url_Adjunto"]!=null){
									if($Actividades["data_det"][$m]["Url_Adjunto"]!=""){
										$contadoradjuntos_img=$contadoradjuntos_img+1;
										if($contadoradjuntos_img%2!=0){
											$tablafotolabel.= '<tr>';
										}

										$extension = explode(".", $Actividades["data_det"][$m]["Url_Adjunto"]);
										$tablafotolabel.='<td class="td" style="width: 50%;">';
										$tablafotolabel.='	<div align="center">';
										if($extension[1]=="png"||$extension[1]=="jpg"||$extension[1]=="jpeg"||$extension[1]=="gif"){
											$tablafotolabel.='<img alt="" src="../../../Archivos/Archivos-Actividades/Mantenimiento-Preventivo/'.$Actividades["data_det"][$m]["Url_Adjunto"].'" width="260" height="260" />';
										}else{
											$tablafotolabel.='<a href="../../../Archivos/Archivos-Actividades/Mantenimiento-Preventivo/'.$Actividades["data_det"][$m]["Url_Adjunto"].'" target="_blank">Descargar '.$extension[1].'</a>';
										}
										$tablafotolabel.='	</div>';
										$tablafotolabel.='	<br />';
										$tablafotolabel.='	<div style="text-align:center;background:#f4f4f4;font-size: 11px;">Adjunto '. $contadoradjuntos_img .'</div>';
										$tablafotolabel.='</td>';

										if($contadoradjuntos_img%2==0){
											$tablafotolabel.='</tr>';
										}
									}
								}
							}

							if($contadoradjuntos_img%2!=0) {
								$tablafotolabel.='</tr>';
							}
							echo $tablafotolabel;
						}
					?>
				</tbody>
			</table>
		</nobreak>
<?php
	}
?>

<!-- ================================================================================================================================================================================================================ -->
<!-- ================================================================================================================================================================================================================ -->

</div>

<!-- ================================================================================================================================================================================================================ -->
<!-- ================================================================================================================================================================================================================ -->

</page>



<?php
//}
    //En una variable llamada $content se obtiene lo que tenga la ruta especificada
    //NOTA: Se usa ob_get_clean porque trae SOLO el contenido
    //Evitará este error tan común en FPDF:
    //FPDF error: Some data has already been output, can't send PDF

	//Eliminamos los archivos del directorio
	//eliminarDir("archivospdf");
	$content = ob_get_clean();
    //Se obtiene la librería
    require_once(dirname(__FILE__).'/../../../html2pdf/html2pdf.class.php');
    /* Las lineas siguientes siempre serán las mismas
     * A mi parecer no hay mucho que explicar. Se explican
     * por sí solas :D
     * */
    try
    {
        $html2pdf = new HTML2PDF('P', 'letter', 'es', true, 'UTF-8', 3); //Configura la hoja
        $html2pdf->pdf->SetDisplayMode('fullpage'); //Ver otros parámetros para SetDisplaMode
        $html2pdf->writeHTML($content); //Se escribe el contenido
		//$filename = "archivospdf/".(string)time() . ".pdf";
        $html2pdf->Output("solicitud_ticket.pdf");
		// return the filename to ajax request
		//echo $filename;
	}
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
?>


<?php
	// Función auxiliar para devolver texto o un espacio vacío
	function formatoTextoValido(string $cadenaParametro = null){
		$cadena = "&nbsp;";
		// Determina si la cadena se encuentra vacía y formatea el texto pasado como parámetro
		if($cadenaParametro != null && $cadenaParametro != "" && !empty($cadenaParametro)) {
			$cadena = htmlentities($cadenaParametro);
        }
		// Devuelve la cadena de texto
		return $cadena;
    }
?>