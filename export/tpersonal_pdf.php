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
        
        $css = file_get_contents('../css/font.css');
        $style = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">';
/*
        $css2 = file_get_contents('../dist/css/icons/font-awesome/css/fontawesome-all.css');
        $css3 = file_get_contents('../dist/css/icons/font-awesome/css/fontawesome.css');

        $css4 = file_get_contents('../dist/css/icons/font-awesome/css/fa-solid.css');
        $css5 = file_get_contents('../dist/css/icons/font-awesome/webfonts/fa-brands-400.eot');
        $css6 = file_get_contents('../dist/css/icons/font-awesome/webfonts/fa-brands-400.woff2');
        $css7 = file_get_contents('../dist/css/icons/font-awesome/webfonts/fa-brands-400.svg');
        $css8 = file_get_contents('../dist/css/icons/font-awesome/webfonts/fa-brands-400.woff');
        $css9 = file_get_contents('../dist/css/icons/font-awesome/webfonts/fa-brands-400.ttf');

*/


        $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];






        $mpdf = new \Mpdf\Mpdf([



            'fontDir' => array_merge($fontDirs, [
                __DIR__ . '/../../resources/fonts',
            ]),
            "fontawesome" => [
                'R' => "fa-brands-400.ttf"
            ],
            "fontawesome" => [
                'R' => "fa-regular-400.ttf"
            ],
            "fontawesome" => [
                'R' => "fa-solid-900.ttf"
            ],




            'mode' => 'utf-8', 
            'format' => [274, 695], 
            'orientation' => 'L',
            'margin_top' => 5,
            'margin_left' => 5,
            'margin_right' => 5,
            'margin_bottom' => 0,
            'default_font_size' => 4,
            'default_font' => 'Branding',
            'mirrorMargins' => true,
        ]);

        $mpdf->WriteHTML($css,\Mpdf\HTMLParserMode::HEADER_CSS);
/*
        $mpdf->WriteHTML($css2,\Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($css3,\Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($css4,\Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($css5,\Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($css6,\Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($css7,\Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($css8,\Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($css9,\Mpdf\HTMLParserMode::HEADER_CSS);
*/

        $mpdf->SetTitle('CONMEBOL | PLATAFORMA PERMISO');
        $ima = '../assets/images/background/fondo3.png';

        $mpdf->WriteHTML($style);
        $mpdf->WriteHTML('<body style="background:url('.$ima.') no-repeat center center;">');
        $mpdf->WriteFixedPosHTML('<span style="font-size:100pt; font-weight:bold; color:#205aa7;">'.$cabJSON['data'][0]['tarjeta_personal_nombre'].'</span>', 113, 70,150, 20, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size:4rem; color:#205aa7;">'.$cabJSON['data'][0]['tipo_cargo_nombre'].'</span>', 113, 85, 120, 14, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-family: fontawesome; font-size: 20pt; color:#74b8e5;">&#xf0e0;</span>', 113, 115, 100, 10, 'auto'); 
        $mpdf->WriteFixedPosHTML('<span style="font-size:7rem; color:#205aa7;">'.$cabJSON['data'][0]['tarjeta_personal_email'].'</span>', 125, 115, 100, 10, 'auto');
        
        $y=130;

        foreach($det1JSON['data'] as $sol01KEY => $sol01VALUE){
            
            if($sol01VALUE['tarjeta_personal_telefono_visualizar']=='S'){
                $tarjetanro = $sol01VALUE['tarjeta_personal_telefono_completo'];
                $mpdf->WriteHTML('');
              //  $mpdf->WriteHTML('<span style="font-family: fontawesome;style="font-size:100pt";">&#xf3ed;  </span>');
               // $mpdf->WriteFixedPosHTML('<span style="font-size:5rem; color:#205aa7; style="font-family: fontawesome;">&#xf3cd;'.$tarjetanro.'</span>', 113, $y, 100, 100, 'auto');
                $mpdf->WriteFixedPosHTML('<span style="font-family: fontawesome; font-size: 20pt; color:#74b8e5;">&#xf879;</span>' , 113, $y, 100, 100, 'auto');
                $mpdf->WriteFixedPosHTML('<span style="font-size:5rem; color:#205aa7;">'.$tarjetanro.' </span>' , 125, $y, 100, 100, 'auto');
                $y=145;
            }
        }

       // $mpdf->WriteHTML();

        $rowVCARD   = '';

        $rowVCARD = $rowVCARD .
        'BEGIN:VCARD' .  "\n" .
        'VERSION:3.0' . "\n" .
        'N' . "\n" .
        'FN:' . "\n" .
        'ORG:Confederación Sudamericana de Fútbol - CONMEBOL' . "\n" .
        'ADR;TYPE=WORK:Autopista Silvio Pettirossi y Valois Rivarola - Luque - Paraguay ' . "\n" .
        'ROLE::'. $cabJSON['data'][0]['tipo_cargo_nombre']. "\n" . 
        'TITLE::' .$cabJSON['data'][0]['tipo_cargo_nombre']. "\n" .
        'TEL;TYPE=WORK;VOICE:+595215172000:' . "\n" .'';

        foreach($det1JSON['data'] as $sol01KEY => $sol01VALUE){

            if($sol01VALUE['tarjeta_personal_telefono_visualizar']=='S'){ 
                'TEL;TYPE=WORK;CELL:+' .$det1JSON['data'][1]['tarjeta_personal_telefono_completo']. "\n";
            }
        }

        'EMAIL;TYPE=WORK:' .$cabJSON['data'][0]['tarjeta_personal_email']. "\n" .
        'URL:https://www.conmebol.com/' . "\n" .
        'END:VCARD';
        //style =" background-image: linear-gradient(top, #c7cdde, #f0f2ff)";
        $mpdf->WriteFixedPosHTML('<img style="color:#205aa7;" src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=' .$rowVCARD . '&choe=UTF-8" alt="QR code"  />', 104, 165, 100, 100, 'auto');
        	

        $mpdf->WriteHTML('</body>');

//        $mpdf -> Output('CARSITOComprobante_'.$fechaHora.'.pdf', 'I');
        $mpdf->Output();
        exit;
    }

  
?>