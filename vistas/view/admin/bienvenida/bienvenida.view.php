<style>
    .modal .modal-dialog {width: 85%;}
</style>

<div class="loadingState" id="loadingState">
  <div class="loader"></div>
</div>

<section class="content">

  <div class="row">

    <div class="col-md-3 col-sm-6 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3 id="sigaNumeroDeActivosAsignadosTic">
            <div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>
          </h3><p>Activos Asignados bajo su resguardo TIC</p>
        </div>
        <div class="icon">
          <i class="fa fa-laptop" aria-hidden="true"></i>
        </div>
        <a href="#" class="small-box-footer" id="sigaDetalleActivosTic">Detalle <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-primary">
        <div class="inner">
          <h3 id="sigaNumeroDeActivosAsignadosBio">
            <div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>
          </h3><p>Activos Asignados bajo su resguardo Biomédica</p>
        </div>
        <div class="icon">
          <i class="fa fa-stethoscope" aria-hidden="true"></i>
        </div>
        <a href="#" class="small-box-footer" id="sigaDetalleActivosBio">Detalle <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-orange">
        <div class="inner">
          <h3 id="sigaNumeroDeActivosAsignadosMto">
            <div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>
          </h3><p>Activos Asignados bajo su resguardo Mantenimiento</p>
        </div>
        <div class="icon">
          <i class="fa fa-wrench" aria-hidden="true"></i>
        </div>
        <a href="#" class="small-box-footer" id="sigaDetalleActivosMto">Detalle <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-teal">
        <div class="inner">
          <h3 id="sigaNumeroDeActivosAsignadosMob">
            <div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>
          </h3><p>Activos Asignados bajo su resguardo Mobiliario</p>
        </div>
        <div class="icon">
          <i class="fa fa-building" aria-hidden="true"></i>
        </div>
        <a href="#" class="small-box-footer" id="sigaDetalleActivosMob">Detalle <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  
  </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Bienvenidos a SIGA</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-8">
                <p class="text-center">
                  <strong></strong>
                </p>
              </div>
            </div>
          
          </div>
          
          <div class="box-footer">
            <div class="row">
            </div>
          </div>

        </div>
      </div>

    </div>

  </section>

<div class="modal fade" tabindex="-1" role="dialog"  id="sigaModalDetalleActivos">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header modal-success">
          <!-- <h5 class="modal-title">Activos</h5> -->
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="table-responsive">
            <table class="table table-bordered" style="font-size: 11px; width: 100%" id="sigaTablaActivosAsignados">
            <thead>
                <tr>
                  <th>Área Gestora</th>
                  <th>Num. Inventario</th>
                  <th>Nombre del Activo</th>
                  <th>Tipo De Vale</th>
                  <th>Ub. Primaria</th>
                  <th>Ub. Secundaria</th>
                  <th>Ub. Especifica</th>
                  <th>Marca</th>
                  <th>Modelo</th>
                  <th>Serie</th>

                  <th>Propiedad</th>
                  <th>Estatus</th>
                  <th>Fch Alta</th>
                  <th>Fch Recepción</th>
                  <th>Fch Operación</th>
                  <th>Manual</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>

$(document).ready(function(){

let id_empleado = $('#usuariosesion').val();
let numEmpleado = $('#nousuariosesion').val();
let Id_Area     = $("#idareasesion").val();


    $.ajax({
      type: "POST",
      url: "/siga/class/admin/bienvenida/bienvenida.ajax.php",
      data: {accion:1,id_empleado:id_empleado, numEmpleado:numEmpleado,id_area:2},
      dataType: "JSON",
      success: function (response) {
        $('#sigaNumeroDeActivosAsignadosTic').html(response);
      },
      error:function(response){
        console.log(response);
      }
    });

    $.ajax({
      type: "POST",
      url: "/siga/class/admin/bienvenida/bienvenida.ajax.php",
      data: {accion:1,id_empleado:id_empleado, numEmpleado:numEmpleado,id_area:1},
      dataType: "JSON",
      success: function (response) {
        $('#sigaNumeroDeActivosAsignadosBio').html(response);
      },
      error:function(response){
        console.log(response);
      }
    });
    
    $.ajax({
      type: "POST",
      url: "/siga/class/admin/bienvenida/bienvenida.ajax.php",
      data: {accion:1,id_empleado:id_empleado, numEmpleado:numEmpleado,id_area:3},
      dataType: "JSON",
      success: function (response) {
        $('#sigaNumeroDeActivosAsignadosMto').html(response);
      },
      error:function(response){
        console.log(response);
      }
    });
    
    $.ajax({
      type: "POST",
      url: "/siga/class/admin/bienvenida/bienvenida.ajax.php",
      data: {accion:1,id_empleado:id_empleado, numEmpleado:numEmpleado,id_area:4},
      dataType: "JSON",
      success: function (response) {
        $('#sigaNumeroDeActivosAsignadosMob').html(response);
      },
      error:function(response){
        console.log(response);
      }
    });


$('#sigaDetalleActivosTic').on('click', function(){
  
  $.ajax({
      type: "POST",
      url: "/siga/class/admin/bienvenida/bienvenida.ajax.php",
      data: {accion:2,numEmpleado:numEmpleado,id_area:2},
      dataType: "JSON",
      beforeSend:function(){
        $('#loadingState').show();
      },
      success: function (response) {
        $('#loadingState').hide();
        $('#sigaTablaActivosAsignados').dataTable({
                data : response,
                destroy:true,
                processing: true,
                columns: [
                    {"data" : "area"},
                    {"data" : "AF_BC"},
                    {"data" : "Activo"},
                    {"data" : "tipoDeVale"},
                    {"data" : "UP"},
                    {"data" : "US"},
                    {"data" : "Especifica"},
                    {"data" : "marca"},
                    {"data" : "modelo"},
                    {"data" : "NumSerie"},

                    {"data" : "propiedad"},
                    {"data" : "situacion"},
                    {"data" : "alta"},
                    {"data" : "fr"},
                    {"data" : "fo"},
                    {"data" : "link"}
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

     });
     
  $('#sigaModalDetalleActivos').modal('show');

});

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
$('#sigaDetalleActivosBio').on('click', function(){
  
  $.ajax({
      type: "POST",
      url: "/siga/class/admin/bienvenida/bienvenida.ajax.php",
      data: {accion:2,numEmpleado:numEmpleado,id_area:1},
      dataType: "JSON",
      beforeSend:function(){
        $('#loadingState').show();
      },
      success: function (response) {
        $('#loadingState').hide();
        $('#sigaTablaActivosAsignados').dataTable({
                data : response,
                destroy:true,
                processing: true,
                columns: [
                    {"data" : "area"},
                    {"data" : "AF_BC"},
                    {"data" : "Activo"},
                    {"data" : "tipoDeVale"},
                    {"data" : "UP"},
                    {"data" : "US"},
                    {"data" : "Especifica"},
                    {"data" : "marca"},
                    {"data" : "modelo"},
                    {"data" : "NumSerie"},
                    {"data" : "propiedad"},
                    {"data" : "situacion"},
                    {"data" : "alta"},
                    {"data" : "fr"},
                    {"data" : "fo"},
                    {"data" : "link"}
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

     });
     
  $('#sigaModalDetalleActivos').modal('show');

});
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
$('#sigaDetalleActivosMto').on('click', function(){
  
  $.ajax({
      type: "POST",
      url: "/siga/class/admin/bienvenida/bienvenida.ajax.php",
      data: {accion:2,numEmpleado:numEmpleado,id_area:3},
      dataType: "JSON",
      beforeSend:function(){
        $('#loadingState').show();
      },
      success: function (response) {
        $('#loadingState').hide();
        $('#sigaTablaActivosAsignados').dataTable({
                data : response,
                destroy:true,
                processing: true,
                columns: [
                    {"data" : "area"},
                    {"data" : "AF_BC"},
                    {"data" : "Activo"},
                    {"data" : "tipoDeVale"},
                    {"data" : "UP"},
                    {"data" : "US"},
                    {"data" : "Especifica"},
                    {"data" : "marca"},
                    {"data" : "modelo"},
                    {"data" : "NumSerie"},
                    {"data" : "propiedad"},
                    {"data" : "situacion"},
                    {"data" : "alta"},
                    {"data" : "fr"},
                    {"data" : "fo"},
                    {"data" : "link"}
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

     });
     
  $('#sigaModalDetalleActivos').modal('show');

});
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

$('#sigaDetalleActivosMob').on('click', function(){
  
  $.ajax({
      type: "POST",
      url: "/siga/class/admin/bienvenida/bienvenida.ajax.php",
      data: {accion:2,numEmpleado:numEmpleado,id_area:4},
      dataType: "JSON",
      beforeSend:function(){
        $('#loadingState').show();
      },
      success: function (response) {
        $('#loadingState').hide();
        $('#sigaTablaActivosAsignados').dataTable({
                data : response,
                destroy:true,
                processing: true,
                columns: [
                    {"data" : "area"},
                    {"data" : "AF_BC"},
                    {"data" : "Activo"},
                    {"data" : "tipoDeVale"},
                    {"data" : "UP"},
                    {"data" : "US"},
                    {"data" : "Especifica"},
                    {"data" : "marca"},
                    {"data" : "modelo"},
                    {"data" : "NumSerie"},
                    {"data" : "propiedad"},
                    {"data" : "situacion"},
                    {"data" : "alta"},
                    {"data" : "fr"},
                    {"data" : "fo"},
                    {"data" : "link"}
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

     });
     
  $('#sigaModalDetalleActivos').modal('show');

});



});

</script>