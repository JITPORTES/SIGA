
<table class="table table-striped" style="width:100%" id="inventario01">
  <thead>
    <tr>
      <th scope="col" style="width:3%">Orden</th>
      <th scope="col" style="width:37%">Nombre de Actividad</th>
      <th scope="col" style="width:30%">Valor Referencia</th>
      <th scope="col" style="width:10%">Valor Medido</th>
      <th scope="col" style="width:10%">Adjunto</th>
      <th scope="col" style="width:10%">Doc / Imagen Ref</th>
      <th scope="col" style="width:10%">Acción</th> 
    </tr>
  </thead>
</table>

<script>

$(document).ready(function() {

let siga_id_rutina_a_editar = $('#inventario01').text();

  $.ajax({
  type: "POST",
  url: "/siga/class/biomedica/rutinas/rutinas.ajax.php",  
  data: {accion:4, siga_rutinas_id:siga_id_rutina_a_editar},
  dataType: "JSON",
  cache: false,
  success: function (response) {   

  $('#siga_table_actividades_editar').dataTable( {
        data : response,
        destroy:true,
        processing: true,
        columns: [
            {"data" : "siga_cat_sort"},
            {"data" : "siga_cat_rutinas_act_desc"},
            {"data" : "siga_cat_rutinas_act_valor_ref"},
            {"data" : "valor_medio"},
            {"data" : "valor_adjunto"},
            {"data" : "link"},
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
  error:function(response){
    alert(response);
  }
});

//------------------------------------------------------------------------------------------------------------------------------------------------------
});
//------------------------------------------------------------------------------------------------------------------------------------------------------

</script>