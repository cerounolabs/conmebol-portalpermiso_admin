<?php
    if(!isset($_SESSION)){ 
        session_start(); 
    }

    require '../../class/function/curl_api.php';
    require '../../class/function/function.php';

    $val_01         = $_POST['val_01'];
    $val_02         = $_POST['val_02'];
    $val_03         = $_SERVER['REMOTE_ADDR'];

    $dataJSON       = json_encode(
        array(
            'usuario_var01' => $val_01,
            'usuario_var02' => $val_02,
            'usuario_var03' => $val_03,
            'usuario_var04'	=> $_SERVER['HTTP_HOST'],
            'usuario_var05'	=> $_SERVER['HTTP_USER_AGENT'],
            'usuario_var06'	=> $_SERVER['HTTP_REFERER']
        ));
    
    $resultJSON     = post_curl('login', $dataJSON);
    $resultJSON     = json_decode($resultJSON, true);

    if ($resultJSON['code'] === 200) {
        $_SESSION['log_01'] = trim(strtoupper($val_01));
        $_SESSION['log_02'] = $val_02;
        $_SESSION['log_03'] = $val_03;

        $_SESSION['usu_01'] = $resultJSON['data'][0]['user_var01'];
        $_SESSION['usu_02'] = $resultJSON['data'][0]['user_var02'];
        $_SESSION['usu_03'] = $resultJSON['data'][0]['user_var03'];
        $_SESSION['usu_04'] = $resultJSON['data'][0]['user_var04'];
        $_SESSION['usu_05'] = $resultJSON['data'][0]['user_var05'];

        $_SESSION['expire'] = time() + 1800;
        
        header('Location: ../../public/home.php');
    } else {
        $val_01             = NULL;
        $val_02             = NULL;
        $val_03             = NULL;

        header('Location: ../../index.php?code='.$resultJSON['code'].'&msg='.$resultJSON['message']);
    }
?>