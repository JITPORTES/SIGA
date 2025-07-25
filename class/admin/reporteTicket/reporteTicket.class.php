<?php
  include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/connect/conectar.class.php");
  include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/admin/utilerias/util.class.php");

class reporteTicket extends conectar{


public function getPrueba(){

return 'Prueba OK';
}

//====================================================================================================================================================================================================================
//====================================================================================================================================================================================================================

public function getActividadesTicketLectura($id_solicitud){
  $pdo = conectar::ConexionGestafSiga(); 

  $sql = "SELECT  Nombre_Actividad, Valor_Referencia, Valor_Medido, Estatus_Actividad, Observaciones, Url_Adjunto, Fecha_Realizada, Num_Actividad
          FROM    siga_det_actividades 
          WHERE   Id_Actividad = (SELECT Id_Actividad FROM siga_solicitud_tickets WHERE Id_Solicitud=$id_solicitud)
          AND   Fecha_Programada= (SELECT convert(varchar, Fech_Solicitud, 112) FROM siga_solicitud_tickets WHERE Id_Solicitud=$id_solicitud)
          ORDER BY Num_Actividad
          ";

  $sqlPrepare = $pdo->prepare($sql);
  $sqlPrepare->execute();
  $info = $sqlPrepare->fetchAll(PDO::FETCH_NAMED);
 
  $pdo = null;
  return $info;
}

//====================================================================================================================================================================================================================
//====================================================================================================================================================================================================================

public function getActividadesDetalleImg($id_solicitud){

  $pdo = conectar::ConexionGestafSiga(); 

  $sql = "SELECT  Url_Adjunto
          FROM    siga_det_actividades 
          WHERE   Id_Actividad = (SELECT Id_Actividad FROM siga_solicitud_tickets WHERE Id_Solicitud=$id_solicitud)
          AND     Url_Adjunto <> ''
          AND     Url_Adjunto LIKE '%.JPEG'
              UNION ALL
          SELECT  Url_Adjunto
          FROM    siga_det_actividades 
          WHERE   Id_Actividad = (SELECT Id_Actividad FROM siga_solicitud_tickets WHERE Id_Solicitud=$id_solicitud)
          AND     Url_Adjunto LIKE '%.JPG'       
          ";

  $sqlPrepare = $pdo->prepare($sql);
  $sqlPrepare->execute();
  $info = $sqlPrepare->fetchAll(PDO::FETCH_COLUMN);
 
  $pdo = null;
  return $info;
}

//====================================================================================================================================================================================================================
//====================================================================================================================================================================================================================

public function getMaterialesTicketLectura($id_solicitud){
  $pdo = conectar::ConexionGestafSiga(); 

  $sql = "SELECT sku_material,
          descripcion_material,
          CASE
            WHEN origen_alm_ext = 1 THEN 'Interno'
            WHEN origen_alm_ext = 2THEN 'Externo'    
            ELSE 'Sin Origen'
          END Origen,          
          folio_almacen_material,
          clase_material,
          unidad_material,
          isnull(numDeParte,'') numDeParte,
          isnull(referencia,'') referencia,     
          costo_material,
          cantidad_material,
          (costo_material*cantidad_material) total
      FROM siga_actividades_materiales
      WHERE Estatus_Reg IN (1,2)
      AND id_solicitud = $id_solicitud";

  $sqlPrepare = $pdo->prepare($sql);
  $sqlPrepare->execute();
  $info = $sqlPrepare->fetchAll(PDO::FETCH_NAMED);

  $pdo = null;
  return $info;
}  

//=========================================================================================================================================================================================
//=========================================================================================================================================================================================
public function getChatAdjuntos($id_solicitud,$tipo){
  $pdo = conectar::ConexionGestafSiga(); 

  $sql = "SELECT adjuntos.Url_Adjunto AS archivo
          FROM siga_ticket_chat chat
          LEFT JOIN siga_cat_ticket_adjuntos adjuntos ON adjuntos.Id_Chat = chat.Id_Chat
          WHERE chat.Id_Solicitud = $id_solicitud
          AND Url_Adjunto LIKE '%.pdf'";

  $sqlPrepare = $pdo->prepare($sql);
  $sqlPrepare->execute();
  $info = $sqlPrepare->fetchAll(PDO::FETCH_COLUMN);

$extArchivos    = array("pdf","xls","xlsx","doc","docx","ppt","pptx");
$extImagenes    = array("jpg", "jpeg", "png", "bmp", "heic", "HEIC");
$arrayArchivos  = array();


if($tipo == 1){
  foreach($info as $item){
    $extension = pathinfo($item['archivo'], PATHINFO_EXTENSION);
      if(in_array($extension,$extArchivos)){
        $arrayArchivos += ['archivo' => $item['archivo']];
      }
  }
}
// } else if($tipo == 2){
//   unset($arrayArchivos);
//   foreach($info as $item){
//     $extension = pathinfo($item['Url_Adjunto'], PATHINFO_EXTENSION);
//       if(in_array($extension,$extImagenes)){
//         $arrayArchivos = array($item['Url_Adjunto']);      
//       }
//   }
// }




  $pdo = null;

  return $info;
}  

//=========================================================================================================================================================================================
//=========================================================================================================================================================================================

public function getAdjuntosSolicitudFil($id_solicitud){
  $pdo = conectar::ConexionGestafSiga(); 
  $utilClass = new util();

  $sql = "SELECT Url_archivo 
          FROM siga_solicitud_tickets tk          
          WHERE tk.Id_Solicitud = $id_solicitud";

  $sqlPrepare = $pdo->prepare($sql);
  $sqlPrepare->execute();
  $info = $sqlPrepare->fetchColumn();

$archivos = explode('---', $info);

$archivosPorExtension = [];
$extensionJpg = 'jpg';
$extensionPNG = 'png';

foreach ($archivos as $archivo) {
    $extension = pathinfo($archivo, PATHINFO_EXTENSION);
    if ($extension === $extensionJpg) {
        $archivosPorExtension[] = $archivo;
    }
}

foreach ($archivos as $archivo) {
    $extension = pathinfo($archivo, PATHINFO_EXTENSION);
    if ($extension === $extensionPNG) {
        $archivosPorExtension[] = $archivo;
    }
}

  $pdo = null;

  return $archivosPorExtension;
}  

//=========================================================================================================================================================================================
//=========================================================================================================================================================================================

public function getAdjuntosSolicitudImgNuevo($id_solicitud){
  $pdo = conectar::ConexionGestafSiga(); 
  $utilClass = new util();

  $sql = "SELECT Url_archivo 
          FROM siga_solicitud_tickets tk          
          WHERE tk.Id_Solicitud = $id_solicitud";

  $sqlPrepare = $pdo->prepare($sql);
  $sqlPrepare->execute();
  $info = $sqlPrepare->fetchColumn();

$archivos = explode('---', $info);

$extImagenes    = array("jpg","jpeg","png","bmp","heic","HEIC","JPG",);
$archivosPorExtension = [];
$extensionPdf = 'pdf';
$extensionXls = 'xls';

foreach ($archivos as $archivo) {
    $extension = pathinfo($archivo, PATHINFO_EXTENSION);
    if ($extension === $extensionPdf) {
        $archivosPorExtension[] = $archivo;
    }
}

foreach ($archivos as $archivo) {
    $extension = pathinfo($archivo, PATHINFO_EXTENSION);
    if ($extension === $extensionXls) {
        $archivosPorExtension[] = $archivo;
    }
}

  $pdo = null;

  return $archivosPorExtension;
}  


}