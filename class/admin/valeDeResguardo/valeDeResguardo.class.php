<?php
  include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/connect/conectar.class.php");
  include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/admin/utilerias/util.class.php");

class valeDeResguardo extends conectar{

  public function pruebaClass(){    
    return 'Prueba De la clase nueva';
  }

  public function envioEmail($Id_Vale_Resguardo, $Correo_solicitante){

		$valeMasivoEmail = 'itdeveloper@hospitalsatelite.com;';
		$liga = '<a href="https://apps2.hospitalsatelite.com/siga/controladores/activos/siga_vale_resguardo/reporte.php?Id_Vale_Resguardo='.$Id_Vale_Resguardo.'">DESCARGA VALE</a>';

		$infoUsuario = '    
		<style type="text/css">
		body { padding-top: 0 !important; padding-bottom: 0 !important; padding-top: 0 !important; padding-bottom: 0 !important; margin:0 !important; width: 100% !important; -webkit-text-size-adjust: 100% !important; -ms-text-size-adjust: 100% !important; -webkit-font-smoothing: antialiased !important; font-family: Tahoma; }
		.tableContent img { border: 0 !important; display: block !important; outline: none !important; }
		p, h2 { margin:0; }
		div,p,ul,h2,h2 { margin:0; }
		.bgBody{ background: #F0F0F0; }
		.bgItem{ background: #ffffff; }
		@media only screen and (max-width:480px) {
			table[class="MainContainer"], td[class="cell"] { width: 100% !important; height:auto !important; }
			td[class="specbundle"] { width: 100% !important; float:left !important; font-size:13px !important; line-height:17px !important; display:block !important; }
			td[class="specbundle3"] { width:90% !important; float:left !important; font-size:14px !important; line-height:18px !important; display:block !important; padding-left:5% !important; padding-right:5% !important; padding-bottom:20px !important; text-align:center !important; }
			td[class="spechide"] { display:none !important; }
			img[class="banner"] { width: 100% !important; height: auto !important; }
		}
		@media only screen and (max-width:540px)
		{
			table[class="MainContainer"], td[class="cell"] { width: 100% !important; height:auto !important; }
			td[class="specbundle"] { width: 100% !important; float:left !important; font-size:13px !important; line-height:17px !important; display:block !important; }
			td[class="specbundle3"] { width:90% !important; float:left !important; font-size:14px !important; line-height:18px !important; display:block !important; padding-left:5% !important; padding-right:5% !important; padding-bottom:20px !important; text-align:center !important; }
			td[class="spechide"] { display:none !important; }
			img[class="banner"] { width: 100% !important; height: auto !important; }
		}
		</style>
	<div paddingwidth="0" paddingheight="0" style="font-family: Tahoma; padding-top: 0; padding-bottom: 0; padding-top: 0; padding-bottom: 0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;" offset="0" toppadding="0" leftpadding="0">
		<!-- ==== Cuerpo central de manera vertical ==== -->
		<div style="background: #414F69;">
			<font face="Tahoma">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableContent bgBody" align="center">
					<tbody>
						<tr>
							<!-- ==== Col izquierdo. Equivalente a un col-md de Boostrap ==== -->
							<td valign="top" class="spechide" style="background: #F0F0F0;">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tbody>
										<tr>
											<td height="170" bgcolor="#414F69"></td>
										</tr>
										<tr>
											<td>&nbsp;</td>
										</tr>
									</tbody>
								</table>
							</td>

							<!-- ==== Col central. Contiene el cuerpo principal del del correo. Equivalente a un col-md de Boostrap ==== -->
							<td valign="top" width="600">
								<table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class="MainContainer" bgcolor="#ffffff">
									<tbody>
										<tr>
											<td class="movableContentContainer">
												<!-- ==== Area 1: Logotipo de la Empresa ==== -->
												<div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
													<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" valign="top">
														<tr>
															<td bgcolor="#414F69" valign="top">
																<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" valign="top">
																	<tr>
																		<td align="center" valign="middle" height="100">
																			<img src="https://apps2.hospitalsatelite.com/public_resources/images/logo_mail_blanco.png" />
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
												</div>

												<!-- ==== Area 2: Area de la Imagen del sistema correspondiente ==== -->
												<div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
													<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" valign="top">
														<tr><td height="25" bgcolor="#414F69"></td></tr>
														<tr><td height="5" bgcolor="#62A9D2"></td></tr>
														<tr><td height="20" class="bgItem"></td></tr>
														<tr>
															<td align="center" style="padding-left: 20px; padding-right: 20px;">
																<div class="contentEditableContainer contentImageEditable">
																	<div class="contentEditable">
																		<img src="https://apps2.hospitalsatelite.com/public_resources/images/logo_siga_mail.png" />
																	</div>
																</div>
															</td>
														</tr>
														<tr><td height="20" class="bgItem"></td></tr>
														<tr>
															<td bgcolor="#000000" style="padding:8px 0;">
																<table width="100%" border="0" cellspacing="0" cellpadding="0">
																	<tbody>
																		<tr>
																			<td width="20" class="spechide">&nbsp;</td>
																			<td>
																				<table width="100%" border="0" cellspacing="0" cellpadding="0">
																					<tbody>
																						<tr>
																							<td align="center" valign="top" class="specbundle3">
																								<div class="contentEditableContainer contentTextEditable">
																									<div class="contentEditable" style="color: #ffffff; font-size: 21px; line-height: 19px;">
																										<p><span>Vale de resguardo</span></p>
																									</div>
																								</div>
																							</td>
																						</tr>
																					</tbody>
																				</table>
																			</td>
																			<td width="20" class="spechide">&nbsp;</td>
																		</tr>
																	</tbody>
																</table>
															</td>
														</tr>
													</table>
												</div>

												<!-- ==== Area 3: Descripción de la Acción ==== -->
												<div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
													<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" valign="top">
														<tr>
															<td>
																<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
																	<tr><td height="25"></td></tr>
																	<tr>
																		<td style="padding: 20px;">
																			<div style="border: 1px solid #EEEEEE; border-radius: 6px; -moz-border-radius: 6px; -webkit-border-radius: 6px; padding: 20px;">
																				<div class="contentEditableContainer contentTextEditable">
																					<div class="contentEditable" style="text-align: center;">
                                          <b>
																					'."Hola".'
                                          </b>
																					</div>
																				</div>
																			</div>
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
												</div>

												<div style="text-align: center;">
												Esta responsiva de equipo sustituye a las de fecha de emisi&oacute;n anterior a esta, <br> firmar el vale y enviar a <b>Cesar Le&oacute;n y Gabriel Chan.</b>
                        <br><br>
                        <b>Verificar que todos sus archivos importantes se guarden dentro de la carpeta de TRABAJO.</b>
                        <br>
                        <br><b>TODOS LOS EQUIPOS MENCIONADOS INCLUYEN CABLES DE CARGA, SE&Ntilde;AL Y ADAPTADORES (SEGUN SEA EL CASO), PARA SU CORRECTO FUNCIONAMIENTO.</b>
												</div>
                        <br>
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tbody>
													<tr>
														<td align="center" valign="top" class="specbundle3" bgcolor="#CCCCCC">
															<div class="contentEditableContainer contentTextEditable">
																<div class="contentEditable" style="color: #ffffff; font-size: 18px; line-height: 19px;">
                                  '.$liga.'
																</div>
															</div>
														</td>
													</tr>
												</tbody>
											</table>

												<!-- ==== Area 5: Pie de pagina ==== -->
												<div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
													<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" valign="top" class="bgBody">
														<tr><td height="38" style="border-bottom: 1px solid #DAE0E4">&nbsp;</td></tr>
														<tr><td height="28"></td></tr>
														<tr>
															<td valign="top" align="center">
																<div class="contentEditableContainer contentTextEditable">
																	<div class="contentEditable" style="color:#A8B0B6; font-size:13px; line-height: 16px;">
																		<p>Este es un correo automatizado. Favor de no responder.</p>
																	</div>
																</div>
															</td>
														</tr>
														<tr><td height="28"></td></tr>
													</table>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</td>

							<!-- ==== Col izquierdo. Equivalente a un col-md de Boostrap ==== -->
							<td valign="top" class="spechide" style="background: #F0F0F0;">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tbody>
										<tr>
											<td height="170" bgcolor="#414F69">&nbsp;</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</font>
		</div>
		<!-- ==== Cinta de pie de pagina ==== -->
		<div>
			<table border="0" cellspacing="0" cellpadding="0" align="center" valign="top" width="100%">
				<tbody>
					<tr>
						<td height="25" style="background: #414F69; width: 100%;" width="100"></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	';

		$url = "http://207.249.133.119:8080/envio_correo_externo/send_external_email.asp";
		$data = array('strPassword'=>'C68H17S49', 'strSubject'=>"SIGA: Vale de resguardo: ".$Id_Vale_Resguardo, 'strTo'=>$Correo_solicitante, 'strHTMLBody'=>$infoUsuario, 'strBCC'=>'itdeveloper@hospitalsatelite.com;','strCc'=>'','system'=>'SIGA');
		$postvars = http_build_query($data);
//cleon@hospitalsatelite.com; gchan@hospitalsatelite.com;
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, count($data));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_exec($ch);
	}


  public function generarValeMasivo($dato){
		$this->envioEmail('','itdeveloper@hospitalsatelite.com');
		return 'ok';
  }

  public function enviarCorreoVale($Id_Vale_Resguardo, $Correo_solicitante){
		$this->envioEmail($Id_Vale_Resguardo, $Correo_solicitante);
		return 'ok';
  }

	public function edcInsertHistorico($Num_Empleado, $tipo_de_vale, $pdf, $usr_insert){
		$pdo = conectar::ConexionGestafSiga();
		$utilClass = new util();
		$sql = "INSERT INTO siga_vale_resguardo_historico(Num_Empleado, tipo_de_vale,pdf , usr_insert, fch_insert, Estatus_reg) VALUES ($Num_Empleado, $tipo_de_vale, '$pdf', $usr_insert,getdate(),1)";
		$sqlPrepare = $pdo->prepare($sql);

		try {
			$sqlPrepare->execute();
		} catch (PDOException $e){
			$utilResponse = $utilClass->fnlog($e);
		}
		
		$pdo = null;
		return 'ok';
  }

	public function edcUpdateEstadoEnvio($envioEdc, $vrdId_Vale_Resguardo){
		$pdo = conectar::ConexionGestafSiga();
		$utilClass = new util();
		$sql = "UPDATE siga_vale_resguardo SET envioEdc=$envioEdc WHERE Id_Vale_Resguardo=$vrdId_Vale_Resguardo";
		$sqlPrepare = $pdo->prepare($sql);
		$utilResponse = $utilClass->fnlog('update'.$sql);
		try {
			$sqlPrepare->execute();
		} catch (PDOException $e){
			$utilResponse = $utilClass->fnlog($e);
		}
		
		$pdo = null;
		return 'ok';
  }

	public function subirEdc($vrdArea, $vrdNumEmpleado, $vrdId_Vale_Resguardo, $envioEdc){
		$fechaEmision = date("d/m/Y");
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://apps2.hospitalsatelite.com/edc/ws/edc_vale_resguardo.asp',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => 'area=TIC&num_emp='.$vrdNumEmpleado.'&fecha_emision='.$fechaEmision,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/x-www-form-urlencoded',
				'Authorization: Basic '. base64_encode("tic_chs:Ker8%eq&-9zq"),
				'Cookie: ASPSESSIONIDAEFQTDDA=CPFLGJACJLMHECMEFHFMOLMN'
			),
		));
		
		$response = curl_exec($curl);
			curl_close($curl);
					$this->edcUpdateEstadoEnvio($envioEdc, $vrdId_Vale_Resguardo);
		return $response;
	}


}