<?php
include_once(dirname(__FILE__)."/../controladores/activos/siga_activos/Siga_activosController.Class.php");
require_once('PHPExcel-1.8/classes/PHPExcel.php');

// Aquí deberías obtener los datos igual que en tu función generarPoliza
// Por ejemplo, puedes recibir las fechas por POST o GET:
$fechainicio = $_POST['fechainicio'] ?? '';
$fechafin = $_POST['fechafin'] ?? '';

$fechainicio_titulo = str_replace('/', '-', $fechainicio);
$fechafin_titulo = str_replace('/', '-', $fechafin);
$siga_ActivosController = new Siga_activosController();
$getpoliza=$siga_ActivosController->generapoliza($fechainicio, $fechafin, null);



$datos = isset($getpoliza['data']) ? $getpoliza['data'] : [];
$consolidado = isset($getpoliza['consolidado']) ? $getpoliza['consolidado'] : [];
// Crear objeto PHPExcel
$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);
$sheet = $objPHPExcel->getActiveSheet();

// Asigna el nombre de la hoja
$sheet->setTitle('Póliza '.$fechainicio_titulo.' a '.$fechafin_titulo);
// Encabezados
$headers = [
    "Área Gestora", "Unidad", "Unidad (Establecimiento)", "Ubicación Primaria", "Ubicación Secundaria", "Propiedad", "No. Inventario", "Descripción Equipo",  "Marca",
    "Modelo", "No. Serie",  "Fecha Alta", "Importe", "Estatus/Actualización"
];
$col = 0;
foreach ($headers as $header) {
    $sheet->setCellValueByColumnAndRow($col, 1, $header);
    // Poner en negritas
    $sheet->getStyleByColumnAndRow($col, 1)->getFont()->setBold(true);
    // Hacer la columna más ancha
    $sheet->getColumnDimensionByColumn($col)->setWidth(22);
    $col++;
}

// Datos
$row = 2;
foreach ($datos as $item) {
    $col = 0;
    // De la A a la J (columnas 0 a 9) como texto
    $sheet->setCellValueExplicitByColumnAndRow($col++, $row, 'Ingeniería Biomédica', PHPExcel_Cell_DataType::TYPE_STRING);
    $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item['Hoja'] ?? '', PHPExcel_Cell_DataType::TYPE_STRING);
    $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item['Unidad'] ?? '', PHPExcel_Cell_DataType::TYPE_STRING);
    $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item['Desc_Ubic_Prim'] ?? '', PHPExcel_Cell_DataType::TYPE_STRING);
    $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item['Desc_Ubic_Sec'] ?? '', PHPExcel_Cell_DataType::TYPE_STRING);
    $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item['Propiedad'] ?? '', PHPExcel_Cell_DataType::TYPE_STRING);
    $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item['AF_BC'] ?? '', PHPExcel_Cell_DataType::TYPE_STRING);
    $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item['Nombre_Activo'] ?? '', PHPExcel_Cell_DataType::TYPE_STRING);
    $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item['Marca'] ?? '', PHPExcel_Cell_DataType::TYPE_STRING);
    $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item['Modelo'] ?? '', PHPExcel_Cell_DataType::TYPE_STRING);
    $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item['NumSerie'] ?? '', PHPExcel_Cell_DataType::TYPE_STRING);
    $sheet->setCellValueByColumnAndRow($col++, $row, $item['Fech_Inserddmmaaaa'] ?? '');
    // Importe como moneda MXN con 2 decimales
    $importe = isset($item['ImporteSeguros']) ? str_replace(['$', ','], '', $item['ImporteSeguros']) : '';
    $sheet->setCellValueExplicitByColumnAndRow($col, $row, $importe, PHPExcel_Cell_DataType::TYPE_NUMERIC);
    $sheet->getStyleByColumnAndRow($col, $row)
        ->getNumberFormat()
        ->setFormatCode('"$"#,##0.00;[Red]\-"$"#,##0.00');
    $col++;
    
    $estatus = trim(($item['Baja_Activo'] ?? '') . ' ' . ($item['Alta_Activo'] ?? ''));
    $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $estatus, PHPExcel_Cell_DataType::TYPE_STRING);
    // Si es Baja, pinta la fila de rojo claro
    if (isset($item['Baja_Activo']) && strtolower(trim($item['Baja_Activo'])) == 'baja') {
        // De la columna 0 a la última (11)
        for ($c = 0; $c <= 13; $c++) {
            $sheet->getStyleByColumnAndRow($c, $row)->applyFromArray([
                'fill' => [
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => ['rgb' => 'FF9999'] // Rojo claro
                ]
            ]);
        }
    }

    // Si es Alta, pinta la fila de verde claro
    if (isset($item['Alta_Activo']) && strtolower(trim($item['Alta_Activo'])) == 'alta') {
        // De la columna 0 a la última (11)
        for ($c = 0; $c <= 13; $c++) {
            $sheet->getStyleByColumnAndRow($c, $row)->applyFromArray([
                'fill' => [
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => ['rgb' => 'CCFFCC'] // Verde claro
                ]
            ]);
        }
    }
    $row++;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Hoja 2
// Crear segunda hoja para el consolidado


$sheet2 = $objPHPExcel->createSheet();
$sheet2->setTitle('Total Bio');

// Fila 1 combinada
$sheet2->mergeCells('B1:C1');
$sheet2->setCellValue('B1', 'EQUIPO NO PROPIO');
$sheet2->getStyle('B1')->getFont()->setBold(true);
$sheet2->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
// Color de fondo azul
$sheet2->getStyle('B1')->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()->setRGB('0070C0'); // Azul tipo Office
// Texto en blanco para contraste
$sheet2->getStyle('B1')->getFont()->getColor()->setRGB('FFFFFF');

$sheet2->getStyle('B1:C1')->applyFromArray([
    'borders' => [
        'allborders' => [
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ]
]);


$sheet2->mergeCells('B2:C2');
$sheet2->setCellValue('B2', 'CORPORATIVO HOSPITAL SATELITE (HS)');
$sheet2->getStyle('B2')->getFont()->setBold(true);
$sheet2->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet2->getStyle('B2:C2')->applyFromArray([
    'borders' => [
        'allborders' => [
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ]
]);


$sheet2->setCellValue('B3', 'TIPO DE CONTRATO');
$sheet2->setCellValue('C3', 'VALOR DE REPOSICIÓN');
$sheet2->getStyle('B3:C3')->getFont()->setBold(true);
$sheet2->getStyle('B3:C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
// Color de fondo azul
$sheet2->getStyle('B3:C3')->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()->setRGB('ACB9CA'); // Gris tipo Office
$sheet2->getStyle('B3:C3')->applyFromArray([
    'borders' => [
        'allborders' => [
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ]
]);

$sheet2->setCellValue('B4', 'RENTA');
$sheet2->setCellValue('C4', $consolidado['rentaHS']);
$sheet2->setCellValue('B5', 'COMODATO');
$sheet2->setCellValue('C5', $consolidado['comodatoHS']);
$sheet2->setCellValue('B6', 'SISTEMA INTEGRAL');
$sheet2->setCellValue('C6', $consolidado['sistemaIntegralHS']);
$sheet2->setCellValue('B7', 'VALOR TOTAL DE REPOSICION ANTES DE IVA');
$sheet2->setCellValue('C7', $consolidado['valorTotalHS']);
$sheet2->getStyle('B7:C7')->getFont()->setBold(true);
$sheet2->getStyle('B4:C7')->applyFromArray([
    'borders' => [
        'allborders' => [
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ]
]);
$sheet2->getStyle('C4:C7')
    ->getNumberFormat()
    ->setFormatCode('"$"#,##0.00;[Red]\-"$"#,##0.00');
// Tamaño de letra más pequeño
$sheet2->getStyle('B4:C6')->getFont()->setSize(10);

$sheet2->mergeCells('B8:C8');
$sheet2->setCellValue('B8', 'CENTRO ESPECIALIZADO HEMODIÁLISIS (CEH)');
$sheet2->getStyle('B8')->getFont()->setBold(true);
$sheet2->getStyle('B8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet2->getStyle('B8:C8')->applyFromArray([
    'borders' => [
        'allborders' => [
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ]
]);

$sheet2->setCellValue('B9', 'TIPO DE CONTRATO');
$sheet2->setCellValue('C9', 'VALOR DE REPOSICIÓN');
$sheet2->getStyle('B9:C9')->getFont()->setBold(true);
$sheet2->getStyle('B9:C9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
// Color de fondo azul
$sheet2->getStyle('B9:C9')->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()->setRGB('ACB9CA'); // Gris tipo Office
$sheet2->getStyle('B9:C9')->applyFromArray([
    'borders' => [
        'allborders' => [
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ]
]);
$sheet2->setCellValue('B10', 'COMODATO - RENTA');
$sheet2->setCellValue('C10', $consolidado['comodatorentaCEH']);
$sheet2->setCellValue('B11', 'VALOR TOTAL DE REPOSICION ANTES DE IVA');
$sheet2->setCellValue('C11', $consolidado['valorTotalCEH']);
$sheet2->getStyle('B11:C11')->getFont()->setBold(true);
$sheet2->getStyle('B4:C11')->applyFromArray([
    'borders' => [
        'allborders' => [
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ]
]);
$sheet2->getStyle('C10:C11')
    ->getNumberFormat()
    ->setFormatCode('"$"#,##0.00;[Red]\-"$"#,##0.00');
// Tamaño de letra más pequeño
$sheet2->getStyle('B10:C10')->getFont()->setSize(10);
$sheet2->getStyle('B10:C11')->applyFromArray([
    'borders' => [
        'allborders' => [
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ]
]);

$sheet2->mergeCells('B12:C12');
$sheet2->setCellValue('B12', 'CENTRO INTEGRAL RENAL (CIR)');
$sheet2->getStyle('B12')->getFont()->setBold(true);
$sheet2->getStyle('B12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet2->getStyle('B12:C12')->applyFromArray([
    'borders' => [
        'allborders' => [
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ]
]);

$sheet2->setCellValue('B13', 'TIPO DE CONTRATO');
$sheet2->setCellValue('C13', 'VALOR DE REPOSICIÓN');
$sheet2->getStyle('B13:C13')->getFont()->setBold(true);
$sheet2->getStyle('B13:C13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
// Color de fondo azul
$sheet2->getStyle('B13:C13')->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()->setRGB('ACB9CA'); // Gris tipo Office
$sheet2->getStyle('B13:C13')->applyFromArray([
    'borders' => [
        'allborders' => [
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ]
]);

$sheet2->setCellValue('B14', 'COMODATO - RENTA');
$sheet2->setCellValue('C14', $consolidado['comodatorentaCIR']);
$sheet2->setCellValue('B15', 'VALOR TOTAL DE REPOSICION ANTES DE IVA');
$sheet2->setCellValue('C15', $consolidado['valorTotalCIR']);
$sheet2->getStyle('B15:C15')->getFont()->setBold(true);
$sheet2->getStyle('B4:C15')->applyFromArray([
    'borders' => [
        'allborders' => [
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ]
]);
$sheet2->getStyle('C14:C15')
    ->getNumberFormat()
    ->setFormatCode('"$"#,##0.00;[Red]\-"$"#,##0.00');
// Tamaño de letra más pequeño
$sheet2->getStyle('B14:C14')->getFont()->setSize(10);
$sheet2->getStyle('B14:C15')->applyFromArray([
    'borders' => [
        'allborders' => [
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ]
]);


$sheet2->mergeCells('B16:C16');
$sheet2->setCellValue('B16', 'CENTRO MÉDICO ESMERALDA (CME)');
$sheet2->getStyle('B16')->getFont()->setBold(true);
$sheet2->getStyle('B16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet2->getStyle('B16:C16')->applyFromArray([
    'borders' => [
        'allborders' => [
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ]
]);

$sheet2->setCellValue('B17', 'TIPO DE CONTRATO');
$sheet2->setCellValue('C17', 'VALOR DE REPOSICIÓN');
$sheet2->getStyle('B17:C17')->getFont()->setBold(true);
$sheet2->getStyle('B17:C17')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
// Color de fondo azul
$sheet2->getStyle('B17:C17')->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()->setRGB('ACB9CA'); // Gris tipo Office
$sheet2->getStyle('B17:C17')->applyFromArray([
    'borders' => [
        'allborders' => [
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ]
]);

$sheet2->setCellValue('B18', 'COMODATO');
$sheet2->setCellValue('C18', $consolidado['comodatoCME']);
$sheet2->setCellValue('B19', 'RENTA');
$sheet2->setCellValue('C19', $consolidado['rentaCME']);
$sheet2->setCellValue('B20', 'VALOR TOTAL DE REPOSICION ANTES DE IVA');
$sheet2->setCellValue('C20', $consolidado['valorTotalCME']);
$sheet2->getStyle('B20:C20')->getFont()->setBold(true);
$sheet2->getStyle('B4:C20')->applyFromArray([
    'borders' => [
        'allborders' => [
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ]
]);
$sheet2->getStyle('C18:C20')
    ->getNumberFormat()
    ->setFormatCode('"$"#,##0.00;[Red]\-"$"#,##0.00');
// Tamaño de letra más pequeño
$sheet2->getStyle('B18:C19')->getFont()->setSize(10);
$sheet2->getStyle('B18:C20')->applyFromArray([
    'borders' => [
        'allborders' => [
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ]
]);

$sheet2->setCellValue('B21', 'TOTAL EQUIPO NO PROPIO (SIN IVA)');
$sheet2->setCellValue('C21', $consolidado['TotalNoPropio']);
$sheet2->getStyle('B21:C21')->getFont()->setBold(true);
$sheet2->getStyle('B21:C21')->applyFromArray([
    'borders' => [
        'allborders' => [
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ]
]);
$sheet2->getStyle('C21')
    ->getNumberFormat()
    ->setFormatCode('"$"#,##0.00;[Red]\-"$"#,##0.00');
// Tamaño de letra más pequeño
$sheet2->getStyle('B21:C21')->getFont()->setSize(15);

$totalEquiProp=count($consolidado['equiposMedPropConsolidado']);
$rowStart = 25+$totalEquiProp;
if($totalEquiProp>0){
    $sheet2->mergeCells('B23:C23');
    $sheet2->setCellValue('B23', 'EQUIPO MÉDICO PROPIO');
    $sheet2->getStyle('B23')->getFont()->setBold(true);
    $sheet2->getStyle('B23')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    // Color de fondo azul
    $sheet2->getStyle('B23')->getFill()
        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()->setRGB('0070C0'); // Azul tipo Office
    // Texto en blanco para contraste
    $sheet2->getStyle('B23')->getFont()->getColor()->setRGB('FFFFFF');

    $sheet2->getStyle('B23:C23')->applyFromArray([
        'borders' => [
            'allborders' => [
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => ['rgb' => '000000']
            ]
        ]
    ]);

    $sheet2->setCellValue('B24', 'SUCURSAL');
    $sheet2->setCellValue('C24', 'VALOR DE REPOSICIÓN');
    $sheet2->getStyle('B24:C24')->getFont()->setBold(true);
    $sheet2->getStyle('B24:C24')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    // Color de fondo azul
    $sheet2->getStyle('B24:C24')->getFill()
        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()->setRGB('ACB9CA'); // Gris tipo Office
    $sheet2->getStyle('B24:C24')->applyFromArray([
        'borders' => [
            'allborders' => [
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => ['rgb' => '000000']
            ]
        ]
    ]);


    for($i=0;$i<$totalEquiProp;$i++){
        $sheet2->setCellValue('B'.(25+$i), $consolidado['equiposMedPropConsolidado'][$i]['unidad']);
        $sheet2->setCellValue('C'.(25+$i), $consolidado['equiposMedPropConsolidado'][$i]['importe']);
        $sheet2->getStyle('C'.(25+$i))
            ->getNumberFormat()
            ->setFormatCode('"$"#,##0.00;[Red]\-"$"#,##0.00');
        $sheet2->getStyle('B'.(25+$i).':C'.(25+$i))->applyFromArray([
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['rgb' => '000000']
                ]
            ]
        ]);
    }
    $sheet2->getStyle('B25:C'.(25+$totalEquiProp))->getFont()->setSize(10);

    $sheet2->setCellValue('B'.($rowStart), 'VALOR TOTAL DE REPOSICION ANTES DE IVA');
    $sheet2->setCellValue('C'.$rowStart, $consolidado['TotalPropio']);
    $sheet2->getStyle('B'.$rowStart.':C'.$rowStart)->getFont()->setBold(true);
    $sheet2->getStyle('B'.$rowStart.':C'.$rowStart)->applyFromArray([
        'borders' => [
            'allborders' => [
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => ['rgb' => '000000']
            ]
        ]
    ]);
    $sheet2->getStyle('C'.$rowStart)
        ->getNumberFormat()
        ->setFormatCode('"$"#,##0.00;[Red]\-"$"#,##0.00');
    // Tamaño de letra más pequeño
    $sheet2->getStyle('B'.$rowStart.':C'.$rowStart)->getFont()->setSize(15);
}

$rowTotalGeneral = $rowStart + 3;
$sheet2->setCellValue('B'.$rowTotalGeneral, 'GRAN TOTAL (SIN IVA)');
$sheet2->setCellValue('C'.$rowTotalGeneral, $consolidado['TotalGeneral']);
$sheet2->getStyle('B'.$rowTotalGeneral.':C'.$rowTotalGeneral)->getFont()->setBold(true);
$sheet2->getStyle('B'.$rowTotalGeneral.':C'.$rowTotalGeneral)->applyFromArray([
    'borders' => [
        'allborders' => [
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ]
]);
$sheet2->getStyle('C'.$rowTotalGeneral)
    ->getNumberFormat()
    ->setFormatCode('"$"#,##0.00;[Red]\-"$"#,##0.00');
// Tamaño de letra más pequeño
$sheet2->getStyle('B'.$rowTotalGeneral.':C'.$rowTotalGeneral)->getFont()->setSize(20);


// Anchos
$sheet2->getColumnDimension('B')->setWidth(62);
$sheet2->getColumnDimension('C')->setWidth(62);




// Establece encabezados para descarga
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="poliza_del_periodo_'.$fechainicio_titulo.'_a_'.$fechafin_titulo.'.xlsx"');
header('Cache-Control: max-age=0');

// Guarda el archivo en la salida
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>