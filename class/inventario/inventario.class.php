<?php
  include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/connect/conectar.class.php");
  include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/admin/utilerias/util.class.php");

class inventario extends conectar{

//==================================================================================================================================================================================================================
//==================================================================================================================================================================================================================
function inventarioDefault($Id_Area){
  $pdo = conectar::ConexionGestafSiga();

  $sql = "SELECT  siga_activos.Id_Activo,
                  
                  siga_activos.Foto, 
                  siga_activos.AF_BC, 
                  siga_activos.DescLarga, 
                  siga_activos.Marca, 
                  siga_activos.Modelo, 
                  siga_activos.NumSerie,        
                  (SELECT Desc_Ubic_Prim FROM siga_cat_ubic_prim WHERE Id_Ubic_Prim= siga_activos.Id_Ubic_Prim) uPrimaria,
                  (SELECT Desc_Ubic_Sec FROM siga_cat_ubic_sec WHERE Id_Ubic_Sec = siga_activos.Id_Ubic_Sec) uSecundaria,
                  (SELECT Desc_Clase FROM siga_cat_clase WHERE Id_Clase = siga_activos.Id_Clase) clase,
                  siga_activos.Nombre_Completo,
                  FORMAT(CAST(siga_activos.Fech_Inser as date),'yyyy-MM-dd') fchAlta,
                  siga_activos.Especifica,
                  siga_activos.ImporteSeguros,
                  (SELECT Desc_Est_Equipo FROM siga_cat_estatus_equipo WHERE Id_Est_Equipo = siga_activos.Id_Situacion_Activo) estatusEquipo,
                  siga_activos.fch_reubicacion
          FROM siga_activos
          LEFT JOIN siga_baja_activo ON siga_activos.Id_Activo = siga_baja_activo.Id_Activo
          LEFT JOIN siga_activo_proveedor ON siga_activos.Id_Activo = siga_activo_proveedor.id_Activo
          LEFT JOIN siga_activos_contabilidad ON siga_activos.Id_Activo = siga_activos_contabilidad.Id_Activo
          WHERE siga_activos.Id_Area = $Id_Area
          AND   siga_activos.Id_Activo not in (SELECT Id_Activo FROM siga_baja_activo WHERE Estatus_Cancelacion in (0))
          AND   siga_activos.Estatus_Reg IN (1,2)";

    $sqlResult = $pdo->prepare($sql);
    $sqlResult->execute();
    $datos = $sqlResult->fetchAll(PDO::FETCH_NAMED);

  $pdo = null;

  return $datos;
}

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function inventarioCabeceras($id_reporte){
  $pdo = conectar::ConexionGestafSiga();

  $sql = "SELECT columnas.cabeceraDeTabla cabecera
          FROM siga_inventario_columnas_titulos titulo
          LEFT JOIN siga_inventario_columnas columnas ON titulo.Id_Columna=columnas.Id_Columna
          WHERE titulo.Id_Reporte_Version=$id_reporte
          order by titulo.Orden";

    $sqlResult = $pdo->prepare($sql);
    $sqlResult->execute();
    $datos = $sqlResult->fetchAll(PDO::FETCH_NAMED);

  $pdo = null;

  return $datos;
}

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function inventarioData($id_reporte){
  $pdo = conectar::ConexionGestafSiga();

  $sql = "SELECT AF_BC,Nombre_Activo,Marca,Modelo,DescCorta,DescLarga,Foto,Garantia,ExtGarantia,Id_Activo,Especifica
          FROM siga_activos
          WHERE Estatus_reg in (1,2)
          AND Id_Area=1
          AND Id_Activo not in (SELECT Id_Activo FROM siga_baja_activo WHERE Estatus_Cancelacion in (0))";

    $sqlResult = $pdo->prepare($sql);
    $sqlResult->execute();
    $datos = $sqlResult->fetchAll(PDO::FETCH_NAMED);

  $pdo = null;

  return $datos;
}

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


}