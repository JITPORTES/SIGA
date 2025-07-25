<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/connect/conectar.class.php");
class select extends conectar{

  function ok(){
    return 'ok';
  }

  function getEstatus($Id_Area){

    $pdo = conectar::ConexionGestafSiga();

    $sql = "SELECT Id_Estatus, Desc_Estatus FROM siga_cat_estatus WHERE Estatus_Reg IN (1,2) AND Id_Area=$Id_Area";
    $sqlPrepare = $pdo->prepare($sql);
    $sqlPrepare->execute();
    $sqlResult = $sqlPrepare->fetchAll(PDO::FETCH_NAMED);

    $pdo=null;
    return $sqlResult;
  }

  function nombreAleatorio(){

    $caracteres_permitidos = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $longitud = 17;
    $ramdom = substr(str_shuffle($caracteres_permitidos), 0, $longitud);

    return $ramdom;
  }


}