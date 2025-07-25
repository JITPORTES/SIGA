<?php
session_start();
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/archivosComunes.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/biomedica/rutinas/rutinas.class.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/class/utilities.class.php");

$Id_Usuario = $_SESSION["Id_Usuario"];

$utilitiesClass 						= new utilities();
$sigaUsuarioPerfilPermiso 	= $utilitiesClass->getSigaPerfilPermisos($_SESSION["Id_Usuario"]);

$rutinasClass = new rutinas();
$rutinasInfo  = $rutinasClass->sigaRutinas(1);
?>

<div id="tabla_mis_rutinas">

    <table class="table table-striped" style="width:100%" id='siga_tabla_rutina_php'>
      <thead class="bg-chs-blue-01">
        <tr>
          <th style="width:86%;text-align: left;">Rutina</th>            
          <th></th>
          <th></th>
          <th></th>
          <th></th>
        </tr>   
      </thead>
      <tbody>
        <?php foreach ($rutinasInfo as $value) { ?>
        <tr>
          <td style="width:86%;text-align: left;"><?php echo $value['siga_cat_rutinas_titulo'];?></td>          
          <td><button class='btn btn-warning btn-sm' title='Detalle' onclick='siga_rutinas_info(<?php echo $value['siga_cat_rutinas_id'];?>,"<?php echo $value['siga_cat_rutinas_titulo'];?>")'>Detalle</button></td>
          <td><button class='btn btn-primary btn-sm' title='Editar Titulo' onclick='siga_rutinas_editar_titulo(<?php echo $value['siga_cat_rutinas_id'];?>,"<?php echo $value['siga_cat_rutinas_titulo'];?>")'><i class="fa fa-pencil" aria-hidden="true"></i> Titulo</button></td>
          <td><button class='btn btn-primary btn-sm' title='Editar Actividades' onclick='siga_rutinas_editar(<?php echo $value['siga_cat_rutinas_id'];?>,"<?php echo $value['siga_cat_rutinas_titulo'];?>")'><i class="fa fa-pencil" aria-hidden="true"></i> Rutina</button></td>
          <td><button class='btn btn-danger  btn-sm' title='Eliminar Actividad' onclick='siga_rutinas_eliminar(<?php echo $value['siga_cat_rutinas_id'];?>,"<?php echo $value['siga_cat_rutinas_titulo'];?>")'><i class="fa fa-times" aria-hidden="true"></i></button></td>
        </tr> 
        <?php }?>
      </tbody>
    </table>
</div>

<script>

$(document).ready(function() {

    let table = new DataTable('#siga_tabla_rutina_php',{
      processing: true,
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
      }
    });

});

</script>  