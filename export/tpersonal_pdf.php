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
            'default_font_size' => 4,
            'default_font' => 'Courier',
            'mirrorMargins' => true,
        ]);


        $mpdf->SetTitle('CONMEBOL | PLATAFORMA PERMISO');
        
        $ima = '../assets/images/background/fondo.png';
        $mpdf->WriteHTML('<body style="background:url('.$ima.') no-repeat center center;">');
        $mpdf->WriteFixedPosHTML('<span style="font-size:100pt; font-weight:bold; color:#416FAD;">'.$cabJSON['data'][0]['tarjeta_personal_nombre'].'</span>', 150, 70, 100, 10, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size:8rem; font-weight:bold; color:#416FAD;">'.$cabJSON['data'][0]['tipo_cargo_nombre'].'</span>', 150, 80, 100, 10, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size:7rem; color:#416FAD;">'.$cabJSON['data'][0]['tarjeta_personal_email'].'</span>', 150, 90, 100, 10, 'auto');
        
        $y=100;

        foreach($det1JSON['data'] as $sol01KEY => $sol01VALUE){
            
            if($sol01VALUE['tarjeta_personal_telefono_visualizar']=='S'){
                $tarjetanro = $sol01VALUE['tarjeta_personal_telefono_completo'];
                $mpdf->WriteFixedPosHTML('<span style="font-size:4rem; color:#416FAD; background-image:"fa fa-mobile""><i class="fa fa-mobile"></i>'.$tarjetanro.'</span>', 150, $y, 100, 10, 'auto');
                $y=110;
            }
        }

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

        $mpdf->WriteFixedPosHTML('<img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=' .$rowVCARD . '&choe=UTF-8" alt="QR code" />', 105, 165, 100, 100, 'auto');
        	

        $mpdf->WriteHTML('</body>');

//        $mpdf -> Output('CARSITOComprobante_'.$fechaHora.'.pdf', 'I');
        $mpdf->Output();
        exit;
    }

  
?>