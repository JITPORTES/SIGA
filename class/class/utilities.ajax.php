<?php

include_once "utilities.class.php";

if(isset($_POST['accion']) && $_POST['accion'] !=='') {

  $accion = trim($_POST['accion']);
  $utilitiesClass = new utilities();

  if($accion == 1){
    $Id_Usuario = $_POST['Id_Usuario'] ;
    $info       = $utilitiesClass->getPermisoGestorSrRenta($Id_Usuario);

    echo json_encode($info);    
  } 

 }else{
echo json_encode('Error ajax: class/utilities.ajax.php');
}

