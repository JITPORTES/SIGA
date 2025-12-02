<?php
	include_once(dirname(__FILE__)."/../../../modelos/activos/dto/siga_activos/Siga_activosDTO.Class.php");
	include_once(dirname(__FILE__)."/../../../modelos/activos/dao/siga_activos/Siga_activosDAO.Class.php");
	include_once(dirname(__FILE__)."/../../../modelos/activos/dto/siga_v_empleados_activo_fijo/Siga_v_empleados_activo_fijoDTO.Class.php");
	include_once(dirname(__FILE__)."/../../../controladores/activos/siga_v_empleados_activo_fijo/Siga_v_empleados_activo_fijoController.Class.php");
	include_once(dirname(__FILE__)."/../../../datos/connect/Proveedor.Class.php");
	include_once(dirname(__FILE__)."/../../../vistas/CURL.php");

	class Siga_activosController {
		private $proveedor;
		public function __construct() {
		}


		public function validarSiga_activos($Siga_activosDto) {
			$Siga_activosDto->setId_Activo(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getId_Activo()))));
			$Siga_activosDto->setAF_BC(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getAF_BC()))));
			$Siga_activosDto->setNombre_Activo(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getNombre_Activo()))));
			$Siga_activosDto->setId_Tipo_Vale_Resg(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getId_Tipo_Vale_Resg()))));
			$Siga_activosDto->setMant_Prevent(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getMant_Prevent()))));
			$Siga_activosDto->setId_Area(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getId_Area()))));
			$Siga_activosDto->setId_Departamento(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getId_Departamento()))));
			$Siga_activosDto->setNum_Empleado(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getNum_Empleado()))));
			//$Siga_activosDto->setNombre_Completo(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getNombre_Completo()))));
			$Siga_activosDto->setFech_Inser(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getFech_Inser()))));
			$Siga_activosDto->setUsr_Inser(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getUsr_Inser()))));
			$Siga_activosDto->setFech_Mod(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getFech_Mod()))));
			$Siga_activosDto->setUsr_Mod(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getUsr_Mod()))));
			$Siga_activosDto->setEstatus_Reg(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getEstatus_Reg()))));
			//$Siga_activosDto->setFoto(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getFoto()))));
			$Siga_activosDto->setId_Clase(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getId_Clase()))));
			$Siga_activosDto->setId_Clasificacion(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getId_Clasificacion()))));
			$Siga_activosDto->setId_Propiedad(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getId_Propiedad()))));
			$Siga_activosDto->setId_Tipo_Activo(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getId_Tipo_Activo()))));
			$Siga_activosDto->setDescCorta(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getDescCorta()))));
			$Siga_activosDto->setDescLarga(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getDescLarga()))));
			$Siga_activosDto->setId_Ubic_Prim(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getId_Ubic_Prim()))));
			$Siga_activosDto->setId_Ubic_Sec(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getId_Ubic_Sec()))));
			$Siga_activosDto->setId_Situacion_Activo(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getId_Situacion_Activo()))));
			$Siga_activosDto->setId_Motivo_Alta(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getId_Motivo_Alta()))));
			$Siga_activosDto->setId_Familia(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getId_Familia()))));
			$Siga_activosDto->setId_Subfamilia(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getId_Subfamilia()))));
			$Siga_activosDto->setMarca(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getMarca()))));
			$Siga_activosDto->setModelo(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getModelo()))));
			$Siga_activosDto->setNumSerie(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getNumSerie()))));
			$Siga_activosDto->setId_ActivoPadre(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getId_ActivoPadre()))));
			$Siga_activosDto->setNumActivoAnterior(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getNumActivoAnterior()))));
			$Siga_activosDto->setParticipaPre(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getParticipaPre()))));
			$Siga_activosDto->setParticipaSeguros(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getParticipaSeguros()))));
			$Siga_activosDto->setImporteSeguros(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getImporteSeguros()))));
			$Siga_activosDto->setParticipaCertificacion(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getParticipaCertificacion()))));
			$Siga_activosDto->setGarantia(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getGarantia()))));
			$Siga_activosDto->setExtGarantia(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getExtGarantia()))));
			$Siga_activosDto->setAnexo(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getAnexo()))));
			$Siga_activosDto->setEspecifica(strtoupper(str_ireplace("'","",trim($Siga_activosDto->getEspecifica()))));
			return $Siga_activosDto;
		}


		
		// <SUMMARY>Obtiene una lista de Activos única para realizar un filtro y generar reportes</SUMMARY>
		public function filtro_afbc($Id_Area, $Seccion, $proveedor = null) {
			$respuesta = array();
			$Data = array();
			$Data_Envia = array();
			$error = false;

			$proveedor = new Proveedor('sqlserver', 'activos');
			$proveedor->connect();
			$sql = "SELECT  distinct S.AF_BC FROM siga_activos S WHERE 0=0 AND S.Estatus_Reg<>'3' AND S.AF_BC IS NOT NULL AND S.AF_BC <> '' ";
			if($Seccion == "Activos") {
				$sql.="	AND  S.Id_Activo not in (select Id_Activo from siga_baja_activo where Estatus_Cancelacion<>1)";
			}
			if($Id_Area != "") {
				$sql .= " AND S.Id_Area=".$Id_Area;
			}
			$sql .= " ORDER BY AF_BC ASC";
			
			//echo $sql;
			$proveedor->execute($sql);
			if (!$proveedor->error()) {
				if ($proveedor->rows($proveedor->stmt) > 0) {
					while ($row = $proveedor->fetch_array($proveedor->stmt, 0)) {
						$Data= array("AF_BC"=>$row["AF_BC"]);
						array_push($Data_Envia, $Data);
					}
				}
			}
			else {
				$error=true;
			}
			$proveedor->close();
			//Fin 
			if($error == false) {
				$respuesta = array("totalCount" => count($Data_Envia), "data" => $Data_Envia, "estatus" => "ok", "mensaje" => "Registros Encontrados");
			}
			else {
				$respuesta = array("totalCount" => "0", "data" => "", "estatus" => "error", "mensaje" => "Ocurrio un Error al Buscar");   	
			}
			return $respuesta;
		}


		// <SUMMARY>Obtiene una lista de Clasificación única para realizar un filtro y generar reportes</SUMMARY>
		public function filtro_clasificacion($Id_Area, $Seccion, $proveedor = null) {
			$respuesta = array();	
			$Data = array();
			$Data_Envia = array();
			$error=false;

			$proveedor = new Proveedor('sqlserver', 'activos');
			$proveedor->connect();
			$sql = "SELECT  distinct   C.Desc_Clasificacion
						FROM siga_activos S 
						left join siga_cat_clasificacion C on S.Id_Clasificacion=C.Id_Clasificacion
						where 0=0 and S.Estatus_Reg<>'3' and S.Id_Clasificacion is not null and S.Id_Clasificacion<>'' ";
			if($Seccion == "Activos"){
				$sql .= " AND S.Id_Activo not in (select Id_Activo from siga_baja_activo where Estatus_Cancelacion<>1) ";
			}
			if($Id_Area!=""){
				$sql .= " and S.Id_Area=" . $Id_Area;
			}
			$sql .= " order by Desc_Clasificacion asc";
			
			
			//echo $sql;
			$proveedor->execute($sql);
			if (!$proveedor->error()) {
				if ($proveedor->rows($proveedor->stmt) > 0) {
					while ($row = $proveedor->fetch_array($proveedor->stmt, 0)) {
						$Data= array("Desc_Clasificacion"=>$row["Desc_Clasificacion"]);
						array_push($Data_Envia, $Data);
					}
				}
			}
			else {
				$error=true;
			}
			$proveedor->close();
			
			//Fin 
			if($error == false) {
				$respuesta = array("totalCount" => count($Data_Envia), "data" => $Data_Envia, "estatus" => "ok", "mensaje" => "Registros Encontrados");   	
			}
			else {
				$respuesta = array("totalCount" => "0", "data" => "", "estatus" => "error", "mensaje" => "Ocurrio un Error al Buscar");   	
			}
			return $respuesta;
		}


		// <SUMMARY>Obtiene una lista por Marcas única para realizar un filtro y generar reportes</SUMMARY>
		public function filtro_marca($Id_Area, $Seccion, $proveedor = null) {
			$respuesta = array();
			$Data = array();
			$Data_Envia = array();
			$error = false;

			$proveedor = new Proveedor('sqlserver', 'activos');
			$proveedor->connect();
			$sql = "SELECT DISTINCT rtrim(ltrim(S.Marca)) AS Marca
						FROM siga_activos S
						WHERE 0=0  AND S.Estatus_Reg<>'3' AND S.Marca IS NOT NULL AND S.Marca <> '' ";
			if($Seccion == "Activos") {
				$sql .= " AND S.Id_Activo NOT IN (SELECT Id_Activo FROM siga_baja_activo WHERE Estatus_Cancelacion <> 1) ";
			}
			if($Id_Area != "") {
				$sql .= " AND S.Id_Area=".$Id_Area;
			}
			$sql .= " ORDER BY Marca ASC ";
			//echo $sql;

			$proveedor->execute($sql);
			if (!$proveedor->error()) {
				if ($proveedor->rows($proveedor->stmt) > 0) {
					while ($row = $proveedor->fetch_array($proveedor->stmt, 0)) {
						$Data= array("Marca"=>$row["Marca"]);
						array_push($Data_Envia, $Data);
					}
				}
			}
			else {
				$error=true;
			}
			$proveedor->close();
			//Fin 
			if($error == false) {
				$respuesta = array("totalCount" => count($Data_Envia), "data" => $Data_Envia, "estatus" => "ok", "mensaje" => "Registros Encontrados");   	
			}
			else {
				$respuesta = array("totalCount" => "0", "data" => "", "estatus" => "error", "mensaje" => "Ocurrio un Error al Buscar");   	
			}
			return $respuesta;
		}

		
		// <SUMMARY>Obtiene una lista por Propiedad única para realizar un filtro y generar reportes</SUMMARY>
		public function filtro_propiedad($Id_Area, $Seccion, $proveedor = null) {
			$respuesta = array();	
			$Data = array();
			$Data_Envia = array();
			$error=false;

			$proveedor = new Proveedor('sqlserver', 'activos');
			$proveedor->connect();
			$sql = " SELECT  distinct P.Id_Propiedad, Desc_Propiedad
						FROM siga_activos S   
						LEFT JOIN siga_cat_propiedad P ON S.Id_Propiedad=S.Id_Propiedad
						WHERE 0=0 AND S.Estatus_Reg<>'3' AND S.Id_Propiedad IS NOT NULL AND S.Id_Propiedad <> '' ";
			if($Seccion == "Activos") {
				$sql .= " AND S.Id_Activo NOT IN (SELECT Id_Activo FROM siga_baja_activo WHERE Estatus_Cancelacion <> 1) ";
			}
			if($Id_Area != "") {
				$sql .= " AND S.Id_Area = ".$Id_Area;
			}
			$sql .= " ORDER BY Desc_Propiedad ASC";
			//echo $sql;

			$proveedor->execute($sql);
			if (!$proveedor->error()) {
				if ($proveedor->rows($proveedor->stmt) > 0) {
					while ($row = $proveedor->fetch_array($proveedor->stmt, 0)) {
						$Data= array("Id_Propiedad"=>$row["Id_Propiedad"],
							"Desc_Propiedad"=>$row["Desc_Propiedad"]
						);
						array_push($Data_Envia, $Data);
					}
				}
			}
			else {
				$error=true;
			}
			$proveedor->close();

			//Fin 
			if($error == false) {
				$respuesta = array("totalCount" => count($Data_Envia), "data" => $Data_Envia, "estatus" => "ok", "mensaje" => "Registros Encontrados");   	
			}
			else {
				$respuesta = array("totalCount" => "0", "data" => "", "estatus" => "error", "mensaje" => "Ocurrio un Error al Buscar");   	
			}
			return $respuesta;
		}


		// <SUMMARY>Obtiene una lista por Responsable única para realizar un filtro y generar reportes</SUMMARY>
		public function filtro_usr_responsable($Id_Area, $Seccion, $proveedor=null) {
			$respuesta = array();	
			$Data = array();
			$Data_Envia = array();
			$error = false;

			$proveedor = new Proveedor('sqlserver', 'activos');
			$proveedor->connect();
			$sql = "SELECT DISTINCT E.num_empleado, E.nombre_completo
						FROM siga_activos S   
						LEFT JOIN empleados_chs E ON S.Num_Empleado=E.num_empleado
						WHERE 0=0 AND S.Estatus_Reg<>'3' AND S.num_empleado IS NOT NULL AND S.num_empleado <> '' ";
			if($Seccion == "Activos") {
				$sql.="	AND S.Id_Activo NOT IN (SELECT Id_Activo FROM siga_baja_activo WHERE Estatus_Cancelacion<>1) ";
			}
			if($Id_Area != "") {
				$sql .= " AND S.Id_Area=".$Id_Area;
			}
			$sql .= " ORDER BY nombre_completo ASC";
			//echo $sql;

			$proveedor->execute($sql);
			if (!$proveedor->error()) {
				if ($proveedor->rows($proveedor->stmt) > 0) {
					while ($row = $proveedor->fetch_array($proveedor->stmt, 0)) {
						$Data= array("num_empleado"=>$row["num_empleado"],
							"nombre_completo"=>$row["nombre_completo"]
						);
						array_push($Data_Envia, $Data);
					}
				}
			}
			else {
				$error=true;
			}
			
			$proveedor->close();
			//Fin 
			if($error == false) {
				$respuesta = array("totalCount" => count($Data_Envia), "data" => $Data_Envia, "estatus" => "ok", "mensaje" => "Registros Encontrados");   	
			}
			else {
				$respuesta = array("totalCount" => "0", "data" => "", "estatus" => "error", "mensaje" => "Ocurrio un Error al Buscar");   	
			}
			return $respuesta;
		}


		// <SUMMARY>Obtiene una lista por Ubicación Primaria única para realizar un filtro y generar reportes</SUMMARY>
		public function filtro_ubic_prim($Id_Area, $Seccion, $proveedor = null) {
			$respuesta = array();
			$Data = array();
			$Data_Envia = array();
			$error=false;

			$proveedor = new Proveedor('sqlserver', 'activos');
			$proveedor->connect();
			$sql = "SELECT  distinct UP.Id_Ubic_Prim, Desc_Ubic_Prim
						FROM siga_activos S   
						LEFT JOIN siga_cat_ubic_prim UP ON S.Id_Ubic_Prim=UP.Id_Ubic_Prim
						WHERE 0 = 0  AND S.Estatus_Reg <> '3' AND S.Id_Ubic_Prim IS NOT NULL AND S.Id_Ubic_Prim <> '' ";
			if($Seccion == "Activos") {
				$sql .= " AND S.Id_Activo NOT IN (SELECT Id_Activo FROM siga_baja_activo WHERE Estatus_Cancelacion<>1) ";
			}
			if($Id_Area != "") {
				$sql .= " AND S.Id_Area=".$Id_Area; 
			}
			$sql .= " ORDER BY Desc_Ubic_Prim ASC";
			//echo $sql;

			$proveedor->execute($sql);
			if (!$proveedor->error()) {
				if ($proveedor->rows($proveedor->stmt) > 0) {
					while ($row = $proveedor->fetch_array($proveedor->stmt, 0)) {
						$Data= array("Id_Ubic_Prim"=>$row["Id_Ubic_Prim"],
							"Desc_Ubic_Prim"=>$row["Desc_Ubic_Prim"]
						);
						array_push($Data_Envia, $Data);
					}
				}
			}
			else {
				$error = true;
			}
			$proveedor->close();
			
			//Fin 
			if($error == false) {
				$respuesta = array("totalCount" => count($Data_Envia), "data" => $Data_Envia, "estatus" => "ok", "mensaje" => "Registros Encontrados");
			}
			else {
				$respuesta = array("totalCount" => "0", "data" => "", "estatus" => "error", "mensaje" => "Ocurrio un Error al Buscar");
			}
			return $respuesta;
		}


		// <SUMMARY>Obtiene una lista por Ubicación Secundaria única para realizar un filtro y generar reportes</SUMMARY>
		public function filtro_ubic_sec($Id_Area, $Seccion, $proveedor = null) {
			$respuesta = array();
			$Data = array();
			$Data_Envia = array();
			$error = false;

			$proveedor = new Proveedor('sqlserver', 'activos');
			$proveedor->connect();
			$sql = "SELECT DISTINCT Desc_Ubic_Sec
						FROM siga_activos S   
						LEFT JOIN siga_cat_ubic_sec US ON S.Id_Ubic_Sec=US.Id_Ubic_Sec
						WHERE 0=0 AND S.Estatus_Reg<>'3' AND S.Id_Ubic_Sec IS NOT NULL AND S.Id_Ubic_Sec<>'' ";
			if($Seccion == "Activos") {
				$sql .= " AND S.Id_Activo NOT IN (SELECT Id_Activo FROM siga_baja_activo WHERE Estatus_Cancelacion <> 1) ";
			}
			if($Id_Area != "") {
				$sql .= " AND S.Id_Area=" . $Id_Area;
			}
			$sql .= " ORDER BY Desc_Ubic_Sec ASC";
			//echo $sql;

			$proveedor->execute($sql);
			if (!$proveedor->error()) {
				if ($proveedor->rows($proveedor->stmt) > 0) {
					while ($row = $proveedor->fetch_array($proveedor->stmt, 0)) {
						$Data= array(
							"Desc_Ubic_Sec"=>$row["Desc_Ubic_Sec"]
						);
						array_push($Data_Envia, $Data);
					}
				}
			}
			else {
				$error=true;
			}
			$proveedor->close();
			//Fin
			if($error == false) {
				$respuesta = array("totalCount" => count($Data_Envia), "data" => $Data_Envia, "estatus" => "ok", "mensaje" => "Registros Encontrados");
			}
			else {
				$respuesta = array("totalCount" => "0", "data" => "", "estatus" => "error", "mensaje" => "Ocurrio un Error al Buscar");
			}
			return $respuesta;
		}


		// <SUMMARY>Obtiene una lista por Ubicación Secundaria única para realizar un filtro y generar reportes</SUMMARY>
		public function filtro_modelo($Id_Area, $Seccion, $proveedor = null) {
			$respuesta = array();
			$Data = array();
			$Data_Envia = array();
			$error = false;

			$proveedor = new Proveedor('sqlserver', 'activos');
			$proveedor->connect();
			$sql = "SELECT DISTINCT RTRIM(LTRIM(S.Modelo)) AS Modelo
						FROM siga_activos S
						WHERE 0 = 0 AND S.Estatus_Reg<>'3' AND S.Modelo IS NOT NULL AND S.Modelo <> ''";
			if($Seccion == "Activos") {
				$sql .= " AND S.Id_Activo NOT IN (SELECT Id_Activo FROM siga_baja_activo WHERE Estatus_Cancelacion <> 1) ";
			}
			if($Id_Area != "") {
				$sql .= " AND S.Id_Area=" . $Id_Area;
			}
			$sql .= " ORDER BY Modelo ASC";
			//echo $sql;

			$proveedor->execute($sql);
			if (!$proveedor->error()) {
				if ($proveedor->rows($proveedor->stmt) > 0) {
					while ($row = $proveedor->fetch_array($proveedor->stmt, 0)) {
						$Data= array("Modelo"=>$row["Modelo"]);
						array_push($Data_Envia, $Data);
					}
				}
			}
			else {
				$error = true;
			}
			$proveedor->close();
			//Fin
			if($error == false) {
				$respuesta = array("totalCount" => count($Data_Envia), "data" => $Data_Envia, "estatus" => "ok", "mensaje" => "Registros Encontrados");
			}
			else {
				$respuesta = array("totalCount" => "0", "data" => "", "estatus" => "error", "mensaje" => "Ocurrio un Error al Buscar");
			}
			return $respuesta;
		}


		// <SUMMARY>Obtiene una lista por de elementos de acuerdo al campo pasado como parametro para realizar un filtro y generar reportes</SUMMARY>
		public function filtro_generico($Id_Area, $NombreCampo, $Seccion, $FiltroSuperior_AFBC = null, $FiltroSuperior_Nombre = null, $FiltroSuperior_Clasificacion = null, $FiltroSuperior_Marca = null, $FiltroSuperior_Modelo = null, $FiltroSuperior_NumSerie = null, $FiltroSuperior_Propiedad = null, $FiltroSuperior_UsuarioResponsable = null, $FiltroSuperior_UbicacionPrimaria = null, $FiltroSuperior_UbicacionSecundaria = null, $FiltroSuperior_Monto_Factura = null, $FiltroSuperior_ImporteSeguros = null, $FiltroSuperior_Estatus = null, $FiltroSuperior_Clase = null, $FiltroSuperior_MotivoBaja = null, $FiltroSuperior_FechaAlta = null, $FiltroSuperior_Descripcion = null, $FiltroSuperior_UbicacionPrimariaOrigen = null, $FiltroSuperior_UbicacionSecundariaOrigen = null, $FiltroSuperior_Baja_Usr_Solicitante = null, $FiltroSuperior_Baja_Usr_DirFinanciera = null, $FiltroSuperior_Baja_Usr_Contabilidad = null, $FiltroSuperior_EstatusWorkflow_Baja = null, $FiltroSuperior_UbicacionEspecifica = null, $proveedor = null) {
			$respuesta = array();
			$Data = array();
			$Data_Envia = array();
			$error = false;
			$proveedor = new Proveedor('sqlserver', 'activos');
			$proveedor->connect();

			$arrayParametros = [];
			if(isset($Id_Area)) { array_push($arrayParametros, "@Id_Area=" . $Id_Area); }
			if(isset($NombreCampo)) { array_push($arrayParametros, "@NombreCampo='" . $NombreCampo . "'"); }
			if(isset($Seccion)) { array_push($arrayParametros, "@Seccion='" . $Seccion . "'"); }
			if(isset($FiltroSuperior_AFBC)) { array_push($arrayParametros, "@FiltroSuperior_AFBC='" . $FiltroSuperior_AFBC . "'"); }
			if(isset($FiltroSuperior_Nombre)) { array_push($arrayParametros, "@FiltroSuperior_Nombre='" . $FiltroSuperior_Nombre . "'"); }
			if(isset($FiltroSuperior_Clasificacion)) { array_push($arrayParametros, "@FiltroSuperior_Clasificacion='" . $FiltroSuperior_Clasificacion . "'"); }
			if(isset($FiltroSuperior_Marca)) { array_push($arrayParametros, "@FiltroSuperior_Marca='" . $FiltroSuperior_Marca . "'"); }
			if(isset($FiltroSuperior_Modelo)) { array_push($arrayParametros, "@FiltroSuperior_Modelo='" . $FiltroSuperior_Modelo . "'"); }
			if(isset($FiltroSuperior_NumSerie)) { array_push($arrayParametros, "@FiltroSuperior_NumSerie='" . $FiltroSuperior_NumSerie . "'"); }
			if(isset($FiltroSuperior_Propiedad)) { array_push($arrayParametros, "@FiltroSuperior_Propiedad='" . $FiltroSuperior_Propiedad . "'"); }
			if(isset($FiltroSuperior_UsuarioResponsable)) { array_push($arrayParametros, "@FiltroSuperior_UsuarioResponsable='" . $FiltroSuperior_UsuarioResponsable . "'"); }
			if(isset($FiltroSuperior_UbicacionPrimaria)) { array_push($arrayParametros, "@FiltroSuperior_UbicacionPrimaria='" . $FiltroSuperior_UbicacionPrimaria . "'"); }
			if(isset($FiltroSuperior_UbicacionSecundaria)) { array_push($arrayParametros, "@FiltroSuperior_UbicacionSecundaria='" . $FiltroSuperior_UbicacionSecundaria . "'"); }
			if(isset($FiltroSuperior_Monto_Factura)) { array_push($arrayParametros, "@FiltroSuperior_Monto_Factura='" . $FiltroSuperior_Monto_Factura . "'"); }
			if(isset($FiltroSuperior_ImporteSeguros)) { array_push($arrayParametros, "@FiltroSuperior_ImporteSeguros='" . $FiltroSuperior_ImporteSeguros . "'"); }
			if(isset($FiltroSuperior_Estatus)) { array_push($arrayParametros, "@FiltroSuperior_Estatus='" . $FiltroSuperior_Estatus . "'"); }
			if(isset($FiltroSuperior_FechaAlta)) { array_push($arrayParametros, "@FiltroSuperior_FechaAlta='" . $FiltroSuperior_FechaAlta . "'"); }
			if(isset($FiltroSuperior_Descripcion)) { array_push($arrayParametros, "@FiltroSuperior_Descripcion='" . $FiltroSuperior_Descripcion . "'"); }
			
			// Filtros especificos en Bajas
			if(isset($FiltroSuperior_Clase)) { array_push($arrayParametros, "@FiltroSuperior_Clase='" . $FiltroSuperior_Clase . "'"); }
			if(isset($FiltroSuperior_MotivoBaja)) { array_push($arrayParametros, "@FiltroSuperior_MotivoBaja='" . $FiltroSuperior_MotivoBaja . "'"); }
			if(isset($FiltroSuperior_Baja_Usr_Solicitante)) { array_push($arrayParametros, "@FiltroSuperior_Baja_Usr_Solicitante='" . $FiltroSuperior_Baja_Usr_Solicitante . "'"); }
			if(isset($FiltroSuperior_Baja_Usr_DirFinanciera)) { array_push($arrayParametros, "@FiltroSuperior_Baja_Usr_DirFinanciera='" . $FiltroSuperior_Baja_Usr_DirFinanciera . "'"); }
			if(isset($FiltroSuperior_Baja_Usr_Contabilidad)) { array_push($arrayParametros, "@FiltroSuperior_Baja_Usr_Contabilidad='" . $FiltroSuperior_Baja_Usr_Contabilidad . "'"); }
			if(isset($FiltroSuperior_EstatusWorkflow_Baja)) { array_push($arrayParametros, "@FiltroSuperior_EstatusWorkflow_Baja='" . $FiltroSuperior_EstatusWorkflow_Baja . "'"); }
			if(isset($FiltroSuperior_UbicacionEspecifica)) { array_push($arrayParametros, "@FiltroSuperior_UbicacionEspecifica='" . $FiltroSuperior_UbicacionEspecifica . "'"); }
			
			// Filtros especificos de Reubicaciones
			if(isset($FiltroSuperior_UbicacionPrimariaOrigen)) { array_push($arrayParametros, "@FiltroSuperior_UbicacionPrimariaOrigen='" . $FiltroSuperior_UbicacionPrimariaOrigen . "'"); }
			if(isset($FiltroSuperior_UbicacionSecundariaOrigen)) { array_push($arrayParametros, "@FiltroSuperior_UbicacionSecundariaOrigen='" . $FiltroSuperior_UbicacionSecundariaOrigen . "'"); }

			$sql = "EXEC sp_siga_activos_campos_registros_get " . implode(",", $arrayParametros);
			//echo $sql;

			$proveedor->execute($sql);
			if (!$proveedor->error()) {
				if ($proveedor->rows($proveedor->stmt) > 0) {
					while ($row = $proveedor->fetch_array($proveedor->stmt, 0)) {
						$Data= array(
							"DespliegueValor"=>$row["DespliegueValor"],
							"DespliegueTexto"=>$row["DespliegueTexto"],
							"Sql"=>$sql
						);
						array_push($Data_Envia, $Data);
					}
				}
			}
			else {
				$error = true;
			}
			$proveedor->close();
			//Fin
			if($error == false) {
				$respuesta = array("totalCount" => count($Data_Envia), "data" => $Data_Envia, "estatus" => $sql, "mensaje" => "Registros Encontrados");
			}
			else {
				$respuesta = array("totalCount" => "0", "data" => $sql, "estatus" => "error", "mensaje" => "Ocurrio un Error al Buscar");
			}
			return $respuesta;
		}





	public function selectSiga_activos($Siga_activosDto,$proveedor=null){
		$Siga_activosDto=$this->validarSiga_activos($Siga_activosDto);
		$Siga_activosDao = new Siga_activosDAO();
		$Siga_activosDto = $Siga_activosDao->selectSiga_activos($Siga_activosDto,$proveedor);
		return $Siga_activosDto;
	}


public function gestor_senior($Tipo_Gestor, $Id_Area, $Id_Usuario, $proveedor=null){
	$respuesta = array();	
	$Data = array();
	$Data_Envia = array();
	$error=false;

	$proveedor = new Proveedor('sqlserver', 'activos');
	$proveedor->connect();
	$sql=" select * from siga_cat_gestores 
					where Tipo_Gestor=".$Tipo_Gestor." and Estatus_Reg<>3 ";
	
	if($Id_Area!=""){
		$sql.=" and Id_area =".$Id_Area;
	}
	
	if($Id_Usuario!=""){
		$sql.=" and Id_Usuario =".$Id_Usuario;
	}
	
	
	//echo $sql;
	$proveedor->execute($sql);
	if (!$proveedor->error()) {
		if ($proveedor->rows($proveedor->stmt) > 0) {
			while ($row = $proveedor->fetch_array($proveedor->stmt, 0)) {
				$Data= array(		
					
					"Id_Gestor"=>$row["Id_Gestor"],
					"Id_Area" => $row["Id_Area"],
					"Id_Seccion" => $row["Id_Seccion"],
					"Tipo_Gestor" => $row["Tipo_Gestor"],
					"Id_Usuario" => $row["Id_Usuario"],
					"Nombre_Empleado" => $row["Nombre_Empleado"]
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

public function selectmotivosalida($siga_activosDto,$proveedor=null){

	$respuesta = array();	
	$Data = array();
	$Data_Envia = array();
	$error=false;

	$proveedor = new Proveedor('sqlserver', 'activos');
	$proveedor->connect();
	$sql=" select * from siga_cat_motivo_salida where Estatus_Reg<>3 and Id_Area='5'";
	
	if($siga_activosDto->getId_Area()!=""){
		$sql.=" or Id_Area='".$siga_activosDto->getId_Area()."'";
	}
	
	
	//echo $sql;
	$proveedor->execute($sql);
	if (!$proveedor->error()) {
		if ($proveedor->rows($proveedor->stmt) > 0) {
			while ($row = $proveedor->fetch_array($proveedor->stmt, 0)) {
				$Data= array(		
					"Id_Motivo_Salida"=>$row["Id_Motivo_Salida"],
					"Id_Area" => rtrim(ltrim($row["Id_Area"])),
					"Desc_Motivo_Alta" => rtrim(ltrim($row["Desc_Motivo_Alta"])),
					"Fech_Inser" => rtrim(ltrim($row["Fech_Inser"])),
					"Usr_Inser" => rtrim(ltrim($row["Usr_Inser"])),
					"Fech_Mod" => rtrim(ltrim($row["Fech_Mod"])),
					"Usr_Mod" => rtrim(ltrim($row["Usr_Mod"])),
					"Estatus_Reg" => rtrim(ltrim($row["Estatus_Reg"]))
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

public function selectbusqueda_activos($siga_activosDto,$proveedor=null){
//$Siga_activosDao = new Siga_activosDAO();
//$Siga_activosDto = $Siga_activosDao->selectbusqueda_activos($Siga_activosDto,$proveedor);
	$respuesta = array();	
	$campos=[];
	$contador = 0;
	$error=false;

	$proveedor = new Proveedor('sqlserver', 'activos');
	$proveedor->connect();
	$sql="select A.Id_Activo, A.AF_BC, A.Nombre_Activo, A.Id_Tipo_Vale_Resg, A.Id_Area, CA.Nom_Area, A.Id_Departamento, CD.Des_Departamento, A.Num_Empleado, A.Nombre_Completo, A.Estatus_Reg, A.Foto, A.Id_Clase,A.Id_Clasificacion, A.Id_Propiedad, CP.Desc_Propiedad,A.Id_Tipo_Activo, A.DescCorta, A.DescLarga, A.Id_Ubic_Prim, CUP.Desc_Ubic_Prim, A.Id_Ubic_Sec,A.Id_Situacion_Activo, CUS.Desc_Ubic_Sec, A.Id_Motivo_Alta, A.Id_Familia, CS.Desc_Subfamilia,A.Marca, A.Modelo, A.NumSerie, A.Id_ActivoPadre, A.NumActivoAnterior, A.Id_Situacion_Activo";
	$sql.=" from siga_activos A";
	$sql.=" left join siga_cat_ubic_prim CUP on A.Id_Ubic_Prim = CUP.Id_Ubic_Prim";
	$sql.=" left join siga_cat_ubic_sec CUS on A.Id_Ubic_Sec = CUS.Id_Ubic_Sec";
	$sql.=" left join siga_catareas CA on A.Id_Area = CA.Id_Area";
	$sql.=" left join siga_cat_propiedad CP on A.Id_Propiedad = CP.Id_Propiedad";
	$sql.=" left join siga_cat_familia CF on A.Id_Familia = CF.Id_Familia";
	$sql.=" left join siga_cat_subfamilia CS on A.Id_Subfamilia = CS.Id_Subfamilia";
	$sql.=" left join siga_cat_departamento CD on A.Id_Departamento = CD.Id_Departamento";
	$sql.=" left outer join siga_baja_activo SB on A.Id_Activo=SB.Id_Activo and SB.Estatus_Cancelacion<>0 ";
	$sql.=" where A.Estatus_Reg <> '3' and A.Id_Situacion_Activo<>'12'  and ";

	if($siga_activosDto->getNum_Empleado()!=""){
		$sql.=" A.Num_Empleado='".$siga_activosDto->getNum_Empleado()."'";
		if(($siga_activosDto->getId_Activo()!="") ||($siga_activosDto->getId_Ubic_Prim()!="") ||($siga_activosDto->getId_Ubic_Sec()!="") ||($siga_activosDto->getId_Area()!="") ||($siga_activosDto->getId_Propiedad()!="") ||($siga_activosDto->getId_Familia()!="") ||($siga_activosDto->getId_Subfamilia()!="") ||($siga_activosDto->getId_Departamento()!=""))
		{
			$sql.=" AND ";
		}
	}
	
	if($siga_activosDto->getId_Activo()!=""){
		$sql.=" A.Id_Activo='".$siga_activosDto->getId_Activo()."'";
		if(($siga_activosDto->getId_Ubic_Prim()!="") ||($siga_activosDto->getId_Ubic_Sec()!="") ||($siga_activosDto->getId_Area()!="") ||($siga_activosDto->getId_Propiedad()!="") ||($siga_activosDto->getId_Familia()!="") ||($siga_activosDto->getId_Subfamilia()!="") ||($siga_activosDto->getId_Departamento()!=""))
		{
			$sql.=" AND ";
		}
	}
	
	if($siga_activosDto->getId_Ubic_Prim()!=""){
		$sql.=" A.Id_Ubic_Prim='".$siga_activosDto->getId_Ubic_Prim()."'";
		if(($siga_activosDto->getId_Ubic_Sec()!="") ||($siga_activosDto->getId_Area()!="") ||($siga_activosDto->getId_Propiedad()!="") ||($siga_activosDto->getId_Familia()!="") ||($siga_activosDto->getId_Subfamilia()!="") ||($siga_activosDto->getId_Departamento()!=""))
		{
			$sql.=" AND ";
		}
	}
	
	if($siga_activosDto->getId_Ubic_Sec()!=""){
		$sql.=" A.Id_Ubic_Sec='".$siga_activosDto->getId_Ubic_Sec()."'";
		if(($siga_activosDto->getId_Area()!="") ||($siga_activosDto->getId_Propiedad()!="") ||($siga_activosDto->getId_Familia()!="") ||($siga_activosDto->getId_Subfamilia()!="") ||($siga_activosDto->getId_Departamento()!=""))
		{
			$sql.=" AND ";
		}
	}
	
	if($siga_activosDto->getId_Area()!=""){
		$sql.=" A.Id_Area='".$siga_activosDto->getId_Area()."'";
		if(($siga_activosDto->getId_Propiedad()!="") ||($siga_activosDto->getId_Familia()!="") ||($siga_activosDto->getId_Subfamilia()!="") ||($siga_activosDto->getId_Departamento()!=""))
		{
			$sql.=" AND ";
		}
	}
	
	if($siga_activosDto->getId_Propiedad()!=""){
		$sql.=" A.Id_Propiedad='".$siga_activosDto->getId_Propiedad()."'";
		if(($siga_activosDto->getId_Familia()!="") ||($siga_activosDto->getId_Subfamilia()!="") ||($siga_activosDto->getId_Departamento()!=""))
		{
			$sql.=" AND ";
		}
	}
	
	if($siga_activosDto->getId_Familia()!=""){
		$sql.=" A.Id_Familia='".$siga_activosDto->getId_Familia()."'";
		if(($siga_activosDto->getId_Subfamilia()!="") ||($siga_activosDto->getId_Departamento()!=""))
		{
			$sql.=" AND ";
		}
	}
	
	if($siga_activosDto->getId_Subfamilia()!=""){
		$sql.=" A.Id_Subfamilia='".$siga_activosDto->getId_Subfamilia()."'";
		if(($siga_activosDto->getId_Departamento()!=""))
		{
			$sql.=" AND ";
		}
	}
	
	if($siga_activosDto->getId_Departamento()!=""){
		$sql.=" A.Id_Departamento='".$siga_activosDto->getId_Departamento()."'";
	}
	
	$proveedor->execute($sql);
	if (!$proveedor->error()) {
		if ($proveedor->rows($proveedor->stmt) > 0) {
			
			while ($row = $proveedor->fetch_array($proveedor->stmt, 0)) {
				//Verificado Anteriormente
				/////////////////////////////////////////////
				$sql=" SELECT Id_Verificacion as Lote, FORMAT(Fech_Mod,'dd/MM/yyyy hh:mm:ss') as Fecha ";
				$sql.=" FROM siga_det_verificacion  where Id_Activo='".$row[0]."' and Estatus_Reg<>'3' order by Fecha desc";
				
				
				$proveedor_con2 = new Proveedor('sqlserver', 'activos');
				$proveedor_con2->connect();
				$proveedor_con2->execute($sql);
				//Consulta 2
				$respuesta2= "No";	
				if (!$proveedor_con2->error()) {
					if ($proveedor_con2->rows($proveedor_con2->stmt) > 0) {
						$respuesta2="";
						while ($row2 = $proveedor_con2->fetch_array($proveedor_con2->stmt, 0)) {
							$respuesta2.="Lote: ".$row2[0]." Fecha: ".$row2[1]." <br><br>";
						}
					}
				
				}else{
					$error=true;
				}
				$proveedor_con2->close();
				///////////////////////////////////////////
				$campos[$contador] = array(
					"Id_Activo" => $row[0], 
					"AF_BC" => $row[1], 
					"Nombre_Activo"=>$row[2], 
					"Id_Tipo_Vale_Resg"=>$row[3], 
					"Id_Area"=>$row[4],
					"Nom_Area"=>$row[5],
					'Id_Departamento'=>$row[6],
					'Des_Departamento'=>$row[7],
					'Num_Empleado'=>$row[8],
					"Nombre_Completo" => $row[9], 
					"Estatus_Reg" => $row[10], 
					"Foto"=>$row[11], 
					"Id_Clase"=>$row[12],
					"Id_Clasificacion"=>$row[13],
					"Id_Propiedad"=>$row[14],
					"Desc_Propiedad"=>$row[15],
					'Id_Tipo_Activo'=>$row[16],
					'DescCorta'=>$row[17],
					'DescLarga'=>$row[18],
					"Id_Ubic_Prim" => $row[19], 
					"Desc_Ubic_Prim" => $row[20], 
					"Id_Ubic_Sec"=>$row[21], 
					"Id_Situacion_Activo"=>$row[22], 
					"Desc_Ubic_Sec"=>$row[23], 
					"Id_Motivo_Alta"=>$row[24],
					"Id_Familia"=>$row[25],
					'Desc_Subfamilia'=>$row[26],
					'Marca'=>$row[27],
					'Modelo'=>$row[28],
					'NumSerie'=>$row[29],
					'Id_ActivoPadre'=>$row[30],
					'NumActivoAnterior'=>$row[31],
					'Lote'=>$respuesta2,
				);
                $contador++;
            }
		}
	}else{
		$error=true;
	}
	$proveedor->close();
	
	//Fin 
	if($error==false){
		$respuesta = array("totalCount" => count($campos), "data" => $campos, "estatus" => "ok", "mensaje" => "Registros Encontrados");   	
	}else{
		$respuesta = array("totalCount" => "0", "data" => "", "estatus" => "error", "mensaje" => "Ocurrio un Error al Buscar");   	
	}
	
	
	return $respuesta;
}

public function selectbusqueda_activos_nota_salida($siga_activosDto, $Cadena, $proveedor=null){
//$Siga_activosDao = new Siga_activosDAO();
//$Siga_activosDto = $Siga_activosDao->selectbusqueda_activos($Siga_activosDto,$proveedor);
	$respuesta = array();	
	$campos=[];
	$contador = 0;
	$error=false;

	$proveedor = new Proveedor('sqlserver', 'activos');
	$proveedor->connect();
	$sql="select A.Id_Activo, A.AF_BC, A.Nombre_Activo, A.Id_Tipo_Vale_Resg, A.Id_Area, CA.Nom_Area, A.Id_Departamento, CD.Des_Departamento, A.Num_Empleado, A.Nombre_Completo, A.Estatus_Reg, A.Foto, A.Id_Clase,A.Id_Clasificacion, A.Id_Propiedad, CP.Desc_Propiedad,A.Id_Tipo_Activo, A.DescCorta, A.DescLarga, A.Id_Ubic_Prim, CUP.Desc_Ubic_Prim, A.Id_Ubic_Sec,A.Id_Situacion_Activo, CUS.Desc_Ubic_Sec, A.Id_Motivo_Alta, A.Id_Familia, CS.Desc_Subfamilia,A.Marca, A.Modelo, A.NumSerie, A.Id_ActivoPadre, A.NumActivoAnterior, A.Id_Situacion_Activo";
	$sql.=" from siga_activos A";
	$sql.=" left join siga_cat_ubic_prim CUP on A.Id_Ubic_Prim = CUP.Id_Ubic_Prim";
	$sql.=" left join siga_cat_ubic_sec CUS on A.Id_Ubic_Sec = CUS.Id_Ubic_Sec";
	$sql.=" left join siga_catareas CA on A.Id_Area = CA.Id_Area";
	$sql.=" left join siga_cat_propiedad CP on A.Id_Propiedad = CP.Id_Propiedad";
	$sql.=" left join siga_cat_familia CF on A.Id_Familia = CF.Id_Familia";
	$sql.=" left join siga_cat_subfamilia CS on A.Id_Subfamilia = CS.Id_Subfamilia";
	$sql.=" left join siga_cat_departamento CD on A.Id_Departamento = CD.Id_Departamento";
	$sql.=" left outer join siga_baja_activo SB on A.Id_Activo=SB.Id_Activo and SB.Estatus_Cancelacion<>0";
	$sql.=" where A.Estatus_Reg <> '3' and A.Id_Situacion_Activo<>'12'  ";
	//$sql.=" and  A.Id_Activo not in(select distinct Id_Activo_DNS from siga_det_nota_salida left join siga_nota_salida on siga_det_nota_salida.Id_Nota_Salida_DNS=siga_nota_salida.Id_Nota_Salida where Id_Activo_DNS is not null and Tipo_Solicitud=2 ) ";
	$sql.=" and ";

	if($siga_activosDto->getNum_Empleado()!=""){
		$sql.=" A.Num_Empleado='".$siga_activosDto->getNum_Empleado()."'";
		if(($siga_activosDto->getId_Activo()!="") ||($siga_activosDto->getId_Ubic_Prim()!="") ||($siga_activosDto->getId_Ubic_Sec()!="") ||($siga_activosDto->getId_Area()!="") ||($siga_activosDto->getId_Propiedad()!="") ||($siga_activosDto->getId_Familia()!="") ||($siga_activosDto->getId_Subfamilia()!="") ||($siga_activosDto->getId_Departamento()!=""))
		{
			$sql.=" AND ";
		}
	}
	
	if($siga_activosDto->getId_Activo()!=""){
		$sql.=" A.Id_Activo='".$siga_activosDto->getId_Activo()."'";
		if(($siga_activosDto->getId_Ubic_Prim()!="") ||($siga_activosDto->getId_Ubic_Sec()!="") ||($siga_activosDto->getId_Area()!="") ||($siga_activosDto->getId_Propiedad()!="") ||($siga_activosDto->getId_Familia()!="") ||($siga_activosDto->getId_Subfamilia()!="") ||($siga_activosDto->getId_Departamento()!=""))
		{
			$sql.=" AND ";
		}
	}
	
	if($siga_activosDto->getId_Ubic_Prim()!=""){
		$sql.=" A.Id_Ubic_Prim='".$siga_activosDto->getId_Ubic_Prim()."'";
		if(($siga_activosDto->getId_Ubic_Sec()!="") ||($siga_activosDto->getId_Area()!="") ||($siga_activosDto->getId_Propiedad()!="") ||($siga_activosDto->getId_Familia()!="") ||($siga_activosDto->getId_Subfamilia()!="") ||($siga_activosDto->getId_Departamento()!=""))
		{
			$sql.=" AND ";
		}
	}
	
	if($siga_activosDto->getId_Ubic_Sec()!=""){
		$sql.=" A.Id_Ubic_Sec='".$siga_activosDto->getId_Ubic_Sec()."'";
		if(($siga_activosDto->getId_Area()!="") ||($siga_activosDto->getId_Propiedad()!="") ||($siga_activosDto->getId_Familia()!="") ||($siga_activosDto->getId_Subfamilia()!="") ||($siga_activosDto->getId_Departamento()!=""))
		{
			$sql.=" AND ";
		}
	}
	
	if($siga_activosDto->getId_Area()!=""){
		$sql.=" A.Id_Area='".$siga_activosDto->getId_Area()."'";
		if(($siga_activosDto->getId_Propiedad()!="") ||($siga_activosDto->getId_Familia()!="") ||($siga_activosDto->getId_Subfamilia()!="") ||($siga_activosDto->getId_Departamento()!=""))
		{
			$sql.=" AND ";
		}
	}
	
	if($siga_activosDto->getId_Propiedad()!=""){
		$sql.=" A.Id_Propiedad='".$siga_activosDto->getId_Propiedad()."'";
		if(($siga_activosDto->getId_Familia()!="") ||($siga_activosDto->getId_Subfamilia()!="") ||($siga_activosDto->getId_Departamento()!=""))
		{
			$sql.=" AND ";
		}
	}
	
	if($siga_activosDto->getId_Familia()!=""){
		$sql.=" A.Id_Familia='".$siga_activosDto->getId_Familia()."'";
		if(($siga_activosDto->getId_Subfamilia()!="") ||($siga_activosDto->getId_Departamento()!=""))
		{
			$sql.=" AND ";
		}
	}
	
	if($siga_activosDto->getId_Subfamilia()!=""){
		$sql.=" A.Id_Subfamilia='".$siga_activosDto->getId_Subfamilia()."'";
		if(($siga_activosDto->getId_Departamento()!=""))
		{
			$sql.=" AND ";
		}
	}
	
	if($siga_activosDto->getId_Departamento()!=""){
		$sql.=" A.Id_Departamento='".$siga_activosDto->getId_Departamento()."'";
	}
	
	if($Cadena!=""){
		$sql.=" and A.Id_Activo in(".$Cadena.")";
	}
	//echo "<pre>";
	//echo $sql;
	//echo "</pre>";
	$proveedor->execute($sql);
	if (!$proveedor->error()) {
		if ($proveedor->rows($proveedor->stmt) > 0) {
			
			while ($row = $proveedor->fetch_array($proveedor->stmt, 0)) {
				
				$campos[$contador] = array(
					"Id_Activo" => $row[0], 
					"AF_BC" => $row[1], 
					"Nombre_Activo"=>$row[2], 
					"Id_Tipo_Vale_Resg"=>$row[3], 
					"Id_Area"=>$row[4],
					"Nom_Area"=>$row[5],
					'Id_Departamento'=>$row[6],
					'Des_Departamento'=>$row[7],
					'Num_Empleado'=>$row[8],
					"Nombre_Completo" => $row[9], 
					"Estatus_Reg" => $row[10], 
					"Foto"=>$row[11], 
					"Id_Clase"=>$row[12],
					"Id_Clasificacion"=>$row[13],
					"Id_Propiedad"=>$row[14],
					"Desc_Propiedad"=>$row[15],
					'Id_Tipo_Activo'=>$row[16],
					'DescCorta'=>$row[17],
					'DescLarga'=>$row[18],
					"Id_Ubic_Prim" => $row[19], 
					"Desc_Ubic_Prim" => $row[20], 
					"Id_Ubic_Sec"=>$row[21], 
					"Id_Situacion_Activo"=>$row[22], 
					"Desc_Ubic_Sec"=>$row[23], 
					"Id_Motivo_Alta"=>$row[24],
					"Id_Familia"=>$row[25],
					'Desc_Subfamilia'=>$row[26],
					'Marca'=>$row[27],
					'Modelo'=>$row[28],
					'NumSerie'=>$row[29],
					'Id_ActivoPadre'=>$row[30],
					'NumActivoAnterior'=>$row[31]
					
				);
                $contador++;
            }
		}
	}else{
		$error=true;
	}
	$proveedor->close();
	
	//Fin 
	if($error==false){
		$respuesta = array("totalCount" => count($campos), "data" => $campos, "estatus" => "ok", "mensaje" => "Registros Encontrados");   	
	}else{
		$respuesta = array("totalCount" => "0", "data" => "", "estatus" => "error", "mensaje" => "Ocurrio un Error al Buscar");   	
	}
	
	
	return $respuesta;
}

public function selectbusqueda_activos_externos_nota_salida($siga_activosDto, $Cadena, $proveedor=null){
  $Data = array();
	$Data_Envia = array();
	
	$respuesta = array();
	$error=false;
	
	$proveedor = new Proveedor('sqlserver', 'activos');
	$proveedor->connect();
	
	$sql="
		SELECT 
			st.Id_Solicitud,
			st.Id_Activo,
			st.Id_Cirugia,
			st.Activo_Externo,
			st.AF_BC_Ext,
			st.Nombre_Act_Ext,
			st.Marca_Act_Ext,
			st.Modelo_Act_Ext, 
			st.No_Serie_Act_Ext,
			st.Cantidad_Equ_Ext,
			st.Empresa_Ext,
			st.Nombre_Completo_Ext,
			st.Telefono_Ext,
			st.Correo_Ext,
			st.Id_Ubic_Prim,
			st.Id_Ubic_Sec,
			Desc_Ubic_Prim,
			Desc_Ubic_Sec,
			(SELECT TOP 1 Id_Gestor
				FROM siga_cat_gestores 
				WHERE Tipo_Gestor=1 
				and Estatus_Reg<>3 
				and Id_area=st.Id_Area 
				and Id_Usuario=".$siga_activosDto->getUsr_Inser().") as Gestor_Senior,
				st.Fech_Solicitud,
				st.Fech_Cierre				
		FROM siga_solicitud_tickets st
		LEFT JOIN siga_cat_ubic_prim CUP on st.Id_Ubic_Prim = CUP.Id_Ubic_Prim
		LEFT JOIN siga_cat_ubic_sec CUS on st.Id_Ubic_Sec = CUS.Id_Ubic_Sec
		left outer join 
		siga_cancelacion_nota_salida cn on st.Id_Solicitud=cn.Id_Solicitud 
		and cn.Estatus_Reg<>3 
		WHERE st.Estatus_Proceso=4 
		and st.Estatus_Reg <>3 
		and st.Id_Cirugia is null 
		and Activo_Externo=1 
		and cn.Id_Cancelacion_Nota IS NULL
		and st.Id_Solicitud not in(	SELECT distinct Id_Solicitud_DNS 
									FROM siga_det_nota_salida 
									LEFT JOIN siga_nota_salida ON siga_det_nota_salida.Id_Nota_Salida_DNS=siga_nota_salida.Id_Nota_Salida
									WHERE Id_Solicitud_DNS is not null 
									AND Tipo_Solicitud=3 
									AND siga_nota_salida.Estatus_Reg<>3 
									AND siga_nota_salida.Nota_Duplicada <>'1')";
	
	if($siga_activosDto->getId_Area()!=""){
		$sql.=" and st.Id_Area=".$siga_activosDto->getId_Area();
	}
		
	if($Cadena!=""){
		$sql.=" and st.Id_Solicitud in(".$Cadena.")";
	}
	
	$proveedor->execute($sql);
	
	//echo "<pre>";
	//echo $sql;
	//echo "</pre>";
	
	
	if (!$proveedor->error()){
		//La posicion cero no se toma
		if ($proveedor->rows($proveedor->stmt) > 0) {
			while ($row_c = $proveedor->fetch_array($proveedor->stmt, 0)) {
				$Data_Acc_d = array();
				$Data_Acc_d_Envia = array();
				if($Cadena!=""){
					$proveedor_acc_d = new Proveedor('sqlserver', 'activos');
					$proveedor_acc_d->connect();
					$sql="select * from siga_det_accesorios_act_ext where Id_Solicitud_Ext=".$row_c["Id_Solicitud"]." and Estatus_Reg_Ext<>3";
					$proveedor_acc_d->execute($sql);
					if (!$proveedor_acc_d->error()){
						if ($proveedor_acc_d->rows($proveedor_acc_d->stmt) > 0) {
							while ($row_d = $proveedor_acc_d->fetch_array($proveedor_acc_d->stmt, 0)) {
								$Cantidad="";if(rtrim(ltrim($row_d["Cantidad_Ext"]))!=NULL){$Cantidad=rtrim(ltrim($row_d["Cantidad_Ext"]));}
								$Data_Acc_d= array(
									"Id_Accesorio_Ext"=>$row_d["Id_Accesorio_Ext"],
									"Nombre_Ext"=>rtrim(ltrim($row_d["Nombre_Ext"])),
									"Cantidad_Ext"=>$Cantidad,
									"Marca_Ext"=>rtrim(ltrim($row_d["Marca_Ext"])),
									"Modelo_Ext"=>rtrim(ltrim($row_d["Modelo_Ext"])),
									"No_Serie_Ext"=>rtrim(ltrim($row_d["No_Serie_Ext"]))
								);
								array_push($Data_Acc_d_Envia, $Data_Acc_d);
							}
						}	
					}else{
						$error=true;
					}
							
					$proveedor_acc_d->close();
				}
				
				$Gestor_Senior=0;
				if($row_c["Gestor_Senior"]!=NULL && $row_c["Gestor_Senior"]!=''){
					$Gestor_Senior=1;	
				}
				
				$Cantidad_ext="";
				if(rtrim(ltrim($row_c["Cantidad_Ext"]))!=NULL)
					{$Cantidad_ext=rtrim(ltrim($row_c["Cantidad_Ext"]));}
				$Data= array(
					"Id_Solicitud"=>$row_c["Id_Solicitud"],
					"Id_Activo"=>$row_c["Id_Activo"],
					"Id_Cirugia"=>$row_c["Id_Cirugia"],
					"Activo_Externo"=>$row_c["Activo_Externo"],
					"AF_BC_Ext"=>$row_c["AF_BC_Ext"],
					"Nombre_Act_Ext"=>$row_c["Nombre_Act_Ext"],
					"Marca_Act_Ext"=>$row_c["Marca_Act_Ext"],
					"Modelo_Act_Ext"=>$row_c["Modelo_Act_Ext"],
					"No_Serie_Act_Ext"=>$row_c["No_Serie_Act_Ext"],
					"Cantidad_Equ_Ext"=>$Cantidad_ext,
					"Empresa_Ext"=>$row_c["Empresa_Ext"],
					"Nombre_Completo_Ext"=>$row_c["Nombre_Completo_Ext"],
					"Telefono_Ext"=>$row_c["Telefono_Ext"],
					"Correo_Ext"=>$row_c["Correo_Ext"],
					"Desc_Ubic_Prim"=>$row_c["Desc_Ubic_Prim"],
					"Id_Ubic_Prim"=>rtrim(ltrim($row_c["Id_Ubic_Prim"])),
					"Id_Ubic_Sec"=>rtrim(ltrim($row_c["Id_Ubic_Sec"])),
					"Desc_Ubic_Sec"=>$row_c["Desc_Ubic_Sec"],
					"Count_Acc_D"=>count($Data_Acc_d_Envia),
					"Data_Acc_D"=>$Data_Acc_d_Envia,
					"Gestor_Senior"=>$Gestor_Senior,
					"Fech_Solicitud"=>$row_c["Fech_Solicitud"],
					"Fech_Cierre"=>$row_c["Fech_Cierre"]
				);
				array_push($Data_Envia, $Data);
			}
		}	
	}else{
		$error=true;
	}

	$proveedor->close();
	if($error==false){
		$respuesta = array("totalCount" => count($Data_Envia),"data" => $Data_Envia,"estatus" => "ok", "mensaje" => "Registros Encontrados");
	}else{
		$respuesta = array("totalCount" => "0", "data" => "","estatus" => "error", "mensaje" => "No se Encontraron Registros");
	}
	return $respuesta;
}

//=============================================================================================================================================================================================
//=============================================================================================================================================================================================

public function selectbusqueda_activos_externos_qtiqx($siga_activosDto, $Cadena, $proveedor=null){
  $Data = array();
	$Data_Envia = array();
	
	$respuesta = array();
	$error=false;
	
	$proveedor = new Proveedor('sqlserver', 'activos');
	$proveedor->connect();
	
	$sql="SELECT 	st.Id_Solicitud,
				st.Id_Activo,
				st.Id_Cirugia,
				st.Activo_Externo,
				st.AF_BC_Ext,
				st.Nombre_Act_Ext,
				st.Marca_Act_Ext,
				st.Modelo_Act_Ext,
				st.No_Serie_Act_Ext,
				st.Cantidad_Equ_Ext,
				st.Empresa_Ext,
				st.Nombre_Completo_Ext,
				st.Telefono_Ext,
				st.Correo_Ext,
				st.Id_Ubic_Prim,
				st.Id_Ubic_Sec,
				Desc_Ubic_Prim,
				Desc_Ubic_Sec,
				(select TOP 1 Id_Gestor from siga_cat_gestores where Tipo_Gestor=1 and Estatus_Reg<>3 and Id_area=st.Id_Area and Id_Usuario=".$siga_activosDto->getUsr_Inser().") as Gestor_Senior,
				st.Fech_Cierre,
				st.Fech_Solicitud
		FROM siga_solicitud_tickets st
		LEFT JOIN siga_cat_ubic_prim CUP 	ON st.Id_Ubic_Prim = CUP.Id_Ubic_Prim
		LEFT JOIN siga_cat_ubic_sec CUS 	ON st.Id_Ubic_Sec = CUS.Id_Ubic_Sec
		LEFT OUTER JOIN siga_cancelacion_nota_salida cn ON st.Id_Solicitud=cn.Id_Solicitud 
			AND cn.Estatus_Reg<>3 
		WHERE st.Estatus_Proceso=4 
			AND st.Estatus_Reg <>3 
			AND st.Id_Cirugia IS NOT null 
			AND cn.Id_Cancelacion_Nota IS NULL
			AND st.Id_Solicitud NOT IN(SELECT DISTINCT Id_Solicitud_DNS FROM siga_det_nota_salida LEFT JOIN siga_nota_salida ON siga_det_nota_salida.Id_Nota_Salida_DNS=siga_nota_salida.Id_Nota_Salida
		WHERE Id_Solicitud_DNS is not null AND Tipo_Solicitud=1 AND siga_nota_salida.Estatus_Reg<>3 AND Nota_Duplicada <>1)
        AND st.Id_Area=1
        AND st.Empresa_Ext <> ''
				AND st.AF_BC_Ext is Null

		UNION ALL

      SELECT 
			st.Id_Solicitud,
			st.Id_Activo,
			st.Id_Cirugia,            
			st.Activo_Externo,
			st.AF_BC_Ext,
			st.Nombre_Act_Ext,
			st.Marca_Act_Ext,
			st.Modelo_Act_Ext, 
			st.No_Serie_Act_Ext,
			st.Cantidad_Equ_Ext,
			st.Empresa_Ext,
			st.Nombre_Completo_Ext,
			st.Telefono_Ext,
			st.Correo_Ext,
			st.Id_Ubic_Prim,
			st.Id_Ubic_Sec,
			Desc_Ubic_Prim,
			Desc_Ubic_Sec,
			(SELECT TOP 1 Id_Gestor
				FROM siga_cat_gestores 
				WHERE Tipo_Gestor=1 
				and Estatus_Reg<>3 
				and Id_area=st.Id_Area 
				and Id_Usuario=".$siga_activosDto->getUsr_Inser().") as Gestor_Senior,
				st.Fech_Cierre,
				st.Fech_Solicitud
		FROM siga_solicitud_tickets st
		LEFT JOIN siga_cat_ubic_prim CUP on st.Id_Ubic_Prim = CUP.Id_Ubic_Prim
		LEFT JOIN siga_cat_ubic_sec CUS on st.Id_Ubic_Sec = CUS.Id_Ubic_Sec
		left outer join 
		siga_cancelacion_nota_salida cn on st.Id_Solicitud=cn.Id_Solicitud 
		and cn.Estatus_Reg<>3 
		WHERE st.Estatus_Proceso=4 
		and st.Estatus_Reg <>3 
		and st.Id_Cirugia is null 
		and Activo_Externo=1 
		and cn.Id_Cancelacion_Nota IS NULL
		AND st.AF_BC_Ext is Null
		and st.Id_Solicitud not in(	SELECT distinct Id_Solicitud_DNS 
									FROM siga_det_nota_salida 
									LEFT JOIN siga_nota_salida ON siga_det_nota_salida.Id_Nota_Salida_DNS=siga_nota_salida.Id_Nota_Salida
									WHERE Id_Solicitud_DNS is not null 
									AND Tipo_Solicitud=3 
									AND siga_nota_salida.Estatus_Reg<>3 
									AND siga_nota_salida.Nota_Duplicada <>'1')
									";
	
	// if($siga_activosDto->getId_Area()!=""){
	// 	$sql.=" and st.Id_Area=".$siga_activosDto->getId_Area();
	// }
		
	if($Cadena!=""){
		$sql.=" and st.Id_Solicitud in(".$Cadena.")";
	}
	


	$proveedor->execute($sql);
	
	//echo "<pre>";
	//echo $sql;
	//echo "</pre>";
	
	
	if (!$proveedor->error()){
		//La posicion cero no se toma
		if ($proveedor->rows($proveedor->stmt) > 0) {
			while ($row_c = $proveedor->fetch_array($proveedor->stmt, 0)) {
				$Data_Acc_d = array();
				$Data_Acc_d_Envia = array();
				if($Cadena!=""){
					$proveedor_acc_d = new Proveedor('sqlserver', 'activos');
					$proveedor_acc_d->connect();
					$sql="select * from siga_det_accesorios_act_ext where Id_Solicitud_Ext=".$row_c["Id_Solicitud"]." and Estatus_Reg_Ext<>3";
					$proveedor_acc_d->execute($sql);
					if (!$proveedor_acc_d->error()){
						if ($proveedor_acc_d->rows($proveedor_acc_d->stmt) > 0) {
							while ($row_d = $proveedor_acc_d->fetch_array($proveedor_acc_d->stmt, 0)) {
								$Cantidad="";if(rtrim(ltrim($row_d["Cantidad_Ext"]))!=NULL){$Cantidad=rtrim(ltrim($row_d["Cantidad_Ext"]));}
								$Data_Acc_d= array(
									"Id_Accesorio_Ext"=>$row_d["Id_Accesorio_Ext"],
									"Nombre_Ext"=>rtrim(ltrim($row_d["Nombre_Ext"])),
									"Cantidad_Ext"=>$Cantidad,
									"Marca_Ext"=>rtrim(ltrim($row_d["Marca_Ext"])),
									"Modelo_Ext"=>rtrim(ltrim($row_d["Modelo_Ext"])),
									"No_Serie_Ext"=>rtrim(ltrim($row_d["No_Serie_Ext"]))
								);
								array_push($Data_Acc_d_Envia, $Data_Acc_d);
							}
						}	
					}else{
						$error=true;
					}
							
					$proveedor_acc_d->close();
				}
				
				$Gestor_Senior=0;
				if($row_c["Gestor_Senior"]!=NULL && $row_c["Gestor_Senior"]!=''){
					$Gestor_Senior=1;	
				}
				
				$Cantidad_ext="";
				if(rtrim(ltrim($row_c["Cantidad_Ext"]))!=NULL)
					{$Cantidad_ext=rtrim(ltrim($row_c["Cantidad_Ext"]));}
				$Data= array(
					"Id_Solicitud"=>$row_c["Id_Solicitud"],
					"Id_Activo"=>$row_c["Id_Activo"],
					"Id_Cirugia"=>$row_c["Id_Cirugia"],
					"Activo_Externo"=>$row_c["Activo_Externo"],
					"AF_BC_Ext"=>$row_c["AF_BC_Ext"],
					"Nombre_Act_Ext"=>$row_c["Nombre_Act_Ext"],
					"Marca_Act_Ext"=>$row_c["Marca_Act_Ext"],
					"Modelo_Act_Ext"=>$row_c["Modelo_Act_Ext"],
					"No_Serie_Act_Ext"=>$row_c["No_Serie_Act_Ext"],
					"Cantidad_Equ_Ext"=>$Cantidad_ext,
					"Empresa_Ext"=>$row_c["Empresa_Ext"],
					"Nombre_Completo_Ext"=>$row_c["Nombre_Completo_Ext"],
					"Telefono_Ext"=>$row_c["Telefono_Ext"],
					"Correo_Ext"=>$row_c["Correo_Ext"],
					"Desc_Ubic_Prim"=>$row_c["Desc_Ubic_Prim"],
					"Id_Ubic_Prim"=>rtrim(ltrim($row_c["Id_Ubic_Prim"])),
					"Id_Ubic_Sec"=>rtrim(ltrim($row_c["Id_Ubic_Sec"])),
					"Desc_Ubic_Sec"=>$row_c["Desc_Ubic_Sec"],
					"Count_Acc_D"=>count($Data_Acc_d_Envia),
					"Data_Acc_D"=>$Data_Acc_d_Envia,
					"Gestor_Senior"=>$Gestor_Senior,
					"fechaCierre"=>$row_c["Fech_Cierre"],
					"FechSolicitud"=>$row_c["Fech_Solicitud"]
				);
				array_push($Data_Envia, $Data);
			}
		}	
	}else{
		$error=true;
	}
	
	$proveedor->close();
	if($error==false){
		$respuesta = array("totalCount" => count($Data_Envia),"data" => $Data_Envia,"estatus" => "ok", "mensaje" => "Registros Encontrados");
	}else{
		$respuesta = array("totalCount" => "0", "data" => "","estatus" => "error", "mensaje" => "No se Encontraron Registros");
	}
	return $respuesta;
}

//=============================================================================================================================================================================================
//=============================================================================================================================================================================================

public function proceso_notas_salida($Id_Area, $proveedor=null){
	$respuesta = array();	
	$Data = array();
	$Data_Envia = array();
	$error=false;

	$proveedor = new Proveedor('sqlserver', 'activos');
	$proveedor->connect();
	$sql="
		select Id_Nota_Salida,Empresa_Recibe, Desc_Ubic_Prim, Desc_Ubic_Sec, Desc_Motivo_Alta, Nombre_Realiza_Nota, Nombre_Quien_Autoriza, Nombre_Contacto as Recibe, Fech_Firma_Recibe,Id_Usr_Realiza_Nota
		from siga_nota_salida 
		left join siga_cat_ubic_prim on siga_nota_salida.Id_Ubic_Prim=siga_cat_ubic_prim.Id_Ubic_Prim 
		left join siga_cat_ubic_sec on siga_nota_salida.Id_Ubic_Sec= siga_cat_ubic_sec.Id_Ubic_Sec
		left join siga_cat_motivo_salida on siga_nota_salida.Id_Motivo_Salida=siga_cat_motivo_salida.Id_Motivo_Salida
		where Id_Area_Realiza=".$Id_Area." and siga_nota_salida.Estatus_Reg<>3 and (Estatus_Proceso<>4 or Estatus_Proceso is null)";
	
  //echo "<pre>"; 
	//echo $sql;
	//echo "</pre>";
	$proveedor->execute($sql);
	if (!$proveedor->error()) {
		if ($proveedor->rows($proveedor->stmt) > 0) {
			while ($row = $proveedor->fetch_array($proveedor->stmt, 0)) {
				$Data= array(
					"Id_Nota_Salida"=>$row["Id_Nota_Salida"],
					"Empresa_Recibe"=>$row["Empresa_Recibe"],
					"Desc_Ubic_Prim" => rtrim(ltrim($row["Desc_Ubic_Prim"])),
					"Desc_Ubic_Sec" => rtrim(ltrim($row["Desc_Ubic_Sec"])),
					"Desc_Motivo_Alta" => rtrim(ltrim($row["Desc_Motivo_Alta"])),
					"Nombre_Realiza_Nota" => rtrim(ltrim($row["Nombre_Realiza_Nota"])),
					"Nombre_Quien_Autoriza" => rtrim(ltrim($row["Nombre_Quien_Autoriza"])),
					"Recibe" => rtrim(ltrim($row["Recibe"])),
					"Fech_Firma_Recibe" => rtrim(ltrim($row["Fech_Firma_Recibe"])),
					"Id_Usr_Realiza_Nota" => rtrim(ltrim($row["Id_Usr_Realiza_Nota"]))
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


public function historial_notas_salida($Id_Area, $Fech_Inicial, $Fech_Final, $proveedor=null){
	$respuesta = array();	
	$Data = array();
	$Data_Envia = array();
	$error=false;

	$proveedor = new Proveedor('sqlserver', 'activos');
	$proveedor->connect();
	$sql="
		select Id_Nota_Salida,Empresa_Recibe, Desc_Ubic_Prim, Desc_Ubic_Sec, Desc_Motivo_Alta, Nombre_Realiza_Nota, Nombre_Quien_Autoriza, Nombre_Contacto as Recibe, Fech_Firma_Recibe,
		(select TOP 1 CONCAT(nd.Id_Solicitud_DNS,'-',FORMAT(ss.Fech_Seguimiento,'yyyy/MM/dd HH:mm:ss'),'-',FORMAT(ss.Fech_Cierre, 'yyyy/MM/dd HH:mm:ss')) as fecha_ticket  from siga_det_nota_salida nd 
		left join siga_solicitud_tickets ss on nd.Id_Solicitud_DNS=ss.Id_Solicitud where Id_Nota_Salida_DNS=sn.Id_Nota_Salida) as fecha_ticket
		from siga_nota_salida sn
		left join siga_cat_ubic_prim on sn.Id_Ubic_Prim=siga_cat_ubic_prim.Id_Ubic_Prim 
		left join siga_cat_ubic_sec on sn.Id_Ubic_Sec= siga_cat_ubic_sec.Id_Ubic_Sec
		left join siga_cat_motivo_salida on sn.Id_Motivo_Salida=siga_cat_motivo_salida.Id_Motivo_Salida
		where Id_Area_Realiza=".$Id_Area." and sn.Estatus_Reg<>3 and Estatus_Proceso=4  
	";

	if($Fech_Inicial!="" && $Fech_Final!=""){
		$sql.=" and CONVERT(DATE,Fech_Firma_Recibe) BETWEEN CONVERT(DATE, '".$Fech_Inicial."') AND CONVERT(DATE, '".$Fech_Final."')  ";
	}else{
		$sql.=" and Fech_Firma_Recibe>=CONVERT(DATE,GETDATE()-365) ";
	}

	//echo $sql;
	$proveedor->execute($sql);
	if (!$proveedor->error()) {
		if ($proveedor->rows($proveedor->stmt) > 0) {
			while ($row = $proveedor->fetch_array($proveedor->stmt, 0)) {
				$partes = explode("-", $row["fecha_ticket"]);
				$Id_Solicitud="";
				$Fecha_Seguimiento="";
				$Fecha_Cierre="";
				if(count($partes)>1){
					$Id_Solicitud=$partes[0];
					$Fecha_Seguimiento=$partes[1];
					$Fecha_Cierre=$partes[2];
				}

				$Data= array(
					"Id_Nota_Salida"=>$row["Id_Nota_Salida"],
					"Empresa_Recibe"=>$row["Empresa_Recibe"],
					"Desc_Ubic_Prim" => rtrim(ltrim($row["Desc_Ubic_Prim"])),
					"Desc_Ubic_Sec" => rtrim(ltrim($row["Desc_Ubic_Sec"])),
					"Desc_Motivo_Alta" => rtrim(ltrim($row["Desc_Motivo_Alta"])),
					"Nombre_Realiza_Nota" => rtrim(ltrim($row["Nombre_Realiza_Nota"])),
					"Nombre_Quien_Autoriza" => rtrim(ltrim($row["Nombre_Quien_Autoriza"])),
					"Recibe" => rtrim(ltrim($row["Recibe"])),
					"Fech_Firma_Recibe" => rtrim(ltrim($row["Fech_Firma_Recibe"])),
					"Id_Solicitud" => rtrim(ltrim($Id_Solicitud)),
					"Fecha_Seguimiento" => rtrim(ltrim($Fecha_Seguimiento)),
					"Fecha_Cierre" => rtrim(ltrim($Fecha_Cierre))
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

public function historial_cancelacion_notas_salida($Id_Area, $Fech_Inicial, $Fech_Final, $proveedor=null){
	$respuesta = array();	
	$Data = array();
	$Data_Envia = array();
	$error=false;

	$proveedor = new Proveedor('sqlserver', 'activos');
	$proveedor->connect();
	$sql="
		select 
			Id_Cancelacion_Nota, sc.Id_Solicitud, ss.Empresa_Ext, 'Nombre: '+ss.Nombre_Act_Ext+'<br>Marca: '+ss.Marca_Act_Ext+'<br>Modelo: '+ss.Modelo_Act_Ext+'<br>No. Serie: '+ss.No_Serie_Act_Ext as Equipo, Desc_Motivio_Cancelacion, FORMAT(sc.Fech_Inser,'yyyy/MM/dd HH:mm:ss') as Fech_Inser, su.Nombre_Usuario as Usuario_Cancelo,
			FORMAT(ss.Fech_Seguimiento,'yyyy/MM/dd HH:mm:ss') as Fecha_Seguimiento, 
			CONVERT(BIGINT, FORMAT(ss.Fech_Cierre, 'yyyyMMddHHmmss')) as Fecha_Cierre
		from siga_cancelacion_nota_salida sc 
		left join siga_solicitud_tickets ss on sc.Id_Solicitud=ss.Id_Solicitud
		left join siga_usuarios su on sc.Usr_Inser=su.Id_Usuario
		where 
			sc.Estatus_Reg<>3  and ss.Estatus_Reg<>3 and ss.Id_Area=".$Id_Area;
	
	if($Fech_Inicial!="" && $Fech_Final!=""){
		$sql.=" and CONVERT(DATE,sc.Fech_Inser) BETWEEN CONVERT(DATE, '".$Fech_Inicial."') AND CONVERT(DATE, '".$Fech_Final."')  ";
	}else{
		$sql.=" and sc.Fech_Inser>=CONVERT(DATE,GETDATE()-365) ";
	}
    
	//echo $sql;
	$proveedor->execute($sql);
	if (!$proveedor->error()) {
		if ($proveedor->rows($proveedor->stmt) > 0) {
			while ($row = $proveedor->fetch_array($proveedor->stmt, 0)) {
				$Data= array(
					"Id_Cancelacion_Nota"=>$row["Id_Cancelacion_Nota"],
					"Id_Solicitud"=>$row["Id_Solicitud"],
					"Empresa_Ext"=>rtrim(ltrim($row["Empresa_Ext"])),
					"Equipo" => rtrim(ltrim($row["Equipo"])),
					"Desc_Motivio_Cancelacion" => rtrim(ltrim($row["Desc_Motivio_Cancelacion"])),
					"Usuario_Cancelo" => rtrim(ltrim($row["Usuario_Cancelo"])),
					"Fech_Inser" => rtrim(ltrim($row["Fech_Inser"])),
					"Fecha_Seguimiento" => rtrim(ltrim($row["Fecha_Seguimiento"])),
					"Fecha_Cierre" => rtrim(ltrim($row["Fecha_Cierre"]))
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

public function getworkflow_alta($Id_Activo,$proveedor=null){
    $respuesta = array();
	$Data = array();
	$Data_Envia = array();
	$error=false;

	$proveedor = new Proveedor('sqlserver', 'activos');
	$proveedor->connect();
	$sql="
        select 
			WA.Id_Alta_Activo,
			WA.CveWorkflow,
			WA.DescWorflow,
			WA.FechaAlta,
			WA.Correo,
			WA.Aceptado,
			WA.Id_Activo,
			WA.No_Empleado,
			WA.Nombre,
			WA.FechaAceptado,
			WA.Comentarios
		from 
			siga_workflow_alta_activo WA 
		where 
			WA.Id_Activo=".$Id_Activo." order by CveWorkflow asc
    ";
	$proveedor->execute($sql);
	if (!$proveedor->error()) {
		if ($proveedor->rows($proveedor->stmt) > 0) {
			while ($row = $proveedor->fetch_array($proveedor->stmt, 0)) {
				$Data= array(		
					"Id_Alta_Activo"=>$row["Id_Alta_Activo"],
					"CveWorkflow" => rtrim(ltrim($row["CveWorkflow"])),
					"DescWorflow" => rtrim(ltrim($row["DescWorflow"])),
					"FechaAlta" => rtrim(ltrim($row["FechaAlta"])),
					"Correo" => rtrim(ltrim($row["Correo"])),
					"Aceptado" => rtrim(ltrim($row["Aceptado"])),
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

public function generapoliza($fechinicio, $fechfin, $proveedor=null){
    $respuesta = array();
	$Data = array();
	$DataEquipMedProp = array();
	$Data_Envia = array();
	$Data_Envia_EquipMedProp = array();
	$consolidado=array();
	$equipoPropio=array();
	$error=false;

	$proveedor = new Proveedor('sqlserver', 'activos');
	$proveedor->connect();
	$sql="
		select 
			*,
			case when 
				Baja_Activo is null and YEAR(CONVERT(date, Fech_Inserddmmaaaa, 103))>=2025  
				and Id_Activo not in (select Id_Activo from siga_poliza_biomedica spb where spb.Id_Activo=fn.Id_Activo and spb.Estatus_Activo='Alta')
			then 'Alta'
			else '' end as Alta_Activo
		from 
			fn_vw_polizabiomedica('".$fechinicio."', '".$fechfin."')  fn
		WHERE 
		(
			(
				CONVERT(DATE, Fech_Inser, 103) >= CONVERT(DATE, '".$fechinicio."', 103)
  				AND 
				CONVERT(DATE, Fech_Inser, 103) <=  CONVERT(DATE, '".$fechfin."', 103)
			)
			or
			(
				CONVERT(DATE, Fech_Inserddmmaaaa, 103) >= CONVERT(DATE, '".$fechinicio."', 103)
  				AND 
				CONVERT(DATE, Fech_Inserddmmaaaa, 103) <=  CONVERT(DATE, '".$fechfin."', 103)
			)
		)
		AND (
			Baja_Activo IS NULL 
			OR Baja_Activo != 'Baja'
			OR (Baja_Activo = 'Baja' AND YEAR(CONVERT(date, Fech_Inserddmmaaaa, 103)) >= 2025)
		) 
		and Id_Activo not in (select Id_Activo from siga_poliza_biomedica spb where spb.Id_Activo=fn.Id_Activo and spb.Estatus_Activo in('Baja', 'Proceso de Baja') )	
    ";
	//echo "<pre>";
	//echo $sql;
	//echo "</pre>";
	$rentaHS=0;
	$comodatoHS=0;
	$sistemaIntegralHS=0;
	$valorTotalHS=0;

	$comodatorentaCEH=0;
	$valorTotalCEH=0;

	$comodatorentaCIR=0;
	$valorTotalCIR=0;

	$rentaCME=0;
	$comodatoCME=0;
	$valorTotalCME=0;
	$TotalNoPropio=0;
	$TotalGeneral=0;
	$proveedor->execute($sql);
	if (!$proveedor->error()) {
		if ($proveedor->rows($proveedor->stmt) > 0) {
			while ($row = $proveedor->fetch_array($proveedor->stmt, 0)) {
				if ($row["Baja_Activo"] != "Baja" && $row["Proceso_Baja"] != "Proceso de Baja") {
					if (!empty($row["ImporteSeguroSF"])) {
						if ($row["Unidad"] == "HS") {
							if ($row["Propiedad"] == "RENTA") {
								$rentaHS += $row["ImporteSeguroSF"];
							} elseif ($row["Propiedad"] == "COMODATO") {
								$comodatoHS += $row["ImporteSeguroSF"];
							} elseif ($row["Propiedad"] == "SISTEMA INTEGRAL") {
								$sistemaIntegralHS += $row["ImporteSeguroSF"];
							} else {
								$DataEquipMedProp = array(
									"Id_Activo" => $row["Id_Activo"],
									"AF_BC" => $row["AF_BC"],
									"Nombre_Activo" => $row["Nombre_Activo"],
									"Unidad" => $row["Unidad"],
									"Desc_Ubic_Prim" => rtrim(ltrim($row["Desc_Ubic_Prim"])),
									"Desc_Ubic_Sec" => rtrim(ltrim($row["Desc_Ubic_Sec"])),
									"Propiedad" => $row["Propiedad"],
									"ImporteSeguroSF" => $row["ImporteSeguroSF"]
								);
								array_push($Data_Envia_EquipMedProp, $DataEquipMedProp);
							}
						} elseif ($row["Unidad"] == "CEH") {
							if ($row["Propiedad"] == "RENTA" || $row["Propiedad"] == "COMODATO") {
								$comodatorentaCEH += $row["ImporteSeguroSF"];
							} else {
								$DataEquipMedProp = array(
									"Id_Activo" => $row["Id_Activo"],
									"AF_BC" => $row["AF_BC"],
									"Nombre_Activo" => $row["Nombre_Activo"],
									"Unidad" => $row["Unidad"],
									"Desc_Ubic_Prim" => rtrim(ltrim($row["Desc_Ubic_Prim"])),
									"Desc_Ubic_Sec" => rtrim(ltrim($row["Desc_Ubic_Sec"])),
									"Propiedad" => $row["Propiedad"],
									"ImporteSeguroSF" => $row["ImporteSeguroSF"]
								);
								array_push($Data_Envia_EquipMedProp, $DataEquipMedProp);
							}
						} elseif ($row["Unidad"] == "CIR") {
							if ($row["Propiedad"] == "RENTA" || $row["Propiedad"] == "COMODATO") {
								$comodatorentaCIR += $row["ImporteSeguroSF"];
							} else {
								$DataEquipMedProp = array(
									"Id_Activo" => $row["Id_Activo"],
									"AF_BC" => $row["AF_BC"],
									"Nombre_Activo" => $row["Nombre_Activo"],
									"Unidad" => $row["Unidad"],
									"Desc_Ubic_Prim" => rtrim(ltrim($row["Desc_Ubic_Prim"])),
									"Desc_Ubic_Sec" => rtrim(ltrim($row["Desc_Ubic_Sec"])),
									"Propiedad" => $row["Propiedad"],
									"ImporteSeguroSF" => $row["ImporteSeguroSF"]
								);
								array_push($Data_Envia_EquipMedProp, $DataEquipMedProp);
							}
						} elseif ($row["Unidad"] == "CME") {
							if ($row["Propiedad"] == "RENTA") {
								$rentaCME += $row["ImporteSeguroSF"];
							} elseif ($row["Propiedad"] == "COMODATO") {
								$comodatoCME += $row["ImporteSeguroSF"];
							} else {
								$DataEquipMedProp = array(
									"Id_Activo" => $row["Id_Activo"],
									"AF_BC" => $row["AF_BC"],
									"Nombre_Activo" => $row["Nombre_Activo"],
									"Unidad" => $row["Unidad"],
									"Desc_Ubic_Prim" => rtrim(ltrim($row["Desc_Ubic_Prim"])),
									"Desc_Ubic_Sec" => rtrim(ltrim($row["Desc_Ubic_Sec"])),
									"Propiedad" => $row["Propiedad"],
									"ImporteSeguroSF" => $row["ImporteSeguroSF"]
								);
								array_push($Data_Envia_EquipMedProp, $DataEquipMedProp);
							}
						} else {
							$DataEquipMedProp = array(
								"Id_Activo" => $row["Id_Activo"],
								"AF_BC" => $row["AF_BC"],
								"Nombre_Activo" => $row["Nombre_Activo"],
								"Unidad" => $row["Unidad"],
								"Desc_Ubic_Prim" => rtrim(ltrim($row["Desc_Ubic_Prim"])),
								"Desc_Ubic_Sec" => rtrim(ltrim($row["Desc_Ubic_Sec"])),
								"Propiedad" => $row["Propiedad"],
								"ImporteSeguroSF" => $row["ImporteSeguroSF"]
							);
							array_push($Data_Envia_EquipMedProp, $DataEquipMedProp);
						}
					}
				}
				
				
				$Data= array(		
					"Hoja"=>$row["Hoja"],
					"Id_Activo" => rtrim(ltrim($row["Id_Activo"])),
					"AF_BC" => rtrim(ltrim($row["AF_BC"])),
					"Nombre_Activo" => rtrim(ltrim($row["Nombre_Activo"])),
					"Fech_Inserddmmaaaa" => rtrim(ltrim($row["Fech_Inserddmmaaaa"])),
					"Fech_Inser" => rtrim(ltrim($row["Fech_Inser"])),
					"Marca" => rtrim(ltrim($row["Marca"])),
					"Modelo" => rtrim(ltrim($row["Modelo"])),
                    "NumSerie" => rtrim(ltrim($row["NumSerie"])),
                    "Desc_Ubic_Prim" => rtrim(ltrim($row["Desc_Ubic_Prim"])),
					"Desc_Ubic_Sec" => rtrim(ltrim($row["Desc_Ubic_Sec"])),
					"Unidad" => rtrim(ltrim($row["Unidad"])),
                    "Propiedad" => rtrim(ltrim($row["Propiedad"])),
                    "ImporteSeguros" => rtrim(ltrim($row["ImporteSeguros"])),
					"ImporteSeguroSF" => rtrim(ltrim($row["ImporteSeguroSF"])),
					"Baja_Activo" => rtrim(ltrim($row["Baja_Activo"])),
					"Proceso_Baja" => rtrim(ltrim($row["Proceso_Baja"])),
					"Alta_Activo" => rtrim(ltrim($row["Alta_Activo"]))
				);
				array_push($Data_Envia, $Data);
            }

			
			$valorTotalHS = $rentaHS + $comodatoHS + $sistemaIntegralHS;
			$valorTotalCEH = $comodatorentaCEH;
			$valorTotalCIR = $comodatorentaCIR;
			$valorTotalCME = $rentaCME + $comodatoCME;
			$TotalNoPropio= $valorTotalHS + $valorTotalCEH + $valorTotalCIR + $valorTotalCME;

			$agrupado = array();
			$totalequipopropio = 0;
			for($i=0; $i<count($Data_Envia_EquipMedProp); $i++){
				$unidad = $Data_Envia_EquipMedProp[$i]['Unidad'];
				$importe = floatval($Data_Envia_EquipMedProp[$i]['ImporteSeguroSF']);
				
				if (!isset($agrupado[$unidad])) {
					$agrupado[$unidad] = 0;
				}
				$agrupado[$unidad] += $importe;
			}

			// Convertir a array de la forma solicitada
			$data = array();
			foreach ($agrupado as $unidad => $importe) {
				$totalequipopropio += $importe;
				$data[] = array("unidad" => $unidad, "importe" => $importe);
			}
			$TotalGeneral=$TotalNoPropio + $totalequipopropio;
			$consolidado = array(
				"rentaHS" => $rentaHS,
				"comodatoHS" => $comodatoHS,
				"sistemaIntegralHS" => $sistemaIntegralHS,
				"valorTotalHS" => $valorTotalHS,
				"comodatorentaCEH" => $comodatorentaCEH,
				"valorTotalCEH" => $valorTotalCEH,
				"comodatorentaCIR" => $comodatorentaCIR,
				"valorTotalCIR" => $valorTotalCIR,
				"rentaCME" => $rentaCME,
				"comodatoCME" => $comodatoCME,
				"valorTotalCME" => $valorTotalCME,
				"TotalNoPropio" => $TotalNoPropio,
				"equiposMedPropDetTotal" => count($Data_Envia_EquipMedProp),
				"equiposMedPropDet" => $Data_Envia_EquipMedProp,
				"equiposMedPropConsolidado" => $data,
				"TotalPropio" => $totalequipopropio,
				"TotalGeneral" => $TotalGeneral
			);
		}
	}else{
		$error=true;
	}
	$proveedor->close();
	
	//Fin 
	if($error==false){
		$respuesta = array("totalCount" => count($Data_Envia), "data" => $Data_Envia, "consolidado" => $consolidado, "estatus" => "ok", "mensaje" => "Registros Encontrados");   	
	}else{
		$respuesta = array("totalCount" => "0", "data" => "", "estatus" => "error", "mensaje" => "Ocurrio un Error al Buscar");   	
	}
	
	return $respuesta;
}

public function polizasegurosbiomedica($fechinicio, $fechfin, $arrayres, $proveedor=null){
    $respuesta = array();
	$error=false;
	$arrayinsert = json_decode($arrayres, true);
	
	$proveedor = new Proveedor('sqlserver', 'activos');
	$proveedor->connect();
	
	$proveedor->beginTransaction();

	for($i=0; $i<$arrayinsert["totalCount"]; $i++){
		$estatus="";
		if($arrayinsert["data"][$i]["Baja_Activo"]!=""){
			$estatus = $arrayinsert["data"][$i]["Baja_Activo"];
		}

		if($arrayinsert["data"][$i]["Alta_Activo"]!=""){
			$estatus = $arrayinsert["data"][$i]["Alta_Activo"];
		}

		if($arrayinsert["data"][$i]["Proceso_Baja"]!=""){
			$estatus = $arrayinsert["data"][$i]["Proceso_Baja"];
		}


		if($estatus!=""){
			//$EstatusAltaBaja= $arrayinsert["data"][$i]["Baja_Activo"]??$arrayinsert["data"][$i]["Alta_Activo"];
			$sql = "INSERT INTO siga_poliza_biomedica (
					Id_Activo, 
					AF_BC, 
					Nombre_Activo, 
					Fech_Alta_Baja, 
					Hoja, 
					Unidad, 
					Importe_Seguro, 
					Estatus_Activo, 
					Proceso_Baja,
					Periodo_Busqueda, 
					FechaAlta) VALUES (";
			$sql .=$arrayinsert["data"][$i]["Id_Activo"].", ";
			$sql .="'".$arrayinsert["data"][$i]["AF_BC"]."', ";
			$sql .="'".$arrayinsert["data"][$i]["Nombre_Activo"]."', ";
			$sql .="'".$arrayinsert["data"][$i]["Fech_Inserddmmaaaa"]."', ";
			$sql .="'".$arrayinsert["data"][$i]["Hoja"]."', ";
			$sql .="'".$arrayinsert["data"][$i]["Unidad"]."', ";
			$sql .="'".$arrayinsert["data"][$i]["ImporteSeguros"]."', ";
			$sql .="'".$estatus."', ";
			$sql .="'".$arrayinsert["data"][$i]["Proceso_Baja"]."', ";
			$sql .="'".$fechinicio."-".$fechfin."', ";
			$sql .="getdate())";

			//echo $sql;
			//echo "<br>";
			$proveedor->execute($sql);
			if (!$proveedor->error()) {
			}else{
				$error = true;
			}
		}
	}

	if($error==false){
		$proveedor->commit();
		$respuesta = array("totalCount" => "1", "estatus" => "ok", "text" => "POLIZA GENERADA CORRECTAMENTE");
	}else{
		$proveedor->rollback();
		$respuesta = array("totalCount" => "0",  "estatus" => "error", "text" => "OCURRIO UN ERROR AL GUARDAR");
	}
	$proveedor->close();
	
	return $respuesta;
}

public function resetearpoliza($proveedor=null){
    $respuesta = array();
	$error=false;
	
	$proveedor = new Proveedor('sqlserver', 'activos');
	$proveedor->connect();
	
	$proveedor->beginTransaction();

	$sql = "DELETE FROM siga_poliza_biomedica ";

	$proveedor->execute($sql);
	if (!$proveedor->error()) {
	}else{
		$error = true;
	}

	if($error==false){
		$proveedor->commit();
		$respuesta = array("totalCount" => "1", "estatus" => "ok", "text" => "POLIZA ELIMINADA CORRECTAMENTE");
	}else{
		$proveedor->rollback();
		$respuesta = array("totalCount" => "0",  "estatus" => "error", "text" => "OCURRIO UN ERROR AL ELIMINAR");
	}
	$proveedor->close();
	
	return $respuesta;
}

public function selectbusqueda_activos_nota_salida_gtiqx($siga_activosDto,$Empresa, $Cadena, $Id_Usuario, $proveedor=null){
  $Data = array();
	$Data_Envia = array();
	
	$respuesta = array();
	$error=false;
	
	$proveedor = new Proveedor('sqlserver', 'activos');
	$proveedor->connect();
	
	$sql="SELECT st.Id_Solicitud,
							st.Id_Activo,
							st.Id_Cirugia,
							st.Activo_Externo,
							st.AF_BC_Ext,
							st.Nombre_Act_Ext,
							st.Marca_Act_Ext,
							st.Modelo_Act_Ext,
							st.No_Serie_Act_Ext,
							st.Cantidad_Equ_Ext,
							st.Empresa_Ext,
							st.Nombre_Completo_Ext,
							st.Telefono_Ext,
							st.Correo_Ext,
							st.Id_Ubic_Prim,
							st.Id_Ubic_Sec,
							Desc_Ubic_Prim,
							Desc_Ubic_Sec,
							FORMAT (st.Fech_Cierre, 'yyyy-MM-dd') as Fech_Cierre,
							FORMAT (st.Fech_Solicitud, 'yyyy-MM-dd') as Fech_Solicitud,
							(select TOP 1 Id_Gestor from siga_cat_gestores where Tipo_Gestor=1 and Estatus_Reg<>3 and Id_area=st.Id_Area and Id_Usuario=".$Id_Usuario.") as Gestor_Senior
		FROM siga_solicitud_tickets st
		LEFT JOIN siga_cat_ubic_prim CUP 	ON st.Id_Ubic_Prim = CUP.Id_Ubic_Prim
		LEFT JOIN siga_cat_ubic_sec CUS 	ON st.Id_Ubic_Sec = CUS.Id_Ubic_Sec
		LEFT OUTER JOIN siga_cancelacion_nota_salida cn ON st.Id_Solicitud=cn.Id_Solicitud 
			AND cn.Estatus_Reg<>3 
		WHERE st.Estatus_Proceso=4 
			AND st.Estatus_Reg <>3 
			AND st.Id_Cirugia IS NOT null 
			AND cn.Id_Cancelacion_Nota IS NULL
			AND st.Empresa_Ext !=''
      AND st.Empresa_Ext is not null
			AND st.Id_Solicitud NOT IN(SELECT DISTINCT Id_Solicitud_DNS FROM siga_det_nota_salida LEFT JOIN siga_nota_salida ON siga_det_nota_salida.Id_Nota_Salida_DNS=siga_nota_salida.Id_Nota_Salida
		WHERE Id_Solicitud_DNS is not null AND Tipo_Solicitud=1 AND siga_nota_salida.Estatus_Reg<>3 AND Nota_Duplicada <>1)
	";
	
	if($siga_activosDto->getId_Area()!=""){
		$sql.=" and st.Id_Area=".$siga_activosDto->getId_Area();
	}
	// JAAP 22/05/2025
	// if($Empresa!=""){
	// 	$sql.=" and st.Empresa_Ext=RTRIM(LTRIM('".$Empresa."'))";
	// }
	
	if($Cadena!=""){
		$sql.=" and st.Id_Solicitud in(".$Cadena.")";
	}
	
	$proveedor->execute($sql);
	
	//echo "<pre>";
	//echo $sql;
	//echo "</pre>";
	if (!$proveedor->error()){
		//La posicion cero no se toma
		if ($proveedor->rows($proveedor->stmt) > 0) {
			while ($row_c = $proveedor->fetch_array($proveedor->stmt, 0)) {
				$Data_Acc_d = array();
				$Data_Acc_d_Envia = array();
				if($Cadena!=""){
					$proveedor_acc_d = new Proveedor('sqlserver', 'activos');
					$proveedor_acc_d->connect();
					$sql="select * from siga_det_accesorios_act_ext where Id_Solicitud_Ext=".$row_c["Id_Solicitud"]." and Estatus_Reg_Ext<>3";
					$proveedor_acc_d->execute($sql);
					if (!$proveedor_acc_d->error()){
						if ($proveedor_acc_d->rows($proveedor_acc_d->stmt) > 0) {
							while ($row_d = $proveedor_acc_d->fetch_array($proveedor_acc_d->stmt, 0)) {
								$Data_Acc_d= array(
									"Id_Accesorio_Ext"=>$row_d["Id_Accesorio_Ext"],
									"Nombre_Ext"=>rtrim(ltrim($row_d["Nombre_Ext"])),
									"Cantidad_Ext"=>rtrim(ltrim($row_d["Cantidad_Ext"])),
									"Marca_Ext"=>rtrim(ltrim($row_d["Marca_Ext"])),
									"Modelo_Ext"=>rtrim(ltrim($row_d["Modelo_Ext"])),
									"No_Serie_Ext"=>rtrim(ltrim($row_d["No_Serie_Ext"]))
									
								);
								array_push($Data_Acc_d_Envia, $Data_Acc_d);
							}
						}	
					}else{
						$error=true;
					}
							
					$proveedor_acc_d->close();
				}
				
				
				
				$Gestor_Senior=0;
				if($row_c["Gestor_Senior"]!=NULL && $row_c["Gestor_Senior"]!=''){
					$Gestor_Senior=1;	
				}
				$Data= array(
					"Id_Solicitud"=>$row_c["Id_Solicitud"],
					"Id_Activo"=>$row_c["Id_Activo"],
					"Id_Cirugia"=>$row_c["Id_Cirugia"],
					"Activo_Externo"=>$row_c["Activo_Externo"],
					"AF_BC_Ext"=>$row_c["AF_BC_Ext"],
					"Nombre_Act_Ext"=>$row_c["Nombre_Act_Ext"],
					"Marca_Act_Ext"=>$row_c["Marca_Act_Ext"],
					"Modelo_Act_Ext"=>$row_c["Modelo_Act_Ext"],
					"No_Serie_Act_Ext"=>$row_c["No_Serie_Act_Ext"],
					"Cantidad_Equ_Ext"=>$row_c["Cantidad_Equ_Ext"],
					"Empresa_Ext"=>$row_c["Empresa_Ext"],
					"Nombre_Completo_Ext"=>$row_c["Nombre_Completo_Ext"],
					"Telefono_Ext"=>$row_c["Telefono_Ext"],
					"Correo_Ext"=>$row_c["Correo_Ext"],
					"Desc_Ubic_Prim"=>$row_c["Desc_Ubic_Prim"],
					"Id_Ubic_Prim"=>rtrim(ltrim($row_c["Id_Ubic_Prim"])),
					"Id_Ubic_Sec"=>rtrim(ltrim($row_c["Id_Ubic_Sec"])),
					"Desc_Ubic_Sec"=>$row_c["Desc_Ubic_Sec"],
					"Count_Acc_D"=>count($Data_Acc_d_Envia),
					"Data_Acc_D"=>$Data_Acc_d_Envia,
					"Gestor_Senior"=>$Gestor_Senior,
					"Fech_Solicitud"=>$row_c["Fech_Solicitud"],
					"Fech_Cierre"=>$row_c["Fech_Cierre"]
				);
				array_push($Data_Envia, $Data);
			}
		}	
	}else{
		$error=true;
	}
	
	$proveedor->close();
	if($error==false){
		$respuesta = array("totalCount" => count($Data_Envia),"data" => $Data_Envia,"estatus" => "OK!!", "mensaje" => "Registros Encontrados");
	}else{
		$respuesta = array("totalCount" => "0", "data" => "","estatus" => "error", "mensaje" => "No se Encontraron Registros");
	}
	return $respuesta;
	
	
}


public function Cancelar_Nota_Salida($Id_Solicitud, $Motivo_Cancelacion, $Usr_Inser, $proveedor=null){
	$respuesta = array();
	$error=false;
	
	
	if($Id_Solicitud!=""){
		$proveedor = new Proveedor('sqlserver', 'activos');
		$proveedor->connect();
	
		$sql="
			insert into siga_cancelacion_nota_salida (Id_Solicitud, Desc_Motivio_Cancelacion, Fech_Inser, Usr_Inser, Estatus_Reg)
			values (".$Id_Solicitud.", '".$Motivo_Cancelacion."', getdate(), '".$Usr_Inser."', 1)
		";
		$proveedor->execute($sql);
		if (!$proveedor->error()){
			
		}else{
			$error=true;
		}
		$proveedor->close();
	}else{
		$error=true;
	}
	
	
	if($error==false){
		$respuesta = array("totalCount" => "1", "estatus" => "ok", "mensaje" => "Registro Cancelado Correctamente");
	}else{
		$respuesta = array("totalCount" => "0","estatus" => "error", "mensaje" => "Ocurrio un error al Cancelar");
	}
	
	return $respuesta;
}


public function Cancelar_Nota_Salida_Proceso($Id_Nota_Salida, $Motivo_Cancelacion, $Usr_Inser, $proveedor=null){
	
	$respuesta = array();
	$error=false;
	
	
	if($Id_Nota_Salida!=""){
		$proveedor = new Proveedor('sqlserver', 'activos');
		$proveedor->connect();
	
		$sql="
			update siga_nota_salida set Estatus_Reg=3, Fech_Mod=getdate(), Usr_Mod='".$Usr_Inser."', Desc_Motivo_Cancel_Proceso='".$Motivo_Cancelacion."'
			where Id_Nota_Salida=".$Id_Nota_Salida."
			-------------
			update siga_det_nota_salida set Estatus_Reg_DNS=3, Fech_Mod_DNS=getdate()
			where Id_Nota_Salida_DNS=".$Id_Nota_Salida."
			
		";
		
		//echo "<pre>";
		//echo $sql;
		//echo "</pre>";
		$proveedor->execute($sql);
		if (!$proveedor->error()){
			
		}else{
			$error=true;
		}
		$proveedor->close();
	}else{
		$error=true;
	}
	
	
	if($error==false){
		$respuesta = array("totalCount" => "1", "estatus" => "ok", "mensaje" => "Registro Cancelado Correctamente");
	}else{
		$respuesta = array("totalCount" => "0","estatus" => "error", "mensaje" => "Ocurrio un error al Cancelar");
	}
	
	return $respuesta;
}


public function select_activos($siga_activosDto,$soloactivos,$proveedor=null){
//$Siga_activosDao = new Siga_activosDAO();
//$Siga_activosDto = $Siga_activosDao->selectbusqueda_activos($Siga_activosDto,$proveedor);
	$respuesta = array();	
	$campos=[];
	$contador = 0;
	$error=false;

	$proveedor = new Proveedor('sqlserver', 'activos');
	$proveedor->connect();
	$sql="SELECT A.Especifica, A.Id_Activo, A.AF_BC, A.Nombre_Activo, A.Id_Tipo_Vale_Resg, 
								A.Id_Area, CA.Nom_Area, A.Id_Departamento, CD.Des_Departamento, A.Num_Empleado, A.Nombre_Completo, 
								A.Estatus_Reg, A.Foto, A.Id_Clase,A.Id_Clasificacion, A.Id_Propiedad, 
								CP.Desc_Propiedad,A.Id_Tipo_Activo, A.DescCorta, A.DescLarga, A.Id_Ubic_Prim, 
								CUP.Desc_Ubic_Prim, A.Id_Ubic_Sec, A.Id_Situacion_Activo,CUS.Desc_Ubic_Sec, A.Id_Motivo_Alta, 
								A.Id_Familia, CS.Desc_Subfamilia,A.Marca, A.Modelo, A.NumSerie, A.Id_ActivoPadre, A.NumActivoAnterior, 
								JA.Nombre, Act.Nombre_Rutina, A.Id_Situacion_Activo,C.Desc_Estatus AS Estatus,
								(SELECT top 1 Centro_Costos FROM siga_activos_contabilidad WHERE A.Id_Activo=siga_activos_contabilidad.Id_Activo) AS Centro_Costos";	
	$sql.=" FROM siga_activos A";
	$sql.=" LEFT JOIN siga_cat_ubic_prim CUP on A.Id_Ubic_Prim = CUP.Id_Ubic_Prim";
	$sql.=" LEFT JOIN siga_cat_ubic_sec CUS on A.Id_Ubic_Sec = CUS.Id_Ubic_Sec";
	$sql.=" LEFT JOIN siga_catareas CA on A.Id_Area = CA.Id_Area";
	$sql.=" LEFT JOIN siga_cat_propiedad CP on A.Id_Propiedad = CP.Id_Propiedad";
	$sql.=" LEFT JOIN siga_cat_familia CF on A.Id_Familia = CF.Id_Familia";
	$sql.=" LEFT JOIN siga_cat_subfamilia CS on A.Id_Subfamilia = CS.Id_Subfamilia";
	$sql.=" LEFT JOIN siga_cat_departamento CD on A.Id_Departamento = CD.Id_Departamento";
	$sql.=" LEFT JOIN siga_jefe_area JA on A.Id_Area = JA.Id_Area";
	$sql.="	LEFT JOIN siga_actividades Act on A.Id_Activo=Act.Id_Activo";
	$sql.="	LEFT JOIN siga_cat_estatus C on  C.Id_Estatus=A.Id_Situacion_Activo";
	
	if($soloactivos==1){
		$sql.=" left outer join siga_baja_activo SB on A.Id_Activo=SB.Id_Activo and SB.Estatus_Cancelacion<>0 ";
	}
	
	$sql.=" WHERE A.Estatus_Reg <> '3' "; //and A.Id_Situacion_Activo<>'12'
	//if($soloactivos==1){
	//	$sql="	and SB.Estatus_Cancelacion<>0 and";
	//}
	
	if(($siga_activosDto->getId_Activo()!="") || ($siga_activosDto->getId_Ubic_Prim()!="") ||($siga_activosDto->getId_Ubic_Sec()!="") ||($siga_activosDto->getId_Area()!="") ||($siga_activosDto->getId_Propiedad()!="") ||($siga_activosDto->getId_Familia()!="") ||($siga_activosDto->getId_Subfamilia()!="") ||($siga_activosDto->getId_Departamento()!=""))
	{
		$sql.=" AND ";
	}
	
	if($siga_activosDto->getId_Activo()!=""){
		$sql.=" A.Id_Activo='".$siga_activosDto->getId_Activo()."'";
		if(($siga_activosDto->getId_Ubic_Prim()!="") ||($siga_activosDto->getId_Ubic_Sec()!="") ||($siga_activosDto->getId_Area()!="") ||($siga_activosDto->getId_Propiedad()!="") ||($siga_activosDto->getId_Familia()!="") ||($siga_activosDto->getId_Subfamilia()!="") ||($siga_activosDto->getId_Departamento()!=""))
		{
			$sql.=" AND ";
		}
	}
	
	if($siga_activosDto->getId_Ubic_Prim()!=""){
		$sql.=" A.Id_Ubic_Prim='".$siga_activosDto->getId_Ubic_Prim()."'";
		if(($siga_activosDto->getId_Ubic_Sec()!="") ||($siga_activosDto->getId_Area()!="") ||($siga_activosDto->getId_Propiedad()!="") ||($siga_activosDto->getId_Familia()!="") ||($siga_activosDto->getId_Subfamilia()!="") ||($siga_activosDto->getId_Departamento()!=""))
		{
			$sql.=" AND ";
		}
	}
	
	if($siga_activosDto->getId_Ubic_Sec()!=""){
		$sql.=" A.Id_Ubic_Sec='".$siga_activosDto->getId_Ubic_Sec()."'";
		if(($siga_activosDto->getId_Area()!="") ||($siga_activosDto->getId_Propiedad()!="") ||($siga_activosDto->getId_Familia()!="") ||($siga_activosDto->getId_Subfamilia()!="") ||($siga_activosDto->getId_Departamento()!=""))
		{
			$sql.=" AND ";
		}
	}
	
	if($siga_activosDto->getId_Area()!=""){
		$sql.=" A.Id_Area='".$siga_activosDto->getId_Area()."'";
		if(($siga_activosDto->getId_Propiedad()!="") ||($siga_activosDto->getId_Familia()!="") ||($siga_activosDto->getId_Subfamilia()!="") ||($siga_activosDto->getId_Departamento()!=""))
		{
			$sql.=" AND ";
		}
	}
	
	if($siga_activosDto->getId_Propiedad()!=""){
		$sql.=" A.Id_Propiedad='".$siga_activosDto->getId_Propiedad()."'";
		if(($siga_activosDto->getId_Familia()!="") ||($siga_activosDto->getId_Subfamilia()!="") ||($siga_activosDto->getId_Departamento()!=""))
		{
			$sql.=" AND ";
		}
	}
	
	if($siga_activosDto->getId_Familia()!=""){
		$sql.=" A.Id_Familia='".$siga_activosDto->getId_Familia()."'";
		if(($siga_activosDto->getId_Subfamilia()!="") ||($siga_activosDto->getId_Departamento()!=""))
		{
			$sql.=" AND ";
		}
	}
	
	if($siga_activosDto->getId_Subfamilia()!=""){
		$sql.=" A.Id_Subfamilia='".$siga_activosDto->getId_Subfamilia()."'";
		if(($siga_activosDto->getId_Departamento()!=""))
		{
			$sql.=" AND ";
		}
	}
	
	if($siga_activosDto->getId_Departamento()!=""){
		$sql.=" A.Id_Departamento='".$siga_activosDto->getId_Departamento()."'";
	}
	
	if($siga_activosDto->getAF_BC()!=""){
		$sql.=" and A.AF_BC='".$siga_activosDto->getAF_BC()."'";
	}
	
$proveedor->execute($sql);
	if (!$proveedor->error()) {
		if ($proveedor->rows($proveedor->stmt) > 0) {
			
			while ($row = $proveedor->fetch_array($proveedor->stmt, 0)) {
				
				$campos[$contador] = array(
					"Id_Activo" => $row["Id_Activo"], 
					"AF_BC" => $row["AF_BC"], 
					"Nombre_Activo"=>$row["Nombre_Activo"], 
					"Id_Tipo_Vale_Resg"=>$row["Id_Tipo_Vale_Resg"], 
					"Id_Area"=>$row["Id_Area"],
					"Nom_Area"=>$row["Nom_Area"],
					'Id_Departamento'=>$row['Id_Departamento'],
					'Des_Departamento'=>$row['Des_Departamento'],
					'Num_Empleado'=>$row['Num_Empleado'],
					"Nombre_Completo" => $row["Nombre_Completo"], 
					"Estatus_Reg" => $row["Estatus_Reg"], 
					"Foto"=>$row["Foto"], 
					"Id_Clase"=>$row["Id_Clase"],
					"Id_Clasificacion"=>$row["Id_Clasificacion"], 
					"Id_Propiedad"=>$row["Id_Propiedad"],
					"Desc_Propiedad"=>$row["Desc_Propiedad"],
					'Id_Tipo_Activo'=>$row['Id_Tipo_Activo'],
					'DescCorta'=>$row['DescCorta'],
					'DescLarga'=>$row['DescLarga'],
					"Id_Ubic_Prim" => $row["Id_Ubic_Prim"], 
					"Desc_Ubic_Prim" => $row["Desc_Ubic_Prim"], 
					"Id_Ubic_Sec"=>$row["Id_Ubic_Sec"], 
					"Id_Situacion_Activo"=>$row["Id_Situacion_Activo"],
					"Desc_Ubic_Sec"=>$row["Desc_Ubic_Sec"], 
					"Id_Motivo_Alta"=>$row["Id_Motivo_Alta"],
					"Id_Familia"=>$row["Id_Familia"],
					'Desc_Subfamilia'=>$row['Desc_Subfamilia'],
					'Marca'=>$row['Marca'],
					'Modelo'=>$row['Modelo'],
					'NumSerie'=>$row['NumSerie'],
					'Id_ActivoPadre'=>$row['Id_ActivoPadre'],
					'NumActivoAnterior'=>$row['NumActivoAnterior'],
					'Jefe_Area'=>$row['Nombre'],
					'Nombre_Rutina'=>rtrim(ltrim($row['Nombre_Rutina'])),
					'Estatus'=>rtrim(ltrim($row['Estatus'])),
					'Especifica'=>rtrim(ltrim($row['Especifica'])),
					'Centro_Costos'=>rtrim(ltrim($row['Centro_Costos']))
				);
                $contador++;
            }
		}
	}else{
		$error=true;
	}
	$proveedor->close();
	
	//Fin 
	if($error==false){
		$respuesta = array("totalCount" => count($campos), "data" => $campos, "estatus" => "ok", "mensaje" => "Registros Encontrados");   	
	}else{
		$respuesta = array("totalCount" => "0", "data" => "", "estatus" => "error", "mensaje" => "Ocurrio un Error al Buscar");   	
	}
	
	
	return $respuesta;
}

public function autocomplete_activos($siga_activosDto,$proveedor=null,$soloactivos){

	$respuesta = array();	
	$Data = array();
	$Data_Envia = array();
	$error=false;

	$proveedor = new Proveedor('sqlserver', 'activos');
	$proveedor->connect();
	$sql="
		select Id_Activo, AF_BC, Marca, Modelo, NumSerie, Num_Empleado, Nombre_Completo, Nombre_Activo, Id_Situacion_Activo, Id_Clase from siga_activos 
		where Estatus_Reg <>'3' ";//and Id_Situacion_Activo<>'12'
	
    if ($soloactivos ==1)	
	$sql .="  and Id_Activo not in (select Id_Activo from siga_baja_activo where Estatus_Cancelacion<>1) ";
	
	if($siga_activosDto->getId_Area()!=""){
		$sql.=" and Id_Area='".$siga_activosDto->getId_Area()."'";
	}

	//echo $sql;
	$proveedor->execute($sql);
	if (!$proveedor->error()) {
		if ($proveedor->rows($proveedor->stmt) > 0) {
			while ($row = $proveedor->fetch_array($proveedor->stmt, 0)) {
				$Data= array(
					"Id_Activo"=>$row["Id_Activo"],
					"AF_BC" => rtrim(ltrim($row["AF_BC"])),
					"Marca" => rtrim(ltrim($row["Marca"])),
					"Modelo" => rtrim(ltrim($row["Modelo"])),
					"NumSerie" => rtrim(ltrim($row["NumSerie"])),
					"Num_Empleado" => rtrim(ltrim($row["Num_Empleado"])),
					"Nombre_Completo" => rtrim(ltrim($row["Nombre_Completo"])),
					"Nombre_Activo" => rtrim(ltrim($row["Nombre_Activo"])),
					"Id_Clase" => rtrim(ltrim($row["Id_Clase"]))
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

public function usuarios_delegacion_autoridad($siga_activosDto){
	$respuesta = array();	
	$Data = array();
	$Data_Envia = array();
	$error=false;

	$proveedor = new Proveedor('sqlserver', 'activos');
	$proveedor->connect();
	$sql = "select * from siga_usuarios where No_Usuario in(select convert(varchar,num_emp) from [CHSTCASOL].CHS_APPS.dbo.delegacion_autoridad 
		left join [CHSTCASOL].CHS_APPS.dbo.empleados_chs on delegacion_autoridad.num_emp=empleados_chs.num_empleado
		where num_emp<>0 and estatus in(1,3) and notas_salida_evtos_rep=1";

	// Lista de Usuarios exclusivos para Biomédica
	if($siga_activosDto->getId_Area() == 1) {
		$sql .=" AND num_empleado IN (102, 378, 315, 255, 686, 1953, 88, 530, 1647, 1394, 587,1053,2977) ";
    }
	$sql .=") and Estatus_Reg <> 3 order by No_Usuario asc";
	
	$proveedor->execute($sql);
	if (!$proveedor->error()) {
		if ($proveedor->rows($proveedor->stmt) > 0) {
			while ($row = $proveedor->fetch_array($proveedor->stmt, 0)) {
				$Data= array(
					"Id_Usuario"=>$row["Id_Usuario"],
					"No_Usuario" => rtrim(ltrim($row["No_Usuario"])),
					"Nombre_Usuario" => rtrim(ltrim($row["Nombre_Usuario"])),
					"Correo" => rtrim(ltrim($row["Correo"])),
					"Usuario" => rtrim(ltrim($row["Usuario"])),
					"Password" => rtrim(ltrim($row["Password"])),
					"Puesto" => rtrim(ltrim($row["Puesto"])),
					"Activo_Fijo" => rtrim(ltrim($row["Activo_Fijo"])),
					"Mesa_Ayuda" => rtrim(ltrim($row["Mesa_Ayuda"]))
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


public function Tabla_Activos_Asis_Esp($siga_activosDto,$proveedor=null,$soloactivos){

	$respuesta = array();	
	$Data = array();
	$Data_Envia = array();
	$error=false;

	$proveedor = new Proveedor('sqlserver', 'activos');
	$proveedor->connect();
	$sql="
		select Id_Activo,AF_BC, Nombre_Activo, Marca, Modelo, NumSerie, UP.Desc_Ubic_Prim, US.Desc_Ubic_Sec, Foto, (select top 1 SU.Nombre_Usuario from siga_usuarios SU where SU.No_Usuario=convert(varchar,SA.Num_Empleado)) as Nombre_Responsable, SA.Id_Situacion_Activo 
		from siga_activos SA
		left join siga_cat_ubic_prim UP on SA.Id_Ubic_Prim=UP.Id_Ubic_Prim
		left join siga_cat_ubic_sec US on SA.Id_Ubic_Sec=US.Id_Ubic_Sec 
		where SA.Estatus_Reg<>'3' and SA.Id_Situacion_Activo<>'12'  ";
	
    if ($soloactivos ==1)	
	$sql .="  and SA.Id_Activo not in (select Id_Activo from siga_baja_activo where Estatus_Cancelacion<>1)";
	
	if($siga_activosDto->getId_Area()!=""){
		$sql.=" and SA.Id_Area='".$siga_activosDto->getId_Area()."'";
	}
	
	if($siga_activosDto->getNum_Empleado()!=""){
		$sql.=" and SA.Num_Empleado='".$siga_activosDto->getNum_Empleado()."'";
	}
	
	//echo $sql;
	$proveedor->execute($sql);
	if (!$proveedor->error()) {
		if ($proveedor->rows($proveedor->stmt) > 0) {
			while ($row = $proveedor->fetch_array($proveedor->stmt, 0)) {
				$Data= array(
					"Id_Activo"=>$row["Id_Activo"],
					"AF_BC" => rtrim(ltrim($row["AF_BC"])),
					"Nombre_Activo" => rtrim(ltrim($row["Nombre_Activo"])),
					"Marca" => rtrim(ltrim($row["Marca"])),
					"Modelo" => rtrim(ltrim($row["Modelo"])),
					"NumSerie" => rtrim(ltrim($row["NumSerie"])),
					"Desc_Ubic_Prim" => rtrim(ltrim($row["Desc_Ubic_Prim"])),
					"Desc_Ubic_Sec" => rtrim(ltrim($row["Desc_Ubic_Sec"])),
					"Foto" => rtrim(ltrim($row["Foto"])),
					"Id_Situacion_Activo"=>$row["Id_Situacion_Activo"],
					"Nombre_Responsable"=> rtrim(ltrim($row["Nombre_Responsable"]))
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


public function guardar_nota_salida($Id_Nota_Salida,  $Id_Ubic_Prim, $Id_Ubic_Sec, $Id_Motivo_Salida, $Id_Usuario, $Id_Usr_Quien_Autoriza, $Empresa_Recibe, $Nombre_Contacto, $Telefono_Contacto, $Mail_Contacto, $Observaciones, $Url_Adjuntos, $Tipo_Solicitud, $Id_Area, $Array_Equ_Acc, $Firma_Digital, $Estatus_Proceso, $Nota_Duplicada){
	$proveedor = new Proveedor('sqlserver', 'activos');
	$respuesta = array();
	$proveedor->connect();
	$Error = false;
	$msgError = null;

	$sql="
		insert into
		siga_nota_salida 
		(
			Id_Area_Realiza
			,Nota_Duplicada
			,Id_Ubic_Prim
			,Id_Ubic_Sec
			,Id_Motivo_Salida
			,Id_Usr_Realiza_Nota
			,Nombre_Realiza_Nota
			,Mail_Realiza_Nota
			--,Firma_Realiza_Nota
			--,Fech_Realiza_Nota
			,Id_Usr_Quien_Autoriza
			,Nombre_Quien_Autoriza
			,Mail_Quien_Autoriza
			,Empresa_Recibe
			,Nombre_Contacto
			,Telefono_Contacto
			,Mail_Contacto
			,Observaciones
			,Url_Adjuntos
			--,Estatus_Proceso
			,Tipo_Solicitud
			,Usr_Inser
			,Fech_Inser
			,Estatus_Reg
		)
		values
		(
		".$Id_Area."
		,'".$Nota_Duplicada."'
		,".$Id_Ubic_Prim."
		,".$Id_Ubic_Sec."
		,".$Id_Motivo_Salida."
		,".$Id_Usuario."
		,(select (select top 1 nombre_completo from empleados_chs where siga_usuarios.No_Usuario=empleados_chs.num_empleado)  from siga_usuarios where Id_Usuario=".$Id_Usuario.")
		,(select (select top 1 email from empleados_chs where siga_usuarios.No_Usuario=empleados_chs.num_empleado)  from siga_usuarios where Id_Usuario=".$Id_Usuario.")
		--,'".$Firma_Digital."'
		--,getdate()
		,".$Id_Usr_Quien_Autoriza."
		,(select (select top 1 nombre_completo from empleados_chs where siga_usuarios.No_Usuario=empleados_chs.num_empleado)  from siga_usuarios where Id_Usuario=".$Id_Usr_Quien_Autoriza.")
		,(select (select top 1 email from empleados_chs where siga_usuarios.No_Usuario=empleados_chs.num_empleado)  from siga_usuarios where Id_Usuario=".$Id_Usr_Quien_Autoriza.")
		,'".$Empresa_Recibe."' 
		,'".$Nombre_Contacto."'
		,'".$Telefono_Contacto."'
		,'".$Mail_Contacto."'
		,'".$Observaciones."'
		,'".$Url_Adjuntos."'
		--,".$Estatus_Proceso."
		,".$Tipo_Solicitud."
		,'".$Id_Usuario."'
		,getdate()
		,1
		)
	";
	//echo "<pre>";
	//echo $sql;
	//echo "</pre>";
	$proveedor->execute($sql);
	if (!$proveedor->error()){
		$Id_Nota_Salida=0;
		$proveedor_max = new Proveedor('sqlserver', 'activos');
		$proveedor_max->connect();
		$sql_max="select max(Id_Nota_Salida) as max_id from siga_nota_salida";
		$proveedor_max->execute($sql_max);
		if (!$proveedor_max->error()){		
			if ($proveedor_max->rows($proveedor_max->stmt) > 0) {
				$row_max = $proveedor_max->fetch_array($proveedor_max->stmt, 0);
				$Id_Nota_Salida=$row_max["max_id"];
			}
		}else{
			$Error=true;
		}
		if(count($Array_Equ_Acc)>0){
			for($i=0; $i<count($Array_Equ_Acc);$i++){
				if($Array_Equ_Acc[$i][1]!=""){
					$proveedor_det = new Proveedor('sqlserver', 'activos');
					$proveedor_det->connect();
					$sql="
						insert into 
						siga_det_nota_salida
						(
							Id_Nota_Salida_DNS
					";
					if($Tipo_Solicitud==1||$Tipo_Solicitud==3){
						$sql.="		
							,Id_Solicitud_DNS
						";	
					}
					if($Tipo_Solicitud==2){
						$sql.="
								,Id_Activo_DNS
								,AF_BC_DNS
						";
					}
					$sql.="	
							
							,Cantidad_DNS
							,Unidad_DNS
							,Marca_DNS
							,Modelo_DNS
							,Descripcion_DNS
							,No_Serie_DNS
							,Fech_Inser_DNS
							,Estatus_Reg_DNS
						) values(
							".$Id_Nota_Salida;
					if($Array_Equ_Acc[$i][0]!=""){
						$sql.=",".$Array_Equ_Acc[$i][0];
					}else{
						$sql.=",NULL";
					}
					
					if($Tipo_Solicitud==2){
						$sql.="
							,'".$Array_Equ_Acc[$i][6]."'
						";
					}	
					
					$sql.="
							,".$Array_Equ_Acc[$i][1]."
							,'".$Array_Equ_Acc[$i][2]."'
							,'".$Array_Equ_Acc[$i][3]."'
							,'".$Array_Equ_Acc[$i][4]."'
							,'".$Array_Equ_Acc[$i][5]."'
							,'".$Array_Equ_Acc[$i][7]."'
							,getdate()
							,'1'
						)
					";
					//echo "<pre>";
					//echo $sql;
					//echo "<pre>";
					$proveedor_det->execute($sql);
					if (!$proveedor_det->error()){
					}else{
						$Error=true;
					}
				}
			}
		}
	}
	else {
		$Error = true;
		$msgError = $proveedor->errorDescripcion();
	}
	
	if($Error == false) {
		$respuesta = array("totalCount" => "1", "Id_Nota_Salida"=>$Id_Nota_Salida, "estatus" => "ok", "mensaje" => "Se ha registrado  correctamente");
	}
	else {
		$respuesta = array("totalCount" => "0", "estatus" => "ok", "mensaje" => $msgError);
	}
	return $respuesta;
}


public function editar_nota_salida($Id_Nota_Salida,  $Id_Ubic_Prim, $Id_Ubic_Sec, $Id_Motivo_Salida, $Id_Usuario, $Id_Usr_Quien_Autoriza, $Empresa_Recibe, $Nombre_Contacto, $Telefono_Contacto, $Mail_Contacto, $Observaciones, $Url_Adjuntos, $Tipo_Solicitud, $Id_Area, $Array_Equ_Acc, $Firma_Digital, $Estatus_Proceso){
	$proveedor = new Proveedor('sqlserver', 'activos');
	$respuesta = array();
	$proveedor->connect();
	$Error=false;
	$sql="
		update 
		siga_nota_salida 
		set 
			Id_Area_Realiza=".$Id_Area."
			,Id_Ubic_Prim=".$Id_Ubic_Prim."
			,Id_Ubic_Sec=".$Id_Ubic_Sec."
			,Id_Motivo_Salida=".$Id_Motivo_Salida."
			,Id_Usr_Realiza_Nota=".$Id_Usuario."
			,Nombre_Realiza_Nota=(select (select top 1 nombre_completo from empleados_chs where siga_usuarios.No_Usuario=empleados_chs.num_empleado)  from siga_usuarios where Id_Usuario=".$Id_Usuario.")
			,Mail_Realiza_Nota=(select (select top 1 email from empleados_chs where siga_usuarios.No_Usuario=empleados_chs.num_empleado)  from siga_usuarios where Id_Usuario=".$Id_Usuario.")
			--,Firma_Realiza_Nota='".$Firma_Digital."'
			--,Fech_Realiza_Nota=getdate()
			,Id_Usr_Quien_Autoriza=".$Id_Usr_Quien_Autoriza."
			,Nombre_Quien_Autoriza=(select (select top 1 nombre_completo from empleados_chs where siga_usuarios.No_Usuario=empleados_chs.num_empleado)  from siga_usuarios where Id_Usuario=".$Id_Usr_Quien_Autoriza.")
			,Mail_Quien_Autoriza=(select (select top 1 email from empleados_chs where siga_usuarios.No_Usuario=empleados_chs.num_empleado)  from siga_usuarios where Id_Usuario=".$Id_Usr_Quien_Autoriza.")
			,Empresa_Recibe='".$Empresa_Recibe."' 
			,Nombre_Contacto='".$Nombre_Contacto."'
			,Telefono_Contacto='".$Telefono_Contacto."'
			,Mail_Contacto='".$Mail_Contacto."'
			,Observaciones='".$Observaciones."'
			,Url_Adjuntos='".$Url_Adjuntos."'
			--,Estatus_Proceso=".$Estatus_Proceso."
			,Tipo_Solicitud=".$Tipo_Solicitud."
			,Usr_Mod='".$Id_Usuario."'
			,Fech_Mod=getdate()
			,Estatus_Reg=2
		where Id_Nota_Salida=".$Id_Nota_Salida."
		
	";
	//echo "<pre>";
	//echo $sql;
	//echo "</pre>";
	$proveedor->execute($sql);
	if (!$proveedor->error()){
		$proveedor_delete = new Proveedor('sqlserver', 'activos');
		$sql="update siga_det_nota_salida set Estatus_Reg_DNS=3 where Id_Nota_Salida_DNS=".$Id_Nota_Salida;
		$proveedor_delete->connect();
		$proveedor_delete->execute($sql);
		if (!$proveedor_delete->error()){
			
			if(count($Array_Equ_Acc)>0){
				for($i=0; $i<count($Array_Equ_Acc);$i++){
					if($Array_Equ_Acc[$i][1]!=""){
						$proveedor_det = new Proveedor('sqlserver', 'activos');
						$proveedor_det->connect();
						$sql="
							insert into 
							siga_det_nota_salida
							(
								Id_Nota_Salida_DNS
						";
						if($Tipo_Solicitud==1||$Tipo_Solicitud==3){
							$sql.="		
								,Id_Solicitud_DNS
							";	
						}
						if($Tipo_Solicitud==2){
							$sql.="
									,Id_Activo_DNS
									,AF_BC_DNS
							";
						}
						$sql.="	
								
								,Cantidad_DNS
								,Unidad_DNS
								,Marca_DNS
								,Modelo_DNS
								,Descripcion_DNS
								,No_Serie_DNS
								,Fech_Inser_DNS
								,Estatus_Reg_DNS
							) values(
								".$Id_Nota_Salida;
						if($Array_Equ_Acc[$i][0]!=""){
							$sql.=",".$Array_Equ_Acc[$i][0];
						}else{
							$sql.=",NULL";
						}
						
						if($Tipo_Solicitud==2){
							$sql.="
								,'".$Array_Equ_Acc[$i][6]."'
							";
						}	
						
						$sql.="
								,".$Array_Equ_Acc[$i][1]."
								,'".$Array_Equ_Acc[$i][2]."'
								,'".$Array_Equ_Acc[$i][3]."'
								,'".$Array_Equ_Acc[$i][4]."'
								,'".$Array_Equ_Acc[$i][5]."'
								,'".$Array_Equ_Acc[$i][7]."'
								,getdate()
								,'1'
							)
						";
						//echo "<pre>";
						//echo $sql;
						//echo "</pre>";
						$proveedor_det->execute($sql);
						if (!$proveedor_det->error()){
						}else{
							$Error=true;
						}
					}
				}
			}
			
			
		}
	}else{
		
		$Error=true;	
	}
	
	if($Error==false){
		$respuesta = array("totalCount" => "1", "Id_Nota_Salida"=>$Id_Nota_Salida, "estatus" => "ok", "mensaje" => "Se ha registrado  correctamente");
	}else{
		$respuesta = array("totalCount" => "0", "estatus" => "ok", "mensaje" => "Ocurrio un error al registrar");
	}
	
	return $respuesta;
}


public function guardar_firma($Id_Nota_Salida, $Estatus_Proceso, $Firma_Digital, $Tipo_Firma, $Empresa_Recibe, $Html_body, $Url_Adjuntos, $proveedor=null){

	$respuesta = array();
	$Data = array();
	$Data_Envia = array();
	$error=false;

	
	if($Tipo_Firma==1){
		$proveedor = new Proveedor('sqlserver', 'activos');
		$proveedor->connect();
		$sql=" update siga_nota_salida set Estatus_Proceso=".$Estatus_Proceso.", Firma_Realiza_Nota='".$Firma_Digital."', Fech_Realiza_Nota=getdate() where Id_Nota_Salida=".$Id_Nota_Salida;
		//echo $sql;
		$proveedor->execute($sql);
		if (!$proveedor->error()) {
		}else{
			$error=true;
		}
		$proveedor->close();
	}
	
	if($Tipo_Firma==2){
		$proveedor = new Proveedor('sqlserver', 'activos');
		$proveedor->connect();
		$sql=" update siga_nota_salida set Estatus_Proceso=".$Estatus_Proceso.", Firma_Quien_Autoriza='".$Firma_Digital."', Fech_Autoriza=getdate() where Id_Nota_Salida=".$Id_Nota_Salida;
		//echo $sql;
		$proveedor->execute($sql);
		if (!$proveedor->error()) {
		}else{
			$error=true;
		}
		$proveedor->close();
	}
	
	if($Tipo_Firma==3){
		$proveedor = new Proveedor('sqlserver', 'activos');
		$proveedor->connect();
		$sql=" update siga_nota_salida set Estatus_Proceso=".$Estatus_Proceso.", Firma_Quien_Recibe='".$Firma_Digital."', Fech_Firma_Recibe=getdate()  where Id_Nota_Salida=".$Id_Nota_Salida;
		//echo $sql;
		$proveedor->execute($sql);
		if (!$proveedor->error()) {
		}else{
			$error=true;
		}
		$proveedor->close();
	}
	
	if($Estatus_Proceso==4){
		$proveedor = new Proveedor('sqlserver', 'activos');
		$proveedor->connect();
		$sql=" update siga_nota_salida set Url_Adjuntos='".$Url_Adjuntos."', Estatus_Proceso=".$Estatus_Proceso.", Fech_Mod=getdate() where Id_Nota_Salida=".$Id_Nota_Salida;
	
		//echo $sql;
		$proveedor->execute($sql);
		if (!$proveedor->error()) {
			$tabla="";
			$Area="";
			$Ubic_Prim="";
			$Ubic_Sec="";
			$Motivo_Salida="";
			$Empresa_Que_Recibe="";
			$Nombre_Contacto="";
			$Telefono="";
			$Correo="";
			$Observaciones="";
			$Fech_Firma_Recibe="";
			$Realiza_Nota="";
			$Autoriza_Salida="";
			$Recibe="";
			$baseFromJavascript = "";
			$Tipo_Solicitud="";
			$Firma1="";
			$Firma2="";
			$Firma3="";
			$Url_Adjuntos="";
			
			$Mail_Realiza_Nota="";
			$Mail_Quien_Autoriza="";
			$Mail_Proveedor="";
			if($Id_Nota_Salida!=""){
				$proveedor_mail = new Proveedor('sqlserver', 'activos');
				$proveedor_mail->connect();
				
				$sql="
					select 
					(select top 1 Nom_Area from siga_catareas where siga_catareas.Id_Area=siga_nota_salida.Id_Area_Realiza) as Area,
					(select top 1 Desc_Ubic_Prim from siga_cat_ubic_prim where siga_cat_ubic_prim.Id_Ubic_Prim=siga_nota_salida.Id_Ubic_Prim) as Ubic_Prim,
					(select top 1 Desc_Ubic_Sec from siga_cat_ubic_sec where siga_cat_ubic_sec.Id_Ubic_Sec=siga_nota_salida.Id_Ubic_Sec) as Ubic_Sec, 
					(select top 1 Desc_Motivo_Alta from siga_cat_motivo_salida where siga_cat_motivo_salida.Id_Motivo_Salida=siga_nota_salida.Id_Motivo_Salida) as Motivo_Salida, 
					convert(varchar, Fech_Firma_Recibe, 22) as Fecha, 
					*
					from siga_nota_salida where Id_Nota_Salida=".$Id_Nota_Salida." and Estatus_Reg<>3
				";
				$proveedor_mail->execute($sql);
				if (!$proveedor_mail->error()){
					if ($proveedor_mail->rows($proveedor_mail->stmt) > 0) {
						while ($row = $proveedor_mail->fetch_array($proveedor_mail->stmt, 0)) {
							$Area=$row["Area"];
							$Ubic_Prim=$row["Ubic_Prim"];
							$Ubic_Sec=$row["Ubic_Sec"];
							$Motivo_Salida=$row["Motivo_Salida"];
							$Empresa_Que_Recibe=$row["Empresa_Recibe"];
							$Nombre_Contacto=$row["Nombre_Contacto"];
							$Telefono=$row["Telefono_Contacto"];
							$Mail_Realiza_Nota=$row["Mail_Realiza_Nota"];
							$Mail_Quien_Autoriza=$row["Mail_Quien_Autoriza"];
							$Mail_Proveedor=$row["Mail_Contacto"];
							$Observaciones=$row["Observaciones"];
							$Fech_Firma_Recibe=$row["Fecha"];
							$Tipo_Solicitud=$row["Tipo_Solicitud"];
							$Realiza_Nota=$row["Nombre_Realiza_Nota"];
							$Autoriza_Salida=$row["Nombre_Quien_Autoriza"];
							$Recibe=$row["Nombre_Contacto"];
							//$Firma1=$row["Firma_Realiza_Nota"];
							//$Firma2=$row["Firma_Quien_Autoriza"];
							//$Firma3=$row["Firma_Quien_Recibe"];
							$Url_Adjuntos=$row["Url_Adjuntos"];
						}
					}
				}		
			}
			
			$html_mail=$Html_body;
			$html_mail=str_replace("||motivo_salida||", $Motivo_Salida, $html_mail);
			$html_mail=str_replace("||empresa||", $Empresa_Que_Recibe, $html_mail);
			$html_mail=str_replace("||realiza||", $Realiza_Nota, $html_mail);
			$html_mail=str_replace("||autoriza||", $Autoriza_Salida, $html_mail);
			$html_mail=str_replace("||comentarios||", $Observaciones, $html_mail);
			
			///////////////INICIA TABLA DETALLE//////////////////////////////////////
			$sql="
				select 
					Id_Solicitud_DNS
					,Id_Activo_DNS
					,AF_BC_DNS
					,Cantidad_DNS
					,Unidad_DNS
					,Marca_DNS
					,Modelo_DNS
					,Descripcion_DNS
					,No_Serie_DNS
				from siga_det_nota_salida where Id_Nota_Salida_DNS=".$Id_Nota_Salida." and Estatus_Reg_DNS<>3
			";
			$proveedor_det = new Proveedor('sqlserver', 'activos');
			$proveedor_det->connect();
			$proveedor_det->execute($sql);
			if (!$proveedor_det->error()){
				if ($proveedor_det->rows($proveedor_det->stmt) > 0) {
					$tabla.='	  <table id="tbl">';
					$tabla.='			<thead class="thead">';
					$tabla.='				<tr id="tr">';
					$tabla.='					<td colspan="7" class="td" style="border-top: 1px solid #ddd;padding: 0px;vertical-align: top;">DATOS DE LOS EQUIPOS</td>';
					$tabla.='				</tr>';
					$tabla.='			</thead>';
					$tabla.='			<tbody class="tbody">';
					$tabla.='				<tr id="tr">';
					$tabla.='					<td class="td"><strong>Cantidad: </strong></td>';
					$tabla.='					<td class="td"><strong>Unidad: </strong></td>';
					$tabla.='					<td class="td"><strong>Marca: </strong></td>';
					$tabla.='					<td class="td"><strong>Modelo: </strong></td>';
					$tabla.='					<td class="td"><strong>Descripción: </strong></td>';
					$tabla.='					<td class="td"><strong>Solicitud: </strong></td>';
					$tabla.='					<td class="td"><strong>No. Serie: </strong></td>';
					$tabla.='				</tr>';
					
					while ($row_det = $proveedor_det->fetch_array($proveedor_det->stmt, 0)) {
						$tabla.='<tr id="tr">';
						$tabla.='	<td class="td_r" style="width: 14.28%;">'.$row_det["Cantidad_DNS"].'</td>';
						$tabla.='	<td class="td_r" style="width: 14.28%;">'.$row_det["Unidad_DNS"].'</td>';
						$tabla.='	<td class="td_r" style="width: 14.28%;">'.$row_det["Marca_DNS"].'</td>';
						$tabla.='	<td class="td_r" style="width: 14.28%;">'.$row_det["Modelo_DNS"].'</td>';
						$tabla.='	<td class="td_r" style="width: 14.28%;">'.$row_det["Descripcion_DNS"].'</td>';
						if($Tipo_Solicitud==1||$Tipo_Solicitud==3){
							$tabla.='	<td class="td_r" style="width: 14.28%;">'.$row_det["Id_Solicitud_DNS"].'</td>';
						}
						
						if($Tipo_Solicitud==2){
							$tabla.='	<td class="td_r" style="width: 14.28%;">'.$row_det["AF_BC_DNS"].'</td>';	
						}
						
						
						$tabla.='	<td class="td_r" style="width: 14.28%;">'.$row_det["No_Serie_DNS"].'</td>';
						$tabla.='</tr>';
					}
					$tabla.='			</tbody>';
					$tabla.='		</table>';
				}
			}
			$html_mail=str_replace("||tabla_detalle||", $tabla, $html_mail);
			///////////////FIN TABLA DETALLE//////////////////////////////////////
			
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
			
			$Empresa_Rec=$Empresa_Recibe;
			$Empresa_Rec=str_replace("á", "a|", $Empresa_Rec);
			$Empresa_Rec=str_replace("Á", "A|", $Empresa_Rec);
			$Empresa_Rec=str_replace("é", "e|", $Empresa_Rec);
			$Empresa_Rec=str_replace("É", "E|", $Empresa_Rec);
			$Empresa_Rec=str_replace("í", "i|", $Empresa_Rec);
			$Empresa_Rec=str_replace("Í", "I|", $Empresa_Rec);
			$Empresa_Rec=str_replace("ó", "o|", $Empresa_Rec);
			$Empresa_Rec=str_replace("Ó", "O|", $Empresa_Rec);
			$Empresa_Rec=str_replace("ú", "u|", $Empresa_Rec);
			$Empresa_Rec=str_replace("Ú", "U|", $Empresa_Rec);
			$Empresa_Rec=str_replace("ñ", "n|", $Empresa_Rec);
			$Empresa_Rec=str_replace("Ñ", "N|", $Empresa_Rec);
			
			
			
			$Correos_Para="biomedica@hospitalsatelite.com; jpalacio@hospitalsatelite.com; aperez@hospitalsatelite.com; seguridadcaseta@hospitalsatelite.com; seguridadmodulo@hospitalsatelite.com; eseguridad@hospitalsatelite.com; ";
			$Correos_Con_Copia=""; $mail_prov_pruebas="";
			
			if($Mail_Quien_Autoriza!=""){$Correos_Con_Copia.=$Mail_Quien_Autoriza."; ";}
			if($Mail_Proveedor!=""){$Correos_Con_Copia.=$Mail_Proveedor."; "; $mail_prov_pruebas=$Mail_Proveedor;}
			
			////$html_mail.=$Correos_Para;
			////$html_mail.="<br>";
			////$html_mail.=$Correos_Con_Copia;
			
			$obj = new CURL();
			$url = "http://207.249.133.119:8080/envio_correo_externo/send_external_email.asp";
			//Productivo
			$data = array('strPassword' => 'C68H17S49', 'strSubject' => "Nota de Salida (".$Empresa_Recibe.")",'strTo'=>$Correos_Para,'strHTMLBody'=>$html_mail,'strCc'=>$Correos_Con_Copia,'strBCC'=>'itdeveloper@hospitalsatelite.com');
			//Pruebas
			//$data = array('strPassword' => 'C68H17S49', 'strSubject' => "Nota de Salida (".$Empresa_Recibe.")",'strTo'=>'itdeveloper@hospitalsatelite.com','strHTMLBody'=>$html_mail,'strCc'=>"itdeveloper@hospitalsatelite.com",'strBCC'=>'itdeveloper@hospitalsatelite.com');
			$correoASP = $obj->curlData($url,$data);
		
		}else{
			$error=true;
		}
		$proveedor->close();
	}
	
	
	//Fin 
	if($error==false){
		$respuesta = array("totalCount" => "1", "Id_Nota_Salida"=>$Id_Nota_Salida, "estatus" => "ok", "mensaje" => "Se ha guardado correctamente");   	
	}else{
		$respuesta = array("totalCount" => "0", "data" => "", "estatus" => "error", "mensaje" => "Ocurrio un Error al Guardar");   	
	}
	
	
	return $respuesta;
}


public function guardar_adjuntos($Id_Nota_Salida, $Url_Adjuntos){
	$respuesta = array();	
	$error=false;

	$proveedor = new Proveedor('sqlserver', 'activos');
	$proveedor->connect();
	$sql="
		update siga_nota_salida set Url_Adjuntos='".$Url_Adjuntos."' where Id_Nota_Salida=".$Id_Nota_Salida."
	";
	
	$proveedor->execute($sql);
	if (!$proveedor->error()) {
	
	}else{
		$error=true;
	}
	
	$proveedor->close();
	
	//Fin 
	if($error==false){
		$respuesta = array("totalCount" => "1", "estatus" => "ok", "mensaje" => "Actualizado correctamente");   	
	}else{
		$respuesta = array("totalCount" => "0", "estatus" => "error", "mensaje" => "Ocurrio un Error al Actualizar");   	
	}
	
	return $respuesta;
}



public function select_Nota_Salida($Id_Nota_Salida,$proveedor=null){

	$respuesta = array();	
	$Data = array();
	$Data_Envia = array();
	$error=false;

	$proveedor = new Proveedor('sqlserver', 'activos');
	$proveedor->connect();
	$sql=" select * from siga_nota_salida where Id_Nota_Salida=".$Id_Nota_Salida." and Estatus_Reg<>3 ";
	
	$proveedor->execute($sql);
	if (!$proveedor->error()) {
		if ($proveedor->rows($proveedor->stmt) > 0) {
			while ($row = $proveedor->fetch_array($proveedor->stmt, 0)) {
				$Data_det = array();
				$Data_Envia_det = array();
				$proveedor_det = new Proveedor('sqlserver', 'activos');
				$proveedor_det->connect();
				$sql="select * from siga_det_nota_salida where Id_Nota_Salida_DNS=".$Id_Nota_Salida." and Estatus_Reg_DNS<>3";
				//echo $sql;
				$proveedor_det->execute($sql);
				if (!$proveedor_det->error()) {
					if ($proveedor_det->rows($proveedor_det->stmt) > 0) {
						while ($row_det = $proveedor_det->fetch_array($proveedor_det->stmt, 0)) {
							$Id_Solicitud_DNS=""; if($row_det["Id_Solicitud_DNS"]!=NULL){$Id_Solicitud_DNS=$row_det["Id_Solicitud_DNS"];}
							$Id_Activo_DNS=""; if($row_det["Id_Activo_DNS"]!=NULL){$Id_Activo_DNS=$row_det["Id_Activo_DNS"];}
							$AF_BC_DNS=""; if($row_det["AF_BC_DNS"]!=NULL){$AF_BC_DNS=$row_det["AF_BC_DNS"];}
							
							$Data_det= array(		
								"Id_Accesorio_DNS"=>$row_det["Id_Accesorio_DNS"],
								"Id_Nota_Salida_DNS"=>$row_det["Id_Nota_Salida_DNS"],
								"Id_Solicitud_DNS"=>$Id_Solicitud_DNS,
								"Id_Activo_DNS"=>$Id_Activo_DNS,
								"AF_BC_DNS"=>$AF_BC_DNS,
								"Cantidad_DNS"=>$row_det["Cantidad_DNS"],
								"Unidad_DNS"=>rtrim(ltrim($row_det["Unidad_DNS"])),
								"Marca_DNS"=>$row_det["Marca_DNS"],
								"Modelo_DNS"=>$row_det["Modelo_DNS"],
								"Descripcion_DNS"=>$row_det["Descripcion_DNS"],
								"No_Serie_DNS"=>$row_det["No_Serie_DNS"],
								"Fech_Inser_DNS"=>$row_det["Fech_Inser_DNS"],
								"Fech_Mod_DNS"=>$row_det["Fech_Mod_DNS"],
								"Estatus_Reg_DNS"=>$row_det["Estatus_Reg_DNS"]
								);
							
							array_push($Data_Envia_det, $Data_det);
						
						}
					}
				}	
				
				$Firma_Realiza_Nota=""; if($row["Firma_Realiza_Nota"]!=NULL){$Firma_Realiza_Nota=$row["Firma_Realiza_Nota"];}
				$Firma_Quien_Autoriza=""; if($row["Firma_Quien_Autoriza"]!=NULL){$Firma_Quien_Autoriza=$row["Firma_Quien_Autoriza"];}
				$Firma_Quien_Recibe=""; if($row["Firma_Quien_Recibe"]!=NULL){$Firma_Quien_Recibe=$row["Firma_Quien_Recibe"];}
				$Data= array(		
					"Id_Nota_Salida"=>$row["Id_Nota_Salida"],
					"Nota_Duplicada"=>$row["Nota_Duplicada"],
					"Id_Area_Realiza"=>$row["Id_Area_Realiza"],
					"Id_Ubic_Prim"=>$row["Id_Ubic_Prim"],
					"Id_Ubic_Sec"=>$row["Id_Ubic_Sec"],
					"Id_Motivo_Salida"=>$row["Id_Motivo_Salida"],
					"Id_Usr_Realiza_Nota"=>$row["Id_Usr_Realiza_Nota"],
					"Nombre_Realiza_Nota"=>$row["Nombre_Realiza_Nota"],
					"Mail_Realiza_Nota"=>$row["Mail_Realiza_Nota"],
					"Firma_Realiza_Nota"=>$Firma_Realiza_Nota,
					"Fech_Realiza_Nota"=>$row["Fech_Realiza_Nota"],
					"Id_Usr_Quien_Autoriza"=>$row["Id_Usr_Quien_Autoriza"],
					"Nombre_Quien_Autoriza"=>$row["Nombre_Quien_Autoriza"],
					"Mail_Quien_Autoriza"=>$row["Mail_Quien_Autoriza"],
					"Firma_Quien_Autoriza"=>$Firma_Quien_Autoriza,
					"Fech_Autoriza"=>$row["Fech_Autoriza"],
					"Empresa_Recibe"=>$row["Empresa_Recibe"],
					"Nombre_Contacto"=>$row["Nombre_Contacto"],
					"Telefono_Contacto"=>$row["Telefono_Contacto"],
					"Mail_Contacto"=>$row["Mail_Contacto"],
					"Firma_Quien_Recibe"=>$Firma_Quien_Recibe,
					"Fech_Firma_Recibe"=>$row["Fech_Firma_Recibe"],
					"Observaciones"=>$row["Observaciones"],
					"Url_Adjuntos"=>$row["Url_Adjuntos"],
					"Estatus_Proceso"=>$row["Estatus_Proceso"],
					"Tipo_Solicitud"=>$row["Tipo_Solicitud"],
					"Usr_Inser"=>$row["Usr_Inser"],
					"Fech_Inser"=>$row["Fech_Inser"],
					"Usr_Mod"=>$row["Usr_Mod"],
					"Fech_Mod"=>$row["Fech_Mod"],
					"Estatus_Reg"=>$row["Estatus_Reg"],
					"Det_Accesorios"=>$Data_Envia_det,
					"total_accesorios"=>count($Data_Envia_det)
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

public function llenarDataTable($draw, $columns, $order, $start, $length, $search,$orden,$siga_activosDto,$estatus,$perfil, $Fech_Inicial, $Fech_Final, $Tab, $Filtro_AF_BC_Activos, $Filtro_Nombre_Activos, $Filtro_Clasific_Activos, $Filtro_Marca_Activos, $Filtro_Modelo_Activos, $Filtro_NumSerie_Activos, $Filtro_Propiedad_Activos, $Filtro_Usr_Responsable_Activos, $Filtro_UPrimaria_Activos, $Filtro_USecundaria_Activos, $Filtro_Estatus_Activos, $Filtro_Importe_Seguro_Activos, $Filtro_Monto_Factura_Activos, $Filtro_Fecha_Alta_Activos, $Filtro_Fecha_Reubicacion_Activos, $Filtro_Descripcion_Activos, $Filtro_Filtro_UPrimariaOrigen_Activos, $Filtro_Filtro_USecundariaOrigen_Activos, $Filtro_Tipo_Activo_Activos, $Filtro_Fecha_Baja_Usr_Solicitante_Activos, $Filtro_Fecha_Baja_Usr_DirFinanciera_Activos, $Filtro_Fecha_Baja_Usr_Contabilidad_Activos, $Filtro_Estatus_Workflow_Activos, $Filtro_UbicacionEspecifica_Activos, $Filtro_Motivo_Baja_Activos) {
	$Siga_activosDao = new Siga_activosDAO();
	return $Siga_activosDao->llenarDataTable($draw, $columns, $order, $start, $length, $search,$orden,$siga_activosDto,$estatus,$perfil, $Fech_Inicial, $Fech_Final, $Tab, $Filtro_AF_BC_Activos, $Filtro_Nombre_Activos, $Filtro_Clasific_Activos, $Filtro_Marca_Activos, $Filtro_Modelo_Activos, $Filtro_NumSerie_Activos, $Filtro_Propiedad_Activos, $Filtro_Usr_Responsable_Activos, $Filtro_UPrimaria_Activos, $Filtro_USecundaria_Activos, $Filtro_Estatus_Activos, $Filtro_Importe_Seguro_Activos, $Filtro_Monto_Factura_Activos, $Filtro_Fecha_Alta_Activos, $Filtro_Fecha_Reubicacion_Activos, $Filtro_Descripcion_Activos, $Filtro_Filtro_UPrimariaOrigen_Activos, $Filtro_Filtro_USecundariaOrigen_Activos, $Filtro_Tipo_Activo_Activos, $Filtro_Fecha_Baja_Usr_Solicitante_Activos, $Filtro_Fecha_Baja_Usr_DirFinanciera_Activos, $Filtro_Fecha_Baja_Usr_Contabilidad_Activos, $Filtro_Estatus_Workflow_Activos, $Filtro_UbicacionEspecifica_Activos, $Filtro_Motivo_Baja_Activos);
}

public function workflowaltaactivos($Siga_activosDto, $proveedor=null){
	foreach ($Siga_activosDto as $activo) {
		$idActivo = $activo->getId_Activo();
		$numEmpleadoSolicitante = $activo->getNum_Empleado_Solicitante();
		$arrayEmpleadoSolicitante=$this->emailEmpleados($numEmpleadoSolicitante, $proveedor=null);
		$EmailSolicitante=$arrayEmpleadoSolicitante[0]->getEmail();
		$NombreSolicitante=$arrayEmpleadoSolicitante[0]->getNombre_completo();
		
		//////////////////////////////
		$numEmpleadoResponsable = $activo->getNum_Empleado();
		$arrayEmpleadoResponable=$this->emailEmpleados($numEmpleadoResponsable, $proveedor=null);
		$EmailResponsable=$arrayEmpleadoResponable[0]->getEmail();
		$NombreResponsable=$arrayEmpleadoResponable[0]->getNombre_completo();
		$Id_Area = $activo->getId_Area();
		$proveedor = new Proveedor('sqlserver', 'activos');
		$proveedor->connect();
		$sql="INSERT INTO siga_workflow_alta_activo (CveWorkflow, DescWorflow, FechaAlta, Correo, Aceptado, Id_Activo, No_Empleado, Nombre)";
		$sql.="values ";
		$sql.="(1,'Usuario Solicitante',getdate(),'".$EmailSolicitante."', 0, ".$idActivo.", ".$numEmpleadoSolicitante.", '".$NombreSolicitante."'),";
		$sql.="(2,'Responsable Área Gestora',getdate(),(select Correo from siga_jefe_area where Id_Area=".$Id_Area."), 0, ".$idActivo.", (select Num_Empleado from siga_jefe_area where Id_Area=".$Id_Area."), (select Nombre from siga_jefe_area where Id_Area=".$Id_Area.")),";
		$sql.="(3,'Usuario Responsable',getdate(),'".$EmailResponsable."', 0, ".$idActivo.", ".$numEmpleadoResponsable.", '".$NombreResponsable."');";
		
		$proveedor->execute($sql);
		if (!$proveedor->error()){
			$email=$this->email_alta_activo($idActivo, 1, $proveedor);
		}else{
			//echo "error";
			$error=true;
		}
		$proveedor->close();
	}
}
public function insertEspecificacionesTecnicas($Id_Activo, $Usr_Inser, $esptecnicas, $proveedor=null){
	$error=false;
	$esptecnicasRaw = $esptecnicas ?? '';
	$esptecnicas = [];
	if ($esptecnicasRaw !== '') {
		$tmp = json_decode($esptecnicasRaw, true);
		if (json_last_error() === JSON_ERROR_NONE && is_array($tmp)) {
			$esptecnicas = $tmp;
		}
	}
	// Datos
	$Identif_Simbologia = $esptecnicas['Identif_Simbologia'] ?? null;

	//$condicion  = $esptecnicas['condicion']  ?? null;
	$proyeccion = $esptecnicas['proyeccion'] ?? null;
	$movilidad  = $esptecnicas['movilidad']  ?? null;

	$f_largo    = $esptecnicas['f_largo']    ?? null;
	$f_profundo = $esptecnicas['f_profundo'] ?? null;
	$f_alto    = $esptecnicas['f_alto']    ?? null;
	$f_peso    = $esptecnicas['f_peso']    ?? null;
	$f_observaciones = $esptecnicas['f_observaciones'] ?? null;

	$Mob_Req_Esp = $esptecnicas['Mob_Req_Esp'] ?? null;
	$Mob_Lugar_Resg_Eq = $esptecnicas['Mob_Lugar_Resg_Eq'] ?? null;
	$Mob_Observaciones = $esptecnicas['Mob_Observaciones'] ?? null;
	
	$Elec_Tip_Bateria = $esptecnicas['Elec_Tip_Bateria'] ?? null;
	$Elec_Tip_Direct_Volt = $esptecnicas['Elec_Tip_Direct_Volt'] ?? null;
	$Elec_Tip_Direct_Amp = $esptecnicas['Elec_Tip_Direct_Amp'] ?? null;
	$Elec_Tip_Alt_Sis_El = $esptecnicas['Elec_Tip_Alt_Sis_El'] ?? null;
	$Elec_Tip_Alt_Volt = $esptecnicas['Elec_Tip_Alt_Volt'] ?? null;
	$Elec_Tip_Alt_Amp = $esptecnicas['Elec_Tip_Alt_Amp'] ?? null;
	$Elec_Tip_Alt_Consum = $esptecnicas['Elec_Tip_Alt_Consum'] ?? null;
	$Elec_Bat_Integrada = $esptecnicas['Elec_Bat_Integrada'] ?? null;
	$Elec_Req_UPS = $esptecnicas['Elec_Req_UPS'] ?? null;
	$Elec_Req_Ener_Regul = $esptecnicas['Elec_Req_Ener_Regul'] ?? null;
	$Elec_Planta_Emerg = $esptecnicas['Elec_Planta_Emerg'] ?? null;
	$Elec_Cont_Tipo = $esptecnicas['Elec_Cont_Tipo'] ?? null;
	$Elec_Cont_Color = $esptecnicas['Elec_Cont_Color'] ?? null;
	$Elec_Cont_Cant = $esptecnicas['Elec_Cont_Cant'] ?? null;
	$Elec_Cont_Alt_SNPT = $esptecnicas['Elec_Cont_Alt_SNPT'] ?? null;
	$Elec_Cont_Ubicacion = $esptecnicas['Elec_Cont_Ubicacion'] ?? null;
	$Elec_Observaciones = $esptecnicas['Elec_Observaciones'] ?? null;
	$Elec_Carg_Elec_QTY = $esptecnicas['Elec_Carg_Elec_QTY'] ?? null;
	$Elec_Carg_Elec_Total = $esptecnicas['Elec_Carg_Elec_Total'] ?? null;

	$Hvac_Temp_Set_Point = $esptecnicas['Hvac_Temp_Set_Point'] ?? null;
	$Hvac_Temp_Rang_Oper_Min = $esptecnicas['Hvac_Temp_Rang_Oper_Min'] ?? null;
	$Hvac_Temp_Rang_Oper_Max = $esptecnicas['Hvac_Temp_Rang_Oper_Max'] ?? null;
	$Hvac_Temp_Gradiente = $esptecnicas['Hvac_Temp_Gradiente'] ?? null;
	$Hvac_Humedad_Rango_Min = $esptecnicas['Hvac_Humedad_Rango_Min'] ?? null;
	$Hvac_Humedad_Rango_Max = $esptecnicas['Hvac_Humedad_Rango_Max'] ?? null;
	$Hvac_Discip_Term = $esptecnicas['Hvac_Discip_Term'] ?? null;
	$Hvac_Recam_X_Hora = $esptecnicas['Hvac_Recam_X_Hora'] ?? null;
	$Hvac_Renovaciones_Aire = $esptecnicas['Hvac_Renovaciones_Aire'] ?? null;
	$Hvac_Efici_Filtrado = $esptecnicas['Hvac_Efici_Filtrado'] ?? null;

	$Tel_Nodred_Cantidad = $esptecnicas['Tel_Nodred_Cantidad'] ?? null;
	$Tel_Nodred_Tipo = $esptecnicas['Tel_Nodred_Tipo'] ?? null;
	$Tel_Nodred_Alt_Sntp = $esptecnicas['Tel_Nodred_Alt_Sntp'] ?? null;
	$Tel_Nodred_Ubicacion = $esptecnicas['Tel_Nodred_Ubicacion'] ?? null;
	$Tel_Nodcom_Cantidad = $esptecnicas['Tel_Nodcom_Cantidad'] ?? null;
	$Tel_Nodcom_Tipo = $esptecnicas['Tel_Nodcom_Tipo'] ?? null;
	$Tel_Nodcom_Alt_Sntp = $esptecnicas['Tel_Nodcom_Alt_Sntp'] ?? null;
	$Tel_Nodcom_Ubicacion = $esptecnicas['Tel_Nodcom_Ubicacion'] ?? null;
	$Tel_Nodvideo_Cantidad = $esptecnicas['Tel_Nodvideo_Cantidad'] ?? null;
	$Tel_Nodvideo_Tipo = $esptecnicas['Tel_Nodvideo_Tipo'] ?? null;
	$Tel_Nodvideo_Alt_Sntp = $esptecnicas['Tel_Nodvideo_Alt_Sntp'] ?? null;
	$Tel_Nodvideo_Ubicacion = $esptecnicas['Tel_Nodvideo_Ubicacion'] ?? null;
	$Tel_Ec_Tipo = $esptecnicas['Tel_Ec_Tipo'] ?? null;
	$Tel_Ec_Req_Min = $esptecnicas['Tel_Ec_Req_Min'] ?? null;
	$Tel_Observaciones = $esptecnicas['Tel_Observaciones'] ?? null;

	$Hid_Agcal_Material = $esptecnicas['Hid_Agcal_Material'] ?? null;
	$Hid_Agcal_Diametro = $esptecnicas['Hid_Agcal_Diametro'] ?? null;
	$Hid_Agcal_Presion = $esptecnicas['Hid_Agcal_Presion'] ?? null;
	$Hid_Agcal_Gasto = $esptecnicas['Hid_Agcal_Gasto'] ?? null;
	$Hid_Agcal_Temp = $esptecnicas['Hid_Agcal_Temp'] ?? null;
	$Hid_Agcal_Calidad = $esptecnicas['Hid_Agcal_Calidad'] ?? null;
	$Hid_Agcal_Cantidad = $esptecnicas['Hid_Agcal_Cantidad'] ?? null;
	$Hid_Agcal_Alt_SNPT = $esptecnicas['Hid_Agcal_Alt_SNPT'] ?? null;
	$Hid_Agcal_Ubicacion = $esptecnicas['Hid_Agcal_Ubicacion'] ?? null;
	$Hid_Agfria_Material = $esptecnicas['Hid_Agfria_Material'] ?? null;
	$Hid_Agfria_Diametro = $esptecnicas['Hid_Agfria_Diametro'] ?? null;
	$Hid_Agfria_Presion = $esptecnicas['Hid_Agfria_Presion'] ?? null;
	$Hid_Agfria_Gasto = $esptecnicas['Hid_Agfria_Gasto'] ?? null;
	$Hid_Agfria_Temp = $esptecnicas['Hid_Agfria_Temp'] ?? null;
	$Hid_Agfria_Calidad = $esptecnicas['Hid_Agfria_Calidad'] ?? null;
	$Hid_Agfria_Cantidad = $esptecnicas['Hid_Agfria_Cantidad'] ?? null;
	$Hid_Agfria_Alt_SNPT = $esptecnicas['Hid_Agfria_Alt_SNPT'] ?? null;
	$Hid_Agfria_Ubicacion = $esptecnicas['Hid_Agfria_Ubicacion'] ?? null;
	$Hid_Observaciones = $esptecnicas['Hid_Observaciones'] ?? null;
	$Hid_Sanit_Material = $esptecnicas['Hid_Sanit_Material'] ?? null;
	$Hid_Sanit_Diametro = $esptecnicas['Hid_Sanit_Diametro'] ?? null;
	$Hid_Sanit_Caudal = $esptecnicas['Hid_Sanit_Caudal'] ?? null;
	$Hid_Sanit_Cantidad = $esptecnicas['Hid_Sanit_Cantidad'] ?? null;
	$Hid_Sanit_Alt_SNPT = $esptecnicas['Hid_Sanit_Alt_SNPT'] ?? null;
	$Hid_Sanit_Ubicacion = $esptecnicas['Hid_Sanit_Ubicacion'] ?? null;
	$Hid_Sanit_Observaciones = $esptecnicas['Hid_Sanit_Observaciones'] ?? null;

	$GM_Ox_Presion_Rang_Max = $esptecnicas['GM_Ox_Presion_Rang_Max'] ?? null;
	$GM_Ox_Presion_Rang_Min = $esptecnicas['GM_Ox_Presion_Rang_Min'] ?? null;
	$GM_Ox_Fluj_Oper_Max = $esptecnicas['GM_Ox_Fluj_Oper_Max'] ?? null;
	$GM_Ox_Fluj_Oper_Min = $esptecnicas['GM_Ox_Fluj_Oper_Min'] ?? null;
	$GM_Ox_Pres_Tom_Mural = $esptecnicas['GM_Ox_Pres_Tom_Mural'] ?? null;
	$GM_Ox_Fluj_Min = $esptecnicas['GM_Ox_Fluj_Min'] ?? null;
	$GM_Ox_Tipo_Conect = $esptecnicas['GM_Ox_Tipo_Conect'] ?? null;
	$GM_Ox_Cantidad = $esptecnicas['GM_Ox_Cantidad'] ?? null;
	$GM_Ox_Alt_SNTP = $esptecnicas['GM_Ox_Alt_SNTP'] ?? null;
	$GM_Ox_Ubicacion = $esptecnicas['GM_Ox_Ubicacion'] ?? null;
	$GM_Ox_Observaciones = $esptecnicas['GM_Ox_Observaciones'] ?? null;
	$GM_Air_Presion_Rang_Max = $esptecnicas['GM_Air_Presion_Rang_Max'] ?? null;
	$GM_Air_Presion_Rang_Min = $esptecnicas['GM_Air_Presion_Rang_Min'] ?? null;
	$GM_Air_Fluj_Oper_Max = $esptecnicas['GM_Air_Fluj_Oper_Max'] ?? null;
	$GM_Air_Fluj_Oper_Min = $esptecnicas['GM_Air_Fluj_Oper_Min'] ?? null;
	$GM_Air_Pres_Tom_Mural = $esptecnicas['GM_Air_Pres_Tom_Mural'] ?? null;
	$GM_Air_Fluj_Min = $esptecnicas['GM_Air_Fluj_Min'] ?? null;
	$GM_Air_Tipo_Conect = $esptecnicas['GM_Air_Tipo_Conect'] ?? null;
	$GM_Air_Cantidad = $esptecnicas['GM_Air_Cantidad'] ?? null;
	$GM_Air_Alt_SNTP = $esptecnicas['GM_Air_Alt_SNTP'] ?? null;
	$GM_Air_Ubicacion = $esptecnicas['GM_Air_Ubicacion'] ?? null;
	$GM_Air_Observaciones = $esptecnicas['GM_Air_Observaciones'] ?? null;
	$GM_N2_Presion_Rang_Max = $esptecnicas['GM_N2_Presion_Rang_Max'] ?? null;
	$GM_N2_Presion_Rang_Min = $esptecnicas['GM_N2_Presion_Rang_Min'] ?? null;
	$GM_N2_Fluj_Oper_Max = $esptecnicas['GM_N2_Fluj_Oper_Max'] ?? null;
	$GM_N2_Fluj_Oper_Min = $esptecnicas['GM_N2_Fluj_Oper_Min'] ?? null;
	$GM_N2_Pres_Tom_Mural = $esptecnicas['GM_N2_Pres_Tom_Mural'] ?? null;
	$GM_N2_Fluj_Min = $esptecnicas['GM_N2_Fluj_Min'] ?? null;
	$GM_N2_Tipo_Conect = $esptecnicas['GM_N2_Tipo_Conect'] ?? null;
	$GM_N2_Cantidad = $esptecnicas['GM_N2_Cantidad'] ?? null;
	$GM_N2_Alt_SNTP = $esptecnicas['GM_N2_Alt_SNTP'] ?? null;
	$GM_N2_Ubicacion = $esptecnicas['GM_N2_Ubicacion'] ?? null;
	$GM_N2_Observaciones = $esptecnicas['GM_N2_Observaciones'] ?? null;
	$GM_Co2_Presion_Rang_Max = $esptecnicas['GM_Co2_Presion_Rang_Max'] ?? null;
	$GM_Co2_Presion_Rang_Min = $esptecnicas['GM_Co2_Presion_Rang_Min'] ?? null;
	$GM_Co2_Fluj_Oper_Max = $esptecnicas['GM_Co2_Fluj_Oper_Max'] ?? null;
	$GM_Co2_Fluj_Oper_Min = $esptecnicas['GM_Co2_Fluj_Oper_Min'] ?? null;
	$GM_Co2_Pres_Tom_Mural = $esptecnicas['GM_Co2_Pres_Tom_Mural'] ?? null;
	$GM_Co2_Fluj_Min = $esptecnicas['GM_Co2_Fluj_Min'] ?? null;
	$GM_Co2_Tipo_Conect = $esptecnicas['GM_Co2_Tipo_Conect'] ?? null;
	$GM_Co2_Cantidad = $esptecnicas['GM_Co2_Cantidad'] ?? null;
	$GM_Co2_Alt_SNTP = $esptecnicas['GM_Co2_Alt_SNTP'] ?? null;
	$GM_Co2_Ubicacion = $esptecnicas['GM_Co2_Ubicacion'] ?? null;
	$GM_Co2_Observaciones = $esptecnicas['GM_Co2_Observaciones'] ?? null;
	$GM_Vac_Presion_Rang_Max = $esptecnicas['GM_Vac_Presion_Rang_Max'] ?? null;
	$GM_Vac_Presion_Rang_Min = $esptecnicas['GM_Vac_Presion_Rang_Min'] ?? null;
	$GM_Vac_Fluj_Oper_Max = $esptecnicas['GM_Vac_Fluj_Oper_Max'] ?? null;
	$GM_Vac_Fluj_Oper_Min = $esptecnicas['GM_Vac_Fluj_Oper_Min'] ?? null;
	$GM_Vac_Pres_Tom_Mural = $esptecnicas['GM_Vac_Pres_Tom_Mural'] ?? null;
	$GM_Vac_Fluj_Min = $esptecnicas['GM_Vac_Fluj_Min'] ?? null;
	$GM_Vac_Tipo_Conect = $esptecnicas['GM_Vac_Tipo_Conect'] ?? null;
	$GM_Vac_Cantidad = $esptecnicas['GM_Vac_Cantidad'] ?? null;
	$GM_Vac_Alt_SNTP = $esptecnicas['GM_Vac_Alt_SNTP'] ?? null;
	$GM_Vac_Ubicacion = $esptecnicas['GM_Vac_Ubicacion'] ?? null;
	$GM_Vac_Observaciones = $esptecnicas['GM_Vac_Observaciones'] ?? null;

	$Finan_Proveedor = $esptecnicas['Finan_Proveedor'] ?? null;
	$Finan_Inv_Esti_Unit = $esptecnicas['Finan_Inv_Esti_Unit'] ?? null;
	$Finan_Cant_A_Adquirir = $esptecnicas['Finan_Cant_A_Adquirir'] ?? null;
	$Finan_Tot_Inv_Estim = $esptecnicas['Finan_Tot_Inv_Estim'] ?? null;

	// Limpia vacíos
	$Identif_Simbologia = ($Identif_Simbologia === '') ? null : $Identif_Simbologia;

	//$condicion  = ($condicion === '') ? null : $condicion;
	$proyeccion = ($proyeccion === '') ? null : $proyeccion;
	$movilidad  = ($movilidad === '') ? null : $movilidad;

	$f_largo    = ($f_largo === '') ? null : $f_largo;
	$f_profundo = ($f_profundo === '') ? null : $f_profundo;
	$f_alto     = ($f_alto === '') ? null : $f_alto;
	$f_peso     = ($f_peso === '') ? null : $f_peso;
	$f_observaciones = ($f_observaciones === '') ? null : $f_observaciones;

	$Mob_Req_Esp       = ($Mob_Req_Esp === '') ? null : $Mob_Req_Esp;
	$Mob_Lugar_Resg_Eq = ($Mob_Lugar_Resg_Eq === '') ? null : $Mob_Lugar_Resg_Eq;
	$Mob_Observaciones = ($Mob_Observaciones === '') ? null : $Mob_Observaciones;
	
	$Elec_Tip_Bateria       	= ($Elec_Tip_Bateria === '') ? null : $Elec_Tip_Bateria;
	$Elec_Tip_Direct_Volt       = ($Elec_Tip_Direct_Volt === '') ? null : $Elec_Tip_Direct_Volt;
	$Elec_Tip_Direct_Amp       	= ($Elec_Tip_Direct_Amp === '') ? null : $Elec_Tip_Direct_Amp;
	$Elec_Tip_Alt_Sis_El       	= ($Elec_Tip_Alt_Sis_El === '') ? null : $Elec_Tip_Alt_Sis_El;
	$Elec_Tip_Alt_Volt       	= ($Elec_Tip_Alt_Volt === '') ? null : $Elec_Tip_Alt_Volt;
	$Elec_Tip_Alt_Amp       	= ($Elec_Tip_Alt_Amp === '') ? null : $Elec_Tip_Alt_Amp;
	$Elec_Tip_Alt_Consum       	= ($Elec_Tip_Alt_Consum === '') ? null : $Elec_Tip_Alt_Consum;
	$Elec_Bat_Integrada       	= ($Elec_Bat_Integrada === '') ? null : $Elec_Bat_Integrada;
	$Elec_Req_UPS       		= ($Elec_Req_UPS === '') ? null : $Elec_Req_UPS;
	$Elec_Req_Ener_Regul       	= ($Elec_Req_Ener_Regul === '') ? null : $Elec_Req_Ener_Regul;
	$Elec_Planta_Emerg       	= ($Elec_Planta_Emerg === '') ? null : $Elec_Planta_Emerg;
	$Elec_Cont_Tipo       		= ($Elec_Cont_Tipo === '') ? null : $Elec_Cont_Tipo;
	$Elec_Cont_Color       		= ($Elec_Cont_Color === '') ? null : $Elec_Cont_Color;
	$Elec_Cont_Cant       		= ($Elec_Cont_Cant === '') ? null : $Elec_Cont_Cant;
	$Elec_Cont_Alt_SNPT       	= ($Elec_Cont_Alt_SNPT === '') ? null : $Elec_Cont_Alt_SNPT;
	$Elec_Cont_Ubicacion       	= ($Elec_Cont_Ubicacion === '') ? null : $Elec_Cont_Ubicacion;
	$Elec_Observaciones       	= ($Elec_Observaciones === '') ? null : $Elec_Observaciones;
	$Elec_Carg_Elec_QTY       	= ($Elec_Carg_Elec_QTY === '') ? null : $Elec_Carg_Elec_QTY;
	$Elec_Carg_Elec_Total       = ($Elec_Carg_Elec_Total === '') ? null : $Elec_Carg_Elec_Total;

	$Hvac_Temp_Set_Point       	= ($Hvac_Temp_Set_Point === '') ? null : $Hvac_Temp_Set_Point;
	$Hvac_Temp_Rang_Oper_Min    = ($Hvac_Temp_Rang_Oper_Min === '') ? null : $Hvac_Temp_Rang_Oper_Min;
	$Hvac_Temp_Rang_Oper_Max    = ($Hvac_Temp_Rang_Oper_Max === '') ? null : $Hvac_Temp_Rang_Oper_Max;
	$Hvac_Temp_Gradiente       	= ($Hvac_Temp_Gradiente === '') ? null : $Hvac_Temp_Gradiente;
	$Hvac_Humedad_Rango_Min     = ($Hvac_Humedad_Rango_Min === '') ? null : $Hvac_Humedad_Rango_Min;
	$Hvac_Humedad_Rango_Max     = ($Hvac_Humedad_Rango_Max === '') ? null : $Hvac_Humedad_Rango_Max;
	$Hvac_Discip_Term       	= ($Hvac_Discip_Term === '') ? null : $Hvac_Discip_Term;
	$Hvac_Recam_X_Hora       	= ($Hvac_Recam_X_Hora === '') ? null : $Hvac_Recam_X_Hora;
	$Hvac_Renovaciones_Aire     = ($Hvac_Renovaciones_Aire === '') ? null : $Hvac_Renovaciones_Aire;
	$Hvac_Efici_Filtrado       	= ($Hvac_Efici_Filtrado === '') ? null : $Hvac_Efici_Filtrado;

	$Tel_Nodred_Cantidad 	= ($Tel_Nodred_Cantidad === '') ? null : $Tel_Nodred_Cantidad;
	$Tel_Nodred_Tipo 		= ($Tel_Nodred_Tipo === '') ? null : $Tel_Nodred_Tipo;
	$Tel_Nodred_Alt_Sntp 	= ($Tel_Nodred_Alt_Sntp === '') ? null : $Tel_Nodred_Alt_Sntp;
	$Tel_Nodred_Ubicacion 	= ($Tel_Nodred_Ubicacion === '') ? null : $Tel_Nodred_Ubicacion;
	$Tel_Nodcom_Cantidad 	= ($Tel_Nodcom_Cantidad === '') ? null : $Tel_Nodcom_Cantidad;
	$Tel_Nodcom_Tipo 		= ($Tel_Nodcom_Tipo === '') ? null : $Tel_Nodcom_Tipo;
	$Tel_Nodcom_Alt_Sntp 	= ($Tel_Nodcom_Alt_Sntp === '') ? null : $Tel_Nodcom_Alt_Sntp;
	$Tel_Nodcom_Ubicacion 	= ($Tel_Nodcom_Ubicacion === '') ? null : $Tel_Nodcom_Ubicacion;
	$Tel_Nodvideo_Cantidad 	= ($Tel_Nodvideo_Cantidad === '') ? null : $Tel_Nodvideo_Cantidad;
	$Tel_Nodvideo_Tipo 		= ($Tel_Nodvideo_Tipo === '') ? null : $Tel_Nodvideo_Tipo;
	$Tel_Nodvideo_Alt_Sntp 	= ($Tel_Nodvideo_Alt_Sntp === '') ? null : $Tel_Nodvideo_Alt_Sntp;
	$Tel_Nodvideo_Ubicacion = ($Tel_Nodvideo_Ubicacion === '') ? null : $Tel_Nodvideo_Ubicacion;
	$Tel_Ec_Tipo 			= ($Tel_Ec_Tipo === '') ? null : $Tel_Ec_Tipo;
	$Tel_Ec_Req_Min 		= ($Tel_Ec_Req_Min === '') ? null : $Tel_Ec_Req_Min;
	$Tel_Observaciones 		= ($Tel_Observaciones === '') ? null : $Tel_Observaciones;

	$Hid_Agcal_Material 	= ($Hid_Agcal_Material === '') ? null : $Hid_Agcal_Material;
	$Hid_Agcal_Diametro 	= ($Hid_Agcal_Diametro === '') ? null : $Hid_Agcal_Diametro;
	$Hid_Agcal_Presion 		= ($Hid_Agcal_Presion === '') ? null : $Hid_Agcal_Presion;
	$Hid_Agcal_Gasto 		= ($Hid_Agcal_Gasto === '') ? null : $Hid_Agcal_Gasto;
	$Hid_Agcal_Temp 		= ($Hid_Agcal_Temp === '') ? null : $Hid_Agcal_Temp;
	$Hid_Agcal_Calidad 	= ($Hid_Agcal_Calidad === '') ? null : $Hid_Agcal_Calidad;
	$Hid_Agcal_Cantidad 	= ($Hid_Agcal_Cantidad === '') ? null : $Hid_Agcal_Cantidad;
	$Hid_Agcal_Alt_SNPT 	= ($Hid_Agcal_Alt_SNPT === '') ? null : $Hid_Agcal_Alt_SNPT;
	$Hid_Agcal_Ubicacion 	= ($Hid_Agcal_Ubicacion === '') ? null : $Hid_Agcal_Ubicacion;
	$Hid_Agfria_Material 	= ($Hid_Agfria_Material === '') ? null : $Hid_Agfria_Material;
	$Hid_Agfria_Diametro 	= ($Hid_Agfria_Diametro === '') ? null : $Hid_Agfria_Diametro;
	$Hid_Agfria_Presion 	= ($Hid_Agfria_Presion === '') ? null : $Hid_Agfria_Presion;
	$Hid_Agfria_Gasto 		= ($Hid_Agfria_Gasto === '') ? null : $Hid_Agfria_Gasto;
	$Hid_Agfria_Temp 		= ($Hid_Agfria_Temp === '') ? null : $Hid_Agfria_Temp;
	$Hid_Agfria_Calidad 	= ($Hid_Agfria_Calidad === '') ? null : $Hid_Agfria_Calidad;
	$Hid_Agfria_Cantidad 	= ($Hid_Agfria_Cantidad === '') ? null : $Hid_Agfria_Cantidad;
	$Hid_Agfria_Alt_SNPT 	= ($Hid_Agfria_Alt_SNPT === '') ? null : $Hid_Agfria_Alt_SNPT;
	$Hid_Agfria_Ubicacion 	= ($Hid_Agfria_Ubicacion === '') ? null : $Hid_Agfria_Ubicacion;
	$Hid_Observaciones 		= ($Hid_Observaciones === '') ? null : $Hid_Observaciones;
	$Hid_Sanit_Material 	= ($Hid_Sanit_Material === '') ? null : $Hid_Sanit_Material;
	$Hid_Sanit_Diametro 	= ($Hid_Sanit_Diametro === '') ? null : $Hid_Sanit_Diametro;
	$Hid_Sanit_Caudal 		= ($Hid_Sanit_Caudal === '') ? null : $Hid_Sanit_Caudal;
	$Hid_Sanit_Cantidad 	= ($Hid_Sanit_Cantidad === '') ? null : $Hid_Sanit_Cantidad;
	$Hid_Sanit_Alt_SNPT 	= ($Hid_Sanit_Alt_SNPT === '') ? null : $Hid_Sanit_Alt_SNPT;
	$Hid_Sanit_Ubicacion 	= ($Hid_Sanit_Ubicacion === '') ? null : $Hid_Sanit_Ubicacion;
	$Hid_Sanit_Observaciones = ($Hid_Sanit_Observaciones === '') ? null : $Hid_Sanit_Observaciones;
	
	$GM_Ox_Presion_Rang_Max			= ($GM_Ox_Presion_Rang_Max === '') ? null : $GM_Ox_Presion_Rang_Max;
	$GM_Ox_Presion_Rang_Min			= ($GM_Ox_Presion_Rang_Min === '') ? null : $GM_Ox_Presion_Rang_Min;
	$GM_Ox_Fluj_Oper_Max            = ($GM_Ox_Fluj_Oper_Max === '') ? null : $GM_Ox_Fluj_Oper_Max;
	$GM_Ox_Fluj_Oper_Min            = ($GM_Ox_Fluj_Oper_Min === '') ? null : $GM_Ox_Fluj_Oper_Min;
	$GM_Ox_Pres_Tom_Mural       = ($GM_Ox_Pres_Tom_Mural === '') ? null : $GM_Ox_Pres_Tom_Mural;
	$GM_Ox_Fluj_Min             = ($GM_Ox_Fluj_Min === '') ? null : $GM_Ox_Fluj_Min;
	$GM_Ox_Tipo_Conect          = ($GM_Ox_Tipo_Conect === '') ? null : $GM_Ox_Tipo_Conect;
	$GM_Ox_Cantidad             = ($GM_Ox_Cantidad === '') ? null : $GM_Ox_Cantidad;
	$GM_Ox_Alt_SNTP             = ($GM_Ox_Alt_SNTP === '') ? null : $GM_Ox_Alt_SNTP;
	$GM_Ox_Ubicacion            = ($GM_Ox_Ubicacion === '') ? null : $GM_Ox_Ubicacion;
	$GM_Ox_Observaciones        = ($GM_Ox_Observaciones === '') ? null : $GM_Ox_Observaciones;
	$GM_Air_Presion_Rang_Max        = ($GM_Air_Presion_Rang_Max === '') ? null : $GM_Air_Presion_Rang_Max;
	$GM_Air_Presion_Rang_Min        = ($GM_Air_Presion_Rang_Min === '') ? null : $GM_Air_Presion_Rang_Min;
	$GM_Air_Fluj_Oper_Max           = ($GM_Air_Fluj_Oper_Max === '') ? null : $GM_Air_Fluj_Oper_Max;
	$GM_Air_Fluj_Oper_Min           = ($GM_Air_Fluj_Oper_Min === '') ? null : $GM_Air_Fluj_Oper_Min;
	$GM_Air_Pres_Tom_Mural      = ($GM_Air_Pres_Tom_Mural === '') ? null : $GM_Air_Pres_Tom_Mural;
	$GM_Air_Fluj_Min            = ($GM_Air_Fluj_Min === '') ? null : $GM_Air_Fluj_Min;
	$GM_Air_Tipo_Conect         = ($GM_Air_Tipo_Conect === '') ? null : $GM_Air_Tipo_Conect;
	$GM_Air_Cantidad            = ($GM_Air_Cantidad === '') ? null : $GM_Air_Cantidad;
	$GM_Air_Alt_SNTP            = ($GM_Air_Alt_SNTP === '') ? null : $GM_Air_Alt_SNTP;
	$GM_Air_Ubicacion           = ($GM_Air_Ubicacion === '') ? null : $GM_Air_Ubicacion;
	$GM_Air_Observaciones       = ($GM_Air_Observaciones === '') ? null : $GM_Air_Observaciones;
	$GM_N2_Presion_Rang_Max         = ($GM_N2_Presion_Rang_Max === '') ? null : $GM_N2_Presion_Rang_Max;
	$GM_N2_Presion_Rang_Min         = ($GM_N2_Presion_Rang_Min === '') ? null : $GM_N2_Presion_Rang_Min;
	$GM_N2_Fluj_Oper_Max            = ($GM_N2_Fluj_Oper_Max === '') ? null : $GM_N2_Fluj_Oper_Max;
	$GM_N2_Fluj_Oper_Min            = ($GM_N2_Fluj_Oper_Min === '') ? null : $GM_N2_Fluj_Oper_Min;
	$GM_N2_Pres_Tom_Mural       = ($GM_N2_Pres_Tom_Mural === '') ? null : $GM_N2_Pres_Tom_Mural;
	$GM_N2_Fluj_Min             = ($GM_N2_Fluj_Min === '') ? null : $GM_N2_Fluj_Min;
	$GM_N2_Tipo_Conect          = ($GM_N2_Tipo_Conect === '') ? null : $GM_N2_Tipo_Conect;
	$GM_N2_Cantidad             = ($GM_N2_Cantidad === '') ? null : $GM_N2_Cantidad;
	$GM_N2_Alt_SNTP             = ($GM_N2_Alt_SNTP === '') ? null : $GM_N2_Alt_SNTP;
	$GM_N2_Ubicacion            = ($GM_N2_Ubicacion === '') ? null : $GM_N2_Ubicacion;
	$GM_N2_Observaciones        = ($GM_N2_Observaciones === '') ? null : $GM_N2_Observaciones;
	$GM_Co2_Presion_Rang_Max        = ($GM_Co2_Presion_Rang_Max === '') ? null : $GM_Co2_Presion_Rang_Max;
	$GM_Co2_Presion_Rang_Min        = ($GM_Co2_Presion_Rang_Min === '') ? null : $GM_Co2_Presion_Rang_Min;
	$GM_Co2_Fluj_Oper_Max           = ($GM_Co2_Fluj_Oper_Max === '') ? null : $GM_Co2_Fluj_Oper_Max;
	$GM_Co2_Fluj_Oper_Min           = ($GM_Co2_Fluj_Oper_Min === '') ? null : $GM_Co2_Fluj_Oper_Min;
	$GM_Co2_Pres_Tom_Mural      = ($GM_Co2_Pres_Tom_Mural === '') ? null : $GM_Co2_Pres_Tom_Mural;
	$GM_Co2_Fluj_Min            = ($GM_Co2_Fluj_Min === '') ? null : $GM_Co2_Fluj_Min;
	$GM_Co2_Tipo_Conect         = ($GM_Co2_Tipo_Conect === '') ? null : $GM_Co2_Tipo_Conect;
	$GM_Co2_Cantidad            = ($GM_Co2_Cantidad === '') ? null : $GM_Co2_Cantidad;
	$GM_Co2_Alt_SNTP            = ($GM_Co2_Alt_SNTP === '') ? null : $GM_Co2_Alt_SNTP;
	$GM_Co2_Ubicacion           = ($GM_Co2_Ubicacion === '') ? null : $GM_Co2_Ubicacion;
	$GM_Co2_Observaciones       = ($GM_Co2_Observaciones === '') ? null : $GM_Co2_Observaciones;
	$GM_Vac_Presion_Rang_Max        = ($GM_Vac_Presion_Rang_Max === '') ? null : $GM_Vac_Presion_Rang_Max;
	$GM_Vac_Presion_Rang_Min        = ($GM_Vac_Presion_Rang_Min === '') ? null : $GM_Vac_Presion_Rang_Min;
	$GM_Vac_Fluj_Oper_Max           = ($GM_Vac_Fluj_Oper_Max === '') ? null : $GM_Vac_Fluj_Oper_Max;
	$GM_Vac_Fluj_Oper_Min           = ($GM_Vac_Fluj_Oper_Min === '') ? null : $GM_Vac_Fluj_Oper_Min;
	$GM_Vac_Pres_Tom_Mural      = ($GM_Vac_Pres_Tom_Mural === '') ? null : $GM_Vac_Pres_Tom_Mural;
	$GM_Vac_Fluj_Min            = ($GM_Vac_Fluj_Min === '') ? null : $GM_Vac_Fluj_Min;
	$GM_Vac_Tipo_Conect         = ($GM_Vac_Tipo_Conect === '') ? null : $GM_Vac_Tipo_Conect;
	$GM_Vac_Cantidad            = ($GM_Vac_Cantidad === '') ? null : $GM_Vac_Cantidad;
	$GM_Vac_Alt_SNTP            = ($GM_Vac_Alt_SNTP === '') ? null : $GM_Vac_Alt_SNTP;
	$GM_Vac_Ubicacion           = ($GM_Vac_Ubicacion === '') ? null : $GM_Vac_Ubicacion;
	$GM_Vac_Observaciones       = ($GM_Vac_Observaciones === '') ? null : $GM_Vac_Observaciones;
	
	$Finan_Proveedor = ($Finan_Proveedor === '') ? null : $Finan_Proveedor;
	$Finan_Inv_Esti_Unit = ($Finan_Inv_Esti_Unit === '') ? null : $Finan_Inv_Esti_Unit;
	$Finan_Cant_A_Adquirir = ($Finan_Cant_A_Adquirir === '') ? null : $Finan_Cant_A_Adquirir;
	$Finan_Tot_Inv_Estim = ($Finan_Tot_Inv_Estim === '') ? null : $Finan_Tot_Inv_Estim;

	$proveedor = new Proveedor('sqlserver', 'activos');
	$proveedor->connect();

	// Si no hay ninguno, no insertes fila
	if ($Identif_Simbologia === null &&
		//$condicion === null && 
		$proyeccion === null && 
		$movilidad === null && 
		$f_largo === null && 
		$f_profundo === null && 
		$f_alto === null && 
		$f_peso === null && 
		$f_observaciones === null &&

		$Mob_Req_Esp === null &&
		$Mob_Lugar_Resg_Eq === null &&
		$Mob_Observaciones === null &&
		
		$Elec_Tip_Bateria === null &&
		$Elec_Tip_Direct_Volt === null &&
		$Elec_Tip_Direct_Amp === null &&
		$Elec_Tip_Alt_Sis_El === null &&
		$Elec_Tip_Alt_Volt === null &&
		$Elec_Tip_Alt_Amp === null &&
		$Elec_Tip_Alt_Consum === null &&
		$Elec_Bat_Integrada === null &&
		$Elec_Req_UPS === null &&
		$Elec_Req_Ener_Regul === null &&
		$Elec_Planta_Emerg === null &&
		$Elec_Cont_Tipo === null &&
		$Elec_Cont_Color === null &&
		$Elec_Cont_Cant === null &&
		$Elec_Cont_Alt_SNPT === null &&
		$Elec_Cont_Ubicacion === null &&
		$Elec_Observaciones === null &&
		$Elec_Carg_Elec_QTY === null &&
		$Elec_Carg_Elec_Total === null &&
		$Hvac_Temp_Set_Point === null &&
		$Hvac_Temp_Rang_Oper_Min === null &&
		$Hvac_Temp_Rang_Oper_Max === null &&
		$Hvac_Temp_Gradiente === null &&
		$Hvac_Humedad_Rango_Min === null &&
		$Hvac_Humedad_Rango_Max === null &&
		$Hvac_Discip_Term === null &&
		$Hvac_Recam_X_Hora === null &&
		$Hvac_Renovaciones_Aire === null &&
		$Hvac_Efici_Filtrado === null &&
		$Tel_Nodred_Cantidad === null &&
		$Tel_Nodred_Tipo === null &&
		$Tel_Nodred_Alt_Sntp === null &&
		$Tel_Nodred_Ubicacion === null &&
		$Tel_Nodcom_Cantidad === null &&
		$Tel_Nodcom_Tipo === null &&
		$Tel_Nodcom_Alt_Sntp === null &&
		$Tel_Nodcom_Ubicacion === null &&
		$Tel_Nodvideo_Cantidad === null &&
		$Tel_Nodvideo_Tipo === null &&
		$Tel_Nodvideo_Alt_Sntp === null &&
		$Tel_Nodvideo_Ubicacion === null &&
		$Tel_Ec_Tipo === null &&
		$Tel_Ec_Req_Min === null &&
		$Tel_Observaciones === null &&
		$Hid_Agcal_Material === null &&
		$Hid_Agcal_Diametro === null &&
		$Hid_Agcal_Presion === null &&
		$Hid_Agcal_Gasto === null &&
		$Hid_Agcal_Temp === null &&
		$Hid_Agcal_Calidad === null &&
		$Hid_Agcal_Cantidad === null &&
		$Hid_Agcal_Alt_SNPT === null &&
		$Hid_Agcal_Ubicacion === null &&
		$Hid_Agfria_Material === null &&
		$Hid_Agfria_Diametro === null &&
		$Hid_Agfria_Presion === null &&
		$Hid_Agfria_Gasto === null &&
		$Hid_Agfria_Temp === null &&
		$Hid_Agfria_Calidad === null &&
		$Hid_Agfria_Cantidad === null &&
		$Hid_Agfria_Alt_SNPT === null &&
		$Hid_Agfria_Ubicacion === null &&
		$Hid_Observaciones === null &&
		$Hid_Sanit_Material === null &&
		$Hid_Sanit_Diametro === null &&
		$Hid_Sanit_Caudal === null &&
		$Hid_Sanit_Cantidad === null &&
		$Hid_Sanit_Alt_SNPT === null &&
		$Hid_Sanit_Ubicacion === null &&
		$Hid_Sanit_Observaciones === null &&
		$GM_Ox_Presion_Rang_Max === null &&
		$GM_Ox_Presion_Rang_Min === null &&
		$GM_Ox_Fluj_Oper_Max === null &&
		$GM_Ox_Fluj_Oper_Min === null &&
		$GM_Ox_Pres_Tom_Mural === null &&
		$GM_Ox_Fluj_Min === null &&
		$GM_Ox_Tipo_Conect === null &&
		$GM_Ox_Cantidad === null &&
		$GM_Ox_Alt_SNTP === null &&
		$GM_Ox_Ubicacion === null &&
		$GM_Ox_Observaciones === null &&
		$GM_Air_Presion_Rang_Max === null &&
		$GM_Air_Presion_Rang_Min === null &&
		$GM_Air_Fluj_Oper_Max === null &&
		$GM_Air_Fluj_Oper_Min === null &&
		$GM_Air_Pres_Tom_Mural === null &&
		$GM_Air_Fluj_Min === null &&
		$GM_Air_Tipo_Conect === null &&
		$GM_Air_Cantidad === null &&
		$GM_Air_Alt_SNTP === null &&
		$GM_Air_Ubicacion === null &&
		$GM_Air_Observaciones === null &&
		$GM_N2_Presion_Rang_Max === null &&
		$GM_N2_Presion_Rang_Min === null &&
		$GM_N2_Fluj_Oper_Max === null &&
		$GM_N2_Fluj_Oper_Min === null &&
		$GM_N2_Pres_Tom_Mural === null &&
		$GM_N2_Fluj_Min === null &&
		$GM_N2_Tipo_Conect === null &&
		$GM_N2_Cantidad === null &&
		$GM_N2_Alt_SNTP === null &&
		$GM_N2_Ubicacion === null &&
		$GM_N2_Observaciones === null &&
		$GM_Co2_Presion_Rang_Max === null &&
		$GM_Co2_Presion_Rang_Min === null &&
		$GM_Co2_Fluj_Oper_Max === null &&
		$GM_Co2_Fluj_Oper_Min === null &&
		$GM_Co2_Pres_Tom_Mural === null &&
		$GM_Co2_Fluj_Min === null &&
		$GM_Co2_Tipo_Conect === null &&
		$GM_Co2_Cantidad === null &&
		$GM_Co2_Alt_SNTP === null &&
		$GM_Co2_Ubicacion === null &&
		$GM_Co2_Observaciones === null &&
		$GM_Vac_Presion_Rang_Max === null &&
		$GM_Vac_Presion_Rang_Min === null &&
		$GM_Vac_Fluj_Oper_Max === null &&
		$GM_Vac_Fluj_Oper_Min === null &&
		$GM_Vac_Pres_Tom_Mural === null &&
		$GM_Vac_Fluj_Min === null &&
		$GM_Vac_Tipo_Conect === null &&
		$GM_Vac_Cantidad === null &&
		$GM_Vac_Alt_SNTP === null &&
		$GM_Vac_Ubicacion === null &&
		$GM_Vac_Observaciones === null &&
		
		$Finan_Proveedor === null &&
		$Finan_Inv_Esti_Unit === null &&
		$Finan_Cant_A_Adquirir === null &&
		$Finan_Tot_Inv_Estim === null
	) {
		// Opcional: return; o log
		return;
	}

	// Construcción dinámica (omite columnas sin valor)
	$cols = ['Id_Activo', 'Fech_Inser', 'Usr_Inser', 'Estatus_Reg'];
	$vals = [$Id_Activo, 'getdate()', "'".$Usr_Inser."'", '1'];

	if ($Identif_Simbologia !== null) {
		$cols[] = 'Identif_Simbologia';
		$vals[] = "'".addslashes($Identif_Simbologia)."'";
	}

	/* if ($condicion !== null) {
		$cols[] = 'Com_Condicion';
		// Si es numérico: $vals[] = (int)$condicion;
		$vals[] = "'".addslashes($condicion)."'";
	} */

	if ($proyeccion !== null) {
		$cols[] = 'Com_Proyeccion';
		$vals[] = "'".addslashes($proyeccion)."'";
	}

	if ($f_largo !== null) {
		$cols[] = 'F_L';
		$vals[] = "'".addslashes($f_largo)."'";
	}

	if ($f_profundo !== null) {
		$cols[] = 'F_P';
		$vals[] = "'".addslashes($f_profundo)."'";
	}

	if ($f_alto !== null) {
		$cols[] = 'F_H';
		$vals[] = "'".addslashes($f_alto)."'";
	}

	if ($f_peso !== null) {
		$cols[] = 'F_Peso';
		$vals[] = "'".addslashes($f_peso)."'";
	}

	if ($movilidad !== null) {
		$cols[] = 'F_Movilidad';
		$vals[] = "'".addslashes($movilidad)."'";
	}

	if ($f_observaciones !== null) {
		$cols[] = 'F_Observaciones';
		$vals[] = "'".addslashes($f_observaciones)."'";
	}

	if ($Mob_Req_Esp !== null) {
		$cols[] = 'Mob_Req_Esp';
		$vals[] = "'".addslashes($Mob_Req_Esp)."'";
	}

	if ($Mob_Lugar_Resg_Eq !== null) {
		$cols[] = 'Mob_Lugar_Resg_Eq';
		$vals[] = "'".addslashes($Mob_Lugar_Resg_Eq)."'";
	}

	if ($Mob_Observaciones !== null) {
		$cols[] = 'Mob_Observaciones';
		$vals[] = "'".addslashes($Mob_Observaciones)."'";
	}
	
	if ($Elec_Tip_Bateria !== null) {
		$cols[] = 'Elec_Tip_Bateria';
		$vals[] = "'".addslashes($Elec_Tip_Bateria)."'";
	}
	
	if ($Elec_Tip_Direct_Volt !== null) {
		$cols[] = 'Elec_Tip_Direct_Volt';
		$vals[] = "'".addslashes($Elec_Tip_Direct_Volt)."'";
	}
	
	if ($Elec_Tip_Direct_Amp !== null) {
		$cols[] = 'Elec_Tip_Direct_Amp';
		$vals[] = "'".addslashes($Elec_Tip_Direct_Amp)."'";
	}
	
	if ($Elec_Tip_Alt_Sis_El !== null) {
		$cols[] = 'Elec_Tip_Alt_Sis_El';
		$vals[] = "'".addslashes($Elec_Tip_Alt_Sis_El)."'";
	}
	
	if ($Elec_Tip_Alt_Volt !== null) {
		$cols[] = 'Elec_Tip_Alt_Volt';
		$vals[] = "'".addslashes($Elec_Tip_Alt_Volt)."'";
	}
	
	if ($Elec_Tip_Alt_Amp !== null) {
		$cols[] = 'Elec_Tip_Alt_Amp';
		$vals[] = "'".addslashes($Elec_Tip_Alt_Amp)."'";
	}
	
	if ($Elec_Tip_Alt_Consum !== null) {
		$cols[] = 'Elec_Tip_Alt_Consum';
		$vals[] = "'".addslashes($Elec_Tip_Alt_Consum)."'";
	}
	
	if ($Elec_Bat_Integrada !== null) {
		$cols[] = 'Elec_Bat_Integrada';
		$vals[] = "'".addslashes($Elec_Bat_Integrada)."'";
	}
	
	if ($Elec_Req_UPS !== null) {
		$cols[] = 'Elec_Req_UPS';
		$vals[] = "'".addslashes($Elec_Req_UPS)."'";
	}
	
	if ($Elec_Req_Ener_Regul !== null) {
		$cols[] = 'Elec_Req_Ener_Regul';
		$vals[] = "'".addslashes($Elec_Req_Ener_Regul)."'";
	}
	
	if ($Elec_Planta_Emerg !== null) {
		$cols[] = 'Elec_Planta_Emerg';
		$vals[] = "'".addslashes($Elec_Planta_Emerg)."'";
	}
	
	if ($Elec_Cont_Tipo !== null) {
		$cols[] = 'Elec_Cont_Tipo';
		$vals[] = "'".addslashes($Elec_Cont_Tipo)."'";
	}
	
	if ($Elec_Cont_Color !== null) {
		$cols[] = 'Elec_Cont_Color';
		$vals[] = "'".addslashes($Elec_Cont_Color)."'";
	}
	
	if ($Elec_Cont_Cant !== null) {
		$cols[] = 'Elec_Cont_Cant';
		$vals[] = "'".addslashes($Elec_Cont_Cant)."'";
	}
	
	if ($Elec_Cont_Alt_SNPT !== null) {
		$cols[] = 'Elec_Cont_Alt_SNPT';
		$vals[] = "'".addslashes($Elec_Cont_Alt_SNPT)."'";
	}
	
	if ($Elec_Cont_Ubicacion !== null) {
		$cols[] = 'Elec_Cont_Ubicacion';
		$vals[] = "'".addslashes($Elec_Cont_Ubicacion)."'";
	}
	
	if ($Elec_Observaciones !== null) {
		$cols[] = 'Elec_Observaciones';
		$vals[] = "'".addslashes($Elec_Observaciones)."'";
	}
	
	if ($Elec_Carg_Elec_QTY !== null) {
		$cols[] = 'Elec_Carg_Elec_QTY';
		$vals[] = "'".addslashes($Elec_Carg_Elec_QTY)."'";
	}
	
	if ($Elec_Carg_Elec_Total !== null) {
		$cols[] = 'Elec_Carg_Elec_Total';
		$vals[] = "'".addslashes($Elec_Carg_Elec_Total)."'";
	}

	if ($Hvac_Temp_Set_Point !== null) {
		$cols[] = 'Hvac_Temp_Set_Point';
		$vals[] = "'".addslashes($Hvac_Temp_Set_Point)."'";
	}

	if ($Hvac_Temp_Rang_Oper_Min !== null) {
		$cols[] = 'Hvac_Temp_Rang_Oper_Min';
		$vals[] = "'".addslashes($Hvac_Temp_Rang_Oper_Min)."'";
	}

	if ($Hvac_Temp_Rang_Oper_Max !== null) {
		$cols[] = 'Hvac_Temp_Rang_Oper_Max';
		$vals[] = "'".addslashes($Hvac_Temp_Rang_Oper_Max)."'";
	}

	if ($Hvac_Temp_Gradiente !== null) {
		$cols[] = 'Hvac_Temp_Gradiente';
		$vals[] = "'".addslashes($Hvac_Temp_Gradiente)."'";
	}

	if ($Hvac_Humedad_Rango_Min !== null) {
		$cols[] = 'Hvac_Humedad_Rango_Min';
		$vals[] = "'".addslashes($Hvac_Humedad_Rango_Min)."'";
	}

	if ($Hvac_Humedad_Rango_Max !== null) {
		$cols[] = 'Hvac_Humedad_Rango_Max';
		$vals[] = "'".addslashes($Hvac_Humedad_Rango_Max)."'";
	}

	if ($Hvac_Discip_Term !== null) {
		$cols[] = 'Hvac_Discip_Term';
		$vals[] = "'".addslashes($Hvac_Discip_Term)."'";
	}

	if ($Hvac_Recam_X_Hora !== null) {
		$cols[] = 'Hvac_Recam_X_Hora';
		$vals[] = "'".addslashes($Hvac_Recam_X_Hora)."'";
	}

	if ($Hvac_Renovaciones_Aire !== null) {
		$cols[] = 'Hvac_Renovaciones_Aire';
		$vals[] = "'".addslashes($Hvac_Renovaciones_Aire)."'";
	}

	if ($Hvac_Efici_Filtrado !== null) {
		$cols[] = 'Hvac_Efici_Filtrado';
		$vals[] = "'".addslashes($Hvac_Efici_Filtrado)."'";
	}

	if ($Tel_Nodred_Cantidad !== null) {
		$cols[] = 'Tel_Nodred_Cantidad';
		$vals[] = "'".addslashes($Tel_Nodred_Cantidad)."'";
	}

	if ($Tel_Nodred_Tipo !== null) {
		$cols[] = 'Tel_Nodred_Tipo';
		$vals[] = "'".addslashes($Tel_Nodred_Tipo)."'";
	}

	if ($Tel_Nodred_Alt_Sntp !== null) {
		$cols[] = 'Tel_Nodred_Alt_Sntp';
		$vals[] = "'".addslashes($Tel_Nodred_Alt_Sntp)."'";
	}

	if ($Tel_Nodred_Ubicacion !== null) {
		$cols[] = 'Tel_Nodred_Ubicacion';
		$vals[] = "'".addslashes($Tel_Nodred_Ubicacion)."'";
	}

	if ($Tel_Nodcom_Cantidad !== null) {
		$cols[] = 'Tel_Nodcom_Cantidad';
		$vals[] = "'".addslashes($Tel_Nodcom_Cantidad)."'";
	}

	if ($Tel_Nodcom_Tipo !== null) {
		$cols[] = 'Tel_Nodcom_Tipo';
		$vals[] = "'".addslashes($Tel_Nodcom_Tipo)."'";
	}

	if ($Tel_Nodcom_Alt_Sntp !== null) {
		$cols[] = 'Tel_Nodcom_Alt_Sntp';
		$vals[] = "'".addslashes($Tel_Nodcom_Alt_Sntp)."'";
	}

	if ($Tel_Nodcom_Ubicacion !== null) {
		$cols[] = 'Tel_Nodcom_Ubicacion';
		$vals[] = "'".addslashes($Tel_Nodcom_Ubicacion)."'";
	}

	if ($Tel_Nodvideo_Cantidad !== null) {
		$cols[] = 'Tel_Nodvideo_Cantidad';
		$vals[] = "'".addslashes($Tel_Nodvideo_Cantidad)."'";
	}

	if ($Tel_Nodvideo_Tipo !== null) {
		$cols[] = 'Tel_Nodvideo_Tipo';
		$vals[] = "'".addslashes($Tel_Nodvideo_Tipo)."'";
	}

	if ($Tel_Nodvideo_Alt_Sntp !== null) {
		$cols[] = 'Tel_Nodvideo_Alt_Sntp';
		$vals[] = "'".addslashes($Tel_Nodvideo_Alt_Sntp)."'";
	}

	if ($Tel_Nodvideo_Ubicacion !== null) {
		$cols[] = 'Tel_Nodvideo_Ubicacion';
		$vals[] = "'".addslashes($Tel_Nodvideo_Ubicacion)."'";
	}

	if ($Tel_Ec_Tipo !== null) {
		$cols[] = 'Tel_Ec_Tipo';
		$vals[] = "'".addslashes($Tel_Ec_Tipo)."'";
	}

	if ($Tel_Ec_Req_Min !== null) {
		$cols[] = 'Tel_Ec_Req_Min';
		$vals[] = "'".addslashes($Tel_Ec_Req_Min)."'";
	}

	if ($Tel_Observaciones !== null) {
		$cols[] = 'Tel_Observaciones';
		$vals[] = "'".addslashes($Tel_Observaciones)."'";
	}

	if ($Hid_Agcal_Material !== null) {
		$cols[] = 'Hid_Agcal_Material';
		$vals[] = "'".addslashes($Hid_Agcal_Material)."'";
	}

	if ($Hid_Agcal_Diametro !== null) {
		$cols[] = 'Hid_Agcal_Diametro';
		$vals[] = "'".addslashes($Hid_Agcal_Diametro)."'";
	}

	if ($Hid_Agcal_Presion !== null) {
		$cols[] = 'Hid_Agcal_Presion';
		$vals[] = "'".addslashes($Hid_Agcal_Presion)."'";
	}

	if ($Hid_Agcal_Gasto !== null) {
		$cols[] = 'Hid_Agcal_Gasto';
		$vals[] = "'".addslashes($Hid_Agcal_Gasto)."'";
	}

	if ($Hid_Agcal_Temp !== null) {
		$cols[] = 'Hid_Agcal_Temp';
		$vals[] = "'".addslashes($Hid_Agcal_Temp)."'";
	}

	if ($Hid_Agcal_Calidad !== null) {
		$cols[] = 'Hid_Agcal_Calidad';
		$vals[] = "'".addslashes($Hid_Agcal_Calidad)."'";
	}

	if ($Hid_Agcal_Cantidad !== null) {
		$cols[] = 'Hid_Agcal_Cantidad';
		$vals[] = "'".addslashes($Hid_Agcal_Cantidad)."'";
	}

	if ($Hid_Agcal_Alt_SNPT !== null) {
		$cols[] = 'Hid_Agcal_Alt_SNPT';
		$vals[] = "'".addslashes($Hid_Agcal_Alt_SNPT)."'";
	}

	if ($Hid_Agcal_Ubicacion !== null) {
		$cols[] = 'Hid_Agcal_Ubicacion';
		$vals[] = "'".addslashes($Hid_Agcal_Ubicacion)."'";
	}

	if ($Hid_Agfria_Material !== null) {
		$cols[] = 'Hid_Agfria_Material';
		$vals[] = "'".addslashes($Hid_Agfria_Material)."'";
	}

	if ($Hid_Agfria_Diametro !== null) {
		$cols[] = 'Hid_Agfria_Diametro';
		$vals[] = "'".addslashes($Hid_Agfria_Diametro)."'";
	}

	if ($Hid_Agfria_Presion !== null) {
		$cols[] = 'Hid_Agfria_Presion';
		$vals[] = "'".addslashes($Hid_Agfria_Presion)."'";
	}

	if ($Hid_Agfria_Gasto !== null) {
		$cols[] = 'Hid_Agfria_Gasto';
		$vals[] = "'".addslashes($Hid_Agfria_Gasto)."'";
	}

	if ($Hid_Agfria_Temp !== null) {
		$cols[] = 'Hid_Agfria_Temp';
		$vals[] = "'".addslashes($Hid_Agfria_Temp)."'";
	}

	if ($Hid_Agfria_Calidad !== null) {
		$cols[] = 'Hid_Agfria_Calidad';
		$vals[] = "'".addslashes($Hid_Agfria_Calidad)."'";
	}

	if ($Hid_Agfria_Cantidad !== null) {
		$cols[] = 'Hid_Agfria_Cantidad';
		$vals[] = "'".addslashes($Hid_Agfria_Cantidad)."'";
	}

	if ($Hid_Agfria_Alt_SNPT !== null) {
		$cols[] = 'Hid_Agfria_Alt_SNPT';
		$vals[] = "'".addslashes($Hid_Agfria_Alt_SNPT)."'";
	}

	if ($Hid_Agfria_Ubicacion !== null) {
		$cols[] = 'Hid_Agfria_Ubicacion';
		$vals[] = "'".addslashes($Hid_Agfria_Ubicacion)."'";
	}

	if ($Hid_Observaciones !== null) {
		$cols[] = 'Hid_Observaciones';
		$vals[] = "'".addslashes($Hid_Observaciones)."'";
	}

	if ($Hid_Sanit_Material !== null) {
		$cols[] = 'Hid_Sanit_Material';
		$vals[] = "'".addslashes($Hid_Sanit_Material)."'";
	}

	if ($Hid_Sanit_Diametro !== null) {
		$cols[] = 'Hid_Sanit_Diametro';
		$vals[] = "'".addslashes($Hid_Sanit_Diametro)."'";
	}

	if ($Hid_Sanit_Caudal !== null) {
		$cols[] = 'Hid_Sanit_Caudal';
		$vals[] = "'".addslashes($Hid_Sanit_Caudal)."'";
	}

	if ($Hid_Sanit_Cantidad !== null) {
		$cols[] = 'Hid_Sanit_Cantidad';
		$vals[] = "'".addslashes($Hid_Sanit_Cantidad)."'";
	}

	if ($Hid_Sanit_Alt_SNPT !== null) {
		$cols[] = 'Hid_Sanit_Alt_SNPT';
		$vals[] = "'".addslashes($Hid_Sanit_Alt_SNPT)."'";
	}

	if ($Hid_Sanit_Ubicacion !== null) {
		$cols[] = 'Hid_Sanit_Ubicacion';
		$vals[] = "'".addslashes($Hid_Sanit_Ubicacion)."'";
	}

	if ($Hid_Sanit_Observaciones !== null) {
		$cols[] = 'Hid_Sanit_Observaciones';
		$vals[] = "'".addslashes($Hid_Sanit_Observaciones)."'";
	}
	
	if ($GM_Ox_Presion_Rang_Max !== null) {
		$cols[] = 'GM_Ox_Presion_Rang_Max';
		$vals[] = "'".addslashes($GM_Ox_Presion_Rang_Max)."'";
	}
	
	if ($GM_Ox_Presion_Rang_Min !== null) {
		$cols[] = 'GM_Ox_Presion_Rang_Min';
		$vals[] = "'".addslashes($GM_Ox_Presion_Rang_Min)."'";
	}
	
	if ($GM_Ox_Fluj_Oper_Max !== null) {
		$cols[] = 'GM_Ox_Fluj_Oper_Max';
		$vals[] = "'".addslashes($GM_Ox_Fluj_Oper_Max)."'";
	}
	
	if ($GM_Ox_Fluj_Oper_Min !== null) {
		$cols[] = 'GM_Ox_Fluj_Oper_Min';
		$vals[] = "'".addslashes($GM_Ox_Fluj_Oper_Min)."'";
	}
	
	if ($GM_Ox_Pres_Tom_Mural !== null) {
		$cols[] = 'GM_Ox_Pres_Tom_Mural';
		$vals[] = "'".addslashes($GM_Ox_Pres_Tom_Mural)."'";
	}
	
	if ($GM_Ox_Fluj_Min !== null) {
		$cols[] = 'GM_Ox_Fluj_Min';
		$vals[] = "'".addslashes($GM_Ox_Fluj_Min)."'";
	}
	
	if ($GM_Ox_Tipo_Conect !== null) {
		$cols[] = 'GM_Ox_Tipo_Conect';
		$vals[] = "'".addslashes($GM_Ox_Tipo_Conect)."'";
	}
	
	if ($GM_Ox_Cantidad !== null) {
		$cols[] = 'GM_Ox_Cantidad';
		$vals[] = "'".addslashes($GM_Ox_Cantidad)."'";
	}
	
	if ($GM_Ox_Alt_SNTP !== null) {
		$cols[] = 'GM_Ox_Alt_SNTP';
		$vals[] = "'".addslashes($GM_Ox_Alt_SNTP)."'";
	}
	
	if ($GM_Ox_Ubicacion !== null) {
		$cols[] = 'GM_Ox_Ubicacion';
		$vals[] = "'".addslashes($GM_Ox_Ubicacion)."'";
	}
	
	if ($GM_Ox_Observaciones !== null) {
		$cols[] = 'GM_Ox_Observaciones';
		$vals[] = "'".addslashes($GM_Ox_Observaciones)."'";
	}
	
	if ($GM_Air_Presion_Rang_Max !== null) {
		$cols[] = 'GM_Air_Presion_Rang_Max';
		$vals[] = "'".addslashes($GM_Air_Presion_Rang_Max)."'";
	}
	
	if ($GM_Air_Presion_Rang_Min !== null) {
		$cols[] = 'GM_Air_Presion_Rang_Min';
		$vals[] = "'".addslashes($GM_Air_Presion_Rang_Min)."'";
	}
	
	if ($GM_Air_Fluj_Oper_Max !== null) {
		$cols[] = 'GM_Air_Fluj_Oper_Max';
		$vals[] = "'".addslashes($GM_Air_Fluj_Oper_Max)."'";
	}
	
	if ($GM_Air_Fluj_Oper_Min !== null) {
		$cols[] = 'GM_Air_Fluj_Oper_Min';
		$vals[] = "'".addslashes($GM_Air_Fluj_Oper_Min)."'";
	}
	
	if ($GM_Air_Pres_Tom_Mural !== null) {
		$cols[] = 'GM_Air_Pres_Tom_Mural';
		$vals[] = "'".addslashes($GM_Air_Pres_Tom_Mural)."'";
	}
	
	if ($GM_Air_Fluj_Min !== null) {
		$cols[] = 'GM_Air_Fluj_Min';
		$vals[] = "'".addslashes($GM_Air_Fluj_Min)."'";
	}
	
	if ($GM_Air_Tipo_Conect !== null) {
		$cols[] = 'GM_Air_Tipo_Conect';
		$vals[] = "'".addslashes($GM_Air_Tipo_Conect)."'";
	}
	
	if ($GM_Air_Cantidad !== null) {
		$cols[] = 'GM_Air_Cantidad';
		$vals[] = "'".addslashes($GM_Air_Cantidad)."'";
	}
	
	if ($GM_Air_Alt_SNTP !== null) {
		$cols[] = 'GM_Air_Alt_SNTP';
		$vals[] = "'".addslashes($GM_Air_Alt_SNTP)."'";
	}
	
	if ($GM_Air_Ubicacion !== null) {
		$cols[] = 'GM_Air_Ubicacion';
		$vals[] = "'".addslashes($GM_Air_Ubicacion)."'";
	}
	
	if ($GM_Air_Observaciones !== null) {
		$cols[] = 'GM_Air_Observaciones';
		$vals[] = "'".addslashes($GM_Air_Observaciones)."'";
	}
	
	if ($GM_N2_Presion_Rang_Max !== null) {
		$cols[] = 'GM_N2_Presion_Rang_Max';
		$vals[] = "'".addslashes($GM_N2_Presion_Rang_Max)."'";
	}
	
	if ($GM_N2_Presion_Rang_Min !== null) {
		$cols[] = 'GM_N2_Presion_Rang_Min';
		$vals[] = "'".addslashes($GM_N2_Presion_Rang_Min)."'";
	}
	
	if ($GM_N2_Fluj_Oper_Max !== null) {
		$cols[] = 'GM_N2_Fluj_Oper_Max';
		$vals[] = "'".addslashes($GM_N2_Fluj_Oper_Max)."'";
	}
	
	if ($GM_N2_Fluj_Oper_Min !== null) {
		$cols[] = 'GM_N2_Fluj_Oper_Min';
		$vals[] = "'".addslashes($GM_N2_Fluj_Oper_Min)."'";
	}
	
	if ($GM_N2_Pres_Tom_Mural !== null) {
		$cols[] = 'GM_N2_Pres_Tom_Mural';
		$vals[] = "'".addslashes($GM_N2_Pres_Tom_Mural)."'";
	}
	
	if ($GM_N2_Fluj_Min !== null) {
		$cols[] = 'GM_N2_Fluj_Min';
		$vals[] = "'".addslashes($GM_N2_Fluj_Min)."'";
	}
	
	if ($GM_N2_Tipo_Conect !== null) {
		$cols[] = 'GM_N2_Tipo_Conect';
		$vals[] = "'".addslashes($GM_N2_Tipo_Conect)."'";
	}
	
	if ($GM_N2_Cantidad !== null) {
		$cols[] = 'GM_N2_Cantidad';
		$vals[] = "'".addslashes($GM_N2_Cantidad)."'";
	}
	
	if ($GM_N2_Alt_SNTP !== null) {
		$cols[] = 'GM_N2_Alt_SNTP';
		$vals[] = "'".addslashes($GM_N2_Alt_SNTP)."'";
	}
	
	if ($GM_N2_Ubicacion !== null) {
		$cols[] = 'GM_N2_Ubicacion';
		$vals[] = "'".addslashes($GM_N2_Ubicacion)."'";
	}
	
	if ($GM_N2_Observaciones !== null) {
		$cols[] = 'GM_N2_Observaciones';
		$vals[] = "'".addslashes($GM_N2_Observaciones)."'";
	}
	
	if ($GM_Co2_Presion_Rang_Max !== null) {
		$cols[] = 'GM_Co2_Presion_Rang_Max';
		$vals[] = "'".addslashes($GM_Co2_Presion_Rang_Max)."'";
	}
	
	if ($GM_Co2_Presion_Rang_Min !== null) {
		$cols[] = 'GM_Co2_Presion_Rang_Min';
		$vals[] = "'".addslashes($GM_Co2_Presion_Rang_Min)."'";
	}
	
	if ($GM_Co2_Fluj_Oper_Max !== null) {
		$cols[] = 'GM_Co2_Fluj_Oper_Max';
		$vals[] = "'".addslashes($GM_Co2_Fluj_Oper_Max)."'";
	}
	
	if ($GM_Co2_Fluj_Oper_Min !== null) {
		$cols[] = 'GM_Co2_Fluj_Oper_Min';
		$vals[] = "'".addslashes($GM_Co2_Fluj_Oper_Min)."'";
	}
	
	if ($GM_Co2_Pres_Tom_Mural !== null) {
		$cols[] = 'GM_Co2_Pres_Tom_Mural';
		$vals[] = "'".addslashes($GM_Co2_Pres_Tom_Mural)."'";
	}
	
	if ($GM_Co2_Fluj_Min !== null) {
		$cols[] = 'GM_Co2_Fluj_Min';
		$vals[] = "'".addslashes($GM_Co2_Fluj_Min)."'";
	}
	
	if ($GM_Co2_Tipo_Conect !== null) {
		$cols[] = 'GM_Co2_Tipo_Conect';
		$vals[] = "'".addslashes($GM_Co2_Tipo_Conect)."'";
	}
	
	if ($GM_Co2_Cantidad !== null) {
		$cols[] = 'GM_Co2_Cantidad';
		$vals[] = "'".addslashes($GM_Co2_Cantidad)."'";
	}
	
	if ($GM_Co2_Alt_SNTP !== null) {
		$cols[] = 'GM_Co2_Alt_SNTP';
		$vals[] = "'".addslashes($GM_Co2_Alt_SNTP)."'";
	}
	
	if ($GM_Co2_Ubicacion !== null) {
		$cols[] = 'GM_Co2_Ubicacion';
		$vals[] = "'".addslashes($GM_Co2_Ubicacion)."'";
	}
	
	if ($GM_Co2_Observaciones !== null) {
		$cols[] = 'GM_Co2_Observaciones';
		$vals[] = "'".addslashes($GM_Co2_Observaciones)."'";
	}
	
	if ($GM_Vac_Presion_Rang_Max !== null) {
		$cols[] = 'GM_Vac_Presion_Rang_Max';
		$vals[] = "'".addslashes($GM_Vac_Presion_Rang_Max)."'";
	}
	
	if ($GM_Vac_Presion_Rang_Min !== null) {
		$cols[] = 'GM_Vac_Presion_Rang_Min';
		$vals[] = "'".addslashes($GM_Vac_Presion_Rang_Min)."'";
	}
	
	if ($GM_Vac_Fluj_Oper_Max !== null) {
		$cols[] = 'GM_Vac_Fluj_Oper_Max';
		$vals[] = "'".addslashes($GM_Vac_Fluj_Oper_Max)."'";
	}
	
	if ($GM_Vac_Fluj_Oper_Min !== null) {
		$cols[] = 'GM_Vac_Fluj_Oper_Min';
		$vals[] = "'".addslashes($GM_Vac_Fluj_Oper_Min)."'";
	}
	
	if ($GM_Vac_Pres_Tom_Mural !== null) {
		$cols[] = 'GM_Vac_Pres_Tom_Mural';
		$vals[] = "'".addslashes($GM_Vac_Pres_Tom_Mural)."'";
	}
	
	if ($GM_Vac_Fluj_Min !== null) {
		$cols[] = 'GM_Vac_Fluj_Min';
		$vals[] = "'".addslashes($GM_Vac_Fluj_Min)."'";
	}
	
	if ($GM_Vac_Tipo_Conect !== null) {
		$cols[] = 'GM_Vac_Tipo_Conect';
		$vals[] = "'".addslashes($GM_Vac_Tipo_Conect)."'";
	}
	
	if ($GM_Vac_Cantidad !== null) {
		$cols[] = 'GM_Vac_Cantidad';
		$vals[] = "'".addslashes($GM_Vac_Cantidad)."'";
	}
	
	if ($GM_Vac_Alt_SNTP !== null) {
		$cols[] = 'GM_Vac_Alt_SNTP';
		$vals[] = "'".addslashes($GM_Vac_Alt_SNTP)."'";
	}
	
	if ($GM_Vac_Ubicacion !== null) {
		$cols[] = 'GM_Vac_Ubicacion';
		$vals[] = "'".addslashes($GM_Vac_Ubicacion)."'";
	}
	
	if ($GM_Vac_Observaciones !== null) {
		$cols[] = 'GM_Vac_Observaciones';
		$vals[] = "'".addslashes($GM_Vac_Observaciones)."'";
	}

	if ($Finan_Proveedor !== null) {
		$cols[] = 'Finan_Proveedor';
		$vals[] = "'".addslashes($Finan_Proveedor)."'";
	}

	if ($Finan_Inv_Esti_Unit !== null) {
		$cols[] = 'Finan_Inv_Esti_Unit';
		$vals[] = "'".addslashes($Finan_Inv_Esti_Unit)."'";
	}

	if ($Finan_Cant_A_Adquirir !== null) {
		$cols[] = 'Finan_Cant_A_Adquirir';
		$vals[] = "'".addslashes($Finan_Cant_A_Adquirir)."'";
	}

	if ($Finan_Tot_Inv_Estim !== null) {
		$cols[] = 'Finan_Tot_Inv_Estim';
		$vals[] = "'".addslashes($Finan_Tot_Inv_Estim)."'";
	}

	$sql = "
		INSERT INTO siga_especificaciones_tecnicas (" . implode(', ', $cols) . ")
		VALUES (" . implode(', ', $vals) . ")
	";
	//echo $sql;
	$proveedor->execute($sql);
	if (!$proveedor->error()){
			
	}else{
		$error=true;
	}
	$proveedor->close();
}

public function insertSiga_activos($Siga_activosDto,$esptecnicas,$proveedor=null){
//$Siga_activosDto=$this->validarSiga_activos($Siga_activosDto);
$Siga_activosDao = new Siga_activosDAO();
$Siga_activosDto = $Siga_activosDao->insertSiga_activos($Siga_activosDto,$proveedor);
$this->workflowaltaactivos($Siga_activosDto,$proveedor);
//Solo para biomedica
if($Siga_activosDto[0]->getId_Area()==1){
	$this->insertEspecificacionesTecnicas($Siga_activosDto[0]->getId_Activo(), $Siga_activosDto[0]->getUsr_Inser(),$esptecnicas, $proveedor);
}
return $Siga_activosDto;
}

public function updateEspecificacionesTecnicas($Id_Esp_Tec, $Usr_Mod, $esptecnicas, $proveedor=null){
	$error=false;
	$esptecnicasRaw = $esptecnicas ?? '';
	$esptecnicas = [];
	if ($esptecnicasRaw !== '') {
		$tmp = json_decode($esptecnicasRaw, true);
		if (json_last_error() === JSON_ERROR_NONE && is_array($tmp)) {
			$esptecnicas = $tmp;
		}
	}
	// Datos
	$Identif_Simbologia = $esptecnicas['Identif_Simbologia'] ?? null;

	//$condicion  = $esptecnicas['condicion']  ?? null;
	$proyeccion = $esptecnicas['proyeccion'] ?? null;
	$movilidad  = $esptecnicas['movilidad']  ?? null;

	$f_largo    = $esptecnicas['f_largo']    ?? null;
	$f_profundo = $esptecnicas['f_profundo'] ?? null;
	$f_alto    = $esptecnicas['f_alto']    ?? null;
	$f_peso    = $esptecnicas['f_peso']    ?? null;
	$f_observaciones = $esptecnicas['f_observaciones'] ?? null;

	$Mob_Req_Esp = $esptecnicas['Mob_Req_Esp'] ?? null;
	$Mob_Lugar_Resg_Eq = $esptecnicas['Mob_Lugar_Resg_Eq'] ?? null;
	$Mob_Observaciones = $esptecnicas['Mob_Observaciones'] ?? null;
	
	$Elec_Tip_Bateria = $esptecnicas['Elec_Tip_Bateria'] ?? null;
	$Elec_Tip_Direct_Volt = $esptecnicas['Elec_Tip_Direct_Volt'] ?? null;
	$Elec_Tip_Direct_Amp = $esptecnicas['Elec_Tip_Direct_Amp'] ?? null;
	$Elec_Tip_Alt_Sis_El = $esptecnicas['Elec_Tip_Alt_Sis_El'] ?? null;
	$Elec_Tip_Alt_Volt = $esptecnicas['Elec_Tip_Alt_Volt'] ?? null;
	$Elec_Tip_Alt_Amp = $esptecnicas['Elec_Tip_Alt_Amp'] ?? null;
	$Elec_Tip_Alt_Consum = $esptecnicas['Elec_Tip_Alt_Consum'] ?? null;
	$Elec_Bat_Integrada = $esptecnicas['Elec_Bat_Integrada'] ?? null;
	$Elec_Req_UPS = $esptecnicas['Elec_Req_UPS'] ?? null;
	$Elec_Req_Ener_Regul = $esptecnicas['Elec_Req_Ener_Regul'] ?? null;
	$Elec_Planta_Emerg = $esptecnicas['Elec_Planta_Emerg'] ?? null;
	$Elec_Cont_Tipo = $esptecnicas['Elec_Cont_Tipo'] ?? null;
	$Elec_Cont_Color = $esptecnicas['Elec_Cont_Color'] ?? null;
	$Elec_Cont_Cant = $esptecnicas['Elec_Cont_Cant'] ?? null;
	$Elec_Cont_Alt_SNPT = $esptecnicas['Elec_Cont_Alt_SNPT'] ?? null;
	$Elec_Cont_Ubicacion = $esptecnicas['Elec_Cont_Ubicacion'] ?? null;
	$Elec_Observaciones = $esptecnicas['Elec_Observaciones'] ?? null;
	$Elec_Carg_Elec_QTY = $esptecnicas['Elec_Carg_Elec_QTY'] ?? null;
	$Elec_Carg_Elec_Total = $esptecnicas['Elec_Carg_Elec_Total'] ?? null;

	$Hvac_Temp_Set_Point = $esptecnicas['Hvac_Temp_Set_Point'] ?? null;
	$Hvac_Temp_Rang_Oper_Min = $esptecnicas['Hvac_Temp_Rang_Oper_Min'] ?? null;
	$Hvac_Temp_Rang_Oper_Max = $esptecnicas['Hvac_Temp_Rang_Oper_Max'] ?? null;
	$Hvac_Temp_Gradiente = $esptecnicas['Hvac_Temp_Gradiente'] ?? null;
	$Hvac_Humedad_Rango_Min = $esptecnicas['Hvac_Humedad_Rango_Min'] ?? null;
	$Hvac_Humedad_Rango_Max = $esptecnicas['Hvac_Humedad_Rango_Max'] ?? null;
	$Hvac_Discip_Term = $esptecnicas['Hvac_Discip_Term'] ?? null;
	$Hvac_Recam_X_Hora = $esptecnicas['Hvac_Recam_X_Hora'] ?? null;
	$Hvac_Renovaciones_Aire = $esptecnicas['Hvac_Renovaciones_Aire'] ?? null;
	$Hvac_Efici_Filtrado = $esptecnicas['Hvac_Efici_Filtrado'] ?? null;

	$Tel_Nodred_Cantidad = $esptecnicas['Tel_Nodred_Cantidad'] ?? null;
	$Tel_Nodred_Tipo = $esptecnicas['Tel_Nodred_Tipo'] ?? null;
	$Tel_Nodred_Alt_Sntp = $esptecnicas['Tel_Nodred_Alt_Sntp'] ?? null;
	$Tel_Nodred_Ubicacion = $esptecnicas['Tel_Nodred_Ubicacion'] ?? null;
	$Tel_Nodcom_Cantidad = $esptecnicas['Tel_Nodcom_Cantidad'] ?? null;
	$Tel_Nodcom_Tipo = $esptecnicas['Tel_Nodcom_Tipo'] ?? null;
	$Tel_Nodcom_Alt_Sntp = $esptecnicas['Tel_Nodcom_Alt_Sntp'] ?? null;
	$Tel_Nodcom_Ubicacion = $esptecnicas['Tel_Nodcom_Ubicacion'] ?? null;
	$Tel_Nodvideo_Cantidad = $esptecnicas['Tel_Nodvideo_Cantidad'] ?? null;
	$Tel_Nodvideo_Tipo = $esptecnicas['Tel_Nodvideo_Tipo'] ?? null;
	$Tel_Nodvideo_Alt_Sntp = $esptecnicas['Tel_Nodvideo_Alt_Sntp'] ?? null;
	$Tel_Nodvideo_Ubicacion = $esptecnicas['Tel_Nodvideo_Ubicacion'] ?? null;
	$Tel_Ec_Tipo = $esptecnicas['Tel_Ec_Tipo'] ?? null;
	$Tel_Ec_Req_Min = $esptecnicas['Tel_Ec_Req_Min'] ?? null;
	$Tel_Observaciones = $esptecnicas['Tel_Observaciones'] ?? null;

	$Hid_Agcal_Material = $esptecnicas['Hid_Agcal_Material'] ?? null;
	$Hid_Agcal_Diametro = $esptecnicas['Hid_Agcal_Diametro'] ?? null;
	$Hid_Agcal_Presion = $esptecnicas['Hid_Agcal_Presion'] ?? null;
	$Hid_Agcal_Gasto = $esptecnicas['Hid_Agcal_Gasto'] ?? null;
	$Hid_Agcal_Temp = $esptecnicas['Hid_Agcal_Temp'] ?? null;
	$Hid_Agcal_Calidad = $esptecnicas['Hid_Agcal_Calidad'] ?? null;
	$Hid_Agcal_Cantidad = $esptecnicas['Hid_Agcal_Cantidad'] ?? null;
	$Hid_Agcal_Alt_SNPT = $esptecnicas['Hid_Agcal_Alt_SNPT'] ?? null;
	$Hid_Agcal_Ubicacion = $esptecnicas['Hid_Agcal_Ubicacion'] ?? null;
	$Hid_Agfria_Material = $esptecnicas['Hid_Agfria_Material'] ?? null;
	$Hid_Agfria_Diametro = $esptecnicas['Hid_Agfria_Diametro'] ?? null;
	$Hid_Agfria_Presion = $esptecnicas['Hid_Agfria_Presion'] ?? null;
	$Hid_Agfria_Gasto = $esptecnicas['Hid_Agfria_Gasto'] ?? null;
	$Hid_Agfria_Temp = $esptecnicas['Hid_Agfria_Temp'] ?? null;
	$Hid_Agfria_Calidad = $esptecnicas['Hid_Agfria_Calidad'] ?? null;
	$Hid_Agfria_Cantidad = $esptecnicas['Hid_Agfria_Cantidad'] ?? null;
	$Hid_Agfria_Alt_SNPT = $esptecnicas['Hid_Agfria_Alt_SNPT'] ?? null;
	$Hid_Agfria_Ubicacion = $esptecnicas['Hid_Agfria_Ubicacion'] ?? null;
	$Hid_Observaciones = $esptecnicas['Hid_Observaciones'] ?? null;
	$Hid_Sanit_Material = $esptecnicas['Hid_Sanit_Material'] ?? null;
	$Hid_Sanit_Diametro = $esptecnicas['Hid_Sanit_Diametro'] ?? null;
	$Hid_Sanit_Caudal = $esptecnicas['Hid_Sanit_Caudal'] ?? null;
	$Hid_Sanit_Cantidad = $esptecnicas['Hid_Sanit_Cantidad'] ?? null;
	$Hid_Sanit_Alt_SNPT = $esptecnicas['Hid_Sanit_Alt_SNPT'] ?? null;
	$Hid_Sanit_Ubicacion = $esptecnicas['Hid_Sanit_Ubicacion'] ?? null;
	$Hid_Sanit_Observaciones = $esptecnicas['Hid_Sanit_Observaciones'] ?? null;
	
	$GM_Ox_Presion_Rang_Max = $esptecnicas['GM_Ox_Presion_Rang_Max'] ?? null;
	$GM_Ox_Presion_Rang_Min = $esptecnicas['GM_Ox_Presion_Rang_Min'] ?? null;
	$GM_Ox_Fluj_Oper_Max = $esptecnicas['GM_Ox_Fluj_Oper_Max'] ?? null;
	$GM_Ox_Fluj_Oper_Min = $esptecnicas['GM_Ox_Fluj_Oper_Min'] ?? null;
	$GM_Ox_Pres_Tom_Mural = $esptecnicas['GM_Ox_Pres_Tom_Mural'] ?? null;
	$GM_Ox_Fluj_Min = $esptecnicas['GM_Ox_Fluj_Min'] ?? null;
	$GM_Ox_Tipo_Conect = $esptecnicas['GM_Ox_Tipo_Conect'] ?? null;
	$GM_Ox_Cantidad = $esptecnicas['GM_Ox_Cantidad'] ?? null;
	$GM_Ox_Alt_SNTP = $esptecnicas['GM_Ox_Alt_SNTP'] ?? null;
	$GM_Ox_Ubicacion = $esptecnicas['GM_Ox_Ubicacion'] ?? null;
	$GM_Ox_Observaciones = $esptecnicas['GM_Ox_Observaciones'] ?? null;
	$GM_Air_Presion_Rang_Max = $esptecnicas['GM_Air_Presion_Rang_Max'] ?? null;
	$GM_Air_Presion_Rang_Min = $esptecnicas['GM_Air_Presion_Rang_Min'] ?? null;
	$GM_Air_Fluj_Oper_Max = $esptecnicas['GM_Air_Fluj_Oper_Max'] ?? null;
	$GM_Air_Fluj_Oper_Min = $esptecnicas['GM_Air_Fluj_Oper_Min'] ?? null;
	$GM_Air_Pres_Tom_Mural = $esptecnicas['GM_Air_Pres_Tom_Mural'] ?? null;
	$GM_Air_Fluj_Min = $esptecnicas['GM_Air_Fluj_Min'] ?? null;
	$GM_Air_Tipo_Conect = $esptecnicas['GM_Air_Tipo_Conect'] ?? null;
	$GM_Air_Cantidad = $esptecnicas['GM_Air_Cantidad'] ?? null;
	$GM_Air_Alt_SNTP = $esptecnicas['GM_Air_Alt_SNTP'] ?? null;
	$GM_Air_Ubicacion = $esptecnicas['GM_Air_Ubicacion'] ?? null;
	$GM_Air_Observaciones = $esptecnicas['GM_Air_Observaciones'] ?? null;
	$GM_N2_Presion_Rang_Max = $esptecnicas['GM_N2_Presion_Rang_Max'] ?? null;
	$GM_N2_Presion_Rang_Min = $esptecnicas['GM_N2_Presion_Rang_Min'] ?? null;
	$GM_N2_Fluj_Oper_Max = $esptecnicas['GM_N2_Fluj_Oper_Max'] ?? null;
	$GM_N2_Fluj_Oper_Min = $esptecnicas['GM_N2_Fluj_Oper_Min'] ?? null;
	$GM_N2_Pres_Tom_Mural = $esptecnicas['GM_N2_Pres_Tom_Mural'] ?? null;
	$GM_N2_Fluj_Min = $esptecnicas['GM_N2_Fluj_Min'] ?? null;
	$GM_N2_Tipo_Conect = $esptecnicas['GM_N2_Tipo_Conect'] ?? null;
	$GM_N2_Cantidad = $esptecnicas['GM_N2_Cantidad'] ?? null;
	$GM_N2_Alt_SNTP = $esptecnicas['GM_N2_Alt_SNTP'] ?? null;
	$GM_N2_Ubicacion = $esptecnicas['GM_N2_Ubicacion'] ?? null;
	$GM_N2_Observaciones = $esptecnicas['GM_N2_Observaciones'] ?? null;
	$GM_Co2_Presion_Rang_Max = $esptecnicas['GM_Co2_Presion_Rang_Max'] ?? null;
	$GM_Co2_Presion_Rang_Min = $esptecnicas['GM_Co2_Presion_Rang_Min'] ?? null;
	$GM_Co2_Fluj_Oper_Max = $esptecnicas['GM_Co2_Fluj_Oper_Max'] ?? null;
	$GM_Co2_Fluj_Oper_Min = $esptecnicas['GM_Co2_Fluj_Oper_Min'] ?? null;
	$GM_Co2_Pres_Tom_Mural = $esptecnicas['GM_Co2_Pres_Tom_Mural'] ?? null;
	$GM_Co2_Fluj_Min = $esptecnicas['GM_Co2_Fluj_Min'] ?? null;
	$GM_Co2_Tipo_Conect = $esptecnicas['GM_Co2_Tipo_Conect'] ?? null;
	$GM_Co2_Cantidad = $esptecnicas['GM_Co2_Cantidad'] ?? null;
	$GM_Co2_Alt_SNTP = $esptecnicas['GM_Co2_Alt_SNTP'] ?? null;
	$GM_Co2_Ubicacion = $esptecnicas['GM_Co2_Ubicacion'] ?? null;
	$GM_Co2_Observaciones = $esptecnicas['GM_Co2_Observaciones'] ?? null;
	$GM_Vac_Presion_Rang_Max = $esptecnicas['GM_Vac_Presion_Rang_Max'] ?? null;
	$GM_Vac_Presion_Rang_Min = $esptecnicas['GM_Vac_Presion_Rang_Min'] ?? null;
	$GM_Vac_Fluj_Oper_Max = $esptecnicas['GM_Vac_Fluj_Oper_Max'] ?? null;
	$GM_Vac_Fluj_Oper_Min = $esptecnicas['GM_Vac_Fluj_Oper_Min'] ?? null;
	$GM_Vac_Pres_Tom_Mural = $esptecnicas['GM_Vac_Pres_Tom_Mural'] ?? null;
	$GM_Vac_Fluj_Min = $esptecnicas['GM_Vac_Fluj_Min'] ?? null;
	$GM_Vac_Tipo_Conect = $esptecnicas['GM_Vac_Tipo_Conect'] ?? null;
	$GM_Vac_Cantidad = $esptecnicas['GM_Vac_Cantidad'] ?? null;
	$GM_Vac_Alt_SNTP = $esptecnicas['GM_Vac_Alt_SNTP'] ?? null;
	$GM_Vac_Ubicacion = $esptecnicas['GM_Vac_Ubicacion'] ?? null;
	$GM_Vac_Observaciones = $esptecnicas['GM_Vac_Observaciones'] ?? null;

	$Finan_Proveedor = $esptecnicas['Finan_Proveedor'] ?? null;
	$Finan_Inv_Esti_Unit = $esptecnicas['Finan_Inv_Esti_Unit'] ?? null;
	$Finan_Cant_A_Adquirir = $esptecnicas['Finan_Cant_A_Adquirir'] ?? null;
	$Finan_Tot_Inv_Estim = $esptecnicas['Finan_Tot_Inv_Estim'] ?? null;

	// Limpia vacíos
	$Identif_Simbologia = ($Identif_Simbologia === '') ? null : $Identif_Simbologia;

	//$condicion  = ($condicion === '') ? null : $condicion;
	$proyeccion = ($proyeccion === '') ? null : $proyeccion;
	$movilidad  = ($movilidad === '') ? null : $movilidad;

	$f_largo    = ($f_largo === '') ? null : $f_largo;
	$f_profundo = ($f_profundo === '') ? null : $f_profundo;
	$f_alto     = ($f_alto === '') ? null : $f_alto;
	$f_peso     = ($f_peso === '') ? null : $f_peso;
	$f_observaciones = ($f_observaciones === '') ? null : $f_observaciones;

	$Mob_Req_Esp       = ($Mob_Req_Esp === '') ? null : $Mob_Req_Esp;
	$Mob_Lugar_Resg_Eq = ($Mob_Lugar_Resg_Eq === '') ? null : $Mob_Lugar_Resg_Eq;
	$Mob_Observaciones = ($Mob_Observaciones === '') ? null : $Mob_Observaciones;
	
	$Elec_Tip_Bateria       	= ($Elec_Tip_Bateria === '') ? null : $Elec_Tip_Bateria;
	$Elec_Tip_Direct_Volt       = ($Elec_Tip_Direct_Volt === '') ? null : $Elec_Tip_Direct_Volt;
	$Elec_Tip_Direct_Amp       	= ($Elec_Tip_Direct_Amp === '') ? null : $Elec_Tip_Direct_Amp;
	$Elec_Tip_Alt_Sis_El       	= ($Elec_Tip_Alt_Sis_El === '') ? null : $Elec_Tip_Alt_Sis_El;
	$Elec_Tip_Alt_Volt       	= ($Elec_Tip_Alt_Volt === '') ? null : $Elec_Tip_Alt_Volt;
	$Elec_Tip_Alt_Amp       	= ($Elec_Tip_Alt_Amp === '') ? null : $Elec_Tip_Alt_Amp;
	$Elec_Tip_Alt_Consum       	= ($Elec_Tip_Alt_Consum === '') ? null : $Elec_Tip_Alt_Consum;
	$Elec_Bat_Integrada       	= ($Elec_Bat_Integrada === '') ? null : $Elec_Bat_Integrada;
	$Elec_Req_UPS       		= ($Elec_Req_UPS === '') ? null : $Elec_Req_UPS;
	$Elec_Req_Ener_Regul       	= ($Elec_Req_Ener_Regul === '') ? null : $Elec_Req_Ener_Regul;
	$Elec_Planta_Emerg       	= ($Elec_Planta_Emerg === '') ? null : $Elec_Planta_Emerg;
	$Elec_Cont_Tipo       		= ($Elec_Cont_Tipo === '') ? null : $Elec_Cont_Tipo;
	$Elec_Cont_Color       		= ($Elec_Cont_Color === '') ? null : $Elec_Cont_Color;
	$Elec_Cont_Cant       		= ($Elec_Cont_Cant === '') ? null : $Elec_Cont_Cant;
	$Elec_Cont_Alt_SNPT       	= ($Elec_Cont_Alt_SNPT === '') ? null : $Elec_Cont_Alt_SNPT;
	$Elec_Cont_Ubicacion       	= ($Elec_Cont_Ubicacion === '') ? null : $Elec_Cont_Ubicacion;
	$Elec_Observaciones       	= ($Elec_Observaciones === '') ? null : $Elec_Observaciones;
	$Elec_Carg_Elec_QTY       	= ($Elec_Carg_Elec_QTY === '') ? null : $Elec_Carg_Elec_QTY;
	$Elec_Carg_Elec_Total       = ($Elec_Carg_Elec_Total === '') ? null : $Elec_Carg_Elec_Total;

	$Hvac_Temp_Set_Point       	= ($Hvac_Temp_Set_Point === '') ? null : $Hvac_Temp_Set_Point;
	$Hvac_Temp_Rang_Oper_Min    = ($Hvac_Temp_Rang_Oper_Min === '') ? null : $Hvac_Temp_Rang_Oper_Min;
	$Hvac_Temp_Rang_Oper_Max    = ($Hvac_Temp_Rang_Oper_Max === '') ? null : $Hvac_Temp_Rang_Oper_Max;
	$Hvac_Temp_Gradiente       	= ($Hvac_Temp_Gradiente === '') ? null : $Hvac_Temp_Gradiente;
	$Hvac_Humedad_Rango_Min     = ($Hvac_Humedad_Rango_Min === '') ? null : $Hvac_Humedad_Rango_Min;
	$Hvac_Humedad_Rango_Max     = ($Hvac_Humedad_Rango_Max === '') ? null : $Hvac_Humedad_Rango_Max;
	$Hvac_Discip_Term       	= ($Hvac_Discip_Term === '') ? null : $Hvac_Discip_Term;
	$Hvac_Recam_X_Hora       	= ($Hvac_Recam_X_Hora === '') ? null : $Hvac_Recam_X_Hora;
	$Hvac_Renovaciones_Aire     = ($Hvac_Renovaciones_Aire === '') ? null : $Hvac_Renovaciones_Aire;
	$Hvac_Efici_Filtrado       	= ($Hvac_Efici_Filtrado === '') ? null : $Hvac_Efici_Filtrado;

	$Tel_Nodred_Cantidad 	= ($Tel_Nodred_Cantidad === '') ? null : $Tel_Nodred_Cantidad;
	$Tel_Nodred_Tipo 		= ($Tel_Nodred_Tipo === '') ? null : $Tel_Nodred_Tipo;
	$Tel_Nodred_Alt_Sntp 	= ($Tel_Nodred_Alt_Sntp === '') ? null : $Tel_Nodred_Alt_Sntp;
	$Tel_Nodred_Ubicacion 	= ($Tel_Nodred_Ubicacion === '') ? null : $Tel_Nodred_Ubicacion;
	$Tel_Nodcom_Cantidad 	= ($Tel_Nodcom_Cantidad === '') ? null : $Tel_Nodcom_Cantidad;
	$Tel_Nodcom_Tipo 		= ($Tel_Nodcom_Tipo === '') ? null : $Tel_Nodcom_Tipo;
	$Tel_Nodcom_Alt_Sntp 	= ($Tel_Nodcom_Alt_Sntp === '') ? null : $Tel_Nodcom_Alt_Sntp;
	$Tel_Nodcom_Ubicacion 	= ($Tel_Nodcom_Ubicacion === '') ? null : $Tel_Nodcom_Ubicacion;
	$Tel_Nodvideo_Cantidad 	= ($Tel_Nodvideo_Cantidad === '') ? null : $Tel_Nodvideo_Cantidad;
	$Tel_Nodvideo_Tipo 		= ($Tel_Nodvideo_Tipo === '') ? null : $Tel_Nodvideo_Tipo;
	$Tel_Nodvideo_Alt_Sntp 	= ($Tel_Nodvideo_Alt_Sntp === '') ? null : $Tel_Nodvideo_Alt_Sntp;
	$Tel_Nodvideo_Ubicacion = ($Tel_Nodvideo_Ubicacion === '') ? null : $Tel_Nodvideo_Ubicacion;
	$Tel_Ec_Tipo 			= ($Tel_Ec_Tipo === '') ? null : $Tel_Ec_Tipo;
	$Tel_Ec_Req_Min 		= ($Tel_Ec_Req_Min === '') ? null : $Tel_Ec_Req_Min;
	$Tel_Observaciones 		= ($Tel_Observaciones === '') ? null : $Tel_Observaciones;

	$Hid_Agcal_Material 	= ($Hid_Agcal_Material === '') ? null : $Hid_Agcal_Material;
	$Hid_Agcal_Diametro 	= ($Hid_Agcal_Diametro === '') ? null : $Hid_Agcal_Diametro;
	$Hid_Agcal_Presion 		= ($Hid_Agcal_Presion === '') ? null : $Hid_Agcal_Presion;
	$Hid_Agcal_Gasto 		= ($Hid_Agcal_Gasto === '') ? null : $Hid_Agcal_Gasto;
	$Hid_Agcal_Temp 		= ($Hid_Agcal_Temp === '') ? null : $Hid_Agcal_Temp;
	$Hid_Agcal_Calidad 		= ($Hid_Agcal_Calidad === '') ? null : $Hid_Agcal_Calidad;
	$Hid_Agcal_Cantidad 	= ($Hid_Agcal_Cantidad === '') ? null : $Hid_Agcal_Cantidad;
	$Hid_Agcal_Alt_SNPT 	= ($Hid_Agcal_Alt_SNPT === '') ? null : $Hid_Agcal_Alt_SNPT;
	$Hid_Agcal_Ubicacion 	= ($Hid_Agcal_Ubicacion === '') ? null : $Hid_Agcal_Ubicacion;
	$Hid_Agfria_Material 	= ($Hid_Agfria_Material === '') ? null : $Hid_Agfria_Material;
	$Hid_Agfria_Diametro 	= ($Hid_Agfria_Diametro === '') ? null : $Hid_Agfria_Diametro;
	$Hid_Agfria_Presion 	= ($Hid_Agfria_Presion === '') ? null : $Hid_Agfria_Presion;
	$Hid_Agfria_Gasto 		= ($Hid_Agfria_Gasto === '') ? null : $Hid_Agfria_Gasto;
	$Hid_Agfria_Temp 		= ($Hid_Agfria_Temp === '') ? null : $Hid_Agfria_Temp;
	$Hid_Agfria_Calidad 	= ($Hid_Agfria_Calidad === '') ? null : $Hid_Agfria_Calidad;
	$Hid_Agfria_Cantidad 	= ($Hid_Agfria_Cantidad === '') ? null : $Hid_Agfria_Cantidad;
	$Hid_Agfria_Alt_SNPT 	= ($Hid_Agfria_Alt_SNPT === '') ? null : $Hid_Agfria_Alt_SNPT;
	$Hid_Agfria_Ubicacion 	= ($Hid_Agfria_Ubicacion === '') ? null : $Hid_Agfria_Ubicacion;
	$Hid_Observaciones 		= ($Hid_Observaciones === '') ? null : $Hid_Observaciones;
	$Hid_Sanit_Material 	= ($Hid_Sanit_Material === '') ? null : $Hid_Sanit_Material;
	$Hid_Sanit_Diametro 	= ($Hid_Sanit_Diametro === '') ? null : $Hid_Sanit_Diametro;
	$Hid_Sanit_Caudal 		= ($Hid_Sanit_Caudal === '') ? null : $Hid_Sanit_Caudal;
	$Hid_Sanit_Cantidad 	= ($Hid_Sanit_Cantidad === '') ? null : $Hid_Sanit_Cantidad;
	$Hid_Sanit_Alt_SNPT 	= ($Hid_Sanit_Alt_SNPT === '') ? null : $Hid_Sanit_Alt_SNPT;
	$Hid_Sanit_Ubicacion 	= ($Hid_Sanit_Ubicacion === '') ? null : $Hid_Sanit_Ubicacion;
	$Hid_Sanit_Observaciones = ($Hid_Sanit_Observaciones === '') ? null : $Hid_Sanit_Observaciones;
	
	$GM_Ox_Presion_Rang_Max			= ($GM_Ox_Presion_Rang_Max === '') ? null : $GM_Ox_Presion_Rang_Max;
	$GM_Ox_Presion_Rang_Min			= ($GM_Ox_Presion_Rang_Min === '') ? null : $GM_Ox_Presion_Rang_Min;
	$GM_Ox_Fluj_Oper_Max            = ($GM_Ox_Fluj_Oper_Max === '') ? null : $GM_Ox_Fluj_Oper_Max;
	$GM_Ox_Fluj_Oper_Min            = ($GM_Ox_Fluj_Oper_Min === '') ? null : $GM_Ox_Fluj_Oper_Min;
	$GM_Ox_Pres_Tom_Mural       = ($GM_Ox_Pres_Tom_Mural === '') ? null : $GM_Ox_Pres_Tom_Mural;
	$GM_Ox_Fluj_Min             = ($GM_Ox_Fluj_Min === '') ? null : $GM_Ox_Fluj_Min;
	$GM_Ox_Tipo_Conect          = ($GM_Ox_Tipo_Conect === '') ? null : $GM_Ox_Tipo_Conect;
	$GM_Ox_Cantidad             = ($GM_Ox_Cantidad === '') ? null : $GM_Ox_Cantidad;
	$GM_Ox_Alt_SNTP             = ($GM_Ox_Alt_SNTP === '') ? null : $GM_Ox_Alt_SNTP;
	$GM_Ox_Ubicacion            = ($GM_Ox_Ubicacion === '') ? null : $GM_Ox_Ubicacion;
	$GM_Ox_Observaciones        = ($GM_Ox_Observaciones === '') ? null : $GM_Ox_Observaciones;
	$GM_Air_Presion_Rang_Max        = ($GM_Air_Presion_Rang_Max === '') ? null : $GM_Air_Presion_Rang_Max;
	$GM_Air_Presion_Rang_Min        = ($GM_Air_Presion_Rang_Min === '') ? null : $GM_Air_Presion_Rang_Min;
	$GM_Air_Fluj_Oper_Max           = ($GM_Air_Fluj_Oper_Max === '') ? null : $GM_Air_Fluj_Oper_Max;
	$GM_Air_Fluj_Oper_Min           = ($GM_Air_Fluj_Oper_Min === '') ? null : $GM_Air_Fluj_Oper_Min;
	$GM_Air_Pres_Tom_Mural      = ($GM_Air_Pres_Tom_Mural === '') ? null : $GM_Air_Pres_Tom_Mural;
	$GM_Air_Fluj_Min            = ($GM_Air_Fluj_Min === '') ? null : $GM_Air_Fluj_Min;
	$GM_Air_Tipo_Conect         = ($GM_Air_Tipo_Conect === '') ? null : $GM_Air_Tipo_Conect;
	$GM_Air_Cantidad            = ($GM_Air_Cantidad === '') ? null : $GM_Air_Cantidad;
	$GM_Air_Alt_SNTP            = ($GM_Air_Alt_SNTP === '') ? null : $GM_Air_Alt_SNTP;
	$GM_Air_Ubicacion           = ($GM_Air_Ubicacion === '') ? null : $GM_Air_Ubicacion;
	$GM_Air_Observaciones       = ($GM_Air_Observaciones === '') ? null : $GM_Air_Observaciones;
	$GM_N2_Presion_Rang_Max         = ($GM_N2_Presion_Rang_Max === '') ? null : $GM_N2_Presion_Rang_Max;
	$GM_N2_Presion_Rang_Min         = ($GM_N2_Presion_Rang_Min === '') ? null : $GM_N2_Presion_Rang_Min;
	$GM_N2_Fluj_Oper_Max            = ($GM_N2_Fluj_Oper_Max === '') ? null : $GM_N2_Fluj_Oper_Max;
	$GM_N2_Fluj_Oper_Min            = ($GM_N2_Fluj_Oper_Min === '') ? null : $GM_N2_Fluj_Oper_Min;
	$GM_N2_Pres_Tom_Mural       = ($GM_N2_Pres_Tom_Mural === '') ? null : $GM_N2_Pres_Tom_Mural;
	$GM_N2_Fluj_Min             = ($GM_N2_Fluj_Min === '') ? null : $GM_N2_Fluj_Min;
	$GM_N2_Tipo_Conect          = ($GM_N2_Tipo_Conect === '') ? null : $GM_N2_Tipo_Conect;
	$GM_N2_Cantidad             = ($GM_N2_Cantidad === '') ? null : $GM_N2_Cantidad;
	$GM_N2_Alt_SNTP             = ($GM_N2_Alt_SNTP === '') ? null : $GM_N2_Alt_SNTP;
	$GM_N2_Ubicacion            = ($GM_N2_Ubicacion === '') ? null : $GM_N2_Ubicacion;
	$GM_N2_Observaciones        = ($GM_N2_Observaciones === '') ? null : $GM_N2_Observaciones;
	$GM_Co2_Presion_Rang_Max        = ($GM_Co2_Presion_Rang_Max === '') ? null : $GM_Co2_Presion_Rang_Max;
	$GM_Co2_Presion_Rang_Min        = ($GM_Co2_Presion_Rang_Min === '') ? null : $GM_Co2_Presion_Rang_Min;
	$GM_Co2_Fluj_Oper_Max           = ($GM_Co2_Fluj_Oper_Max === '') ? null : $GM_Co2_Fluj_Oper_Max;
	$GM_Co2_Fluj_Oper_Min           = ($GM_Co2_Fluj_Oper_Min === '') ? null : $GM_Co2_Fluj_Oper_Min;
	$GM_Co2_Pres_Tom_Mural      = ($GM_Co2_Pres_Tom_Mural === '') ? null : $GM_Co2_Pres_Tom_Mural;
	$GM_Co2_Fluj_Min            = ($GM_Co2_Fluj_Min === '') ? null : $GM_Co2_Fluj_Min;
	$GM_Co2_Tipo_Conect         = ($GM_Co2_Tipo_Conect === '') ? null : $GM_Co2_Tipo_Conect;
	$GM_Co2_Cantidad            = ($GM_Co2_Cantidad === '') ? null : $GM_Co2_Cantidad;
	$GM_Co2_Alt_SNTP            = ($GM_Co2_Alt_SNTP === '') ? null : $GM_Co2_Alt_SNTP;
	$GM_Co2_Ubicacion           = ($GM_Co2_Ubicacion === '') ? null : $GM_Co2_Ubicacion;
	$GM_Co2_Observaciones       = ($GM_Co2_Observaciones === '') ? null : $GM_Co2_Observaciones;
	$GM_Vac_Presion_Rang_Max        = ($GM_Vac_Presion_Rang_Max === '') ? null : $GM_Vac_Presion_Rang_Max;
	$GM_Vac_Presion_Rang_Min        = ($GM_Vac_Presion_Rang_Min === '') ? null : $GM_Vac_Presion_Rang_Min;
	$GM_Vac_Fluj_Oper_Max           = ($GM_Vac_Fluj_Oper_Max === '') ? null : $GM_Vac_Fluj_Oper_Max;
	$GM_Vac_Fluj_Oper_Min           = ($GM_Vac_Fluj_Oper_Min === '') ? null : $GM_Vac_Fluj_Oper_Min;
	$GM_Vac_Pres_Tom_Mural      = ($GM_Vac_Pres_Tom_Mural === '') ? null : $GM_Vac_Pres_Tom_Mural;
	$GM_Vac_Fluj_Min            = ($GM_Vac_Fluj_Min === '') ? null : $GM_Vac_Fluj_Min;
	$GM_Vac_Tipo_Conect         = ($GM_Vac_Tipo_Conect === '') ? null : $GM_Vac_Tipo_Conect;
	$GM_Vac_Cantidad            = ($GM_Vac_Cantidad === '') ? null : $GM_Vac_Cantidad;
	$GM_Vac_Alt_SNTP            = ($GM_Vac_Alt_SNTP === '') ? null : $GM_Vac_Alt_SNTP;
	$GM_Vac_Ubicacion           = ($GM_Vac_Ubicacion === '') ? null : $GM_Vac_Ubicacion;
	$GM_Vac_Observaciones       = ($GM_Vac_Observaciones === '') ? null : $GM_Vac_Observaciones;
	
	$Finan_Proveedor = ($Finan_Proveedor === '') ? null : $Finan_Proveedor;
	$Finan_Inv_Esti_Unit = ($Finan_Inv_Esti_Unit === '') ? null : $Finan_Inv_Esti_Unit;
	$Finan_Cant_A_Adquirir = ($Finan_Cant_A_Adquirir === '') ? null : $Finan_Cant_A_Adquirir;
	$Finan_Tot_Inv_Estim = ($Finan_Tot_Inv_Estim === '') ? null : $Finan_Tot_Inv_Estim;

	$proveedor = new Proveedor('sqlserver', 'activos');
	$proveedor->connect();

	$sql = "
		UPDATE siga_especificaciones_tecnicas SET 
			Fech_Mod = getdate(),
			Usr_Mod = '".$Usr_Mod."',
			Identif_Simbologia = ".($Identif_Simbologia !== null ? "'".addslashes($Identif_Simbologia)."'" : "NULL").",
			Com_Proyeccion = ".($proyeccion !== null ? "'".addslashes($proyeccion)."'" : "NULL").",
			F_L = ".($f_largo !== null ? "'".addslashes($f_largo)."'" : "NULL").",
			F_P = ".($f_profundo !== null ? "'".addslashes($f_profundo)."'" : "NULL").",
			F_H = ".($f_alto !== null ? "'".addslashes($f_alto)."'" : "NULL").",
			F_Peso = ".($f_peso !== null ? "'".addslashes($f_peso)."'" : "NULL").",
			F_Movilidad = ".($movilidad !== null ? "'".addslashes($movilidad)."'" : "NULL").",
			F_Observaciones = ".($f_observaciones !== null ? "'".addslashes($f_observaciones)."'" : "NULL").",
			Mob_Req_Esp = ".($Mob_Req_Esp !== null ? "'".addslashes($Mob_Req_Esp)."'" : "NULL").",
			Mob_Lugar_Resg_Eq = ".($Mob_Lugar_Resg_Eq !== null ? "'".addslashes($Mob_Lugar_Resg_Eq)."'" : "NULL").",
			Mob_Observaciones = ".($Mob_Observaciones !== null ? "'".addslashes($Mob_Observaciones)."'" : "NULL").",
			Elec_Tip_Bateria = ".($Elec_Tip_Bateria !== null ? "'".addslashes($Elec_Tip_Bateria)."'" : "NULL").",
			Elec_Tip_Direct_Volt = ".($Elec_Tip_Direct_Volt !== null ? "'".addslashes($Elec_Tip_Direct_Volt)."'" : "NULL").",
			Elec_Tip_Direct_Amp = ".($Elec_Tip_Direct_Amp !== null ? "'".addslashes($Elec_Tip_Direct_Amp)."'" : "NULL").",
			Elec_Tip_Alt_Sis_El = ".($Elec_Tip_Alt_Sis_El !== null ? "'".addslashes($Elec_Tip_Alt_Sis_El)."'" : "NULL").",
			Elec_Tip_Alt_Volt = ".($Elec_Tip_Alt_Volt !== null ? "'".addslashes($Elec_Tip_Alt_Volt)."'" : "NULL").",
			Elec_Tip_Alt_Amp = ".($Elec_Tip_Alt_Amp !== null ? "'".addslashes($Elec_Tip_Alt_Amp)."'" : "NULL").",
			Elec_Tip_Alt_Consum = ".($Elec_Tip_Alt_Consum !== null ? "'".addslashes($Elec_Tip_Alt_Consum)."'" : "NULL").",
			Elec_Bat_Integrada = ".($Elec_Bat_Integrada !== null ? "'".addslashes($Elec_Bat_Integrada)."'" : "NULL").",
			Elec_Req_UPS = ".($Elec_Req_UPS !== null ? "'".addslashes($Elec_Req_UPS)."'" : "NULL").",
			Elec_Req_Ener_Regul = ".($Elec_Req_Ener_Regul !== null ? "'".addslashes($Elec_Req_Ener_Regul)."'" : "NULL").",
			Elec_Planta_Emerg = ".($Elec_Planta_Emerg !== null ? "'".addslashes($Elec_Planta_Emerg)."'" : "NULL").",
			Elec_Cont_Tipo = ".($Elec_Cont_Tipo !== null ? "'".addslashes($Elec_Cont_Tipo)."'" : "NULL").",
			Elec_Cont_Color = ".($Elec_Cont_Color !== null ? "'".addslashes($Elec_Cont_Color)."'" : "NULL").",
			Elec_Cont_Cant = ".($Elec_Cont_Cant !== null ? "'".addslashes($Elec_Cont_Cant)."'" : "NULL").",
			Elec_Cont_Alt_SNPT = ".($Elec_Cont_Alt_SNPT !== null ? "'".addslashes($Elec_Cont_Alt_SNPT)."'" : "NULL").",
			Elec_Cont_Ubicacion = ".($Elec_Cont_Ubicacion !== null ? "'".addslashes($Elec_Cont_Ubicacion)."'" : "NULL").",
			Elec_Observaciones = ".($Elec_Observaciones !== null ? "'".addslashes($Elec_Observaciones)."'" : "NULL").",
			Elec_Carg_Elec_QTY = ".($Elec_Carg_Elec_QTY !== null ? "'".addslashes($Elec_Carg_Elec_QTY)."'" : "NULL").",
			Elec_Carg_Elec_Total = ".($Elec_Carg_Elec_Total !== null ? "'".addslashes($Elec_Carg_Elec_Total)."'" : "NULL").",
			Hvac_Temp_Set_Point = ".($Hvac_Temp_Set_Point !== null ? "'".addslashes($Hvac_Temp_Set_Point)."'" : "NULL").",
			Hvac_Temp_Rang_Oper_Min = ".($Hvac_Temp_Rang_Oper_Min !== null ? "'".addslashes($Hvac_Temp_Rang_Oper_Min)."'" : "NULL").",
			Hvac_Temp_Rang_Oper_Max = ".($Hvac_Temp_Rang_Oper_Max !== null ? "'".addslashes($Hvac_Temp_Rang_Oper_Max)."'" : "NULL").",
			Hvac_Temp_Gradiente = ".($Hvac_Temp_Gradiente !== null ? "'".addslashes($Hvac_Temp_Gradiente)."'" : "NULL").",
			Hvac_Humedad_Rango_Min = ".($Hvac_Humedad_Rango_Min !== null ? "'".addslashes($Hvac_Humedad_Rango_Min)."'" : "NULL").",
			Hvac_Humedad_Rango_Max = ".($Hvac_Humedad_Rango_Max !== null ? "'".addslashes($Hvac_Humedad_Rango_Max)."'" : "NULL").",
			Hvac_Discip_Term = ".($Hvac_Discip_Term !== null ? "'".addslashes($Hvac_Discip_Term)."'" : "NULL").",
			Hvac_Recam_X_Hora = ".($Hvac_Recam_X_Hora !== null ? "'".addslashes($Hvac_Recam_X_Hora)."'" : "NULL").",
			Hvac_Renovaciones_Aire = ".($Hvac_Renovaciones_Aire !== null ? "'".addslashes($Hvac_Renovaciones_Aire)."'" : "NULL").",
			Hvac_Efici_Filtrado = ".($Hvac_Efici_Filtrado !== null ? "'".addslashes($Hvac_Efici_Filtrado)."'" : "NULL").",
			Tel_Nodred_Cantidad = ".($Tel_Nodred_Cantidad !== null ? "'".addslashes($Tel_Nodred_Cantidad)."'" : "NULL").",
			Tel_Nodred_Tipo = ".($Tel_Nodred_Tipo !== null ? "'".addslashes($Tel_Nodred_Tipo)."'" : "NULL").",
			Tel_Nodred_Alt_Sntp = ".($Tel_Nodred_Alt_Sntp !== null ? "'".addslashes($Tel_Nodred_Alt_Sntp)."'" : "NULL").",
			Tel_Nodred_Ubicacion = ".($Tel_Nodred_Ubicacion !== null ? "'".addslashes($Tel_Nodred_Ubicacion)."'" : "NULL").",
			Tel_Nodcom_Cantidad = ".($Tel_Nodcom_Cantidad !== null ? "'".addslashes($Tel_Nodcom_Cantidad)."'" : "NULL").",
			Tel_Nodcom_Tipo = ".($Tel_Nodcom_Tipo !== null ? "'".addslashes($Tel_Nodcom_Tipo)."'" : "NULL").",
			Tel_Nodcom_Alt_Sntp = ".($Tel_Nodcom_Alt_Sntp !== null ? "'".addslashes($Tel_Nodcom_Alt_Sntp)."'" : "NULL").",
			Tel_Nodcom_Ubicacion = ".($Tel_Nodcom_Ubicacion !== null ? "'".addslashes($Tel_Nodcom_Ubicacion)."'" : "NULL").",
			Tel_Nodvideo_Cantidad = ".($Tel_Nodvideo_Cantidad !== null ? "'".addslashes($Tel_Nodvideo_Cantidad)."'" : "NULL").",
			Tel_Nodvideo_Tipo = ".($Tel_Nodvideo_Tipo !== null ? "'".addslashes($Tel_Nodvideo_Tipo)."'" : "NULL").",
			Tel_Nodvideo_Alt_Sntp = ".($Tel_Nodvideo_Alt_Sntp !== null ? "'".addslashes($Tel_Nodvideo_Alt_Sntp)."'" : "NULL").",
			Tel_Nodvideo_Ubicacion = ".($Tel_Nodvideo_Ubicacion !== null ? "'".addslashes($Tel_Nodvideo_Ubicacion)."'" : "NULL").",
			Tel_Ec_Tipo = ".($Tel_Ec_Tipo !== null ? "'".addslashes($Tel_Ec_Tipo)."'" : "NULL").",
			Tel_Ec_Req_Min = ".($Tel_Ec_Req_Min !== null ? "'".addslashes($Tel_Ec_Req_Min)."'" : "NULL").",
			Tel_Observaciones = ".($Tel_Observaciones !== null ? "'".addslashes($Tel_Observaciones)."'" : "NULL").",
			Hid_Agcal_Material = ".($Hid_Agcal_Material !== null ? "'".addslashes($Hid_Agcal_Material)."'" : "NULL").",
			Hid_Agcal_Diametro = ".($Hid_Agcal_Diametro !== null ? "'".addslashes($Hid_Agcal_Diametro)."'" : "NULL").",
			Hid_Agcal_Presion = ".($Hid_Agcal_Presion !== null ? "'".addslashes($Hid_Agcal_Presion)."'" : "NULL").",
			Hid_Agcal_Gasto = ".($Hid_Agcal_Gasto !== null ? "'".addslashes($Hid_Agcal_Gasto)."'" : "NULL").",
			Hid_Agcal_Temp = ".($Hid_Agcal_Temp !== null ? "'".addslashes($Hid_Agcal_Temp)."'" : "NULL").",
			Hid_Agcal_Calidad = ".($Hid_Agcal_Calidad !== null ? "'".addslashes($Hid_Agcal_Calidad)."'" : "NULL").",
			Hid_Agcal_Cantidad = ".($Hid_Agcal_Cantidad !== null ? "'".addslashes($Hid_Agcal_Cantidad)."'" : "NULL").",
			Hid_Agcal_Alt_SNPT = ".($Hid_Agcal_Alt_SNPT !== null ? "'".addslashes($Hid_Agcal_Alt_SNPT)."'" : "NULL").",
			Hid_Agcal_Ubicacion = ".($Hid_Agcal_Ubicacion !== null ? "'".addslashes($Hid_Agcal_Ubicacion)."'" : "NULL").",
			Hid_Agfria_Material = ".($Hid_Agfria_Material !== null ? "'".addslashes($Hid_Agfria_Material)."'" : "NULL").",
			Hid_Agfria_Diametro = ".($Hid_Agfria_Diametro !== null ? "'".addslashes($Hid_Agfria_Diametro)."'" : "NULL").",
			Hid_Agfria_Presion = ".($Hid_Agfria_Presion !== null ? "'".addslashes($Hid_Agfria_Presion)."'" : "NULL").",
			Hid_Agfria_Gasto = ".($Hid_Agfria_Gasto !== null ? "'".addslashes($Hid_Agfria_Gasto)."'" : "NULL").",
			Hid_Agfria_Temp = ".($Hid_Agfria_Temp !== null ? "'".addslashes($Hid_Agfria_Temp)."'" : "NULL").",
			Hid_Agfria_Calidad = ".($Hid_Agfria_Calidad !== null ? "'".addslashes($Hid_Agfria_Calidad)."'" : "NULL").",
			Hid_Agfria_Cantidad = ".($Hid_Agfria_Cantidad !== null ? "'".addslashes($Hid_Agfria_Cantidad)."'" : "NULL").",
			Hid_Agfria_Alt_SNPT = ".($Hid_Agfria_Alt_SNPT !== null ? "'".addslashes($Hid_Agfria_Alt_SNPT)."'" : "NULL").",
			Hid_Agfria_Ubicacion = ".($Hid_Agfria_Ubicacion !== null ? "'".addslashes($Hid_Agfria_Ubicacion)."'" : "NULL").",
			Hid_Observaciones = ".($Hid_Observaciones !== null ? "'".addslashes($Hid_Observaciones)."'" : "NULL").",
			Hid_Sanit_Material = ".($Hid_Sanit_Material !== null ? "'".addslashes($Hid_Sanit_Material)."'" : "NULL").",
			Hid_Sanit_Diametro = ".($Hid_Sanit_Diametro !== null ? "'".addslashes($Hid_Sanit_Diametro)."'" : "NULL").",
			Hid_Sanit_Caudal = ".($Hid_Sanit_Caudal !== null ? "'".addslashes($Hid_Sanit_Caudal)."'" : "NULL").",
			Hid_Sanit_Cantidad = ".($Hid_Sanit_Cantidad !== null ? "'".addslashes($Hid_Sanit_Cantidad)."'" : "NULL").",
			Hid_Sanit_Alt_SNPT = ".($Hid_Sanit_Alt_SNPT !== null ? "'".addslashes($Hid_Sanit_Alt_SNPT)."'" : "NULL").",
			Hid_Sanit_Ubicacion = ".($Hid_Sanit_Ubicacion !== null ? "'".addslashes($Hid_Sanit_Ubicacion)."'" : "NULL").",
			Hid_Sanit_Observaciones = ".($Hid_Sanit_Observaciones !== null ? "'".addslashes($Hid_Sanit_Observaciones)."'" : "NULL").",
			GM_Ox_Presion_Rang_Max = ".($GM_Ox_Presion_Rang_Max !== null ? "'".addslashes($GM_Ox_Presion_Rang_Max)."'" : "NULL").",
			GM_Ox_Presion_Rang_Min = ".($GM_Ox_Presion_Rang_Min !== null ? "'".addslashes($GM_Ox_Presion_Rang_Min)."'" : "NULL").",
			GM_Ox_Fluj_Oper_Max = ".($GM_Ox_Fluj_Oper_Max !== null ? "'".addslashes($GM_Ox_Fluj_Oper_Max)."'" : "NULL").",
			GM_Ox_Fluj_Oper_Min = ".($GM_Ox_Fluj_Oper_Min !== null ? "'".addslashes($GM_Ox_Fluj_Oper_Min)."'" : "NULL").",
			GM_Ox_Pres_Tom_Mural = ".($GM_Ox_Pres_Tom_Mural !== null ? "'".addslashes($GM_Ox_Pres_Tom_Mural)."'" : "NULL").",
			GM_Ox_Fluj_Min = ".($GM_Ox_Fluj_Min !== null ? "'".addslashes($GM_Ox_Fluj_Min)."'" : "NULL").",
			GM_Ox_Tipo_Conect = ".($GM_Ox_Tipo_Conect !== null ? "'".addslashes($GM_Ox_Tipo_Conect)."'" : "NULL").",
			GM_Ox_Cantidad = ".($GM_Ox_Cantidad !== null ? "'".addslashes($GM_Ox_Cantidad)."'" : "NULL").",
			GM_Ox_Alt_SNTP = ".($GM_Ox_Alt_SNTP !== null ? "'".addslashes($GM_Ox_Alt_SNTP)."'" : "NULL").",
			GM_Ox_Ubicacion = ".($GM_Ox_Ubicacion !== null ? "'".addslashes($GM_Ox_Ubicacion)."'" : "NULL").",
			GM_Ox_Observaciones = ".($GM_Ox_Observaciones !== null ? "'".addslashes($GM_Ox_Observaciones)."'" : "NULL").",
			GM_Air_Presion_Rang_Max = ".($GM_Air_Presion_Rang_Max !== null ? "'".addslashes($GM_Air_Presion_Rang_Max)."'" : "NULL").",
			GM_Air_Presion_Rang_Min = ".($GM_Air_Presion_Rang_Min !== null ? "'".addslashes($GM_Air_Presion_Rang_Min)."'" : "NULL").",
			GM_Air_Fluj_Oper_Max = ".($GM_Air_Fluj_Oper_Max !== null ? "'".addslashes($GM_Air_Fluj_Oper_Max)."'" : "NULL").",
			GM_Air_Fluj_Oper_Min = ".($GM_Air_Fluj_Oper_Min !== null ? "'".addslashes($GM_Air_Fluj_Oper_Min)."'" : "NULL").",
			GM_Air_Pres_Tom_Mural = ".($GM_Air_Pres_Tom_Mural !== null ? "'".addslashes($GM_Air_Pres_Tom_Mural)."'" : "NULL").",
			GM_Air_Fluj_Min = ".($GM_Air_Fluj_Min !== null ? "'".addslashes($GM_Air_Fluj_Min)."'" : "NULL").",
			GM_Air_Tipo_Conect = ".($GM_Air_Tipo_Conect !== null ? "'".addslashes($GM_Air_Tipo_Conect)."'" : "NULL").",
			GM_Air_Cantidad = ".($GM_Air_Cantidad !== null ? "'".addslashes($GM_Air_Cantidad)."'" : "NULL").",
			GM_Air_Alt_SNTP = ".($GM_Air_Alt_SNTP !== null ? "'".addslashes($GM_Air_Alt_SNTP)."'" : "NULL").",
			GM_Air_Ubicacion = ".($GM_Air_Ubicacion !== null ? "'".addslashes($GM_Air_Ubicacion)."'" : "NULL").",
			GM_Air_Observaciones = ".($GM_Air_Observaciones !== null ? "'".addslashes($GM_Air_Observaciones)."'" : "NULL").",
			GM_N2_Presion_Rang_Max = ".($GM_N2_Presion_Rang_Max !== null ? "'".addslashes($GM_N2_Presion_Rang_Max)."'" : "NULL").",
			GM_N2_Presion_Rang_Min = ".($GM_N2_Presion_Rang_Min !== null ? "'".addslashes($GM_N2_Presion_Rang_Min)."'" : "NULL").",
			GM_N2_Fluj_Oper_Max = ".($GM_N2_Fluj_Oper_Max !== null ? "'".addslashes($GM_N2_Fluj_Oper_Max)."'" : "NULL").",
			GM_N2_Fluj_Oper_Min = ".($GM_N2_Fluj_Oper_Min !== null ? "'".addslashes($GM_N2_Fluj_Oper_Min)."'" : "NULL").",
			GM_N2_Pres_Tom_Mural = ".($GM_N2_Pres_Tom_Mural !== null ? "'".addslashes($GM_N2_Pres_Tom_Mural)."'" : "NULL").",
			GM_N2_Fluj_Min = ".($GM_N2_Fluj_Min !== null ? "'".addslashes($GM_N2_Fluj_Min)."'" : "NULL").",
			GM_N2_Tipo_Conect = ".($GM_N2_Tipo_Conect !== null ? "'".addslashes($GM_N2_Tipo_Conect)."'" : "NULL").",
			GM_N2_Cantidad = ".($GM_N2_Cantidad !== null ? "'".addslashes($GM_N2_Cantidad)."'" : "NULL").",
			GM_N2_Alt_SNTP = ".($GM_N2_Alt_SNTP !== null ? "'".addslashes($GM_N2_Alt_SNTP)."'" : "NULL").",
			GM_N2_Ubicacion = ".($GM_N2_Ubicacion !== null ? "'".addslashes($GM_N2_Ubicacion)."'" : "NULL").",
			GM_N2_Observaciones = ".($GM_N2_Observaciones !== null ? "'".addslashes($GM_N2_Observaciones)."'" : "NULL").",
			GM_Co2_Presion_Rang_Max = ".($GM_Co2_Presion_Rang_Max !== null ? "'".addslashes($GM_Co2_Presion_Rang_Max)."'" : "NULL").",
			GM_Co2_Presion_Rang_Min = ".($GM_Co2_Presion_Rang_Min !== null ? "'".addslashes($GM_Co2_Presion_Rang_Min)."'" : "NULL").",
			GM_Co2_Fluj_Oper_Max = ".($GM_Co2_Fluj_Oper_Max !== null ? "'".addslashes($GM_Co2_Fluj_Oper_Max)."'" : "NULL").",
			GM_Co2_Fluj_Oper_Min = ".($GM_Co2_Fluj_Oper_Min !== null ? "'".addslashes($GM_Co2_Fluj_Oper_Min)."'" : "NULL").",
			GM_Co2_Pres_Tom_Mural = ".($GM_Co2_Pres_Tom_Mural !== null ? "'".addslashes($GM_Co2_Pres_Tom_Mural)."'" : "NULL").",
			GM_Co2_Fluj_Min = ".($GM_Co2_Fluj_Min !== null ? "'".addslashes($GM_Co2_Fluj_Min)."'" : "NULL").",
			GM_Co2_Tipo_Conect = ".($GM_Co2_Tipo_Conect !== null ? "'".addslashes($GM_Co2_Tipo_Conect)."'" : "NULL").",
			GM_Co2_Cantidad = ".($GM_Co2_Cantidad !== null ? "'".addslashes($GM_Co2_Cantidad)."'" : "NULL").",
			GM_Co2_Alt_SNTP = ".($GM_Co2_Alt_SNTP !== null ? "'".addslashes($GM_Co2_Alt_SNTP)."'" : "NULL").",
			GM_Co2_Ubicacion = ".($GM_Co2_Ubicacion !== null ? "'".addslashes($GM_Co2_Ubicacion)."'" : "NULL").",
			GM_Co2_Observaciones = ".($GM_Co2_Observaciones !== null ? "'".addslashes($GM_Co2_Observaciones)."'" : "NULL").",
			GM_Vac_Presion_Rang_Max = ".($GM_Vac_Presion_Rang_Max !== null ? "'".addslashes($GM_Vac_Presion_Rang_Max)."'" : "NULL").",
			GM_Vac_Presion_Rang_Min = ".($GM_Vac_Presion_Rang_Min !== null ? "'".addslashes($GM_Vac_Presion_Rang_Min)."'" : "NULL").",
			GM_Vac_Fluj_Oper_Max = ".($GM_Vac_Fluj_Oper_Max !== null ? "'".addslashes($GM_Vac_Fluj_Oper_Max)."'" : "NULL").",
			GM_Vac_Fluj_Oper_Min = ".($GM_Vac_Fluj_Oper_Min !== null ? "'".addslashes($GM_Vac_Fluj_Oper_Min)."'" : "NULL").",
			GM_Vac_Pres_Tom_Mural = ".($GM_Vac_Pres_Tom_Mural !== null ? "'".addslashes($GM_Vac_Pres_Tom_Mural)."'" : "NULL").",
			GM_Vac_Fluj_Min = ".($GM_Vac_Fluj_Min !== null ? "'".addslashes($GM_Vac_Fluj_Min)."'" : "NULL").",
			GM_Vac_Tipo_Conect = ".($GM_Vac_Tipo_Conect !== null ? "'".addslashes($GM_Vac_Tipo_Conect)."'" : "NULL").",
			GM_Vac_Cantidad = ".($GM_Vac_Cantidad !== null ? "'".addslashes($GM_Vac_Cantidad)."'" : "NULL").",
			GM_Vac_Alt_SNTP = ".($GM_Vac_Alt_SNTP !== null ? "'".addslashes($GM_Vac_Alt_SNTP)."'" : "NULL").",
			GM_Vac_Ubicacion = ".($GM_Vac_Ubicacion !== null ? "'".addslashes($GM_Vac_Ubicacion)."'" : "NULL").",
			GM_Vac_Observaciones = ".($GM_Vac_Observaciones !== null ? "'".addslashes($GM_Vac_Observaciones)."'" : "NULL").",
			Finan_Proveedor = ".($Finan_Proveedor !== null ? "'".addslashes($Finan_Proveedor)."'" : "NULL").",
			Finan_Inv_Esti_Unit = ".($Finan_Inv_Esti_Unit !== null ? "'".addslashes($Finan_Inv_Esti_Unit)."'" : "NULL").",
			Finan_Cant_A_Adquirir = ".($Finan_Cant_A_Adquirir !== null ? "'".addslashes($Finan_Cant_A_Adquirir)."'" : "NULL").",
			Finan_Tot_Inv_Estim = ".($Finan_Tot_Inv_Estim !== null ? "'".addslashes($Finan_Tot_Inv_Estim)."'" : "NULL")."
		WHERE Id_Esp_Tec = ".$Id_Esp_Tec.
	"";
	///echo $sql;
	$proveedor->execute($sql);
	if (!$proveedor->error()){
			
	}else{
		$error=true;
	}
	$proveedor->close();
}

public function getespecificacionestecnicas($Id_Activo, $proveedor=null){
	$respuesta = array();	
	$Data = array();
	$Data_Envia = array();
	$error=false;

	$proveedor = new Proveedor('sqlserver', 'activos');
	$proveedor->connect();
	$sql=" 
	select 
		Id_Esp_Tec,
		Id_Activo,
		Identif_Simbologia,
		Com_Proyeccion,
		F_L,
		F_P,
		F_H,
		F_Peso,
		F_Movilidad,
		F_Observaciones,
		Mob_Req_Esp,
		Mob_Lugar_Resg_Eq,
		Mob_Observaciones,
		Elec_Tip_Bateria,
		Elec_Tip_Direct_Volt,
		Elec_Tip_Direct_Amp,
		Elec_Tip_Alt_Sis_El,
		Elec_Tip_Alt_Volt,
		Elec_Tip_Alt_Amp,
		Elec_Tip_Alt_Consum,
		Elec_Bat_Integrada,
		Elec_Req_UPS,
		Elec_Req_Ener_Regul,
		Elec_Planta_Emerg,
		Elec_Cont_Tipo,
		Elec_Cont_Color,
		Elec_Cont_Cant,
		Elec_Cont_Alt_SNPT,
		Elec_Cont_Ubicacion,
		Elec_Observaciones,
		Elec_Carg_Elec_QTY,
		Elec_Carg_Elec_Total,
		Hvac_Temp_Set_Point,
		Hvac_Temp_Rang_Oper_Min,
		Hvac_Temp_Rang_Oper_Max,
		Hvac_Temp_Gradiente,
		Hvac_Humedad_Rango_Min,
		Hvac_Humedad_Rango_Max,
		Hvac_Discip_Term,
		Hvac_Recam_X_Hora,
		Hvac_Renovaciones_Aire,
		Hvac_Efici_Filtrado,
		Tel_Nodred_Cantidad,
		Tel_Nodred_Tipo,
		Tel_Nodred_Alt_Sntp,
		Tel_Nodred_Ubicacion,
		Tel_Nodcom_Cantidad,
		Tel_Nodcom_Tipo,
		Tel_Nodcom_Alt_Sntp,
		Tel_Nodcom_Ubicacion,
		Tel_Nodvideo_Cantidad,
		Tel_Nodvideo_Tipo,
		Tel_Nodvideo_Alt_Sntp,
		Tel_Nodvideo_Ubicacion,
		Tel_Ec_Tipo,
		Tel_Ec_Req_Min,
		Tel_Observaciones,
		Hid_Agcal_Material,
		Hid_Agcal_Diametro,
		Hid_Agcal_Presion,
		Hid_Agcal_Gasto,
		Hid_Agcal_Temp,
		Hid_Agcal_Calidad,
		Hid_Agcal_Cantidad,
		Hid_Agcal_Alt_SNPT,
		Hid_Agcal_Ubicacion,
		Hid_Agfria_Material,
		Hid_Agfria_Diametro,
		Hid_Agfria_Presion,
		Hid_Agfria_Gasto,
		Hid_Agfria_Temp,
		Hid_Agfria_Calidad,
		Hid_Agfria_Cantidad,
		Hid_Agfria_Alt_SNPT,
		Hid_Agfria_Ubicacion,
		Hid_Observaciones,
		Hid_Sanit_Material,
		Hid_Sanit_Diametro,
		Hid_Sanit_Caudal,
		Hid_Sanit_Cantidad,
		Hid_Sanit_Alt_SNPT,	
		Hid_Sanit_Ubicacion,
		Hid_Sanit_Observaciones,
		GM_Ox_Presion_Rang_Max,
		GM_Ox_Presion_Rang_Min,
		GM_Ox_Fluj_Oper_Max,
		GM_Ox_Fluj_Oper_Min,
		GM_Ox_Pres_Tom_Mural,
		GM_Ox_Fluj_Min,
		GM_Ox_Tipo_Conect,
		GM_Ox_Cantidad,
		GM_Ox_Alt_SNTP,
		GM_Ox_Ubicacion,
		GM_Ox_Observaciones,
		GM_Air_Presion_Rang_Max,
		GM_Air_Presion_Rang_Min,
		GM_Air_Fluj_Oper_Max,
		GM_Air_Fluj_Oper_Min,
		GM_Air_Pres_Tom_Mural,
		GM_Air_Fluj_Min,
		GM_Air_Tipo_Conect,
		GM_Air_Cantidad,
		GM_Air_Alt_SNTP,
		GM_Air_Ubicacion,
		GM_Air_Observaciones,
		GM_N2_Presion_Rang_Max,
		GM_N2_Presion_Rang_Min,
		GM_N2_Fluj_Oper_Max,
		GM_N2_Fluj_Oper_Min,
		GM_N2_Pres_Tom_Mural,
		GM_N2_Fluj_Min,
		GM_N2_Tipo_Conect,
		GM_N2_Cantidad,
		GM_N2_Alt_SNTP,
		GM_N2_Ubicacion,	
		GM_N2_Observaciones,
		GM_Co2_Presion_Rang_Max,
		GM_Co2_Presion_Rang_Min,
		GM_Co2_Fluj_Oper_Max,
		GM_Co2_Fluj_Oper_Min,
		GM_Co2_Pres_Tom_Mural,
		GM_Co2_Fluj_Min,
		GM_Co2_Tipo_Conect,
		GM_Co2_Cantidad,
		GM_Co2_Alt_SNTP,
		GM_Co2_Ubicacion,
		GM_Co2_Observaciones,
		GM_Vac_Presion_Rang_Max,
		GM_Vac_Presion_Rang_Min,
		GM_Vac_Fluj_Oper_Max,
		GM_Vac_Fluj_Oper_Min,
		GM_Vac_Pres_Tom_Mural,
		GM_Vac_Fluj_Min,
		GM_Vac_Tipo_Conect,
		GM_Vac_Cantidad,
		GM_Vac_Alt_SNTP,
		GM_Vac_Ubicacion,
		GM_Vac_Observaciones,
		Finan_Proveedor,
		Finan_Inv_Esti_Unit,
		Finan_Cant_A_Adquirir,
		Finan_Tot_Inv_Estim,
		Fech_Inser,
		Usr_Inser,
		Fech_Mod,
		Usr_Mod,
		Estatus_Reg
	from siga_especificaciones_tecnicas where Id_Activo=".$Id_Activo." and Estatus_Reg<>3 ";

	
	
	
	//echo $sql;
	$proveedor->execute($sql);
	if (!$proveedor->error()) {
		if ($proveedor->rows($proveedor->stmt) > 0) {
			while ($row = $proveedor->fetch_array($proveedor->stmt, 0)) {
				$Data= array(		
					"Id_Esp_Tec"=>$row["Id_Esp_Tec"],
					"Id_Activo" => $row["Id_Activo"],
					"Identif_Simbologia" => $row["Identif_Simbologia"],
					//"Com_Condicion" => $row["Com_Condicion"],
					"Com_Proyeccion" => $row["Com_Proyeccion"],
					"F_L" => $row["F_L"],
					"F_P" => $row["F_P"],
					"F_H" => $row["F_H"],
					"F_Peso" => $row["F_Peso"],
					"F_Movilidad" => $row["F_Movilidad"],
					"F_Observaciones" => $row["F_Observaciones"],
					"Mob_Req_Esp" => $row["Mob_Req_Esp"],
					"Mob_Lugar_Resg_Eq" => $row["Mob_Lugar_Resg_Eq"],
					"Mob_Observaciones" => $row["Mob_Observaciones"],
					"Elec_Tip_Bateria" => $row["Elec_Tip_Bateria"],
					"Elec_Tip_Direct_Volt" => $row["Elec_Tip_Direct_Volt"],
					"Elec_Tip_Direct_Amp" => $row["Elec_Tip_Direct_Amp"],
					"Elec_Tip_Alt_Sis_El" => $row["Elec_Tip_Alt_Sis_El"],
					"Elec_Tip_Alt_Volt" => $row["Elec_Tip_Alt_Volt"],
					"Elec_Tip_Alt_Amp" => $row["Elec_Tip_Alt_Amp"],
					"Elec_Tip_Alt_Consum" => $row["Elec_Tip_Alt_Consum"],
					"Elec_Bat_Integrada" => $row["Elec_Bat_Integrada"],
					"Elec_Req_UPS" => $row["Elec_Req_UPS"],
					"Elec_Req_Ener_Regul" => $row["Elec_Req_Ener_Regul"],
					"Elec_Planta_Emerg" => $row["Elec_Planta_Emerg"],
					"Elec_Cont_Tipo" => $row["Elec_Cont_Tipo"],
					"Elec_Cont_Color" => $row["Elec_Cont_Color"],
					"Elec_Cont_Cant" => $row["Elec_Cont_Cant"],
					"Elec_Cont_Alt_SNPT" => $row["Elec_Cont_Alt_SNPT"],
					"Elec_Cont_Ubicacion" => $row["Elec_Cont_Ubicacion"],
					"Elec_Observaciones" => $row["Elec_Observaciones"],
					"Elec_Carg_Elec_QTY" => $row["Elec_Carg_Elec_QTY"],
					"Elec_Carg_Elec_Total" => $row["Elec_Carg_Elec_Total"],
					"Hvac_Temp_Set_Point" => $row["Hvac_Temp_Set_Point"],
					"Hvac_Temp_Rang_Oper_Min" => $row["Hvac_Temp_Rang_Oper_Min"],
					"Hvac_Temp_Rang_Oper_Max" => $row["Hvac_Temp_Rang_Oper_Max"],
					"Hvac_Temp_Gradiente" => $row["Hvac_Temp_Gradiente"],
					"Hvac_Humedad_Rango_Min" => $row["Hvac_Humedad_Rango_Min"],
					"Hvac_Humedad_Rango_Max" => $row["Hvac_Humedad_Rango_Max"],
					"Hvac_Discip_Term" => $row["Hvac_Discip_Term"],
					"Hvac_Recam_X_Hora" => $row["Hvac_Recam_X_Hora"],
					"Hvac_Renovaciones_Aire" => $row["Hvac_Renovaciones_Aire"],
					"Hvac_Efici_Filtrado" => $row["Hvac_Efici_Filtrado"],
					"Tel_Nodred_Cantidad" => $row["Tel_Nodred_Cantidad"],
					"Tel_Nodred_Tipo" => $row["Tel_Nodred_Tipo"],
					"Tel_Nodred_Alt_Sntp" => $row["Tel_Nodred_Alt_Sntp"],
					"Tel_Nodred_Ubicacion" => $row["Tel_Nodred_Ubicacion"],
					"Tel_Nodcom_Cantidad" => $row["Tel_Nodcom_Cantidad"],
					"Tel_Nodcom_Tipo" => $row["Tel_Nodcom_Tipo"],
					"Tel_Nodcom_Alt_Sntp" => $row["Tel_Nodcom_Alt_Sntp"],
					"Tel_Nodcom_Ubicacion" => $row["Tel_Nodcom_Ubicacion"],
					"Tel_Nodvideo_Cantidad" => $row["Tel_Nodvideo_Cantidad"],
					"Tel_Nodvideo_Tipo" => $row["Tel_Nodvideo_Tipo"],
					"Tel_Nodvideo_Alt_Sntp" => $row["Tel_Nodvideo_Alt_Sntp"],
					"Tel_Nodvideo_Ubicacion" => $row["Tel_Nodvideo_Ubicacion"],
					"Tel_Ec_Tipo" => $row["Tel_Ec_Tipo"],
					"Tel_Ec_Req_Min" => $row["Tel_Ec_Req_Min"],
					"Tel_Observaciones" => $row["Tel_Observaciones"],
					"Hid_Agcal_Material" => $row["Hid_Agcal_Material"],
					"Hid_Agcal_Diametro" => $row["Hid_Agcal_Diametro"],
					"Hid_Agcal_Presion" => $row["Hid_Agcal_Presion"],
					"Hid_Agcal_Gasto" => $row["Hid_Agcal_Gasto"],
					"Hid_Agcal_Temp" => $row["Hid_Agcal_Temp"],
					"Hid_Agcal_Calidad" => $row["Hid_Agcal_Calidad"],
					"Hid_Agcal_Cantidad" => $row["Hid_Agcal_Cantidad"],
					"Hid_Agcal_Alt_SNPT" => $row["Hid_Agcal_Alt_SNPT"],
					"Hid_Agcal_Ubicacion" => $row["Hid_Agcal_Ubicacion"],
					"Hid_Agfria_Material" => $row["Hid_Agfria_Material"],
					"Hid_Agfria_Diametro" => $row["Hid_Agfria_Diametro"],
					"Hid_Agfria_Presion" => $row["Hid_Agfria_Presion"],
					"Hid_Agfria_Gasto" => $row["Hid_Agfria_Gasto"],
					"Hid_Agfria_Temp" => $row["Hid_Agfria_Temp"],
					"Hid_Agfria_Calidad" => $row["Hid_Agfria_Calidad"],
					"Hid_Agfria_Cantidad" => $row["Hid_Agfria_Cantidad"],
					"Hid_Agfria_Alt_SNPT" => $row["Hid_Agfria_Alt_SNPT"],
					"Hid_Agfria_Ubicacion" => $row["Hid_Agfria_Ubicacion"],
					"Hid_Observaciones" => $row["Hid_Observaciones"],
					"Hid_Sanit_Material" => $row["Hid_Sanit_Material"],
					"Hid_Sanit_Diametro" => $row["Hid_Sanit_Diametro"],
					"Hid_Sanit_Caudal" => $row["Hid_Sanit_Caudal"],
					"Hid_Sanit_Cantidad" => $row["Hid_Sanit_Cantidad"],
					"Hid_Sanit_Alt_SNPT" => $row["Hid_Sanit_Alt_SNPT"],
					"Hid_Sanit_Ubicacion" => $row["Hid_Sanit_Ubicacion"],
					"Hid_Sanit_Observaciones" => $row["Hid_Sanit_Observaciones"],
					"GM_Ox_Presion_Rang_Max" => $row["GM_Ox_Presion_Rang_Max"],
					"GM_Ox_Presion_Rang_Min" => $row["GM_Ox_Presion_Rang_Min"],
					"GM_Ox_Fluj_Oper_Max" => $row["GM_Ox_Fluj_Oper_Max"],
					"GM_Ox_Fluj_Oper_Min" => $row["GM_Ox_Fluj_Oper_Min"],
					"GM_Ox_Pres_Tom_Mural" => $row["GM_Ox_Pres_Tom_Mural"],
					"GM_Ox_Fluj_Min" => $row["GM_Ox_Fluj_Min"],
					"GM_Ox_Tipo_Conect" => $row["GM_Ox_Tipo_Conect"],
					"GM_Ox_Cantidad" => $row["GM_Ox_Cantidad"],
					"GM_Ox_Alt_SNTP" => $row["GM_Ox_Alt_SNTP"],
					"GM_Ox_Ubicacion" => $row["GM_Ox_Ubicacion"],
					"GM_Ox_Observaciones" => $row["GM_Ox_Observaciones"],
					"GM_Air_Presion_Rang_Max" => $row["GM_Air_Presion_Rang_Max"],
					"GM_Air_Presion_Rang_Min" => $row["GM_Air_Presion_Rang_Min"],
					"GM_Air_Fluj_Oper_Max" => $row["GM_Air_Fluj_Oper_Max"],
					"GM_Air_Fluj_Oper_Min" => $row["GM_Air_Fluj_Oper_Min"],
					"GM_Air_Pres_Tom_Mural" => $row["GM_Air_Pres_Tom_Mural"],
					"GM_Air_Fluj_Min" => $row["GM_Air_Fluj_Min"],
					"GM_Air_Tipo_Conect" => $row["GM_Air_Tipo_Conect"],
					"GM_Air_Cantidad" => $row["GM_Air_Cantidad"],
					"GM_Air_Alt_SNTP" => $row["GM_Air_Alt_SNTP"],
					"GM_Air_Ubicacion" => $row["GM_Air_Ubicacion"],
					"GM_Air_Observaciones" => $row["GM_Air_Observaciones"],
					"GM_N2_Presion_Rang_Max" => $row["GM_N2_Presion_Rang_Max"],
					"GM_N2_Presion_Rang_Min" => $row["GM_N2_Presion_Rang_Min"],
					"GM_N2_Fluj_Oper_Max" => $row["GM_N2_Fluj_Oper_Max"],
					"GM_N2_Fluj_Oper_Min" => $row["GM_N2_Fluj_Oper_Min"],
					"GM_N2_Pres_Tom_Mural" => $row["GM_N2_Pres_Tom_Mural"],
					"GM_N2_Fluj_Min" => $row["GM_N2_Fluj_Min"],
					"GM_N2_Tipo_Conect" => $row["GM_N2_Tipo_Conect"],
					"GM_N2_Cantidad" => $row["GM_N2_Cantidad"],
					"GM_N2_Alt_SNTP" => $row["GM_N2_Alt_SNTP"],
					"GM_N2_Ubicacion" => $row["GM_N2_Ubicacion"],
					"GM_N2_Observaciones" => $row["GM_N2_Observaciones"],
					"GM_Co2_Presion_Rang_Max" => $row["GM_Co2_Presion_Rang_Max"],
					"GM_Co2_Presion_Rang_Min" => $row["GM_Co2_Presion_Rang_Min"],
					"GM_Co2_Fluj_Oper_Max" => $row["GM_Co2_Fluj_Oper_Max"],
					"GM_Co2_Fluj_Oper_Min" => $row["GM_Co2_Fluj_Oper_Min"],
					"GM_Co2_Pres_Tom_Mural" => $row["GM_Co2_Pres_Tom_Mural"],
					"GM_Co2_Fluj_Min" => $row["GM_Co2_Fluj_Min"],
					"GM_Co2_Tipo_Conect" => $row["GM_Co2_Tipo_Conect"],
					"GM_Co2_Cantidad" => $row["GM_Co2_Cantidad"],
					"GM_Co2_Alt_SNTP" => $row["GM_Co2_Alt_SNTP"],
					"GM_Co2_Ubicacion" => $row["GM_Co2_Ubicacion"],
					"GM_Co2_Observaciones" => $row["GM_Co2_Observaciones"],
					"GM_Vac_Presion_Rang_Max" => $row["GM_Vac_Presion_Rang_Max"],
					"GM_Vac_Presion_Rang_Min" => $row["GM_Vac_Presion_Rang_Min"],
					"GM_Vac_Fluj_Oper_Max" => $row["GM_Vac_Fluj_Oper_Max"],
					"GM_Vac_Fluj_Oper_Min" => $row["GM_Vac_Fluj_Oper_Min"],
					"GM_Vac_Pres_Tom_Mural" => $row["GM_Vac_Pres_Tom_Mural"],
					"GM_Vac_Fluj_Min" => $row["GM_Vac_Fluj_Min"],
					"GM_Vac_Tipo_Conect" => $row["GM_Vac_Tipo_Conect"],
					"GM_Vac_Cantidad" => $row["GM_Vac_Cantidad"],
					"GM_Vac_Alt_SNTP" => $row["GM_Vac_Alt_SNTP"],
					"GM_Vac_Ubicacion" => $row["GM_Vac_Ubicacion"],
					"GM_Vac_Observaciones" => $row["GM_Vac_Observaciones"],
					"Finan_Proveedor" => $row["Finan_Proveedor"],
					"Finan_Inv_Esti_Unit" => $row["Finan_Inv_Esti_Unit"],
					"Finan_Cant_A_Adquirir" => $row["Finan_Cant_A_Adquirir"],
					"Finan_Tot_Inv_Estim" => $row["Finan_Tot_Inv_Estim"],
					"Fech_Inser" => $row["Fech_Inser"],
					"Usr_Inser" => $row["Usr_Inser"],
					"Fech_Mod" => $row["Fech_Mod"],
					"Usr_Mod" => $row["Usr_Mod"],
					"Estatus_Reg" => $row["Estatus_Reg"]
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

public function reporteEspecificacionesTecnicas($Id_Activo, $proveedor=null){
	$respuesta = array();	
	$Data = array();
	$Data_Envia = array();
	$error=false;

	$proveedor = new Proveedor('sqlserver', 'activos');
	$proveedor->connect();

	$sql="
		SELECT				
			S.Id_Activo,
			S.AF_BC,
			S.Nombre_Activo,
			S.Marca,
			S.Modelo,
			S.NumSerie,
			S.DescLarga,

			(select Desc_Ubic_Prim from siga_cat_ubic_prim T where T.Id_Ubic_Prim=S.Id_Ubic_Prim) as Ubic_Prim,
			(select Desc_Ubic_Sec from siga_cat_ubic_sec T where T.Id_Ubic_Sec=S.Id_Ubic_Sec) as Ubic_Sec,
			S.Especifica AS UbicacionEspecifica,
			E.Identif_Simbologia,

			(select P.Desc_Propiedad from siga_cat_propiedad P where P.Id_Propiedad=S.Id_Propiedad) as Propiedad,
			(select Con.siga_condicion_de_recepcion_descripcion from siga_cat_condicion_de_recepcion Con where Con.siga_condicion_de_recepcion_id=S.siga_activos_condicion_recepcion) as Condicion,
			(select Descripcion from Siga_cat_proyeccion Pro where Pro.Id_Proyeccion=E.Com_Proyeccion) as Proyeccion,

			F_L,
			F_P,
			F_H,
			F_Peso,
			F_Movilidad,
			F_Observaciones,

			Mob_Req_Esp,
			Mob_Lugar_Resg_Eq,
			Mob_Observaciones,

			Elec_Tip_Bateria,
			Elec_Tip_Direct_Volt,
			Elec_Tip_Direct_Amp,
			Elec_Tip_Alt_Sis_El,
			Elec_Tip_Alt_Volt,
			Elec_Tip_Alt_Amp,
			Elec_Tip_Alt_Consum,
			Elec_Bat_Integrada,
			Elec_Req_UPS,
			Elec_Req_Ener_Regul,
			Elec_Planta_Emerg,
			Elec_Cont_Tipo,
			Elec_Cont_Color,
			Elec_Cont_Cant,
			Elec_Cont_Alt_SNPT,
			Elec_Cont_Ubicacion,
			Elec_Observaciones,
			Elec_Carg_Elec_QTY,
			Elec_Carg_Elec_Total,

			Hvac_Temp_Set_Point,
			Hvac_Temp_Rang_Oper_Min,
			Hvac_Temp_Rang_Oper_Max,
			Hvac_Temp_Gradiente,
			Hvac_Humedad_Rango_Min,
			Hvac_Humedad_Rango_Max,
			Hvac_Discip_Term,
			Hvac_Recam_X_Hora,
			Hvac_Renovaciones_Aire,
			Hvac_Efici_Filtrado,
			
			Tel_Nodred_Cantidad,
			Tel_Nodred_Tipo,
			Tel_Nodred_Alt_Sntp,
			Tel_Nodred_Ubicacion,
			Tel_Nodcom_Cantidad,
			Tel_Nodcom_Tipo,
			Tel_Nodcom_Alt_Sntp,
			Tel_Nodcom_Ubicacion,
			Tel_Nodvideo_Cantidad,
			Tel_Nodvideo_Tipo,
			Tel_Nodvideo_Alt_Sntp,
			Tel_Nodvideo_Ubicacion,
			Tel_Ec_Tipo,
			Tel_Ec_Req_Min,
			Tel_Observaciones,

			Hid_Agcal_Material,
			Hid_Agcal_Diametro,
			Hid_Agcal_Presion,
			Hid_Agcal_Gasto,
			Hid_Agcal_Temp,
			Hid_Agcal_Calidad,
			Hid_Agcal_Cantidad,
			Hid_Agcal_Alt_SNPT,
			Hid_Agcal_Ubicacion,
			Hid_Agfria_Material,
			Hid_Agfria_Diametro,
			Hid_Agfria_Presion,
			Hid_Agfria_Gasto,
			Hid_Agfria_Temp,
			Hid_Agfria_Calidad,
			Hid_Agfria_Cantidad,
			Hid_Agfria_Alt_SNPT,
			Hid_Agfria_Ubicacion,
			Hid_Observaciones,
			Hid_Sanit_Material,
			Hid_Sanit_Diametro,
			Hid_Sanit_Caudal,
			Hid_Sanit_Cantidad,
			Hid_Sanit_Alt_SNPT,	
			Hid_Sanit_Ubicacion,
			Hid_Sanit_Observaciones,
			
			GM_Ox_Presion_Rang_Max,
			GM_Ox_Presion_Rang_Min,
			GM_Ox_Fluj_Oper_Max,
			GM_Ox_Fluj_Oper_Min,
			GM_Ox_Pres_Tom_Mural,
			GM_Ox_Fluj_Min,
			GM_Ox_Tipo_Conect,
			GM_Ox_Cantidad,
			GM_Ox_Alt_SNTP,
			GM_Ox_Ubicacion,
			GM_Ox_Observaciones,
			GM_Air_Presion_Rang_Max,
			GM_Air_Presion_Rang_Min,
			GM_Air_Fluj_Oper_Max,
			GM_Air_Fluj_Oper_Min,
			GM_Air_Pres_Tom_Mural,
			GM_Air_Fluj_Min,
			GM_Air_Tipo_Conect,
			GM_Air_Cantidad,
			GM_Air_Alt_SNTP,
			GM_Air_Ubicacion,
			GM_Air_Observaciones,
			GM_N2_Presion_Rang_Max,
			GM_N2_Presion_Rang_Min,
			GM_N2_Fluj_Oper_Max,
			GM_N2_Fluj_Oper_Min,
			GM_N2_Pres_Tom_Mural,
			GM_N2_Fluj_Min,
			GM_N2_Tipo_Conect,
			GM_N2_Cantidad,
			GM_N2_Alt_SNTP,
			GM_N2_Ubicacion,	
			GM_N2_Observaciones,
			GM_Co2_Presion_Rang_Max,
			GM_Co2_Presion_Rang_Min,
			GM_Co2_Fluj_Oper_Max,
			GM_Co2_Fluj_Oper_Min,
			GM_Co2_Pres_Tom_Mural,
			GM_Co2_Fluj_Min,
			GM_Co2_Tipo_Conect,
			GM_Co2_Cantidad,
			GM_Co2_Alt_SNTP,
			GM_Co2_Ubicacion,
			GM_Co2_Observaciones,
			GM_Vac_Presion_Rang_Max,
			GM_Vac_Presion_Rang_Min,
			GM_Vac_Fluj_Oper_Max,
			GM_Vac_Fluj_Oper_Min,
			GM_Vac_Pres_Tom_Mural,
			GM_Vac_Fluj_Min,
			GM_Vac_Tipo_Conect,
			GM_Vac_Cantidad,
			GM_Vac_Alt_SNTP,
			GM_Vac_Ubicacion,
			GM_Vac_Observaciones,
			Finan_Proveedor,
			Finan_Inv_Esti_Unit,
			Finan_Cant_A_Adquirir,
			Finan_Tot_Inv_Estim

		FROM siga_activos S
			LEFT JOIN siga_activo_proveedor P ON P.Id_Activo = S.Id_Activo
			LEFT JOIN (SELECT * FROM siga_activos_contabilidad WHERE Fech_Inser IS NOT NULL) C ON S.Id_Activo = C.Id_Activo
			LEFT JOIN siga_especificaciones_tecnicas E on S.Id_Activo=E.Id_Activo
		WHERE 
			0=0  AND S.Estatus_Reg <> 3  and S.Id_Area=1 
			AND (
				S.Id_Activo not in (select Id_Activo from siga_baja_activo)
				OR
				S.Id_Activo IN (
					SELECT B_1.Id_Activo
					FROM siga_baja_activo B_1
					INNER JOIN 
					(
						SELECT TOP 1 WITH TIES
							Id_Activo, Fecha_Baja AS UltimoRegistro, Id_baja AS UltimoMovimiento
						FROM siga_baja_activo
						ORDER BY
							ROW_NUMBER() OVER(PARTITION BY Id_Activo ORDER BY Fecha_Baja DESC, Id_baja DESC)
					) B_2
					ON B_1.Fecha_Baja = B_2.UltimoRegistro
					AND B_1.Id_Activo = B_2.Id_Activo
					AND B_1.Id_Baja = B_2.UltimoMovimiento
					WHERE
					/*-- Cancelados y que siguen en operación --*/
					B_1.Estatus_Cancelacion = 1 AND B_1.EstatusBaja = 0
				)
			)
	";
	if($Id_Activo!=""){
		$sql.=" AND S.Id_Activo=".$Id_Activo." ";	
	}

	$proveedor->execute($sql);
	if (!$proveedor->error()) {
		if ($proveedor->rows($proveedor->stmt) > 0) {
			while ($row = $proveedor->fetch_array($proveedor->stmt, 0)) {
				$Data= array(		
					"Id_Activo"=>$row["Id_Activo"],
					"AF_BC" => $row["AF_BC"],
					"Nombre_Activo" => $row["Nombre_Activo"],
					"Marca" => $row["Marca"],
					"Modelo" => $row["Modelo"],
					"NumSerie" => $row["NumSerie"],
					"DescLarga" => $row["DescLarga"],
					"Ubic_Prim" => $row["Ubic_Prim"],
					"Ubic_Sec" => $row["Ubic_Sec"],
					"UbicacionEspecifica" => $row["UbicacionEspecifica"],
					"Identif_Simbologia" => $row["Identif_Simbologia"],
					"Propiedad" => $row["Propiedad"],
					"Condicion" => $row["Condicion"],
					"Proyeccion" => $row["Proyeccion"],
					"F_L" => $row["F_L"],
					"F_P" => $row["F_P"],
					"F_H" => $row["F_H"],
					"F_Peso" => $row["F_Peso"],
					"F_Movilidad" => $row["F_Movilidad"],
					"F_Observaciones" => $row["F_Observaciones"],

					"Mob_Req_Esp" => $row["Mob_Req_Esp"],
					"Mob_Lugar_Resg_Eq" => $row["Mob_Lugar_Resg_Eq"],
					"Mob_Observaciones" => $row["Mob_Observaciones"],

					"Elec_Tip_Bateria" => $row["Elec_Tip_Bateria"],
					"Elec_Tip_Direct_Volt" => $row["Elec_Tip_Direct_Volt"],
					"Elec_Tip_Direct_Amp" => $row["Elec_Tip_Direct_Amp"],
					"Elec_Tip_Alt_Sis_El" => $row["Elec_Tip_Alt_Sis_El"],
					"Elec_Tip_Alt_Volt" => $row["Elec_Tip_Alt_Volt"],
					"Elec_Tip_Alt_Amp" => $row["Elec_Tip_Alt_Amp"],
					"Elec_Tip_Alt_Consum" => $row["Elec_Tip_Alt_Consum"],
					"Elec_Bat_Integrada" => $row["Elec_Bat_Integrada"],
					"Elec_Req_UPS" => $row["Elec_Req_UPS"],
					"Elec_Req_Ener_Regul" => $row["Elec_Req_Ener_Regul"],
					"Elec_Planta_Emerg" => $row["Elec_Planta_Emerg"],
					"Elec_Cont_Tipo" => $row["Elec_Cont_Tipo"],
					"Elec_Cont_Color" => $row["Elec_Cont_Color"],
					"Elec_Cont_Cant" => $row["Elec_Cont_Cant"],
					"Elec_Cont_Alt_SNPT" => $row["Elec_Cont_Alt_SNPT"],
					"Elec_Cont_Ubicacion" => $row["Elec_Cont_Ubicacion"],
					"Elec_Observaciones" => $row["Elec_Observaciones"],
					"Elec_Carg_Elec_QTY" => $row["Elec_Carg_Elec_QTY"],
					"Elec_Carg_Elec_Total" => $row["Elec_Carg_Elec_Total"],

					"Hvac_Temp_Set_Point" => $row["Hvac_Temp_Set_Point"],
					"Hvac_Temp_Rang_Oper_Min" => $row["Hvac_Temp_Rang_Oper_Min"],
					"Hvac_Temp_Rang_Oper_Max" => $row["Hvac_Temp_Rang_Oper_Max"],
					"Hvac_Temp_Gradiente" => $row["Hvac_Temp_Gradiente"],
					"Hvac_Humedad_Rango_Min" => $row["Hvac_Humedad_Rango_Min"],
					"Hvac_Humedad_Rango_Max" => $row["Hvac_Humedad_Rango_Max"],
					"Hvac_Discip_Term" => $row["Hvac_Discip_Term"],
					"Hvac_Recam_X_Hora" => $row["Hvac_Recam_X_Hora"],
					"Hvac_Renovaciones_Aire" => $row["Hvac_Renovaciones_Aire"],
					"Hvac_Efici_Filtrado" => $row["Hvac_Efici_Filtrado"],

					"Tel_Nodred_Cantidad" => $row["Tel_Nodred_Cantidad"],
					"Tel_Nodred_Tipo" => $row["Tel_Nodred_Tipo"],
					"Tel_Nodred_Alt_Sntp" => $row["Tel_Nodred_Alt_Sntp"],
					"Tel_Nodred_Ubicacion" => $row["Tel_Nodred_Ubicacion"],
					"Tel_Nodcom_Cantidad" => $row["Tel_Nodcom_Cantidad"],
					"Tel_Nodcom_Tipo" => $row["Tel_Nodcom_Tipo"],
					"Tel_Nodcom_Alt_Sntp" => $row["Tel_Nodcom_Alt_Sntp"],
					"Tel_Nodcom_Ubicacion" => $row["Tel_Nodcom_Ubicacion"],
					"Tel_Nodvideo_Cantidad" => $row["Tel_Nodvideo_Cantidad"],
					"Tel_Nodvideo_Tipo" => $row["Tel_Nodvideo_Tipo"],
					"Tel_Nodvideo_Alt_Sntp" => $row["Tel_Nodvideo_Alt_Sntp"],
					"Tel_Nodvideo_Ubicacion" => $row["Tel_Nodvideo_Ubicacion"],
					"Tel_Ec_Tipo" => $row["Tel_Ec_Tipo"],
					"Tel_Ec_Req_Min" => $row["Tel_Ec_Req_Min"],
					"Tel_Observaciones" => $row["Tel_Observaciones"],
					"Hid_Agcal_Material" => $row["Hid_Agcal_Material"],
					"Hid_Agcal_Diametro" => $row["Hid_Agcal_Diametro"],
					"Hid_Agcal_Presion" => $row["Hid_Agcal_Presion"],
					"Hid_Agcal_Gasto" => $row["Hid_Agcal_Gasto"],
					"Hid_Agcal_Temp" => $row["Hid_Agcal_Temp"],
					"Hid_Agcal_Calidad" => $row["Hid_Agcal_Calidad"],
					"Hid_Agcal_Cantidad" => $row["Hid_Agcal_Cantidad"],
					"Hid_Agcal_Alt_SNPT" => $row["Hid_Agcal_Alt_SNPT"],
					"Hid_Agcal_Ubicacion" => $row["Hid_Agcal_Ubicacion"],
					"Hid_Agfria_Material" => $row["Hid_Agfria_Material"],
					"Hid_Agfria_Diametro" => $row["Hid_Agfria_Diametro"],
					"Hid_Agfria_Presion" => $row["Hid_Agfria_Presion"],
					"Hid_Agfria_Gasto" => $row["Hid_Agfria_Gasto"],
					"Hid_Agfria_Temp" => $row["Hid_Agfria_Temp"],
					"Hid_Agfria_Calidad" => $row["Hid_Agfria_Calidad"],
					"Hid_Agfria_Cantidad" => $row["Hid_Agfria_Cantidad"],
					"Hid_Agfria_Alt_SNPT" => $row["Hid_Agfria_Alt_SNPT"],
					"Hid_Agfria_Ubicacion" => $row["Hid_Agfria_Ubicacion"],
					"Hid_Observaciones" => $row["Hid_Observaciones"],
					"Hid_Sanit_Material" => $row["Hid_Sanit_Material"],
					"Hid_Sanit_Diametro" => $row["Hid_Sanit_Diametro"],
					"Hid_Sanit_Caudal" => $row["Hid_Sanit_Caudal"],
					"Hid_Sanit_Cantidad" => $row["Hid_Sanit_Cantidad"],
					"Hid_Sanit_Alt_SNPT" => $row["Hid_Sanit_Alt_SNPT"],
					"Hid_Sanit_Ubicacion" => $row["Hid_Sanit_Ubicacion"],
					"Hid_Sanit_Observaciones" => $row["Hid_Sanit_Observaciones"],
					"GM_Ox_Presion_Rang_Max" => $row["GM_Ox_Presion_Rang_Max"],
					"GM_Ox_Presion_Rang_Min" => $row["GM_Ox_Presion_Rang_Min"],
					"GM_Ox_Fluj_Oper_Max" => $row["GM_Ox_Fluj_Oper_Max"],
					"GM_Ox_Fluj_Oper_Min" => $row["GM_Ox_Fluj_Oper_Min"],
					"GM_Ox_Pres_Tom_Mural" => $row["GM_Ox_Pres_Tom_Mural"],
					"GM_Ox_Fluj_Min" => $row["GM_Ox_Fluj_Min"],
					"GM_Ox_Tipo_Conect" => $row["GM_Ox_Tipo_Conect"],
					"GM_Ox_Cantidad" => $row["GM_Ox_Cantidad"],
					"GM_Ox_Alt_SNTP" => $row["GM_Ox_Alt_SNTP"],
					"GM_Ox_Ubicacion" => $row["GM_Ox_Ubicacion"],
					"GM_Ox_Observaciones" => $row["GM_Ox_Observaciones"],
					"GM_Air_Presion_Rang_Max" => $row["GM_Air_Presion_Rang_Max"],
					"GM_Air_Presion_Rang_Min" => $row["GM_Air_Presion_Rang_Min"],
					"GM_Air_Fluj_Oper_Max" => $row["GM_Air_Fluj_Oper_Max"],
					"GM_Air_Fluj_Oper_Min" => $row["GM_Air_Fluj_Oper_Min"],
					"GM_Air_Pres_Tom_Mural" => $row["GM_Air_Pres_Tom_Mural"],
					"GM_Air_Fluj_Min" => $row["GM_Air_Fluj_Min"],
					"GM_Air_Tipo_Conect" => $row["GM_Air_Tipo_Conect"],
					"GM_Air_Cantidad" => $row["GM_Air_Cantidad"],
					"GM_Air_Alt_SNTP" => $row["GM_Air_Alt_SNTP"],
					"GM_Air_Ubicacion" => $row["GM_Air_Ubicacion"],
					"GM_Air_Observaciones" => $row["GM_Air_Observaciones"],
					"GM_N2_Presion_Rang_Max" => $row["GM_N2_Presion_Rang_Max"],
					"GM_N2_Presion_Rang_Min" => $row["GM_N2_Presion_Rang_Min"],
					"GM_N2_Fluj_Oper_Max" => $row["GM_N2_Fluj_Oper_Max"],
					"GM_N2_Fluj_Oper_Min" => $row["GM_N2_Fluj_Oper_Min"],
					"GM_N2_Pres_Tom_Mural" => $row["GM_N2_Pres_Tom_Mural"],
					"GM_N2_Fluj_Min" => $row["GM_N2_Fluj_Min"],
					"GM_N2_Tipo_Conect" => $row["GM_N2_Tipo_Conect"],
					"GM_N2_Cantidad" => $row["GM_N2_Cantidad"],
					"GM_N2_Alt_SNTP" => $row["GM_N2_Alt_SNTP"],
					"GM_N2_Ubicacion" => $row["GM_N2_Ubicacion"],
					"GM_N2_Observaciones" => $row["GM_N2_Observaciones"],
					"GM_Co2_Presion_Rang_Max" => $row["GM_Co2_Presion_Rang_Max"],
					"GM_Co2_Presion_Rang_Min" => $row["GM_Co2_Presion_Rang_Min"],
					"GM_Co2_Fluj_Oper_Max" => $row["GM_Co2_Fluj_Oper_Max"],
					"GM_Co2_Fluj_Oper_Min" => $row["GM_Co2_Fluj_Oper_Min"],
					"GM_Co2_Pres_Tom_Mural" => $row["GM_Co2_Pres_Tom_Mural"],
					"GM_Co2_Fluj_Min" => $row["GM_Co2_Fluj_Min"],
					"GM_Co2_Tipo_Conect" => $row["GM_Co2_Tipo_Conect"],
					"GM_Co2_Cantidad" => $row["GM_Co2_Cantidad"],
					"GM_Co2_Alt_SNTP" => $row["GM_Co2_Alt_SNTP"],
					"GM_Co2_Ubicacion" => $row["GM_Co2_Ubicacion"],
					"GM_Co2_Observaciones" => $row["GM_Co2_Observaciones"],
					"GM_Vac_Presion_Rang_Max" => $row["GM_Vac_Presion_Rang_Max"],
					"GM_Vac_Presion_Rang_Min" => $row["GM_Vac_Presion_Rang_Min"],
					"GM_Vac_Fluj_Oper_Max" => $row["GM_Vac_Fluj_Oper_Max"],
					"GM_Vac_Fluj_Oper_Min" => $row["GM_Vac_Fluj_Oper_Min"],
					"GM_Vac_Pres_Tom_Mural" => $row["GM_Vac_Pres_Tom_Mural"],
					"GM_Vac_Fluj_Min" => $row["GM_Vac_Fluj_Min"],
					"GM_Vac_Tipo_Conect" => $row["GM_Vac_Tipo_Conect"],
					"GM_Vac_Cantidad" => $row["GM_Vac_Cantidad"],
					"GM_Vac_Alt_SNTP" => $row["GM_Vac_Alt_SNTP"],
					"GM_Vac_Ubicacion" => $row["GM_Vac_Ubicacion"],
					"GM_Vac_Observaciones" => $row["GM_Vac_Observaciones"],
					"Finan_Proveedor" => $row["Finan_Proveedor"],
					"Finan_Inv_Esti_Unit" => $row["Finan_Inv_Esti_Unit"],
					"Finan_Cant_A_Adquirir" => $row["Finan_Cant_A_Adquirir"],
					"Finan_Tot_Inv_Estim" => $row["Finan_Tot_Inv_Estim"],
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

public function emailEmpleados($numEmpleadoSolicitante){
	$siga_EmpleadosController = new Siga_v_empleados_activo_fijoController();
	$siga_EmpleadosDto = new Siga_v_empleados_activo_fijoDTO();
	$siga_EmpleadosDto->setNum_empleado($numEmpleadoSolicitante);
	$EmailSolicitante=$siga_EmpleadosController->selectSiga_v_empleados_activo_fijo($siga_EmpleadosDto);
	return $EmailSolicitante;
}

public function email_alta_activo($Id_Activo, $CveWorkFlow, $proveedor=null){
	$html_mail= file_get_contents('../../../datos/mail/correosigaaltaworflow.html');		
	
	$sql="
		select 
			top 1 wa.Id_Alta_Activo, wa.CveWorkflow, wa.DescWorflow, rtrim(ltrim(wa.Correo)) as Correo, wa.Nombre, No_Empleado, 
			ca.Nom_Area, 
			sa.AF_BC, sa.Nombre_Activo, up.Desc_Ubic_Prim, us.Desc_Ubic_Sec, DescCorta, sa.Marca, sa.Modelo, sa.NumSerie, p.Desc_Propiedad
		from 
			siga_workflow_alta_activo wa
				left join siga_activos sa on wa.Id_Activo=sa.Id_Activo 
				left join siga_cat_ubic_prim up on up.Id_Ubic_Prim=sa.Id_Ubic_Prim
				left join siga_cat_ubic_sec us on us.Id_Ubic_Sec=sa.Id_Ubic_Sec
				left join siga_cat_propiedad p on p.Id_Propiedad=sa.Id_Propiedad
				left join siga_catareas ca on ca.Id_Area=sa.Id_Area
		where wa.Id_Activo=".$Id_Activo." and CveWorkflow=".$CveWorkFlow."
	";
	$proveedor_det = new Proveedor('sqlserver', 'activos');
	$proveedor_det->connect();
	$proveedor_det->execute($sql);
	if (!$proveedor_det->error()){
		if ($proveedor_det->rows($proveedor_det->stmt) > 0) {
			while ($row = $proveedor_det->fetch_array($proveedor_det->stmt, 0)) {
				$CveWorkflow=$row["CveWorkflow"];
				$NombreEmail=$row["Nombre"];
				$Correo=$row["Correo"];
				
				$Area=$row["Nom_Area"];
				$Id_Alta_Activo=$row["Id_Alta_Activo"];
				$Activo=rtrim(ltrim($row["Nombre_Activo"]));
				$AFBC=$row["AF_BC"];
				$DescCorta=$row["DescCorta"];
				$UbicPri=$row["Desc_Ubic_Prim"];
				$UbicSec=$row["Desc_Ubic_Sec"];
				$Marca=$row["Marca"];
				$Modelo=$row["Modelo"];
				$Serie=$row["NumSerie"];
				$Propiedad=$row["Desc_Propiedad"];
				$ruta= "https://apps2.hospitalsatelite.com/SIGA";
				$html_mail = str_replace("#Area#",$Area,$html_mail);
				$html_mail = str_replace("#ACTIVO#",$Activo,$html_mail);
				$html_mail = str_replace("#Id_Activo_Alta#",$Id_Alta_Activo,$html_mail);
				$html_mail = str_replace("#Id_Activo#",$Id_Activo,$html_mail);
				$html_mail = str_replace("#RUTA#",$ruta,$html_mail);
				$html_mail = str_replace("#PASO#",$CveWorkflow,$html_mail);
				$html_mail = str_replace("#USER#",$NombreEmail,$html_mail);

				$html_mail = str_replace("#AFBC#",$AFBC,$html_mail);
				$html_mail = str_replace("#Ubic_Prim#",$UbicPri,$html_mail);
				$html_mail = str_replace("#Ubic_Sec#",$UbicSec,$html_mail);
				$html_mail = str_replace("#DescCorta#",$DescCorta,$html_mail);
				$html_mail = str_replace("#Marca#",$Marca,$html_mail);
				$html_mail = str_replace("#Modelo#",$Modelo,$html_mail);
				$html_mail = str_replace("#Serie#",$Serie,$html_mail);
				$html_mail = str_replace("#Propiedad#",$Propiedad,$html_mail);

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
				$data = array('strPassword' => 'C68H17S49', 'strSubject' => "Alta Activo (".$Activo.")",  'strTo'=>$Correo,'strHTMLBody'=>$html_mail,'strCc'=>'','strBCC'=>'jtalon@hospitalsatelite.com');
				//Pruebas
				//$data = array('strPassword' => 'C68H17S49', 'strSubject' => "Alta Activo (".$Activo.")",'strTo'=>'jtalon@hospitalsatelite.com','strHTMLBody'=>$html_mail,'strCc'=>'','strBCC'=>'jtalon@hospitalsatelite.com');
				$correoASP = $obj->curlData($url,$data);
				
			}
		}
	}
		
	$proveedor->close();
	
}

public function workflow_alta($Aceptado, $Id_Alta_Activo, $Paso){
	$proveedor = new Proveedor('sqlserver', 'activos');
	$proveedor->connect();
	$sql="UPDATE siga_workflow_alta_activo SET Aceptado=".$Aceptado.", FechaAceptado=getdate() ";
	$sql.="where Id_Alta_Activo= ".$Id_Alta_Activo;
	$error=false;
	$proveedor->execute($sql);
	if (!$proveedor->error()){
		if($Aceptado!=2){
			$proveedor2 = new Proveedor('sqlserver', 'activos');
			$proveedor2->connect();
			$sql="select 
					top 1
					(".$Paso."+1) as siguiente_paso,
					* 
				from 
					siga_workflow_alta_activo 
				where 
					Id_Activo=(select Id_Activo from siga_workflow_alta_activo where Id_Alta_Activo=".$Id_Alta_Activo.") 
					and CveWorkflow=(".$Paso."+1)
			";
			$proveedor2->execute($sql);
			if (!$proveedor2->error()){
				if ($proveedor2->rows($proveedor2->stmt) > 0) {
					while ($row_c = $proveedor2->fetch_array($proveedor2->stmt, 0)) {
						$Sig_Paso=$row_c["siguiente_paso"];
						$Id_Activo=$row_c["Id_Activo"];
						$email=$this->email_alta_activo($Id_Activo, $Sig_Paso, $proveedor2);
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



public function getcatalogo($tabla, $id_campo, $campo, $proveedor=null){

	$respuesta = array();	
	$Data = array();
	$Data_Envia = array();
	$error=false;

	$proveedor = new Proveedor('sqlserver', 'activos');
	$proveedor->connect();
	$sql="select * from ".$tabla." where Estatus_Reg<>3 order by ".$campo;
	
	//echo $sql;
	$proveedor->execute($sql);
	if (!$proveedor->error()) {
		if ($proveedor->rows($proveedor->stmt) > 0) {
			while ($row = $proveedor->fetch_array($proveedor->stmt, 0)) {
				$Data= array(
					"".$id_campo.""=>$row["".$id_campo.""],
					"".$campo.""=>$row["".$campo.""]
					
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

public function updateSiga_activos($Siga_activosDto, $esptecnicas, $Id_Esp_Tec, $proveedor=null){
//$Siga_activosDto=$this->validarSiga_activos($Siga_activosDto);
$Siga_activosDao = new Siga_activosDAO();
//$tmpDto = new Siga_activosDTO();
//$tmpDto = $Siga_activosDao->selectSiga_activos($Siga_activosDto,$proveedor);
//if($tmpDto!=""){//$Siga_activosDto->setFechaRegistro($tmpDto[0]->getFechaRegistro());
$Siga_activosDto = $Siga_activosDao->updateSiga_activos($Siga_activosDto,$proveedor);
if($Siga_activosDto[0]->getId_Area()==1){
	if($Id_Esp_Tec==""){
		$this->insertEspecificacionesTecnicas($Siga_activosDto[0]->getId_Activo(), $Siga_activosDto[0]->getUsr_Mod(),$esptecnicas, $proveedor);
	}else{
		$this->updateEspecificacionesTecnicas($Id_Esp_Tec, $Siga_activosDto[0]->getUsr_Mod(),$esptecnicas, $proveedor);
	}
}
return $Siga_activosDto;
//}
//return "";
}

public function guardarEspTecFinan($Id_Esp_Tec, $Id_Activo, $esptecnicas, $Usr_Mod, $proveedor=null){
	if($Id_Esp_Tec==""){
		$this->insertEspecificacionesTecnicas($Id_Activo, $Usr_Mod,$esptecnicas, $proveedor);
	}else{
		$this->updateEspecificacionesTecnicas($Id_Esp_Tec, $Usr_Mod,$esptecnicas, $proveedor);
	}
	return "";
}

public function deleteSiga_activos($Siga_activosDto,$proveedor=null){
//$Siga_activosDto=$this->validarSiga_activos($Siga_activosDto);
$Siga_activosDao = new Siga_activosDAO();
$Siga_activosDto = $Siga_activosDao->deleteSiga_activos($Siga_activosDto,$proveedor);
return $Siga_activosDto;
}


public function grafica_clasificacion($Siga_activosDto, $proveedor=null){
	$Total=0;
	$Data = array();
	$Data_Envia = array();
	
	
	$respuesta = array();
	$error=false;
	
	$proveedor = new Proveedor('sqlserver', 'activos');
	$proveedor->connect();
	
	$Clase_y_Clasificacion="";
	
	
	if($Siga_activosDto->getId_Clasificacion()!=""&&$Siga_activosDto->getId_Clasificacion()!="-1"){
		$Clase_y_Clasificacion.=" Id_Clasificacion=".$Siga_activosDto->getId_Clasificacion()." and ";
	}
	
	if($Siga_activosDto->getId_Clase()!=""&&$Siga_activosDto->getId_Clase()!="-1"){
		$Clase_y_Clasificacion.=" A.Id_Clase=".$Siga_activosDto->getId_Clase()." and ";
	}
	
	if($Siga_activosDto->getId_Clase()!=""){
		$sql="
			SELECT S.Desc_Clasificacion, A.Id_Clasificacion,COUNT(A.Id_Clasificacion) AS RecuentoFilas
			FROM siga_activos A
			left join siga_cat_clasificacion S on A.Id_Clasificacion=S.Id_Clasificacion
			where  ".$Clase_y_Clasificacion." A.Id_Area='".$Siga_activosDto->getId_Area()."' and A.Estatus_Reg<>'3' and A.Id_Situacion_Activo<>'12'
			GROUP BY S.Desc_Clasificacion, A.Id_Clasificacion
			HAVING COUNT(A.Id_Clasificacion) > 0
			ORDER BY A.Id_Clasificacion
		";
	}else{
		$sql="
			SELECT Id_Clase, COUNT(*) AS RecuentoFilas
			FROM siga_activos 
			where  ".$Clase_y_Clasificacion." Id_Area='".$Siga_activosDto->getId_Area()."' and Estatus_Reg<>'3' and Id_Situacion_Activo<>'12'
			GROUP BY Id_Clase
			HAVING COUNT(*) > 0
			ORDER BY Id_Clase
		";
	}
	
	$proveedor->execute($sql);
	
	
	if (!$proveedor->error()){
		if ($proveedor->rows($proveedor->stmt) > 0) {
			while ($row_c = $proveedor->fetch_array($proveedor->stmt, 0)) {
				$Total=$Total+$row_c["RecuentoFilas"];
				$Id_Clase="";
				$Desc_Clase="";
				$Desc_Clasificacion="";
				
				$proveedor2 = new Proveedor('sqlserver', 'activos');
				$proveedor2->connect();
				
				if($Siga_activosDto->getId_Clase()==""){
					$sql="
						SELECT a.Id_Clase,f.Desc_Clase,s.Desc_Clasificacion, a.Id_Clasificacion, COUNT(*) AS RecuentoFilas
						FROM siga_activos a 
						left join siga_cat_clasificacion s on  a.Id_Clasificacion=s.Id_Clasificacion
						left join siga_cat_clase f on  a.Id_Clase=F.Id_Clase
						where   a.Id_Clase='".$row_c["Id_Clase"]."' and  a.Id_Area='".$Siga_activosDto->getId_Area()."' and a.Estatus_Reg<>'3' and a.Id_Situacion_Activo<>'12'
						GROUP BY a.Id_Clase,f.Desc_Clase,s.Desc_Clasificacion,a.Id_Clasificacion
						HAVING COUNT(*) > 0
						ORDER BY RecuentoFilas desc
					";
				
					$DataClasificacion = array();
					$DataClasificacion_Envia = array();
					$proveedor2->execute($sql);
					if (!$proveedor2->error()){
						if ($proveedor2->rows($proveedor2->stmt) > 0) {
							while ($row = $proveedor2->fetch_array($proveedor2->stmt, 0)) {
								$Id_Clase=$row["Id_Clase"];
								$Desc_Clase=$row["Desc_Clase"];
								$Desc_Clasificacion=$row["Desc_Clasificacion"];
								if($Siga_activosDto->getId_Clase()==""){
									$DataClasificacion= array(
										"Desc_Clase"=>$Desc_Clase,
										"Id_Clasificacion"=>$row["Id_Clasificacion"],
										"Desc_Clasificacion"=>$Desc_Clasificacion,
										"RecuentoFilasClasificacion" => $row["RecuentoFilas"]
									);
								
									array_push($DataClasificacion_Envia, $DataClasificacion);
								}
							}
						}
					}else{
						$error=true;
					}
					$proveedor2->close();
					
					
					$Data= array(
						"Clasificacion"=>$DataClasificacion_Envia,
						"Id_Clase"=>$Id_Clase,
						"Desc_Clase"=>$Desc_Clase,
						"RecuentoFilas" => $row_c["RecuentoFilas"],
						"CountClasificacion"=>count($DataClasificacion_Envia)
					);	
				}else{
					$Data= array(
						"Desc_Clasificacion"=>$row_c["Desc_Clasificacion"],
						"Id_Clasificacion"=>$row_c["Id_Clasificacion"],
						"RecuentoFilas" => $row_c["RecuentoFilas"],
					);	
				}
				
				array_push($Data_Envia, $Data);
			}
		}	
	}else{
		$error=true;
	}
	
	$proveedor->close();
	
	if($error==false){
		$respuesta = array("totalCount" => count($Data_Envia),"Total_Filas"=>$Total,"data" => $Data_Envia,"estatus" => "ok", "mensaje" => "Registros Encontrados");
	}else{
		$respuesta = array("totalCount" => "0", "data" => "","estatus" => "error", "mensaje" => "No se Encontraron Registros");
	}
	return $respuesta;
}


public function grafica_subfamilias($Siga_activosDto, $proveedor=null){
	$Total=0;
	$Data = array();
	$Data_Envia = array();
	
	
	$respuesta = array();
	$error=false;
	
	$proveedor = new Proveedor('sqlserver', 'activos');
	$proveedor->connect();
	
	$Familia_y_Subfamilia="";
	
	
	if($Siga_activosDto->getId_Subfamilia()!=""&&$Siga_activosDto->getId_Subfamilia()!="-1"){
		$Familia_y_Subfamilia.=" Id_Subfamilia=".$Siga_activosDto->getId_Subfamilia()." and ";
	}
	
	if($Siga_activosDto->getId_Familia()!=""&&$Siga_activosDto->getId_Familia()!="-1"){
		$Familia_y_Subfamilia.=" A.Id_Familia=".$Siga_activosDto->getId_Familia()." and ";
	}
	
	if($Siga_activosDto->getId_Familia()!=""){
		$sql="
			SELECT S.Desc_Subfamilia, A.Id_Subfamilia,COUNT(A.Id_Subfamilia) AS RecuentoFilas
			FROM siga_activos A
			left join siga_cat_subfamilia S on A.Id_Subfamilia=S.Id_Subfamilia
			where  ".$Familia_y_Subfamilia." A.Id_Area='".$Siga_activosDto->getId_Area()."' and A.Estatus_Reg<>'3' and A.Id_Situacion_Activo<>'12'
			GROUP BY S.Desc_Subfamilia, A.Id_Subfamilia
			HAVING COUNT(A.Id_Subfamilia) > 0
			ORDER BY A.Id_Subfamilia
		";
	}else{
		$sql="
			SELECT Id_Familia, COUNT(*) AS RecuentoFilas
			FROM siga_activos 
			where  ".$Familia_y_Subfamilia." Id_Area='".$Siga_activosDto->getId_Area()."' and Estatus_Reg<>'3' and Id_Situacion_Activo<>'12'
			GROUP BY Id_Familia
			HAVING COUNT(*) > 0
			ORDER BY Id_Familia
		";
	}
	
	$proveedor->execute($sql);
	
	
	if (!$proveedor->error()){
		if ($proveedor->rows($proveedor->stmt) > 0) {
			while ($row_c = $proveedor->fetch_array($proveedor->stmt, 0)) {
				$Total=$Total+$row_c["RecuentoFilas"];
				$Id_Familia="";
				$Desc_Familia="";
				$Desc_Subfamilia="";
				
				$proveedor2 = new Proveedor('sqlserver', 'activos');
				$proveedor2->connect();
				
				if($Siga_activosDto->getId_Familia()==""){
					$sql="
						SELECT a.Id_Familia,f.Desc_Familia,s.Desc_Subfamilia, a.Id_Subfamilia, COUNT(*) AS RecuentoFilas
						FROM siga_activos a 
						left join siga_cat_subfamilia s on  a.Id_Subfamilia=s.Id_Subfamilia
						left join siga_cat_familia f on  a.Id_Familia=F.Id_Familia
						where   a.Id_Familia='".$row_c["Id_Familia"]."' and  a.Id_Area='".$Siga_activosDto->getId_Area()."' and a.Estatus_Reg<>'3' and a.Id_Situacion_Activo<>'12'
						GROUP BY a.Id_Familia,f.Desc_Familia,s.Desc_Subfamilia,a.Id_Subfamilia
						HAVING COUNT(*) > 0
						ORDER BY RecuentoFilas desc
					";
				
					$DataSubfamilia = array();
					$DataSubfamilia_Envia = array();
					$proveedor2->execute($sql);
					if (!$proveedor2->error()){
						if ($proveedor2->rows($proveedor2->stmt) > 0) {
							while ($row = $proveedor2->fetch_array($proveedor2->stmt, 0)) {
								$Id_Familia=$row["Id_Familia"];
								$Desc_Familia=$row["Desc_Familia"];
								$Desc_Subfamilia=$row["Desc_Subfamilia"];
								if($Siga_activosDto->getId_Familia()==""){
									$DataSubfamilia= array(
										"Desc_Familia"=>$Desc_Familia,
										"Id_Subfamilia"=>$row["Id_Subfamilia"],
										"Desc_Subfamilia"=>$Desc_Subfamilia,
										"RecuentoFilasSubfamilia" => $row["RecuentoFilas"]
									);
								
									array_push($DataSubfamilia_Envia, $DataSubfamilia);
								}
							}
						}
					}else{
						$error=true;
					}
					$proveedor2->close();
					
					
					$Data= array(
						"Subfamilia"=>$DataSubfamilia_Envia,
						"Id_Familia"=>$Id_Familia,
						"Desc_Familia"=>$Desc_Familia,
						"RecuentoFilas" => $row_c["RecuentoFilas"],
						"CountSubfamilia"=>count($DataSubfamilia_Envia)
					);	
				}else{
					$Data= array(
						"Desc_Subfamilia"=>$row_c["Desc_Subfamilia"],
						"Id_Subfamilia"=>$row_c["Id_Subfamilia"],
						"RecuentoFilas" => $row_c["RecuentoFilas"],
					);	
				}
				
				array_push($Data_Envia, $Data);
			}
		}	
	}else{
		$error=true;
	}
	
	$proveedor->close();
	
	if($error==false){
		$respuesta = array("totalCount" => count($Data_Envia),"Total_Filas"=>$Total,"data" => $Data_Envia,"estatus" => "ok", "mensaje" => "Registros Encontrados");
	}else{
		$respuesta = array("totalCount" => "0", "data" => "","estatus" => "error", "mensaje" => "No se Encontraron Registros");
	}
	return $respuesta;
}

public function grafica_estatus_activo($Siga_activosDto, $proveedor=null){
	$Total=0;
	$Data = array();
	$Data_Envia = array();
	
	$respuesta = array();
	$error=false;
	
	$proveedor = new Proveedor('sqlserver', 'activos');
	$proveedor->connect();
	
	$Estatus_Activo="";
	
	
	if($Siga_activosDto->getId_Situacion_Activo()!=""&&$Siga_activosDto->getId_Situacion_Activo()!="-1"){
		$Estatus_Activo.=" Id_Situacion_Activo=".$Siga_activosDto->getId_Situacion_Activo()." and ";
	}
	
	
	$sql="
		SELECT Id_Situacion_Activo, COUNT(*) AS RecuentoFilas
		FROM siga_activos 
		where  ".$Estatus_Activo." Id_Area='".$Siga_activosDto->getId_Area()."' and Estatus_Reg<>'3' and Id_Situacion_Activo<>'12'
		GROUP BY Id_Situacion_Activo
		HAVING COUNT(*) > 0
		ORDER BY Id_Situacion_Activo
	";
	
	$proveedor->execute($sql);
	
	
	if (!$proveedor->error()){
		if ($proveedor->rows($proveedor->stmt) > 0) {
			while ($row_c = $proveedor->fetch_array($proveedor->stmt, 0)) {
				$Total=$Total+$row_c["RecuentoFilas"];
				$Desc_Estatus="";
				
				$proveedor2 = new Proveedor('sqlserver', 'activos');
				$proveedor2->connect();
				
				
				$sql="
					select Desc_Estatus from  siga_cat_estatus
					where Id_Estatus='".$row_c["Id_Situacion_Activo"]."'
				";
				
				$proveedor2->execute($sql);
				if (!$proveedor2->error()){
					if ($proveedor2->rows($proveedor2->stmt) > 0) {
						while ($row = $proveedor2->fetch_array($proveedor2->stmt, 0)) {
							$Desc_Estatus=$row["Desc_Estatus"];
						}
					}
				}else{
					$error=true;
				}
				$proveedor2->close();
				
				$Data= array(
				    "Desc_Estatus"=>$Desc_Estatus,
				    "Id_Situacion_Activo" => $row_c["Id_Situacion_Activo"],
				    "RecuentoFilas" => $row_c["RecuentoFilas"]
				);
				array_push($Data_Envia, $Data);
			}
		}	
	}else{
		$error=true;
	}
	
	$proveedor->close();
	
	if($error==false){
		$respuesta = array("totalCount" => count($Data_Envia),"Total_Filas"=>$Total,"data" => $Data_Envia,"estatus" => "ok", "mensaje" => "Registros Encontrados");
	}else{
		$respuesta = array("totalCount" => "0", "data" => "","estatus" => "error", "mensaje" => "No se Encontraron Registros");
	}
	return $respuesta;
}


}
?>