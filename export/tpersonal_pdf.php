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

        $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $mpdf = new \Mpdf\Mpdf([
            'fontDir' => array_merge($fontDirs, [
                '../dist/font',
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
            "brandingbold" => [
                'R' => "Latinotype_Branding_Bold.ttf"
            ],
            "brandingmedium" => [
                'R' => "Latinotype_Branding_Medium.ttf"
            ],
            "Latinotype_Branding_Semibold" => [
                'R' => "Latinotype_Branding_Semibold.ttf"
            ],
            'mode' => 'utf-8', 
            'format' => [274, 695], 
            'orientation' => 'L',
            'margin_top' => 5,
            'margin_left' => 5,
            'margin_right' => 5,
            'margin_bottom' => 0,
            'default_font_size' => 4,
            'default_font' => 'brandingmedium',
            'mirrorMargins' => true,
        ]);

        $mpdf->WriteHTML($css,\Mpdf\HTMLParserMode::HEADER_CSS);

        $mpdf->SetTitle('CONMEBOL | PLATAFORMA PERMISO');
        $ima = '../assets/images/background/fondo3.png';
        $numero ='+595 215172000';
        $direccion= 'Autopista Silvio Pettirossi y Valois Rivarola. Luque, Paraguay.';
        $url = 'www.conmebol.com';
        $style = "font-family: brandingbold; font-size:100pt; font-weight:bold; color:#205aa7;";

        $mpdf->WriteHTML('<body style="background:url('.$ima.') no-repeat center center; font-family: brandingmedium;">');
        $mpdf->WriteFixedPosHTML('<span style="font-family: brandingbold; font-size:10rem; color:#205aa7">'.$cabJSON['data'][0]['tarjeta_personal_nombre1'].' '.$cabJSON['data'][0]['tarjeta_personal_apellido1'].'</span>', 113, 70, 200, 30, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size:6rem; color:#205aa7; font-weight:bold;">'.$cabJSON['data'][0]['tipo_cargo_nombre'].'</span>', 113, 88, 150, 30, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-family: fontawesome; font-size:4rem; color:#74b8e5;">&#xf0e0;</span>', 113, 111, 100, 10, 'auto'); 
        $mpdf->WriteFixedPosHTML('<span style="font-size:7rem; color:#205aa7;">'.$cabJSON['data'][0]['tarjeta_personal_email'].'</span>', 125, 110, 100, 10, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-family: fontawesome; font-size:4rem; color:#74b8e5;">&#xf879;</span>' , 113, 121, 100, 10, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size:5rem; color:#205aa7;">'.$numero.'</span>', 125, 120, 100, 10, 'auto');
        
        $y=130;

        foreach($det1JSON['data'] as $sol01KEY => $sol01VALUE){
            if($sol01VALUE['tarjeta_personal_telefono_visualizar']=='S'){

                $tarjetanro = $sol01VALUE['tarjeta_personal_telefono_completo'];

                $mpdf->WriteFixedPosHTML('<span style="font-family: fontawesome; font-size:4rem; color:#74b8e5;">&#xf3cd;</span>' , 113, $y, 100, 10, 'auto');
                $mpdf->WriteFixedPosHTML('<span style="font-size:5rem; color:#205aa7;">'.$tarjetanro.'</span>' , 125, $y, 100, 10, 'auto');

                $y=140;
           }
        }
        
        $mpdf->WriteFixedPosHTML('<span style="font-size:8rem; color:#205aa7;">'.$direccion.'</span>', 170, 163, 115, 35, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-family: Branding Bold; font-size:7rem; color:#205aa7;">'.$url.'</span>', 170, 210, 100, 10, 'auto');

        $rowVCARD   = '';

        $rowNombre  = str_replace(',',';',$cabJSON['data'][0]['tarjeta_personal_nombre']);
        $rowVCARD = $rowVCARD.
        'BEGIN:VCARD'."\n".
        'VERSION:3.0'."\n".
        'N:'.$rowNombre."\n".
        'FN:'.$cabJSON['data'][0]['tarjeta_personal_nombre']."\n".
        'ORG:Confederación Sudamericana de Fútbol - CONMEBOL'."\n".
//        'ADR;TYPE=WORK:Autopista Silvio Pettirossi y Valois Rivarola - Luque - Paraguay '."\n".
        'ROLE:'.$cabJSON['data'][0]['tipo_cargo_nombre']."\n"; 
//        'TITLE:' .$cabJSON['data'][0]['tipo_cargo_nombre']."\n".
//        'TEL;TYPE=WORK;VOICE:+595215172000:'."\n".'';

        foreach($det1JSON['data'] as $sol01KEY => $sol01VALUE){
            if($sol01VALUE['tarjeta_personal_telefono_visualizar']=='S'){ 
                $rowVCARD = $rowVCARD.'TEL;TYPE=WORK;CELL:'.$sol01VALUE['tarjeta_personal_telefono_completo']."\n";
            }
        }

        $rowVCARD = $rowVCARD.'EMAIL;TYPE=WORK:'.$cabJSON['data'][0]['tarjeta_personal_email']."\n".
        'URL:https://www.conmebol.com/'."\n".
        'END:VCARD';
 
        $mpdf->WriteFixedPosHTML('<img src="https://api.qrserver.com/v1/create-qr-code/?data='.urlencode($rowVCARD).'&size=200x200&color=32-90-167"  />', 113, 165, 100, 140, 'auto');

        $mpdf->WriteHTML('</body>');

//        $mpdf -> Output('CARSITOComprobante_'.$fechaHora.'.pdf', 'I');
        $mpdf->Output();
        exit;
    }
?>