<?php
  include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/connect/conectar.class.php");
  include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/admin/utilerias/util.class.php");
  include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/catalogos/catalogos.class.php");

class mantenimientoPreventivo extends conectar{

//==================================================================================================================================================================================================================
//==================================================================================================================================================================================================================
function sigaTablaGlobal($Id_Area, $agnio, $id_Activo, $cmbubicacionprim, $cmbubicacionsec, $cmbclase, $cmbclasificacion, $cmbfamilia, $cmbsubfamilia, $selectUsuarios, $textModeloGlobal, $textMarcaGlobal, $textNombreRutina, $textDescripcionCorta, $cmbGestor, $cmbOdernAscDesc){
  $pdo = conectar::ConexionGestafSiga();

  $sql = "SELECT  activos.Id_Activo,
                  activos.AF_BC,         
                  isnull((SELECT Desc_Ubic_Prim FROM siga_cat_ubic_prim WHERE Id_Ubic_Prim = activos.Id_Ubic_Prim),'Sin Ubicación') as uPrimaria,
                  activos.Nombre_Completo uResponsable, 
                  CASE 
                      WHEN AC.Realiza=0 THEN 'Interno' 
                      WHEN AC.Realiza=1 THEN 'Externo' 
                  END as Realiza,               
                  ac.Descripcion rutina,
                  (SELECT Desc_Frecuencia FROM siga_cat_frecuencia WHERE Id_Frecuencia=ac.Id_Frecuencia) frecuencia,
                  activos.DescCorta,
                  activos.NumSerie,
                  activos.Modelo,
                  (SELECT TOP 1 ISNULL(usuario.Nombre_Usuario, 'Sin Asignar') usuario FROM siga_solicitud_tickets tk LEFT JOIN siga_usuarios usuario ON tk.Id_Gestor= Usuario.Id_Usuario WHERE Id_Activo=activos.Id_Activo AND YEAR(tk.Fech_Inser)=$agnio ORDER BY TK.Id_Solicitud DESC) gestor
          FROM siga_actividades ac
          LEFT JOIN siga_solicitud_tickets tk ON ac.Id_Actividad=tk.Id_Actividad
          LEFT JOIN siga_activos activos ON activos.Id_Activo = ac.Id_Activo
          WHERE Tipo_Actividad = 2
          AND ac.Id_Area =$Id_Area
          AND ac.Estatus_Reg in (1,2)      
          AND YEAR(ac.Fecha_Programada) = $agnio";
          
            if($id_Activo != ''){
              $sql.=" AND activos.Id_Activo =$id_Activo";
            }
            if($cmbubicacionprim <> -1){
              $sql.=" AND activos.Id_Ubic_Prim =$cmbubicacionprim";
            }
            if($cmbubicacionsec <> -1){
                $sql.=" AND activos.Id_Ubic_Sec =$cmbubicacionsec";
              }
            if($cmbclase <> -1){
                $sql.=" AND activos.Id_Clase =$cmbclase";
              }
            if($cmbclasificacion <> -1){
                $sql.=" AND activos.Id_Clasificacion =$cmbclasificacion";
              }
            if($cmbfamilia <> -1){
                $sql.=" AND activos.Id_Familia =$cmbfamilia";
              }
            if($cmbfamilia <> -1){
                $sql.=" AND activos.Id_Subfamilia =$cmbsubfamilia";
              }
            if($selectUsuarios <> ""){
                $sql.=" AND activos.Num_Empleado =$selectUsuarios";
              }
            if($textModeloGlobal <> ""){
                $sql.=" AND activos.Modelo COLLATE Latin1_general_CI_AI like '%$textModeloGlobal%' ";
              }
            if($textMarcaGlobal <> ""){
                $sql.=" AND activos.Marca COLLATE Latin1_general_CI_AI like '%$textMarcaGlobal%' ";
              }  
            if($textNombreRutina <> ""){
                $sql.=" AND ac.Descripcion COLLATE Latin1_general_CI_AI like '%$textNombreRutina%' ";
              } 
            if($textDescripcionCorta <> ""){
                $sql.=" AND activos.DescCorta COLLATE Latin1_general_CI_AI like '%$textDescripcionCorta%' ";
              } 
            if($cmbGestor <> -1){
                $sql.=" AND tk.Id_Gestor =$cmbGestor";
              }
 
    $sql.=" GROUP BY activos.Id_Activo, activos.AF_BC, activos.Id_Ubic_Prim, activos.Nombre_Completo, Realiza, ac.Descripcion, ac.Id_Frecuencia, activos.DescCorta,activos.NumSerie,activos.Modelo";
    $sql.=" ORDER BY uPrimaria $cmbOdernAscDesc";

    $sqlResult = $pdo->prepare($sql);
    $sqlResult->execute();
    $datos = $sqlResult->fetchAll(PDO::FETCH_NAMED);

  $pdo = null;

  return $datos;
}

function sigaTablaGlobalFechas($Id_Area, $agnio, $id_Activo,$nombreRutina){

  $mes01 = $this->sigaTablaGlobalFechasMes($Id_Area, $agnio, $id_Activo, 1,$nombreRutina);
  $mes02 = $this->sigaTablaGlobalFechasMes($Id_Area, $agnio, $id_Activo, 2,$nombreRutina);
  $mes03 = $this->sigaTablaGlobalFechasMes($Id_Area, $agnio, $id_Activo, 3,$nombreRutina);
  $mes04 = $this->sigaTablaGlobalFechasMes($Id_Area, $agnio, $id_Activo, 4,$nombreRutina);
  $mes05 = $this->sigaTablaGlobalFechasMes($Id_Area, $agnio, $id_Activo, 5,$nombreRutina);
  $mes06 = $this->sigaTablaGlobalFechasMes($Id_Area, $agnio, $id_Activo, 6,$nombreRutina);
  $mes07 = $this->sigaTablaGlobalFechasMes($Id_Area, $agnio, $id_Activo, 7,$nombreRutina);
  $mes08 = $this->sigaTablaGlobalFechasMes($Id_Area, $agnio, $id_Activo, 8,$nombreRutina);
  $mes09 = $this->sigaTablaGlobalFechasMes($Id_Area, $agnio, $id_Activo, 9,$nombreRutina);
  $mes10 = $this->sigaTablaGlobalFechasMes($Id_Area, $agnio, $id_Activo, 10,$nombreRutina);
  $mes11 = $this->sigaTablaGlobalFechasMes($Id_Area, $agnio, $id_Activo, 11,$nombreRutina);
  $mes12 = $this->sigaTablaGlobalFechasMes($Id_Area, $agnio, $id_Activo, 12,$nombreRutina);
  
  $resultado[]=array('mes01'=>$mes01['mes'],'Estatus_Proceso01'=>$mes01['Estatus_Proceso'],'programado01'=>$mes01['programado'],'cierre01'=>$mes01['cierre'],'ticket01'=>$mes01['Id_Solicitud'],'color01'=>$mes01['color']);
  $resultado[]=array('mes02'=>$mes02['mes'],'Estatus_Proceso02'=>$mes02['Estatus_Proceso'],'programado02'=>$mes02['programado'],'cierre02'=>$mes02['cierre'],'ticket02'=>$mes02['Id_Solicitud'],'color02'=>$mes02['color']);
  $resultado[]=array('mes03'=>$mes03['mes'],'Estatus_Proceso03'=>$mes03['Estatus_Proceso'],'programado03'=>$mes03['programado'],'cierre03'=>$mes03['cierre'],'ticket03'=>$mes03['Id_Solicitud'],'color03'=>$mes03['color']);
  $resultado[]=array('mes04'=>$mes04['mes'],'Estatus_Proceso04'=>$mes04['Estatus_Proceso'],'programado04'=>$mes04['programado'],'cierre04'=>$mes04['cierre'],'ticket04'=>$mes04['Id_Solicitud'],'color04'=>$mes04['color']);
  $resultado[]=array('mes05'=>$mes05['mes'],'Estatus_Proceso05'=>$mes05['Estatus_Proceso'],'programado05'=>$mes05['programado'],'cierre05'=>$mes05['cierre'],'ticket05'=>$mes05['Id_Solicitud'],'color05'=>$mes05['color']);
  $resultado[]=array('mes06'=>$mes06['mes'],'Estatus_Proceso06'=>$mes06['Estatus_Proceso'],'programado06'=>$mes06['programado'],'cierre06'=>$mes06['cierre'],'ticket06'=>$mes06['Id_Solicitud'],'color06'=>$mes06['color']);
  $resultado[]=array('mes07'=>$mes07['mes'],'Estatus_Proceso07'=>$mes07['Estatus_Proceso'],'programado07'=>$mes07['programado'],'cierre07'=>$mes07['cierre'],'ticket07'=>$mes07['Id_Solicitud'],'color07'=>$mes07['color']);
  $resultado[]=array('mes08'=>$mes08['mes'],'Estatus_Proceso08'=>$mes08['Estatus_Proceso'],'programado08'=>$mes08['programado'],'cierre08'=>$mes08['cierre'],'ticket08'=>$mes08['Id_Solicitud'],'color08'=>$mes08['color']);
  $resultado[]=array('mes09'=>$mes09['mes'],'Estatus_Proceso09'=>$mes09['Estatus_Proceso'],'programado09'=>$mes09['programado'],'cierre09'=>$mes09['cierre'],'ticket09'=>$mes09['Id_Solicitud'],'color09'=>$mes09['color']);
  $resultado[]=array('mes10'=>$mes10['mes'],'Estatus_Proceso10'=>$mes10['Estatus_Proceso'],'programado10'=>$mes10['programado'],'cierre10'=>$mes10['cierre'],'ticket10'=>$mes10['Id_Solicitud'],'color10'=>$mes10['color']);
  $resultado[]=array('mes11'=>$mes11['mes'],'Estatus_Proceso11'=>$mes11['Estatus_Proceso'],'programado11'=>$mes11['programado'],'cierre11'=>$mes11['cierre'],'ticket11'=>$mes11['Id_Solicitud'],'color11'=>$mes11['color']);
  $resultado[]=array('mes12'=>$mes12['mes'],'Estatus_Proceso12'=>$mes12['Estatus_Proceso'],'programado12'=>$mes12['programado'],'cierre12'=>$mes12['cierre'],'ticket12'=>$mes12['Id_Solicitud'],'color12'=>$mes12['color']);
  
  return $resultado;
}

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function sigaTablaGlobalFechasMes($Id_Area, $agnio, $id_Activo, $mes, $nombreRutina){
  $pdo = conectar::ConexionGestafSiga();
  $utilClass = new util();

  $sql = "SELECT MONTH(ac.Fecha_Programada) mes, 
                tk.Estatus_Proceso Estatus_Proceso,
                DAY(ac.Fecha_Programada) programado,                    
                (SELECT CASE 
                            -- WHEN Estatus_Proceso=1 THEN DAY(Fech_Solicitud)
                            -- WHEN Estatus_Proceso=2 THEN DAY(Fech_Seguimiento)
                            -- WHEN Estatus_Proceso=3 THEN DAY(Fech_Espera_Cierre)
                            WHEN Estatus_Proceso=4 THEN DAY(ac.Fecha_Realizada)
                        END  cierre
          FROM siga_solicitud_tickets WHERE Id_Solicitud = tk.Id_Solicitud) cierre,
          tk.Id_Solicitud,
            ISNULL((SELECT 
            CASE 
                WHEN Estatus_Proceso=1 THEN 'background-color:#D90505;'
                WHEN Estatus_Proceso=2 THEN 'background-color:#ecc93b;' 
                WHEN Estatus_Proceso=3 THEN 'background-color:#35a61e;'
                WHEN Estatus_Proceso=4 THEN 'background-color:#448aff;'
            ELSE ''
            END  color
          FROM siga_solicitud_tickets WHERE Id_Solicitud = tk.Id_Solicitud AND estatus_reg <> 3),'background-color:#717d7e;') AS color
          FROM siga_actividades ac
          LEFT JOIN siga_solicitud_tickets tk ON ac.Id_Actividad=tk.Id_Actividad
          LEFT JOIN siga_activos activos ON activos.Id_Activo = ac.Id_Activo
          WHERE Tipo_Actividad = 2
          AND ac.Id_Area = $Id_Area
          AND ac.Estatus_Reg in (1,2)           
          AND YEAR(ac.Fecha_Programada) = $agnio
          AND activos.Id_Activo = $id_Activo
          AND MONTH(ac.Fecha_Programada) = $mes
          AND ac.Nombre_Rutina = '$nombreRutina'          
          ORDER BY mes ASC";
  $sqlPrepare = $pdo->prepare($sql);  
  $sqlPrepare->execute();
  $info = $sqlPrepare->fetch(PDO::FETCH_NAMED);

  $pdo=null;
  return $info;
}

public function getMPCalendario($agnio, $Id_Area){
  $pdo = conectar::ConexionGestafSiga();
  $utilClass = new util();

  $sql = "SELECT ('[AF_BC: '+RTRIM(activos.AF_BC)+'][Nombre: '+RTRIM(activos.DescCorta)+'][Modelo:'+RTRIM(activos.Modelo)+'][Serie: '+RTRIM(activos.NumSerie)+']') as title,        
            FORMAT(CAST(ac.Fecha_Programada as date),'yyyy-MM-dd') as start,
              CASE 
                  WHEN tk.Estatus_Proceso=1 AND tk.Estatus_Reg <> 3 THEN '#D90505'
                  WHEN tk.Estatus_Proceso=2 AND tk.Estatus_Reg <> 3  THEN '#ecc93b' 
                  WHEN tk.Estatus_Proceso=3 AND tk.Estatus_Reg <> 3  THEN '#35a61e'
                  WHEN tk.Estatus_Proceso=4 AND tk.Estatus_Reg <> 3  THEN '#448aff'  
              ELSE '#717d7e'
            END  color,
          ac.Id_Actividad as idActividad
          FROM siga_actividades ac
          LEFT JOIN siga_solicitud_tickets tk ON ac.Id_Actividad=tk.Id_Actividad
          LEFT JOIN siga_activos activos ON activos.Id_Activo = ac.Id_Activo
          WHERE Tipo_Actividad = 2
          AND ac.Id_Area = $Id_Area
          AND ac.Estatus_Reg in (1,2)
          AND YEAR(ac.Fecha_Programada) = $agnio";

  $sqlPrepare = $pdo->prepare($sql);
  $sqlPrepare->execute();
  $info = $sqlPrepare->fetchall(PDO::FETCH_NAMED);

    $pdo=null;

  return $info;
}

public function getMPActividad($idActividad){
  $pdo = conectar::ConexionGestafSiga();
  $utilClass = new util();

  $sql = "SELECT (RTRIM(activos.AF_BC) +'-'+RTRIM(activos.DescCorta)) activo,
        RTRIM(activos.Modelo) Modelo,
        RTRIM(activos.NumSerie) NumSerie, 
        RTRIM(activos.Marca) Marca,
        (SELECT Desc_Ubic_Prim FROM siga_cat_ubic_prim WHERE Id_Ubic_Prim=activos.Id_Ubic_Prim) uPrimaria,
        (SELECT Desc_Ubic_Sec FROM siga_cat_ubic_sec WHERE Id_Ubic_Sec=activos.Id_Ubic_Sec) uSecundaria,
        activos.Especifica,
        activos.Foto,
        ac.Id_Actividad as idActividad,
        ac.siga_cat_rutinas_id as idRutina,
        ac.Descripcion rutina,
        FORMAT(CAST(ac.Fecha_Programada as date),'yyyy-MM-dd') fechaProgramada,
        ac.Estatus_Reg,
        isnull(tk.Estatus_Proceso,0) Estatus_Proceso,
        isnull(tk.Estatus_Reg,0) tkEstatus_Reg
        FROM siga_actividades ac
        LEFT JOIN siga_solicitud_tickets tk ON ac.Id_Actividad=tk.Id_Actividad
        LEFT JOIN siga_activos activos ON activos.Id_Activo = ac.Id_Activo
        WHERE ac.Id_Actividad=$idActividad      
        ";

  $sqlPrepare = $pdo->prepare($sql);
  $sqlPrepare->execute();
  $info = $sqlPrepare->fetch(PDO::FETCH_NAMED);

    $pdo=null;

  return $info;
}

public function getActividadesUPrimaria($idMes, $idAgnio, $Id_Area,$cmbubicacionprim_mensual, $cmbubicacionsec_mensual, $cmbclase_mensual, $cmbclasificacion_mensual,
																																		$cmbfamilia_mensual, $cmbsubfamilia_mensual, $selectActivosSearchMensual){

  $pdo = conectar::ConexionGestafSiga();
  $utilClass = new util();

  $sql = "SELECT  activos.Id_Ubic_Prim,
                  isnull((SELECT Desc_Ubic_Prim FROM siga_cat_ubic_prim WHERE Id_Ubic_Prim = activos.Id_Ubic_Prim),'Sin Ubicación') as uPrimaria      
            FROM  siga_actividades ac
            LEFT JOIN siga_solicitud_tickets tk ON ac.Id_Actividad=tk.Id_Actividad
            LEFT JOIN siga_activos activos ON activos.Id_Activo = ac.Id_Activo
            WHERE Tipo_Actividad = 2
            AND   ac.Id_Area = $Id_Area
            AND   ac.Estatus_Reg in (1,2)
            AND   MONTH(ac.Fecha_Programada) = $idMes
            AND   YEAR(ac.Fecha_Programada) = $idAgnio";

            if($cmbubicacionprim_mensual != -1){
              $sql.=" AND activos.Id_Ubic_Prim =$cmbubicacionprim_mensual";
            }

            if($cmbubicacionsec_mensual != -1){
              $sql.=" AND activos.Id_Ubic_Sec =$cmbubicacionsec_mensual";
            }

            if($cmbclase_mensual != -1){
              $sql.=" AND activos.Id_Clase =$cmbclase_mensual";
            }

            if($cmbclasificacion_mensual != -1){
              $sql.=" AND activos.Id_Clasificacion =$cmbclasificacion_mensual";
            }

            if($cmbfamilia_mensual != -1){
              $sql.=" AND activos.Id_Familia =$cmbfamilia_mensual";
            }

            if($cmbsubfamilia_mensual != -1){
              $sql.=" AND activos.Id_Subfamilia =$cmbsubfamilia_mensual";
            }

            if($selectActivosSearchMensual != ''){
              $sql.=" AND activos.Id_Activo =$selectActivosSearchMensual";
            }

          $sql.=" GROUP by activos.Id_Ubic_Prim";
  //$utilClass->fnlog($sql);
  $sqlPrepare = $pdo->prepare($sql);
  $sqlPrepare->execute();
  $info = $sqlPrepare->fetchall(PDO::FETCH_NAMED);

    $pdo=null;

  return $info ;
}

public function getUbiSecundaria($idMes, $idAgnio, $Id_Area, $idUPrimaria){

  $pdo = conectar::ConexionGestafSiga();
  $utilClass = new util();

  $sql = "SELECT DISTINCT(activos.Id_Ubic_Sec) idSecundaria,
          isnull((SELECT Desc_Ubic_Sec FROM siga_cat_ubic_sec WHERE Id_Ubic_Sec= activos.Id_Ubic_Sec),'Sin Ubicacion') USecundaria,
          activos.Id_Ubic_Prim           
          FROM siga_actividades ac
          LEFT JOIN siga_solicitud_tickets tk ON ac.Id_Actividad=tk.Id_Actividad
          LEFT JOIN siga_activos activos ON activos.Id_Activo = ac.Id_Activo
          WHERE Tipo_Actividad = 2
          AND ac.Id_Area = $Id_Area
          AND ac.Estatus_Reg in (1,2)
          AND MONTH(ac.Fecha_Programada) = $idMes
          AND YEAR(ac.Fecha_Programada) = $idAgnio
          AND activos.Id_Ubic_Prim      = $idUPrimaria ";

          $sqlPrepare = $pdo->prepare($sql);
          $sqlPrepare->execute();
          $info = $sqlPrepare->fetchall(PDO::FETCH_NAMED);

    $pdo = null;

    return $info;
}

public function getActividadesUPrimariaUSecundaria($idMes, $idAgnio, $Id_Area, $idUPrimaria, $USecundaria){

  $pdo = conectar::ConexionGestafSiga();
  $utilClass = new util();

  $sql = "SELECT activos.Id_Activo,
                activos.AF_BC,         
                tk.Id_Solicitud,        
                isnull((SELECT Desc_Ubic_Sec FROM siga_cat_ubic_sec WHERE Id_Ubic_Sec= activos.Id_Ubic_Sec),'Sin Ubicacion') USecundaria,
                isnull(tk.Estatus_Proceso,0) Estatus_Proceso,
                activos.Nombre_Completo uResponsable, 
                ac.Descripcion rutina,
                ac.Id_Actividad,
                ac.siga_cat_rutinas_id,
                (SELECT Desc_Frecuencia FROM siga_cat_frecuencia WHERE Id_Frecuencia=ac.Id_Frecuencia) frecuencia,
                activos.DescCorta,
                activos.NumSerie,
                activos.Modelo,
                (SELECT TOP 1 ISNULL(usuario.Nombre_Usuario, 'Sin Asignar') usuario FROM siga_solicitud_tickets tk LEFT JOIN siga_usuarios usuario ON tk.Id_Gestor= Usuario.Id_Usuario WHERE Id_Activo=activos.Id_Activo AND YEAR(tk.Fech_Inser)=2025 ORDER BY TK.Id_Solicitud DESC) gestor,
                ac.Fecha_Programada,
                ac.Fecha_Realizada,
                activos.Foto,
                tk.Estatus_Reg,
              CASE 
                  WHEN tk.Estatus_Proceso=1 AND tk.Estatus_Reg <> 3 THEN '#D90505'
                  WHEN tk.Estatus_Proceso=2 AND tk.Estatus_Reg <> 3  THEN '#ecc93b'
                  WHEN tk.Estatus_Proceso=3 AND tk.Estatus_Reg <> 3  THEN '#35a61e'
                  WHEN tk.Estatus_Proceso=4 AND tk.Estatus_Reg <> 3  THEN '#448aff'
                ELSE '#717d7e'
              END  color,
              CASE 
                  WHEN Estatus_Proceso=1 THEN 'Nuevo'
                  WHEN Estatus_Proceso=2 THEN 'Seguimiento' 
                  WHEN Estatus_Proceso=3 THEN 'Por Calificar'
                  WHEN Estatus_Proceso=4 THEN 'Cerrado'
                ELSE 'Pendiente'
              END  estado
          FROM siga_actividades ac
          LEFT JOIN siga_solicitud_tickets tk ON ac.Id_Actividad=tk.Id_Actividad
          LEFT JOIN siga_activos activos ON activos.Id_Activo = ac.Id_Activo
          WHERE Tipo_Actividad = 2
          AND ac.Id_Area = $Id_Area
          AND ac.Estatus_Reg in (1,2)
          AND MONTH(ac.Fecha_Programada) = $idMes
          AND YEAR(ac.Fecha_Programada) = $idAgnio
          AND activos.Id_Ubic_Prim      = $idUPrimaria
          AND activos.Id_Ubic_Sec       = $USecundaria";
          
  //$utilClass->fnlog($sql);
  $sqlPrepare = $pdo->prepare($sql);
  $sqlPrepare->execute();
  $info = $sqlPrepare->fetchall(PDO::FETCH_NAMED);

    $pdo=null;

  return $info ;
}

//=================================================================================================================================================================================================
//=================================================================================================================================================================================================
public function getActividadesUPrimariaPendientes($Id_Area,$cmbubicacionprim_mensual, $cmbubicacionsec_mensual, $cmbclase_mensual, $cmbclasificacion_mensual,
																																		$cmbfamilia_mensual, $cmbsubfamilia_mensual, $selectActivosSearchMensual){

  $fechaIni = date('Ymt');
  $fechaFin = date('Ym01',strtotime('-6 months'));
  $pdo = conectar::ConexionGestafSiga();
  $utilClass = new util();

  $sql = "SELECT  activos.Id_Ubic_Prim,
                  isnull((SELECT Desc_Ubic_Prim FROM siga_cat_ubic_prim WHERE Id_Ubic_Prim = activos.Id_Ubic_Prim),'Sin Ubicación') as uPrimaria      
            FROM  siga_actividades ac
            LEFT JOIN siga_solicitud_tickets tk ON ac.Id_Actividad=tk.Id_Actividad
            LEFT JOIN siga_activos activos ON activos.Id_Activo = ac.Id_Activo
            WHERE Tipo_Actividad = 2
            AND   ac.Id_Area = $Id_Area
            AND   ac.Estatus_Reg in (1,2)
            AND   ac.Fecha_Programada between '$fechaFin' and '$fechaIni' ";

            if($cmbubicacionprim_mensual != -1){
              $sql.=" AND activos.Id_Ubic_Prim =$cmbubicacionprim_mensual";
            }

            if($cmbubicacionsec_mensual != -1){
              $sql.=" AND activos.Id_Ubic_Sec =$cmbubicacionsec_mensual";
            }

            if($cmbclase_mensual != -1){
              $sql.=" AND activos.Id_Clase =$cmbclase_mensual";
            }

            if($cmbclasificacion_mensual != -1){
              $sql.=" AND activos.Id_Clasificacion =$cmbclasificacion_mensual";
            }

            if($cmbfamilia_mensual != -1){
              $sql.=" AND activos.Id_Familia =$cmbfamilia_mensual";
            }

            if($cmbsubfamilia_mensual != -1){
              $sql.=" AND activos.Id_Subfamilia =$cmbsubfamilia_mensual";
            }

            if($selectActivosSearchMensual != ''){
              $sql.=" AND activos.Id_Activo =$selectActivosSearchMensual";
            }

          $sql.=" GROUP by activos.Id_Ubic_Prim";
  //$utilClass->fnlog($sql);
  $sqlPrepare = $pdo->prepare($sql);
  $sqlPrepare->execute();
  $info = $sqlPrepare->fetchall(PDO::FETCH_NAMED);

    $pdo=null;

  return $info ;
}


public function getUbiSecundariaPendientes($Id_Area, $idUPrimaria){

  $fechaIni = date('Ymt');
  $fechaFin = date('Ym01',strtotime('-6 months'));

  $pdo = conectar::ConexionGestafSiga();
  $utilClass = new util();

  $sql = "SELECT DISTINCT(activos.Id_Ubic_Sec) idSecundaria,
          isnull((SELECT Desc_Ubic_Sec FROM siga_cat_ubic_sec WHERE Id_Ubic_Sec= activos.Id_Ubic_Sec),'Sin Ubicacion') USecundaria,
          activos.Id_Ubic_Prim           
          FROM siga_actividades ac
          LEFT JOIN siga_solicitud_tickets tk ON ac.Id_Actividad=tk.Id_Actividad
          LEFT JOIN siga_activos activos ON activos.Id_Activo = ac.Id_Activo
          WHERE Tipo_Actividad = 2
          AND ac.Id_Area = $Id_Area
          AND ac.Estatus_Reg in (1,2)
          AND ac.Fecha_Programada between '$fechaFin' and '$fechaIni'
          AND activos.Id_Ubic_Prim      = $idUPrimaria ";

          $sqlPrepare = $pdo->prepare($sql);
          $sqlPrepare->execute();
          $info = $sqlPrepare->fetchall(PDO::FETCH_NAMED);

    $pdo = null;
    //$utilClass->fnlog($sql);
    return $info;
}

public function getActividadesUPrimariaUSecundariaPendientes($Id_Area, $idUPrimaria, $USecundaria){

  $fechaIni = date('Ymt');
  $fechaFin = date('Ym01',strtotime('-6 months'));

  $pdo = conectar::ConexionGestafSiga();
  $utilClass = new util();

  $sql = "SELECT activos.Id_Activo,
                activos.AF_BC,         
                tk.Id_Solicitud,        
                isnull((SELECT Desc_Ubic_Sec FROM siga_cat_ubic_sec WHERE Id_Ubic_Sec= activos.Id_Ubic_Sec),'Sin Ubicacion') USecundaria,
                isnull(tk.Estatus_Proceso,0) Estatus_Proceso,
                activos.Nombre_Completo uResponsable, 
                ac.Descripcion rutina,
                ac.Id_Actividad,
                ac.siga_cat_rutinas_id,
                (SELECT Desc_Frecuencia FROM siga_cat_frecuencia WHERE Id_Frecuencia=ac.Id_Frecuencia) frecuencia,
                activos.DescCorta,
                activos.NumSerie,
                activos.Modelo,
                (SELECT TOP 1 ISNULL(usuario.Nombre_Usuario, 'Sin Asignar') usuario FROM siga_solicitud_tickets tk LEFT JOIN siga_usuarios usuario ON tk.Id_Gestor= Usuario.Id_Usuario WHERE Id_Activo=activos.Id_Activo AND YEAR(tk.Fech_Inser)=2025 ORDER BY TK.Id_Solicitud DESC) gestor,
                ac.Fecha_Programada,
                ac.Fecha_Realizada,
                activos.Foto,
                tk.Estatus_Reg,
              CASE 
                  WHEN tk.Estatus_Proceso=1 AND tk.Estatus_Reg <> 3 THEN '#D90505'
                  WHEN tk.Estatus_Proceso=2 AND tk.Estatus_Reg <> 3  THEN '#ecc93b'
                  WHEN tk.Estatus_Proceso=3 AND tk.Estatus_Reg <> 3  THEN '#35a61e'
                  WHEN tk.Estatus_Proceso=4 AND tk.Estatus_Reg <> 3  THEN '#448aff'
                ELSE '#717d7e'
              END  color,
              CASE 
                  WHEN Estatus_Proceso=1 THEN 'Nuevo'
                  WHEN Estatus_Proceso=2 THEN 'Seguimiento' 
                  WHEN Estatus_Proceso=3 THEN 'Por Calificar'
                  WHEN Estatus_Proceso=4 THEN 'Cerrado'
                ELSE 'Pendiente'
              END  estado
          FROM siga_actividades ac
          LEFT JOIN siga_solicitud_tickets tk ON ac.Id_Actividad=tk.Id_Actividad
          LEFT JOIN siga_activos activos ON activos.Id_Activo = ac.Id_Activo
          WHERE Tipo_Actividad = 2
          AND ac.Id_Area = $Id_Area
          AND ac.Estatus_Reg in (1,2)
          AND ac.Fecha_Programada BETWEEN '$fechaFin' AND '$fechaIni'
          AND activos.Id_Ubic_Prim      = $idUPrimaria
          AND activos.Id_Ubic_Sec       = $USecundaria";
          
  //$utilClass->fnlog($sql);
  $sqlPrepare = $pdo->prepare($sql);
  $sqlPrepare->execute();
  $info = $sqlPrepare->fetchall(PDO::FETCH_NAMED);

    $pdo=null;

  return $info ;
}

function getActividadesPorAgnio($id_activo,  $txt_Rutina_Search, $txt_Desc_Corta_Search, $agnio_vigente, $ubi_primaria_calendario, $ubi_Secundaria_calendario,$Id_area, $mes_vigente){

  $pdo = conectar::ConexionGestafSiga();
  $utilClass      = new util();


  $sql = "SELECT activos.Id_Activo,
                activos.AF_BC,         
                tk.Id_Solicitud,
                isnull((SELECT Desc_Ubic_Prim FROM siga_cat_ubic_prim WHERE Id_Ubic_Prim = activos.Id_Ubic_Prim),'Sin Ubicación') as uPrimaria,
                isnull((SELECT Desc_Ubic_Sec FROM siga_cat_ubic_sec WHERE Id_Ubic_Sec= activos.Id_Ubic_Sec),'Sin Ubicacion') USecundaria,
                isnull(tk.Estatus_Proceso,0) Estatus_Proceso,
                activos.Nombre_Completo uResponsable, 
                ac.Descripcion rutina,
                ac.Id_Actividad,
                ac.siga_cat_rutinas_id,
                (SELECT Desc_Frecuencia FROM siga_cat_frecuencia WHERE Id_Frecuencia=ac.Id_Frecuencia) frecuencia,
                activos.DescCorta,
                activos.NumSerie,
                activos.Modelo,
                (SELECT TOP 1 ISNULL(usuario.Nombre_Usuario, 'Sin Asignar') usuario FROM siga_solicitud_tickets tk LEFT JOIN siga_usuarios usuario ON tk.Id_Gestor= Usuario.Id_Usuario WHERE Id_Activo=activos.Id_Activo AND YEAR(tk.Fech_Inser)=$agnio_vigente ORDER BY TK.Id_Solicitud DESC) gestor,
                ac.Fecha_Programada,
                ac.Fecha_Realizada,
                activos.Foto,
                tk.Estatus_Reg,
              CASE 
                  WHEN tk.Estatus_Proceso=1 AND tk.Estatus_Reg <> 3 THEN '#D90505'
                  WHEN tk.Estatus_Proceso=2 AND tk.Estatus_Reg <> 3 THEN '#ecc93b'
                  WHEN tk.Estatus_Proceso=3 AND tk.Estatus_Reg <> 3 THEN '#35a61e'
                  WHEN tk.Estatus_Proceso=4 AND tk.Estatus_Reg <> 3 THEN '#448aff'
                ELSE '#717d7e'
              END  color,
              CASE 
                  WHEN Estatus_Proceso=1 THEN 'Nuevo'
                  WHEN Estatus_Proceso=2 THEN 'Seguimiento' 
                  WHEN Estatus_Proceso=3 THEN 'Por Calificar'
                  WHEN Estatus_Proceso=4 THEN 'Cerrado'
                ELSE 'Pendiente'
              END  estado,
              CASE 
                  WHEN ac.realiza=0 THEN 'Interno'
                  WHEN ac.realiza=1 THEN 'Externo'                   
                ELSE 'S/R'
              END  realiza  
          FROM siga_actividades ac
          LEFT JOIN siga_solicitud_tickets tk ON ac.Id_Actividad=tk.Id_Actividad
          LEFT JOIN siga_activos activos ON activos.Id_Activo = ac.Id_Activo
          WHERE Tipo_Actividad = 2
          AND ac.Id_Area = $Id_area
          AND ac.Estatus_Reg in (1,2)
          AND YEAR(ac.Fecha_Programada) = $agnio_vigente
          ";

          if($id_activo != -1){
            $sql.=" AND activos.Id_Activo         = $id_activo";
          }

          if($mes_vigente != -1){
            $sql.=" AND MONTH(ac.Fecha_Programada) = $mes_vigente";
          }          


          if($ubi_primaria_calendario != -1){
            $sql.=" AND activos.Id_Ubic_Prim      = $ubi_primaria_calendario";
          }

          if($ubi_Secundaria_calendario != null){
            $sql.=" AND activos.Id_Ubic_Sec       = $ubi_Secundaria_calendario";
          }

           $sql.=" ORDER BY Fecha_Programada DESC";
  //$utilClass->fnlog($sql);

  $sqlPrepare = $pdo->prepare($sql);
  $sqlPrepare->execute();
  $info = $sqlPrepare->fetchall(PDO::FETCH_NAMED);

    $pdo=null;

  return $info;
}


}