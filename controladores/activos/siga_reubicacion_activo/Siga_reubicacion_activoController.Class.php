<?php

include_once(dirname(__FILE__)."/../../../modelos/activos/dto/siga_reubicacion_activo/Siga_reubicacion_activoDTO.Class.php");
include_once(dirname(__FILE__)."/../../../modelos/activos/dao/siga_reubicacion_activo/Siga_reubicacion_activoDAO.Class.php");
include_once(dirname(__FILE__)."/../../../datos/connect/Proveedor.Class.php");
include_once(dirname(__FILE__)."/../../../vistas/CURL.php");
class Siga_reubicacion_activoController {
private $proveedor;
public function __construct() {
}
public function validarSiga_reubicacion_activo($Siga_reubicacion_activoDto){
$Siga_reubicacion_activoDto->setId_Activo_Reubicacion(strtoupper(str_ireplace("'","",trim($Siga_reubicacion_activoDto->getId_Activo_Reubicacion()))));
$Siga_reubicacion_activoDto->setId_Area(strtoupper(str_ireplace("'","",trim($Siga_reubicacion_activoDto->getId_Area()))));
$Siga_reubicacion_activoDto->setId_Ubic_Prim(strtoupper(str_ireplace("'","",trim($Siga_reubicacion_activoDto->getId_Ubic_Prim()))));
$Siga_reubicacion_activoDto->setId_Ubic_Sec(strtoupper(str_ireplace("'","",trim($Siga_reubicacion_activoDto->getId_Ubic_Sec()))));
//Cambio Mauricio/Ignacio
$Siga_reubicacion_activoDto->setId_Estatus_Activo(strtoupper(str_ireplace("'","",trim($Siga_reubicacion_activoDto->getId_Estatus_Activo()))));
//Fin Cambio Mauricio/Ignacio
$Siga_reubicacion_activoDto->setId_Usuario_Responsable(strtoupper(str_ireplace("'","",trim($Siga_reubicacion_activoDto->getId_Usuario_Responsable()))));
$Siga_reubicacion_activoDto->setNom_Usuario_Reponsable(strtoupper(str_ireplace("'","",trim($Siga_reubicacion_activoDto->getNom_Usuario_Reponsable()))));
$Siga_reubicacion_activoDto->setCentro_Costos(strtoupper(str_ireplace("'","",trim($Siga_reubicacion_activoDto->getCentro_Costos()))));
$Siga_reubicacion_activoDto->setJefe_Area(strtoupper(str_ireplace("'","",trim($Siga_reubicacion_activoDto->getJefe_Area()))));
$Siga_reubicacion_activoDto->setMotivo_Reubicacion(strtoupper(str_ireplace("'","",trim($Siga_reubicacion_activoDto->getMotivo_Reubicacion()))));
$Siga_reubicacion_activoDto->setComentarios_Reubicacion(strtoupper(str_ireplace("'","",trim($Siga_reubicacion_activoDto->getComentarios_Reubicacion()))));
$Siga_reubicacion_activoDto->setFech_Inser(strtoupper(str_ireplace("'","",trim($Siga_reubicacion_activoDto->getFech_Inser()))));
$Siga_reubicacion_activoDto->setUsr_Inser(strtoupper(str_ireplace("'","",trim($Siga_reubicacion_activoDto->getUsr_Inser()))));
$Siga_reubicacion_activoDto->setFech_Mod(strtoupper(str_ireplace("'","",trim($Siga_reubicacion_activoDto->getFech_Mod()))));
$Siga_reubicacion_activoDto->setUsr_Mod(strtoupper(str_ireplace("'","",trim($Siga_reubicacion_activoDto->getUsr_Mod()))));
$Siga_reubicacion_activoDto->setEstatus_Reg(strtoupper(str_ireplace("'","",trim($Siga_reubicacion_activoDto->getEstatus_Reg()))));
return $Siga_reubicacion_activoDto;
}
public function selectSiga_reubicacion_activo($Siga_reubicacion_activoDto,$proveedor=null){
$Siga_reubicacion_activoDto=$this->validarSiga_reubicacion_activo($Siga_reubicacion_activoDto);
$Siga_reubicacion_activoDao = new Siga_reubicacion_activoDAO();
$Siga_reubicacion_activoDto = $Siga_reubicacion_activoDao->selectSiga_reubicacion_activo($Siga_reubicacion_activoDto,$proveedor);
return $Siga_reubicacion_activoDto;
}

public function email_reubicacion_activo($id_reubicacion_activo, $CveWorkFlow, $proveedor=null){
	$html_mail= file_get_contents(dirname(__FILE__).'/../../../datos/mail/correosigareubicacionworflow.html');		
	
	$sql="
        select 
			top 1 
            wa.Id_Workflow_Reubicacion_Activo,
			wa.Id_Reubicacion_Activo, 
            wa.Id_Activo,
			sa.AF_BC, sa.Nombre_Activo,
			ca.Nom_Area,
			up.Desc_Ubic_Prim, 
			us.Desc_Ubic_Sec,
			sa.Especifica,
			cc.Desc_Centro_de_costos,
			su.Nombre_Usuario as Usuario_Solicitante,
			sce.Desc_Estatus,
			sra.Nom_Usuario_Reponsable,
			sra.Motivo_Reubicacion,
			sra.Comentarios_Reubicacion,
			wa.CveWorkflow, 
            wa.DescWorflow, 
            rtrim(ltrim(wa.Correo)) as Correo, 
            wa.Nombre, 
            No_Empleado, 
			DescCorta, sa.Marca, sa.Modelo, sa.NumSerie, p.Desc_Propiedad
		from 
			siga_workflow_reubicacion_activo wa
				left join siga_reubicacion_activo sra on sra.Id_Activo_Reubicacion=wa.Id_Reubicacion_Activo
				left join siga_activos sa on sra.Id_Activo=sa.Id_Activo 
				left join siga_cat_ubic_prim up on up.Id_Ubic_Prim=sra.Id_Ubic_Prim
				left join siga_cat_ubic_sec us on us.Id_Ubic_Sec=sra.Id_Ubic_Sec
				left join siga_cat_propiedad p on p.Id_Propiedad=sa.Id_Propiedad
				left join siga_catareas ca on ca.Id_Area=sra.Id_Area
				left join siga_cat_centro_de_costos cc on cc.Id_Centros_de_costos=sra.Centro_Costos
				left join siga_usuarios su on su.No_Usuario=sra.No_Empleado_Solicitante
				left join siga_cat_estatus sce on sce.Id_Estatus=sra.Id_Estatus_Activo
		where wa.Id_Reubicacion_Activo=".$id_reubicacion_activo." and CveWorkflow=".$CveWorkFlow.";
	";
    //echo $sql;
    $proveedor_det = new Proveedor('sqlserver', 'activos');
	$proveedor_det->connect();
	$proveedor_det->execute($sql);
	if (!$proveedor_det->error()){
		if ($proveedor_det->rows($proveedor_det->stmt) > 0) {
			while ($row = $proveedor_det->fetch_array($proveedor_det->stmt, 0)) {
				$Area=$row["Nom_Area"];
				$AFBC=$row["AF_BC"];
                $Id_Activo=rtrim(ltrim($row["Id_Activo"]));
                $Activo=rtrim(ltrim($row["Nombre_Activo"]));
                $UbicPri=$row["Desc_Ubic_Prim"];
				$UbicSec=$row["Desc_Ubic_Sec"];
                $UbicEsp=$row["Especifica"];
                $CentroCostos=$row["Desc_Centro_de_costos"];
                $Usuario_Solicitante=$row["Usuario_Solicitante"];
                $Estatus=$row["Desc_Estatus"];
                $Nom_Usuario_Reponsable=$row["Nom_Usuario_Reponsable"];
                $Motivo_Reubicacion=$row["Motivo_Reubicacion"];
                $Comentarios_Reubicacion=$row["Comentarios_Reubicacion"];

                $CveWorkflow=$row["CveWorkflow"];
				$Correo=$row["Correo"];
				$NombreEmail=$row["Nombre"];
				$Id_Reubicacion_Activo=$row["Id_Reubicacion_Activo"];
                $Id_Workflow_Reubicacion_Activo=$row["Id_Workflow_Reubicacion_Activo"];
				
				$ruta= "https://apps2.hospitalsatelite.com/SIGA";
			    $html_mail = str_replace("#Area#",$Area,$html_mail);
				$html_mail = str_replace("#AFBC#",$AFBC,$html_mail);
                $html_mail = str_replace("#ACTIVO#",$Activo,$html_mail);
                $html_mail = str_replace("#Ubic_Prim#",$UbicPri,$html_mail);
				$html_mail = str_replace("#Ubic_Sec#",$UbicSec,$html_mail);
                $html_mail = str_replace("#Ubic_Esp#",$UbicEsp,$html_mail);
                $html_mail = str_replace("#Centro_Costos#",$CentroCostos,$html_mail);
                $html_mail = str_replace("#Usuario_Solicitante#",$Usuario_Solicitante,$html_mail);
                $html_mail = str_replace("#Estatus#",$Estatus,$html_mail);
                $html_mail = str_replace("#Usuario_Resguardo#",$Nom_Usuario_Reponsable,$html_mail);
                $html_mail = str_replace("#Motivo_Reubicacion#",$Motivo_Reubicacion,$html_mail);
                $html_mail = str_replace("#Comentarios_Reubicacion#",$Comentarios_Reubicacion,$html_mail);

				$html_mail = str_replace("#Id_Reubicacion_Activo#",$Id_Reubicacion_Activo,$html_mail);
				$html_mail = str_replace("#Id_Workflow_Reubicacion_Activo#",$Id_Workflow_Reubicacion_Activo,$html_mail);
				$html_mail = str_replace("#RUTA#",$ruta,$html_mail);
				$html_mail = str_replace("#PASO#",$CveWorkflow,$html_mail);
				$html_mail = str_replace("#USER#",$NombreEmail,$html_mail);
                
                $html_mail=str_replace("á", "a|", $html_mail);
				$html_mail=str_replace("Á", "A|", $html_mail);
				$html_mail=str_replace("é", "e|", $html_mail);
				$html_mail=str_replace("É", "E|", $html_mail);
				$html_mail=str_replace("í", "i|", $html_mail);
				$html_mail=str_replace("Í", "I|", $html_mail);
				$html_mail=str_replace("ó", "o|", $html_mail);
				$html_mail=str_replace("Ó", "O|", $html_mail);
				$html_mail=str_replace("ú", "u|", $html_mail);
				$html_mail=str_replace("Ú", "U|", $html_mail);
				$html_mail=str_replace("ñ", "n|", $html_mail);
				$html_mail=str_replace("Ñ", "N|", $html_mail);
						
				//$html_mail.="<br>";
				//$html_mail.="<br>";		
				//$html_mail.=$Correo;
				//$html_mail.="<br>";
				$obj = new CURL();
				$url = "http://207.249.133.119:8080/envio_correo_externo/send_external_email.asp";
				//Productivo
				  $data = array('strPassword' => 'C68H17S49', 'strSubject' => "Reubicacion del Activo (".$Activo.")",'strTo'=>$Correo,'strHTMLBody'=>$html_mail,'strCc'=>'','strBCC'=>'jtalon@hospitalsatelite.com');
				//Pruebas
				//$data = array('strPassword' => 'C68H17S49', 'strSubject' => "Reubicacion del Activo (".$Activo.")",'strTo'=>'jtalon@hospitalsatelite.com','strHTMLBody'=>$html_mail,'strCc'=>'','strBCC'=>'jtalon@hospitalsatelite.com');
                $correoASP = $obj->curlData($url,$data);
				return $data;
			}
		}
	}
		
	$proveedor->close();
	
}

public function workflow_reubicacion($Aceptado, $Id_Workflow_Reubicacion_Activo, $Paso){
	$proveedor = new Proveedor('sqlserver', 'activos');
	$proveedor->connect();
	$sql="UPDATE siga_workflow_reubicacion_activo SET Aceptado=".$Aceptado.", FechaAceptado=getdate() ";
	$sql.="where Id_Workflow_Reubicacion_Activo= ".$Id_Workflow_Reubicacion_Activo;
	$error=false;
	$proveedor->execute($sql);
	if (!$proveedor->error()){
        if($Aceptado!=2){
            $proveedor2 = new Proveedor('sqlserver', 'activos');
            $proveedor2->connect();
            $sql="
                select 
                    top 1
                    (".$Paso."+1) as siguiente_paso,
                    * 
                from 
                    siga_workflow_reubicacion_activo 
                where 
                    Id_Reubicacion_Activo=(select Id_Reubicacion_Activo from siga_workflow_reubicacion_activo where Id_Workflow_Reubicacion_Activo=".$Id_Workflow_Reubicacion_Activo.") 
                    and CveWorkflow=(".$Paso."+1)   
            ";
            $proveedor2->execute($sql);
            if (!$proveedor2->error()){
                if ($proveedor2->rows($proveedor2->stmt) > 0) {
                    while ($row_c = $proveedor2->fetch_array($proveedor2->stmt, 0)) {
                        $Sig_Paso=$row_c["siguiente_paso"];
                        $Id_Reubicacion_Activo=$row_c["Id_Reubicacion_Activo"];
                        $this->email_reubicacion_activo($Id_Reubicacion_Activo, $Sig_Paso, $proveedor2);
                        return true;
                    }
                }
            }else{
                $error=true;
                return false;
            }
            $proveedor2->close();
        }else{
			return true;
		}    
	}else{
		$error=true;
		return false;
	}

	$proveedor->close();
	return true;
}


public function getworkflow_reubicacion($Id_Activo_Reubicacion,$proveedor=null){
    $respuesta = array();
	$Data = array();
	$Data_Envia = array();
	$error=false;

	$proveedor = new Proveedor('sqlserver', 'activos');
	$proveedor->connect();
	$sql="
        select 
			wa.Id_Workflow_Reubicacion_Activo,
			wa.CveWorkflow, 
			wa.DescWorflow,
			wa.FechaAlta,
			wa.Correo,
			wa.Aceptado,
			wa.Id_Reubicacion_Activo,
			wa.Id_Activo,
			wa.No_Empleado,
			wa.Nombre,
			wa.FechaAceptado,
			wa.Comentarios
		from 
			siga_workflow_reubicacion_activo wa
		where wa.Id_Reubicacion_Activo=".$Id_Activo_Reubicacion." order by CveWorkflow asc
    
    ";
	$proveedor->execute($sql);
	if (!$proveedor->error()) {
		if ($proveedor->rows($proveedor->stmt) > 0) {
			while ($row = $proveedor->fetch_array($proveedor->stmt, 0)) {
				$Data= array(		
					"Id_Workflow_Reubicacion_Activo"=>$row["Id_Workflow_Reubicacion_Activo"],
					"CveWorkflow" => rtrim(ltrim($row["CveWorkflow"])),
					"DescWorflow" => rtrim(ltrim($row["DescWorflow"])),
					"FechaAlta" => rtrim(ltrim($row["FechaAlta"])),
					"Correo" => rtrim(ltrim($row["Correo"])),
					"Aceptado" => rtrim(ltrim($row["Aceptado"])),
					"Id_Reubicacion_Activo" => rtrim(ltrim($row["Id_Reubicacion_Activo"])),
					"Id_Activo" => rtrim(ltrim($row["Id_Activo"])),
                    "No_Empleado" => rtrim(ltrim($row["No_Empleado"])),
                    "Nombre" => rtrim(ltrim($row["Nombre"])),
                    "FechaAceptado" => rtrim(ltrim($row["FechaAceptado"])),
                    "Comentarios" => rtrim(ltrim($row["Comentarios"]))
				);
				array_push($Data_Envia, $Data);
            }
		}
	}else{
		$error=true;
	}
	$proveedor->close();
	
	//Fin 
	if($error==false){
		$respuesta = array("totalCount" => count($Data_Envia), "data" => $Data_Envia, "estatus" => "ok", "mensaje" => "Registros Encontrados");   	
	}else{
		$respuesta = array("totalCount" => "0", "data" => "", "estatus" => "error", "mensaje" => "Ocurrio un Error al Buscar");   	
	}
	
	return $respuesta;
}

public function insertSiga_reubicacion_activo($Siga_reubicacion_activoDto,$proveedor=null){
//$Siga_reubicacion_activoDto=$this->validarSiga_reubicacion_activo($Siga_reubicacion_activoDto);
$Siga_reubicacion_activoDao = new Siga_reubicacion_activoDAO();
$Siga_reubicacion_activoDto = $Siga_reubicacion_activoDao->insertSiga_reubicacion_activo($Siga_reubicacion_activoDto,$proveedor);
return $Siga_reubicacion_activoDto;
}
public function updateSiga_reubicacion_activo($Siga_reubicacion_activoDto,$proveedor=null){
//$Siga_reubicacion_activoDto=$this->validarSiga_reubicacion_activo($Siga_reubicacion_activoDto);
$Siga_reubicacion_activoDao = new Siga_reubicacion_activoDAO();
//$tmpDto = new Siga_reubicacion_activoDTO();
//$tmpDto = $Siga_reubicacion_activoDao->selectSiga_reubicacion_activo($Siga_reubicacion_activoDto,$proveedor);
//if($tmpDto!=""){//$Siga_reubicacion_activoDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
$Siga_reubicacion_activoDto = $Siga_reubicacion_activoDao->updateSiga_reubicacion_activo($Siga_reubicacion_activoDto,$proveedor);
return $Siga_reubicacion_activoDto;
//}
//return "";
}
public function deleteSiga_reubicacion_activo($Siga_reubicacion_activoDto,$proveedor=null){
//$Siga_reubicacion_activoDto=$this->validarSiga_reubicacion_activo($Siga_reubicacion_activoDto);
$Siga_reubicacion_activoDao = new Siga_reubicacion_activoDAO();
$Siga_reubicacion_activoDto = $Siga_reubicacion_activoDao->deleteSiga_reubicacion_activo($Siga_reubicacion_activoDto,$proveedor);
return $Siga_reubicacion_activoDto;
}
}
?>