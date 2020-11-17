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
	$val05          = $_POST['var05'];
	$val06          = $_POST['var06'];
	$val07          = $_POST['var07'];
	$val08_1		= '';
	$val08_2		= '';
	$val08_3		= '';
	$val09          = strtoupper($_POST['var09']);

	if (isset($_POST['var10'])) {
		$val10          = $_POST['var10'];
	} else {
		$val10          = date('Y');
	}
	
	$target_ban     = true;

	$work01         = $_POST['workCodigo'];
	$work02         = $_POST['workModo'];
	$work03         = $_POST['workPage'];

	$usu_03         = strtoupper($_SESSION['usu_03']);
	$usu_05         = strtoupper($_SESSION['usu_05']);
	$usu_18         = strtoupper(trim($_SESSION['usu_18']));

	$log_03         = $_SESSION['log_03'];

	if (!empty($_FILES['var08_1']['tmp_name'])) {
		$target_ban     = false;
        $target_msn     = '';
		$target_nam     = getFechaHora();
		$target_dir     = '../../uploads/solicitud/';
        $target_file    = $target_dir.basename($_FILES['var08_1']['name']);
		$imageFileType  = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		$target_file	= $target_nam.'.'.$imageFileType;

        if(isset($_POST['submit'])) {
			if ($_FILES['var08_1']['type'] == 'application/pdf') {
				$check = $_FILES['var08_1']['size'];
			} else {
				$check = getimagesize($_FILES['var08_1']['tmp_name']);
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
        
        if ($_FILES['var08_1']['size'] > 20000001 && $target_ban == true) {
            $target_msn = 'ERROR: El archivo es muy pesado, sobrepasa lo permitido de 20MB. Verifique!';
            $target_ban = false;
        }
        
        if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'pdf' && $target_ban == true) {
            $target_msn = 'ERROR: El formato del archivo no corresponde, solo permitido .jpg, .png, .jpeg, .pdf. Verifique!';
            $target_ban = false;
        }

        if ($target_ban == true) {
            if (move_uploaded_file($_FILES['var08_1']['tmp_name'], $target_dir.''.$target_file)) {
				$val08_1	= $target_file;
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

	if (!empty($_FILES['var08_2']['tmp_name'])) {
		$target_ban     = false;
        $target_msn     = '';
		$target_nam     = getFechaHora();
		$target_dir     = '../../uploads/solicitud/';
        $target_file    = $target_dir.basename($_FILES['var08_2']['name']);
		$imageFileType  = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		$target_file	= $target_nam.'.'.$imageFileType;

        if(isset($_POST['submit'])) {
			if ($_FILES['var08_2']['type'] == 'application/pdf') {
				$check = $_FILES['var08_2']['size'];
			} else {
				$check = getimagesize($_FILES['var08_2']['tmp_name']);
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
        
        if ($_FILES['var08_2']['size'] > 20000001 && $target_ban == true) {
            $target_msn = 'ERROR: El archivo es muy pesado, sobrepasa lo permitido de 20MB. Verifique!';
            $target_ban = false;
        }
        
        if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'pdf' && $target_ban == true) {
            $target_msn = 'ERROR: El formato del archivo no corresponde, solo permitido .jpg, .png, .jpeg, .pdf. Verifique!';
            $target_ban = false;
        }

        if ($target_ban == true) {
            if (move_uploaded_file($_FILES['var08_2']['tmp_name'], $target_dir.''.$target_file)) {
				$val08_2	= $target_file;
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

	if (!empty($_FILES['var08_3']['tmp_name'])) {
		$target_ban     = false;
        $target_msn     = '';
		$target_nam     = getFechaHora();
		$target_dir     = '../../uploads/solicitud/';
        $target_file    = $target_dir.basename($_FILES['var08_3']['name']);
		$imageFileType  = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		$target_file	= $target_nam.'.'.$imageFileType;

        if(isset($_POST['submit'])) {
			if ($_FILES['var08_3']['type'] == 'application/pdf') {
				$check = $_FILES['var08_3']['size'];
			} else {
				$check = getimagesize($_FILES['var08_3']['tmp_name']);
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
        
        if ($_FILES['var08_3']['size'] > 20000001 && $target_ban == true) {
            $target_msn = 'ERROR: El archivo es muy pesado, sobrepasa lo permitido de 20MB. Verifique!';
            $target_ban = false;
        }
        
        if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'pdf' && $target_ban == true) {
            $target_msn = 'ERROR: El formato del archivo no corresponde, solo permitido .jpg, .png, .jpeg, .pdf. Verifique!';
            $target_ban = false;
        }

        if ($target_ban == true) {
            if (move_uploaded_file($_FILES['var08_3']['tmp_name'], $target_dir.''.$target_file)) {
				$val08_3	= $target_file;
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
					'solicitud_periodo'					=> $val10,
					'solicitud_documento_jefe'			=> $usu_18,
					'solicitud_adjunto1'				=> $val08_1,
					'solicitud_adjunto2'				=> $val08_2,
					'solicitud_adjunto3'				=> $val08_3,
					'solicitud_observacion_colaborador'	=> $val09,
					'auditoria_usuario'     			=> $usu_03,
					'auditoria_fecha_hora'  			=> date('Y-m-d H:i:s'),
					'auditoria_ip'          			=> $log_03
				));

			switch($work02){
				case 'C':
					$result	= post_curl('200/solicitudes', $dataJSON);
					break;
				case 'U':
					$result	= put_curl('200/solicitudes/'.$work01, $dataJSON);
					break;
				case 'D':
					$result	= delete_curl('200/solicitudes/'.$work01, $dataJSON);
					break;
			}
		}

		$result = json_decode($result, true);
		$code	= $result['code'];
		$message= $result['message'];
	}

	if ($work02 == 'C') {
		header('Location: ../../public/'.$work03.'code='.$code.'&msg='.$message.'&tipo=SOLING&codigo='.$result['codigo']);
	} else {
		header('Location: ../../public/'.$work03.'code='.$code.'&msg='.$message);
	}

	ob_end_flush();
?>