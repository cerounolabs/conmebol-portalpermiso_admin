<?php
    require '../class/function/curl_api.php';
    require '../class/function/function.php';
    require '../class/session/session_system.php';
    require '../vendor/autoload.php';
    
    $fechaHora      = getFechaHora();

    if(isset($_GET['codigo'])){ 
        $codElem = $_GET['codigo'];
    }

    if ($codElem <> 0){
        $cabJSON    = get_curl('200/tarjetapersonal/codigo/'.$codElem);
        $det1JSON   = get_curl('200/tarjetapersonal/telefonoprefijo/tarjetapersonal/'.$codElem);
        $det2JSON   = get_curl('200/tarjetapersonal/redsocial/tarjetapersonal/'.$codElem);

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8', 
            'format' => [274, 695], 
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
        
        $ima = '../assets/images/background/fondo.png';
//        $mpdf->Image($ima, 10, 10, 110, 110, 'png', '', true, false);
        $mpdf->WriteHTML('<body style="background:url('.$ima.') no-repeat center center;">');
        $mpdf->WriteFixedPosHTML('<span style="font-size:10rem; font-weight:bold;">'.$cabJSON['data'][0]['tarjeta_personal_nombre'].'</span>', 150, 70, 100, 10, 'auto');
        $mpdf->WriteHTML('</body>');

//        $mpdf -> Output('CARSITOComprobante_'.$fechaHora.'.pdf', 'I');
        $mpdf->Output();
        exit;
    }
?>