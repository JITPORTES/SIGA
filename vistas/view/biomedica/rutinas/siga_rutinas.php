<?php 
session_start();
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/archivosComunes.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/biomedica/rutinas/rutinas.class.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/class/utilities.class.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/biomedica/biomedica.class.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/catalogos.class.php");

$biomedicaClass = new biomedica();
$utilitiesClass = new utilities();
$rutinasClass   = new rutinas();
$catalogosClass = new catalogos();

$frecuenciasInfo            = $catalogosClass->getFrecuencia();
$biomedicaActivosInfo       = $biomedicaClass->getSigaActivosArea(1);
$Id_Usuario                 = $_SESSION["Id_Usuario"];
$Id_area                    = $_SESSION["Id_Area"];
$sigaUsuarioPerfilPermiso 	= $utilitiesClass->getSigaPerfilPermisos($_SESSION["Id_Usuario"]);
$rutinasInfo                = $rutinasClass->sigaRutinas();

?>

<link rel="stylesheet" href="/siga/plugins/datatables2.0/datatables2.css">
<link rel="stylesheet" href="/siga/plugins/sweetalert2/sweetalert2.css">
<link rel="stylesheet" href="/siga/plugins/selectize/selectize.default.css">
<link rel="stylesheet" href="/siga/plugins/awesome/css/font-awesome.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>

<style>
 table {
  font-size: 12px;
  }
  .modal .modal-dialog {width: 65%;}
  input[type='file'] { font-size: 10px; content: 'Seleccionar';}
</style>

<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->
<div class="container-fluid"><!------------------------------------------------------------------------------------------------------------------------------------>
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->
<span id="siga_id_rutina_a_editar" style="display:none"></span>
<span id="siga_id_actividad_a_editar" style="display:none"></span>
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->
<div class="row"><!------------------------------------------------------------------------------------------------------------------------------------------------>
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->

<!-- Botón Alta de rutina Inicio --------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- Botón Alta de rutina Inicio --------------------------------------------------------------------------------------------------------------------------------------------------------------->

<div class="box box-chs-01" id="siga_rutina_tabla_div">

  <div class="box-header">
      <h3 class="box-title">Rutinas</h3>
        <div class="box-footer bg-chs-blue-02">
          <?php if(in_array(29, $sigaUsuarioPerfilPermiso) || in_array(0, $sigaUsuarioPerfilPermiso)){ ?>
            <button type="button" class="btn btn-success btn-sm" id="siga_rutina_agregar_btn"><i class="fa fa-plus" aria-hidden="true"></i>  Agregar</button>
          <?php } ?>
        </div>
        <br>        
        
        <div class="box box-chs-01" id="tabla_mis_rutinas"></div>

        <!-- <table class="table bg-chs-blue-02" style="width:100%; color: white;" id="sigaTablaDeRutinas">
          <thead>
            <th style="width:80%;">Rutina</th>            
            <th style="width:20%;">Detalle</th>
          </thead>
          
        </table> -->

  </div>

</div>

<!-- Botón Alta de rutina Fin --------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- Botón Alta de rutina Fin --------------------------------------------------------------------------------------------------------------------------------------------------------------->

<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->
</div><!----------------------------------------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->

<!-- Baja de rutina inicio --------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- Baja de rutina inicio --------------------------------------------------------------------------------------------------------------------------------------------------------------->

<div class="modal fade modal-danger" id="siga_rutina_eliminar" tabindex="-1" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar Rutina</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="siga_rutina_titulo_id" style="display: none;"></p>
        <p id="siga_rutina_titulo"></p>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-outline" id="siga_rutinas_btn_eliminar">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<!-- Baja de rutina fin --------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- Baja de rutina fin --------------------------------------------------------------------------------------------------------------------------------------------------------------->

<!-- Detalle de rutina Inicio --------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- Detalle de rutina Inicio --------------------------------------------------------------------------------------------------------------------------------------------------------------->
<div class="modal fade" id="siga_rutina_detalle" aria-labelledby="" aria-hidden="true">

  <div class="modal-dialog modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><p id="siga_rutinas_titulo_detalle"></p></h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <table class="table table-striped" style="width:100%" id="id_alex">
        <thead>
          <tr>
            <th scope="col" style="width:3%">Orden</th>
            <th scope="col" style="width:48%">Nombre de Actividad</th>
            <th scope="col" style="width:30%">Valor Referencia</th>
            <th scope="col" style="width:10%">Valor Medido</th>
            <th scope="col" style="width:10%">Adjunto</th>
            <th scope="col" style="width:10%">Doc / Imagen Ref</th>
          </tr>
        </thead>

        <tbody></tbody>

      </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>   
      </div>
    </div>
  </div>
</div>
<!-- Detalle de rutina Fin --------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- Detalle de rutina Fin --------------------------------------------------------------------------------------------------------------------------------------------------------------->

<!-- Tabla de activos Inicio --------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- Tabla de activos Inicio --------------------------------------------------------------------------------------------------------------------------------------------------------------->
<div id="siga_com_tabla_activos"></div>
<!-- Tabla de activos Fin --------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- Tabla de activos Fin --------------------------------------------------------------------------------------------------------------------------------------------------------------->

<!-- Modal Bajas  ------------------------------------------------------------------------------------------------------------------------------------------------------------------>

<div id="siga_div_baja_activos">

  <div class="table-responsive">
    <table class="table table-striped" id="table_siga_baja_activos"></table>
  </div>
  
</div>

<!-- Modal asignar rutina ------------------------------------------------------------------------------------------------------------------------------------------------------------------>

<div class="modal fade" id="siga_rutina_modal_asignar" aria-labelledby="" aria-hidden="true">

  <div class="modal-dialog modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><p id="siga_rutinas_titulo_detalle"></p></h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="borradoDivActivos();">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        
      <div class="row">
        <div class="col-md-6">

        <div class="form-group">
              <label for="recipient-name" class="col-form-label ">Rutina:</label>
              <select id="siga_cmb_rutinas" style="width:100%">
                <option value="-1" disabled Selected>Selecionar Rutina</option>
                  <?php foreach($rutinasInfo as $item){ ?>
                <option value="<?php echo $item['siga_cat_rutinas_id']; ?>"><?php echo $item['siga_cat_rutinas_titulo']; ?></option>
                  <?php }?>
              </select>
              <span id="siga_contador" style="display:none"></span>
          </div>

        </div>
        <div class="col-md-6"></div>
      </div>

      <table class="table table-striped" style="width:100%" id="id_activos_para_rutina">
        <thead class="bg-chs-blue-01">
          <tr>
            <th scope="col" style="width:10%">AF BC</th>
            <th scope="col" style="width:30%">Activo</th>
            <th scope="col" style="width:10%">Fecha Programada</th>
            <th scope="col" style="width:10%">Frecuencia</th>
            <th scope="col" style="width:10%">Realiza </th>            
          </tr>
        </thead>
        <tbody id="id_activos_para_rutina_tbody">
        </tbody>
      </table>
    
    
    </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-success btn-sm pull-left" id="siga_modal_asignar_guardar"><i class="fa fa-plus" aria-hidden="true"></i>  Guardar</button>
      <button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal" onclick="borradoDivActivos();"><i class="fa fa-times" aria-hidden="true"></i> Cerrar</button>      
      </div>
    </div>

  </div>
</div>

<!-- Modal editar rutina ------------------------------------------------------------------------------------------------------------------------------------------------------------------>

<div class="modal fade" id="siga_rutina_modal_editar" aria-labelledby="" aria-hidden="true">

<div class="modal-dialog modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" ></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <button class="btn btn-success" id="sigaAgregarActividad">+ Agregar Actividad</button>
      </div>
      <div class="modal-body">
        <div id="tabla_rutinas_actividades_edit"></div>        
      </div>

      <div class="modal-footer">      
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>   
      </div>
    </div>
  </div>
</div>

<!-- Modal editar rutina Titulo ------------------------------------------------------------------------------------------------------------------------------------------------------------------>
<!-- Modal editar rutina Titulo ------------------------------------------------------------------------------------------------------------------------------------------------------------------>

<div class="modal fade" id="siga_rutinas_editar_titulo" aria-labelledby="" aria-hidden="true">

<div class="modal-dialog modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title">Titulo Rutina: <span id="siga_rutina_titulo_desc"><b>Titulo</b></span> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="siga_titulo_editar_id" style="display: none;"></p>
        <input type="text" class="form-control" id="siga_titulo_editar" name="siga_titulo_editar">
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-success btn-sm" id="siga_rutinas_titulo_btn_guardar" name="siga_rutinas_titulo_btn_guardar"><i class="fa fa-plus" aria-hidden="true"></i>  Guardar Titulo</button>        
      </div>
    </div>
  </div>
</div>

<!-- Alta de rutina Inicio --------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- Alta de rutina Inicio --------------------------------------------------------------------------------------------------------------------------------------------------------------->

<div class="modal fade" role="dialog" id="siga_rutina_agregar">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-chs-blue-01">
        <h5 class="modal-title">Rutina / Alta</h5>
      </div>
      <div class="modal-body">       
      
        <form  method="post" enctype="multipart/form-data" id="formularioActividadesDetalles" name="formularioActividadesDetalles">

          <div class="form-group" id="siga_rutinas_nombre">
            <label>Nombre de Rutina</label>
              <input type="text" class="form-control" placeholder="Nombre Rutina" id="siga_rutinas_descripcion" name="siga_rutinas_descripcion" value="Titulo Datos precargados">
          </div>            
              <input type="text" id="contador" style="display:none;">
          <table class="table table-striped" id="siga_table_actividades">

            <thead class="bg-chs-blue-02 fw-semibold text-white" style="color:white;">
                <tr>
                    <th class="text-center text-white" style="width:30%">Nombre de Actividad</th>
                    <th class="text-center text-white" style="width:25%">Valor Referencia</th>
                    <th class="text-center text-white" style="width:10%">Valor Medido ¿Obligatorio?</th>
                    <th class="text-center text-white" style="width:10%">Adjunto ¿Obligatorio?</th>
                    <th class="text-center text-white" style="width:20%">Doc / Imagen Ref</th>
                    <th class="text-center text-white" style="width:5%"></th>
                </tr>
            </thead>
            <tbody></tbody>
          </table>
            <button type="button" class="btn btn-primary btn-sm" id="siga_rutinas_actividades_agregar_btn"><i class="fa fa-plus" aria-hidden="true"></i>  Agregar Actividad</button>      
          </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-success btn-sm" id="siga_rutinas_guardar_btn" name="siga_rutinas_guardar_btn"><i class="fa fa-plus" aria-hidden="true"></i>  Guardar Rutina</button>
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">  Cerrar</button>
        </div>

      </form>
    </div>
  </div>
</div>

<!-- Modal editar rutina ------------------------------------------------------------------------------------------------------------------------------------------------------------------>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="siga_rutina_modal_edicion_actividad">
  <div class="modal-dialog modal-lg" role="document">
  <form  method="post" enctype="multipart/form-data" id="formularioActividadesDetalles" name="formularioActividadesEdicion">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Rutina - Actividad - Edición</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <table style="width:100%">
          <tbody>
            <tr>
              <td>Actividad:</td>
              <td>
              <p id="siga_id_actividad_editar" style="display:none"></p>  
              <input type="text" class="form-control" placeholder="Obligatorio...." name="siga_rutina_act_desc" id="siga_rutina_act_desc" size="50">
              </td>
            </tr>
            <tr>
              <td>Valor Referencia:</td>
              <td><input type="text" class="form-control" name="siga_rutina_act_valor_ref" id="siga_rutina_act_valor_ref" size="50"></td>
            </tr>
            <tr>
              <td>Valor Medido:</td>
              <td><input class='form-check-input col-lg-offset-4' type='checkbox' name="siga_rutina_act_valor_medio" id="siga_rutina_act_valor_medio"></td>
            </tr>
            <tr>
              <td>Valor Adjunto:</td>
              <td>
                <input class='form-check-input col-lg-offset-4' type='checkbox' name="siga_rutina_act_adjunto" id="siga_rutina_act_adjunto"></p>
              </td>
            </tr>
            <tr>
              <td>Doc / Ref:</td>
              <td>
                <input class='form-control' type='file' name="siga_rutina_act_archivo" id="siga_rutina_act_archivo"></p>
                <i class="fa fa-trash" aria-hidden="true" onclick="borrarArchivo();" id="siga_actividades_i"></i>                
                <span id="siga_actividades_link"></span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success btn-sm pull-left" id="siga_actividades_actualizar_guardar"> Actualizar</button>
        <button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal editar rutina ------------------------------------------------------------------------------------------------------------------------------------------------------------------>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="siga_rutina_modal_agregar_actividad">
  <div class="modal-dialog modal-sm" role="document">
  <form  method="post" enctype="multipart/form-data" id="formularioActividadesDetalles" name="formularioActividadesEdicion">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Rutina - Actividad - Agregar - Actividad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <table style="width:100%">
          <tbody>
          <tr>
              <td>Posición de la actividad en la rutina:</td>
              <td>             
                <select name="sigaSortActividades" id="sigaSortActividades" class="form-control" style="width:15%;">
                </select>
              </td>
            </tr>
            <tr>
              <td>Actividad:</td>
              <td>              
                <input type="text" class="form-control" placeholder="Obligatorio...." name="siga_rutina_act_desc_agregar" id="siga_rutina_act_desc_agregar" size="50">
              </td>
            </tr>
            <tr>
              <td>Valor Referencia:</td>
              <td><input type="text" class="form-control" name="siga_rutina_act_valor_ref_agregar" id="siga_rutina_act_valor_ref_agregar" size="50"></td>
            </tr>
            <tr>
              <td>Valor Medido:</td>
              <td><input class='form-check-input col-lg-offset-4' type='checkbox' name="siga_rutina_act_valor_medio_agregar" id="siga_rutina_act_valor_medio_agregar"></td>
            </tr>
            <tr>
              <td>Valor Adjunto:</td>
              <td>
                <input class='form-check-input col-lg-offset-4' type='checkbox' name="siga_rutina_act_adjunto_agregar" id="siga_rutina_act_adjunto_agregar"></p>
              </td>
            </tr>
            <tr>
              <td>Doc / Ref:</td>
              <td>
                <input class='form-control' type='file' name="siga_rutina_act_archivo_agregar" id="siga_rutina_act_archivo_agregar"></p>
                <!-- <i class="fa fa-trash" aria-hidden="true" onclick="borrarArchivo();" id="siga_actividades_archivo_agregar"></i>                 -->
                <span id="siga_actividades_link_agregar"></span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success btn-sm pull-left" id="sigaRutinasAgregarActividad">+ Agregar</button>
        <button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!------------------------------------------------------------------------------------------------------------------------------------------------------>
<!------------------------------------------------------------------------------------------------------------------------------------------------------>
	</div>
</div>
	
<!------------------------------------------------------------------------------------------------------------------------------------------------------>
<!------------------------------------------------------------------------------------------------------------------------------------------------------>
<!------------------------------------------------------------------------------------------------------------------------------------------------------>
<!------------------------------------------------------------------------------------------------------------------------------------------------------>
	</div>
</div><!-- /.row -->


<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->
</div><!----------------------------------------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->

<script src="/siga/plugins/datatables2.0/datatable2.js"></script>
<script src="/siga/plugins/sweetalert2/sweetalert2.js"></script>
<script src="/siga/class/fx.js"></script>
<script src="/siga/plugins/selectize/selectize.js"></script>
<script src="/siga/js/Funciones.js"></script>

<script>

$(document).ready(function() {
  let Id_Area     = $("#idareasesion").val();
  let Id_Usuario = <?php echo $Id_Usuario;?>;

  $('#siga_com_tabla_activos').load('/siga/vistas/view/biomedica/components/rutinas/siga_rutinas_activos.com.php');
  $('#siga_cmb_rutinas').selectize();

  $("#siga_checkall").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
  });  
  
  cargaPhp();
  $('#siga_rutina_titulo').val();

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------  
$('#siga_rutina_agregar_btn').on('click', function(){
  $('#siga_rutina_agregar').modal('show');
  $('#siga_table_actividades tbody').html('');
  $('#siga_rutinas_descripcion').val('');
  $('#siga_rutinas_nombre').attr('class','form-group');
  $('#contador').val(0);

});

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
let x=0;
let i;
let arreglado = [];

$('#siga_rutinas_actividades_agregar_btn').click(function() {
    let i = $('#contador').val();
    
      let tr = $("<tr id='row"+x+"'>")
      tr.append(`<td><input type="text" class="form-control" placeholder="Actividad...." name="siga_rutina_actividad${i}" id="siga_rutina_actividad${i}" value=""></td>`);
      tr.append(`<td><input type="text" class="form-control" placeholder="Valor Referencia...." name="siga_rutina_valor_referenciado${i}" id="siga_rutina_valor_referenciado${i}" value=""></td>`);
      tr.append(`<td><center><input class='form-check-input col-lg-offset-4' type='checkbox' id="siga_rutina_valor_medio${i}" name="siga_rutina_valor_medio${i}"></center></td>`);
      tr.append(`<td><center><input class='form-check-input col-lg-offset-4' type='checkbox' id="siga_rutina_adjunto${i}" name="siga_rutina_adjunto${i}"></center></td>`);
      tr.append(`<td><center><input class='form-control' type='file' id="siga_rutina_file${i}" name="siga_rutina_file${i}"></center></td>`);
      tr.append(`<td><center><i class="fa fa-trash" aria-hidden="true" onclick='eliminar(${x});' id='sigaImagen${x}'></i></td>`);
      tr.append(`</tr>`);
      
      $('#siga_table_actividades tbody').append(tr)      
        i++;
    $('#contador').val(i);
    x++;
    arreglado.push(i);
  });

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------

$('#siga_rutinas_guardar_btn').on('click', function(){
$('#siga_rutinas_guardar_btn').attr('disabled', false);

var formData                  = new FormData();
var siga_rutinas_descripcion  = $('#siga_rutinas_descripcion').val();
var validar                   = true;
var Id_Usuario                = <?php echo $Id_Usuario;?>;
let Id_Area                   = $("#idareasesion").val();
var arrayMensajes             = [];

if(siga_rutinas_descripcion==''){  
  $('#siga_rutinas_descripcion').focus();
  arrayMensajes.push('Falta: Nombre de Rutina.<br>');
  validar = false;
}

formData.append('siga_rutinas_descripcion', siga_rutinas_descripcion); 
formData.append('Id_Usuario', Id_Usuario);
formData.append('Id_Area', Id_Area);

for(contador=0; contador<=110;){

  var validando = $('#siga_rutina_actividad'+contador).length;
  var siga_rutina_actividad = $('#siga_rutina_actividad'+contador).val();

  if(siga_rutina_actividad == ''){
    arrayMensajes.push('Falta: Nombre Actividad.<br>');
    $('#siga_rutina_actividad'+contador).focus();
    validar = false;

  } else {

      if(validando){
      var mis_siga_rutina_file 	= $('#siga_rutina_file'+contador)[0].files[0];

      formData.append('siga_rutina_actividad'+contador, $('#siga_rutina_actividad'+contador).val()); 
      formData.append('siga_rutina_valor_referenciado'+contador, $('#siga_rutina_valor_referenciado'+contador).val()); 
      formData.append('siga_rutina_valor_medio'+contador, $('#siga_rutina_valor_medio'+contador).is(':checked')); 
      formData.append('siga_rutina_adjunto'+contador, $('#siga_rutina_adjunto'+contador).is(':checked')); 
      formData.append('miArchivo'+contador, mis_siga_rutina_file);
    }

  }

  contador++;
}

if(arrayMensajes!=''){
  alertar(arrayMensajes,'red','btn-red');
}

if(validar){

  $.ajax({
      type: "POST",
      url: "/siga/class/biomedica/rutinas/misRutinas.ajax.php",                
      cache: false,
      processData: false,
      contentType: false,    //Required
      data: formData,
      dataType: 'html',
      beforeSend: function(){        
        $('#siga_rutinas_guardar_btn').attr('disabled', true);
      },
      success: function (response) {
        //console.log(response);
        alertar('Registro exitosa','green','btn-green');
          $('#siga_rutina_agregar').modal('hide');
            cargaPhp();
      },
      error:function(response){      
        alert('Error en la carga !!!!');
          $('#siga_rutina_agregar').modal('hide');
            alertar('Operación sin éxito','red','btn-red');
      }
  });

}

});

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

$('#siga_rutinas_btn_eliminar').on('click', function(){
  
  let siga_rutina_titulo_id = $('#siga_rutina_titulo_id').html();
  
  $.ajax({
    type: "POST",
    url: "/siga/class/biomedica/rutinas/rutinas.ajax.php",
    data: {accion:3,siga_rutina_titulo_id:siga_rutina_titulo_id,Id_Usuario:Id_Usuario},
    dataType: "JSON",
    async: false,
    cache: false,
    success: function (response) {
      cargaPhp();
    }
  });
  $('#siga_rutina_eliminar').modal('hide');
});

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------

$('#siga_biomedica_activos').DataTable({
  aLengthMenu: [
        [5,25, 50, 100, 200, -1],
        [5,25,50,100,200,"All"]
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
        this.api()
            .columns()
            .every(function () {
                let column = this;
                let title = column.footer().textContent;
 
                // Create input element
                let input = document.createElement('input');
                input.placeholder = title;
                column.footer().replaceChildren(input);
 
                // Event listener for user input
                input.addEventListener('keyup', () => {
                    if (column.search() !== this.value) {
                        column.search(input.value).draw();
                    }
                });
            });
    }


});

//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

$('#siga_modal_asignar_guardar').on('click', function(){

  let validar  = true;
  let siga_cmb_rutinas = $('#siga_cmb_rutinas').val();
  let siga_cmb_rutinasD= $('#siga_cmb_rutinas').text();
  let siga_contador    = $('#siga_contador').text();
  let Id_Usuario       = <?php echo $Id_Usuario;?>;
  let array            = new Array(); 

  if(siga_cmb_rutinas==-1){
    alerta('error','Debe seleccionar una rutina');
    validar = false;
  }

  for(let i = 1; i <= siga_contador; ){
    array.push({id_activo: $('#siga_id_activo'+i).val(), Frecuencia: $('#siga_frecuencia'+i).val(), fecha: $('#fecha'+i).val(), realiza: $('#siga_realiza'+i).val() });          
    i++
  }

  if(validar){
    
    $.ajax({
      type: "POST",
      url: "/siga/class/biomedica/rutinas/rutinas.ajax.php",
      data: {accion:6, array:array,siga_cmb_rutinas:siga_cmb_rutinas,siga_cmb_rutinasD:siga_cmb_rutinasD,Id_Usuario:Id_Usuario},
      dataType: "JSON",
      async: false,
      cache: false,
      beforeSend: function(){
        jsShowWindowLoad("Por favor espere, procesando información");
      },
      success: function (response) {
        console.log(response);
        $('#siga_com_tabla_activos').load('/siga/vistas/view/biomedica/components/rutinas/siga_rutinas_activos.com.php');            
          $('#siga_rutina_modal_asignar').modal('hide');
          jsRemoveWindowLoad();
      },
      error : function(response) {          
        alerta('error','Contacte a sistemas.');
        jsRemoveWindowLoad();
				}
    });   
  }
});

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------

$('#siga_actividades_actualizar_guardar').on('click', function(){

let formDataActualizar          = new FormData();  
let validar                     = true;
let siga_id_actividad_editar    = $('#siga_id_actividad_editar').html();
let siga_rutina_act_desc        = $('#siga_rutina_act_desc').val();
let siga_rutina_act_valor_ref   = $('#siga_rutina_act_valor_ref').val();
let siga_rutina_act_valor_medio = $('#siga_rutina_act_valor_medio').is(':checked')
let siga_rutina_act_adjunto     = $('#siga_rutina_act_adjunto').is(':checked')
let siga_rutina_act_archivo     = $('#siga_rutina_act_archivo')[0].files[0];
let Id_Usuario                  = <?php echo $Id_Usuario;?>;

if(siga_id_actividad_editar==''){
  alerta('error','Error, sesión vencida');
  validar = false;
}else if(siga_rutina_act_desc ==''){
  alerta('error','Se requiere de seleccionar un activo');
  validar = false;
}

if(siga_rutina_act_valor_medio==true){
  siga_rutina_act_valor_medio=1;
}else{
  siga_rutina_act_valor_medio=0;
}

if(siga_rutina_act_adjunto==true){
  siga_rutina_act_adjunto=1;
}else{
  siga_rutina_act_adjunto=0;
}

formDataActualizar.append('accion', 8);
formDataActualizar.append('siga_id_actividad_editar', siga_id_actividad_editar); 
formDataActualizar.append('siga_rutina_act_desc', siga_rutina_act_desc);
formDataActualizar.append('siga_rutina_act_valor_ref', siga_rutina_act_valor_ref); 
formDataActualizar.append('siga_rutina_act_valor_medio', siga_rutina_act_valor_medio);
formDataActualizar.append('siga_rutina_act_adjunto', siga_rutina_act_adjunto);
formDataActualizar.append('siga_rutina_act_archivo', siga_rutina_act_archivo);  
formDataActualizar.append('Id_Usuario', Id_Usuario);

if(validar){

  $.ajax({
    type: "POST",
    url: "/siga/class/biomedica/rutinas/rutinas.ajax.php",
    data: formDataActualizar,
    cache: false,
    processData: false,
    contentType: false,    //Required
    dataType: "HTML",
    beforeSend:function(){
      $('#siga_actividades_actualizar_guardar').attr('disabled',true);
      $('#siga_actividades_actualizar_guardar').html('Procesando');
    },
    success: function (response) {
      //console.log(response);
      $('#tabla_rutinas_actividades_edit').hide().load('/siga/vistas/view/biomedica/rutinas/siga_rutina_actividades_div.php').fadeIn('500');
      $('#siga_rutina_modal_edicion_actividad').modal('hide');
    },
    error: function(response){
      //alerta('error', 'error'+response);
      $('#siga_actividades_actualizar_guardar').attr('disabled',false);
    }
  });


}


});

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------

$('#siga_rutinas_titulo_btn_guardar').on('click',function(){

  let validar             = true;
  let Id_Usuario          = <?php echo $Id_Usuario;?>;
  let siga_titulo_editar_id  = $('#siga_titulo_editar_id').html();
  let siga_titulo_editar  = $('#siga_titulo_editar').val();  

  if(siga_titulo_editar == ''){
    validar= false;
  }

  if(validar){
    $.ajax({
      type: "POST",
      url: "/siga/class/biomedica/rutinas/rutinas.ajax.php",
      data: {accion:12,Id_Usuario:Id_Usuario, siga_titulo_editar_id:siga_titulo_editar_id, siga_titulo_editar:siga_titulo_editar},
      dataType: "JSON",
      cache: false,
      beforeSend: function(){
        $('#siga_rutinas_titulo_btn_guardar').attr('disabled', true);        
      },
      success: function (response) {        
        $('#siga_rutinas_titulo_btn_guardar').attr('disabled', false);
        cargaPhp();
        //$('#tabla_rutinas_actividades_edit').load('/siga/vistas/view/biomedica/rutinas/siga_rutina_actividades_div.php');
        $('#siga_rutinas_editar_titulo').modal('hide');

      },
      error: function(){
        $('#siga_rutinas_titulo_btn_guardar').attr('disabled', false);
      }
    });
  }

});

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------

$('#sigaAgregarActividad').on('click', function(){    
  let siga_id_rutina_a_editar = $('#siga_id_rutina_a_editar').html();

  $('#sigaSortActividades').val('');
  $('#siga_rutina_act_desc_agregar').val('');
  $('#siga_rutina_act_valor_ref_agregar').val('');
  $('#siga_rutina_act_valor_medio_agregar').prop('checked', false);
  $('#siga_rutina_act_adjunto_agregar').prop('checked', false); 
  $('#siga_rutina_act_archivo_agregar').val('');
  $('#sigaRutinasAgregarActividad').attr('disabled', false);

    $.ajax({
      type: "POST",
      url: "/siga/class/biomedica/rutinas/rutinas.ajax.php",
      data: {accion:14, siga_cat_rutinas_id:siga_id_rutina_a_editar},
      dataType: "JSON",
      async: false,
      cache: false,
      beforeSend: function(){ },
      success: function (response) {      
        $('#sigaSortActividades').html(response);      
        $('#siga_rutina_modal_agregar_actividad').modal('show');
      },
      error: function(){ }    
    });

  });

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------

  $('#sigaRutinasAgregarActividad').on('click', function(){
    
    let validar                               = true;
    let Id_Usuario                            = <?php echo $Id_Usuario;?>;
    var formData                              = new FormData();
    let siga_id_rutina_a_editar               = $('#siga_id_rutina_a_editar').html();
    let sigaSortActividades                   = $('#sigaSortActividades').val();
    let siga_rutina_act_desc_agregar          = $('#siga_rutina_act_desc_agregar').val();
    let siga_rutina_act_valor_ref_agregar     = $('#siga_rutina_act_valor_ref_agregar').val();
    let siga_rutina_act_valor_medio_agregar   = $('#siga_rutina_act_valor_medio_agregar').is(':checked');
    let siga_rutina_act_adjunto_agregar       = $('#siga_rutina_act_adjunto_agregar').is(':checked');
    let siga_rutina_act_archivo_agregar       = $('#siga_rutina_act_archivo_agregar')[0].files[0];    

    if(siga_rutina_act_desc_agregar == ''){
      alert('Descripción Obligatoria');
      validar = false;
    }

    formData.append('accion', 15);
    formData.append('Id_Usuario', Id_Usuario);
    formData.append('siga_id_rutina_a_editar', siga_id_rutina_a_editar);
    formData.append('sigaSortActividades', sigaSortActividades);
    formData.append('siga_rutina_act_desc_agregar', siga_rutina_act_desc_agregar);
    formData.append('siga_rutina_act_valor_ref_agregar', siga_rutina_act_valor_ref_agregar);
    formData.append('siga_rutina_act_valor_medio_agregar', siga_rutina_act_valor_medio_agregar);
    formData.append('siga_rutina_act_adjunto_agregar', siga_rutina_act_adjunto_agregar);
    formData.append('siga_rutina_act_archivo_agregar', siga_rutina_act_archivo_agregar);

    if(validar){

      $.ajax({
        type: "POST",
        url: "/siga/class/biomedica/rutinas/rutinas.ajax.php",
        cache: false,
        processData: false,
        contentType: false,
        data: formData,
        dataType: 'html',
        beforeSend: function(){ $('#sigaRutinasAgregarActividad').attr('disabled', true) },
        success: function (response) {
          $('#tabla_rutinas_actividades_edit').load('/siga/vistas/view/biomedica/rutinas/siga_rutina_actividades_div.php').fadeIn('500');
          $('#siga_rutina_modal_agregar_actividad').modal('hide');
        },
        error: function(){
          alert('SIGA: Error contacte a sistemas.');
         }
      });

    }

  });

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
});	
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------

function siga_rutinas_eliminar(siga_rutinas_id,siga_cat_rutinas_titulo){
  $('#siga_rutina_eliminar').modal('show');
  $('#siga_rutina_titulo').html(siga_cat_rutinas_titulo);
  $('#siga_rutina_titulo_id').html(siga_rutinas_id);
}

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function siga_rutinas_info(siga_rutinas_id,siga_cat_rutinas_titulo){

  $('#siga_rutinas_titulo_detalle').val(siga_cat_rutinas_titulo);
  
  $.ajax({
    type: "POST",
    url: "/siga/class/biomedica/rutinas/rutinas.ajax.php",
    data: {accion:4,siga_rutinas_id:siga_rutinas_id},
    dataType: "JSON",
    success: function (response) {

      $('#id_alex').dataTable({

                data : response,
                destroy:true,
                processing: true,
                columns: [                  
                    {"data" : "siga_cat_sort"},
                    {"data" : "siga_cat_rutinas_act_desc"},
                    {"data" : "siga_cat_rutinas_act_valor_ref"},
                    {"data" : "valor_medio"},
                    {"data" : "valor_adjunto"},
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
									    }
            });
      $('#siga_rutina_detalle').modal('show'); 
    }
  });
  
}

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function siga_rutinas_editar(siga_rutinas_id){
  $('#siga_id_rutina_a_editar').html(siga_rutinas_id);  
  $('#tabla_rutinas_actividades_edit').load('/siga/vistas/view/biomedica/rutinas/siga_rutina_actividades_div.php');
  $('#siga_rutina_modal_editar').modal('show');
}

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function siga_rutinas_editar_titulo(siga_rutinas_id,siga_rutina_titulo){
  $('#siga_titulo_editar_id').html(siga_rutinas_id);
  $('#siga_titulo_editar').val(siga_rutina_titulo);
  $('#siga_rutina_titulo_desc').html('<b>'+siga_rutina_titulo+'</b>');  
  $('#siga_rutinas_editar_titulo').modal('show');
}

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function cargaPhp(){

  let Id_Area     = $("#idareasesion").val();

  $.ajax({
				type: "POST",
				url: "/siga/class/biomedica/rutinas/rutinas.ajax.php",
				data: {accion:17, Id_Area: Id_Area},
				dataType: "JSON",
				success: function (response) {
          console.log(response);
					$('#sigaTablaDeRutinas').dataTable({
										data : response,
										destroy:true,
										processing: true,
										columns: [                  												
												{"data" : "siga_cat_rutinas_titulo"},
												{"data" : ""}
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
                        columnDefs: [
                        {targets: -1,
                          orderable: false,
                          data: null,
                          render: function (data, type, row, meta) {
                            let fila = meta.row;
                            let botones = `<button class='btn btn-warning btn-sm' onclick='siga_rutinas_info(`+response[fila].siga_cat_rutinas_id+`,`+response[fila].siga_cat_rutinas_id+`);'>Detalle</button>
                            <button class='btn btn-primary btn-sm' onclick='siga_rutinas_editar_titulo(`+response[fila].siga_cat_rutinas_id+`,'`+response[fila].siga_cat_rutinas_titulo+`'); '><i class="fa fa-pencil" aria-hidden="true"></i> Titulo</button>
                            <button class='btn btn-primary btn-sm' onclick='siga_rutinas_editar(`+response[fila].siga_cat_rutinas_id+`); return false;'><i class="fa fa-pencil" aria-hidden="true"></i> Rutina</button>
                            <button class='btn btn-danger  btn-sm' onclick='siga_rutinas_eliminar(`+response[fila].siga_cat_rutinas_id+`); return false;'><i class="fa fa-times" aria-hidden="true"></i></button>
                            `;
                            return botones;
                            }
                          }
                        ],

                          
								});					

				  }
			});

  $('#tabla_mis_rutinas').load('/siga/vistas/view/biomedica/rutinas/siga_rutina_php_div.php');
}

//===============================================================================================================================================================================================================
//===============================================================================================================================================================================================================

function borradoDivActivos(){
  $('#id_activos_para_rutina_tbody').html('');  
}

//===============================================================================================================================================================================================================
//===============================================================================================================================================================================================================

function eliminar(id_baja){
  $('#row'+id_baja).remove();
  let i = $('#contador').val();
  //i--;
  $('#contador').val(i);

}    

//===============================================================================================================================================================================================================
//===============================================================================================================================================================================================================

function alertar(texto,tipo,boton){
  $.alert({
    title: 'SIGA',
    type: tipo,
    buttons: {
        Cerrar: {
            text: 'Cerrar',
            btnClass: boton,
            action: function(){
            }
        },
      },
    content: texto,
    });
}

//===============================================================================================================================================================================================================
//===============================================================================================================================================================================================================

function borrarArchivo(){
  let siga_id_actividad_editar = $('#siga_id_actividad_editar').html();

  $.confirm({
    title: 'SIGA',
    content: '¿Desea elimiar el archivo?',
    type: 'red',
    buttons: {
      
        Aceptar: function () {

$.ajax({
  type: "POST",
  url: "/siga/class/biomedica/rutinas/rutinas.ajax.php",
  data: {accion: 11, siga_id_actividad_editar:siga_id_actividad_editar},
  dataType: "JSON",
  async: false,
  cache: false,
  beforeSend: function(){

  },
  success: function (response) {
    $('#siga_actividades_link').hide();
    $('#siga_actividades_i').hide();
    $('#tabla_rutinas_actividades_edit').hide().load('/siga/vistas/view/biomedica/rutinas/siga_rutina_actividades_div.php').fadeIn('500');
  },
  error: function(response){
    alerta('Error al ejecutar está operación. Revise logs','red','btn-red')
  }
});

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        },
        cancel: function () {
            
        },
    }
});

}

//===============================================================================================================================================================================================================
//===============================================================================================================================================================================================================

function rutinasEliminarActividad(id){
  let Id_Usuario = <?php echo $Id_Usuario;?>;
  $.confirm({
    title: 'SIGA:',
    type: 'red',    
    content: '¿Desea eliminar la actividad?',
    btnClass: 'btn-red',
    buttons: {
        Confirmar: function () {
          $.ajax({
            type: "POST",
            url: "/siga/class/biomedica/rutinas/rutinas.ajax.php",
            data: {accion:16, id:id, Id_Usuario:Id_Usuario},
            dataType: "JSON",
            cache: false,
            beforeSend: function(){

            },
            success: function (response) {
              $('#tabla_rutinas_actividades_edit').load('/siga/vistas/view/biomedica/rutinas/siga_rutina_actividades_div.php').fadeIn('10000');
              //console.log(response);
            },
            error: function(response){
              $.alert({
              title: 'SIGA',
              content: 'Contacta a sistemas'+response,
              });
            }

          });
        },
        Cancelar: function () {
          
        }
    }
});



  // $.alert({
  //   title: 'SIGA',
  //   type: 'error',
  //   buttons: {
  //       Cerrar: {
  //           text: 'Cerrar',
  //           btnClass: boton,
  //           action: function(){
  //             $.ajax({
  //               type: "method",
  //               url: "/siga/class/biomedica/rutinas/rutinas.ajax.php",
  //               data: {accion:12,id:id },
  //               dataType: "JSON",
  //               cache: false,
  //               beforeSend: function(){

  //               },
  //               success: function (response) {
                  
  //               },
  //               error: function(response){

  //               }
  //             });
  //           }
  //       },
  //     },
  //   content: texto,
  //   });


}

</script>