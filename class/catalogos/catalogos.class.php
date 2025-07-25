<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/connect/conectar.class.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/admin/utilerias/util.class.php");
class catalogos extends conectar {

  function getSigaMenu(){
    
    $pdoConexionGestafSiga = conectar::ConexionGestafSiga();

    $sqlSigaCatMenu ="SELECT siga_menu_id, siga_menu_desc FROM siga_usuarios_menu (NOLOCK) WHERE siga_menu_estatus in (1,2) ORDER BY siga_menu_desc ASC";
    
    $sqlSigaCatMenu = $pdoConexionGestafSiga->query($sqlSigaCatMenu);
    $SigaCatMenu    = $sqlSigaCatMenu->fetchAll(PDO::FETCH_NUM);

    return $SigaCatMenu;
  }

function getSigaPermisos(){
  $pdoConexionGestafSiga = conectar::ConexionGestafSiga();
  $sqlSigaCat ="SELECT siga_id_permiso,siga_permiso_desc FROM siga_usuarios_permisos (NOLOCK) WHERE siga_permiso_estatus IN (1,2) ORDER BY siga_menu_id";
    
  $SigaCat = $pdoConexionGestafSiga->query($sqlSigaCat);
  $SigaCat = $SigaCat->fetchAll(PDO::FETCH_NAMED);

  return $SigaCat;
}

function getSigaEmail($Id_Usuario){
  $pdoConexionGestafSiga = conectar::ConexionGestafSiga();
  
  $sqlGetSigaEmail="SELECT Nombre_Usuario, Correo FROM siga_usuarios (NOLOCK) WHERE Id_Usuario=$Id_Usuario";
  $GetSigaEmail = $pdoConexionGestafSiga->query($sqlGetSigaEmail);
  $SigaEmail    = $GetSigaEmail->fetch(PDO::FETCH_NUM);

return $SigaEmail;
}

function getSigaCatAgnios(){
  $pdoConexionGestafSiga = conectar::ConexionGestafSiga();
  $sqlgetSigaCatAgnios ="SELECT   Id_Anios,Desc_Anios
                        FROM      siga_cat_anios (NOLOCK)
                        WHERE     Estatus_Reg in (1,2)
                        ORDER BY  Desc_Anios DESC";
  
  $getSigaCatAgnios  = $pdoConexionGestafSiga->query($sqlgetSigaCatAgnios);
  $getSigaCatAgnios = $getSigaCatAgnios->fetchAll(PDO::FETCH_NAMED);
  $pdoConexionGestafSiga=null;

  return $getSigaCatAgnios;
  }

  function getSigaUsuariosVigentes(){
    $pdoConexionGestafSiga = conectar::ConexionGestafSiga();
    
    $sqlgetSigaUsuariosVigentes = "SELECT Id_Usuario,No_Usuario,Nombre_Usuario
                                  FROM    siga_usuarios (NOLOCK)
                                  WHERE   Estatus_Reg in (1,2)
                                  -- AND No_Usuario <> ''
                                  -- AND Correo <> ''
                                  -- AND Correo <> '0'
                                  -- AND Correo <> '@hospitalsatelite.com'
                                  -- AND Id_Usuario NOT IN (3847,143)
                                  AND Password not like 'baja%' 
                                  ORDER BY Nombre_Usuario ASC";                                  
    
    $getSigaUsuariosVigentes = $pdoConexionGestafSiga->prepare($sqlgetSigaUsuariosVigentes);
    $getSigaUsuariosVigentes->execute();
    $getSigaUsuariosVigentesInfo = $getSigaUsuariosVigentes->fetchAll(PDO::FETCH_NAMED);    
  
  return $getSigaUsuariosVigentesInfo;

  }


  function getSigaUsuariosVigentesConCorreo(){
    $pdoConexionGestafSiga = conectar::ConexionGestafSiga();
    
    $sqlgetSigaUsuariosVigentes = "SELECT Id_Usuario,No_Usuario,Nombre_Usuario,Correo
                                  FROM    siga_usuarios (NOLOCK)
                                  WHERE   Estatus_Reg in (1,2)
                                  AND No_Usuario <> ''
                                  AND Correo <> ''
                                  AND Correo <> '0'
                                  AND Correo <> '@hospitalsatelite.com'
                                  AND Id_Usuario NOT IN (3847,143)
                                  AND Password not like 'baja%' 
                                  ORDER BY Nombre_Usuario ASC";                                  
    
    $getSigaUsuariosVigentes = $pdoConexionGestafSiga->prepare($sqlgetSigaUsuariosVigentes);
    $getSigaUsuariosVigentes->execute();
    $getSigaUsuariosVigentesInfo = $getSigaUsuariosVigentes->fetchAll(PDO::FETCH_NAMED);    
  
  return $getSigaUsuariosVigentesInfo;
  }

  function getFrecuencia(){
    
    $pdoConexionGestafSiga = conectar::ConexionGestafSiga();

    $sql = "SELECT  Id_Frecuencia,      
                    Desc_Frecuencia,      
                    Periodo,
                    Total
            FROM  siga_cat_frecuencia (NOLOCK)
            WHERE Estatus_Reg in (1,2)";                                  
    
    $getSql = $pdoConexionGestafSiga->prepare($sql);
    $getSql->execute();
    $getSqlInfo = $getSql->fetchAll(PDO::FETCH_NAMED);    
  
  return $getSqlInfo;

  }

  //========================================================================================================================================================================================================
  //========================================================================================================================================================================================================

  function getCentroDeCostos(){
    
    $pdo = conectar::ConexionGestafSiga();

    $sql = "SELECT  Id_Centros_de_costos,      
                    Desc_Centro_de_costos,      
                    Clave,
                    Nomenclatura
            FROM  siga_cat_centro_de_costos (NOLOCK)
            WHERE Estatus_Reg in (1,2)";                                  
    
    $getSql = $pdo->prepare($sql);
    $getSql->execute();
    $getSqlInfo = $getSql->fetchAll(PDO::FETCH_NAMED);    
  
  $pdo=null;

    return $getSqlInfo;
  }

//========================================================================================================================================================================================================
//========================================================================================================================================================================================================

function getGestorPorArea($Id_Area){
$pdo = conectar::ConexionGestafSiga();
  $sql = "SELECT distinct(Id_Usuario) idUsuario, Nombre_Empleado 
          FROM siga_cat_gestores (NOLOCK)
          WHERE Id_Area = 1
          AND Estatus_Reg IN (1,2)          
          AND id_Usuario NOT IN (2507)";
          
  $sqlPrepare = $pdo->prepare($sql);  
  $sqlPrepare->execute();
  $info = $sqlPrepare->fetchAll(PDO::FETCH_NAMED);
  
  $pdo=null;

  return $info;
}

//========================================================================================================================================================================================================
//========================================================================================================================================================================================================

function getRutinasPorArea($Id_Area){
$pdo = conectar::ConexionGestafSiga();
  $sql = "SELECT  siga_cat_rutinas_id, siga_cat_rutinas_titulo
          FROM    siga_cat_rutinas (NOLOCK)
          WHERE   siga_cat_area=$Id_Area
          AND     siga_cat_rutinas_estatus IN (1,2)";
          
  $sqlPrepare = $pdo->prepare($sql);  
  $sqlPrepare->execute();
  $info = $sqlPrepare->fetchAll(PDO::FETCH_NAMED);
  
  $pdo=null;

  return $info;
}

//========================================================================================================================================================================================================
//========================================================================================================================================================================================================

function getRutinaDetalle($Id_rutina){
  $pdo = conectar::ConexionGestafSiga();

    $sql = "SELECT  siga_cat_rutinas_act_desc, 
                    siga_cat_rutinas_act_valor_ref,
              CASE WHEN siga_cat_rutinas_act_valor_medio = 1 THEN 'Obligatorio' ELSE '' END valor,
              CASE WHEN siga_cat_rutinas_act_adjunto = 1 THEN 'Obligatorio' ELSE '' END adjunto,
              siga_cat_sort
            FROM  siga_cat_rutinas_act (NOLOCK)
            WHERE siga_cat_rutinas_id = $Id_rutina
            ORDER BY siga_cat_sort ASC";
            
    $sqlPrepare = $pdo->prepare($sql);  
    $sqlPrepare->execute();
    $info = $sqlPrepare->fetchAll(PDO::FETCH_NAMED);
    
      $pdo=null;

  return $info;
}

//========================================================================================================================================================================================================
//========================================================================================================================================================================================================
function getClasificacion($idClase){
  $pdo = conectar::ConexionGestafSiga();

    $sql = "SELECT Id_Clasificacion, Desc_Clasificacion
            FROM siga_cat_clasificacion (NOLOCK)
            WHERE Id_Clase = $idClase
            AND Estatus_Reg IN (1,2)";
            
    $sqlPrepare = $pdo->prepare($sql);  
    $sqlPrepare->execute();
    $info = $sqlPrepare->fetchAll(PDO::FETCH_NAMED);
    
      $pdo=null;

  return $info;
}

//========================================================================================================================================================================================================
//========================================================================================================================================================================================================

function getSubFamilia($idFamilia){
  $pdo = conectar::ConexionGestafSiga();

    $sql = "SELECT Id_Subfamilia, Desc_Subfamilia
            FROM siga_cat_subfamilia (NOLOCK)
            WHERE Id_Familia = $idFamilia
            AND Estatus_Reg IN (1,2)";
            
    $sqlPrepare = $pdo->prepare($sql);  
    $sqlPrepare->execute();
    $info = $sqlPrepare->fetchAll(PDO::FETCH_NAMED);
    
      $pdo=null;

  return $info;
}

//========================================================================================================================================================================================================
//========================================================================================================================================================================================================

function getUbiPrimaria($Id_Area){
  $pdo = conectar::ConexionGestafSiga();

    $sql = "SELECT Id_Ubic_Prim, Desc_Ubic_Prim
            FROM siga_cat_ubic_prim (NOLOCK)
            WHERE Estatus_Reg IN (1,2)
            AND Id_Area = $Id_Area";
            
    $sqlPrepare = $pdo->prepare($sql);  
    $sqlPrepare->execute();
    $info = $sqlPrepare->fetchAll(PDO::FETCH_NAMED);
    
      $pdo=null;

  return $info;
}

//========================================================================================================================================================================================================
//========================================================================================================================================================================================================

function getUbiSecundaria($Id_Ubic_Prim){
  $pdo = conectar::ConexionGestafSiga();

    $sql = "SELECT  Id_Ubic_Sec,
                    Desc_Ubic_Sec      
            FROM    siga_cat_ubic_sec (NOLOCK)
            WHERE   Id_Ubic_Prim=$Id_Ubic_Prim
            AND     Estatus_Reg in (1,2)";
            
    $sqlPrepare = $pdo->prepare($sql);  
    $sqlPrepare->execute();
    $info = $sqlPrepare->fetchAll(PDO::FETCH_NAMED);
    
      $pdo=null;

  return $info;
}

//========================================================================================================================================================================================================
//========================================================================================================================================================================================================

function getActivos($Id_Area){
  $pdo = conectar::ConexionGestafSiga();

    $sql = "SELECT id_activo, AF_BC, Nombre_Activo
            FROM siga_activos (NOLOCK)
            WHERE Id_Area = $Id_Area 
            AND Id_Activo NOT IN (SELECT Id_Activo FROM siga_baja_activo) 
            AND estatus_Reg in (1,2)";
            
    $sqlPrepare = $pdo->prepare($sql);  
    $sqlPrepare->execute();
    $info = $sqlPrepare->fetchAll(PDO::FETCH_NAMED);
    
      $pdo=null;

  return $info;
}

//========================================================================================================================================================================================================
//========================================================================================================================================================================================================

function getAnioActividades($Id_Area){
  $pdo = conectar::ConexionGestafSiga();

    $sql = "SELECT DISTINCT(year(Fecha_Programada)) agnio
            FROM  siga_actividades
            WHERE Fecha_Programada <> ''
            AND   Fecha_Programada is not null
            AND   Id_Area = $Id_Area
            ORDER BY agnio DESC";
            
    $sqlPrepare = $pdo->prepare($sql);  
    $sqlPrepare->execute();
    $info = $sqlPrepare->fetchAll(PDO::FETCH_COLUMN);
    
      $pdo=null;

  return $info;
}

//========================================================================================================================================================================================================
//========================================================================================================================================================================================================

function getMes(){
  $pdo = conectar::ConexionGestafSiga();

    $sql = "SELECT Id_Meses, Desc_Meses FROM siga_cat_meses";
            
    $sqlPrepare = $pdo->prepare($sql);  
    $sqlPrepare->execute();
    $info = $sqlPrepare->fetchAll(PDO::FETCH_NAMED);
    
      $pdo=null;

  return $info;
}

//========================================================================================================================================================================================================
//========================================================================================================================================================================================================

}