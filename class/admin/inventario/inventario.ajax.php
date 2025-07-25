<?php

include_once "inventario.class.php";

if(isset($_POST['accion']) && 
$_POST['accion'] !=='') {
  
  $accion = trim($_POST['accion']);

  if($accion == 1){

    $inventarioClass = new inventario();

    echo json_encode('accion1');
    
  } else if ($accion == 2){
    
    $af_bc= trim($_POST['af_bc']);
    
    $inventarioClass = new inventario();
    $resultado = $inventarioClass->validarAFBC($af_bc);

    echo json_encode($resultado);
  }



  
//======================================================================================================================================
 }else{

  echo json_encode('Error, Contacte a sistemas');

}