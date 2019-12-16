<?php
	if(!isset($_SESSION)){ 
        session_start(); 
    }
    
    ob_start();
    
    require '../../class/function/curl_api.php';

	$val01          = strtoupper($_POST['var01']);
	$val02          = strtoupper($_POST['var02']);

	$work01         = $_POST['workCodigo'];
	$work02         = $_POST['workAccion'];

	$usu_03         = strtoupper($_SESSION['usu_03']);
	$usu_05         = strtoupper($_SESSION['usu_05']);

	$log_03         = $_SESSION['log_03'];

    if (isset($val01) && isset($val02)) {
        $dataJSON = json_encode(
            array(
				'tipo_estado_codigo'				=> $val01,
				'tipo_accion_codigo'				=> $work02,
				'solicitud_codigo'					=> $work01,
				'solicitud_observacion'				=> $val02,
				'solicitud_usuario'					=> $usu_03,
				'solicitud_fecha_hora'				=> date('Y-m-d H:i:s'),
				'solicitud_ip'						=> $log_03,
				'auditoria_usuario'     			=> $usu_03,
                'auditoria_fecha_hora'  			=> date('Y-m-d H:i:s'),
                'auditoria_ip'          			=> $log_03
			));
		
		$result	= put_curl('200/'.$work01, $dataJSON);
	}

	$result		= json_decode($result, true);

	header('Location: ../../public/solicitudes.php?code='.$result['code'].'&msg='.$result['message']);

	ob_end_flush();
?>