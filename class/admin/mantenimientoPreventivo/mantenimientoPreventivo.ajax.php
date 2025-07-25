<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/admin/mantenimientoPreventivo/mantenimientoPreventivo.class.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/admin/utilerias/util.class.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/catalogos/catalogos.class.php");

if(isset($_POST['accion']) && 
$_POST['accion'] !=='') {

$accion = trim($_POST['accion']);
$mantenimientoPreventivoClass = new mantenimientoPreventivo();
$utilClass                    = new util();
$catalogosClass 							= new catalogos();

  if($accion==1){
    
    $agnioActual 			= $_POST['agnioActual'];
		$id_Activo 				= $_POST['id_Activo'];
		$cmbubicacionprim = $_POST['cmbubicacionprim'];
		$cmbubicacionsec 	= $_POST['cmbubicacionsec'];
		$cmbclase 				= $_POST['cmbclase'];
		$cmbclasificacion = $_POST['cmbclasificacion'];
		$cmbOdernAscDesc 	= $_POST['cmbOdernAscDesc'];
		$cmbfamilia				= $_POST['cmbfamilia'];
		$cmbsubfamilia		= $_POST['cmbsubfamilia'];
		$selectUsuarios   = $_POST['selectUsuarios'];
		$textModeloGlobal = $_POST['text_Modelo_Global'];
		$textMarcaGlobal  = $_POST['text_Marca_Global'];
		$textNombreRutina = $_POST['text_Nombre_Rutina'];
		$textDescripcionCorta = $_POST['textDescripcionCorta'];
		$cmbGestor 				= $_POST['cmbGestor'];
		$Id_Area 					= $_POST['Id_Area'];

    $tablaArray = array();
    $info = $mantenimientoPreventivoClass->sigaTablaGlobal($Id_Area,$agnioActual,$id_Activo, $cmbubicacionprim, $cmbubicacionsec, $cmbclase ,$cmbclasificacion ,$cmbfamilia, $cmbsubfamilia, $selectUsuarios, $textModeloGlobal, $textMarcaGlobal, $textNombreRutina, $textDescripcionCorta, $cmbGestor, $cmbOdernAscDesc);
		
    foreach($info as $item){

      $fecha = $mantenimientoPreventivoClass->sigaTablaGlobalFechas(1,$agnioActual, $item['Id_Activo'], $item['rutina']); 
							
				if($fecha[0]['Estatus_Proceso01']==4){$cierre01='<a href="https://apps2.hospitalsatelite.com/siga/controladores/activos/siga_solicitud_tickets/Reporte-Ticket.php?Id_Solicitud='.$fecha[0]['ticket01'].'" target="_blank" style="text-decoration: none;color: black;" title="Ticket: '.$fecha[0]['ticket01'].'">'.$fecha[0]['cierre01'].'</a>';}else{$cierre01='';}
				if($fecha[1]['Estatus_Proceso02']==4){$cierre02='<a href="https://apps2.hospitalsatelite.com/siga/controladores/activos/siga_solicitud_tickets/Reporte-Ticket.php?Id_Solicitud='.$fecha[1]['ticket02'].'" target="_blank" style="text-decoration: none;color: black;" title="Ticket: '.$fecha[1]['ticket02'].'">'.$fecha[1]['cierre02'].'</a>';}else{$cierre02='';}
				if($fecha[2]['Estatus_Proceso03']==4){$cierre03='<a href="https://apps2.hospitalsatelite.com/siga/controladores/activos/siga_solicitud_tickets/Reporte-Ticket.php?Id_Solicitud='.$fecha[2]['ticket03'].'" target="_blank" style="text-decoration: none;color: black;" title="Ticket: '.$fecha[2]['ticket03'].'">'.$fecha[2]['cierre03'].'</a>';}else{$cierre03='';}
				if($fecha[3]['Estatus_Proceso04']==4){$cierre04='<a href="https://apps2.hospitalsatelite.com/siga/controladores/activos/siga_solicitud_tickets/Reporte-Ticket.php?Id_Solicitud='.$fecha[3]['ticket04'].'" target="_blank" style="text-decoration: none;color: black;" title="Ticket: '.$fecha[3]['ticket04'].'">'.$fecha[3]['cierre04'].'</a>';}else{$cierre04='';}	
				if($fecha[4]['Estatus_Proceso05']==4){$cierre05='<a href="https://apps2.hospitalsatelite.com/siga/controladores/activos/siga_solicitud_tickets/Reporte-Ticket.php?Id_Solicitud='.$fecha[4]['ticket05'].'" target="_blank" style="text-decoration: none;color: black;" title="Ticket: '.$fecha[4]['ticket05'].'">'.$fecha[4]['cierre05'].'</a>';}else{$cierre05='';}	
				if($fecha[5]['Estatus_Proceso06']==4){$cierre06='<a href="https://apps2.hospitalsatelite.com/siga/controladores/activos/siga_solicitud_tickets/Reporte-Ticket.php?Id_Solicitud='.$fecha[5]['ticket06'].'" target="_blank" style="text-decoration: none;color: black;" title="Ticket: '.$fecha[5]['ticket06'].'">'.$fecha[5]['cierre06'].'</a>';}else{$cierre06='';}	
				if($fecha[6]['Estatus_Proceso07']==4){$cierre07='<a href="https://apps2.hospitalsatelite.com/siga/controladores/activos/siga_solicitud_tickets/Reporte-Ticket.php?Id_Solicitud='.$fecha[6]['ticket07'].'" target="_blank" style="text-decoration: none;color: black;" title="Ticket: '.$fecha[6]['ticket07'].'">'.$fecha[6]['cierre07'].'</a>';}else{$cierre07='';}
				if($fecha[7]['Estatus_Proceso08']==4){$cierre08='<a href="https://apps2.hospitalsatelite.com/siga/controladores/activos/siga_solicitud_tickets/Reporte-Ticket.php?Id_Solicitud='.$fecha[7]['ticket08'].'" target="_blank" style="text-decoration: none;color: black;" title="Ticket: '.$fecha[7]['ticket08'].'">'.$fecha[7]['cierre08'].'</a>';}else{$cierre08='';}
				if($fecha[8]['Estatus_Proceso09']==4){$cierre09='<a href="https://apps2.hospitalsatelite.com/siga/controladores/activos/siga_solicitud_tickets/Reporte-Ticket.php?Id_Solicitud='.$fecha[8]['ticket09'].'" target="_blank" style="text-decoration: none;color: black;" title="Ticket: '.$fecha[8]['ticket09'].'">'.$fecha[8]['cierre09'].'</a>';}else{$cierre09='';}
				if($fecha[9]['Estatus_Proceso10']==4){$cierre10='<a href="https://apps2.hospitalsatelite.com/siga/controladores/activos/siga_solicitud_tickets/Reporte-Ticket.php?Id_Solicitud='.$fecha[9]['ticket10'].'" target="_blank" style="text-decoration: none;color: black;" title="Ticket: '.$fecha[9]['ticket10'].'">'.$fecha[9]['cierre10'].'</a>';}else{$cierre10='';}
				if($fecha[10]['Estatus_Proceso11']==4){$cierre11='<a href="https://apps2.hospitalsatelite.com/siga/controladores/activos/siga_solicitud_tickets/Reporte-Ticket.php?Id_Solicitud='.$fecha[10]['ticket11'].'" target="_blank" style="text-decoration: none;color: black;" title="Ticket: '.$fecha[10]['ticket11'].'">'.$fecha[10]['cierre11'].'</a>';}else{$cierre11='';}
				if($fecha[11]['Estatus_Proceso12']==4){$cierre12='<a href="https://apps2.hospitalsatelite.com/siga/controladores/activos/siga_solicitud_tickets/Reporte-Ticket.php?Id_Solicitud='.$fecha[11]['ticket12'].'" target="_blank" style="text-decoration: none;color: black;" title="Ticket: '.$fecha[11]['ticket12'].'">'.$fecha[11]['cierre12'].'</a>';}else{$cierre12='';}

				$tablaArray[]='<tr style="border-style: solid;">';
				$tablaArray[]='  <td style="font-size:11px;"><strong>'.$item['uPrimaria'].'</strong></td>';
				$tablaArray[]='  <td style="font-size:11px;"><strong>'.$item['uResponsable'].'</strong></td>';								
				$tablaArray[]='  <td style="font-size:11px;"><strong>'.$item['gestor'].'</strong></td>';	
				$tablaArray[]='  <td style="font-size:11px;"><strong>'.$item['Realiza'].'</strong></td>';
				$tablaArray[]='  <td style="font-size:11px;"><strong>'.$item['AF_BC'].'</strong></td>';
				$tablaArray[]='  <td style="font-size:11px;"><strong>'.$item['DescCorta'].'</strong></td>';
				$tablaArray[]='  <td style="font-size:11px;"><strong>'.$item['Modelo'].'</strong></td>';
				$tablaArray[]='  <td style="font-size:11px;"><strong>'.$item['NumSerie'].'</strong></td>';								
				$tablaArray[]='  <td style="font-size:11px;"><strong>'.$item['frecuencia'].'</strong></td>'; 
				$tablaArray[]='  <td style="font-size:11px;"><strong>'.$item['rutina'].'</strong></td>';                                
				$tablaArray[]='  <td style="background-color:#f4f4f4;text-align: center;">'.$fecha[0]['programado01'].'</td>';
				$tablaArray[]='  <td style="'.$fecha[0]['color01'].'text-align: center;">'.$cierre01.'</td>';
				$tablaArray[]='  <td style="background-color:#f4f4f4;text-align: center;">'.$fecha[1]['programado02'].'</td>';
				$tablaArray[]='  <td style="'.$fecha[1]['color02'].'text-align: center;">'.$cierre02.'</td>';
				$tablaArray[]='  <td style="background-color:#f4f4f4;text-align: center;">'.$fecha[2]['programado03'].'</td>';
				$tablaArray[]='  <td style="'.$fecha[2]['color03'].'text-align: center;">'.$cierre03.'</td>';
				$tablaArray[]='  <td style="background-color:#f4f4f4;text-align: center;">'.$fecha[3]['programado04'].'</td>';
				$tablaArray[]='  <td style="'.$fecha[3]['color04'].'text-align: center;">'.$cierre04.'</td>';
				$tablaArray[]='  <td style="background-color:#f4f4f4;text-align: center;">'.$fecha[4]['programado05'].'</td>';
				$tablaArray[]='  <td style="'.$fecha[4]['color05'].'text-align: center;">'.$cierre05.'</td>';
				$tablaArray[]='  <td style="background-color:#f4f4f4;text-align: center;">'.$fecha[5]['programado06'].'</td>';
				$tablaArray[]='  <td style="'.$fecha[5]['color06'].'text-align: center;">'.$cierre06.'</td>';
				$tablaArray[]='  <td style="background-color:#f4f4f4;text-align: center;">'.$fecha[6]['programado07'].'</td>';
				$tablaArray[]='  <td style="'.$fecha[6]['color07'].'text-align: center;">'.$cierre07.'</td>';
				$tablaArray[]='  <td style="background-color:#f4f4f4;text-align: center;">'.$fecha[7]['programado08'].'</td>';
				$tablaArray[]='  <td style="'.$fecha[7]['color08'].'text-align: center;">'.$cierre08.'</td>';
				$tablaArray[]='  <td style="background-color:#f4f4f4;text-align: center;">'.$fecha[8]['programado09'].'</td>';
				$tablaArray[]='  <td style="'.$fecha[8]['color09'].'text-align: center;">'.$cierre09.'</td>';
				$tablaArray[]='  <td style="background-color:#f4f4f4;text-align: center;">'.$fecha[9]['programado10'].'</td>';
				$tablaArray[]='  <td style="'.$fecha[9]['color10'].'text-align: center;">'.$cierre10.'</td>';
				$tablaArray[]='  <td style="background-color:#f4f4f4;text-align: center;">'.$fecha[10]['programado11'].'</td>';
				$tablaArray[]='  <td style="'.$fecha[10]['color11'].'text-align: center;">'.$cierre11.'</td>';
				$tablaArray[]='  <td style="background-color:#f4f4f4;text-align: center;">'.$fecha[11]['programado12'].'</td>';
				$tablaArray[]='  <td style="'.$fecha[11]['color12'].'text-align: center;">'.$cierre12.'</td>';
				$tablaArray[]='</tr>';

    }

    echo json_encode($tablaArray);
  
  } else if($accion == 2){
			$agnio 		= $_POST['agnio'];
			$Id_Area 	= $_POST['Id_Area'];

			$info = $mantenimientoPreventivoClass->getMPCalendario($agnio, $Id_Area);

    echo json_encode($info);
  
	} else if($accion == 3){
		$idActividad = $_POST['idActividad'];

		$info = $mantenimientoPreventivoClass->getMPActividad($idActividad);
    echo json_encode($info);  
	
	} else if($accion == 4){

		$fecMtoProgramado	= $_POST['fchInicio'];
		$idAgnio 					= date("Y",strtotime($fecMtoProgramado));
		$idMes 						= date("d",strtotime($fecMtoProgramado));		
		$Id_Area 					= $_POST['Id_Area'];

		$cmbubicacionprim_mensual 		= $_POST['cmbubicacionprim_mensual'];
		$cmbubicacionsec_mensual 			= $_POST['cmbubicacionsec_mensual'];
		$cmbclase_mensual 						= $_POST['cmbclase_mensual'];
		$cmbclasificacion_mensual 		= $_POST['cmbclasificacion_mensual'];
		$cmbfamilia_mensual 					= $_POST['cmbfamilia_mensual'];
		$cmbsubfamilia_mensual 				= $_POST['cmbsubfamilia_mensual'];
		$selectActivosSearchMensual 	= $_POST['selectActivosSearchMensual'];

		$ActividadesArray = '';
		$info = 	$mantenimientoPreventivoClass->getActividadesUPrimaria($idMes, $idAgnio, $Id_Area, 
																																			$cmbubicacionprim_mensual, $cmbubicacionsec_mensual, $cmbclase_mensual, $cmbclasificacion_mensual,
																																		$cmbfamilia_mensual, $cmbsubfamilia_mensual, $selectActivosSearchMensual);



		foreach($info as $item){
			$ActividadesArray.='<div class="row">
														<div class="col-md-12">
															<div class="box box-primary collapsed-box">

																<div class="box-header" aria-expanded="false" style="background-color: #19294a; color:white;">
																	<h4 class="box-title">'.$item['uPrimaria'].'</h4>
																		<div class="box-tools pull-right" >
																			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
																			</button>
																		</div>              
																</div>				
																<div class="box-body">';

			$datoUbiSecundaria = $mantenimientoPreventivoClass->getUbiSecundaria($idMes, $idAgnio, $Id_Area, $item['Id_Ubic_Prim']);
			
			foreach($datoUbiSecundaria as $item){

									$ActividadesArray.='<div class="col-md-12">
													<div class="box box-warning collapsed-box border-0" aria-expanded="false">

														<div class="box-header" style="background-color: #f0f0f0; color:black;">
															<h4 class="box-title">'.$item['USecundaria'].'</h4>
																<div class="box-tools pull-right">
																	<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
																	</button>
																</div>              
														</div>';
				
			$detalle = $mantenimientoPreventivoClass->getActividadesUPrimariaUSecundaria($idMes, $idAgnio, $Id_Area, $item['Id_Ubic_Prim'],$item['idSecundaria']);

			foreach($detalle as $det){

						if($det['Foto'] != ''){
							$imagen ='<img src="../Archivos/Archivos-Activos/'.$det['Foto'].'" alt="SIGA" width="65" height="65">';
						}else{
							$imagen ='<img src="../dist/img/no-camera.png" alt="SIGA" width="64" height="64">';
						}

						if($det['Estatus_Reg']<>3){
						
							if($det['Estatus_Proceso']==0){
								$style ='<small class="label pull-right" style="background-color: #717d7e;">P</small>';
								$editable ='<span style="color: green;" onclick=mtoPreventivo('.$det['Id_Actividad'].');><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></span>';
								$fechaRealizada = '';

							}else if ($det['Estatus_Proceso']==1){
								$style ='<small class="label pull-right" style="background-color: #D90505;">N</small>';
								$editable ='<span style="color: red;"><i class="fa fa-times fa-lg" aria-hidden="true"></i></span>';
								$fechaRealizada = 'Pendiente';
								$ticket = $det['Id_Solicitud'];

							}else if ($det['Estatus_Proceso']==2){
								$style ='<small class="label pull-right" style="background-color: #ecc93b;">S</small>';
								$editable ='<span style="color: red;"><i class="fa fa-times fa-lg" aria-hidden="true"></i></span>';
								$fechaRealizada = 'Pendiente';
								$ticket = $det['Id_Solicitud'];

							}else if ($det['Estatus_Proceso']==3){
								$style ='<small class="label pull-right" style="background-color: #35a61e;">P</small>';
								$editable ='<span style="color: red;"><i class="fa fa-times fa-lg" aria-hidden="true"></i></span>';
								$fechaRealizada = 'Pendiente';
								$ticket = $det['Id_Solicitud'];

							}else if ($det['Estatus_Proceso']==4){
								$style ='<small class="label pull-right" style="background-color: #448aff;">C</small>';
								$editable ='<span style="color: red;"><i class="fa fa-times fa-lg" aria-hidden="true"></i></span>';
								$fechaRealizada = date('d/m/Y', strtotime($det['Fecha_Realizada']));
								$ticket = $det['Id_Solicitud'];

							}
							$estado = $det['estado'];

						}else{							
							$ticket = '';
							$style ='<small class="label pull-right" style="background-color: #717d7e;">P</small>';
							$editable ='<span style="color: green;" onclick=mtoPreventivo('.$det['Id_Actividad'].');><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></span>';
							$estado = 'Pendiente';
						}

				$ActividadesArray.='<div class="box-body">
															
																<table class="table">
																	<t>
																		<tr>
																			<th>Foto</th>
																			<th>Información de activo</th>
																			<th>Información de la rutina</th>
																			<th>Información Adicional</th>
																		</tr>
																	</t>
																	<tbody>
																		<tr>
																			<td>'.$imagen.'</td>
																			<td>
																				<ul>
																					<li><b>AF/BC: </b>'.$det['AF_BC'].'</li>
																					<li><b>Número de serie: </b>'.$det['NumSerie'].'</li>
																					<li><b>Nombre: </b>'.$det['DescCorta'].'</li>
																					<li><b>Modelo: </b>'.$det['Modelo'].'</li>
																				</ul>															
																			</td>
																			<td>
																					<ul>
																						<li><b>No. ticket: </b>'.$ticket.'</li>
																						<li>'.$style.'<b>Estado: </b>'.$estado.'</li>
																						<li><b>Fecha programada: </b>'.date('d/m/Y', strtotime($det['Fecha_Programada'])).'</li>
																						<li><b>Fecha realizada: </b>'.$fechaRealizada.'</li>																						
																					</ul>
																			</td>
																			<td>
																					<ul>
																						<li><b>Rutina:</b>'.$det['rutina'].'  <span style="color: green;" onclick=modalDetalleDeRutina('.$det['siga_cat_rutinas_id'].');><i class="fa fa-search-plus" aria-hidden="true" fa-lg></i></span></li>
																						<li><b>Editable: </b>'.$editable.'</li>
																						<li><b>Gestor: </b>'.$det['gestor'].'</li>
																						<li><b>Frecuencia: </b>'.$det['frecuencia'].'</li>																					
																						
																					</ul>
																			</td>									
																		</tr>
																	</tbody>
																</table>

															</div>';

				}

		$ActividadesArray.='</div> 
											</div>';

			}

			$ActividadesArray .= '</div>			
													</div>          
												</div>
											</div>';
		} 

// <li><b>Días de retraso: </b><span class="bg-danger">días</span></li>
    echo json_encode($ActividadesArray);
  
	} else if($accion == 5){

		$fecMtoProgramado	= $_POST['fchInicio'];
		$idAgnio 					= date("Y",strtotime($fecMtoProgramado));
		$idMes 						= date("d",strtotime($fecMtoProgramado));		
		$Id_Area 					= $_POST['Id_Area'];

		$cmbubicacionprim_mensual 		= $_POST['cmbubicacionprim_mensual'];
		$cmbubicacionsec_mensual 			= $_POST['cmbubicacionsec_mensual'];
		$cmbclase_mensual 						= $_POST['cmbclase_mensual'];
		$cmbclasificacion_mensual 		= $_POST['cmbclasificacion_mensual'];
		$cmbfamilia_mensual 					= $_POST['cmbfamilia_mensual'];
		$cmbsubfamilia_mensual 				= $_POST['cmbsubfamilia_mensual'];
		$selectActivosSearchMensual 	= $_POST['selectActivosSearchMensual'];

		$ActividadesArray = '';
		$info = 	$mantenimientoPreventivoClass->getActividadesUPrimaria($idMes, $idAgnio, $Id_Area, 
																																			$cmbubicacionprim_mensual, $cmbubicacionsec_mensual, $cmbclase_mensual, $cmbclasificacion_mensual,
																																		$cmbfamilia_mensual, $cmbsubfamilia_mensual, $selectActivosSearchMensual);



		foreach($info as $item){
			$ActividadesArray.='<div class="row">
														<div class="col-md-12">
															<div class="box box-primary collapsed-box">

																<div class="box-header" aria-expanded="false" style="background-color: #19294a; color:white;">
																	<h4 class="box-title">'.$item['uPrimaria'].'</h4>
																		<div class="box-tools pull-right" >
																			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
																			</button>
																		</div>              
																</div>				
																<div class="box-body">';

			$datoUbiSecundaria = $mantenimientoPreventivoClass->getUbiSecundaria($idMes, $idAgnio, $Id_Area, $item['Id_Ubic_Prim']);
			
			foreach($datoUbiSecundaria as $item){

									$ActividadesArray.='<div class="col-md-12">
													<div class="box box-warning collapsed-box border-0" aria-expanded="false">

														<div class="box-header" style="background-color: #f0f0f0; color:black;">
															<h4 class="box-title">'.$item['USecundaria'].'</h4>
																<div class="box-tools pull-right">
																	<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
																	</button>
																</div>              
														</div>';
				
			$detalle = $mantenimientoPreventivoClass->getActividadesUPrimariaUSecundaria($idMes, $idAgnio, $Id_Area, $item['Id_Ubic_Prim'],$item['idSecundaria']);

			foreach($detalle as $det){

						if($det['Foto'] != ''){
							$imagen ='<img src="../Archivos/Archivos-Activos/'.$det['Foto'].'" alt="SIGA" width="65" height="65">';
						}else{
							$imagen ='<img src="../dist/img/no-camera.png" alt="SIGA" width="64" height="64">';
						}

						if($det['Estatus_Reg']<>3){
						
							if($det['Estatus_Proceso']==0){
								$style ='<small class="label pull-right" style="background-color: #717d7e;">P</small>';
								$editable ='<span style="color: green;" onclick=mtoPreventivo('.$det['Id_Actividad'].');><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></span>';
								$fechaRealizada = '';

							}else if ($det['Estatus_Proceso']==1){
								$style ='<small class="label pull-right" style="background-color: #D90505;">N</small>';
								$editable ='<span style="color: red;"><i class="fa fa-times fa-lg" aria-hidden="true"></i></span>';
								$fechaRealizada = 'Pendiente';
								$ticket = $det['Id_Solicitud'];

							}else if ($det['Estatus_Proceso']==2){
								$style ='<small class="label pull-right" style="background-color: #ecc93b;">S</small>';
								$editable ='<span style="color: red;"><i class="fa fa-times fa-lg" aria-hidden="true"></i></span>';
								$fechaRealizada = 'Pendiente';
								$ticket = $det['Id_Solicitud'];

							}else if ($det['Estatus_Proceso']==3){
								$style ='<small class="label pull-right" style="background-color: #35a61e;">P</small>';
								$editable ='<span style="color: red;"><i class="fa fa-times fa-lg" aria-hidden="true"></i></span>';
								$fechaRealizada = 'Pendiente';
								$ticket = $det['Id_Solicitud'];

							}else if ($det['Estatus_Proceso']==4){
								$style ='<small class="label pull-right" style="background-color: #448aff;">C</small>';
								$editable ='<span style="color: red;"><i class="fa fa-times fa-lg" aria-hidden="true"></i></span>';
								$fechaRealizada = date('d/m/Y', strtotime($det['Fecha_Realizada']));
								$ticket = $det['Id_Solicitud'];

							}
							$estado = $det['estado'];

						}else{							
							$ticket = '';
							$style ='<small class="label pull-right" style="background-color: #717d7e;">P</small>';
							$editable ='<span style="color: green;" onclick=mtoPreventivo('.$det['Id_Actividad'].');><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></span>';
							$estado = 'Pendiente';
						}

				$ActividadesArray.='<div class="box-body">
															
																<table class="table">
																	<t>
																		<tr>
																			<th>Foto</th>
																			<th>Información de activo</th>
																			<th>Información de la rutina</th>
																			<th>Información Adicional</th>
																		</tr>
																	</t>
																	<tbody>
																		<tr>
																			<td>'.$imagen.'</td>
																			<td>
																				<ul>
																					<li><b>AF/BC: </b>'.$det['AF_BC'].'</li>
																					<li><b>Número de serie: </b>'.$det['NumSerie'].'</li>
																					<li><b>Nombre: </b>'.$det['DescCorta'].'</li>
																					<li><b>Modelo: </b>'.$det['Modelo'].'</li>
																				</ul>															
																			</td>
																			<td>
																					<ul>
																						<li><b>No. ticket: </b>'.$ticket.'</li>
																						<li>'.$style.'<b>Estado: </b>'.$estado.'</li>
																						<li><b>Fecha programada: </b>'.date('d/m/Y', strtotime($det['Fecha_Programada'])).'</li>
																						<li><b>Fecha realizada: </b>'.$fechaRealizada.'</li>																						
																					</ul>
																			</td>
																			<td>
																					<ul>
																						<li><b>Rutina:</b>'.$det['rutina'].'  <span style="color: green;" onclick=modalDetalleDeRutina('.$det['siga_cat_rutinas_id'].');><i class="fa fa-search-plus" aria-hidden="true" fa-lg></i></span></li>
																						<li><b>Editable: </b>'.$editable.'</li>
																						<li><b>Gestor: </b>'.$det['gestor'].'</li>
																						<li><b>Frecuencia: </b>'.$det['frecuencia'].'</li>																					
																						
																					</ul>
																			</td>									
																		</tr>
																	</tbody>
																</table>

															</div>';

				}

		$ActividadesArray.='</div> 
											</div>';

			}

			$ActividadesArray .= '</div>			
													</div>          
												</div>
											</div>';
		} 

// <li><b>Días de retraso: </b><span class="bg-danger">días</span></li>
    echo json_encode($ActividadesArray);
  
	} else if($accion == 6){

		$fecMtoProgramado	= $_POST['fchInicio'];
		// $idAgnio 					= date("Y",strtotime($fecMtoProgramado));
		// $idMes 						= date("d",strtotime($fecMtoProgramado));		
		$Id_Area 					= $_POST['Id_Area'];

		$cmbubicacionprim_mensual 		= $_POST['cmbubicacionprim_mensual'];
		$cmbubicacionsec_mensual 			= $_POST['cmbubicacionsec_mensual'];
		$cmbclase_mensual 						= $_POST['cmbclase_mensual'];
		$cmbclasificacion_mensual 		= $_POST['cmbclasificacion_mensual'];
		$cmbfamilia_mensual 					= $_POST['cmbfamilia_mensual'];
		$cmbsubfamilia_mensual 				= $_POST['cmbsubfamilia_mensual'];
		$selectActivosSearchMensual 	= $_POST['selectActivosSearchMensual'];

		$ActividadesArray = '';
		$info = 	$mantenimientoPreventivoClass->getActividadesUPrimariaPendientes( $Id_Area, 
																																		$cmbubicacionprim_mensual, $cmbubicacionsec_mensual, $cmbclase_mensual, $cmbclasificacion_mensual,
																																		$cmbfamilia_mensual, $cmbsubfamilia_mensual, $selectActivosSearchMensual);

		foreach($info as $item){
			$ActividadesArray.='<div class="row">
														<div class="col-md-12">
															<div class="box box-primary collapsed-box">

																<div class="box-header" aria-expanded="false" style="background-color: #19294a; color:white;">
																	<h4 class="box-title">'.$item['uPrimaria'].'</h4>
																		<div class="box-tools pull-right" >
																			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
																			</button>
																		</div>              
																</div>				
																<div class="box-body">';

		$datoUbiSecundaria = $mantenimientoPreventivoClass->getUbiSecundariaPendientes($Id_Area, $item['Id_Ubic_Prim']);
		
	

			foreach($datoUbiSecundaria as $item){

									$ActividadesArray.='<div class="col-md-12">
													<div class="box box-warning collapsed-box border-0" aria-expanded="false">

														<div class="box-header" style="background-color: #f0f0f0; color:black;">
															<h4 class="box-title">'.$item['USecundaria'].'</h4>
																<div class="box-tools pull-right">
																	<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
																	</button>
																</div>              
														</div>';
				
		if($item['idSecundaria'] != ''){

		$detalle = $mantenimientoPreventivoClass->getActividadesUPrimariaUSecundariaPendientes($Id_Area, $item['Id_Ubic_Prim'],$item['idSecundaria']);

			foreach($detalle as $det){

						if($det['Foto'] != ''){
							$imagen ='<img src="../Archivos/Archivos-Activos/'.$det['Foto'].'" alt="SIGA" width="65" height="65">';
						}else{
							$imagen ='<img src="../dist/img/no-camera.png" alt="SIGA" width="64" height="64">';
						}

						if($det['Estatus_Reg']<>3){
						
							if($det['Estatus_Proceso']==0){
								$style ='<small class="label pull-right" style="background-color: #717d7e;">P</small>';
								$editable ='<span style="color: green;" onclick=mtoPreventivo('.$det['Id_Actividad'].');><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></span>';
								$fechaRealizada = '';

							}else if ($det['Estatus_Proceso']==1){
								$style ='<small class="label pull-right" style="background-color: #D90505;">N</small>';
								$editable ='<span style="color: red;"><i class="fa fa-times fa-lg" aria-hidden="true"></i></span>';
								$fechaRealizada = 'Pendiente';
								$ticket = $det['Id_Solicitud'];

							}else if ($det['Estatus_Proceso']==2){
								$style ='<small class="label pull-right" style="background-color: #ecc93b;">S</small>';
								$editable ='<span style="color: red;"><i class="fa fa-times fa-lg" aria-hidden="true"></i></span>';
								$fechaRealizada = 'Pendiente';
								$ticket = $det['Id_Solicitud'];

							}else if ($det['Estatus_Proceso']==3){
								$style ='<small class="label pull-right" style="background-color: #35a61e;">P</small>';
								$editable ='<span style="color: red;"><i class="fa fa-times fa-lg" aria-hidden="true"></i></span>';
								$fechaRealizada = 'Pendiente';
								$ticket = $det['Id_Solicitud'];

							}else if ($det['Estatus_Proceso']==4){
								$style ='<small class="label pull-right" style="background-color: #448aff;">C</small>';
								$editable ='<span style="color: red;"><i class="fa fa-times fa-lg" aria-hidden="true"></i></span>';
								$fechaRealizada = date('d/m/Y', strtotime($det['Fecha_Realizada']));
								$ticket = $det['Id_Solicitud'];

							}
							$estado = $det['estado'];

						}else{							
							$ticket = '';
							$style ='<small class="label pull-right" style="background-color: #717d7e;">P</small>';
							$editable ='<span style="color: green;" onclick=mtoPreventivo('.$det['Id_Actividad'].');><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></span>';
							$estado = 'Pendiente';
						}

				$ActividadesArray.='<div class="box-body">
															
																<table class="table">
																	<t>
																		<tr>
																			<th>Foto</th>
																			<th>Información de activo</th>
																			<th>Información de la rutina</th>
																			<th>Información Adicional</th>
																		</tr>
																	</t>
																	<tbody>
																		<tr>
																			<td>'.$imagen.'</td>
																			<td>
																				<ul>
																					<li><b>AF/BC: </b>'.$det['AF_BC'].'</li>
																					<li><b>Número de serie: </b>'.$det['NumSerie'].'</li>
																					<li><b>Nombre: </b>'.$det['DescCorta'].'</li>
																					<li><b>Modelo: </b>'.$det['Modelo'].'</li>
																				</ul>															
																			</td>
																			<td>
																					<ul>
																						<li><b>No. ticket: </b>'.$ticket.'</li>
																						<li>'.$style.'<b>Estado: </b>'.$estado.'</li>
																						<li><b>Fecha programada: </b>'.date('d/m/Y', strtotime($det['Fecha_Programada'])).'</li>
																						<li><b>Fecha realizada: </b>'.$fechaRealizada.'</li>																						
																					</ul>
																			</td>
																			<td>
																					<ul>
																						<li><b>Rutina:</b>'.$det['rutina'].'  <span style="color: green;" onclick=modalDetalleDeRutina('.$det['siga_cat_rutinas_id'].');><i class="fa fa-search-plus" aria-hidden="true" fa-lg></i></span></li>
																						<li><b>Editable: </b>'.$editable.'</li>
																						<li><b>Gestor: </b>'.$det['gestor'].'</li>
																						<li><b>Frecuencia: </b>'.$det['frecuencia'].'</li>																					
																						
																					</ul>
																			</td>									
																		</tr>
																	</tbody>
																</table>

															</div>';

				}

		}

		$ActividadesArray.='</div> 
											</div>';

			}

			$ActividadesArray .= '</div>			
													</div>          
												</div>
											</div>';
		} 

// <li><b>Días de retraso: </b><span class="bg-danger">días</span></li>
    echo json_encode($ActividadesArray);
  
	} else if($accion == 7){

	$id_activo									= $_POST['id_activo'];	
	$txt_Rutina_Search 					= $_POST['txt_Rutina_Search'];
	$txt_Desc_Corta_Search 			= $_POST['txt_Desc_Corta_Search'];
	$agnio_vigente 							= $_POST['agnio_vigente'];
	$mes_vigente 								= $_POST['mes_vigente'];	
	$ubi_primaria_calendario 		= $_POST['ubi_primaria_calendario'];
	$ubi_Secundaria_calendario 	= $_POST['ubi_Secundaria_calendario'];
	$Id_area 										= $_POST['Id_area'];

  $agnios 										= $catalogosClass->getAnioActividades($Id_area);

  //$utilClass->fnlog($agnios);

	$reporte = '';

	if($agnio_vigente == -1){
				
		foreach($agnios as $item){		

			$reporte.='<div class="table-responsive">';
			$reporte.='	<table class="table table-bordered display table-striped">';
			$reporte.='		<thead>';
			$reporte.='			<tr>';
			$reporte.='				<td style="color:#fff;" class="text-center" colspan="9"><h4>'.$item.'</h4></td>';
			$reporte.='			</tr>  ';
			$reporte.='		</thead>';
			$reporte.='		<tbody>';

			$info = 	$mantenimientoPreventivoClass->getActividadesPorAgnio($id_activo,  $txt_Rutina_Search, $txt_Desc_Corta_Search, $item, $ubi_primaria_calendario, $ubi_Secundaria_calendario,$Id_area, $mes_vigente);
			
			foreach($info as $items){

				if($items['Estatus_Reg'] <> 3){

							if($items['Estatus_Proceso']==0){
								$style ='<small class="label pull-right" style="background-color: #717d7e;">P</small>';
								$editable ='<span style="color: green;" onclick=mtoPreventivo('.$items['Id_Actividad'].');><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></span>';
								$fechaRealizada = '';

							}else if ($items['Estatus_Proceso']==1){
								$style ='<small class="label pull-right" style="background-color: #D90505;">N</small>';
								$editable ='<span style="color: red;"><i class="fa fa-times fa-lg" aria-hidden="true"></i></span>';
								$fechaRealizada = 'Pendiente';
								$ticket = $items['Id_Solicitud'];

							}else if ($items['Estatus_Proceso']==2){
								$style ='<small class="label pull-right" style="background-color: #ecc93b;">S</small>';
								$editable ='<span style="color: red;"><i class="fa fa-times fa-lg" aria-hidden="true"></i></span>';
								$fechaRealizada = 'Pendiente';
								$ticket = $items['Id_Solicitud'];

							}else if ($items['Estatus_Proceso']==3){
								$style ='<small class="label pull-right" style="background-color: #35a61e;">P</small>';
								$editable ='<span style="color: red;"><i class="fa fa-times fa-lg" aria-hidden="true"></i></span>';
								$fechaRealizada = 'Pendiente';
								$ticket = $items['Id_Solicitud'];

							}else if ($items['Estatus_Proceso']==4){
								$style ='<small class="label pull-right" style="background-color: #448aff;">C</small>';
								$editable ='<span style="color: red;"><i class="fa fa-times fa-lg" aria-hidden="true"></i></span>';
								$fechaRealizada = date('d/m/Y', strtotime($items['Fecha_Realizada']));
								$ticket = $items['Id_Solicitud'];

							}
							$estado = $items['estado'];

						}else{							
							$ticket = '';
							$style ='<small class="label pull-right" style="background-color: #717d7e;">P</small>';
							$editable ='<span style="color: green;" onclick=mtoPreventivo('.$items['Id_Actividad'].');><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></span>';
							$estado = 'Pendiente';
				}


					$reporte.='<tr>';
					$reporte.='<td width="2%">';
						$reporte.= $editable;
					$reporte.='</td>';

					$reporte.='<td width="2%">';
						$reporte.= $style; 
					$reporte.='</td>';

					$reporte.='<td  width="5%">';
						$reporte.= date('d/m/Y',strtotime($items["Fecha_Programada"]));
					$reporte.='</td>';
					$reporte.='<td width="5%">';
						$reporte.= trim($items["AF_BC"]);
					$reporte.='</td>';
					$reporte.='<td width="25%">';
						$reporte.= trim($items["DescCorta"]);
					$reporte.='</td>';
					$reporte.='<td width="25%">';
						$reporte.= trim($items["rutina"]);
					$reporte.='</td>';
					$reporte.='<td width="15%">';
						$reporte.= trim($items["uPrimaria"]);
					$reporte.='</td>';
					$reporte.='<td width="15%">';
						$reporte.= trim($items["USecundaria"]);
					$reporte.='</td>';
					$reporte.='<td width="5%">';
						$reporte.= $items["realiza"];
					$reporte.='</td>';
				$reporte.='</tr>';

			}

			$reporte.='		</tbody>';
			$reporte.='	</table>';
			$reporte.='</div>';
		
		}
			
	} else {

			$info = 	$mantenimientoPreventivoClass->getActividadesPorAgnio($id_activo,  $txt_Rutina_Search, $txt_Desc_Corta_Search, $agnio_vigente, $ubi_primaria_calendario, $ubi_Secundaria_calendario,$Id_area, $mes_vigente);
			
			$reporte.='<div class="table-responsive">';
			$reporte.='	<table class="table table-bordered display table-striped">';
			$reporte.='		<thead>';
			$reporte.='			<tr>';
			$reporte.='				<td style="color:#fff;" class="text-center" colspan="8"><h4>'.$agnio_vigente.'</h4></td>';
			$reporte.='			</tr>  ';
			$reporte.='		</thead>';
			$reporte.='		<tbody>';
			
			foreach($info as $items){

				$reporte.='<tr>';
					$reporte.='<td width="5%">';
						$reporte.= $items["Id_Actividad"];
					$reporte.='</td>';
					$reporte.='<td  width="5%">';
						$reporte.= date('d/m/Y',strtotime($items["Fecha_Programada"]));
					$reporte.='</td>';
					$reporte.='<td width="5%">';
						$reporte.= trim($items["AF_BC"]);
					$reporte.='</td>';
					$reporte.='<td width="25%">';
						$reporte.= trim($items["DescCorta"]);
					$reporte.='</td>';
					$reporte.='<td width="25%">';
						$reporte.= trim($items["rutina"]);
					$reporte.='</td>';
					$reporte.='<td width="15%">';
						$reporte.= trim($items["uPrimaria"]);
					$reporte.='</td>';
					$reporte.='<td width="15%">';
						$reporte.= trim($items["USecundaria"]);
					$reporte.='</td>';
					$reporte.='<td width="5%">';
						$reporte.= $items["realiza"];
					$reporte.='</td>';
				$reporte.='</tr>';

			}

			$reporte.='		</tbody>';
			$reporte.='	</table>';
			$reporte.='</div>';       

	}

	//$info = 	$mantenimientoPreventivoClass->getActividadesPorAgnio($id_activo,  $txt_Rutina_Search, $txt_Desc_Corta_Search, $agnio_vigente, $ubi_primaria_calendario, $ubi_Secundaria_calendario,$Id_area );


		echo json_encode($reporte);
	}


} else {
echo json_encode('error rutina Ajax');
}
