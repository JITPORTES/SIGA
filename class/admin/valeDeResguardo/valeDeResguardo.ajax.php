<?php

include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/admin/valeDeResguardo/valeDeResguardo.class.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/admin/utilerias/util.class.php");

$vdrClass   = new valeDeResguardo();
$utilClass  = new util();

if(isset($_POST['accion']) && 
$_POST['accion'] !=='') {

$accion = trim($_POST['accion']);


if($accion==1){

  $idareasesion   = trim($_POST['idareasesion']);
  $Usr_Inser      = trim($_POST['Usr_Inser']);
  $valeMasivoTipo = trim($_POST['valeMasivoTipo']);

  $info = $vdrClass->generarValeMasivo('ok');

  echo json_encode('/'.$idareasesion.'/'.$Usr_Inser.'/'.$valeMasivoTipo);

} else if ($accion==2){

  $valePDF              = $_FILES['valePDF'];
  $vrdNumEmpleado       = $_POST['vrdNumEmpleado'];
  $vrdNumEmpleadoBaja   = $_POST['vrdNumEmpleadoBaja'];
  $valePDFNombre        = $_FILES['valePDF']['name'];
  $extension            = pathinfo($valePDFNombre, PATHINFO_EXTENSION);
  $vrdId_Vale_Resguardo = $_POST['vrdId_Vale_Resguardo'];
  $Usr_Inser            = $_POST['Usr_Inser'];
  //$fecha              = date("d-m-Y--H.m.s");
  $vrdArea            = 'TIC';

  $ruta               = dirname(__FILE__, 5).'\SIGA\\Archivos\\Archivos-VRD';
  $rutahistorial      = dirname(__FILE__, 5).'\SIGA\\Archivos\\Archivos-VRD\\historial';
  $nombreAleatorio    = $utilClass->nombreAleatorio();


  if($vrdNumEmpleadoBaja == "true"){
        $tipo_de_vale = 1;
  }else{
        $tipo_de_vale = 0;      
  }
  $archivoVRD           = $ruta.'\\'.$vrdNumEmpleado.'.'.$extension;
  $archivoVRDHistorico  = $rutahistorial.'\\'.$vrdNumEmpleado.'-'.$nombreAleatorio.'.'.$extension;
  $pdf                  = $vrdNumEmpleado.'-'.$nombreAleatorio.'.'.$extension;
unlink($archivoVRD);

if(move_uploaded_file($_FILES['valePDF']['tmp_name'], $archivoVRD)){

  $info   = $vdrClass->subirEdc($vrdArea, $vrdNumEmpleado, $vrdId_Vale_Resguardo, 1);
  $vdrClass->edcInsertHistorico($vrdNumEmpleado, $tipo_de_vale, $pdf, $Usr_Inser);

  if(!copy($archivoVRD,$archivoVRDHistorico)){
    echo "failed to copy $archivoVRDHistorico";
  } else {
    echo "copied $archivoVRD into $archivoVRDHistorico\n";
  }
  
  $resultado = true;
} else {
  $resultado = false;
}
  
  echo json_encode('');
}

} else {
  echo json_encode('error ValeDeResguardo.ajax.php');
  }