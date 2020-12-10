<?php
    ob_start();

    require '../class/function/curl_api.php';
    require '../vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\Settings;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;

    if (isset($_GET['cod05'])) {
        $parm05 = $_GET['cod05'];
    } else {
        $parm05 = 0;
    }

    if (isset($_GET['cod06'])) {
        $parm06 = $_GET['cod06'];
    } else {
        $parm06 = 0;
    }

    if (isset($_GET['cod07'])) {
        $parm07 = $_GET['cod07'];
    } else {
        $parm07 = 0;
    }

    if (isset($_GET['cod08'])) {
        $parm08 = $_GET['cod08'];
    } else {
        $parm08 = 0;
    }

    $dataJSON   = get_curl('200/tarjetapersonal/listado');
    $fileName   = "planilla_comprobantes_".date('YmdHis').".xls";
    $sheetXLS   = new Spreadsheet();

    // Set document properties
    $sheetXLS->getProperties()
        ->setCreator('MSc. Christian Zelaya')
        ->setLastModifiedBy('MSc. Christian Zelaya')
        ->setTitle('CONMEBOL - Sistema Permiso export XLS')
        ->setSubject('CONMEBOL - Sistema Permiso export XLS')
        ->setDescription('CONMEBOL - Sistema Permiso')
        ->setKeywords('CONMEBOL - Sistema Permiso export XLS')
        ->setCategory('CONMEBOL - Sistema Permiso export XLS');

    $sheetXLS->setActiveSheetIndex(0)
        ->setCellValue('A1', 'tipo_gerencia_codigo')
        ->setCellValue('B1', 'tipo_gerencia_nombre')
        ->setCellValue('C1', 'tipo_departamento_codigo')
        ->setCellValue('D1', 'tipo_departamento_nombre')
        ->setCellValue('E1', 'tipo_cargo_codigo')
        ->setCellValue('F1', 'tipo_cargo_nombre') 
        ->setCellValue('G1', 'tarjeta_personal_documento') 
        ->setCellValue('H1', 'tarjeta_personal_nombre') 
        ->setCellValue('I1', 'tarjeta_personal_email') 
        ->setCellValue('J1', 'tipo_cantidad_castellano')
        ->setCellValue('K1', 'tipo_estado_codigo')
        ->setCellValue('L1', 'tipo_estado_castellano');
        
    if ($dataJSON['code'] === 200) {
        $indexRow = 2;

        foreach ($dataJSON['data'] as $dataKEY => $valueJSON){
            if($parm05 == 0){
                if($parm06 == 0){
                    if($parm07 == 0){
                        if($parm08 == 0){

                            $sheetXLS->setActiveSheetIndex(0)
                                ->setCellValue('A'.$indexRow, $valueJSON['tipo_gerencia_codigo'])
                                ->setCellValue('B'.$indexRow, $valueJSON['tipo_gerencia_nombre']) 
                                ->setCellValue('C'.$indexRow, $valueJSON['tipo_departamento_codigo'])
                                ->setCellValue('D'.$indexRow, $valueJSON['tipo_departamento_nombre'])
                                ->setCellValue('E'.$indexRow, $valueJSON['tipo_cargo_codigo'])
                                ->setCellValue('F'.$indexRow, $valueJSON['tipo_cargo_nombre'])
                                ->setCellValue('G'.$indexRow, $valueJSON['tarjeta_personal_documento'])
                                ->setCellValue('H'.$indexRow, $valueJSON['tarjeta_personal_nombre'])
                                ->setCellValue('I'.$indexRow, $valueJSON['tarjeta_personal_email'])
                                ->setCellValue('J'.$indexRow, $valueJSON['tipo_cantidad_castellano'])
                                ->setCellValue('K'.$indexRow, $valueJSON['tipo_estado_codigo'])
                                ->setCellValue('L'.$indexRow, $valueJSON['tipo_estado_castellano']);

                            $indexRow = $indexRow + 1;

                        }elseif ($valueJSON['tipo_estado_codigo'] == $parm08){

                            $sheetXLS->setActiveSheetIndex(0)
                                ->setCellValue('A'.$indexRow, $valueJSON['tipo_gerencia_codigo'])
                                ->setCellValue('B'.$indexRow, $valueJSON['tipo_gerencia_nombre']) 
                                ->setCellValue('C'.$indexRow, $valueJSON['tipo_departamento_codigo'])
                                ->setCellValue('D'.$indexRow, $valueJSON['tipo_departamento_nombre'])
                                ->setCellValue('E'.$indexRow, $valueJSON['tipo_cargo_codigo'])
                                ->setCellValue('F'.$indexRow, $valueJSON['tipo_cargo_nombre'])
                                ->setCellValue('G'.$indexRow, $valueJSON['tarjeta_personal_documento'])
                                ->setCellValue('H'.$indexRow, $valueJSON['tarjeta_personal_nombre'])
                                ->setCellValue('I'.$indexRow, $valueJSON['tarjeta_personal_email'])
                                ->setCellValue('J'.$indexRow, $valueJSON['tipo_cantidad_castellano'])
                                ->setCellValue('K'.$indexRow, $valueJSON['tipo_estado_codigo'])
                                ->setCellValue('L'.$indexRow, $valueJSON['tipo_estado_castellano']);

                            $indexRow = $indexRow + 1;
                                
                        }
                    }else if ($valueJSON['tarjeta_personal_documento'] == $parm07){
                        if($parm08 == 0){

                            $sheetXLS->setActiveSheetIndex(0)
                                ->setCellValue('A'.$indexRow, $valueJSON['tipo_gerencia_codigo'])
                                ->setCellValue('B'.$indexRow, $valueJSON['tipo_gerencia_nombre']) 
                                ->setCellValue('C'.$indexRow, $valueJSON['tipo_departamento_codigo'])
                                ->setCellValue('D'.$indexRow, $valueJSON['tipo_departamento_nombre'])
                                ->setCellValue('E'.$indexRow, $valueJSON['tipo_cargo_codigo'])
                                ->setCellValue('F'.$indexRow, $valueJSON['tipo_cargo_nombre'])
                                ->setCellValue('G'.$indexRow, $valueJSON['tarjeta_personal_documento'])
                                ->setCellValue('H'.$indexRow, $valueJSON['tarjeta_personal_nombre'])
                                ->setCellValue('I'.$indexRow, $valueJSON['tarjeta_personal_email'])
                                ->setCellValue('J'.$indexRow, $valueJSON['tipo_cantidad_castellano'])
                                ->setCellValue('K'.$indexRow, $valueJSON['tipo_estado_codigo'])
                                ->setCellValue('L'.$indexRow, $valueJSON['tipo_estado_castellano']);

                            $indexRow = $indexRow + 1;
                               
                        }else if ($valueJSON['tipo_estado_codigo'] == $parm08){

                            $sheetXLS->setActiveSheetIndex(0)
                                ->setCellValue('A'.$indexRow, $valueJSON['tipo_gerencia_codigo'])
                                ->setCellValue('B'.$indexRow, $valueJSON['tipo_gerencia_nombre']) 
                                ->setCellValue('C'.$indexRow, $valueJSON['tipo_departamento_codigo'])
                                ->setCellValue('D'.$indexRow, $valueJSON['tipo_departamento_nombre'])
                                ->setCellValue('E'.$indexRow, $valueJSON['tipo_cargo_codigo'])
                                ->setCellValue('F'.$indexRow, $valueJSON['tipo_cargo_nombre'])
                                ->setCellValue('G'.$indexRow, $valueJSON['tarjeta_personal_documento'])
                                ->setCellValue('H'.$indexRow, $valueJSON['tarjeta_personal_nombre'])
                                ->setCellValue('I'.$indexRow, $valueJSON['tarjeta_personal_email'])
                                ->setCellValue('J'.$indexRow, $valueJSON['tipo_cantidad_castellano'])
                                ->setCellValue('K'.$indexRow, $valueJSON['tipo_estado_codigo'])
                                ->setCellValue('L'.$indexRow, $valueJSON['tipo_estado_castellano']);

                            $indexRow = $indexRow + 1;

                                
                        }
                    }
                }else if ($valueJSON['tipo_departamento_codigo'] == $parm06){
                    if($parm07 == 0){
                        if($parm08 == 0){

                            $sheetXLS->setActiveSheetIndex(0)
                                ->setCellValue('A'.$indexRow, $valueJSON['tipo_gerencia_codigo'])
                                ->setCellValue('B'.$indexRow, $valueJSON['tipo_gerencia_nombre']) 
                                ->setCellValue('C'.$indexRow, $valueJSON['tipo_departamento_codigo'])
                                ->setCellValue('D'.$indexRow, $valueJSON['tipo_departamento_nombre'])
                                ->setCellValue('E'.$indexRow, $valueJSON['tipo_cargo_codigo'])
                                ->setCellValue('F'.$indexRow, $valueJSON['tipo_cargo_nombre'])
                                ->setCellValue('G'.$indexRow, $valueJSON['tarjeta_personal_documento'])
                                ->setCellValue('H'.$indexRow, $valueJSON['tarjeta_personal_nombre'])
                                ->setCellValue('I'.$indexRow, $valueJSON['tarjeta_personal_email'])
                                ->setCellValue('J'.$indexRow, $valueJSON['tipo_cantidad_castellano'])
                                ->setCellValue('K'.$indexRow, $valueJSON['tipo_estado_codigo'])
                                ->setCellValue('L'.$indexRow, $valueJSON['tipo_estado_castellano']);

                            $indexRow = $indexRow + 1;

                        }else if ($valueJSON['tipo_estado_codigo'] == $parm08){

                            $sheetXLS->setActiveSheetIndex(0)
                                ->setCellValue('A'.$indexRow, $valueJSON['tipo_gerencia_codigo'])
                                ->setCellValue('B'.$indexRow, $valueJSON['tipo_gerencia_nombre']) 
                                ->setCellValue('C'.$indexRow, $valueJSON['tipo_departamento_codigo'])
                                ->setCellValue('D'.$indexRow, $valueJSON['tipo_departamento_nombre'])
                                ->setCellValue('E'.$indexRow, $valueJSON['tipo_cargo_codigo'])
                                ->setCellValue('F'.$indexRow, $valueJSON['tipo_cargo_nombre'])
                                ->setCellValue('G'.$indexRow, $valueJSON['tarjeta_personal_documento'])
                                ->setCellValue('H'.$indexRow, $valueJSON['tarjeta_personal_nombre'])
                                ->setCellValue('I'.$indexRow, $valueJSON['tarjeta_personal_email'])
                                ->setCellValue('J'.$indexRow, $valueJSON['tipo_cantidad_castellano'])
                                ->setCellValue('K'.$indexRow, $valueJSON['tipo_estado_codigo'])
                                ->setCellValue('L'.$indexRow, $valueJSON['tipo_estado_castellano']);

                            $indexRow = $indexRow + 1;
                            
                        }
                    }else if ($valueJSON['tarjeta_personal_documento'] == $parm07){
                        if($parm08 == 0){

                            $sheetXLS->setActiveSheetIndex(0)
                                ->setCellValue('A'.$indexRow, $valueJSON['tipo_gerencia_codigo'])
                                ->setCellValue('B'.$indexRow, $valueJSON['tipo_gerencia_nombre']) 
                                ->setCellValue('C'.$indexRow, $valueJSON['tipo_departamento_codigo'])
                                ->setCellValue('D'.$indexRow, $valueJSON['tipo_departamento_nombre'])
                                ->setCellValue('E'.$indexRow, $valueJSON['tipo_cargo_codigo'])
                                ->setCellValue('F'.$indexRow, $valueJSON['tipo_cargo_nombre'])
                                ->setCellValue('G'.$indexRow, $valueJSON['tarjeta_personal_documento'])
                                ->setCellValue('H'.$indexRow, $valueJSON['tarjeta_personal_nombre'])
                                ->setCellValue('I'.$indexRow, $valueJSON['tarjeta_personal_email'])
                                ->setCellValue('J'.$indexRow, $valueJSON['tipo_cantidad_castellano'])
                                ->setCellValue('K'.$indexRow, $valueJSON['tipo_estado_codigo'])
                                ->setCellValue('L'.$indexRow, $valueJSON['tipo_estado_castellano']);

                            $indexRow = $indexRow + 1;

                        }else if ($valueJSON['tipo_estado_codigo'] == $parm08){

                            $sheetXLS->setActiveSheetIndex(0)
                                ->setCellValue('A'.$indexRow, $valueJSON['tipo_gerencia_codigo'])
                                ->setCellValue('B'.$indexRow, $valueJSON['tipo_gerencia_nombre']) 
                                ->setCellValue('C'.$indexRow, $valueJSON['tipo_departamento_codigo'])
                                ->setCellValue('D'.$indexRow, $valueJSON['tipo_departamento_nombre'])
                                ->setCellValue('E'.$indexRow, $valueJSON['tipo_cargo_codigo'])
                                ->setCellValue('F'.$indexRow, $valueJSON['tipo_cargo_nombre'])
                                ->setCellValue('G'.$indexRow, $valueJSON['tarjeta_personal_documento'])
                                ->setCellValue('H'.$indexRow, $valueJSON['tarjeta_personal_nombre'])
                                ->setCellValue('I'.$indexRow, $valueJSON['tarjeta_personal_email'])
                                ->setCellValue('J'.$indexRow, $valueJSON['tipo_cantidad_castellano'])
                                ->setCellValue('K'.$indexRow, $valueJSON['tipo_estado_codigo'])
                                ->setCellValue('L'.$indexRow, $valueJSON['tipo_estado_castellano']);

                            $indexRow = $indexRow + 1;
                            
                        }
                    }
                }
            }else if ($valueJSON['tipo_gerencia_codigo'] == $parm05){
                if($parm06 == 0){
                    if($parm07 == 0){
                        if($parm08 == 0){

                            $sheetXLS->setActiveSheetIndex(0)
                                ->setCellValue('A'.$indexRow, $valueJSON['tipo_gerencia_codigo'])
                                ->setCellValue('B'.$indexRow, $valueJSON['tipo_gerencia_nombre']) 
                                ->setCellValue('C'.$indexRow, $valueJSON['tipo_departamento_codigo'])
                                ->setCellValue('D'.$indexRow, $valueJSON['tipo_departamento_nombre'])
                                ->setCellValue('E'.$indexRow, $valueJSON['tipo_cargo_codigo'])
                                ->setCellValue('F'.$indexRow, $valueJSON['tipo_cargo_nombre'])
                                ->setCellValue('G'.$indexRow, $valueJSON['tarjeta_personal_documento'])
                                ->setCellValue('H'.$indexRow, $valueJSON['tarjeta_personal_nombre'])
                                ->setCellValue('I'.$indexRow, $valueJSON['tarjeta_personal_email'])
                                ->setCellValue('J'.$indexRow, $valueJSON['tipo_cantidad_castellano'])
                                ->setCellValue('K'.$indexRow, $valueJSON['tipo_estado_codigo'])
                                ->setCellValue('L'.$indexRow, $valueJSON['tipo_estado_castellano']);

                            $indexRow = $indexRow + 1;

                        }else if ($valueJSON['tipo_estado_codigo'] == $parm08){

                            $sheetXLS->setActiveSheetIndex(0)
                                ->setCellValue('A'.$indexRow, $valueJSON['tipo_gerencia_codigo'])
                                ->setCellValue('B'.$indexRow, $valueJSON['tipo_gerencia_nombre']) 
                                ->setCellValue('C'.$indexRow, $valueJSON['tipo_departamento_codigo'])
                                ->setCellValue('D'.$indexRow, $valueJSON['tipo_departamento_nombre'])
                                ->setCellValue('E'.$indexRow, $valueJSON['tipo_cargo_codigo'])
                                ->setCellValue('F'.$indexRow, $valueJSON['tipo_cargo_nombre'])
                                ->setCellValue('G'.$indexRow, $valueJSON['tarjeta_personal_documento'])
                                ->setCellValue('H'.$indexRow, $valueJSON['tarjeta_personal_nombre'])
                                ->setCellValue('I'.$indexRow, $valueJSON['tarjeta_personal_email'])
                                ->setCellValue('J'.$indexRow, $valueJSON['tipo_cantidad_castellano'])
                                ->setCellValue('K'.$indexRow, $valueJSON['tipo_estado_codigo'])
                                ->setCellValue('L'.$indexRow, $valueJSON['tipo_estado_castellano']);

                            $indexRow = $indexRow + 1;

                        }
                    }else if ($valueJSON['tarjeta_personal_documento'] == $parm07){
                        if($parm08 == 0){

                            $sheetXLS->setActiveSheetIndex(0)
                                ->setCellValue('A'.$indexRow, $valueJSON['tipo_gerencia_codigo'])
                                ->setCellValue('B'.$indexRow, $valueJSON['tipo_gerencia_nombre']) 
                                ->setCellValue('C'.$indexRow, $valueJSON['tipo_departamento_codigo'])
                                ->setCellValue('D'.$indexRow, $valueJSON['tipo_departamento_nombre'])
                                ->setCellValue('E'.$indexRow, $valueJSON['tipo_cargo_codigo'])
                                ->setCellValue('F'.$indexRow, $valueJSON['tipo_cargo_nombre'])
                                ->setCellValue('G'.$indexRow, $valueJSON['tarjeta_personal_documento'])
                                ->setCellValue('H'.$indexRow, $valueJSON['tarjeta_personal_nombre'])
                                ->setCellValue('I'.$indexRow, $valueJSON['tarjeta_personal_email'])
                                ->setCellValue('J'.$indexRow, $valueJSON['tipo_cantidad_castellano'])
                                ->setCellValue('K'.$indexRow, $valueJSON['tipo_estado_codigo'])
                                ->setCellValue('L'.$indexRow, $valueJSON['tipo_estado_castellano']);

                            $indexRow = $indexRow + 1;

                        }else if ($valueJSON['tipo_estado_codigo'] == $parm08){

                            $sheetXLS->setActiveSheetIndex(0)
                                ->setCellValue('A'.$indexRow, $valueJSON['tipo_gerencia_codigo'])
                                ->setCellValue('B'.$indexRow, $valueJSON['tipo_gerencia_nombre']) 
                                ->setCellValue('C'.$indexRow, $valueJSON['tipo_departamento_codigo'])
                                ->setCellValue('D'.$indexRow, $valueJSON['tipo_departamento_nombre'])
                                ->setCellValue('E'.$indexRow, $valueJSON['tipo_cargo_codigo'])
                                ->setCellValue('F'.$indexRow, $valueJSON['tipo_cargo_nombre'])
                                ->setCellValue('G'.$indexRow, $valueJSON['tarjeta_personal_documento'])
                                ->setCellValue('H'.$indexRow, $valueJSON['tarjeta_personal_nombre'])
                                ->setCellValue('I'.$indexRow, $valueJSON['tarjeta_personal_email'])
                                ->setCellValue('J'.$indexRow, $valueJSON['tipo_cantidad_castellano'])
                                ->setCellValue('K'.$indexRow, $valueJSON['tipo_estado_codigo'])
                                ->setCellValue('L'.$indexRow, $valueJSON['tipo_estado_castellano']);

                            $indexRow = $indexRow + 1;
                        }
                    }
                }else if ($valueJSON['tipo_departamento_codigo'] == $parm06){
                    if($parm07 == 0){
                        if($parm08 == 0){

                            $sheetXLS->setActiveSheetIndex(0)
                                ->setCellValue('A'.$indexRow, $valueJSON['tipo_gerencia_codigo'])
                                ->setCellValue('B'.$indexRow, $valueJSON['tipo_gerencia_nombre']) 
                                ->setCellValue('C'.$indexRow, $valueJSON['tipo_departamento_codigo'])
                                ->setCellValue('D'.$indexRow, $valueJSON['tipo_departamento_nombre'])
                                ->setCellValue('E'.$indexRow, $valueJSON['tipo_cargo_codigo'])
                                ->setCellValue('F'.$indexRow, $valueJSON['tipo_cargo_nombre'])
                                ->setCellValue('G'.$indexRow, $valueJSON['tarjeta_personal_documento'])
                                ->setCellValue('H'.$indexRow, $valueJSON['tarjeta_personal_nombre'])
                                ->setCellValue('I'.$indexRow, $valueJSON['tarjeta_personal_email'])
                                ->setCellValue('J'.$indexRow, $valueJSON['tipo_cantidad_castellano'])
                                ->setCellValue('K'.$indexRow, $valueJSON['tipo_estado_codigo'])
                                ->setCellValue('L'.$indexRow, $valueJSON['tipo_estado_castellano']);

                            $indexRow = $indexRow + 1;

                        }else if ($valueJSON['tipo_estado_codigo'] == $parm08){

                            $sheetXLS->setActiveSheetIndex(0)
                                ->setCellValue('A'.$indexRow, $valueJSON['tipo_gerencia_codigo'])
                                ->setCellValue('B'.$indexRow, $valueJSON['tipo_gerencia_nombre']) 
                                ->setCellValue('C'.$indexRow, $valueJSON['tipo_departamento_codigo'])
                                ->setCellValue('D'.$indexRow, $valueJSON['tipo_departamento_nombre'])
                                ->setCellValue('E'.$indexRow, $valueJSON['tipo_cargo_codigo'])
                                ->setCellValue('F'.$indexRow, $valueJSON['tipo_cargo_nombre'])
                                ->setCellValue('G'.$indexRow, $valueJSON['tarjeta_personal_documento'])
                                ->setCellValue('H'.$indexRow, $valueJSON['tarjeta_personal_nombre'])
                                ->setCellValue('I'.$indexRow, $valueJSON['tarjeta_personal_email'])
                                ->setCellValue('J'.$indexRow, $valueJSON['tipo_cantidad_castellano'])
                                ->setCellValue('K'.$indexRow, $valueJSON['tipo_estado_codigo'])
                                ->setCellValue('L'.$indexRow, $valueJSON['tipo_estado_castellano']);

                            $indexRow = $indexRow + 1;
                            
                        }
                    }else if ($valueJSON['tarjeta_personal_documento'] == $parm07){
                        if($parm08 == 0){

                            $sheetXLS->setActiveSheetIndex(0)
                                ->setCellValue('A'.$indexRow, $valueJSON['tipo_gerencia_codigo'])
                                ->setCellValue('B'.$indexRow, $valueJSON['tipo_gerencia_nombre']) 
                                ->setCellValue('C'.$indexRow, $valueJSON['tipo_departamento_codigo'])
                                ->setCellValue('D'.$indexRow, $valueJSON['tipo_departamento_nombre'])
                                ->setCellValue('E'.$indexRow, $valueJSON['tipo_cargo_codigo'])
                                ->setCellValue('F'.$indexRow, $valueJSON['tipo_cargo_nombre'])
                                ->setCellValue('G'.$indexRow, $valueJSON['tarjeta_personal_documento'])
                                ->setCellValue('H'.$indexRow, $valueJSON['tarjeta_personal_nombre'])
                                ->setCellValue('I'.$indexRow, $valueJSON['tarjeta_personal_email'])
                                ->setCellValue('J'.$indexRow, $valueJSON['tipo_cantidad_castellano'])
                                ->setCellValue('K'.$indexRow, $valueJSON['tipo_estado_codigo'])
                                ->setCellValue('L'.$indexRow, $valueJSON['tipo_estado_castellano']);

                            $indexRow = $indexRow + 1;

                        }else if ($valueJSON['tipo_estado_codigo'] == $parm08){

                            $sheetXLS->setActiveSheetIndex(0)
                                ->setCellValue('A'.$indexRow, $valueJSON['tipo_gerencia_codigo'])
                                ->setCellValue('B'.$indexRow, $valueJSON['tipo_gerencia_nombre']) 
                                ->setCellValue('C'.$indexRow, $valueJSON['tipo_departamento_codigo'])
                                ->setCellValue('D'.$indexRow, $valueJSON['tipo_departamento_nombre'])
                                ->setCellValue('E'.$indexRow, $valueJSON['tipo_cargo_codigo'])
                                ->setCellValue('F'.$indexRow, $valueJSON['tipo_cargo_nombre'])
                                ->setCellValue('G'.$indexRow, $valueJSON['tarjeta_personal_documento'])
                                ->setCellValue('H'.$indexRow, $valueJSON['tarjeta_personal_nombre'])
                                ->setCellValue('I'.$indexRow, $valueJSON['tarjeta_personal_email'])
                                ->setCellValue('J'.$indexRow, $valueJSON['tipo_cantidad_castellano'])
                                ->setCellValue('K'.$indexRow, $valueJSON['tipo_estado_codigo'])
                                ->setCellValue('L'.$indexRow, $valueJSON['tipo_estado_castellano']);

                            $indexRow = $indexRow + 1;
                            
                        }
                    }
                }
            }
        } 
    }

    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;");
    header("Content-Disposition: attachment;filename=$fileName");
    header("Cache-Control: max-age=0");
    header("Cache-Control: max-age=1");
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: ".gmdate('D, d M Y H:i:s')." GMT");
    header("Cache-Control: cache, must-revalidate");
    header("Pragma: public");

    $writerXLS = IOFactory::createWriter($sheetXLS, 'Xls');
    $writerXLS->save('php://output');
    
    exit;
    ob_end_flush();
?>