<?php
	if(!isset($_SESSION)){ 
        session_start(); 
    }
    
    ob_start();
    
	require '../../class/function/curl_api.php';
	require '../../class/function/function.php';

	$val00_1		= $_POST['var00_1'];
	$val00_2		= $_POST['var00_2'];
    $val01          = trim(strtolower($_POST['var01']));
    $val02          = intval($_POST['var02']);

	$work01			= $_POST['workCodigo'];
	$work02			= $_POST['workModo']; 
	$work03         = $_POST['workPage'];
	$work04         = $_POST['workDocumento'];
	$work05         = intval($_POST['workEstado']);
	$work06         = intval($_POST['workAccion']);
	$work07         = $_POST['workCTelefono'];
	$work08         = $_POST['workCRSocial'];
	
	$log_01         = $_SESSION['log_01'];
	$log_03         = $_SESSION['log_03'];

	$usu_07         = $_SESSION['usu_07'];
	$usu_09         = $_SESSION['usu_09'];
	$usu_11         = $_SESSION['usu_11'];
	$usu_13         = $_SESSION['usu_13'];

	$dataJSON = json_encode(
		array(
			'tipo_accion_codigo'					=> $work06,
			'tipo_estado_parametro'					=> $work05,
			'tipo_cantidad_parametro'				=> $val02,
			'tarjeta_personal_orden'				=> 999,
			'tarjeta_personal_email'				=> $val01,
			'tipo_gerencia_codigo'					=> $usu_07,
			'tipo_departamento_codigo'				=> $usu_09,
			'tipo_jefatura_codigo'					=> $usu_11,
			'tipo_cargo_codigo'						=> $usu_13,
			'tarjeta_personal_documento'			=> $work04,
			'tarjeta_personal_nombre_visualizar'	=> $val00_1,
			'tarjeta_personal_apellido_visualizar'	=> $val00_2,
			'tarjeta_personal_observacion'			=> '',

			'auditoria_usuario'     				=> $log_01,
			'auditoria_fecha_hora'  				=> date('Y-m-d H:i:s'),
			'auditoria_ip'          				=> $log_03
		));

	switch ($work02) {
		case 'C':
			$result	= post_curl('200/tarjetapersonal', $dataJSON);
			$result	= json_decode($result, true);
			$code	= $result['code'];
			$msg	= str_replace("\n", ' ', $result['message']);
			$work01	= $result['codigo'];
			break;

		case 'U':
			$result	= put_curl('200/tarjetapersonal/'.$work01, $dataJSON);
			$result	= json_decode($result, true);
			$code	= $result['code'];
			$msg	= str_replace("\n", ' ', $result['message']);
			break;
	}

	if($work02 == 'C'){
		for ($i=1; $i < $work07 ; $i++) {
			$val03		= trim($_POST['var03_'.$i]);
			$val04		= $_POST['var04_'.$i];
			$val05		= trim($_POST['var05_'.$i]);
			$dataJSON	= json_encode(
				array(
					'tipo_estado_parametro'					=> $work05,
					'tarjeta_personal_telefono_orden'		=> 999,	
					'tipo_prefijo_parametro'				=> $val04,
					'tarjeta_personal_codigo'				=> $work01,
					'tarjeta_personal_telefono_visualizar'	=> $val03,
					'tarjeta_personal_telefono_numero'		=> $val05,
					'tarjeta_personal_telefono_observacion'	=> '',
					
					'auditoria_usuario'     			    => $log_01,
					'auditoria_fecha_hora'  			    => date('Y-m-d H:i:s'),
					'auditoria_ip'          			    => $log_03
				));

			$result1	= post_curl('200/tarjetapersonal/telefonoprefijo',$dataJSON);
		}

		for ($i=1; $i < $work08 ; $i++) {
			$val06		= trim($_POST['var06_'.$i]);
			$val07		= $_POST['var07_'.$i];
			$val08		= trim(strtolower($_POST['var08_'.$i]));
			$dataJSON	= json_encode(
				array(
					'tipo_estado_parametro'						=> $work05,
					'tarjeta_personal_red_social_orden'     	=> 999,
					'tipo_red_social_parametro'					=> $val07,
					'tarjeta_personal_codigo'					=> $work01,
					'tarjeta_personal_red_social_visualizar'	=> $val06,
					'tarjeta_personal_red_social_direccion'		=> $val08,
					'tarjeta_personal_red_social_observacion' 	=> '',

					'auditoria_usuario'     			        => $log_01,
					'auditoria_fecha_hora'  			        => date('Y-m-d H:i:s'),
					'auditoria_ip'          			        => $log_03
				));

			$result1	= post_curl('200/tarjetapersonal/redsocial', $dataJSON);
		}
	}
	
	header('Location: ../../'.$work03.'?codigo='.$work01.'&code='.$code.'&msg='.$msg);

	ob_end_flush();
?>