<?php
	if(!isset($_SESSION)){ 
        session_start(); 
    }
    
    ob_start();
    
	require '../../class/function/curl_api.php';
	require '../../class/function/function.php';

    $val01          = trim($_POST['var01']);
    $val02          = trim($_POST['var02']);
	$val09			= ($_POST['var09']);
	$val010			= trim($_POST['var010']);
	$val011			= ($_POST['var011']);

	$work01			= $_POST['workCodigo'];
	$work02			= $_POST['workModo']; 
	$work03         = $_POST['workPage'];
	
	$log_01         = $_SESSION['log_01'];
	$log_03         = $_SESSION['log_03'];

	$log_107         = $_SESSION['usu_07'];
	$log_109         = $_SESSION['usu_09'];
	$log_113         = $_SESSION['usu_13'];
	$log_118         = $_SESSION['usu_18'];
	
//cabecera
			$dataJSON = json_encode(
				array(
					'tipo_estado_parametro'				=>1,
					'tipo_cantidad_parametro'			=>$val011,
					'tarjeta_personal_orden'			=>999,
					'tipo_gerencia_codigo'				=>$log_107,
					'tipo_departamento_codigo'			=>$log_109,
					'tipo_jefatura_codigo'				=>999,
					'tipo_cargo_codigo'					=>$log_113,
					'tarjeta_personal_documento'		=>$log_118,
					'tarjeta_personal_observacion'		=>'',
					'nombre_completo'					=> $val01,
					'email'								=> $val02,

					'auditoria_usuario'     			=> $log_01,
					'auditoria_fecha_hora'  			=> date('Y-m-d H:i:s'),
					'auditoria_ip'          			=> $log_03
				));

					$result	= post_curl('200/tarjetapersonal', $dataJSON);
					$result	= json_decode($result, true);
					$msg	= str_replace("\n", ' ', $result['message']);
					

//telefono
			for ($i=1; $i < 3; $i++) {
				$val03          = ($_POST['var03_'.$i]);//prefijo
				$val04          = trim($_POST['var04_'.$i]);//telefono
				$val05          = trim($_POST['var05_'.$i]);//valor si/no

				$dataJSON = json_encode(
					array(
						'tipo_estado_parametro'					=> 1,
						'tarjeta_personal_telefono_orden'		=>999,	
						'tipo_prefijo_parametro'				=> $val03,
						'tarjeta_personal_codigo'				=> $work01,
						'tarjeta_personal_telefono_visualizar'	=> $val05,
						'tarjeta_personal_telefono_numero'		=> $val04,
						'tarjeta_personal_telefono_observacion'	=> '',
						
						'auditoria_usuario'     			    => $log_01,
						'auditoria_fecha_hora'  			    => date('Y-m-d H:i:s'),
						'auditoria_ip'          			    => $log_03
					));

					$result	= post_curl('200/tarjetapersonal/telefonoprefijo',$dataJSON);
					$result	= json_decode($result, true);
					$msg	= str_replace("\n", ' ', $result['message']);
					
			}

//redes sociales
			$dataJSON = json_encode(
				array(
					'tipo_estado_parametro'						=> 1,
					'tarjeta_personal_red_social_orden'     	=>999,
					'tipo_red_social_parametro'					=> $val09,
					'tarjeta_personal_codigo'					=> $work01,
					'tarjeta_personal_red_social_direccion'		=> $val010,
					'tarjeta_personal_red_social_observacion' 	=>'',
					
					'auditoria_usuario'     			        => $log_01,
					'auditoria_fecha_hora'  			        => date('Y-m-d H:i:s'),
					'auditoria_ip'          			        => $log_03
				));

					$result	= post_curl('200/tarjetapersonal/redsocial', $dataJSON);
					$result	= json_decode($result, true);
					$msg	= str_replace("\n", ' ', $result['message']);

		header('Location: ../../public/'.$work03.'?codigo='.$work01.'&code='.$result['code'].'&msg='.$msg);

		ob_end_flush();
?>