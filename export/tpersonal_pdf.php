<?php

//    require '../class/function/curl_api.php';
//    require '../class/function/function.php';
//    require '../class/session/session_system.php';
    require '../vendor/autoload.php';
    
    $fechaHora      = getFechaHora();

//    if(isset($_GET['codigo'])){ 
//        $codElem = $_GET['codigo'];
//    }

//    if ($codElem <> 0){
//        $resultJSON = get_curl('200/tarjetapersonal/codigo/'.$codElem);
//        $det01JSON  = get_curl('200/tarjetapersonal/telefonoprefijo/tarjetapersonal/'.$codElem);
//        $det02JSON  = get_curl('200/tarjetapersonal/redsocial/tarjetapersonal/'.$codElem);

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8', 
            'format' => [75, 175], 
            'orientation' => 'L',
            'margin_top' => 5,
            'margin_left' => 5,
            'margin_right' => 5,
            'margin_bottom' => 0,
            'default_font_size' => 6,
            'default_font' => 'Courier',
            'mirrorMargins' => true
        ]);

        $mpdf->SetTitle('CONMEBOL | PLATAFORMA PERMISO');

        $mpdf->WriteHTML('<body>');
        $mpdf->WriteHTML('</body>');

//        $mpdf -> Output('CARSITOComprobante_'.$fechaHora.'.pdf', 'I');
        $mpdf->Output();
//        exit;
//    }
?>