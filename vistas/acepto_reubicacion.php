<?php 
	//error_reporting(E_ALL);
	//ini_set("display_errors", 1);
	require_once("class/SIGA.php");
	require_once("../datos/mail/correo.php");
	

	$obj = new SIGA();
	$Id_Workflow_Reubicacion_Activo = $_GET["Id_Workflow_Reubicacion_Activo"];
	$Id_Reubicacion_Activo = $_GET["Id_Reubicacion_Activo"];
	$Paso = $_GET["Paso"];

 
	
	$workflowReubicacion=$obj->workflowReubicacion($Id_Reubicacion_Activo, $Paso);
	//echo "<pre>";
	//print_r($workflowReubicacion);
	//echo "</pre>";
	$existe=$workflowReubicacion[0]["Aceptado"];
	
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>CHS</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.6 -->
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
		<!-- iCheck -->
		<link rel="stylesheet" href="../plugins/iCheck/square/blue.css">
		
		<!-- ==== File Input ==== -->
		<link href="../plugins/fileinput/fileinput.css" type="text/css" rel="stylesheet" />
		<!-- /.login-box -->
		<!-- jQuery 2.2.3 -->
		<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
		<!-- Bootstrap 3.3.6 -->
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<!-- iCheck -->
		<script src="../plugins/iCheck/icheck.min.js"></script>

		<!-- ==== File Input ==== -->
		<link rel="stylesheet" href="../plugins/fileinput/fileinput.css">
		<script src="../plugins/fileinput/fileinput.js"></script>
		<script src="../plugins/fileinput/fileinput_locale_es.js"></script>
		<script src="../plugins/fileinput/fileInputFuncionesGenericas.js"></script>


		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<style>
			.login-page { background-attachment: fixed; }
			.tablaAnchoAltoFull { display: table; width: 100%; height: 100%; }
				.pseudoTr { display: table-row; }
				.pseudoTd { display: table-cell; }
				.pseudoTdCentradoVertical  { display: table-cell; vertical-align: middle; }
			.vcenter { display: inline-block; vertical-align: middle; float: none; }
			@media(max-width: 767px) {
				.vcenter { display: block; }
			}
		</style>
	</head>
	
	<body class="hold-transition login-page">
		<div class="tablaAnchoAltoFull">
			<div class="pseudoTr">
				<div class="pseudoTdCentradoVertical">
					<div class="container">
						<div class="row">
							<div class="col-md-6 col-md-offset-3" style="padding: 1em;">
							<div class="panel panel-default">
								<div class="panel-body">
									<div>
										<div class="login-logo"><a href="#"><img src="../dist/img/logo.png" style="max-width: 140px;" class="img-responsive center-block" alt=""></a></div>
											<div class="text-center" style="background-color: #19294a; border: green solid 1px; margin-bottom: 1em;">
												<img src="../dist/img//LOGO-SIGA-BLANCO.PNG" style="width: initial; height: 60px; margin: 1.5em; display: inline-block;" alt="User Image">
											</div>
										</div>
										<form>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group has-feedback">
														<p><center><b><?php echo $workflowReubicacion[0]["Nombre"] ?></b></center></p>
													</div>
												</div>
											</div>
										<?php if($existe=="0" || $existe=="1"){ ?>
											<form>
												<?php if ($existe==0) { ?>
													<hr />
													<div class="row">
														<div class="col-md-12">
															<h4>Datos de la reubicación:</h4>
															<div class="form-group has-feedback">
																<table class="table table-bordered">
																	<tr>
																		<td>Area</td>
																		<td><?php echo $workflowReubicacion[0]["Nom_Area"] ?></td>
																	</tr>	
																	<tr>
																		<td>Nombre del Activo / AFBC</td>
																		<td><?php echo $workflowReubicacion[0]["Nombre_Activo"] ?> / <?php echo $workflowReubicacion[0]["AF_BC"] ?></td>
																	</tr>
																	<tr>
																		<td>Ubicación Primaria</td>
																		<td><?php echo $workflowReubicacion[0]["Desc_Ubic_Prim"] ?></td>
																	</tr>
																	<tr>
																		<td>Ubicación Secundaria</td>
																		<td><?php echo $workflowReubicacion[0]["Desc_Ubic_Sec"] ?></td>
																	</tr>
																	<tr>
																		<td>Ubicación Especifica</td>
																		<td><?php echo $workflowReubicacion[0]["Especifica"] ?></td>
																	</tr>
																	<tr>
																		<td>Centro de Costos</td>
																		<td><?php echo $workflowReubicacion[0]["Desc_Centro_de_costos"] ?></td>
																	</tr>
																	<tr>
																		<td>Usuario Solicitante</td>
																		<td><?php echo $workflowReubicacion[0]["Usuario_Solicitante"] ?></td>
																	</tr>
																	<tr>
																		<td>Estatus del Activo</td>
																		<td><?php echo $workflowReubicacion[0]["Desc_Estatus"] ?></td>
																	</tr>
																	<tr>
																		<td>Usuario Responsable</td>
																		<td><?php echo $workflowReubicacion[0]["Nom_Usuario_Reponsable"] ?></td>
																	</tr>
																	<tr>
																		<td>Motivo Reubicación</td>
																		<td><?php echo $workflowReubicacion[0]["Motivo_Reubicacion"] ?></td>
																	</tr>
																	<tr>
																		<td>Comentarios Reubicación</td>
																		<td><?php echo $workflowReubicacion[0]["Comentarios_Reubicacion"] ?></td>
																	</tr>		 
																</table>
															</div>
														</div>
													</div>
												<?php
													}
												?>
												<div class="row">
													<div class="col-md-12">
														<div class="checkbox icheck" id="divMensaje">
															<label style="font-size: x-large;" class="text-center">
																<?php if ($existe==0) {?>
																	Acepto la reubicación del activo fijo <b><?php echo $workflowReubicacion[0]["Nombre_Activo"]; ?></b> con clave <b><?php echo $workflowReubicacion[0]["AF_BC"] ?></b>
																<?php } else {?>
																	LA REUBICACIÓN YA HA SIDO ACEPTADA
																<?php }?>
															</label>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 text-center">
														<?php if ($existe==0) {?>
															<input type="button" class="btn btn-primary btn-block chs" id="btnIngresar" onclick="Aceptar()" name="btnIngresar" value="ACEPTO">
															<br>
															<br>
															<input type="button" class="btn btn-primary btn-block chs" id="btnNo" onclick="Cancelar()" name="btnNo" value="NO ACEPTO">
														<?php }?>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<div class="alert alert-danger alert-dismissible fade in" role="alert" style="display:none" id="divmensajeerror">
															<button type="button" id="alertClose" class="close" aria-label="Close"><span aria-hidden="true">×</span></button>
															<strong id="divErrorMnj"></strong>
														</div>
													</div>
												</div>
											</form>
										<?php }
										else{
											echo 'LA REUBICACIÓN YA HA SIDO CANCELADA.<br><br>';
											//echo '<strong>Comentarios de la Cancelación: </strong>'.$Cancelacion[1].'<br>';
										} ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>



		<script type="text/javascript">
			 Aceptar = function() {
					if (confirm("¿Estás seguro de que deseas aceptar la reubicación del activo?")) {
							$("#btnIngresar").prop("disabled", true);
							$("#btnNo").prop("disabled", true);
							$.post("../fachadas/activos/siga_reubicacion_activo/Siga_reubicacion_activoFacade.Class.php", {
								Aceptado: 1,
								Id_Workflow_Reubicacion_Activo: <?php echo $Id_Workflow_Reubicacion_Activo; ?>,
								Paso: <?php echo $Paso; ?>,
								accion: "workflow_reubicacion"
							})
							.done(function (result) {
								location.reload();
							})
							.fail(function (jqXHR, textStatus, errorThrown) {
								alert("Ocurrió un error: Comunicate con el area de TI");
								location.reload();
							});
					} else {
							// Si se presiona "Cancelar", no hace nada
					}
			}
			
			Cancelar = function() {
					if (confirm("¿Estás seguro de que deseas rechazar la reubicación del activo?")) {
							$("#btnIngresar").prop("disabled", true);
							$("#btnNo").prop("disabled", true);
							$.post("../fachadas/activos/siga_reubicacion_activo/Siga_reubicacion_activoFacade.Class.php", {
								Aceptado: 2,
								Id_Workflow_Reubicacion_Activo: <?php echo $Id_Workflow_Reubicacion_Activo; ?>,
								Paso: <?php echo $Paso; ?>,
								accion: "workflow_reubicacion"
							})
							.done(function (result) {
								location.reload();
							})
							.fail(function (jqXHR, textStatus, errorThrown) {
								alert("Ocurrió un error: Comunicate con el area de TI");
								location.reload();
							});
					} else {
							// Si se presiona "Cancelar", no hace nada
					}
			}
		
		
			$("#alertClose").click(function(e) {
				$("#divmensajeerror").hide();
			});

			
		</script>
	</body>
</html>