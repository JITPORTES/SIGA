<?php

if(isset($_POST['Id_Area']) && $_POST['Id_Area'] !==''){

include_once(dirname(__FILE__)."/../../cx.php");


    $Id_Area            = $_POST['Id_Area'];
    $Nombre_Ejecutante  = trim(strtoupper(strtolower($_POST['Nombre_Ejecutante'])));

    $ticket_reasignacion_ejecutante="
    SELECT  Id_Ejecutante,
            Nombre_Completo
    FROM    siga_cat_ejecutantes
    WHERE   Id_Area=$Id_Area
    AND     Estatus_Reg <> 3
    ORDER BY Nombre_Completo
    ";

    $ticket_reasignacion_ejecutante_qry=$pdoConexion->query($ticket_reasignacion_ejecutante);
    $ticket_reasignacion_ejecutante_res=$ticket_reasignacion_ejecutante_qry->fetchAll(PDO::FETCH_NAMED);

    $ticket_reasignacion_ejecutante_array=["<option disabled selected>Ejecutante</option>"];

    foreach($ticket_reasignacion_ejecutante_res as $item){
        $ejecutante = trim(strtoupper(strtolower($item['Nombre_Completo'])));
        if(strcmp($ejecutante, $Nombre_Ejecutante) === 0){
          $selected = 'selected';
        }else{
          $selected = '';
        }
        $ticket_reasignacion_ejecutante_array[]="<option value='".$item['Nombre_Completo']."' ".$selected.">".trim($item['Nombre_Completo'])."</option>";
    }       

    $pdoConexion=null;

echo json_encode($ticket_reasignacion_ejecutante_array);

 } else {
    echo json_encode('Error: no se puede hacer consulta ajax.');
 }

?>