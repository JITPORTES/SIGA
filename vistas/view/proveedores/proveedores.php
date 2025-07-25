<?php

include_once $_SERVER["DOCUMENT_ROOT"]."/siga/class/inventario/inventario.class.php";
$inventarioClass = new inventario();

$inventarioInfo  = $inventarioClass->inventarioCabeceras(56);
$inventarioData  = $inventarioClass->inventarioData(56);

?>

<section class="content">
  <div class="panel">
  
<!------------------------------------------------------------------------------------------------------------------------------------------------------>
<div class="table-responsive">
							<table class="table table-striped" id="siga_templete_01">
                <thead>
                  <tr>
                    <?php foreach($inventarioInfo as $item){ ?>
                          <th><?php echo $item['cabecera']?></th>
                    <?php }?>                  
                  </tr>
                </thead>
								<tbody>
                  <?php foreach($inventarioData as $item) {?>
                  <tr>                    
                    <td><?php echo $item['AF_BC']; ?></td>
                    <td><?php echo $item['Nombre_Activo']; ?></td>
                    <td><?php echo $item['Marca']; ?></td>
                    <td><?php echo $item['Modelo']; ?></td>
                    <td><?php echo $item['DescCorta']; ?></td>
                    <td><?php echo $item['DescLarga']; ?></td>  
                    <td><?php echo $item['Foto']; ?></td>
                    <td><?php echo $item['Garantia']; ?></td>
                    <td><?php echo $item['ExtGarantia']; ?></td>
                    <td><?php echo $item['Id_Activo']; ?></td>
                    <td><?php echo $item['Especifica']; ?></td>
                  </tr>
                  <?php }?>
								</tbody>

                <tfoot>
                  <tr>
                    <?php foreach($inventarioInfo as $item){ ?>
                          <th><?php echo $item['cabecera']?></th>
                    <?php }?>                  
                  </tr>
                </tfoot>
							</table>
              
            </div>

						
</section>


<script>
$(document).ready(function() {



  $('#siga_templete_01').DataTable({
  aLengthMenu: [
        [10,25, 50, 100, 200, -1],
        [10,25,50,100,200,"All"]
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


            initComplete: function () {
            count = 0;
            this.api().columns().every( function () {
                var title = this.header();
                //replace spaces with dashes
                title = $(title).html().replace(/[\W]/g, '-');
                var column = this;
                var select = $('<select id="' + title + '" class="select2" ></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                      //Get the "text" property from each selected data 
                      //regex escape the value and store in array
                      var data = $.map( $(this).select2('data'), function( value, key ) {
                        return value.text ? '^' + $.fn.dataTable.util.escapeRegex(value.text) + '$' : null;
                                 });
                      
                      //if no data selected use ""
                      if (data.length === 0) {
                        data = [""];
                      }
                      
                      //join array into string with regex or (|)
                      var val = data.join('|');
                      
                      //search for the option(s) selected
                      column
                            .search( val ? val : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' );
                } );
              
              //use column title as selector and placeholder
              $('#' + title).select2({
                multiple: true,
                closeOnSelect: false,
                placeholder: title
              });
              
              //initially clear select otherwise first option is selected
              $('.select2').val(null).trigger('change');
            } );
        }
 

  });

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
});//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
</script>
