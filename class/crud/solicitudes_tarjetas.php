<?php
	if(!isset($_SESSION)){ 
        session_start(); 
    }
    
    ob_start();
    
	require '../../class/function/curl_api.php';
	require '../../class/function/function.php';

    $val01          = trim($_POST['var01']);
    $val02          = trim($_POST['var02']);
	$val011			= ($_POST['var011']);

	$work01			= $_POST['workCodigo'];
	$work02			= $_POST['workModo']; 
	$work03         = $_POST['workPage'];
	$work04         = $_POST['workAccion'];
	$work05         = $_POST['workDocumento'];
	$work06         = $_POST['workEstado'];
	$work07         = $_POST['workCTelefono'];
	$work08         = $_POST['workCRSocial'];
	
	$log_01         = $_SESSION['log_01'];
	$log_03         = $_SESSION['log_03'];

	$log_107         = $_SESSION['usu_07'];
	$log_109         = $_SESSION['usu_09'];
	$log_111         = $_SESSION['usu_11'];
	$log_113         = $_SESSION['usu_13'];
	
	
//***********************cabecera**************************//
			$dataJSON = json_encode(
				array(
					'tipo_accion_codigo'				=> $work04,
					'tipo_estado_parametro'				=> $work06,
					'tipo_cantidad_parametro'			=> $val011,
					'tarjeta_personal_orden'			=> 999,
					'tarjeta_personal_email'			=> $val02,
					'tipo_gerencia_codigo'				=> $log_107,
					'tipo_departamento_codigo'			=> $log_109,
					'tipo_jefatura_codigo'				=> $log_111,
					'tipo_cargo_codigo'					=> $log_113,
					'tarjeta_personal_documento'		=> $work05,
					'tarjeta_personal_observacion'		=> '',
					'auditoria_usuario'     			=> $log_01,
					'auditoria_fecha_hora'  			=> date('Y-m-d H:i:s'),
					'auditoria_ip'          			=> $log_03
				));
				if($work02 == 'C'){

					$result	= post_curl('200/tarjetapersonal', $dataJSON);
					$result	= json_decode($result, true);
					$msg	= str_replace("\n", ' ', $result['message']);
					$work01=$result['codigo'];
					
				}else if($work02 == 'U'){

					$result	= put_curl('200/tarjetapersonal/'.$work01, $dataJSON);
					$result	= json_decode($result, true);
					$msg	= str_replace("\n", ' ', $result['message']);
					
				}
//*********************telefono*******************************//
			for ($i=1; $i < $work07 ; $i++) {
				$val03          = $_POST['var03_'.$i];
				$val04          = trim($_POST['var04_'.$i]);
				$val05          = trim($_POST['var05_'.$i]);

				$dataJSON = json_encode(
					array(
						'tipo_estado_parametro'					=> $work06,
						'tarjeta_personal_telefono_orden'		=>	999,	
						'tipo_prefijo_parametro'				=> $val03,
						'tarjeta_personal_codigo'				=> $work01,
						'tarjeta_personal_telefono_visualizar'	=> $val05,
						'tarjeta_personal_telefono_numero'		=> $val04,
						'tarjeta_personal_telefono_observacion'	=> '',
						
						'auditoria_usuario'     			    => $log_01,
						'auditoria_fecha_hora'  			    => date('Y-m-d H:i:s'),
						'auditoria_ip'          			    => $log_03
					));

					if($work02 == 'C'){
						$result	= post_curl('200/tarjetapersonal/telefonoprefijo',$dataJSON);
						$result	= json_decode($result, true);
						$msg	= str_replace("\n", ' ', $result['message']);
	
					}else if($work02 == 'U'){
	
						$result	= put_curl('200/tarjetapersonal/'.$work01, $dataJSON);
						$result	= json_decode($result, true);
						$msg	= str_replace("\n", ' ', $result['message']);
	
					}
			}

//********************redes sociales***************************//
		for ($i=1; $i < $work08 ; $i++) {
			$val010			= trim($_POST['var010_'.$i]);
			$val11			= trim($_POST['var011_'.$i]);
			$val012			= trim($_POST['var012_'.$i]);
			$dataJSON = json_encode(
				array(
					'tipo_estado_parametro'						=> $work06,
					'tarjeta_personal_red_social_orden'     	=>999,
					'tipo_red_social_parametro'					=> $val11,
					'tarjeta_personal_codigo'					=> $work01,
					'tarjeta_personal_red_social_direccion'		=> $val010,
					'tarjeta_personal_red_social_observacion' 	=>'',
					
					'auditoria_usuario'     			        => $log_01,
					'auditoria_fecha_hora'  			        => date('Y-m-d H:i:s'),
					'auditoria_ip'          			        => $log_03
				));

				if($work02 == 'C'){

					$result	= post_curl('200/tarjetapersonal/redsocial', $dataJSON);
					$result	= json_decode($result, true);
					$msg	= str_replace("\n", ' ', $result['message']);

				}else if($work02 == 'U'){

					$result	= put_curl('200/tarjetapersonal/redesocial/'.$work01, $dataJSON);
					$result	= json_decode($result, true);
					$msg	= str_replace("\n", ' ', $result['message']);

				}

		}

		header('Location: ../../public/'.$work03.'?codigo='.$work01.'&code='.$result['code'].'&msg='.$msg);

		ob_end_flush();
?>