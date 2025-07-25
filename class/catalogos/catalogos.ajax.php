<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/catalogos/catalogos.class.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/admin/utilerias/util.class.php");

if(	isset($_POST['accion']) && 
  $_POST['accion'] !==''){

  $accion = trim($_POST['accion']);

    if($accion == 1){      
      $catalogosClass = new catalogos();

      $Id_Area = trim($_POST['Id_Area']);        
      $info = $catalogosClass->getGestorPorArea($Id_Area); 
      $infoArray = array('<option value="-1">Seleccionar Gestor</option>');
      
      foreach($info as $item){
        $infoArray[] = '<option value="'.$item["idUsuario"].'">'.$item["Nombre_Empleado"].'</option>';
      }

      echo json_encode($infoArray);

    } else if($accion == 2){      
      
      $catalogosClass = new catalogos();

      $Id_Area = trim($_POST['Id_Area']);        
      $info = $catalogosClass->getRutinasPorArea($Id_Area); 
      $infoArray = array('<option value="-1">Seleccionar Rutina</option>');
      
      foreach($info as $item){
        $infoArray[] = '<option value="'.$item["siga_cat_rutinas_id"].'">'.$item["siga_cat_rutinas_titulo"].'</option>';
      }

      echo json_encode($infoArray);

    } else if($accion == 3){      
      
      $catalogosClass = new catalogos();

      $idRutina = $_POST['idRutina'];
      $info     = $catalogosClass->getRutinaDetalle($idRutina);

      echo json_encode($info);
    
    } else if($accion == 4){      
      
      $catalogosClass = new catalogos();

      $idClase = $_POST['idClase'];
      $info     = $catalogosClass->getClasificacion($idClase);

      $infoArray = array('<option value="-1">--Clasificación--</option>');

      foreach($info as $item){
        $infoArray[] = '<option value="'.$item["Id_Clasificacion"].'">'.$item["Desc_Clasificacion"].'</option>';
      }

      echo json_encode($infoArray);
    
    } else if($accion == 5){      
      
      $catalogosClass = new catalogos();

      $idFamilia = $_POST['idFamilia'];
      $info     = $catalogosClass->getSubFamilia($idFamilia);

      $infoArray = array('<option value="-1">--SUBFAMILIA--</option>');

      foreach($info as $item){
        $infoArray[] = '<option value="'.$item["Id_Subfamilia"].'">'.$item["Desc_Subfamilia"].'</option>';
      }

      echo json_encode($infoArray);
    } else if($accion == 6){      
      
      $catalogosClass = new catalogos();

      $Id_area = $_POST['Id_area'];
      $info     = $catalogosClass->getUbiPrimaria($Id_area);

      $infoArray = array('<option value="-1" disabled>-- Ubi Primaria --</option>');

      foreach($info as $item){
        $infoArray[] = '<option value="'.$item["Id_Ubic_Prim"].'">'.$item["Desc_Ubic_Prim"].'</option>';
      }

      echo json_encode($infoArray);
    } else if ($accion == 7){      
      
      $catalogosClass = new catalogos();

      $Id_Ubic_Prim = $_POST['Id_Ubic_Prim'];
      $info     = $catalogosClass->getUbiSecundaria($Id_Ubic_Prim);

      $infoArray = array('<option value="-1" disabled selected>-- Ubi Secundaria --</option>');

      foreach($info as $item){
        $infoArray[] = '<option value="'.$item["Id_Ubic_Sec"].'">'.$item["Desc_Ubic_Sec"].'</option>';
      }

      echo json_encode($infoArray);

    } else if ($accion == 8){      
      
      $catalogosClass = new catalogos();

      $Id_area = $_POST['Id_area'];
      $info     = $catalogosClass->getActivos($Id_area);

      $infoArray = array('<option value="-1" disabled>-- Activos Vigentes --</option>');

      foreach($info as $item){
        $infoArray[] = '<option value="'.$item["id_activo"].'">'.trim($item["AF_BC"]).'-'.trim($item["Nombre_Activo"]).'</option>';
      }

    echo json_encode($infoArray);
    
  } else if ($accion == 9){      
      
      $catalogosClass = new catalogos();

      $Id_area  = $_POST['Id_area'];
      $info     = $catalogosClass->getAnioActividades($Id_area);

      $infoArray = array('<option value="-1" disabled>-- Años Vigentes --</option>');

      foreach($info as $item){
        $infoArray[] = '<option value="'.$item.'">'.trim($item).'</option>';
      }
      echo json_encode($infoArray);
  } else if ($accion == 10){
      
      $catalogosClass = new catalogos();
      
      $info  = $catalogosClass->getMes();

      $infoArray = array('<option value="-1" disabled>-- Meses Vigentes --</option>');

      foreach($info as $item){
        $infoArray[] = '<option value="'.$item['Id_Meses'].'">'.trim($item['Desc_Meses']).'</option>';
      }
      echo json_encode($infoArray);
  }
} else {
  echo json_encode('Error ajax Catalogos');
}