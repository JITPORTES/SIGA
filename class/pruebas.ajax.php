<?php

  include_once($_SERVER["DOCUMENT_ROOT"]."/siga/plugins/verot/class.upload.php");
  use Verot\Upload\Upload;

if(isset($_POST['accion']) && 
$_POST['accion'] !=='') {


$accion = $_POST['accion'];

if($accion ==1){
  
  $file   = $_FILES['miImagen'];
  $nombre = $_FILES['miImagen']['name'];

  $foo = new Upload($file);

  $url = $_SERVER["DOCUMENT_ROOT"].'/siga/Archivos/pruebas/';
  $id = $nombre;
  $foo->file_new_name_body  = sprintf($id, $size_x, time());
  $foo->image_resize        = true;
  $foo->image_x             = 1260;
  $foo->image_y             = 1260;
  $foo->image_ratio         = true;

    $foo->process($url);
      if($foo->processed){
        $resultado='if redimencion';
      }else{
        $resultado='else redimencion: '.$foo->error;
      }

  echo json_encode('ok: 1'.$resultado);
}


}

