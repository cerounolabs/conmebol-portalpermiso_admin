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
	$target_ban     = false;

	$work01         = $_POST['workCodigo'];
	$work02         = $_POST['workModo'];
	$work03         = $_POST['workPage'];

	$usu_03         = strtoupper($_SESSION['usu_03']);
	$usu_05         = strtoupper($_SESSION['usu_05']);

	$log_03         = $_SESSION['log_03'];

	if (!empty($_FILES['var06']['tmp_name'])) {
        $target_msn     = '';
		$target_nam     = getFechaHora();
		$target_dir     = '../../uploads/comprobante/';
        $target_file    = $target_dir.basename($_FILES['var06']['name']);
		$imageFileType  = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		$target_file	= $target_nam.'.'.$imageFileType;

        if(isset($_POST['submit'])) {
			if ($_FILES['var06']['type'] == 'application/pdf') {
				$check = $_FILES['var06']['size'];
			} else {
				$check = getimagesize($_FILES['var06']['tmp_name']);
			}

            if($check !== false) {
				$target_ban = true;
            } else {
				$target_ban = false;
				$target_msn = 'ERROR: El archivo no es correcto. Verifique!';
            }
        }
        
        if (file_exists($target_file) && $target_ban == true) {
            $target_msn = 'ERROR: Ya existe una archivo con el mismo nombre. Verifique!';
            $target_ban = false;
        }
        
        if ($_FILES['var06']['size'] > 20000001 && $target_ban == true) {
            $target_msn = 'ERROR: El archivo es muy pesado, sobrepasa lo permitido de 20MB. Verifique!';
            $target_ban = false;
        }
        
        if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'pdf' && $target_ban == true) {
            $target_msn = 'ERROR: El formato del archivo no corresponde, solo permitido .jpg, .png, .jpeg, .pdf. Verifique!';
            $target_ban = false;
        }

        if ($target_ban == true) {
            if (move_uploaded_file($_FILES['var06']['tmp_name'], $target_dir.''.$target_file)) {
				$val06		= $target_file;
				$target_msn	= $target_file;
                $target_ban = true;
            } else {
                $target_msn = 'ERROR: El archivo tuvo inconveniente en subir, favor intente devuelta. Verifique!';
                $target_ban = false;
            }
		}
		
		$code	= 400;
		$message= $target_msn;
	}

	if ($target_ban == true) {
		if (isset($val01) && isset($val02) && isset($val03) && isset($val04) && isset($val05)) {
			$dataJSON = json_encode(
				array(
					'tipo_estado_codigo'				=> $val01,
					'tipo_comprobante_codigo'			=> $val02,
					'tipo_mes_codigo'					=> $val04,
					'comprobante_documento'				=> $val05,
					'comprobante_periodo'				=> $val03,
					'comprobante_adjunto'				=> $val06,
					'comprobante_observacion'			=> $val07,
					'auditoria_usuario'     			=> $usu_03,
					'auditoria_fecha_hora'  			=> date('Y-m-d H:i:s'),
					'auditoria_ip'          			=> $log_03
				));

			switch($work02){
				case 'C':
					$result	= post_curl('200/comprobante', $dataJSON);
					break;
				case 'U':
					$result	= put_curl('200/comprobante/'.$work01, $dataJSON);
					break;
				case 'D':
					$result	= delete_curl('200/comprobante/'.$work01, $dataJSON);
					break;
			}
		}

		$result = json_decode($result, true);
		$code	= $result['code'];
		$message= $result['message'];
	}
	
	header('Location: ../../public/'.$work03.'.php?code='.$code.'&msg='.$message);
	ob_end_flush();
?>