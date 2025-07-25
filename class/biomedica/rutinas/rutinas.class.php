<?php
  include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/connect/conectar.class.php");
  include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/admin/utilerias/util.class.php");

class rutinas extends conectar{

  function sigaRutinasTitulo($siga_rutinas_descripcion,$Id_Usuario,$Id_Area){
    $pdoConexionGestafSiga = conectar::ConexionGestafSiga();
    $utilClass = new util();

    $sqlSigaRutinas = "INSERT INTO siga_cat_rutinas(siga_cat_rutinas_titulo, siga_cat_rutinas_usr_insert,siga_cat_rutinas_fch_insert,siga_cat_rutinas_estatus,siga_cat_area) VALUES(:siga_rutinas_descripcion,$Id_Usuario,getdate(),1,:siga_cat_area)";
    $SigaRutinas    = $pdoConexionGestafSiga->prepare($sqlSigaRutinas);
    $SigaRutinas->bindParam(":siga_rutinas_descripcion",	$siga_rutinas_descripcion, PDO::PARAM_STR);
    $SigaRutinas->bindParam(":siga_cat_area",		          $Id_Area, PDO::PARAM_INT);

    try {
      $pdoConexionGestafSiga->beginTransaction();
        $SigaRutinas->execute();
        $siga_cat_rutinas_id = $pdoConexionGestafSiga->lastInsertId();
      $pdoConexionGestafSiga->commit();
    } catch (PDOException $e) {
      $pdoConexionGestafSiga->rollBack();
        $error='Rutinas: '.$e->getMessage();
        $utilClass->fnlog($error);
    }

      $pdoConexionGestafSiga=null;
    return $siga_cat_rutinas_id;
  }

  
  function sigaRutinasActividad($idRutina,$orden,$siga_rutina_actividad,$siga_rutina_valor_referenciado,$siga_rutina_valor_medio,$siga_rutina_adjunto,$Id_Usuario){
    $pdoConexionGestafSiga = conectar::ConexionGestafSiga();
    $utilClass = new util();

    $sqlSigaRutinasAct = "INSERT INTO siga_cat_rutinas_act(siga_cat_rutinas_id, siga_cat_sort, siga_cat_rutinas_act_desc, siga_cat_rutinas_act_valor_ref,siga_cat_rutinas_act_valor_medio, siga_cat_rutinas_act_adjunto, siga_cat_rutinas_act_usr_insert, siga_cat_rutinas_act_fch_insert, siga_cat_rutinas_act_estatus) 
                          VALUES($idRutina,:orden,:siga_rutina_actividad,:siga_rutina_valor_referenciado,:siga_rutina_valor_medio,:siga_rutina_adjunto,:Id_Usuario,getdate(),1)";
    $SigaRutinasAct    = $pdoConexionGestafSiga->prepare($sqlSigaRutinasAct);
    $SigaRutinasAct->bindParam(":siga_rutina_actividad",	        $siga_rutina_actividad,         PDO::PARAM_STR);
    $SigaRutinasAct->bindParam(":orden",		                      $orden,                         PDO::PARAM_INT);
    $SigaRutinasAct->bindParam(":siga_rutina_valor_referenciado",	$siga_rutina_valor_referenciado,PDO::PARAM_STR);
    $SigaRutinasAct->bindParam(":siga_rutina_valor_medio",		    $siga_rutina_valor_medio,       PDO::PARAM_INT);
    $SigaRutinasAct->bindParam(":siga_rutina_adjunto",		        $siga_rutina_adjunto,           PDO::PARAM_INT);
    $SigaRutinasAct->bindParam(":Id_Usuario",		                  $Id_Usuario,                    PDO::PARAM_INT);

    try {
      $pdoConexionGestafSiga->beginTransaction();
        $SigaRutinasAct->execute();
        $siga_cat_rutinas_id = $pdoConexionGestafSiga->lastInsertId();
      $pdoConexionGestafSiga->commit();
    } catch (PDOException $e) {
      $pdoConexionGestafSiga->rollBack();
        $error='Rutinas Actividades: '.$e->getMessage();
        $utilClass->fnlog($error);
    }
      
    $pdoConexionGestafSiga=null;

    return $siga_cat_rutinas_id;
  }

  function sigaRutinasActividadUpdateArchivo($siga_cat_rutinas_act_id, $nombreArchivo){
    $pdo = conectar::ConexionGestafSiga();
    $utilClass = new util();

    $sql = "UPDATE siga_cat_rutinas_act SET siga_cat_rutinas_act_archivo='$nombreArchivo' WHERE siga_cat_rutinas_act_id = $siga_cat_rutinas_act_id";
    $resultado    = $pdo->prepare($sql);
    $resultado->bindParam(":nombreArchivo",	        $nombreArchivo, PDO::PARAM_STR);
    $utilClass->fnlog($sql);
    try {
      $pdo->beginTransaction();
      //   $resultado->execute();
      // $pdo->commit();
    } catch (PDOException $e) {
      $pdo->rollBack();
        $error='Rutinas Actividades: '.$e->getMessage();
        $utilClass->fnlog($error);
    }      
      $pdo=null;
    return true;
  }

  function sigaRutinasBaja($siga_rutina_titulo_id,$Id_Usuario){
    $pdoConexionGestafSiga = conectar::ConexionGestafSiga();
    $utilClass = new util();

    $sqlSigaRutina = "UPDATE siga_cat_rutinas SET siga_cat_rutinas_estatus=3, siga_cat_rutinas_usr_update=$Id_Usuario,siga_cat_rutinas_fch_update=getdate() WHERE siga_cat_rutinas_id=$siga_rutina_titulo_id";
    $SigaRutina    = $pdoConexionGestafSiga->prepare($sqlSigaRutina);

    $sqlSigaRutinaDet = "UPDATE siga_cat_rutinas_act SET siga_cat_rutinas_act_estatus=3 WHERE siga_cat_rutinas_id = $siga_rutina_titulo_id";
    $SigaRutinaDet = $pdoConexionGestafSiga->prepare($sqlSigaRutinaDet);

    try {
      $pdoConexionGestafSiga->beginTransaction();
        $SigaRutina->execute();
        $SigaRutinaDet->execute();
      $pdoConexionGestafSiga->commit();
      $resultado=1;
    } catch (PDOException $e) {
      $pdoConexionGestafSiga->rollBack();
      $resultado=5;
        $error='Rutinas: '.$e->getMessage();
        $utilClass->fnlog($error);
    }

    return $sqlSigaRutina;
  }

  function sigaRutinas(){
    $pdoConexionGestafSiga = conectar::ConexionGestafSiga();
      
      $sqlSigaRutinas = "SELECT siga_cat_rutinas_id, siga_cat_rutinas_titulo FROM siga_cat_rutinas WITH (NOLOCK) WHERE siga_cat_area= 1 AND siga_cat_rutinas_estatus IN (1,2)";
      $SigaRutinas    = $pdoConexionGestafSiga->prepare($sqlSigaRutinas);
      $SigaRutinas->execute();
      $SigaRutinasInfo = $SigaRutinas->fetchAll(PDO::FETCH_ASSOC);

    $pdoConexionGestafSiga = NULL;
    return $SigaRutinasInfo;
  }

  function sigaRutinasInfo($siga_rutinas_id){
    $pdoConexionGestafSiga = conectar::ConexionGestafSiga();

    $sqlSigaRutina ="SELECT siga_cat_sort,
                            siga_cat_rutinas_act_desc,
                            siga_cat_rutinas_act_valor_ref,
                        CASE 
                          WHEN siga_cat_rutinas_act_valor_medio=1 THEN 'SI'
                          ELSE 'NO'
                        END valor_medio,
                        CASE 
                          WHEN siga_cat_rutinas_act_adjunto=1 THEN 'SI'
                          ELSE 'NO'
                        END valor_adjunto,
                        siga_cat_rutinas_act_id as id_actividad,
                        CASE
                          WHEN siga_cat_rutinas_act_archivo is NULL THEN 'Sin Archivo'   
                          WHEN siga_cat_rutinas_act_archivo !='' THEN  CONCAT('<a href=\"https://apps2.hospitalsatelite.com/SIGA/Archivos/Archivos-Rutinas/',siga_cat_rutinas_act_archivo,'\" target=\"_blank\">link</a>')
                        END link
                        FROM  siga_cat_rutinas_act WITH (NOLOCK)
                        WHERE siga_cat_rutinas_id=$siga_rutinas_id
                        AND   siga_cat_rutinas_act_estatus IN (1,2)
                        AND   siga_cat_rutinas_act_desc != ''
                        ORDER BY siga_cat_rutinas_act_usr_insert DESC";
      $SigaRutinas = $pdoConexionGestafSiga->prepare($sqlSigaRutina);
      $SigaRutinas->execute();
      $SigaRutinasInfo = $SigaRutinas->fetchAll(PDO::FETCH_ASSOC);

    $pdoConexionGestafSiga = NULL;
    return $SigaRutinasInfo;
  }

function sigaRutinasActivosSolicitados($siga_ids_activos){
  $pdoConexionGestafSiga = conectar::ConexionGestafSiga();

  $ids = implode(",", $siga_ids_activos);

  $sql="SELECT  Id_Activo, AF_BC, Nombre_Activo
        FROM    siga_activos WITH (NOLOCK)
        WHERE   Id_Activo IN ($ids)
        ORDER BY Id_Activo
        ";

  $sqlResult = $pdoConexionGestafSiga->prepare($sql);
  $sqlResult->execute();
  $datos = $sqlResult->fetchAll(PDO::FETCH_NAMED);

  $pdoConexionGestafSiga = NULL;
return $datos;
}

function sigaInsertarRutina($id_activo,$frecuencia,$fecha,$siga_cmb_rutinas,$siga_cmb_rutinasD,$Id_Usuario,$siga_realiza ){
$pdoSiga    = conectar::ConexionGestafSiga();
$utilClass  = new util();

$sql = "SELECT siga_cat_rutinas_act_id, siga_cat_rutinas_act_desc, siga_cat_rutinas_act_valor_ref, siga_cat_sort FROM siga_cat_rutinas_act WITH (NOLOCK) WHERE siga_cat_rutinas_act_estatus IN (1,2) AND siga_cat_rutinas_act_desc != '' AND siga_cat_rutinas_id=$siga_cmb_rutinas ORDER BY siga_cat_sort";
$sqlPre = $pdoSiga->prepare($sql);
$sqlPre->execute();
$fetchSql = $sqlPre->fetchAll(PDO::FETCH_NUM);

  if($frecuencia == 2){
    $valorIntervalo = 'P1M';
    $valorInter = 1;
  } else if($frecuencia == 3){
    $valorIntervalo = 'P2M';
    $valorInter = 2;
  } else if($frecuencia == 4){
    $valorIntervalo = 'P3M';
    $valorInter = 3;
  } else if($frecuencia == 5){
    $valorIntervalo = 'P4M';
    $valorInter = 4;
  } else if($frecuencia == 6){
    $valorIntervalo = 'P6M';
    $valorInter = 6;
  } else if($frecuencia == 7){
    $valorIntervalo = 'P12M';
    $valorInter = 12;
  }
  
$fchInicioUnica = new DateTime( $fecha);
$fechaInicioDeRutinaUnica = $fchInicioUnica->format('Ymd');

// $fchInicio = new DateTime( $fecha);
// $fechaInicioDeRutina = $fchInicio->format('Ym01');

$fchFin    = new DateTime( $fecha);
$fchFin->modify( '+1 year' );
$fechaFinDeRutina= $fchFin->format('Y1231');

//========================================================================================================================================================================================================================
//========================================================================================================================================================================================================================

try{

  $sqlIni        = "INSERT INTO siga_actividades(Id_Area, Tipo_Actividad, Id_Activo, siga_cat_rutinas_id, Nombre_Rutina, Id_Frecuencia,Descripcion,Realiza,Fecha_Programada,vincular_mesa_ayuda,Fech_Inser,Usr_Inser,Estatus_Reg) VALUES (1,2,$id_activo,$siga_cmb_rutinas,'$siga_cmb_rutinasD',$frecuencia,'$siga_cmb_rutinasD',$siga_realiza,'$fechaInicioDeRutinaUnica',1,getdate(),$Id_Usuario,1)";
  $sqlIniPre     = $pdoSiga->prepare($sqlIni);
  $sqlIniPre->execute();
  $idDeActividad = $pdoSiga->lastInsertId();
  
  } catch(PDOException $e) {    
    $error=$e->getMessage();
    $utilClass->fnlog('L220:'.$error);
  }

//========================================================================================================================================================================================================================

  foreach($fetchSql as $item){
    $sqlInsert  = "INSERT INTO siga_det_actividades(Id_Actividad,siga_cat_rutinas_act_id,Num_Actividad,Nombre_Actividad,Valor_Referencia,Fecha_Programada,Fecha_Realizada,Fech_Inser,Usr_Inser,Estatus_Reg,V_Mesa) VALUES ($idDeActividad,$item[0],$item[3],'$item[1]','$item[2]','$fechaInicioDeRutinaUnica','',getdate(),$Id_Usuario,1,1)";    
    $ejecutar   = $pdoSiga->prepare($sqlInsert);
    $ejecutar->execute();
  }
  
//========================================================================================================================================================================================================================
//========================================================================================================================================================================================================================

  $fchFin1 = new DateTime( $fecha);  
  
  for($y=0; $y<24; $y++){
  
    $fchFin1->modify( '+'.$valorInter.' month');
    $fch= $fchFin1->format('Ym01');
  
    if($fechaFinDeRutina>$fch){

        $sqlSub        = "INSERT INTO siga_actividades(Id_Area, Tipo_Actividad, Id_Activo, siga_cat_rutinas_id, Nombre_Rutina, Id_Frecuencia,Descripcion,Realiza,Fecha_Programada,vincular_mesa_ayuda,Fech_Inser,Usr_Inser,Estatus_Reg) VALUES (1,2,$id_activo,$siga_cmb_rutinas,'$siga_cmb_rutinasD',$frecuencia,'$siga_cmb_rutinasD',$siga_realiza,'$fch',1,getdate(),$Id_Usuario,1)";
        $sqlSubInfo     = $pdoSiga->prepare($sqlSub);
        $sqlSubInfo->execute();
        $idDeActividadSub = $pdoSiga->lastInsertId();

//========================================================================================================================================================================================================================

          foreach($fetchSql as $item){
            $sqlInsertSub  = "INSERT INTO siga_det_actividades(Id_Actividad,siga_cat_rutinas_act_id,Num_Actividad,Nombre_Actividad,Valor_Referencia,Fecha_Programada,Fecha_Realizada,Fech_Inser,Usr_Inser,Estatus_Reg,V_Mesa) VALUES ($idDeActividadSub,$item[0],$item[3],'$item[1]','$item[2]','$fch','',getdate(),$Id_Usuario,1,1)";
            $ejecutarSub   = $pdoSiga->prepare($sqlInsertSub);
            $ejecutarSub->execute();
          }

      }  
  }

//========================================================================================================================================================================================================================
//========================================================================================================================================================================================================================

      $pdoSiga=null;
    return true;
 }

//==================================================================================================================================================================================================================
//==================================================================================================================================================================================================================

function actividadPorId($id){
  $pdo = conectar::ConexionGestafSiga();

  $sql = "SELECT siga_cat_rutinas_act_id, siga_cat_rutinas_act_desc, siga_cat_rutinas_act_valor_ref, siga_cat_rutinas_act_valor_medio, siga_cat_rutinas_act_adjunto,ISNULL(siga_cat_rutinas_act_archivo,'') siga_cat_rutinas_act_archivo FROM siga_cat_rutinas_act WHERE siga_cat_rutinas_act_id = $id";
  $sqlResult = $pdo->prepare($sql);
  $sqlResult->execute();
  $datos = $sqlResult->fetch(PDO::FETCH_NAMED);

  $pdoConexionGestafSiga = NULL;

  return $datos;
}

function actividadUpdatePorId($siga_id_actividad_editar, $siga_rutina_act_desc, $siga_rutina_act_valor_ref, $siga_rutina_act_valor_medio, $siga_rutina_act_adjunto,$nombreArchivo,$Id_Usuario){
  $pdo        = conectar::ConexionGestafSiga();
  $utilClass  = new util();

  $sql ="UPDATE siga_cat_rutinas_act 
          SET siga_cat_rutinas_act_desc=:siga_rutina_act_desc, siga_cat_rutinas_act_valor_ref=:siga_rutina_act_valor_ref,
              siga_cat_rutinas_act_valor_medio=:siga_rutina_act_valor_medio, siga_cat_rutinas_act_adjunto=:siga_rutina_act_adjunto,
              siga_cat_rutinas_act_archivo= :nombreArchivo, siga_cat_rutinas_act_usr_update= :Id_Usuario, siga_cat_rutinas_act_fch_update= getdate()
          WHERE siga_cat_rutinas_act_id=:siga_id_actividad_editar";

  $ejecutar = $pdo->prepare($sql); 
  $ejecutar->bindParam(":siga_id_actividad_editar",	    $siga_id_actividad_editar,     PDO::PARAM_INT);
  $ejecutar->bindParam(":siga_rutina_act_desc",	        $siga_rutina_act_desc,         PDO::PARAM_STR);
  $ejecutar->bindParam(":siga_rutina_act_valor_ref",	  $siga_rutina_act_valor_ref,    PDO::PARAM_STR);
  $ejecutar->bindParam(":siga_rutina_act_valor_medio",	$siga_rutina_act_valor_medio,  PDO::PARAM_INT);
  $ejecutar->bindParam(":siga_rutina_act_adjunto",	    $siga_rutina_act_adjunto,      PDO::PARAM_INT);
  $ejecutar->bindParam(":nombreArchivo",	              $nombreArchivo,                PDO::PARAM_STR);
  $ejecutar->bindParam(":Id_Usuario",	                  $Id_Usuario,                   PDO::PARAM_INT);
  
  try {
    $pdo->beginTransaction();
      $ejecutar->execute();
    $pdo->commit();
    $resultado=true;
  } catch (PDOException $e) {
    $pdo->rollBack();
    $resultado=false;
      $error='Rutinas: '.$e->getMessage();
      $utilClass->fnlog($error);
  }

  $pdo= null;
  return $resultado;
}

function sigaInsertarRutinaIndividual($id_activo,$frecuencia,$fecha,$siga_cmb_rutinas,$siga_cmb_rutinasD,$Id_Usuario, $comentarios){
  $pdoSiga = conectar::ConexionGestafSiga();
  
  $sql = "SELECT siga_cat_rutinas_act_id, siga_cat_rutinas_act_desc, siga_cat_rutinas_act_valor_ref 
          FROM siga_cat_rutinas_act WITH (NOLOCK) 
          WHERE siga_cat_rutinas_act_estatus IN (1,2) 
          AND siga_cat_rutinas_act_desc != '' 
          AND siga_cat_rutinas_id=$siga_cmb_rutinas";
    $sqlPre = $pdoSiga->prepare($sql);
    $sqlPre->execute();
    $fetchSql = $sqlPre->fetchAll(PDO::FETCH_NUM);
  
    if($frecuencia == 2){
      $valorIntervalo = 'P1M';
    } else if($frecuencia == 3){
      $valorIntervalo = 'P2M';
    } else if($frecuencia == 4){
      $valorIntervalo = 'P3M';
    } else if($frecuencia == 5){
      $valorIntervalo = 'P4M';
    } else if($frecuencia == 6){
      $valorIntervalo = 'P6M';
    } else if($frecuencia == 7){
      $valorIntervalo = 'P12M';
    }
    
    $primeraFecha   = date('Ymd', strtotime($fecha));
    $fechaIni       = new DateTime($fecha);
    $fechaDeInicio  = intval($fechaIni->format('Y'));
    $fechaFin       = new DateTime($fecha);
    $fechaFinal     = $fechaFin->add(new DateInterval('P12M'));
    $fechaFinal     = intval($fechaFin->format('Y'));
    $fechaInsert    = new DateTime($fecha);
  
    $sqlIni     = "INSERT INTO siga_actividades(Id_Area, Tipo_Actividad, Id_Activo, siga_cat_rutinas_id, Nombre_Rutina, Id_Frecuencia,Descripcion,Realiza,Fecha_Programada,vincular_mesa_ayuda,Comentarios,Fech_Inser,Usr_Inser,Estatus_Reg) 
                    VALUES (1,2,$id_activo,$siga_cmb_rutinas,'$siga_cmb_rutinasD',$frecuencia,'$siga_cmb_rutinasD',1,'$primeraFecha',1,'$comentarios', getdate(),$Id_Usuario,1)";
    $sqlIniPre  = $pdoSiga->prepare($sqlIni);

      $sqlIniPre->execute();
      $idDeActividad = $pdoSiga->lastInsertId();
  
    for($i=0;$i<30;$i++){
  
      $unaFecha = $fechaIni->add(new DateInterval($valorIntervalo));
      $unaFecha->format('Y');
      $fvalidar = intval($fechaIni->format('Y'));
      $fechaInsert->add(new DateInterval($valorIntervalo));
  
      if($fechaFinal >= $fvalidar){
        $fechaInserts = $fechaInsert->format('Ym01');
        try {
          $i=1;
          foreach($fetchSql as $item){
            try {
              $sqlInsert  = "INSERT INTO siga_det_actividades(Id_Actividad,siga_cat_rutinas_act_id,Num_Actividad,Nombre_Actividad,Valor_Referencia,Fecha_Programada,Fecha_Realizada,Fech_Inser,Usr_Inser,Estatus_Reg,V_Mesa) 
                              VALUES ($idDeActividad,$item[0],$i,'$item[1]','$item[2]','$fechaInserts','',getdate(),$Id_Usuario,1,1)";

              $ejecutar   = $pdoSiga->prepare($sqlInsert);
              $ejecutar->execute();
            } catch (PDOException $e) {
              $resultado=$e->getMessage();
            }
          $i++;
        }
  //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
          } catch (PDOException $e) {
              $pdoSiga->rollBack();
              $resultado=$e->getMessage();            
            }     
        }
  
    }
    $z=1;
    foreach($fetchSql as $item){
      $sqlInsert2 = "INSERT INTO siga_det_actividades(Id_Actividad,siga_cat_rutinas_act_id,Num_Actividad,Nombre_Actividad,Valor_Referencia,Fecha_Programada,Fecha_Realizada,Fech_Inser,Usr_Inser,Estatus_Reg,V_Mesa) VALUES ($idDeActividad,$item[0],$z,'$item[1]','$item[2]','$primeraFecha','',getdate(),$Id_Usuario,1,1)";
      $ejecutar2   = $pdoSiga->prepare($sqlInsert2);
      $ejecutar2->execute();
      $z++;
    }
  
  //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  
    // if(!empty($arrayAccesorios)){
      
    //   foreach ($arrayAccesorios as $item) {
    //     $descripcion_material   = trim($item["nombre"]);
    //     $folio_almacen_material = trim($item["folio"]);
    //     $sku_material           = trim($item["sku"]);
    //     $clase_material         = trim($item["clase"]);
    //     $unidad_material        = trim($item["unidad"]);
    //     $costo_material         = trim($item["costo"]);
    //     $cantidad_material      = trim($item["cantidad"]);

    //     $sqlAccesorios = "INSERT INTO siga_actividades_materiales(id_actividad,descripcion_material,folio_almacen_material,sku_material,clase_material,unidad_material,costo_material,cantidad_material,Fech_Inser,Usr_Inser) 
    //                       VALUES ($idDeActividad, '$descripcion_material','$folio_almacen_material','$sku_material','$clase_material','$unidad_material',$costo_material,$cantidad_material,getdate(),$Id_Usuario)";
        
    //     $sqlAccesoriosExecute  = $pdoSiga->prepare($sqlAccesorios);
    //     $sqlAccesoriosExecute->execute();
    //   }
               
    // }

    //,  $arrayAccesorios
    
  //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  
        $pdoSiga=null;
      return 'ok:';
   }

   function sigaEliminarArchivoActividad($siga_id_actividad_editar){
    
    $pdoConexionGestafSiga = conectar::ConexionGestafSiga();
    $utilClass = new util();

    $sql = "UPDATE siga_cat_rutinas_act SET siga_cat_rutinas_act_archivo='' WHERE siga_cat_rutinas_act_id = :siga_id_actividad_editar";
    $resultado    = $pdoConexionGestafSiga->prepare($sql);
    $resultado->bindParam(":siga_id_actividad_editar",	$siga_id_actividad_editar, PDO::PARAM_INT);
    
    try {
      $pdoConexionGestafSiga->beginTransaction();
        $resultado->execute();
      $pdoConexionGestafSiga->commit();
    } catch (PDOException $e) {
      $pdoConexionGestafSiga->rollBack();
        $error='Rutinas Actividades: '.$e->getMessage();
        $utilClass->fnlog($error);
    }      
      $pdoConexionGestafSiga=null;
    return true;
   }

   function sigaEliminarArchivoCarpeta($siga_cat_rutinas_act_id){

    $pdo = conectar::ConexionGestafSiga();
    $utilClass = new util();

      $sqlSigaRutinas = "SELECT  siga_cat_rutinas_act_archivo FROM siga_cat_rutinas_act WITH (NOLOCK) WHERE siga_cat_rutinas_act_id IN ($siga_cat_rutinas_act_id)";
      $SigaRutinas    = $pdo->prepare($sqlSigaRutinas);
      $SigaRutinas->execute();
      $SigaRutinasInfo = $SigaRutinas->fetchColumn();
      $utilClass->fnlog($SigaRutinasInfo);

    $pdo = NULL;

    return $SigaRutinasInfo;
   }

function sortActividades($siga_cat_rutinas_id){
  $pdo = conectar::ConexionGestafSiga();
  $utilClass = new util();

  $sql = "SELECT siga_cat_sort FROM siga_cat_rutinas_act WHERE siga_cat_rutinas_id = :siga_cat_rutinas_id AND siga_cat_rutinas_act_estatus IN (1,2) ORDER BY siga_cat_sort asc";
  $sqlPrepare = $pdo->prepare($sql);
  $sqlPrepare->bindParam(':siga_cat_rutinas_id', $siga_cat_rutinas_id, PDO::PARAM_INT);
  $sqlPrepare->execute();

  $sqlPrepareInfo = $sqlPrepare->fetchAll(PDO::FETCH_NAMED);

  $pdo=null;
  return $sqlPrepareInfo;
}

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function sigaRutinaUpdateTitulo($Id_Usuario, $siga_titulo_editar_id, $siga_titulo_editar){
  $pdo = conectar::ConexionGestafSiga();
  $utilClass = new util();

  $sql = "UPDATE siga_cat_rutinas SET siga_cat_rutinas_titulo=:siga_titulo_editar, siga_cat_rutinas_usr_update=:Id_Usuario, siga_cat_rutinas_fch_update=getdate(), siga_cat_rutinas_estatus=2 WHERE siga_cat_rutinas_id=:siga_titulo_editar_id";
  $sqlPrepare = $pdo->prepare($sql);  
  $sqlPrepare->bindParam(":Id_Usuario",	            $Id_Usuario,          PDO::PARAM_INT);
  $sqlPrepare->bindParam(":siga_titulo_editar",     $siga_titulo_editar,  PDO::PARAM_STR);
  $sqlPrepare->bindParam(":siga_titulo_editar_id",	$siga_titulo_editar_id, PDO::PARAM_INT);
  try {
    $pdo->beginTransaction();
      $sqlPrepare->execute();
    $pdo->commit();
  } catch (PDOException $e) {
    $pdo->rollBack();
      $error='rutinas.class.php::sigaRutinaUpdateTitulo:: '.$e->getMessage();
      $utilClass->fnlog($error);
  }

  return true;
}

function sigaAgregarActividadRutinaVigente($siga_id_rutina_a_editar, $sigaSortActividades, $siga_rutina_act_desc_agregar, $siga_rutina_act_valor_ref_agregar,$siga_rutina_act_valor_medio_agregar, $siga_rutina_act_adjunto_agregar, $nombreArchivo,$Id_Usuario){
  $pdo = conectar::ConexionGestafSiga();
  $utilClass = new util();
  
  if($sigaSortActividades == -1){
    $sql        = "SELECT TOP 1 siga_cat_sort FROM siga_cat_rutinas_act WHERE siga_cat_rutinas_id = $siga_id_rutina_a_editar AND siga_cat_rutinas_act_estatus in (1,2) ORDER BY siga_cat_sort DESC";
    $sqlPrepare = $pdo->prepare($sql);
    $sqlPrepare->execute();
    $info = $sqlPrepare->fetch(PDO::FETCH_NAMED);
    
    $orden = $info['siga_cat_sort']+1;
    $sqlInsert = "INSERT INTO siga_cat_rutinas_act (siga_cat_rutinas_id,siga_cat_sort,siga_cat_rutinas_act_desc,siga_cat_rutinas_act_valor_ref,siga_cat_rutinas_act_valor_medio,siga_cat_rutinas_act_adjunto,siga_cat_rutinas_act_archivo,siga_cat_rutinas_act_usr_insert,siga_cat_rutinas_act_fch_insert,siga_cat_rutinas_act_estatus) VALUES ($siga_id_rutina_a_editar,$orden,'$siga_rutina_act_desc_agregar','$siga_rutina_act_valor_ref_agregar',$siga_rutina_act_valor_medio_agregar,$siga_rutina_act_adjunto_agregar,'$nombreArchivo',$Id_Usuario,getdate(),1)";
    $sqlInsertPrepare = $pdo->prepare($sqlInsert);
    $sqlInsertPrepare->execute();
    $resultado = true;

  }else{
    $sql        = "SELECT siga_cat_rutinas_act_id, siga_cat_sort FROM siga_cat_rutinas_act WHERE siga_cat_rutinas_id = $siga_id_rutina_a_editar AND siga_cat_sort >= $sigaSortActividades AND siga_cat_rutinas_act_estatus in (1,2) ORDER BY siga_cat_sort ASC ";
    $sqlPrepare = $pdo->prepare($sql);
    $sqlPrepare->execute();
    $info = $sqlPrepare->fetchAll(PDO::FETCH_NAMED);

    foreach($info as $item){
      $orden = $item['siga_cat_sort']+1;
      $sqlUpdate = "UPDATE siga_cat_rutinas_act SET siga_cat_sort=$orden WHERE siga_cat_rutinas_act_id =".$item['siga_cat_rutinas_act_id'];
      $sqlUpdatePrepare = $pdo->prepare($sqlUpdate);
      $sqlUpdatePrepare->execute();
    }

    $sqlInsert = "INSERT INTO siga_cat_rutinas_act (siga_cat_rutinas_id,siga_cat_sort,siga_cat_rutinas_act_desc,siga_cat_rutinas_act_valor_ref,siga_cat_rutinas_act_valor_medio,siga_cat_rutinas_act_adjunto,siga_cat_rutinas_act_archivo,siga_cat_rutinas_act_usr_insert,siga_cat_rutinas_act_fch_insert,siga_cat_rutinas_act_estatus) VALUES ($siga_id_rutina_a_editar,$sigaSortActividades,'$siga_rutina_act_desc_agregar','$siga_rutina_act_valor_ref_agregar',$siga_rutina_act_valor_medio_agregar,$siga_rutina_act_adjunto_agregar,'$nombreArchivo',$Id_Usuario,getdate(),1)";
    $sqlInsertPrepare = $pdo->prepare($sqlInsert);
    $sqlInsertPrepare->execute();
    $resultado = true;
  }

  return $resultado;
}

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function sigaEliminarActividadRutinaVigente($Id_Usuario,$id){
  $pdo = conectar::ConexionGestafSiga();
  $utilClass = new util();

  $sql02 = "SELECT siga_cat_sort FROM siga_cat_rutinas_act WHERE siga_cat_rutinas_act_id=$id";
  $sqlPrepare02 = $pdo->prepare($sql02);
  $sqlPrepare02->execute();
  $info02 = $sqlPrepare02->fetchColumn();

  $sql  = "SELECT siga_cat_rutinas_act_id, siga_cat_sort 
           FROM   siga_cat_rutinas_act 
           WHERE  siga_cat_rutinas_id = (SELECT siga_cat_rutinas_id FROM siga_cat_rutinas_act WHERE siga_cat_rutinas_act_id=$id)
           AND    siga_cat_sort > $info02
           AND    siga_cat_rutinas_act_estatus IN (1,2)
           ORDER BY siga_cat_sort";
  $sqlPrepare = $pdo->prepare($sql);
  $sqlPrepare->execute();
  $info = $sqlPrepare->fetchAll(PDO::FETCH_NAMED);

  foreach($info as $item){
    $orden = $item['siga_cat_sort']-1;
    $sqlUpdate        = "UPDATE siga_cat_rutinas_act SET siga_cat_sort=$orden WHERE siga_cat_rutinas_act_id =".$item['siga_cat_rutinas_act_id'];
    $sqlUpdatePrepare = $pdo->prepare($sqlUpdate);
    $sqlUpdatePrepare->execute();

    $utilClass->fnlog($sqlUpdate);
  }

  $sqlUpdateEstatus = "UPDATE siga_cat_rutinas_act SET siga_cat_rutinas_act_estatus=3 WHERE siga_cat_rutinas_act_id=$id";
  $sqlUpdateEstatusPrepare = $pdo->prepare($sqlUpdateEstatus);
  $sqlUpdateEstatusPrepare->execute();

    $pdo = null;
  return true;
}

function pruebaRutinas(){
  return 'Prueba De la clase nueva';
}

}

  // $pdo = conectar::ConexionGestafSiga();
  // $utilClass = new util();

  // $ids = "SELECT siga_cat_rutinas_id FROM siga_cat_rutinas where siga_cat_rutinas_estatus=1";
  // $idsPrepare = $pdo->prepare($ids);
  // $idsPrepare->execute();
  // $resultado = $idsPrepare->fetchAll(PDO::FETCH_NAMED);

  
  // foreach($resultado as $item){      
    
  //     $sql = "SELECT siga_cat_rutinas_act_id,siga_cat_rutinas_id FROM siga_cat_rutinas_act WHERE siga_cat_rutinas_id=".$item['siga_cat_rutinas_id']." ORDER BY siga_cat_rutinas_act_id ASC";
  //     $sqlPrepare = $pdo->prepare($sql);
  //     $sqlPrepare->execute();
  //     $resultados = $sqlPrepare->fetchAll(PDO::FETCH_NAMED);
  //     $c = 1;
  //       foreach($resultados as $ver){
  //         $utilClass->fnlog($ver['siga_cat_rutinas_id'].'/'.$ver['siga_cat_rutinas_act_id']);
  //         $updateSorteo = "UPDATE siga_cat_rutinas_act SET siga_cat_sort = $c WHERE siga_cat_rutinas_act_id=".$ver['siga_cat_rutinas_act_id'];
  //         $sqlPrepareSorteo = $pdo->prepare($updateSorteo);
  //         $sqlPrepareSorteo->execute();
  //         $utilClass->fnlog($updateSorteo);
  //         $c++;
  //       }
      
  // }