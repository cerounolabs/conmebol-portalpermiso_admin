<?php 
    if(!isset($_SESSION)){ 
        session_start(); 
    }

    $log_01 = $_SESSION['log_01'];
    $log_02 = $_SESSION['log_02'];
    $log_03 = $_SESSION['log_03'];

    $usu_01 = $_SESSION['usu_01'];
    $usu_02 = $_SESSION['usu_02'];
    $usu_03 = $_SESSION['usu_03'];
    $usu_04 = $_SESSION['usu_04'];

//    $seg_01 = $_SESSION['seg_01'];

    $expire = $_SESSION['expire'];

    $val_03 = $_SERVER['REMOTE_ADDR'];
    
    if ($expire < time()) {
        header('Location: ../../class/session/session_logout.php');
    } else {
        if ($log_01 == '' ) {
            header('Location: ../../class/session/session_logout.php');
        } else {
            if (isset($log_01) && isset($log_03) && isset($val_03)) {
                setlocale(LC_MONETARY, 'es_PY');
    
                $_SESSION['expire'] = time() + 1800;
    
                $urlAct             = $_SERVER['REQUEST_URI'];
                $urlPat             = strtoupper(substr(substr($_SERVER['SCRIPT_FILENAME'], 48), 0, -4));
                $ulrPos             = strpos($_SERVER['HTTP_REFERER'], 'public');
                $urlAnt             = substr($_SERVER['HTTP_REFERER'], $ulrPos);
                $ulrPos             = strpos($urlAnt, '.php?');

                if ($ulrPos > 0){
                    $urlQui = substr($urlAnt, $ulrPos);
                    $ulrPos = strlen($urlQui);
                    $urlAnt = substr($urlAnt, 0, ($ulrPos * -1));
                }
/*
                foreach ($seg_01['data'] as $seg_01Key=>$seg_01Array) {
                    if ($urlPat == $seg_01Array['programa_nombre']){
                        if ($seg_01Array['acceso_ingresar'] == 'S'){
                            break;
                        } else {
                            header('Location: ../../public/home.php?code=401&msg=No tiene permiso para ingresar!');
                        }
                    }
                }
*/
            } else {
                header('Location: ../../class/session/session_logout.php');
            }
        }
    }
?>