<?php

include_once "reubicacion.class.php";
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/admin/utilerias/util.class.php");

if(isset($_POST['accion']) && 
$_POST['accion'] !=='') {
  
  $accion = trim($_POST['accion']);

  if($accion == 1){

    $reubicacionClass = new reubicacion();
    $utilClass        = new util();

    $Id_Usuario_Sesion          = trim($_POST['Id_Usuario_Sesion']);
    $Id_Activo                  = trim($_POST['Id_Activo']);
    $Id_Area                    = trim($_POST['Id_Area']);
    $Id_Ubic_Prim               = trim($_POST['Id_Ubic_Prim']);
    $Id_Ubic_Sec                = trim($_POST['Id_Ubic_Sec']);
    $Ubic_Especifica            = trim($_POST['Ubic_Especifica']);
    $Centro_Costos_assist       = trim($_POST['Centro_Costos_assist']);
    $cmbestatusreubicacionguar  = trim($_POST['cmbestatusreubicacionguar']);
    $Id_Usuario_Responsable     = trim($_POST['Id_Usuario_Responsable']);
		$No_Empleado_Solicitante     = trim($_POST['No_Empleado_Solicitante']);
    $Motivo_Reubicacion         = trim($_POST['Motivo_Reubicacion']);
    $Comentarios_Reubicacion    = trim($_POST['Comentarios_Reubicacion']);

    $resultado = $reubicacionClass->reUbicacionDeActivo($Id_Usuario_Sesion,$Id_Activo,$Id_Area,$Id_Ubic_Prim,$Id_Ubic_Sec,$Ubic_Especifica,$Centro_Costos_assist,$cmbestatusreubicacionguar,$Id_Usuario_Responsable,$Motivo_Reubicacion,$Comentarios_Reubicacion, $No_Empleado_Solicitante);

    print json_encode($resultado);
    
  } 
  
//======================================================================================================================================
 }else{

  echo json_encode('Error, Contacte a sistemas');

}