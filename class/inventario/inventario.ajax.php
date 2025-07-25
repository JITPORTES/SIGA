<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/siga/class/inventario/inventario.class.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/siga/class/admin/utilerias/util.class.php";

if(isset($_POST['accion']) && 
$_POST['accion'] !=='') {

$accion = trim($_POST['accion']);

$inventarioClass = new inventario();
$utilClass       = new util();

  if($accion==1){
    $id_reporte = $_POST['id_reporte'];
      
    $info = $inventarioClass->inventarioCabeceras($Id_Area);   
    echo json_encode($info);
  
  } 

} else {
echo json_encode('error rutina Ajax');
}
