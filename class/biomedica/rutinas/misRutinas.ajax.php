<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/biomedica/rutinas/rutinas.class.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/admin/utilerias/util.class.php");

$utilClass    = new util();
$rutinasClass = new rutinas();

$ruta = $utilClass->rutaRaiz();

$siga_rutinas_descripcion = $_POST['siga_rutinas_descripcion'];
$Id_Usuario               = $_POST['Id_Usuario'];
$Id_Area                  = $_POST['Id_Area'];

$idRutina = $rutinasClass->sigaRutinasTitulo($siga_rutinas_descripcion,$Id_Usuario,$Id_Area);

//=============================================================================================================================================================
if($idRutina){
//=============================================================================================================================================================
  $x=1;
  for ($miContador=0; $miContador<=110;){  
//-------------------------------------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------------------------------------------
    $ramdom = $utilClass->nombreAleatorio();
    $siga_rutina_actividad = $_POST['siga_rutina_actividad'.$miContador];

        if($siga_rutina_actividad !=''){          
//-------------------------------------------------------------------------------------------------------------------------------------------------------------

        $siga_rutina_actividad          = trim($_POST['siga_rutina_actividad'.$miContador]);
        $siga_rutina_valor_referenciado = trim($_POST['siga_rutina_valor_referenciado'.$miContador]);
        $siga_rutina_valor_medio        = $_POST['siga_rutina_valor_medio'.$miContador];
        $siga_rutina_adjunto            = $_POST['siga_rutina_adjunto'.$miContador];

        $siga_rutina_valor_medio  = ($siga_rutina_valor_medio == 'true') ? 1 : 0;
        $siga_rutina_adjunto      = ($siga_rutina_adjunto == 'true') ? 1 : 0;
        
        $idActividad = $rutinasClass->sigaRutinasActividad($idRutina,$x,$siga_rutina_actividad,$siga_rutina_valor_referenciado,$siga_rutina_valor_medio,$siga_rutina_adjunto,$Id_Usuario);

          if($idActividad){

            if($_FILES['miArchivo'.$miContador]!= null){            
              $ext = pathinfo($_FILES['miArchivo'.$miContador]['name'], PATHINFO_EXTENSION);
                $name = $idRutina.$ramdom.'.'.$ext;
                  if(move_uploaded_file($_FILES['miArchivo'.$miContador]['tmp_name'], $ruta.'/Archivos/Archivos-Rutinas/'.$name)){
                    $rutinasClass->sigaRutinasActividadUpdateArchivo($idActividad,$name);
                  }else{
                    $utilClass->fnlog('Error al subir archivo rutina-actividades');
                  }
              }else{
                $rutinasClass->sigaRutinasActividadUpdateArchivo($idActividad,'');
              }
          }
//-------------------------------------------------------------------------------------------------------------------------------------------------------------
        }
//-------------------------------------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------------------------------------------
    $miContador++;
    $x++;
  }
  echo json_encode(true);
//=============================================================================================================================================================  
} else {
  echo json_encode(false);
}
//=============================================================================================================================================================
