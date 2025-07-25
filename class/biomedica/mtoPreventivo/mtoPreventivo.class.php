<?php
  include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/connect/conectar.class.php");
  include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/admin/utilerias/util.class.php");
  class mtoPreventivo extends conectar{
    
    function prueba(){
      $pdo = conectar::ConexionGestafSiga();

      $pdo=null;
      return 'prueba';
    }

    function getActividadesIdFecha($id, $Fech_Solicitud){            
      $pdo = conectar::ConexionGestafSiga();
      
      $sql = "SELECT act.Id_Det_Actividad, act.Num_Actividad, rutina.siga_cat_rutinas_act_desc, rutina.siga_cat_rutinas_act_valor_ref, 
                    rutina.siga_cat_rutinas_act_valor_medio, rutina.siga_cat_rutinas_act_adjunto,
                    act.Fecha_Programada, act.Fecha_Realizada, act.Url_Adjunto, 
                    act.Valor_Medido, act.Observaciones, 
                    act.Estatus_Actividad, isnull(rutina.siga_cat_rutinas_act_archivo,'') siga_cat_rutinas_act_archivo
              FROM  siga_det_actividades act
              LEFT JOIN siga_cat_rutinas_act rutina ON act.siga_cat_rutinas_act_id = rutina.siga_cat_rutinas_act_id
              WHERE Id_Actividad = $id
              AND   Fecha_Programada = $Fech_Solicitud
              AND   rutina.siga_cat_rutinas_act_estatus in (1,2)
              ORDER BY rutina.siga_cat_sort";
      $resultado = $pdo->prepare($sql);
      $resultado->execute();
      $info = $resultado->fetchAll(PDO::FETCH_NAMED);
      $pdo=null;
      return $info;
    }

    function updateActividades($act_id,$act_valor_medido,$act_estatus,$act_observaciones,$act_fch_realizado, $act_adjunto, $Id_Usuario){

      $pdo = conectar::ConexionGestafSiga();
      $utilClass  = new util();

        $sql = "UPDATE siga_det_actividades SET Valor_Medido=:act_valor_medido, Estatus_Actividad=:act_estatus, Observaciones=:act_observaciones, Fecha_Realizada=:act_fch_realizado, Url_Adjunto=:act_adjunto_nom, Usr_Mod=:Id_Usuario, Fech_Mod=getdate() WHERE Id_Det_Actividad=:act_id";
        $query = $pdo->prepare($sql);
        $query->bindParam(":act_valor_medido",	$act_valor_medido,  PDO::PARAM_STR);
        $query->bindParam(":act_estatus",				$act_estatus,			  PDO::PARAM_INT);      
        $query->bindParam(":act_observaciones",	$act_observaciones, PDO::PARAM_STR);
        $query->bindParam(":act_adjunto_nom",	  $act_adjunto,       PDO::PARAM_STR);
        $query->bindParam(":act_fch_realizado", $act_fch_realizado, PDO::PARAM_STR);
        $query->bindParam(":Id_Usuario",				$Id_Usuario,			  PDO::PARAM_INT);
        $query->bindParam(":act_id",				    $act_id,			      PDO::PARAM_INT);

      try {
				$pdo->beginTransaction();
					$query->execute();
				$pdo->commit();
        $resultado = true;
      } catch (PDOException $e) {
        $resultado = false;
        //$log=$e->getMessage();
        $utilClass->fnlog('updateActividades:'.$e->getMessage());
      }

      $sqlUpdate = "UPDATE siga_actividades SET Fecha_Realizada='$act_fch_realizado' WHERE Id_Actividad = $act_id";
      $sqlPrepareUpdate = $pdo->prepare($sqlUpdate);
      $sqlPrepareUpdate->execute();

        $pdo=null;
      return $resultado;
    }

    function updateActividadesSinImagen($act_id,$act_valor_medido,$act_estatus,$act_observaciones,$act_fch_realizado, $Id_Usuario){

      $pdo = conectar::ConexionGestafSiga();
      $utilClass  = new util();

        $sql = "UPDATE siga_det_actividades SET Valor_Medido=:act_valor_medido, Estatus_Actividad=:act_estatus, Observaciones=:act_observaciones, Fecha_Realizada=:act_fch_realizado, Usr_Mod=:Id_Usuario, Fech_Mod=getdate() WHERE Id_Det_Actividad=:act_id";
        $query = $pdo->prepare($sql);
        $query->bindParam(":act_valor_medido",	$act_valor_medido,  PDO::PARAM_STR);
        $query->bindParam(":act_estatus",				$act_estatus,			  PDO::PARAM_INT);      
        $query->bindParam(":act_observaciones",	$act_observaciones, PDO::PARAM_STR);        
        $query->bindParam(":act_fch_realizado", $act_fch_realizado, PDO::PARAM_STR);
        $query->bindParam(":Id_Usuario",				$Id_Usuario,			  PDO::PARAM_INT);
        $query->bindParam(":act_id",				    $act_id,			      PDO::PARAM_INT);

      try {
				$pdo->beginTransaction();
					$query->execute();
				$pdo->commit();
        $resultado = true;
      } catch (PDOException $e) {
        $resultado = false;
        $utilClass->fnlog('updateActividadesSinImagen:'.$e->getMessage());        
      }

        $pdo=null;
      return $resultado;
    }

  function sigaActualizarActividades($act_id,$campo,$valor){
    // $pdo = conectar::ConexionGestafSiga();

    $sql = "UPDATE siga_det_actividades SET $campo='$valor' WHERE Id_Det_Actividad=$act_id";
    // $query = $pdo->prepare($sql);

    // $query->bindParam(":act_valor_medido",	$act_valor_medido,  PDO::PARAM_STR);
    // $query->bindParam(":act_estatus",				$act_estatus,			  PDO::PARAM_INT);  

    // try {
    //   $pdo->beginTransaction();
    //     $query->execute();
    //   $pdo->commit();
    //   $resultado = true;
    // } catch (PDOException $e) {
    //   $resultado = false;
    //   $log=$e->getMessage();
    // }

      // $pdo=null;


    return $sql;
  }

  function sigaActividadesEliminarImagen($id){
    $pdo = conectar::ConexionGestafSiga();
    $utilClass  = new util();

    $busqueda = "SELECT Url_Adjunto FROM siga_det_actividades WHERE Id_Det_Actividad=$id"; 
    $resultadoBusqueda = $pdo->prepare($busqueda);
    $resultadoBusqueda->execute();
    $url = $resultadoBusqueda->fetch(PDO::FETCH_COLUMN);
    $utilClass->fnlog($busqueda);
    $sql  = "UPDATE siga_det_actividades SET Url_Adjunto = '', Fecha_Realizada='',Estatus_Actividad=0, Observaciones='',Valor_Medido='' WHERE Id_Det_Actividad=$id";
    $sqlPrepare  = $pdo->prepare($sql);

    try {
      $pdo->beginTransaction();
        $sqlPrepare->execute();
          $pdo->commit();
      $valido = true;
      //$utilClass->fnlog($sql);
    } catch (PDOException $e) {
      $valido = false;      
      $utilClass->fnlog($e->getMessage());
    }    

    if($valido){
      $destinationDirectory = $_SERVER['DOCUMENT_ROOT'].'/SIGA/Archivos/Archivos-Actividades/Mantenimiento-Preventivo/'.$url['Url_Adjunto'];
      
      if(unlink($destinationDirectory)){
        $resultado='Se elimino';
      }else{
        $resultado='no se elimino';
      }
      
      $resultado='true';
    } else {
      $resultado='false';
     }
    
    $pdo=null;
    return $resultado;
  }

function getActivoActividad($id_actividad){
  $pdo = conectar::ConexionGestafSiga();

  $sql = "SELECT  Id_Actividad, 
        actividades.Id_Activo, 
        actividades.Nombre_Rutina,
        activos.AF_BC,
        activos.DescLarga,
        isNULL((SELECT Desc_Ubic_Sec FROM siga_cat_ubic_sec WHERE Id_Ubic_Sec=activos.Id_Ubic_Sec),'Sin Ubicación Secundaria') Ubic_Sec,
        (SELECT Desc_Ubic_Prim FROM siga_cat_ubic_prim WHERE Id_Ubic_Prim=activos.Id_Ubic_Prim) Ubic_Prim,         
        activos.NumSerie,
        activos.Marca,
        activos.DescCorta,
        activos.Modelo,
        activos.Especifica,
        activos.Foto
      FROM siga_actividades actividades
      LEFT JOIN siga_activos activos ON activos.Id_Activo=actividades.Id_Activo
      WHERE Id_Actividad=$id_actividad";
    $resultado = $pdo->prepare($sql);
    $resultado->execute();
    $info = $resultado->fetch(PDO::FETCH_NAMED);

  $pdo=NULL;

  return $info;
}

function reprogramarActividad($id_actividad_detalle,$fecha_reprogramada_detalle,$Id_Usuario){
  $pdo = conectar::ConexionGestafSiga();
  $fecha_reprogramada_detalle = str_replace("-", "",  $fecha_reprogramada_detalle);
  $resultado                = true;
  
  $sql = "UPDATE siga_actividades SET Fecha_Programada=$fecha_reprogramada_detalle, Fech_Mod= GETDATE(), Usr_Mod=$Id_Usuario WHERE Id_Actividad=$id_actividad_detalle";
  $resultado = $pdo->prepare($sql);
  $resultado->execute();

  $sqlDetalle = "UPDATE siga_det_actividades SET Fecha_Programada=$fecha_reprogramada_detalle, Fech_Mod=getdate(), Usr_Mod=$Id_Usuario WHERE Id_Actividad=$id_actividad_detalle";
  $resultadoDetalle = $pdo->prepare($sqlDetalle);
  $resultadoDetalle->execute();

  $pdo=null;
  return true;
}

function cancelarActividad($texto_id_actividad,$Id_Usuario){
  $pdo = conectar::ConexionGestafSiga();
  $utilClass  = new util();
  //$texto_fecha_programada   = str_replace("-", "",  $texto_fecha_programada);
  $resultado                = true;

  //$sql = "UPDATE siga_det_actividades SET Estatus_Reg=3, Fech_Mod= GETDATE(), Usr_Mod=$Id_Usuario WHERE Id_Actividad=$texto_id_actividad and Fecha_Programada=$texto_fecha_programada";
  $sql = "UPDATE siga_actividades SET Estatus_Reg=3, Fech_Mod= GETDATE(), Usr_Mod=$Id_Usuario WHERE Id_Actividad=$texto_id_actividad";
  //$utilClass->fnlog($sql);
  $resultado = $pdo->prepare($sql);
  $resultado->execute();

  $pdo=null;
  return $resultado;
}

  function validarRutinaCompleta($Id_Actividad, $Fecha_Programada){
    $pdo = conectar::ConexionGestafSiga();

    $sql = "SELECT COUNT(Fecha_Realizada) 
            FROM siga_det_actividades 
            WHERE Id_Actividad    = :Id_Actividad
            AND Fecha_Programada  = :Fecha_Programada
            AND Fecha_Realizada= ''";

    $sqlPrepare = $pdo->prepare($sql);
    $sqlPrepare->bindParam(":Fecha_Programada",	$Fecha_Programada,  PDO::PARAM_STR);
    $sqlPrepare->bindParam(":Id_Actividad",			$Id_Actividad,			PDO::PARAM_INT);
    $sqlPrepare->execute();
    $resultado = $sqlPrepare->fetchColumn(0);

    $pdo=null;

    return $resultado;
  }

  function getTituloDeRutina($Id_Actividad){
    $pdo = conectar::ConexionGestafSiga();

    $sql = "SELECT  Nombre_Rutina
            FROM    siga_actividades
            WHERE   Id_Actividad = :Id_Actividad";

    $sqlPrepare = $pdo->prepare($sql);
    $sqlPrepare->bindParam(":Id_Actividad",			$Id_Actividad,			PDO::PARAM_INT);
    $sqlPrepare->execute();
    $resultado = $sqlPrepare->fetchColumn(0);

    $pdo=null;
    return $resultado;
  }

  function insertAccesoriosDeTicket($Id_Solicitud,$descripcion,$Folio_Almacen,$sku,$clase,$unidad,$costo,$cantidad,$Id_Usuario){
    $pdo        = conectar::ConexionGestafSiga();
    $utilClass  = new util();

    $sql = "INSERT INTO siga_actividades_materiales (id_solicitud,descripcion_material,folio_almacen_material,sku_material,clase_material,unidad_material,costo_material,cantidad_material,Fech_Inser,Usr_Inser,Estatus_Reg) 
            VALUES ($Id_Solicitud,:descripcion,:Folio_Almacen,:sku,:clase,:unidad,$costo,$cantidad,getdate(),$Id_Usuario,1)";
    $sqlPrepare = $pdo->prepare($sql);
    $sqlPrepare->bindParam(":descripcion",	  $descripcion,   PDO::PARAM_STR);
    $sqlPrepare->bindParam(":Folio_Almacen",	$Folio_Almacen, PDO::PARAM_STR);
    $sqlPrepare->bindParam(":sku",	          $sku,           PDO::PARAM_STR);
    $sqlPrepare->bindParam(":clase",	        $clase,         PDO::PARAM_STR);
    $sqlPrepare->bindParam(":unidad",	        $unidad,        PDO::PARAM_STR);    

    try {
      $pdo->beginTransaction();
        $sqlPrepare->execute();
      $pdo->commit();
      $resultado = true;
    } catch (PDOException $e) {
      $resultado = false;
      $utilClass->fnlog('mtoPreventivo.class::insertAccesoriosDeTicket::'.$e->getMessage());
    }

    $pdo = null;
    return $resultado;
  }

function materialTicket($id_solicitud,$origen_alm_ext){
  $pdo        = conectar::ConexionGestafSiga();
  $utilClass  = new util();

  $sql = "SELECT id_materiales, origen_alm_ext, descripcion_material, folio_almacen_material, sku_material, clase_material, unidad_material, costo_material, cantidad_material,(costo_material*cantidad_material)importe, numDeParte, referencia
          FROM  siga_actividades_materiales
          WHERE id_solicitud=$id_solicitud
          AND   Estatus_Reg IN (1,2)
          AND   origen_alm_ext = $origen_alm_ext";
          
  $sqlPrepare = $pdo->prepare($sql);
  
  try{
    $sqlPrepare->execute();
    $resultado = $sqlPrepare->fetchAll(PDO::FETCH_NAMED);
  }catch(PDOException $e){
    $utilClass->fnlog('materialTicket:'.$e->getMessage());    
  }

  $pdo = null;
  return $resultado;
}

public function eliminarMaterial($id_material,$Id_Usuario){
  $pdo = conectar::ConexionGestafSiga();
  $utilClass  = new util();

  $sql = "UPDATE siga_actividades_materiales SET Estatus_Reg=3, Fech_Mod= GETDATE(), Usr_Mod=$Id_Usuario WHERE id_materiales=$id_material";
  $resultado = $pdo->prepare($sql);

  try{
    $pdo->beginTransaction();
      $resultado->execute(); 
    $pdo->commit();
    $resultado=true;
  }catch(PDOException $e){
    $utilClass->fnlog('eliminarMaterial:'.$e->getMessage());    
    $resultado=false;
  }
$pdo=null;

  return $resultado;
}

public function editarMaterial($id_material){
  $pdo = conectar::ConexionGestafSiga();
  
    $sql = "SELECT  id_materiales,descripcion_material,folio_almacen_material,sku_material,clase_material,unidad_material,FORMAT(costo_material, 'N', 'en-us') costo_material,cantidad_material,numDeParte,referencia
            FROM    siga_actividades_materiales
            WHERE   id_materiales=$id_material";

    $sqlPrepare = $pdo->prepare($sql);
      $sqlPrepare->execute();
    $resultado = $sqlPrepare->fetch(PDO::FETCH_NAMED);
  $pdo=null;
  return $resultado;
}

public function editarMaterialUpdate($id_materiales, $acc_folio_almacen_material, $acc_cantidad_material, $Id_Usuario){
  $pdo = conectar::ConexionGestafSiga();
  $utilClass  = new util();

  $sql = "UPDATE siga_actividades_materiales 
          SET folio_almacen_material =:acc_folio_almacen_material, cantidad_material=:acc_cantidad_material, Fech_Mod= GETDATE(), Usr_Mod=:Id_Usuario, Estatus_Reg=2 
          WHERE id_materiales = $id_materiales";
  $sqlPrepare = $pdo->prepare($sql);
  $sqlPrepare->bindParam(":acc_folio_almacen_material",	  $acc_folio_almacen_material,  PDO::PARAM_STR);
  $sqlPrepare->bindParam(":acc_cantidad_material",	      $acc_cantidad_material,       PDO::PARAM_INT);
  $sqlPrepare->bindParam(":Id_Usuario",	                  $Id_Usuario,                  PDO::PARAM_INT);

  try{
    $pdo->beginTransaction();
      $sqlPrepare->execute(); 
    $pdo->commit();
    $resultado=true;    
  }catch(PDOException $e){
    $utilClass->fnlog('editarMaterialUpdate:'.$e->getMessage());    
    $resultado=false;
  }

  $pdo=null;
  return $resultado;
}

public function accesoriosAssist(){
  $pdo        = conectar::ConexionChsTcaSol();

  $sql="SELECT inviar.art, inviar.des1
        FROM    inviar
        LEFT JOIN invart ON inviar.art=invart.art
        WHERE   invart.alm='BIO'
        AND     inviar.status=00
        AND     inviar.lin != 'SER'
        AND     invart.status=00";
  $sqlPrepare = $pdo->prepare($sql);
  $sqlPrepare->execute();
  $info = $sqlPrepare->fetchAll(PDO::FETCH_NAMED);

  $pdo = null;
  return $info;
}

public function accesoriosAssistId($idAccesorioAssist){
  $pdo  = conectar::ConexionChsTcaSol();
  $utilClass  = new util();

  $sql="SELECT inviar.art,
          inviar.des1,
          inviar.cod_barras,
          REPLACE(LTRIM(REPLACE(inviar.art,'0',' ')),' ','0') as sku_vista,
          inviar.s_lin,
          inviar.marca,
          invart.localizacion,
          invart.uds_sal,
          CAST(invart.Existencia as int) Existencia,
          inviar.uds_min,
          CAST(invart.cto_prom as numeric(10,2)) AS costo,          
          CONCAT('$ ', FORMAT(invart.cto_prom, 'N', 'en-us')) AS cto_prom
        FROM    inviar
        LEFT JOIN invart ON inviar.art=invart.art
        WHERE   inviar.art=:idAccesorioAssist
        AND     invart.alm='BIO'
        AND     inviar.status=00
        AND     inviar.lin != 'SER'
        AND     invart.status=00
  ";

  $sqlPrepare = $pdo->prepare($sql);
  $sqlPrepare->bindParam(':idAccesorioAssist',  $idAccesorioAssist, PDO::PARAM_STR);
  $sqlPrepare->execute();
  $resultado = $sqlPrepare->fetch(PDO::FETCH_NAMED);

  $pdo=null;

  return $resultado;
}

public function agregarMaterial($Id_Solicitud,$combo_accesorios_assist, $origen_alm_ext, $acc_folio_almacen_material_a,$acc_sku_material_a,$acc_clase_material_a,$acc_unidad_material_a,$acc_costo_material_a,$acc_cantidad_material_a,$Id_Usuario,$acc_no_parte_ext,$acc_referencia_ext){
  $pdo = conectar::ConexionGestafSiga();
  $utilClass  = new util();

  $sql = "INSERT INTO siga_actividades_materiales(id_solicitud, descripcion_material, origen_alm_ext, folio_almacen_material, sku_material, clase_material, unidad_material, costo_material, cantidad_material, Fech_Inser, Usr_Inser, Estatus_Reg,numDeParte,referencia) 
          VALUES (:Id_Solicitud, :combo_accesorios_assist, :origen_alm_ext, :acc_folio_almacen_material_a, :acc_sku_material_a, :acc_clase_material_a, :acc_unidad_material_a, :acc_costo_material_a, :acc_cantidad_material_a, getdate(), :Id_Usuario,1,:acc_no_parte_ext, :acc_referencia_ext)";
  $sqlPrepare = $pdo->prepare($sql);
  $sqlPrepare->bindParam(':Id_Solicitud',             $Id_Solicitud, PDO::PARAM_INT);
  $sqlPrepare->bindParam(':combo_accesorios_assist',  $combo_accesorios_assist, PDO::PARAM_STR);
  $sqlPrepare->bindParam(':origen_alm_ext',           $origen_alm_ext, PDO::PARAM_INT);
  $sqlPrepare->bindParam(':acc_folio_almacen_material_a', $acc_folio_almacen_material_a, PDO::PARAM_STR);
  $sqlPrepare->bindParam(':acc_sku_material_a',       $acc_sku_material_a, PDO::PARAM_STR);
  $sqlPrepare->bindParam(':acc_clase_material_a',     $acc_clase_material_a, PDO::PARAM_STR);
  $sqlPrepare->bindParam(':acc_unidad_material_a',    $acc_unidad_material_a, PDO::PARAM_STR);
  $sqlPrepare->bindParam(':acc_costo_material_a',     $acc_costo_material_a, PDO::PARAM_INT);
  $sqlPrepare->bindParam(':acc_cantidad_material_a',  $acc_cantidad_material_a, PDO::PARAM_INT);
  $sqlPrepare->bindParam(':Id_Usuario',               $Id_Usuario, PDO::PARAM_INT);  
  $sqlPrepare->bindParam(':acc_no_parte_ext',         $acc_no_parte_ext, PDO::PARAM_STR);
  $sqlPrepare->bindParam(':acc_referencia_ext',       $acc_referencia_ext, PDO::PARAM_STR);

  try{
    $pdo->beginTransaction();
      $sqlPrepare->execute();
    $pdo->commit();
    $resultado=true; 
    $utilClass->fnlog('ejecuto bien'.$resultado);   
  }catch(PDOException $e){
    $utilClass->fnlog('agregarMaterialmtoPreventivo.Class:agregarMaterial::'.$e->getMessage());    
    $resultado=false;
  }

  $pdo= null;
return '';
}

public function totalImporteMateriales($Id_Solicitud){
  $pdo = conectar::ConexionGestafSiga();
  $utilClass  = new util();

  $sql = "SELECT sum(costo_material*cantidad_material) as total
          FROM siga_actividades_materiales
          WHERE id_solicitud=:Id_Solicitud
          AND Estatus_Reg in (1,2)";

  $sqlPrepare = $pdo->prepare($sql);
  $sqlPrepare->bindParam(':Id_Solicitud', $Id_Solicitud, PDO::PARAM_INT);
  $sqlPrepare->execute();
  $info = $sqlPrepare->fetchColumn(0);

  $pdo = null;
  return $info;
}

public function getClase($id_materiales){
  $pdo = conectar::ConexionGestafSiga();
  $utilClass  = new util();
  $sql = "SELECT clase_material FROM siga_actividades_materiales WHERE id_materiales=$id_materiales";
  
  $sqlPrepare = $pdo->prepare($sql);
  $sqlPrepare->execute();
  $info = $sqlPrepare->fetchColumn();
  return $info;
}

public function getUnidad($id_materiales){
  $pdo = conectar::ConexionGestafSiga();
  $utilClass  = new util();
  $sql = "SELECT unidad_material FROM siga_actividades_materiales WHERE id_materiales=$id_materiales";
  
  $sqlPrepare = $pdo->prepare($sql);
  $sqlPrepare->execute();
  $info = $sqlPrepare->fetchColumn();
  return $info;
}

public function editarMaterialExternoUpdate($id_materiales_edit, $acc_descripcion_material_ext_edit,$acc_clase_material_ext_edit, $acc_unidad_material_ext_edit, $acc_no_parte_ext_edit, $acc_referencia_ext_edit, $acc_costo_material_ext_edit, $acc_cantidad_material_ext_edit, $Id_Usuario){
  $pdo = conectar::ConexionGestafSiga();
  $utilClass  = new util();

  $sql = "UPDATE siga_actividades_materiales 
          SET   descripcion_material = :acc_descripcion_material_ext_edit,
                clase_material=:acc_clase_material_ext_edit,
                unidad_material=:acc_unidad_material_ext_edit,
                numDeParte=:acc_no_parte_ext_edit,
                referencia=:acc_referencia_ext_edit,
                costo_material=:acc_costo_material_ext_edit,
                cantidad_material=:acc_cantidad_material_ext_edit,
                Fech_Mod= GETDATE(),
                Usr_Mod=:Id_Usuario,
                Estatus_Reg=2 
          WHERE  id_materiales = $id_materiales_edit";
  $sqlPrepare = $pdo->prepare($sql);
  $sqlPrepare->bindParam(":acc_descripcion_material_ext_edit",  $acc_descripcion_material_ext_edit,  PDO::PARAM_STR);
  $sqlPrepare->bindParam(":acc_clase_material_ext_edit",	      $acc_clase_material_ext_edit,  PDO::PARAM_STR);
  $sqlPrepare->bindParam(":acc_unidad_material_ext_edit",	      $acc_unidad_material_ext_edit,  PDO::PARAM_STR);
  $sqlPrepare->bindParam(":acc_no_parte_ext_edit",	            $acc_no_parte_ext_edit,  PDO::PARAM_STR);
  $sqlPrepare->bindParam(":acc_referencia_ext_edit",	          $acc_referencia_ext_edit,  PDO::PARAM_STR);
  $sqlPrepare->bindParam(":acc_costo_material_ext_edit",	      $acc_costo_material_ext_edit,       PDO::PARAM_INT);
  $sqlPrepare->bindParam(":acc_cantidad_material_ext_edit",	    $acc_cantidad_material_ext_edit,       PDO::PARAM_INT);
  $sqlPrepare->bindParam(":Id_Usuario",	                        $Id_Usuario,                  PDO::PARAM_INT);

  try{
    $pdo->beginTransaction();
      $sqlPrepare->execute(); 
    $pdo->commit();
    $resultado=true;    
    $utilClass->fnlog($sql);

  }catch(PDOException $e){
    $utilClass->fnlog('editarMaterialUpdate:'.$e->getMessage());    
    $resultado=false;
  }

  $pdo=null;
  return $resultado;
}

public function getActividadesTicketLectura($id_solicitud){
  $pdo = conectar::ConexionGestafSiga(); 

  $sql = "SELECT Nombre_Actividad, Valor_Referencia, Valor_Medido, Estatus_Actividad, Observaciones, Url_Adjunto, Fecha_Realizada
          FROM siga_det_actividades 
          WHERE Id_Actividad = (SELECT Id_Actividad FROM siga_solicitud_tickets WHERE Id_Solicitud=$id_solicitud)
          AND Fecha_Programada= (SELECT convert(varchar, Fech_Solicitud, 112) FROM siga_solicitud_tickets WHERE Id_Solicitud=$id_solicitud)";

  $sqlPrepare = $pdo->prepare($sql);
  $sqlPrepare->execute();
  $info = $sqlPrepare->fetchAll(PDO::FETCH_NAMED);

  $pdo = null;
  return $info;
}

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

} 