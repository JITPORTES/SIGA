<?php
include_once "reporteCategoriaGestor.class.php";

if(isset($_POST['accion']) && $_POST['accion'] !==''){

$accion =$_POST['accion'];

if($accion == 1){

    
    echo json_encode('');
} else {
    echo json_encode('Error en ajax: reporteCategoriaGestor');
}

}