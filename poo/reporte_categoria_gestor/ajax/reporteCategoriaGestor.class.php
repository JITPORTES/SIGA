<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/connect/conectar.class.php");
class reporteCategoriaGestor extends conectar{

  function ok(){
    return 'ok';
  }

  function activosBajoResguardoPorUsuario($id_empleado, $numEmpleado, $id_area){
    $pdo = conectar::ConexionGestafSiga();

    $sql = "SELECT COUNT(Id_Activo) activos 
            FROM siga_activos 
            WHERE Num_Empleado=$numEmpleado 
            AND Estatus_Reg in (1,2) ";
    
    $sqlPrepare = $pdo->prepare($sql);
    $sqlPrepare->execute();
    $sqlResult = $sqlPrepare->fetchAll(PDO::FETCH_NAMED);
    $pdo=null;

    return $sqlResult;
  }


}
