 
<script src="DataTables1.10.0/media/js/jquery.dataTables.min.js"></script>
<div id="divpolizabiomedica" style="display: none;">
	<table border="0" cellspacing="6" cellpadding="6" width="100%">
		<tbody>
			<tr>
				<td><div class="col-md-12">Fecha inicial:</div></td>
				<td><div class="col-md-12"><input type="text" class="form-control" id="fechaDelPoliza" name="fechaDelPoliza" autocomplete="off"></div></td>
				<td><div class="col-md-12">Fecha Final:</div></td>
				<td><div class="col-md-12"><input type="text" class="form-control" id="fechaAlPoliza" name="fechaAlPoliza" autocomplete="off"></div></td>
				<td align="center">
					<button type="button" class="btn chs" id="genera_poliza" onclick="Poliza()">Buscar</button><br>
				</td>
				<td align="center">
					<button type="button" class="btn chs" style="background-color: red; color: white;" onclick="Resetar()">Resetear</button><br>
				</td>
			</tr>
		</tbody>
	</table>
	<br><br>
	<div id="dtpoliza">
	<div>
	<script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
	<script>
		$('#fechaDelPoliza').datepicker({
			format: 'dd/mm/yyyy',
			}).datepicker().on('changeDate', function(e) {
			/*var dateString = $('#fechaAl').val();
			alert('Fecha1='+dateString);
			var dateParts = dateString.split("/");
			var minDateFilter = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]).getTime();*/
			//alert('Fecha='+minDateFilter);
			//tablabaja.draw();
		});

		$('#fechaAlPoliza').datepicker({
				format: 'dd/mm/yyyy',
			}).datepicker().on('changeDate', function(e) {
			/*var dateString = $('#fechaAl').val();
			alert('Fecha1='+dateString);
			var dateParts = dateString.split("/");
			var minDateFilter = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]).getTime();*/
			//alert('Fecha='+minDateFilter);
			//tablabaja.draw();
		});
		$(document).ready(function() {
			var resultado = new Array();
			var Id_Area_Poliza = $("#idareasesion").val();
			if(Id_Area_Poliza==1){
				$("#divpolizabiomedica").show();
			}
			Poliza=function(){
				let fechinicio= $("#fechaDelPoliza").val();
				let fechfin= $("#fechaAlPoliza").val();
				if(fechinicio=="" || fechfin==""){
					alert("Atención: Debe seleccionar las fechas de inicio y fin para generar la póliza de seguro");
					return;
				}
				generarPoliza(fechinicio, fechfin);
			}
			generarPoliza = function(fechinicio, fechfin) {
				
				var data = { accion: "generapoliza", fechinicio: fechinicio, fechfin: fechfin };
				resultado = cargo_cmb("../fachadas/activos/siga_activos/Siga_activosFacade.Class.php", false, data);
				$("#dtpoliza").html("");
				var tablapoliza='<button type="button" class="btn btn-success" onclick="exportar_poliza()">Exportar a Excel</button>';
				tablapoliza+='&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-primary" onclick="polizagenerar()" style="display:none" id="generar_poliza">Generar Póliza</button>';
				tablapoliza+='<br><br>';
				tablapoliza+='<table id="tablaPoliza" class="table table-bordered table-striped" style="width: 100%;">';
				tablapoliza+='	<thead>';
				tablapoliza+='		<tr>';
				tablapoliza+='			<th>Área Gestora</th>';
				tablapoliza+='			<th>Unidad</th>';
				tablapoliza+='			<th>Unidad (Establecimiento)</th>';
				tablapoliza+='			<th>Ubicación Primaria</th>';	
				tablapoliza+='			<th>Ubicación Secundaria</th>';
				tablapoliza+='			<th>Propiedad</th>';
				tablapoliza+='			<th>No. Inventario</th>';
				tablapoliza+='			<th>Descripción Equipo</th>';
				tablapoliza+='			<th>Marca</th>';
				tablapoliza+='			<th>Modelo</th>';
				tablapoliza+='			<th>No. Serie</th>';
				tablapoliza+='			<th>Fecha Alta</th>';
				tablapoliza+='			<th>Importe</th>';
				tablapoliza+='			<th>Estatus/Actualización</th>';
				tablapoliza+='		</tr>';
				tablapoliza+='	</thead>';
				tablapoliza+='	<tbody></tbody>';
				tablapoliza+='</table>';
				$("#dtpoliza").html(tablapoliza);
				// Limpia la tabla antes de llenarla
				if ($.fn.DataTable.isDataTable('#tablaPoliza')) {
					$('#tablaPoliza').DataTable().clear().destroy();
				}
				$('#tablaPoliza tbody').empty();
				if (resultado.totalCount > 0) {
					$('#generar_poliza').show();
					// Crea el array de datos para el DataTable
					var datos = [];
					for (var i = 0; i < resultado.totalCount; i++) {
						var item = resultado.data[i];
						// Ajusta las columnas según los datos que recibes
						datos.push([
							'Ingeniería Biomédica',
							item.Hoja || '',
							item.Unidad || '',
							item.Desc_Ubic_Prim || '',
							item.Desc_Ubic_Sec || '',
							item.Propiedad || '',
							item.AF_BC || '',
							item.Nombre_Activo || '',
							item.Marca || '',
							item.Modelo || '',
							item.Num_Serie || '',
							item.Fech_Inserddmmaaaa || '',
							item.ImporteSeguros || '',
							item.Baja_Activo || item.Alta_Activo || '',
						]);
					}
					$('#tablaPoliza thead tr').clone(true).appendTo('#tablaPoliza thead');
					$('#tablaPoliza thead tr:eq(1) th').each(function (i) {
						var title = $(this).text();
						$(this).html('<input type="text" class="search-input" placeholder="Buscar ' + title + '" style="width: 100%;"/>');
						$('.search-input').css('color', 'black');
						// Agregar evento de búsqueda por columna
						$('input', this).on('keyup change', function () {
						if ($('#tablaPoliza').DataTable().column(i).search() !== this.value) {
							$('#tablaPoliza').DataTable()
							.column(i)
							.search(this.value)
							.draw();
						}
						});
					});
					// Inicializa el DataTable
					$('#tablaPoliza').DataTable({
						"lengthMenu": [
							[ 25, 50, 100, 100000 ],
							[ '25 Filas', '50 Filas', '100 Filas', 'Todos' ]
						],
						"scrollY": 400,
						"scrollX": true,
						"processing": true,
						"serverSide": false,
						"orderCellsTop": true,
						"fixedHeader": false,
						data: datos,
						columns: [
							{ title: "Área Gestora" },
							{ title: "Unidad" },
							{ title: "Unidad (Establecimiento)" },
							{ title: "Ubicación Primaria" },
							{ title: "Ubicación Secundaria" },
							{ title: "Propiedad" },
							{ title: "No. Inventario" },
							{ title: "Descripción Equipo" },
							{ title: "Marca" },
							{ title: "Modelo" },
							{ title: "No. Serie" },
							{ title: "Fecha Alta" },
							{ title: "Importe" },
							{ title: "Estatus/Actualización" },
						],
						destroy: true,
						"language": {
							"lengthMenu": "Mostrando _MENU_ registros por página",
							"zeroRecords": "Sin resultados",
							"info": "Mostrando página _PAGE_ de _PAGES_, resultados filtrados: _TOTAL_ de _MAX_ registros",
							"infoEmpty": "Sin resultados",
							"infoFiltered": "",
							"search": "Búsqueda: ",
							"paginate": {
								"first": "Primera",
								"last": "Última",
								"next": "Siguiente",
								"previous": "Anterior"
							}
						},
						"rowCallback": function(row, data, index) {
							// La columna "Estatus/Actualización" es la número 13 (índice base 0)
							if (data[13] && data[13].toString().toLowerCase().indexOf('baja') !== -1) {
								$(row).css('background-color', '#ffcccc'); // Rojo claro
							}

							if (data[13] && data[13].toString().toLowerCase().indexOf('alta') !== -1) {
								$(row).css('background-color', '#ccffcc'); // Verde claro
							}
						}
					});
				} else {
					// Si no hay resultados, muestra mensaje
					$('#tablaPoliza tbody').html('<tr><td colspan="14" class="text-center">Sin Resultados</td></tr>');
				}
			}

			exportar_poliza=async function() {
				var fechinicio = $("#fechaDelPoliza").val();
				var fechfin = $("#fechaAlPoliza").val();
				if (!fechinicio || !fechfin) {
					alert("Selecciona las fechas de inicio y fin");
					return;
				}
				// Crea y envía un formulario oculto para POST
				var form = $('<form method="POST" action="exportar_poliza_excel.php" target="_blank">' +
					'<input type="hidden" name="fechainicio" value="' + fechinicio + '"/>' +
					'<input type="hidden" name="fechafin" value="' + fechfin + '"/>' +
					'</form>');
				$('body').append(form);
				form.submit();
				form.remove();
			}

			polizagenerar = async function() {
				let fechinicio = $("#fechaDelPoliza").val();
				let fechfin = $("#fechaAlPoliza").val();
				if (resultado.totalCount > 0) {
					if (fechinicio == "" || fechfin == "") {
						alert("Atención: Debe seleccionar las fechas de inicio y fin para generar la póliza de seguro");
						return;
					}
					await exportar_poliza();
					var data = { accion: "polizasegurosbiomedica", fechinicio: fechinicio, fechfin: fechfin, arrayres: JSON.stringify(resultado) };
					res = cargo_cmb("../fachadas/activos/siga_activos/Siga_activosFacade.Class.php", false, data);
					if (res.totalCount > 0) {
						resultado=[];
						$("#dtpoliza").html("");
						$('#tablaPoliza').DataTable().clear().destroy();
						Poliza();
						alert("Póliza generada exitosamente.");
					} else {
						alert("Error al generar la póliza: ");
					}
				} else {
					alert("No hay datos para generar la póliza.");
				
				}	
			}

			Resetar = function() {
				if (!confirm("¿Estás seguro de que deseas resetear la póliza?")) {
					return;
				}
				var data = { accion: "resetearpoliza" };
				res = cargo_cmb("../fachadas/activos/siga_activos/Siga_activosFacade.Class.php", false, data);
				if (res.totalCount > 0) {
					resultado=[];
					//$("#fechaDelPoliza").val('');
					//$("#fechaAlPoliza").val('');
					$("#dtpoliza").html('');
					$('#tablaPoliza').DataTable().clear().destroy();
				} else {
					alert("Error al resetear la póliza: ");
				}
			}
			
		});
	</script>
</div>