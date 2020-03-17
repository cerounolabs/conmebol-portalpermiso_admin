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
    $usu_05 = $_SESSION['usu_05'];
    $usu_06 = $_SESSION['usu_06'];
    $usu_07 = $_SESSION['usu_07'];
    $usu_08 = $_SESSION['usu_08'];
    $usu_09 = $_SESSION['usu_09'];
    $usu_10 = $_SESSION['usu_10'];
    $usu_11 = $_SESSION['usu_11'];
    $usu_12 = $_SESSION['usu_12'];
    $usu_13 = $_SESSION['usu_13'];
    $usu_14 = $_SESSION['usu_14'];
    $usu_15 = $_SESSION['usu_15'];
    $usu_16 = $_SESSION['usu_16'];
    $usu_17 = $_SESSION['usu_17'];

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