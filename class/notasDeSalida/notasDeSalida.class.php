<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/connect/conectar.class.php");
  include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/admin/utilerias/util.class.php");
class notasDeSalida extends conectar{

  function ok(){
    return 'ok';
  }

public  function getDatosActivoExterno($Id_Solicitud){
    $pdo = conectar::ConexionGestafSiga();

    $sql = "SELECT Empresa_Ext,
                  Nombre_Act_Ext,
                  Marca_Act_Ext,
                  Modelo_Act_Ext,
                  No_Serie_Act_Ext,
                  Cantidad_Equ_Ext,
                  Id_Ubic_Prim,
                  Id_Ubic_Sec
              FROM siga_solicitud_tickets
              WHERE Id_Solicitud=$Id_Solicitud";
    
    $sqlPrepare = $pdo->prepare($sql);
    $sqlPrepare->execute();
    $info = $sqlPrepare->fetch(PDO::FETCH_NAMED);
    $pdo=null;

    return $info;
  }

public function getUbicPrimaria($id_area){
  $pdo = conectar::ConexionGestafSiga();

  $sql = "SELECT Id_Ubic_Prim,Desc_Ubic_Prim
          FROM siga_cat_ubic_prim
          WHERE Id_Area=1
          AND Estatus_Reg IN (1,2)";
  
  $sqlPrepare = $pdo->prepare($sql);
  $sqlPrepare->execute();
  $info = $sqlPrepare->fetchAll(PDO::FETCH_NAMED);

  $pdo=null;
  return $info;
}

public function getUbicSecundaria($Id_Ubic_Prim){
  $pdo = conectar::ConexionGestafSiga();

  $sql = "SELECT  Id_Ubic_Sec,
                  Desc_Ubic_Sec
          FROM    siga_cat_ubic_sec
          WHERE   Id_Ubic_Prim=$Id_Ubic_Prim";

  $sqlPrepare = $pdo->prepare($sql);
  $sqlPrepare->execute();
  $info = $sqlPrepare->fetchAll(PDO::FETCH_NAMED);

  $pdo=null;
  return $info;
}

public function getAccesoriosNotaSalida($Id_Solicitud){
  $pdo = conectar::ConexionGestafSiga();

  $sql = "SELECT  Id_Accesorio_Ext,
                  Nombre_Ext,
                  Cantidad_Ext,
                  Marca_Ext,
                  Modelo_Ext,
                  No_Serie_Ext
        FROM  siga_det_accesorios_act_ext
        WHERE Id_Solicitud_Ext=$Id_Solicitud";

  $sqlPrepare = $pdo->prepare($sql);
  $sqlPrepare->execute();
  $info = $sqlPrepare->fetchAll(PDO::FETCH_NAMED);

    $pdo=null;
  return $info;
}

public function setEditarDatosActualizar($ns_id_solicitud, $ns_proveedor, $ns_activo_nombre, $ns_modelo, $ns_marca, $ns_no_serie, $ns_cantidad, $ns_uPrimaria, $ns_uSecundaria){
  $pdo = conectar::ConexionGestafSiga();
  $utilClass = new util();
  
  $sql = "UPDATE siga_solicitud_tickets 
          SET Empresa_Ext='$ns_proveedor', Nombre_Act_Ext='$ns_activo_nombre', Marca_Act_Ext='$ns_marca', Modelo_Act_Ext='$ns_modelo', No_Serie_Act_Ext='$ns_no_serie', Cantidad_Equ_Ext=$ns_cantidad, Id_Ubic_Prim=$ns_uPrimaria, Id_Ubic_Sec=$ns_uSecundaria 
          WHERE Id_Solicitud=$ns_id_solicitud";

  $sqlPrepare = $pdo->prepare($sql);   

    try {
      $pdo->beginTransaction();
        $sqlPrepare->execute();
      $pdo->commit();
      $resultado=true;
    } catch (PDOException $e) {
      $pdo->rollBack();
      $resultado=false;
        $error='Rutinas: '.$e->getMessage();
        $utilClass->fnlog($error);
    }

    $pdo=null;
  return $resultado;
}

public function getNotasDeSalidasCanceladas(){
  $pdo = conectar::ConexionGestafSiga();

  $sql = "SELECT  Id_Solicitud,
                  Desc_Motivio_Cancelacion, 
                  siga_usuarios.Nombre_Usuario,
                  convert(varchar, NS.Fech_Inser, 111) Fech_Inser
          FROM    siga_cancelacion_nota_salida ns
          LEFT JOIN siga_usuarios ON ns.Usr_Inser = siga_usuarios.Id_Usuario
          WHERE   ns.Estatus_Reg IN (1,2)";

  $sqlPrepare = $pdo->prepare($sql);
  $sqlPrepare->execute();
  $info = $sqlPrepare->fetchAll(PDO::FETCH_NAMED);

    $pdo=null;
  return $info;
}

}
