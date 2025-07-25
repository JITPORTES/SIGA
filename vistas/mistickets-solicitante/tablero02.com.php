<input type="hidden" id="hddArea" value="1">  
<input type="hidden" id="hddSeccion" value="">  	
<input type="hidden" id="hddEstatus_Proceso" value="">

<!-- ========================================================================================================================================================================================================== -->
<!-- ========================================================================================================================================================================================================== -->
<div class="box box-primary" style="background-color:rgb(255, 255, 255); display:none;">
  <div class="box-body">
<!-- ========================================================================================================================================================================================================== -->
<!-- ========================================================================================================================================================================================================== -->

<div class="row">

</div>

<!-- ========================================================================================================================================================================================================== -->
<!-- ========================================================================================================================================================================================================== -->
  </div>
</div>
<!-- ========================================================================================================================================================================================================== -->
<!-- ========================================================================================================================================================================================================== -->

<div class="row">
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="nuevo">

  <div class="">
		<ul class="nav nav-pills nav-justified">
		   <div class="row">
		      <div class="col-md-12">

							<li style="display:inline">
								<div class="col-md-2 col-sm-2 col-xs-12">
								  <div class="info-box azul">
								    <a data-toggle="tab" href="#biomedica" onclick="cambiaArea(1);carga_activos_vip('mis_activos');msjticketscerrar();">
								      <span class="info-box-icon bg-aqua"><i class="fa fa-stethoscope"></i></span>
								      <div class="info-box-content">
								      	<h4 class="info-box-text">Biomédica</h4>
								      </div>
								    </a>
								  </div>
								</div>
							</li>

							<li class="active">
								<div class="col-md-2 col-sm-2 col-xs-12">
								    <div class="info-box verde">
											<a data-toggle="tab" href="#tic" onclick="cambiaArea(2);carga_activos_vip('mis_activos');msjticketscerrar();">
												<span class="info-box-icon bg-green"><i class="fa fa-laptop"></i></span>
												<div class="info-box-content">
													<h4 class="info-box-text">TIC</h4>
												</div>
											</a>
								    </div>
								</div>
							</li>

						<li style="display:inline">
							<div class="col-md-2 col-sm-2 col-xs-12">
								<div class="info-box rojo">
									<a data-toggle="tab" href="#juridico" onclick="cambiaArea(6); areaJuridico(); msjticketscerrar();">
									<span class="info-box-icon bg-red"><i class="fa fa-gavel"></i></span>
										<div class="info-box-content">
											<h4 class="info-box-text">Jurídico</h4>
										</div>
									</a>
								</div>
							</div>
						</li>

						<li style="display:inline" id="div_mantenimiento_solicitudes">
							<div class="col-md-2 col-sm-2 col-xs-12">
								<div class="info-box amarillo">
									<a data-toggle="tab" href="#mantenimiento" onclick="cambiaArea(3);carga_activos_vip('mis_activos');msjticketscerrar();">
									<span class="info-box-icon bg-orange"><i class="fa fa-wrench"></i></span>
									<div class="info-box-content">
										<h4 class="info-box-text">Mantenimiento</h4>
									</div>
									</a>
								</div>
							</div>
						</li>

						<li style="display:inline" id="div_aprovisionamiento_solicitudes">
							<div class="col-md-2 col-sm-2 col-xs-12">
								<div class="info-box info">
									<a data-toggle="tab" href="#" onclick="cambiaArea(7);carga_activos_vip('mis_activos');msjticketscerrar();">
									<span class="info-box-icon bg-teal"><i class="fa fa-archive" aria-hidden="true"></i></span>
										<div class="info-box-content">
											<h4 class="info-box-text">Aprovisionamiento</h4>
										</div>
									</a>
								</div>
							</div>
						</li>

						<li style="display:inline" id="div_negocios_solicitudes">
							<div class="col-md-2 col-sm-2 col-xs-12">
								<div class="info-box">
									<a data-toggle="tab" href="#" onclick="cambiaArea(8);carga_activos_vip('mis_activos');msjticketscerrar();">
									<span class="info-box-icon bg-navy"><i class="fa fa-cubes" aria-hidden="true"></i></span>
										<div class="info-box-content">
											<h4 class="info-box-text">Inteligencia De Negocios</h4>
										</div>
									</a>
								</div>
							</div>
						</li>

		  	</div>
			</div>
		</ul>

<!-- ===================================================================================================================================================================================================== -->
<!-- ===================================================================================================================================================================================================== -->

<div align="center" id="mensaje_cerrados"></div>

<!-- ===================================================================================================================================================================================================== -->
<!-- ===================================================================================================================================================================================================== -->

  <div class="tab-content">

      <div id="biomedica" class="tab-pane fade in active">
        <form>
        <div class="col-md-12">
          
          <div class="box">
            <div class="box-header azul with-border" id="headerArea">
              <h3 class="box-title" id="h3Area">Solicitud de soporte</h3>
                <input type="hidden" id="hidden_seleccion_activo">
            </div>

                  <div class="box-body">

                      <div class="col-md-10 col-md-offset-1" id="divSeccion">
                        <div class="col-md-12" style="display:none;">
                          <div class="row">
                            <div class="form-group">
                            <select class="form-control" id="cmb_categoria"></select>
                            <select class="form-control" id="cmb_categoria"></select>
                            </div>
                            <div class="form-group"></div>
                          </div>
                        </div>
                      </div>

                    <div class="col-md-10 col-md-offset-1">

                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label" style="font-size: 11px;">Titulo Reporte</label>	
                          <input type="text" id="desc_titulo" class="form-control" placeholder="Titulo Reporte">
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label" style="font-size: 11px;">Descripción Detallada de lo Reportado</label>
                          <textarea rows="4" id="Descripcion_ticket" class="form-control" placeholder="Descripción Detallada de lo Reportado(500 caracteres)"></textarea>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <ul class="inline">
                          <li>Prioridad</li>
                          <li>
                            <div class="form-group">
                              <div class="checkbox">
                                <label>
                                  <input type="radio" name="prioridad" id="Check_Alta"> Alta
                                </label>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="form-group">
                              <div class="checkbox">
                                <label>
                                  <input type="radio" name="prioridad" id="Check_Media"> Media
                                </label>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="form-group">
                              <div class="checkbox">
                                <label>
                                  <input type="radio" name="prioridad" id="Check_Poca"> Baja
                                </label>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                        
                      <div class="col-md-12">
                        <div class="form-group" id="Adjuntos_tickets"></div>
                      </div>

                  </div>
                </div>
              </div>
                  

            <div class="box" id="solicitud_mis_activos">
              <div class="box-header azul with-border" id="headerArea2">
                <h3 class="box-title">Mis activos</h3>
              </div>

              <div class="box-body">
                <div class="col-md-10 col-md-offset-1">
                  
                  <div class="col-md-4">
                    <div class="form-group">
                      <select id="select-activos" class="demo-default" placeholder="AF/BC" style="display:none"></select>
                    </div>
                  </div>
                        
              
                  <div class="col-md-12" id="Seleccionar_Activos">
                    <ul class="inline center">
                      <li><strong>Activos: </strong></li>
                      <li>
                        <div class="form-group">
                        <div class="checkbox icheck">
                          <label>
                          <input type="radio" name="Check_Mis_y_Todos_Activos"  id="Check_Mis_Activos" onchange="javascript:carga_activos_vip('mis_activos')" checked> Mis Activos
                          </label>
                        </div>
                        </div>
                      </li>
                      <li>
                        <div class="form-group">
                        <div class="checkbox icheck">
                          <label>
                          <input type="radio" name="Check_Mis_y_Todos_Activos"  id="Check_Todos_Activos" onchange="javascript:carga_activos_vip('')"> Todos los Activos
                          </label>
                        </div>
                        </div>
                      </li>
                    </ul>
                  </div>

                  <div class="col-md-12">
                    <div class="table-responsive" id="div_tablaactivos"></div>
                  </div>

          </div>
        </div>
      </div>
    </div>
  </form>
        
        <div class="row">
          <div class="col-md-7 text-right" style="margin-top:15px;">
            <button type="button" id="solicitar" class="btn chs">Solicitar soporte</button>
          </div>
        </div>

            </div>          
          </div>
        </div>
  </div>
            
<!-- ===================================================================================================================================================================================================== -->
<!-- ===================================================================================================================================================================================================== -->
          
	<div role="tabpanel" class="tab-pane" id="sin_respuesta">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
				
          <table id="display_sin_respuesta" class="table table-bordered table-striped table-chs" width='100%'>
						<thead>
							<tr>
								<th>Seguimiento</th>	
								<th class='columna-exportar-excel'>Folio Solicitud</th>
								<th class='columna-exportar-excel'>Solicitado</th>
								<th class='columna-exportar-excel'>Estatus</th>
								<th class='columna-exportar-excel'>Prioridad</th>
								<th class='columna-exportar-excel'>Secci&oacute;n</th>
								<th class='columna-exportar-excel'>Categoría</th>
								<th class='columna-exportar-excel'>Subctegoría</th>
								<th class='columna-exportar-excel'><?php echo $Espacios; ?>Titulo Reporte<?php echo $Espacios; ?></th>
								<th class='columna-exportar-excel'><?php echo $Espacios; ?>Descripción Detalle de lo Reportado<?php echo $Espacios; ?></th>
								<th class='columna-exportar-excel'>Area</th>
							</tr>
						</thead>
					</table>
        
        </div>
      </div>       
    </div>
  </div>
			
<!-- ===================================================================================================================================================================================================== -->
<!-- ===================================================================================================================================================================================================== -->

  <div role="tabpanel" class="tab-pane" id="proceso">            
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          
          <table id="display_seguimiento" class="table table-bordered table-striped table-chs" width="100%">
            <thead>
              <tr>
                <th>Seguimiento</th>                    
                <th class='columna-exportar-excel'>Folio Solicitud</th>
                <th class='columna-exportar-excel'>En Seguimiento</th>
                <th class='columna-exportar-excel'>Estatus</th>
                <th class='columna-exportar-excel'>Gestor</th>
                <th class='columna-exportar-excel'>Prioridad</th>
                <th class='columna-exportar-excel'>Secci&oacute;n</th>
                <th class='columna-exportar-excel'>Categoría</th>
                <th class='columna-exportar-excel'>Subctegoría</th>
                <th class='columna-exportar-excel'><?php echo $Espacios; ?>Titulo Reporte<?php echo $Espacios; ?></th>
                <th class='columna-exportar-excel'><?php echo $Espacios; ?>Descripción&nbsp;Detalle de lo Reportado<?php echo $Espacios; ?></th>
                <th class='columna-exportar-excel'>Area</th>
              </tr>
            </thead>
          </table>

        </div>            
      </div>
    </div>
  </div>

<!-- ===================================================================================================================================================================================================== -->
<!-- ===================================================================================================================================================================================================== -->

	<div role="tabpanel" class="tab-pane" id="por_cerrar">	
		<div class="col-md-12">
		  <div class="box">
			  <div class="box-body">
    
          <table id="display_por_cerrar" class="table table-bordered table-striped table-chs" width="100%">
            <thead>
            <tr>
            <th>Seguimiento</th>          
            <th class='columna-exportar-excel'>Folio Solicitud</th>
            <th class='columna-exportar-excel'>Fecha Solicitud</th>
            <th class='columna-exportar-excel'>Fecha Seguimiento</th>
            <th class='columna-exportar-excel'>Estatus</th>
            <th class='columna-exportar-excel'>Gestor</th>
            <th class='columna-exportar-excel'>Prioridad</th>
            <th class='columna-exportar-excel'>Secci&oacute;n</th>
            <th class='columna-exportar-excel'>Categoría</th>
            <th class='columna-exportar-excel'>Subcategoría</th>
            <th class='columna-exportar-excel'><?php echo $Espacios; ?>Titulo Reporte<?php echo $Espacios; ?></th>
            <th class='columna-exportar-excel'><?php echo $Espacios; ?>Descripción&nbsp;Detalle de lo Reportado<?php echo $Espacios; ?></th>
            <th class='columna-exportar-excel'>Acciones Realizadas(Tablero02-352)</th>
            <th class='columna-exportar-excel'>Area</th>
            </tr>
            </thead>
          </table>

			  </div>
		  </div>
		</div>
	</div>

<!-- ===================================================================================================================================================================================================== -->
<!-- ===================================================================================================================================================================================================== -->

	<div role="tabpanel" class="tab-pane" id="historico">            
		<div class="col-md-12">
			<div class="box">                
				<div class="box-body">

				<div class="table-responsive" align="center">
					<ul class="inline center">						
						<li>
							<div class="form-group">
								<div class="checkbox icheck">
									<label>
									<input type="radio" value="5" onchange="javascript:todos_tickets()" id="tickets_actuales" name="radio_tickets"><strong>Tickets Actuales a 3 Meses</strong></label>
								</div>
							</div>
						</li>
						<li>
							<div class="form-group">
								<div class="checkbox icheck">
									<label>
									<input type="radio" value="4" onchange="javascript:todos_tickets()" id="todos_tickets" name="radio_tickets"><strong>Todos los Tickets</strong></label>
								</div>
							</div>
						</li>
					</ul>
				</div>
				<br>

            <table id="tablacerrado" class="table table-bordered table-striped table-chs" width="100%">
              <thead>
                <tr>
                  <th>Seguimiento</th>
                  <th><i class="fa fa-paperclip" aria-hidden="true"></i></th>
                  <th class='columna-exportar-excel'>Folio Solicitud</th>
                  <th class='columna-exportar-excel'>Cerrado</th>
                  <th class='columna-exportar-excel'>Estatus</th>
                  <th class='columna-exportar-excel'>Gestor</th>
                  <th class='columna-exportar-excel'>Prioridad</th>
                  <th class='columna-exportar-excel'>Secci&oacute;n</th>
                  <th class='columna-exportar-excel'>Categoría</th>
                  <th class='columna-exportar-excel'>Subctegoría</th>
                  <th class='columna-exportar-excel'><?php echo $Espacios; ?>Titulo Reporte<?php echo $Espacios; ?></th>
                  <th class='columna-exportar-excel'><?php echo $Espacios; ?>Descripción&nbsp;Detalle de lo Reportado<?php echo $Espacios; ?></th>
                  <th class='columna-exportar-excel'>Acciones Realizadas</th>
                  <th class='columna-exportar-excel'>Area</th>
                </tr>
              </thead>
            </table>

	        </div>              
				</div>              
			</div>
		</div>
	</div>
</div>