<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/connect/conectar.class.php");
class util extends conectar{

  function ok(){
    return 'ok';
  }

  public function nombreAleatorio(){

    $caracteres_permitidos = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $longitud = 30;
    $ramdom = substr(str_shuffle($caracteres_permitidos), 0, $longitud);

    return $ramdom;
  }

  public function encriptar($id){
		$id = 'miIdSigaCHS='.$id;
		$pass = '%%&/Sic#CHS%Mx?2023#$%%&/%%Mx?2023#$%%&/%#CHS%Mx#CHS%Mx?2023';
		$method = 'AES-256-CFB';
		$idDesencriptado = openssl_encrypt($id, $method, $pass);
	return $idDesencriptado;
}

public function desencriptar($id){
		$pass = '%%&/Sic#CHS%Mx?2023#$%%&/%%Mx?2023#$%%&/%#CHS%Mx#CHS%Mx?2023';
		$method = 'AES-256-CFB';
		$idDesencriptado = openssl_decrypt($id, $method, $pass);
		$dato = str_replace('miIdSigaCHS=','',$idDesencriptado);
	return $dato;
}

public function fnlog($error){
		$ruta=dirname(__FILE__,4);
		$file = fopen($ruta."/logs/siga_log.txt", "a");
		
    $date=date("Y-m-d H:i:s");
		  fwrite($file, "($date) SIGA: $error " . PHP_EOL);
		  fclose($file);
    return $ruta;
	}

public function rutaRaiz(){
	
	$ruta = dirname(__FILE__,4);

	return $ruta;
}


}