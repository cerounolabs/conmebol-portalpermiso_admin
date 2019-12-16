<?php
	if(!isset($_SESSION)){ 
        session_start(); 
    }
    
    ob_start();
    
    require '../../class/function/curl_api.php';

    $val01          = strtoupper($_POST['var01']);
    $val02          = $_POST['var02'];
    $val03          = $_POST['var03'];
    $val04          = strtoupper($_POST['var04']);
	$val05          = strtoupper($_POST['var05']);
	$val06          = strtoupper($_POST['var06']);
	$val07          = strtoupper($_POST['var07']);

    $work01         = $_POST['workCodigo'];
    $work02         = $_POST['workModo'];

	$usu_03         = strtoupper($_SESSION['usu_03']);

	$log_03         = $_SESSION['log_03'];

    if (isset($val01) && isset($val02) && isset($val03)) {
        $dataJSON = json_encode(
            array(
                'tipo_estado_codigo'    => $val01,
				'tipo_orden_numero'     => $val02,
				'tipo_dia_cantidad'     => $val03,
				'tipo_dia_corrido'		=> $val04,
				'tipo_dia_unidad'		=> $val05,
				'tipo_archivo_adjunto'	=> $val06,
                'tipo_observacion'      => $val07,
				'auditoria_usuario'     => $usu_03,
                'auditoria_fecha_hora'  => date('Y-m-d H:i:s'),
                'auditoria_ip'          => $log_03
			));
		
		switch($work02){
			case 'C':
				$result	= post_curl('100', $dataJSON);
				break;
			case 'U':
				$result	= put_curl('100/'.$work01, $dataJSON);
				break;
			case 'D':
				$result	= delete_curl('100/'.$work01, $dataJSON);
				break;
		}
	}

	$result		= json_decode($result, true);

    header('Location: ../../public/solicitud.php?code='.$result['code'].'&msg='.$result['message']);

	ob_end_flush();
?>