<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/biomedica/rutinas/rutinas.class.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/admin/utilerias/util.class.php");


if(isset($_POST['accion']) && 
$_POST['accion'] !=='') {


$accion = trim($_POST['accion']);
$rutinasClass = new rutinas();
$utilClass    = new util();

if($accion==1){
 
    echo json_encode('ok:'.$accion);

  } else if($accion == 2){
   
    echo json_encode('OK:'.$accion);

  } else if($accion == 3){
    $rutinasClass = new rutinas();
    $siga_rutina_titulo_id  = $_POST['siga_rutina_titulo_id'];
    $Id_Usuario             = $_POST['Id_Usuario'];
    $rutinaBaja = $rutinasClass->sigaRutinasBaja($siga_rutina_titulo_id,$Id_Usuario);
  
    echo json_encode($rutinaBaja);

  } else if ($accion==4){
    
    $siga_rutinas_id = $_POST['siga_rutinas_id'];
    $rutinasInfo = $rutinasClass->sigaRutinasInfo($siga_rutinas_id);

    echo json_encode($rutinasInfo);
  
  } else if($accion==5){

      $siga_ids_activos = $_POST['siga_ids_activos'];
      $rutinasInfo = $rutinasClass->sigaRutinasActivosSolicitados($siga_ids_activos);

    echo json_encode($rutinasInfo);

  } else if ($accion==6){
    
    $array            = $_POST['array'];
    $siga_cmb_rutinas = $_POST['siga_cmb_rutinas'];
    $siga_cmb_rutinasD= $_POST['siga_cmb_rutinasD'];
    $Id_Usuario       = $_POST['Id_Usuario'];

    foreach($array as $item){

      switch ($item['Frecuencia']) {
        case 2:
          $rutinasInfo = $rutinasClass->sigaInsertarRutina($item['id_activo'],2, $item['fecha'],$siga_cmb_rutinas, $siga_cmb_rutinasD, $Id_Usuario);          
          break;
        case 3:
          $rutinasInfo = $rutinasClass->sigaInsertarRutina($item['id_activo'],3, $item['fecha'],$siga_cmb_rutinas, $siga_cmb_rutinasD, $Id_Usuario);          
          break;
        case 4:
          $rutinasInfo = $rutinasClass->sigaInsertarRutina($item['id_activo'],4, $item['fecha'],$siga_cmb_rutinas, $siga_cmb_rutinasD, $Id_Usuario);          
          break;
        case 5:
          $rutinasInfo = $rutinasClass->sigaInsertarRutina($item['id_activo'],5, $item['fecha'],$siga_cmb_rutinas, $siga_cmb_rutinasD, $Id_Usuario);          
          break;
        case 6:
          $rutinasInfo = $rutinasClass->sigaInsertarRutina($item['id_activo'],6, $item['fecha'],$siga_cmb_rutinas, $siga_cmb_rutinasD, $Id_Usuario);          
          break;
        case 7:          
          $rutinasInfo = $rutinasClass->sigaInsertarRutina($item['id_activo'],7, $item['fecha'],$siga_cmb_rutinas, $siga_cmb_rutinasD, $Id_Usuario);          
          break;
      }
      
  }
    echo json_encode($rutinasInfo);
  
  } else if($accion==7){

      $id = $_POST['id'];
      $rutinasInfo = $rutinasClass->actividadPorId($id);
      
      echo json_encode($rutinasInfo);
  } else if($accion==8){

    $siga_id_actividad_editar     = trim($_POST['siga_id_actividad_editar']);
    $siga_rutina_act_desc         = trim($_POST['siga_rutina_act_desc']);
    $siga_rutina_act_valor_ref    = trim($_POST['siga_rutina_act_valor_ref']);
    $siga_rutina_act_valor_medio  = $_POST['siga_rutina_act_valor_medio'];
    $siga_rutina_act_adjunto      = $_POST['siga_rutina_act_adjunto'];
    $siga_rutina_act_archivo      = $_FILES['siga_rutina_act_archivo'];
    $Id_Usuario                   = trim($_POST['Id_Usuario']);

    $ramdom = $utilClass->nombreAleatorio();
    $ruta   = $utilClass->rutaRaiz();

    if($siga_rutina_act_archivo!= null){      
      $ext = pathinfo($_FILES['siga_rutina_act_archivo']['name'], PATHINFO_EXTENSION);
      $nombreArchivo=$siga_id_actividad_editar.$ramdom.'.'.$ext;

      $rutinasInfo = $rutinasClass->actividadUpdatePorId($siga_id_actividad_editar, $siga_rutina_act_desc, $siga_rutina_act_valor_ref, $siga_rutina_act_valor_medio, $siga_rutina_act_adjunto,$nombreArchivo,$Id_Usuario);

      $nombreArchivoEliminar = $rutinasClass->sigaEliminarArchivoCarpeta($siga_id_actividad_editar);
      $utilClass->fnlog($nombreArchivoEliminar);
      unlink($ruta.'/Archivos/Archivos-Rutinas/'.$nombreArchivoEliminar);   

         if($rutinasInfo){
          
          if(move_uploaded_file($_FILES['siga_rutina_act_archivo']['tmp_name'], $ruta.'/Archivos/Archivos-Rutinas/'.$nombreArchivo)){            
            $rutinasClass->sigaRutinasActividadUpdateArchivo($siga_id_actividad_editar,$nombreArchivo);
          }else{
            $utilClass->fnlog('Error al subir archivo rutina-actividades');
          }

        }

     }else{
      $nombreArchivo = '';
      $rutinasInfo = $rutinasClass->actividadUpdatePorId($siga_id_actividad_editar, $siga_rutina_act_desc, $siga_rutina_act_valor_ref, $siga_rutina_act_valor_medio, $siga_rutina_act_adjunto,$nombreArchivo,$Id_Usuario);
     }



    echo json_encode($rutinasInfo);

    
  } else if($accion == 9){
      $rutinasInfo = $rutinasClass->sigaRutinas();
      $rutinasInfoArray = array('<option value="-1">Seleccionar Rutina</option>');

      foreach($rutinasInfo as $item){
        $rutinasInfoArray[]='<option value='.$item["siga_cat_rutinas_id"].'>'.$item["siga_cat_rutinas_titulo"].'</option>';
      }
    echo json_encode($rutinasInfoArray);

  }  else if ($accion == 10) {
        
    $select_activos         = $_POST['select_activos'];
    $siga_rutinasGet        = $_POST['siga_rutinasGet'];    
    $siga_fecha_programada  = $_POST['siga_fecha_programada'];
    $siga_frecuencia        = $_POST['siga_frecuencia'];
    $siga_realiza           = $_POST['siga_realiza'];
    $vincular_a_mesa_ayuda  = $_POST['vincular_a_mesa_ayuda'];
    $siga_rutinasGetNombre  = $_POST['siga_rutinasGetNombre'];    
    $Id_Usuario             = $_POST['Id_Usuario'];
    
    $rutinasInfo = $rutinasClass->sigaInsertarRutina($select_activos,$siga_frecuencia, $siga_fecha_programada,$siga_rutinasGet, $siga_rutinasGetNombre, $Id_Usuario,$siga_realiza );

      echo json_encode($rutinasInfo);
  
    } else if ($accion==11) {
      $siga_id_actividad_editar = $_POST['siga_id_actividad_editar'];

      $rutinasClass->sigaEliminarArchivoActividad($siga_id_actividad_editar);
      echo json_encode($accion);

     } else if ($accion==12){
      $Id_Usuario             = $_POST['Id_Usuario'];
      $siga_titulo_editar_id  = $_POST['siga_titulo_editar_id'];
      $siga_titulo_editar     = trim($_POST['siga_titulo_editar']);

      $siga_titulo_editar = str_replace('"', "", $siga_titulo_editar);
      $siga_titulo_editar = str_replace("'", "", $siga_titulo_editar);

      $resultado = $rutinasClass->sigaRutinaUpdateTitulo($Id_Usuario, $siga_titulo_editar_id, $siga_titulo_editar);

      echo json_encode($resultado);

     } else if ($accion==14) {

      $siga_cat_rutinas_id = $_POST['siga_cat_rutinas_id'];
      $info=$rutinasClass->sortActividades($siga_cat_rutinas_id);

      foreach ($info as $item) {
        $resultado[] = '<option value='.$item["siga_cat_sort"].'>'.$item["siga_cat_sort"].'</option>';
      }
        $resultado[] = '<option value="-1">Último</option>';
      
      echo json_encode($resultado);

    } else if ($accion==15) {

      $ruta                               = $utilClass->rutaRaiz();
      $ramdom                             = $utilClass->nombreAleatorio();

      $Id_Usuario                         = $_POST['Id_Usuario'];
      $siga_id_rutina_a_editar            = $_POST['siga_id_rutina_a_editar'];
      $sigaSortActividades                = $_POST['sigaSortActividades'];
      $siga_rutina_act_desc_agregar       = $_POST['siga_rutina_act_desc_agregar'];
      $siga_rutina_act_valor_ref_agregar  = $_POST['siga_rutina_act_valor_ref_agregar'];

      $siga_rutina_act_valor_medio_agregar= $_POST['siga_rutina_act_valor_medio_agregar'];
      $siga_rutina_act_adjunto_agregar    = $_POST['siga_rutina_act_adjunto_agregar'];

      $siga_rutina_act_archivo_agregar    = $_FILES['siga_rutina_act_archivo_agregar']['name'];


      if($siga_rutina_act_valor_medio_agregar == 'true'){$siga_rutina_act_valor_medio_agregar=1;}else{$siga_rutina_act_valor_medio_agregar=0;};
      if($siga_rutina_act_adjunto_agregar == 'true'){$siga_rutina_act_adjunto_agregar=1;}else{$siga_rutina_act_adjunto_agregar=0;};

      if($siga_rutina_act_archivo_agregar!= null){ 
      $ext = pathinfo($_FILES['siga_rutina_act_archivo_agregar']['name'], PATHINFO_EXTENSION);
      $nombreArchivo=$ramdom.'.'.$ext;
  
      $info=$rutinasClass->sigaAgregarActividadRutinaVigente($siga_id_rutina_a_editar, $sigaSortActividades, $siga_rutina_act_desc_agregar,$siga_rutina_act_valor_ref_agregar, $siga_rutina_act_valor_medio_agregar, $siga_rutina_act_adjunto_agregar, $nombreArchivo,$Id_Usuario);
      
      if($info){
        move_uploaded_file($_FILES['siga_rutina_act_archivo_agregar']['tmp_name'], $ruta.'/Archivos/Archivos-Rutinas/'.$nombreArchivo);        
        $resultado = true;
        }else{
          $resultado= false;
        }
      
      } else {
        $info=$rutinasClass->sigaAgregarActividadRutinaVigente($siga_id_rutina_a_editar, $sigaSortActividades, $siga_rutina_act_desc_agregar,$siga_rutina_act_valor_ref_agregar, $siga_rutina_act_valor_medio_agregar, $siga_rutina_act_adjunto_agregar,'',$Id_Usuario);
        $resultado = true;
      }

      echo json_encode($resultado);
    
    } else if ($accion==16) {
      $Id_Usuario = $_POST['Id_Usuario'];
      $id         = $_POST['id'];

      $resultado=$rutinasClass->sigaEliminarActividadRutinaVigente($Id_Usuario,$id);
      echo json_encode($resultado);

    } else if ($accion==17) {
      $Id_Area = $_POST['Id_Area'];
      
      $info  = $rutinasClass->sigaRutinas();
      $infoArray = array();

        echo json_encode($info);
    } 

} else {
echo json_encode('error rutina Ajax');
}
