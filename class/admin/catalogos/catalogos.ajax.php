<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/admin/utilerias/util.class.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/admin/catalogos/catalogos.class.php");

if(isset($_POST['accion']) && 
$_POST['accion'] !=='') {

$accion     = trim($_POST['accion']);
$utilClass  = new util();

if($accion==1){


  
}

} else {
echo json_encode('error rutina Ajax');
}
