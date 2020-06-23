<?php
	if(!isset($_SESSION)){ 
        session_start(); 
    }
    
    ob_start();
    
	require '../../class/function/curl_api.php';
	require '../../class/function/function.php';

    $val01          = $_POST['var01'];
    $val02          = $_POST['var02'];
    $val03          = $_POST['var03'];
    $val04          = $_POST['var04'];
	$val05          = trim(strtoupper(strtolower($_POST['var05'])));
	$val06          = '';
	$val07          = trim(strtoupper(strtolower($_POST['var07'])));

	$work01         = $_POST['workCodigo'];
	$work02         = $_POST['workModo'];
	$work03         = $_POST['workPage'];

	$usu_03         = strtoupper($_SESSION['usu_03']);
	$usu_05         = strtoupper($_SESSION['usu_05']);

	$log_03         = $_SESSION['log_03'];

	$path			= '../../uploads/comprobante';
	$folder			= $path.'/temporal/';

	if (is_dir($folder)) {
		if ($dh = opendir($folder)){
			while (($element = readdir($dh)) !== false) {
				$filDat = explode('.', $element);
                $file   = $filDat[0];
				$filNam = str_replace('_', '', $file);
				$FilNew	= getUUID();
				$FilNew	= str_replace('-', '', $FilNew);
				$FilNew	= str_replace('_', '', $FilNew);

				move_uploaded_file($element, $path.'/'.$FilNew.'.pdf');
				
				$dataJSON 	= json_encode(
					array(
						'tipo_estado_codigo'				=> $val01,
						'tipo_comprobante_codigo'			=> $val02,
						'tipo_mes_codigo'					=> $val04,
						'comprobante_documento'				=> $filNam,
						'comprobante_periodo'				=> $val03,
						'comprobante_adjunto'				=> $FilNew.'.pdf',
						'comprobante_observacion'			=> $val07,
						'auditoria_usuario'     			=> $usu_03,
						'auditoria_fecha_hora'  			=> date('Y-m-d H:i:s'),
						'auditoria_ip'          			=> $log_03
					));

				$result	= post_curl('200/comprobante', $dataJSON);
			}

			closedir($dh);
		}
	}

	$code	= 200;
	$message= 'Proceso concluido';
	
	header('Location: ../../public/'.$work03.'.php?code='.$code.'&msg='.$message);
	ob_end_flush();
?>