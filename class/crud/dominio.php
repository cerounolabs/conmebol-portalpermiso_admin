<?php
	if(!isset($_SESSION)){ 
        session_start(); 
    }
    
    ob_start();
    
	require '../../class/function/curl_api.php';
	
    $val01          = $_POST['var01'];
    $val02          = $_POST['var02'];
    $val03          = strtoupper(strtolower(trim($_POST['var03'])));
	$val04          = strtoupper(strtolower(trim($_POST['var04'])));
	$val05          = strtoupper(strtolower(trim($_POST['var05'])));

    $work01         = $_POST['workCodigo'];
	$work02         = $_POST['workModo'];
	$work03         = $_POST['workPage'];
	$work04         = $_POST['workDominio'];
	
	$usu_03         = strtoupper($_SESSION['usu_03']);

	$log_03         = $_SESSION['log_03'];

    if (isset($val01) && isset($val03)) {
        $dataJSON = json_encode(
            array(
				'tipo_estado_codigo'        => $val01,
				'tipo_orden'    		    => $val02,
                'tipo_nombre_ingles'        => $val03,
                'tipo_nombre_castellano'    => $val03,
                'tipo_nombre_portugues'     => $val03,
				'tipo_path'                 => $val04,
				'tipo_dominio'              => $work04,
				'tipo_observacion'          => $val05,
				'auditoria_usuario'         => $usu_03,
                'auditoria_fecha_hora'	    => date('Y-m-d H:i:s'),
                'auditoria_ip'        	    => $log_03
			));
		
		switch($work02){
			case 'C':
				$result	= post_curl('100/dominio', $dataJSON);
				break;
			case 'U':
				$result	= put_curl('100/dominio/'.$work01, $dataJSON);
				break;
			case 'D':
				$result	= delete_curl('100/dominio/'.$work01, $dataJSON);
				break;
		}
	}
	
	$result		= json_decode($result, true);
	$msg		= str_replace("\n", ' ', $result['message']);

	header('Location: ../../public/'.$work03.'.php?dominio='.$work04.'&code='.$result['code'].'&msg='.$msg);

	ob_end_flush();
?>