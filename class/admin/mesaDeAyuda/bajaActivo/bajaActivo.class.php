<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/connect/conectar.class.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/admin/utilerias/util.class.php");

//================================================================================================================================================================================
class bajaActivo extends conectar{
//================================================================================================================================================================================

  function ok(){
    return 'ok';
  }

  function updatedSituacionActivo($Id_Activo){
    $pdo = conectar::ConexionGestafSiga();
    $utilClass = new util();

    $sql = "UPDATE siga_activos SET Id_Situacion_Activo=12 WHERE Id_Activo=$Id_Activo";
    $sqlPrepare = $pdo->prepare($sql);
    
    try {
      $sqlPrepare->execute();
    } catch (PDOException $e) {
      $error='bajaActivo.class.php: '.$e->getMessage();
      $utilClass->fnlog($error);
    }
    
    return '';
  }

}