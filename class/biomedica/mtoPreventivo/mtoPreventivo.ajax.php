<?php

include_once "mtoPreventivo.class.php";
include_once "/siga/class/admin/utilerias/util.class.php";

  include_once($_SERVER["DOCUMENT_ROOT"]."/siga/plugins/verot/class.upload.php");
  use Verot\Upload\Upload;


if(isset($_POST['accion']) && 
$_POST['accion'] !=='') {

  $accion = trim($_POST['accion']);
  $mtoPreventivoClass = new mtoPreventivo();
  $utilClass = new util();
  
  if($accion == 1){
    
    $id               = $_POST['id'];
    $Fech_Solicitud   = date('Ymd',strtotime($_POST['Fech_Solicitud']));
    $hoy              = date('Y-m-d');
    $Estatus_Proceso  = $_POST['Estatus_Proceso'];

    $mtoInfo        = $mtoPreventivoClass->getActividadesIdFecha($id, $Fech_Solicitud);
    $mtoArray       = array();
    
    foreach($mtoInfo as $item){
      //if($Estatus_Proceso != 2){$miStyle = "style= 'display:none'"; $estatusProcesoDisabled='';}
      if($item['siga_cat_rutinas_act_archivo']){$archivo = "<center><a href='https://apps2.hospitalsatelite.com/siga/archivos/Archivos-Rutinas/".$item['siga_cat_rutinas_act_archivo']."' target='_blank'><i class='fa fa-file-text-o' aria-hidden='true'></i></a></center>";} else {$archivo = "";}
      if($item['siga_cat_rutinas_act_valor_medio']==1){ $estilo = "style='font-size: 11px; border:1px solid red;'"; } else { $estilo = "style='font-size: 11px;'"; }
      if($item['siga_cat_rutinas_act_adjunto']==1){ $estiloAdjunto = "style='font-size: 13px; border:1px solid red;'"; } else { $estiloAdjunto = "style='font-size: 13px;'"; }
      
      if($item['Url_Adjunto']!=''){$url="<i class='fa fa-trash-o' aria-hidden='true' style='color:red' onclick='sigaActividadesEliminarImagen(".$item['Id_Det_Actividad'].",".$Fech_Solicitud.",".$id.");'></i> <a href='/siga/Archivos/Archivos-Actividades/Mantenimiento-Preventivo/".$item['Url_Adjunto']."' target='_blank'>Ver Archivo</a>"; $validaAdjunto=1; $fileEstadoArchivo='disabled';}else{$url=""; $validaAdjunto=0; $fileEstadoArchivo='';}

      // if($Estatus_Proceso == 2){
      //   if($item['Url_Adjunto']!=''){$url="<i class='fa fa-trash-o' aria-hidden='true' style='color:red' onclick='sigaActividadesEliminarImagen(".$item['Id_Det_Actividad'].",".$Fech_Solicitud.",".$id.");'></i> <a href='/siga/Archivos/Archivos-Actividades/Mantenimiento-Preventivo/".$item['Url_Adjunto']."' target='_blank'>Ver Archivo</a>"; $validaAdjunto=1; $fileEstadoArchivo='disabled';}else{$url=""; $validaAdjunto=0; $fileEstadoArchivo='';}
      // } else {
      //   if($item['Url_Adjunto']!=''){$url="<a href='/siga/Archivos/Archivos-Actividades/Mantenimiento-Preventivo/".$item['Url_Adjunto']."' target='_blank'>Ver Archivo</a>"; $validaAdjunto=1; $fileEstadoArchivo='disabled';}else{$url=""; $validaAdjunto=0; $fileEstadoArchivo='';}
      // }

      if($item['Fecha_Realizada'] == '        ' || $item['Fecha_Realizada'] == '' || $item['Fecha_Realizada'] == null){
        $boton = "class='btn btn-success btn-sm'"; $txtBtn='Guardar';$funcion="sigaValidarActividades"; $disabled=""; $miAccion=2;
        $fechaRealizadaActividad ='';
        $style = "";
      } else {
        $boton="class='btn btn-warning btn-sm'"; $txtBtn='Actualizar';$funcion="sigaValidarActividades"; $disabled = ""; $miAccion=2;
        $fechaRealizadaActividad = date("Y-m-d", strtotime($item['Fecha_Realizada']));
        //$style = "style= 'display:none'";
        $style = "";
      }

    if($item['Estatus_Actividad'] != null){
      if($item['Estatus_Actividad']==1){
        $check1 = "checked";
        $check2 = "";
        $check3 = "";
      } else if($item['Estatus_Actividad']==2){        
        $check1 = "";
        $check2 = "checked";
        $check3 = "";
      } else if($item['Estatus_Actividad']==3){
        $check1 = "";
        $check2 = "";
        $check3 = "checked";
      }else if($item['Estatus_Actividad']==0){
        $check1 = "";
        $check2 = "";
        $check3 = "";
      }
     } 
     else {
      $check1 = "";
      $check2 = "";
      $check3 = "";
    }

    $mtoArray[] = "
      <tr>
        <td>".$archivo."</td><td>".$item['siga_cat_rutinas_act_desc']."<input type='hidden' id='act_id_".$item['Id_Det_Actividad']."' name='act_id_".$item['Id_Det_Actividad']."' value='".$item['Id_Det_Actividad']."' readonly></td><td>".$item['siga_cat_rutinas_act_valor_ref']."</td>
        <td><textarea rows='2' class='form-control' id='act_valor_medido_".$item['Id_Det_Actividad']."' name='act_valor_medido_".$item['Id_Det_Actividad']."' ".$estilo." onblur='onBlurActividades(\"act_valor_medido\",".$item['Id_Det_Actividad'].",".$item['siga_cat_rutinas_act_valor_medio'].",".$item['siga_cat_rutinas_act_adjunto'].",\"".$item['siga_cat_rutinas_act_desc']."\");' ".$estatusProcesoDisabled.">".$item['Valor_Medido']."</textarea></td>
        <td><center><span class='form-radio'><input ".$estatusProcesoDisabled." type='radio' ".$check1." name='act_estatus_".$item['Id_Det_Actividad']."' id='act_estatus_".$item['Id_Det_Actividad']."' value='1' /><br><label for='act_estatus_".$item['Id_Det_Actividad']."' clase='display: block;'>OK</label></span></center></td>
        <td><center><span class='form-radio'><input ".$estatusProcesoDisabled." type='radio' ".$check2." name='act_estatus_".$item['Id_Det_Actividad']."' id='act_estatus_".$item['Id_Det_Actividad']."' value='2' /><br><label for='act_estatus_".$item['Id_Det_Actividad']."' clase='display: block;'>Fallo</label></span></center></td>
        <td><center><span class='form-radio'><input ".$estatusProcesoDisabled." type='radio' ".$check3." name='act_estatus_".$item['Id_Det_Actividad']."' id='act_estatus_".$item['Id_Det_Actividad']."' value='3' /><br><label for='act_estatus_".$item['Id_Det_Actividad']."' clase='display: block;'>N/A</label></span></center></td>
        <td><textarea rows='2' class='form-control' placeholder='' id='act_observaciones_".$item['Id_Det_Actividad']."' name='act_observaciones_".$item['Id_Det_Actividad']."' style='font-size: 11px;' onblur='onBlurActividades(\"act_observaciones\",".$item['Id_Det_Actividad'].",".$item['siga_cat_rutinas_act_valor_medio'].",".$item['siga_cat_rutinas_act_adjunto'].",\"".$item['siga_cat_rutinas_act_desc']."\");' ".$estatusProcesoDisabled." >".$item['Observaciones']."</textarea></td>
        <td><input type='hidden' value='".$validaAdjunto."' name='act_adjunto_valida_".$item['Id_Det_Actividad']."' id='act_adjunto_valida_".$item['Id_Det_Actividad']."'><input name='act_adjunto_".$item['Id_Det_Actividad']."' id='act_adjunto_".$item['Id_Det_Actividad']."' placeholder='Select a file' type='file' ".$estiloAdjunto." class='form-control' ".$fileEstadoArchivo." ".$estatusProcesoDisabled.">$url
        <td>".date("d/m/Y", strtotime($item['Fecha_Programada']))."</td>
        <td>
          <input type = 'date' onkeypress='return false;' name='act_fch_realizado_".$item['Id_Det_Actividad']."' id='act_fch_realizado_".$item['Id_Det_Actividad']."' min='".$hoy."' value='".$fechaRealizadaActividad."' ".$estatusProcesoDisabled.">
        </td>
        <td>
          <button ".$boton." id='act_boton_".$item['Id_Det_Actividad']."' name='act_boton_".$item['Id_Det_Actividad']."' onclick='".$funcion."(".$item['Id_Det_Actividad'].",".$item['siga_cat_rutinas_act_valor_medio'].",".$item['siga_cat_rutinas_act_adjunto'].",\"".$item['siga_cat_rutinas_act_desc']."\",".$miAccion.")' ".$miStyle." >".$txtBtn."</button>
        </td>
      </tr>      
      ";
    }

    //array_push($mtoArray, "<tr style='display:none'><td><input type='text' id='mto_prev_Id_Actividad' name='mto_prev_Id_Actividad' value='".$id."'></td><td><input type='text' id='mto_prev_Fecha_Programada' name='mto_prev_Fecha_Programada' value='".$Fech_Solicitud."'></td></tr>");

    echo json_encode($mtoArray);

  } 

// ================================================================================================================================================================================================
// ================================================================================================================================================================================================

  else if ($accion == 2){

    $Id_Usuario         = $_POST['Id_Usuario'];
    $act_id             = $_POST['act_id'];
    $act_valor_medido   = $_POST['act_valor_medido'];
    $act_estatus        = $_POST['act_estatus'];
    $act_observaciones  = $_POST['act_observaciones'];
    $act_fch_realizado  = date('Ymd',strtotime($_POST['act_fch_realizado']));
    $hoy                = date('Ymd');
    $ext_adjunto        = $_FILES['file']['name'];
    $act_adjunto        = $_FILES['file'];
    $act_adjunto_valida = $_POST['act_adjunto_valida'];
    
    $tipoArchivo  = pathinfo($ext_adjunto, PATHINFO_EXTENSION);

    $fileNombre   = $hoy.'-'.$utilClass->nombreAleatorio();
    $nuevoNombre  = $fileNombre.'.'.$tipoArchivo;    

    $mtoInfo = $mtoPreventivoClass->updateActividades($act_id,$act_valor_medido,$act_estatus,$act_observaciones, $act_fch_realizado, $nuevoNombre, $Id_Usuario );

    if($mtoInfo){
      
      if($act_adjunto_valida==0){

            $foo = new Upload($act_adjunto);
            
              $url = $_SERVER["DOCUMENT_ROOT"].'/siga/Archivos/Archivos-Actividades/Mantenimiento-Preventivo/';
              $id = $fileNombre;          
              $foo->image_resize        = true;
              $foo->image_x             = 1260;
              $foo->image_y             = 1260;
              $foo->image_ratio         = true;
              $foo->file_new_name_body  = sprintf($id, $size_x, time());

                $foo->process($url);
                $foo->processed;
            echo json_encode(true);
          
          } else {
            echo json_encode(false);
          } 
      
      }     

  }

// ================================================================================================================================================================================================
// ================================================================================================================================================================================================

   else if($accion == 3){

    $act_id = $_POST['act_id'];
    $campo  = $_POST['campo'];
    $valor  = $_POST['valor'];
    
    $mtoInfo = $mtoPreventivoClass->sigaActualizarActividades($act_id,$campo,$valor);
    echo json_encode($mtoInfo);

  } 
  
// ================================================================================================================================================================================================
// ================================================================================================================================================================================================
  
  else if ($accion == 4){

    $id = $_POST['id'];
    $mtoInfo = $mtoPreventivoClass->sigaActividadesEliminarImagen($id);

    echo json_encode('ACCION: 4'.$id);
  
  } 

// ================================================================================================================================================================================================
// ================================================================================================================================================================================================

  else if ($accion == 5){
    $Id_Actividad = $_POST['Id_Actividad'];

    $mtoInfo = $mtoPreventivoClass->getActivoActividad($Id_Actividad);

    echo json_encode($mtoInfo);
  } 
  
// ================================================================================================================================================================================================
// ================================================================================================================================================================================================
  
  else if ($accion == 6){

    $id_actividad_detalle         = $_POST['id_actividad_detalle'];
    $fecha_reprogramada_detalle   = $_POST['fecha_reprogramada_detalle'];    
    $Id_Usuario                   = $_POST['Id_Usuario'];
    
    $mtoInfo = $mtoPreventivoClass->reprogramarActividad($id_actividad_detalle,$fecha_reprogramada_detalle,$Id_Usuario);

    echo json_encode($mtoInfo);
  } 
  
// ================================================================================================================================================================================================
// ================================================================================================================================================================================================
  
  else if ($accion == 7){

    $texto_fecha_programada   = $_POST['texto_fecha_programada'];
    $texto_id_actividad       = $_POST['texto_id_actividad'];    
    $Id_Usuario               = $_POST['Id_Usuario'];
    
      $mtoInfo = $mtoPreventivoClass->cancelarActividad($texto_id_actividad,$Id_Usuario);

    echo json_encode($mtoInfo);

  } 
  
// ================================================================================================================================================================================================
// ================================================================================================================================================================================================
  
  else if ($accion == 8){

    $Fecha_Programada = $_POST['Fecha_Programada'];
    $Fecha_Programada = date('Ymd',strtotime($Fecha_Programada));
    $Id_Actividad     = $_POST['Id_Actividad'];

    $validarRutinaCompletaInfo = $mtoPreventivoClass->validarRutinaCompleta($Id_Actividad, $Fecha_Programada);

    echo json_encode($validarRutinaCompletaInfo);
  } 
  
// ================================================================================================================================================================================================
// ================================================================================================================================================================================================

  else if ($accion == 9){
    
    $Id_Actividad     = $_POST['id'];
    
    $Info = $mtoPreventivoClass->getTituloDeRutina($Id_Actividad);

    echo json_encode($Info);
  
  } 
  
// ================================================================================================================================================================================================
// ================================================================================================================================================================================================
  
  else if($accion == 10){

    $Id_Usuario       = $_POST['Id_Usuario'];
    $Id_Solicitud     = $_POST['Id_Solicitud'];
    $arrayAccesorios  = $_POST['arrayAccesorios'];

    foreach($arrayAccesorios as $item){
    $descripcion    = str_replace(',','',trim($item['descripcion']));
    $descripcion    = str_replace('"','',trim($descripcion));
    $descripcion    = str_replace("'","",trim($descripcion));    
    $Folio_Almacen  = str_replace(',','',trim($item['Folio_Almacen']));
    $sku            = str_replace(',','',trim($item['sku']));
 
    $info = $mtoPreventivoClass->insertAccesoriosDeTicket($Id_Solicitud,$descripcion,$Folio_Almacen,$sku,trim($item['clase']),trim($item['unidad']),trim($item['costo']),trim($item['cantidad']),trim($Id_Usuario));
      //echo json_encode($info);
    }
    
    echo json_encode($info);
  } 
  
// ================================================================================================================================================================================================
// ================================================================================================================================================================================================
  
  else if($accion == 11){

    $Id_Usuario       = $_POST['Id_Usuario'];
    $Id_Solicitud     = $_POST['Id_Solicitud'];
    $arrayAccesorios  = $_POST['arrayAccesorios'];

    foreach($arrayAccesorios as $item){
    $descripcion    = str_replace(',','',trim($item['descripcion']));
    $descripcion    = str_replace('"','',trim($descripcion));
    $descripcion    = str_replace("'","",trim($descripcion));    
    $Folio_Almacen  = str_replace(',','',trim($item['Folio_Almacen']));
    $sku            = str_replace(',','',trim($item['sku']));
 
    $info = $mtoPreventivoClass->insertAccesoriosDeTicket($Id_Solicitud,$descripcion,$Folio_Almacen,$sku,trim($item['clase']),trim($item['unidad']),trim($item['costo']),trim($item['cantidad']),trim($Id_Usuario));
      //echo json_encode($info);

    }
  
  } 
  
// ================================================================================================================================================================================================
// ================================================================================================================================================================================================
  
  else if ($accion == 12){
    $Id_Usuario         = $_POST['Id_Usuario'];
    $act_id             = $_POST['act_id'];
    $act_valor_medido   = $_POST['act_valor_medido'];
    $act_estatus        = $_POST['act_estatus'];
    $act_observaciones  = $_POST['act_observaciones'];
    $act_fch_realizado  = date('Ymd',strtotime($_POST['act_fch_realizado']));
    $hoy                = date('Ymd');
    $act_adjunto        = $_FILES['file']['name'];
    $act_adjunto_valida = $_POST['act_adjunto_valida'];


    if($act_adjunto != ''){
      $act_adjunto =$hoy.'-'.$act_adjunto;
    } else {
      $act_adjunto ='';
    }

    //$mtoInfo = $mtoPreventivoClass->updateActividades($act_id,$act_valor_medido,$act_estatus,$act_observaciones, $act_fch_realizado, $act_adjunto, $Id_Usuario );
    $mtoInfo = $mtoPreventivoClass->updateActividadesSinImagen($act_id,$act_valor_medido,$act_estatus,$act_observaciones, $act_fch_realizado, $Id_Usuario );

    // if($mtoInfo){

      
    //   if($act_adjunto_valida==0){

    //     if($act_adjunto != ''){
    //       $destinationDirectory = $_SERVER['DOCUMENT_ROOT'].'/SIGA/Archivos/Archivos-Actividades/Mantenimiento-Preventivo/';
    //       $finalLocation = $destinationDirectory.$act_adjunto;
  
    //       if(move_uploaded_file($_FILES['file']['tmp_name'], $finalLocation)) {
    //           echo json_encode(true);
    //         } else {
    //           echo json_encode(false);
    //       }
        
    //     } else {
    //       echo json_encode(false);
    //     } 
    //   }     

    // }else{
    //   echo json_encode($act_adjunto);
    // }   

    echo json_encode($mtoInfo);

  } 
  
// ================================================================================================================================================================================================
// ================================================================================================================================================================================================
  
  else if ($accion == 14) {
    $id_solicitud     = $_POST['Id_Solicitud'];
    $origen_alm_ext   = $_POST['origen_alm_ext'];
    $Estatus_Proceso  = $_POST['Estatus_Proceso'];

    $datos = array();

    $mtoInfo = $mtoPreventivoClass->materialTicket($id_solicitud,$origen_alm_ext);
    $total = 0;
    foreach($mtoInfo as $item){
        if($Estatus_Proceso != 2){
          $style = 'style="display: none;"';
        }
        if($origen_alm_ext==1){
          $total+=$item['importe'];
          $datos[]="<tr><td>".$item['descripcion_material']."</td><td>".$item['folio_almacen_material']."</td><td>".$item['sku_material']."</td><td>".$item['clase_material']."</td><td>".$item['unidad_material']."</td><td>$".number_format($item['costo_material'],2, '.', ',')."</td><td>".$item['cantidad_material']."</td><td>$".number_format($item['importe'],2, '.', ',')."</td><td><i class='fa fa-pencil' aria-hidden='true' onclick='editarMaterial(".$item['id_materiales'].")' ".$style." ></i></td><td><i class='fa fa-trash' aria-hidden='true' onclick='eliminarMaterial(".$item['id_materiales'].")' ".$style." ></i></td></tr>";      
        } else if ($origen_alm_ext==2){
          $total+=$item['importe'];
          $datos[]="<tr><td>".$item['descripcion_material']."</td><td>".$item['clase_material']."</td><td>".$item['unidad_material']."</td><td>".$item['numDeParte']."</td><td>".$item['referencia']."</td><td>$".number_format($item['costo_material'],2, '.', ',')."</td><td>".$item['cantidad_material']."</td><td>$".number_format($item['importe'],2, '.', ',')."</td><td><i class='fa fa-pencil' aria-hidden='true' onclick='editarMaterialExterno(".$item['id_materiales'].")' ".$style." ></i></td><td><i class='fa fa-trash' aria-hidden='true' onclick='eliminarMaterial(".$item['id_materiales'].")' ".$style." ></i></td></tr>";      
        }      
      }
      

      if($origen_alm_ext==1){
        $datos[]="<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>$".number_format($total,2, '.', ',')."</td><td></td><td></td></tr>";      
      } else {
        $datos[]="<tr><td></td><td></td><td></td><td></td><td></td><td>$".number_format($total,2, '.', ',')."</td><td></td><td></td></tr>";      
      }
         
    echo json_encode($datos);

  } 
  
// ================================================================================================================================================================================================
// ================================================================================================================================================================================================

  else if ($accion == 15){
    $id_material  = $_POST['id_material'];
    $Id_Usuario   = $_POST['Id_Usuario'];

    $mtoInfo = $mtoPreventivoClass->eliminarMaterial($id_material,$Id_Usuario);

    echo json_encode($mtoInfo);

  } 
  
// ================================================================================================================================================================================================
// ================================================================================================================================================================================================

  else if ($accion == 16){
    $id_material  = $_POST['id_material'];

    $mtoInfo = $mtoPreventivoClass->editarMaterial($id_material);

    echo json_encode($mtoInfo);

  } 
  
// ================================================================================================================================================================================================
// ================================================================================================================================================================================================
  
  else if ($accion == 17){

    $id_materiales              = $_POST['id_materiales'];
    $acc_folio_almacen_material = $_POST['acc_folio_almacen_material'];
    $acc_cantidad_material      = $_POST['acc_cantidad_material'];
    $Id_Usuario                 = $_POST['Id_Usuario'];

    $mtoInfo = $mtoPreventivoClass->editarMaterialUpdate($id_materiales, $acc_folio_almacen_material, $acc_cantidad_material, $Id_Usuario);

    echo json_encode($mtoInfo);

  } 
  
// ================================================================================================================================================================================================
// ================================================================================================================================================================================================
  
  else if ($accion == 18){

    $mtoInfo = $mtoPreventivoClass->accesoriosAssist();
    
    //$accesorios_assist_array=array("<option disabled selected value='-1'> Seleccionar Material Disponible </option>");

    foreach($mtoInfo as $item){
      $accesorios_assist_array[]="<option value='".$item['art']."'>".$item['des1']."</option>";
    }

    echo json_encode($accesorios_assist_array);

  } 
  
// ================================================================================================================================================================================================
// ================================================================================================================================================================================================
  
  else if ($accion == 19){

    $idAccesorioAssist  = $_POST['idAccesorioAssist'];
    $mtoInfo = $mtoPreventivoClass->accesoriosAssistId($idAccesorioAssist);

    echo json_encode($mtoInfo);

  } 
  
// ================================================================================================================================================================================================
// ================================================================================================================================================================================================  
  
  else if ($accion == 20){

    $Id_Solicitud                 = trim($_POST['Id_Solicitud']);
    $combo_accesorios_assist      = trim($_POST['combo_accesorios_assist']);
    $acc_folio_almacen_material_a = trim($_POST['acc_folio_almacen_material_a']);
    $acc_sku_material_a           = trim($_POST['acc_sku_material_a']);
    $acc_clase_material_a         = trim($_POST['acc_clase_material_a']);
    $acc_unidad_material_a        = trim($_POST['acc_unidad_material_a']);
    $acc_costo_material_a         = trim($_POST['acc_costo_material_a']);    
    $acc_cantidad_material_a      = trim($_POST['acc_cantidad_material_a']);
    $Id_Usuario                   = trim($_POST['Id_Usuario']);
    $origen_alm_ext               = trim($_POST['origen_alm_ext']);
    $acc_no_parte_ext             = trim($_POST['acc_no_parte_ext']);
    $acc_referencia_ext           = trim($_POST['acc_referencia_ext']);

    $mtoInfo = $mtoPreventivoClass->agregarMaterial($Id_Solicitud,$combo_accesorios_assist, $origen_alm_ext, $acc_folio_almacen_material_a,$acc_sku_material_a,$acc_clase_material_a,$acc_unidad_material_a,$acc_costo_material_a,$acc_cantidad_material_a,$Id_Usuario,$acc_no_parte_ext,$acc_referencia_ext);

    echo json_encode($mtoInfo);

  } 
  
// ================================================================================================================================================================================================
// ================================================================================================================================================================================================
  
  else if ($accion == 21){

    $Id_Solicitud                 = trim($_POST['Id_Solicitud']);
    $mtoInfo = $mtoPreventivoClass->totalImporteMateriales($Id_Solicitud);
    $info = number_format($mtoInfo,2);
    echo json_encode('$'.$info);
  
  } 
  
// ================================================================================================================================================================================================
// ================================================================================================================================================================================================
  
  else if ($accion == 22){
    $datos = array('EQPO','REF','ACC','CON');
    $options = array();
    $id_materiales                 = trim($_POST['id_materiales']);    
    $mtoInfo = $mtoPreventivoClass->getClase($id_materiales);
    
    foreach($datos as $item){
      if($item == $mtoInfo){$select='selected';} else {$select='';}
      $options [] = "<option value='".$item."' $select>".$item."</option>";
    }

    echo json_encode($options);

  } 
  
// ================================================================================================================================================================================================
// ================================================================================================================================================================================================
    
  else if ($accion == 23){
    $datos = array('PZA','CAJ','BOL','PAQ','KIT','MTR'); 
    $id_materiales                 = trim($_POST['id_materiales']);
    $mtoInfo = $mtoPreventivoClass->getUnidad($id_materiales);
    
    foreach($datos as $item){
      if($item == $mtoInfo){$select='selected';} else {$select='';}
      $options [] = "<option value='".$item."' $select>".$item."</option>";
    }

    echo json_encode($options);
  
  } 
  
// ================================================================================================================================================================================================
// ================================================================================================================================================================================================  
  
  else if ($accion == 24){
    
    $id_materiales_edit                 = trim($_POST['id_materiales_edit']);
    $acc_descripcion_material_ext_edit  = trim($_POST['acc_descripcion_material_ext_edit']);
    $acc_clase_material_ext_edit        = trim($_POST['acc_clase_material_ext_edit']);
    $acc_unidad_material_ext_edit       = trim($_POST['acc_unidad_material_ext_edit']);
    $acc_no_parte_ext_edit              = trim($_POST['acc_no_parte_ext_edit']);
    $acc_referencia_ext_edit            = trim($_POST['acc_referencia_ext_edit']);
    $acc_costo_material_ext_edit        = trim($_POST['acc_costo_material_ext_edit']);
    $acc_cantidad_material_ext_edit     = trim($_POST['acc_cantidad_material_ext_edit']);
    $Id_Usuario                         = trim($_POST['Id_Usuario']);

    $mtoInfo = $mtoPreventivoClass->editarMaterialExternoUpdate($id_materiales_edit, $acc_descripcion_material_ext_edit,$acc_clase_material_ext_edit, $acc_unidad_material_ext_edit, $acc_no_parte_ext_edit, $acc_referencia_ext_edit, $acc_costo_material_ext_edit, $acc_cantidad_material_ext_edit, $Id_Usuario);

    echo json_encode($options);
  } 

// ================================================================================================================================================================================================
// ================================================================================================================================================================================================

  else if ($accion == 25){
    
    $id_solicitud = trim($_POST['id']);
    $info = $mtoPreventivoClass->getActividadesTicketLectura($id_solicitud);
    $respuesta = array();

    foreach($info as $item){
  
      if($item["Url_Adjunto"] != ''){
        $imagen='<a href="https://apps2.hospitalsatelite.com/siga/Archivos/Archivos-Actividades/Mantenimiento-Preventivo/'.$item["Url_Adjunto"].'" target="_blank"><i class="fa fa-camera" aria-hidden="true"></i></a>';
      } else {$imagen='';}

      if($item["Estatus_Actividad"] == 1){ $estatus='OK'; } 
      else if($item["Estatus_Actividad"] == 2){ $estatus='FALLO'; } 
      else if($item["Estatus_Actividad"] == 3){ $estatus='N/A'; }

      $respuesta[]='<tr>												
											<td style="width:20%">'.$item["Nombre_Actividad"].'</td>
											<td style="width:20%">'.$item["Valor_Referencia"].'</td>
											<td style="width:20%">'.$item["Valor_Medido"].'</td>
											<td align="center" style="width:5%">'.$estatus.'</td>
											<td style="width:20%">'.$item["Observaciones"].'</td>                      
											<td align="center" style="width:5%">'.$imagen.'</td>
											<td align="center" style="width:5%">'.date("d/m/Y", strtotime($item["Fecha_Realizada"])).'</td>
										</tr>';
                  }
    
    echo json_encode($respuesta);
  }   else if ($accion == 26){
    
    $id_solicitud = trim($_POST['id']);
    $info = $mtoPreventivoClass->getMaterialesTicketLectura($id_solicitud);
    $respuesta = array();

    foreach($info as $item){

      $respuesta[]='<tr>												
											<td style="width:10%">'.$item["sku_material"].'</td>
											<td style="width:20%">'.$item["descripcion_material"].'</td>
                      <td style="width:5%">'.$item["Origen"].'</td>
											<td style="width:10%">'.$item["folio_almacen_material"].'</td>
                      <td style="width:5%">'.$item["clase_material"].'</td>
                      <td style="width:5%">'.$item["unidad_material"].'</td>
                      <td style="width:5%">'.$item["numDeParte"].'</td>
                      <td style="width:5%">'.$item["referencia"].'</td>
                      <td class="text-right" style="width:5%">'.number_format($item["costo_material"],2).'</td>
                      <td class="text-right" style="width:5%">'.$item["cantidad_material"].'</td>
                      <td class="text-right" style="width:5%">'.number_format($item["total"],2).'</td>
										</tr>';
                  }
    
    echo json_encode($respuesta);
  } 

// ================================================================================================================================================================================================
// ================================================================================================================================================================================================


}else{
  echo json_encode('rutinas Ajax');
  }