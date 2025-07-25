<?php

include_once "notasDeSalida.class.php";

if(isset($_POST['accion']) && 
$_POST['accion'] !=='') {
  
  $accion = trim($_POST['accion']);

  if($accion == 1){
    $notasDeSalidaClass = new notasDeSalida();
    $Id_Solicitud  = trim($_POST['Id_Solicitud']);

    $info = $notasDeSalidaClass->getDatosActivoExterno($Id_Solicitud);

    echo json_encode($info);
  } else if($accion==2){

    $notasDeSalidaClass = new notasDeSalida();

    $Id_Area      = $_POST['Id_Area'];
    $Id_Ubic_Prim = $_POST['Id_Ubic_Prim'];

    $info = $notasDeSalidaClass->getUbicPrimaria($Id_Area);
    $options = array();
    
    foreach($info as $item){
      if($item["Id_Ubic_Prim"] == $Id_Ubic_Prim){
        $selected = 'selected';
      } else {
        $selected = '';
      }
      $options[]='<option value="'.$item["Id_Ubic_Prim"].'" '.$selected.'>'.$item["Desc_Ubic_Prim"].'</option>';
    }

    echo json_encode($options);
  
  } else if($accion==3){
    $notasDeSalidaClass = new notasDeSalida();
    $Id_Ubic_Prim = trim($_POST['Id_Ubic_Prim']);
    $Id_Ubic_Sec  = trim($_POST['Id_Ubic_Sec']);
     $options = array();

    $info = $notasDeSalidaClass->getUbicSecundaria($Id_Ubic_Prim);

    foreach($info as $item){
      if($item["Id_Ubic_Sec"] == $Id_Ubic_Sec){
        $selected = 'selected';
      } else {
        $selected = '';
      }
      $options[]='<option value="'.$item["Id_Ubic_Sec"].'" '.$selected.'>'.$item["Desc_Ubic_Sec"].'</option>';
    }

    echo json_encode($options);

  } else if($accion==4){
    
    $notasDeSalidaClass = new notasDeSalida();
    
    $Id_Ubic_Prim = trim($_POST['Id_Ubic_Prim']);    
    $options      = array();

    $info = $notasDeSalidaClass->getUbicSecundaria($Id_Ubic_Prim);

    foreach($info as $item){
        $options[]='<option value="'.$item["Id_Ubic_Sec"].'">'.$item["Desc_Ubic_Sec"].'</option>';
      }

    echo json_encode($options);

  } else if($accion==5){
    
    $notasDeSalidaClass = new notasDeSalida();
    
    $ns_id_solicitud  = $_POST['ns_id_solicitud'];
    $ns_proveedor     = $_POST['ns_proveedor'];
    $ns_activo_nombre = $_POST['ns_activo_nombre'];
    $ns_modelo        = $_POST['ns_modelo'];
    $ns_marca         = $_POST['ns_marca'];
    $ns_no_serie      = $_POST['ns_no_serie'];
    $ns_cantidad      = $_POST['ns_cantidad'];
    $ns_uPrimaria     = $_POST['ns_uPrimaria'];
    $ns_uSecundaria   = $_POST['ns_uSecundaria'];

    $info = $notasDeSalidaClass->setEditarDatosActualizar($ns_id_solicitud, $ns_proveedor, $ns_activo_nombre, $ns_modelo, $ns_marca, $ns_no_serie, $ns_cantidad, $ns_uPrimaria, $ns_uSecundaria);

    echo json_encode($info);
    
  } else if($accion==6){
    
    $notasDeSalidaClass = new notasDeSalida();
    $info = $notasDeSalidaClass->getNotasDeSalidasCanceladas();
      echo json_encode($info);
  }
  
//======================================================================================================================================
 }else{

  echo json_encode('Error, Contacte a sistemas');

}