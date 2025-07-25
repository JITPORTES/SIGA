<?php

include_once(dirname(__FILE__)."/../../cx.php");

if(isset($_POST['accion']) && 
$_POST['accion'] !=='') {

$accion = $_POST['accion'];

if($accion == 1){

$accesorios_assist="
SELECT 
        inviar.art,
        inviar.des1
FROM    inviar
LEFT JOIN invart ON inviar.art=invart.art
WHERE   invart.alm='BIO'
AND     inviar.status=00
AND     inviar.lin != 'SER'
AND     invart.status=00
";

$accesorios_assist_qry=$pdoConexionAssit->query($accesorios_assist);
$accesorios_assist_res=$accesorios_assist_qry->fetchAll(PDO::FETCH_NAMED);

$accesorios_assist_array=["<option disabled selected value=''> Seleccionar Material Disponible </option>"];

for ($i=0; $i < count($accesorios_assist_res) ; $i++) { 
    $accesorios_assist_array[]="<option value='".trim($accesorios_assist_res[$i]['art'])."'>".trim($accesorios_assist_res[$i]['des1']).' - ('.trim($accesorios_assist_res[$i]['art'],'0').')'."</option>";
}

$pdoConexionAssit=null;

echo json_encode($accesorios_assist_array);

} else if ($accion == 2){

    $accesorios_assist="
    SELECT  inviar.art,
            inviar.des1,
            inviar.cod_barras,
            REPLACE(LTRIM(REPLACE(inviar.art,'0',' ')),' ','0') as sku_vista,
            inviar.s_lin,
            inviar.marca,
            invart.localizacion,
            invart.uds_sal,
            invart.Existencia,
            inviar.uds_min,
            invart.cto_prom
    FROM    inviar
    LEFT JOIN invart ON inviar.art=invart.art
    WHERE   inviar.art='$sku_id'
    AND     invart.alm='BIO'
    AND     inviar.status=00
    AND     inviar.lin != 'SER'
    AND     invart.status=00
    ";
    
    $accesorios_assist_qry=$pdoConexionAssit->query($accesorios_assist);
    $accesorios_assist_res=$accesorios_assist_qry->fetchAll(PDO::FETCH_NAMED);
    
    $pdoConexionAssit=null;
    
    echo json_encode($accesorios_assist_res);




    echo json_encode($accion);
}

} else {

    echo json_encode('Error');
}