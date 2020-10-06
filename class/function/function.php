<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    function getUUID(){
        $data    = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); 
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); 
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    function getFechaHora(){
        $result = date("YmdHis");
        return $result;
    }

    function setEmail($var00, $var01, $var02, $var03, $var04, $var05, $var06, $var07, $var08, $var09, $var10, $var11, $var12){
        require '../vendor/autoload.php';

        $result     = '';
        $mensaje    = '
        <!DOCTYPE html>
        <html lang="es">
            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta name="description" content="CONMEBOL, Sistema Permiso">
                <meta name="author" content="IT Consulting - https://it.com.py">
        
                <link href="http://www.conmebol.com/sites/all/themes/conm/favicon.ico" type="image/vnd.microsoft.icon" rel="shortcut icon"/>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        
                <title>CONMEBOL | SISTEMA PERMISO</title>
        
                <style>
                    *, *:before, *:after {
                        -moz-box-sizing: border-box;
                        -webkit-box-sizing: border-box;
                        box-sizing: border-box;
                    }
        
                    body {
                        width: max-content;
                        padding: 10px;
                        background-color: #f0f0f0;
                    }
        
                    table {
                        width: 800px;
                        height: 100%;
                        border: 3px solid #163562;
                        overflow: hidden;
                    }
        
                    th {
                        width: 50%;
                    }
        
                    .header-row {
                        background-color: #163562;
                    }
        
                    .header-img {
                        height: 50px;
                    }
        
                    .header-title {
                        color: #fff;
                        font-size: 24px;
                        font-weight: bold;
                        font-family: Verdana;
                        letter-spacing: 2.5px;
                        padding: 10px;
                    }
        
                    .row-2 {
                        background-color: #dedede;
                    }
        
                    .body-title {
                        width: 50px;
                        padding: 10px;
                        font-weight: bold;
                    }
        
                    .body-content {
                        padding: 10px;
                    }
                </style>
            </head>
            <body>
                <table>
                    <thead>
                        <tr class="header-row">
                            <th colspan="2">
                                <img class="header-img" src="http://permisos.conmebol.com/assets/images/logo_notificacion.png" style="height: 50px;" alt="Logo CONMEBOL">
                            </th>
                        </tr>
                        <tr class="header-row">
                            <th colspan="2" class="header-title">
                                SOLICITUD DE PERMISO
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="row-2">
                            <td class="body-title">
                                ESTADO
                            </td>
                            <td class="body-content">
                                '.$var02.'
                            </td>
                        </tr>
        
                        <tr>
                            <td class="body-title">
                                SOLICITUD
                            </td>
                            <td class="body-content">
                                '.$var03.'
                            </td>
                        </tr>

                        <tr class="row-2">
                            <td class="body-title">
                                COLABORADOR
                            </td>
                            <td class="body-content">
                                '.$var04.'
                            </td>
                        </tr>
        
                        <tr>
                            <td class="body-title">
                                FECHA INICIO
                            </td>
                            <td class="body-content">
                                '.$var05.'
                            </td>
                        </tr>
        
                        <tr class="row-2">
                            <td class="body-title">
                                FECHA RETORNO
                            </td>
                            <td class="body-content">
                                '.$var06.'
                            </td>
                        </tr>
        
                        <tr>
                            <td class="body-title">
                                HORA INICIO
                            </td>
                            <td class="body-content">
                                '.$var07.'
                            </td>
                        </tr>
        
                        <tr class="row-2">
                            <td class="body-title">
                                HORA DESDE
                            </td>
                            <td class="body-content">
                                '.$var08.'
                            </td>
                        </tr>
        
                        <tr>
                            <td class="body-title">
                                ADJUNTO
                            </td>
                            <td class="body-content">
                                <a href="'.$var09.'" target="_blank" title="Ver adjunto">VISUALIZAR DOCUMENTO RESPALDATORIO</a>
                            </td>
                        </tr>
        
                        <tr class="row-2">
                            <td class="body-title">
                                COMENTARIO SOLICITANTE
                            </td>
                            <td class="body-content">
                                '.$var10.'
                            </td>
                        </tr>
        
                        <tr>
                            <td class="body-title">
                                COMENTARIO JEFATURA
                            </td>
                            <td class="body-content">
                                '.$var11.'
                            </td>
                        </tr>
        
                        <tr class="row-2">
                            <td class="body-title">
                                COMENTARIO TH
                            </td>
                            <td class="body-content">
                                '.$var12.'
                            </td>
                        </tr>
                    </tbody>
                </table>
            </body>
        </html>';

        $mail       = new PHPMailer(true);
        
        try {
            $mail->SMTPDebug    = 0;
            $mail->isSMTP();
            $mail->Host         = '40.97.100.2';
            $mail->Port         = 587;
            $mail->SMTPSecure   = 'tls';
            $mail->SMTPAuth     = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Username     = 'notificaciones@conmebol.com';
            $mail->Password     = 'P3lota.2019';
            
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->setFrom('notificaciones@conmebol.com', 'Solicitud de Permiso');
            $mail->addAddress($var00, $var01);

            $mail->isHTML(true);
            $mail->Subject      = 'Solicitud de Permiso';
            $mail->Body         = $mensaje;
            $mail->Send();
        } catch (Exception $e) {
            $result = $mail->ErrorInfo;
        }
    }

    function setEmail2($var00, $var01, $var02, $var03, $var04, $var05, $var06, $var07, $var08, $var09, $var10, $var11, $var12){
        require '../vendor/autoload.php';

        $result     = '';
        $mensaje    = '
        <!DOCTYPE html>
        <html lang="es">
            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta name="description" content="CONMEBOL, Sistema Permiso">
                <meta name="author" content="IT Consulting - https://it.com.py">
        
                <link href="http://www.conmebol.com/sites/all/themes/conm/favicon.ico" type="image/vnd.microsoft.icon" rel="shortcut icon"/>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        
                <title>CONMEBOL | SISTEMA PERMISO</title>
        
                <style>
                    *, *:before, *:after {
                        -moz-box-sizing: border-box;
                        -webkit-box-sizing: border-box;
                        box-sizing: border-box;
                    }
        
                    body {
                        width: max-content;
                        padding: 10px;
                        background-color: #f0f0f0;
                    }
        
                    table {
                        width: 800px;
                        height: 100%;
                        border: 3px solid #163562;
                        overflow: hidden;
                    }
        
                    th {
                        width: 50%;
                    }
        
                    .header-row {
                        background-color: #163562;
                    }
        
                    .header-img {
                        height: 50px;
                    }
        
                    .header-title {
                        color: #fff;
                        font-size: 24px;
                        font-weight: bold;
                        font-family: Verdana;
                        letter-spacing: 2.5px;
                        padding: 10px;
                    }
        
                    .row-2 {
                        background-color: #dedede;
                    }
        
                    .body-title {
                        width: 50px;
                        padding: 10px;
                        font-weight: bold;
                    }
        
                    .body-content {
                        padding: 10px;
                    }
                </style>
            </head>
            <body>
                <table>
                    <thead>
                        <tr class="header-row">
                            <th colspan="2">
                                <img class="header-img" src="http://permisos.conmebol.com/assets/images/logo_notificacion.png" style="height: 50px;" alt="Logo CONMEBOL">
                            </th>
                        </tr>
                        <tr class="header-row">
                            <th colspan="2" class="header-title">
                                SOLICITUD DE PERMISO
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="row-2">
                            <td class="body-title">
                                ESTADO
                            </td>
                            <td class="body-content">
                                '.$var02.'
                            </td>
                        </tr>
        
                        <tr>
                            <td class="body-title">
                                SOLICITUD
                            </td>
                            <td class="body-content">
                                '.$var03.'
                            </td>
                        </tr>

                        <tr class="row-2">
                            <td class="body-title">
                                COLABORADOR
                            </td>
                            <td class="body-content">
                                '.$var04.'
                            </td>
                        </tr>
        
                        <tr>
                            <td class="body-title">
                                FECHA INICIO
                            </td>
                            <td class="body-content">
                                '.$var05.'
                            </td>
                        </tr>
        
                        <tr class="row-2">
                            <td class="body-title">
                                FECHA RETORNO
                            </td>
                            <td class="body-content">
                                '.$var06.'
                            </td>
                        </tr>
        
                        <tr>
                            <td class="body-title">
                                HORA INICIO
                            </td>
                            <td class="body-content">
                                '.$var07.'
                            </td>
                        </tr>
        
                        <tr class="row-2">
                            <td class="body-title">
                                HORA DESDE
                            </td>
                            <td class="body-content">
                                '.$var08.'
                            </td>
                        </tr>
        
                        <tr>
                            <td class="body-title">
                                ADJUNTO
                            </td>
                            <td class="body-content">
                                <a href="'.$var09.'" target="_blank" title="Ver adjunto">VISUALIZAR DOCUMENTO RESPALDATORIO</a>
                            </td>
                        </tr>
        
                        <tr class="row-2">
                            <td class="body-title">
                                COMENTARIO SOLICITANTE
                            </td>
                            <td class="body-content">
                                '.$var10.'
                            </td>
                        </tr>
        
                        <tr>
                            <td class="body-title">
                                COMENTARIO JEFATURA
                            </td>
                            <td class="body-content">
                                '.$var11.'
                            </td>
                        </tr>
        
                        <tr class="row-2">
                            <td class="body-title">
                                COMENTARIO TH
                            </td>
                            <td class="body-content">
                                '.$var12.'
                            </td>
                        </tr>
                    </tbody>
                </table>
            </body>
        </html>';

        $mail       = new PHPMailer(true);
        
        try {
            $mail->SMTPDebug    = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host         = '192.185.195.43';
            $mail->Port         = 587;
            $mail->SMTPSecure   = 'tls';
            $mail->SMTPAuth     = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Username     = 'czelaya@it.com.py';
            $mail->Password     = 'fxiw~M3Lg%Qp';
            
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->setFrom('notificaciones@conmebol.com', 'Solicitud de Permiso');
            $mail->addAddress($var00, $var01);

            $mail->isHTML(true);
            $mail->Subject      = 'Solicitud de Permiso';
            $mail->Body         = $mensaje;
            $mail->Send();
            echo 'ENVIO'.$e;
        } catch (Exception $e) {
            $result = $mail->ErrorInfo;
            echo 'ERROR'.$e;
        }
    }

    function getTitleDominio($var01){
        switch ($var01) {
            //PARAMETRO COMPROBANTE
            case 'COMPROBANTEESTADO':
                $result = 'Comprobante Estado';
                break;

            case 'COMPROBANTETIPO':
                $result = 'Comprobante Tipo';
                break;
        }

        return $result;
    }

    function getMonthName($var01) {
        $result = '';

        switch ($var01) {
            case '01':
                $result = 'ENERO';
                break;

            case '02':
                $result = 'FEBRERO';
                break;

            case '03':
                $result = 'MARZO';
                break;

            case '04':
                $result = 'ABRIL';
                break;

            case '05':
                $result = 'MAYO';
                break;

            case '06':
                $result = 'JUNIO';
                break;

            case '07':
                $result = 'JULIO';
                break;
                
            case '08':
                $result = 'AGOSTO';
                break;

            case '09':
                $result = 'SEPTIEMBRE';
                break;

            case '10':
                $result = 'OCTUBRE';
                break;

            case '11':
                $result = 'NOVIEMBRE';
                break;

            case '12':
                $result = 'DICIEMBRE';
                break;
        }

        return $result;
    }

    function dirToArray($var01) {
        $result = array();
        $cdir   = scandir($var01, SCANDIR_SORT_DESCENDING);
    
        foreach ($cdir as $key => $value) {
            if (!in_array($value,array('.', '..'))) {
                if (is_dir($var01.DIRECTORY_SEPARATOR.$value)) {
                    $result[$value] = dirToArray($var01.DIRECTORY_SEPARATOR.$value);
                } else {
                    $result[] = $value;
                }
            }
        }
    
        return $result;
    } 
?>