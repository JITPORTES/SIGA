    <div class="modal fade modalchs" data-backdrop="false" id="seguimientoReporte">
			<div class="modal-dialog modal-xl">

<!-- ============================================================================================================================================================================================================ -->
<!-- ============================================================================================================================================================================================================ -->

				<div class="modal-content">
						<div class="modal-header azuldef">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
								<span aria-hidden="true">&times;</span>
							</button>
							<h4 class="modal-title"><i class="fa fa-check-circle-o" aria-hidden="true"></i>Mis tickets</h4>
						</div>

						<div class="modal-body nopsides">

<!-- ============================================================================================================================================================================================================ -->
<!-- ============================================================================================================================================================================================================ -->

							<ul class="nav nav-tabs azuldef" role="tablist">
								<li role="presentation" class="active" onclick="cargachat()"><a href="#chat" aria-controls="chat" role="tab" data-toggle="tab" id="tabChat">Chat Seguimiento</a></li>
								<li role="presentation"><a id="tab_adjuntos" href="#adjuntos" aria-controls="adjuntos" role="tab" data-toggle="tab">Adjuntos</a></li>
								<li role="presentation" style="display:none" id="li_actividades"><a id="tab_ver_actividades" href="#actividades" aria-controls="actividades" role="tab" data-toggle="tab">Ver Actividades(T03-19)</a></li>
                <li role="presentation" style="display:none" id="li_materiales"><a id="tab_ver_materiales" href="#materiales" aria-controls="materiales" role="tab" data-toggle="tab">Ver Material(T03-20)</a></li>
								<li role="presentation"><a id="tab_cerrar" href="#finalizar" aria-controls="finalizar" role="tab" data-toggle="tab">Calificar Atención</a></li>
							</ul>

<!-- ============================================================================================================================================================================================================ -->
<!-- ============================================================================================================================================================================================================ -->

							<div class="tab-content tab-contenedor">
								<div role="tabpanel" class="tab-pane active" id="chat">
									<div class="col-md-10 col-md-offset-1">

										<div class="col-md-5">
											<ul class="heads">
												<li><span>No. Solicitud de ayuda</span> <span style="color: #666;font-weight: normal;" id="spanNumsolicitud1"></span></li>
												<li id="liSolicitudAnterior1"><span>No. Solicitud Anterior</span> <span style="color: #666;font-weight: normal;" id="spanNumsolicitudAnterior1"></span></li>
												<li><span>Status</span> <span style="color: #666;font-weight: normal;" id="spanStatus1"></span></li>
												<li><span>Lo Realiza</span> <span style="color: #666;font-weight: normal;" id="spanLo_Realiza1"></span></li>
												<li><span>Activo</span> <span style="color: #666;font-weight: normal;" id="spanActivo1"></span></li>
												<li><span>Marca</span> <span style="color: #666;font-weight: normal;" id="spanMarca1"></span></li>
												<li><span>Modelo</span> <span style="color: #666;font-weight: normal;" id="spanModelo1"></span></li>
												<li><span>No. Serie</span> <span style="color: #666;font-weight: normal;" id="spanNo_Serie1"></span></li>
												<li><span>Ubic. Prim.</span> <span style="color: #666;font-weight: normal;" id="spanUbic_Prim1"></span></li>
												<li><span>Ubic. Sec.</span> <span style="color: #666;font-weight: normal;" id="spanUbic_Sec1"></span></li>
												<li><span>Área</span> <span style="color: #666;font-weight: normal;" id="spanArea1"></span></li>
												<li><span>Prioridad</span> <span style="color: #666;font-weight: normal;" id="spanPrioridad1"></span></li>
												<li id="liMedio1"><span>Medio</span> <span style="color: #666;font-weight: normal;" id="spanMedio1"></span></li>
												<li><span>Sección</span> <span style="color: #666;font-weight: normal;" id="spanSeccion1"></span></li>
												<li><span>Categoria</span> <span style="color: #666;font-weight: normal;" id="spanCategoria1"></span></li>
												<li><span>Subcategoria</span> <span style="color: #666;font-weight: normal;" id="spanSubcategoria1"></span></li>
												<li><span>Motivo de reporte</span> <span style="color: #666;font-weight: normal;" id="spanMotivo1"></span></li>
												<li><span>Usuario</span> <span style="color: #666;font-weight: normal;" id="spanSolicitud1"></span></li>
												<li><span>Horario de atención</span> </li>
												<li><span>Gestor</span> <span style="color: #666;font-weight: normal;" id="spanFech_Solicitud1"></span></li>
												<li><span>Fecha Solicitud</span> <span style="color: #666;font-weight: normal;" id="spanFech_Solicitud1"></span></li>
											</ul>
										</div>

<!-- ============================================================================================================================================================================================================ -->
<!-- ============================================================================================================================================================================================================ -->

									<div class="col-md-7">
										<div class="col-md-12">
											<div class="box" id="div_box_chat">

												<div class="box-header azul">
													<h3 class="box-title" id="title_chat"></h3>
													<div class="box-tools pull-right">
														<button type="button" class="btn btn-box-tool"><i class="fa fa-search"></i></button>
													</div>
												</div>

												<div class="box-body">
													<div class="direct-chat-messages" id="divChat"></div>
												</div>

												<div class="box-footer">
														<div class="input-group">
															<input type="text" name="message" placeholder="Escribe tu mensaje ..." id="Mensaje" class="form-control" maxlength="1000">
															<span class="input-group-btn">
																<button type="button" data-toggle="modal" data-target="#Modal_Adjuntos_Imagenes" class="btn chs btn-flat" onclick="imagenes_chat()" ><i class="fa fa-paperclip" aria-hidden="true"></i></button>
																<button type="button" id="botonEnviar" class="btn chs btn-flat">Enviar</button>	
															</span>
														</div>
												</div>

												<div align="center" id="format_solicitud_prov"></div>
												
												</div>                    
											</div>
										</div>

										<!-- ============================================================================================================================================================================================================ -->

						</div>
					</div>

										<!-- ============================================================================================================================================================================================================ -->

								<div role="tabpanel" class="tab-pane" id="adjuntos">
									<div class="col-md-3">
										<ul class="nav nav-pills nav-stacked file-browser">
											<li class="active"><a href="#tab_a" data-toggle="pill">Docs</a></li>
											<li><a href="#tab_b" data-toggle="pill">Imagenes</a></li>
										</ul>
									</div>

									<div class="col-md-8 file-browser-container">
										<div class="tab-content">

											<div class="tab-pane active" id="tab_a">
												<ul id="div_adjuntos_chat_archivos"></ul>
											</div>
											<div class="tab-pane" id="tab_b">
												<ul id="div_adjuntos_chat_imagenes"></ul>
											</div>
										
										</div>
									</div>
								</div>

<!-- ============================================================================================================================================================================================================ -->
<!-- ============================================================================================================================================================================================================ -->

  <div role="tabpanel" class="tab-pane" id="actividades">
    <input type="hidden" id="Id_Actividad">

    <div class="row">
      <div class="col-md-12">      
      
          <div class="box box-solid">
            <div class="box-body">

              <div class="table-responsive">
                <div id="datos_actividades"></div>
                      
								<table class="table table-striped table-bordered" id="actividadesTicketrutinas" width="100%">
									<thead>
										<tr>												
											<td align="center" style="width:20%">Actividades</td>
											<td align="center" style="width:20%">Valor Referencia</td>
											<td align="center" style="width:20%">Valor medido</td>
											<td align="center" style="width:5%">Estatus</td>
											<td align="center" style="width:15%">Observaciones</td>
											<td align="center" style="width:5%">Adjuntos</td>											
											<td align="center" style="width:10%">F Realizado</td>											
										</tr>
									</thead>
									<tbody id="tablaActividadesSoloLectura"></tbody>

								</table>
              
              </div> 
            </div>

        </div>
      </div>
    </div>

  </div>				

<!-- ============================================================================================================================================================================================================ -->
<!-- ============================================================================================================================================================================================================ -->

  <div role="tabpanel" class="tab-pane" id="materiales">
    <input type="hidden" id="li_materiales">

    <div class="row">
      <div class="col-md-12">      
      
          <div class="box box-solid">
            <div class="box-body">

              <div class="table-responsive">
                <div id="datos_actividades"></div>
                      
                  <table class="table table-striped table-bordered" id="id_listaMateriales" width="100%">
                    <thead>
                      <tr>	
                        <td align="center">SKU</td>
                        <td align="center">Material</td>
                        <td align="center">Origen</td>
                        <td align="center">Folio Almacen</td>
                        <td align="center">Clave Material</td>                        
                        <td align="center">Clave U/M</td>
                        <td align="center">Clave Num Parte</td>
                        <td align="center">Clave Referencia</td>
                        <td align="center">Costo</td>
                        <td align="center">Cantidad</td>
                        <td align="center">Total</td>
                      </tr>
                    </thead>
                    <tbody id="tablaMaterialesSoloLectura"></tbody>
                  </table>
              
              </div> 
            </div>

        </div>
      </div>
    </div>
  </div>				

<!-- ============================================================================================================================================================================================================ -->
<!-- ============================================================================================================================================================================================================ -->

							<div role="tabpanel" class="tab-pane" id="finalizar">
								<div class="row">
									<div class="col-md-10 col-md-offset-1">
										<div class="col-md-6">
											<ul class="heads">
													<li><span>No. Solicitud de ayuda</span> <span style="color: #666;font-weight: normal;" id="spanNumsolicitud2"></span></li>
													<li id="liSolicitudAnterior2"><span>No. Solicitud Anterior</span> <span style="color: #666;font-weight: normal;" id="spanNumsolicitudAnterior2"></span></li>
													<li><span>Status</span> <span style="color: #666;font-weight: normal;" id="spanStatus2"></span></li>
													<li><span>Lo Realiza</span> <span style="color: #666;font-weight: normal;" id="spanLo_Realiza2"></span></li>
													<li><span>Activo</span> <span style="color: #666;font-weight: normal;" id="spanActivo2"></span></li>
													<li><span>Marca</span> <span style="color: #666;font-weight: normal;" id="spanMarca2"></span></li>
													<li><span>Modelo</span> <span style="color: #666;font-weight: normal;" id="spanModelo2"></span></li>
													<li><span>No. Serie</span> <span style="color: #666;font-weight: normal;" id="spanNo_Serie2"></span></li>
													<li><span>Ubic. Prim.</span> <span style="color: #666;font-weight: normal;" id="spanUbic_Prim2"></span></li>
													<li><span>Ubic. Sec.</span> <span style="color: #666;font-weight: normal;" id="spanUbic_Sec2"></span></li>
													<li><span>Área</span> <span style="color: #666;font-weight: normal;" id="spanArea2"></span></li>
													<li><span>Prioridad</span> <span style="color: #666;font-weight: normal;" id="spanPrioridad2"></span></li>
													<li id="liMedio2"><span>Medio</span> <span style="color: #666;font-weight: normal;" id="spanMedio2"></span></li>
													<li><span>Sección</span> <span style="color: #666;font-weight: normal;" id="spanSeccion2"></span></li>
													<li><span>Categoria</span> <span style="color: #666;font-weight: normal;" id="spanCategoria2"></span></li>
													<li><span>Subcategoria</span> <span style="color: #666;font-weight: normal;" id="spanSubcategoria2"></span></li>
													<li><span>Motivo de reporte</span> <span style="color: #666;font-weight: normal;" id="spanMotivo2"></span></li>
													<li><span>Usuario</span> <span style="color: #666;font-weight: normal;" id="spanSolicitud2"></span></li>
													<li><span>Horario de atención</span> </li>
													<li><span>Gestor</span> <span style="color: #666;font-weight: normal;" id="spanGestor2"></span></li>
													<li><span>Fecha Solicitud</span> <span style="color: #666;font-weight: normal;" id="spanFech_Solicitud2"></span></li>
											</ul>
										</div>
										
										<div class="col-md-6">
											<div class="row">
												<p class="question"><strong>Motivo Aparente (Reportado): </strong><font id="Desc_Motivo_Aparente"></font></p>
												<p class="question"><strong>Motivo Real Encontrado: </strong><font id="Desc_Motivo_Real"></font></p>
												<p class="question"><strong>Estatus Final del Equipo: </strong><font id="Desc_Est_Equipo"></font></p>
												<p class="question"><strong>Descripción de Acciones Realizadas: </strong> <font id="Desc_Cierre"></font></p>
											</div>
										</div>	

										<div class="col-md-6">
											<div class="row">
												<form class="faces">
													<p class="question">Solución Ofrecida</p>
													<input type="radio" id="faces-1-1" id="p15" onclick="javascript:guardaRespuestaP1(5);" name="faces-1-set" class="faces-radio cinco">
													<label for="faces-1-1"></label>
													<input type="radio" id="faces-1-2" id="p14" onclick="javascript:guardaRespuestaP1(4);" name="faces-1-set" class="faces-radio cuatro">
													<label for="faces-1-2"></label>
													<input type="radio" id="faces-1-3" id="p13" onclick="javascript:guardaRespuestaP1(3);" name="faces-1-set" class="faces-radio tres">
													<label for="faces-1-3"></label>
													<input type="radio" id="faces-1-4" id="p12" onclick="javascript:guardaRespuestaP1(2);" name="faces-1-set" class="faces-radio dos">
													<label for="faces-1-4"></label>
													<input type="radio" id="faces-1-5" id="p11" onclick="javascript:guardaRespuestaP1(1);" name="faces-1-set" class="faces-radio uno" checked>
													<label for="faces-1-5"></label>
													<input type="hidden" id="hddP1" value="">
												</form>
												<div class="form-group">
													<textarea rows="2" class="form-control" id="Solucion" placeholder="Comentarios..."></textarea>
												</div>
											</div>

											<div class="row">
												<form class="faces">
													<p class="question">Actitud de Servicio</p>
													<input type="radio" id="faces-2-1" id="p25" onclick="javascript:guardaRespuestaP2(5);" name="faces-1-set" class="faces-radio cinco">
													<label for="faces-2-1"></label>
													<input type="radio" id="faces-2-2" id="p24" onclick="javascript:guardaRespuestaP2(4);" name="faces-1-set" class="faces-radio cuatro">
													<label for="faces-2-2"></label>
													<input type="radio" id="faces-2-3" id="p23" onclick="javascript:guardaRespuestaP2(3);" name="faces-1-set" class="faces-radio tres">
													<label for="faces-2-3"></label>
													<input type="radio" id="faces-2-4" id="p22" onclick="javascript:guardaRespuestaP2(2);" name="faces-1-set" class="faces-radio dos">
													<label for="faces-2-4"></label>
													<input type="radio" id="faces-2-5" id="p21" onclick="javascript:guardaRespuestaP2(1);" name="faces-1-set" class="faces-radio uno">
													<label for="faces-2-5"></label>
													<input type="hidden" id="hddP2" value="">
												</form>
												<div class="form-group">
													<textarea rows="2" class="form-control"  id="Actitud" placeholder="Comentarios..."></textarea>
												</div>
											</div>

											<div class="row">
												<form class="faces">
													<p class="question">Tiempo de respuesta</p>
													<input type="radio" id="faces-3-1" id="p35" onclick="javascript:guardaRespuestaP3(5);" name="faces-1-set" class="faces-radio cinco" checked >
													<label for="faces-3-1"></label>
													<input type="radio" id="faces-3-2" id="p34" onclick="javascript:guardaRespuestaP3(4);" name="faces-1-set" class="faces-radio cuatro">
													<label for="faces-3-2"></label>
													<input type="radio" id="faces-3-3" id="p33" onclick="javascript:guardaRespuestaP3(3);" name="faces-1-set" class="faces-radio tres">
													<label for="faces-3-3"></label>
													<input type="radio" id="faces-3-4" id="p32" onclick="javascript:guardaRespuestaP3(2);" name="faces-1-set" class="faces-radio dos">
													<label for="faces-3-4"></label>
													<input type="radio" id="faces-3-5" id="p31" onclick="javascript:guardaRespuestaP3(1);" name="faces-1-set" class="faces-radio uno" checked>
													<label for="faces-3-5"></label>
													<input type="hidden" id="hddP3" value="">
												</form>
												<div class="form-group">
													<textarea rows="2" class="form-control"  id="TiempoRespuesta" placeholder="Comentarios..."></textarea>
												</div>
											</div>
										</div>

									</div>
									</div>
										<div class="modal-footer">
											<button type="button" id="botonEnviarCalificacion" class="btn chs">Enviar calificación</button>
											<button type="button" onclick='$("#tabChat").click()' id="botonNoSolucionado" class="btn chs">No Solucionado</button>
										</div>
									</div>
								</div>
							</div>

						</div>
				</div>
      </div>
    </div>