<?php

include_once "email.class.php";

if(isset($_POST['accion']) && 
$_POST['accion'] !=='') {
  
  $accion = trim($_POST['accion']);

  if($accion == 1){

    $emailClass = new email();

        $Id_Solicitud = $_POST['id_solicitud'];
        $motivo = $_POST['motivo'];

        $info = $emailClass->envioEmail(1,'',$Id_Solicitud,$motivo);

    echo json_encode($info);
    
  } else if ($accion == 2){
    
    
    echo json_encode('');
  }



  
//======================================================================================================================================
 }else{

  echo json_encode('Error, Contacte a sistemas');

}