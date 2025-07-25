<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/connect/conectar.class.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/admin/utilerias/util.class.php");
include_once(dirname(__FILE__)."/../../../../modelos/activos/dto/siga_v_empleados_activo_fijo/Siga_v_empleados_activo_fijoDTO.Class.php");
include_once(dirname(__FILE__)."/../../../../controladores/activos/siga_v_empleados_activo_fijo/Siga_v_empleados_activo_fijoController.Class.php");
include_once(dirname(__FILE__)."/../../../../controladores/activos/siga_reubicacion_activo/Siga_reubicacion_activoController.Class.php");
//================================================================================================================================================================================
class reubicacion extends conectar{
//================================================================================================================================================================================

  function ok(){
    return 'ok';
  }
  
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  function reUbicacionDeActivo(
    $Id_Usuario_Sesion,
    $Id_Activo,
    $Id_Area,
    $Id_Ubic_Prim,
    $Id_Ubic_Sec,
    $Ubic_Especifica,
    $Centro_Costos_assist,
    $cmbestatusreubicacionguar,
    $Id_Usuario_Responsable,
    $Motivo_Reubicacion,
    $Comentarios_Reubicacion,
    $No_Empleado_Solicitante
  ) {
      try {
            $pdo = conectar::ConexionGestafSiga();
            $utilClass = new util();

            // Consultar información del activo
            $sql01 = "SELECT AF_BC, Nombre_Activo, Id_Ubic_Prim, Id_Ubic_Sec, ISNULL(Especifica, '') AS Especifica, Num_Empleado, Nombre_Completo, Id_Situacion_Activo, 
                        ISNULL((SELECT Centro_Costos FROM siga_activos_contabilidad WHERE Id_Activo = sa.Id_Activo), '') AS Centro_Costos 
                        FROM siga_Activos sa WHERE sa.Id_Activo = :Id_Activo";
            $sqlPrepare01 = $pdo->prepare($sql01);
            $sqlPrepare01->execute([':Id_Activo' => $Id_Activo]);
            $sqlResult01 = $sqlPrepare01->fetch(PDO::FETCH_ASSOC);

            // Consultar información del usuario responsable
            $sql02 = "SELECT No_Usuario, Nombre_Usuario, Correo FROM siga_usuarios WHERE Id_Usuario = :Id_Usuario_Responsable";
            $sqlPrepare02 = $pdo->prepare($sql02);
            $sqlPrepare02->execute([':Id_Usuario_Responsable' => $Id_Usuario_Responsable]);
            $sqlResultResp = $sqlPrepare02->fetch(PDO::FETCH_ASSOC);

            // Consultar información del solicitante
            $sqlsol = "SELECT No_Usuario, Nombre_Usuario, Correo FROM siga_usuarios WHERE Id_Usuario = :No_Empleado_Solicitante";
            $sqlPrepareSol = $pdo->prepare($sqlsol);
            $sqlPrepareSol->execute([':No_Empleado_Solicitante' => $No_Empleado_Solicitante]);
            $sqlResultSol = $sqlPrepareSol->fetch(PDO::FETCH_ASSOC);

            // Consultar información del jefe de área
            $sql07 = "SELECT Num_Empleado, Nombre, Correo FROM siga_jefe_area WHERE Id_Area = :Id_Area";
            $sqlPrepare07 = $pdo->prepare($sql07);
            $sqlPrepare07->execute([':Id_Area' => $Id_Area]);
            $sqlResultJefeArea = $sqlPrepare07->fetch(PDO::FETCH_ASSOC);

            // Actualizar información del activo
            $sql03 = "UPDATE siga_Activos 
                        SET Id_Area = :Id_Area, Id_Ubic_Prim = :Id_Ubic_Prim, Id_Ubic_Sec = :Id_Ubic_Sec, Id_Situacion_Activo = :cmbestatusreubicacionguar,
                            Especifica = :Ubic_Especifica, Num_Empleado = :No_Usuario, Nombre_Completo = :Nombre_Usuario, Fech_Mod = GETDATE(), Usr_Mod = :Id_Usuario_Sesion
                        WHERE Id_Activo = :Id_Activo";
            $sqlPrepare03 = $pdo->prepare($sql03);

            // Actualizar centro de costos
            $sql04 = "UPDATE siga_activos_contabilidad SET Centro_Costos = :Centro_Costos_assist WHERE Id_Activo = :Id_Activo";
            $sqlPrepare04 = $pdo->prepare($sql04);

            // Insertar reubicación del activo
            $sql05 = "INSERT INTO siga_reubicacion_activo 
                        (Id_Activo, Id_Area, Id_Ubic_Prim, Id_Ubic_Sec, Ubic_Especifica, Id_Usuario_Responsable, Nom_Usuario_Reponsable, Jefe_Area, Motivo_Reubicacion, Comentarios_Reubicacion, Fech_Inser, Usr_Inser, Estatus_Reg, Centro_Costos, Id_Estatus_Activo, No_Empleado_Solicitante) 
                        VALUES (:Id_Activo, :Id_Area, :Id_Ubic_Prim, :Id_Ubic_Sec, :Ubic_Especifica, :No_Usuario, :Nombre_Usuario, :Jefe_Area, :Motivo_Reubicacion, :Comentarios_Reubicacion, GETDATE(), :Id_Usuario_Sesion, 1, :Centro_Costos_assist, :cmbestatusreubicacionguar, :No_Empleado_Solicitante)";
            $sqlPrepare05 = $pdo->prepare($sql05);

            $pdo->beginTransaction();

            $sqlPrepare05->execute([
                ':Id_Activo' => $Id_Activo,
                ':Id_Area' => $Id_Area,
                ':Id_Ubic_Prim' => $Id_Ubic_Prim,
                ':Id_Ubic_Sec' => $Id_Ubic_Sec,
                ':Ubic_Especifica' => $Ubic_Especifica,
                ':No_Usuario' => $sqlResultResp['No_Usuario'],
                ':Nombre_Usuario' => $sqlResultResp['Nombre_Usuario'],
                ':Jefe_Area' => $sqlResultJefeArea['Nombre'],
                ':Motivo_Reubicacion' => $Motivo_Reubicacion,
                ':Comentarios_Reubicacion' => $Comentarios_Reubicacion,
                ':Id_Usuario_Sesion' => $Id_Usuario_Sesion,
                ':Centro_Costos_assist' => $Centro_Costos_assist,
                ':cmbestatusreubicacionguar' => $cmbestatusreubicacionguar,
                ':No_Empleado_Solicitante' => $sqlResultSol['No_Usuario']
            ]);

            $id_reubicacion_activo = $pdo->lastInsertId();

            $sqlPrepare03->execute([
                ':Id_Area' => $Id_Area,
                ':Id_Ubic_Prim' => $Id_Ubic_Prim,
                ':Id_Ubic_Sec' => $Id_Ubic_Sec,
                ':cmbestatusreubicacionguar' => $cmbestatusreubicacionguar,
                ':Ubic_Especifica' => $Ubic_Especifica,
                ':No_Usuario' => $sqlResultResp['No_Usuario'],
                ':Nombre_Usuario' => $sqlResultResp['Nombre_Usuario'],
                ':Id_Usuario_Sesion' => $Id_Usuario_Sesion,
                ':Id_Activo' => $Id_Activo
            ]);

            $sqlPrepare04->execute([
                ':Centro_Costos_assist' => $Centro_Costos_assist,
                ':Id_Activo' => $Id_Activo
            ]);

            $pdo->commit();

            // Insertar histórico de reubicación
            $CentroCostos = $sqlResult01['Centro_Costos'] ?: null;
            $No_Empleado_Resguardo = $sqlResult01['Num_Empleado'] ?: null;

            $sql06 = "INSERT INTO siga_historico_reubicacion 
                        (Id_Activo_Reubicacion, Id_Activo, Id_Area, Id_Estatus_Activo, Centro_Costos, Id_Ubic_Prim, Id_Ubic_Sec, Ubic_Especifica, FechaReubicacion, Id_Usuario, Responsable_Activo_Procedencia, id_responsable_procedencia, estatus_registro) 
                        VALUES (:Id_Activo_Reubicacion, :Id_Activo, :Id_Area, :Id_Estatus_Activo, :Centro_Costos, :Id_Ubic_Prim, :Id_Ubic_Sec, :Ubic_Especifica, GETDATE(), :Id_Usuario_Sesion, :Responsable_Activo_Procedencia, :id_responsable_procedencia, 1)";
            $sqlPrepare06 = $pdo->prepare($sql06);

            $sqlPrepare06->execute([
                ':Id_Activo_Reubicacion' => $id_reubicacion_activo,
                ':Id_Activo' => $Id_Activo,
                ':Id_Area' => $Id_Area,
                ':Id_Estatus_Activo' => $sqlResult01['Id_Situacion_Activo'],
                ':Centro_Costos' => $CentroCostos,
                ':Id_Ubic_Prim' => $sqlResult01['Id_Ubic_Prim'],
                ':Id_Ubic_Sec' => $sqlResult01['Id_Ubic_Sec'],
                ':Ubic_Especifica' => $sqlResult01['Especifica'],
                ':Id_Usuario_Sesion' => $Id_Usuario_Sesion,
                ':Responsable_Activo_Procedencia' => $sqlResult01['Nombre_Completo'],
                ':id_responsable_procedencia' => $No_Empleado_Resguardo
            ]);

            // Actualizar reubicación en activos
            $sql08 = "UPDATE siga_Activos SET id_reubicacion = :id_reubicacion_activo, fch_reubicacion = GETDATE() WHERE Id_Activo = :Id_Activo";
            $sqlPrepare08 = $pdo->prepare($sql08);

            $sqlPrepare08->execute([
                ':id_reubicacion_activo' => $id_reubicacion_activo,
                ':Id_Activo' => $Id_Activo
            ]);

            $arrayEmpleadoResponableProc=$this->getemailEmpleados($No_Empleado_Resguardo, $proveedor=null);
            $EmailResponsableProcedencia=$arrayEmpleadoResponableProc[0]->getEmail();
            $NombreResponsableProcedencia=$arrayEmpleadoResponableProc[0]->getNombre_completo();

            
            
            //Alimenta la tabla de workflow de reubicaciones 
            $sqlwkf = "INSERT INTO siga_workflow_reubicacion_activo 
                (CveWorkflow, DescWorflow, FechaAlta, Correo, Aceptado, Id_Reubicacion_Activo, Id_Activo, No_Empleado, Nombre) 
                VALUES 
                (:CveWorkflow1, :DescWorkflow1, GETDATE(), :Correo1, 0, :Id_Reubicacion_Activo1, :Id_Activo1, :No_Empleado1, :Nombre1),
                (:CveWorkflow2, :DescWorkflow2, GETDATE(), :Correo2, 0, :Id_Reubicacion_Activo2, :Id_Activo2, :No_Empleado2, :Nombre2),
                (:CveWorkflow3, :DescWorkflow3, GETDATE(), :Correo3, 0, :Id_Reubicacion_Activo3, :Id_Activo3, :No_Empleado3, :Nombre3),
                (:CveWorkflow4, :DescWorkflow4, GETDATE(), :Correo4, 0, :Id_Reubicacion_Activo4, :Id_Activo4, :No_Empleado4, :Nombre4)";

            $sqlPrepare09 = $pdo->prepare($sqlwkf);
            $sqlPrepare09->execute([
                ':CveWorkflow1' => 1,
                ':DescWorkflow1' => 'Usuario Solicitante',
                ':Correo1' => $sqlResultSol['Correo'],
                ':Id_Reubicacion_Activo1' => $id_reubicacion_activo,
                ':Id_Activo1' => $Id_Activo,
                ':No_Empleado1' => $sqlResultSol['No_Usuario'],
                ':Nombre1' => $sqlResultSol['Nombre_Usuario'],

                ':CveWorkflow2' => 2,
                ':DescWorkflow2' => 'Usuario Responsable Procedencia',
                ':Correo2' => $EmailResponsableProcedencia,
                ':Id_Reubicacion_Activo2' => $id_reubicacion_activo,
                ':Id_Activo2' => $Id_Activo,
                ':No_Empleado2' => $No_Empleado_Resguardo,
                ':Nombre2' => $NombreResponsableProcedencia,

                ':CveWorkflow3' => 3,
                ':DescWorkflow3' => 'Usuario Responsable Final',
                ':Correo3' => $sqlResultResp['Correo'],
                ':Id_Reubicacion_Activo3' => $id_reubicacion_activo,
                ':Id_Activo3' => $Id_Activo,
                ':No_Empleado3' => $sqlResultResp['No_Usuario'],
                ':Nombre3' => $sqlResultResp['Nombre_Usuario'],

                ':CveWorkflow4' => 4,
                ':DescWorkflow4' => 'Responsable Área Gestora',
                ':Correo4' => $sqlResultJefeArea['Correo'],
                ':Id_Reubicacion_Activo4' => $id_reubicacion_activo,
                ':Id_Activo4' => $Id_Activo,
                ':No_Empleado4' => $sqlResultJefeArea['Num_Empleado'],
                ':Nombre4' => $sqlResultJefeArea['Nombre']
            ]);
            //Fin Alimenta la tabla de workflow de reubicaciones 


            //Envia correo de acuerdo al workflow
            $siga_ReubicacionController = new Siga_reubicacion_activoController();
            $siga_ReubicacionController->email_reubicacion_activo($id_reubicacion_activo, 1, null);
            //Fin Envia correo de acuerdo al workflow
            return json_encode($sqlResult01);
      } catch (PDOException $e) {
            $pdo->rollBack();
            $error = 'reubicacion.class.php: ' . $e->getMessage();
            $utilClass->fnlog($error);
            return json_encode(['error' => $error]);
      } finally {
            $pdo = null;
      }
  }


  public function getemailEmpleados($numEmpleadoSolicitante){
	$siga_EmpleadosController = new Siga_v_empleados_activo_fijoController();
	$siga_EmpleadosDto = new Siga_v_empleados_activo_fijoDTO();
	$siga_EmpleadosDto->setNum_empleado($numEmpleadoSolicitante);
	$EmailSolicitante=$siga_EmpleadosController->selectSiga_v_empleados_activo_fijo($siga_EmpleadosDto);
	return $EmailSolicitante;
 }
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


//================================================================================================================================================================================
}
//================================================================================================================================================================================