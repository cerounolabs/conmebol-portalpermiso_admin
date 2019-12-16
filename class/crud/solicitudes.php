<?php
	if(!isset($_SESSION)){ 
        session_start(); 
    }
    
    ob_start();
    
    require '../../class/function/curl_api.php';

    $val01          = $_POST['var01'];
    $val02          = $_POST['var02'];
    $val03          = $_POST['var03'];
    $val04          = $_POST['var04'];
	$val05          = $_POST['var05'];
	$val06          = $_POST['var06'];
	$val07          = $_POST['var07'];
	$val08          = strtolower($_POST['var08']);
	$val08          = strtoupper($_POST['var09']);

    $work01         = $_POST['workCodigo'];
    $work02         = $_POST['workModo'];

	$usu_03         = strtoupper($_SESSION['usu_03']);
	$usu_05         = strtoupper($_SESSION['usu_05']);

	$log_03         = $_SESSION['log_03'];

    if (isset($val01) && isset($val02) && isset($val03)) {
        $dataJSON = json_encode(
            array(
				'tipo_estado_codigo'				=> 'I',
				'tipo_solicitud_codigo'				=> $val01,
				'solicitud_documento'				=> $usu_05,
				'solicitud_fecha_desde'				=> $val02,
				'solicitud_fecha_hasta'				=> $val03,
                'solicitud_fecha_cantidad'			=> $val04,
				'solicitud_hora_desde'				=> $val05,
				'solicitud_hora_hasta'				=> $val06,
				'solicitud_hora_cantidad'			=> $val07,
				'solicitud_adjunto'					=> $val08,
				'solicitud_observacion_colaborador'	=> $val09,
				'auditoria_usuario'     			=> $usu_03,
                'auditoria_fecha_hora'  			=> date('Y-m-d H:i:s'),
                'auditoria_ip'          			=> $log_03
			));
		
		switch($work02){
			case 'C':
				$result	= post_curl('200', $dataJSON);
				break;
			case 'U':
				$result	= put_curl('200/'.$work01, $dataJSON);
				break;
			case 'D':
				$result	= delete_curl('200/'.$work01, $dataJSON);
				break;
		}
	}

	$result		= json_decode($result, true);

	header('Location: ../../public/solicitudes.php?code='.$result['code'].'&msg='.$result['message']);

	ob_end_flush();
?>