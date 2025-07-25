<?php

include_once "bajaActivo.class.php";

if(isset($_POST['accion']) && 
$_POST['accion'] !=='') {
  
  $accion = trim($_POST['accion']);

  if($accion == 1){

    $bajaActivoClass = new bajaActivo();
    $Id_Activo       = trim($_POST['Id_Activo']);

    $resultado = $bajaActivoClass->updatedSituacionActivo($Id_Activo);

    print json_encode($resultado);
    
  } 
  
//======================================================================================================================================
 }else{

  echo json_encode('Error, Contacte a sistemas');

}