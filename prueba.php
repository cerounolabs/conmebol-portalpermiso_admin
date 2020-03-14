<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'class/function/function.php';
    require 'vendor/autoload.php';

    $var01 = 'christian@cerouno.com.py';
    $var02 = 'dgonzalez@conmebol.com';

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
                                <img class="header-img" src="http://permisos.conmebol.com/assets/images/logo_index.png" alt="Logo CONMEBOL">
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
                                INGRESADO
                            </td>
                        </tr>
        
                        <tr>
                            <td class="body-title">
                                SOLICITUD
                            </td>
                            <td class="body-content">
                                JUSTIFICACIÓN DE LLEGADAS TARDIAS
                            </td>
                        </tr>

                        <tr class="row-2">
                            <td class="body-title">
                                COLABORADOR
                            </td>
                            <td class="body-content">
                                CHRISTIAN EDUARDO ZELAYA SOSA
                            </td>
                        </tr>
        
                        <tr>
                            <td class="body-title">
                                FECHA INICIO
                            </td>
                            <td class="body-content">
                                11/03/2020
                            </td>
                        </tr>
        
                        <tr class="row-2">
                            <td class="body-title">
                                FECHA RETORNO
                            </td>
                            <td class="body-content">
                                11/03/2020
                            </td>
                        </tr>
        
                        <tr>
                            <td class="body-title">
                                HORA INICIO
                            </td>
                            <td class="body-content">
                                08:00
                            </td>
                        </tr>
        
                        <tr class="row-2">
                            <td class="body-title">
                                HORA DESDE
                            </td>
                            <td class="body-content">
                                18:00
                            </td>
                        </tr>
        
                        <tr>
                            <td class="body-title">
                                ADJUNTO
                            </td>
                            <td class="body-content">
                                <a href="http://permisos.conmebol.com/uploads/" target="_blank" title="Ver adjunto">VISUALIZAR DOCUMENTO RESPALDATORIO</a>
                            </td>
                        </tr>
        
                        <tr class="row-2">
                            <td class="body-title">
                                COMENTARIO SOLICITANTE
                            </td>
                            <td class="body-content">
                                QUIERO SALIR DE VACACIONES
                            </td>
                        </tr>
        
                        <tr>
                            <td class="body-title">
                                COMENTARIO JEFATURA
                            </td>
                            <td class="body-content">
                                OK
                            </td>
                        </tr>
        
                        <tr class="row-2">
                            <td class="body-title">
                                COMENTARIO TH
                            </td>
                            <td class="body-content">
                                QUIERO SALIR DE VACACIONES
                            </td>
                        </tr>
                    </tbody>
                </table>
            </body>
        </html>';

        $mail       = new PHPMailer(true);
        
        try {
            $mail->SMTPDebug    = 2;
            $mail->isSMTP();
            $mail->Host         = 'smpt.office365.com';
            $mail->Port         = 587;
            $mail->SMTPSecure   = 'tls';
            $mail->SMTPAuth     = true;
            $mail->Username     = 'notificaciones@conmebol.com';
            $mail->Password     = 'P3lota.2019';
            

            $mail->setFrom('notificaciones@conmebol.com', 'Solicitud de Permiso');
            $mail->addAddress($var01, $var02);

            $mail->isHTML(true);
            $mail->Subject      = 'Solicitud de Permiso';
            $mail->Body         = $mensaje;
        
            $mail->Send();
        } catch (Exception $e) {
            echo "Mailer Error: {$mail->ErrorInfo}";
        }
?>