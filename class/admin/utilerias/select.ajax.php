<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/utilerias/select.class.php");

if(isset($_POST['accion']) && 
$_POST['accion'] !=='') {

$accion = trim($_POST['accion']);

if($accion == 'getEstatus'){
  


  echo json_encode($accion);

} else if ($accion == 'getEstatus'){
  


  
  echo json_encode($accion);

}






} else {
  echo json_encode('error rutina Ajax');
  }