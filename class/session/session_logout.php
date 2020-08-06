<?php
    if(!isset($_SESSION)){ 
        session_start(); 
    }

    unset($_SESSION['log_01']);
    unset($_SESSION['log_02']);
    unset($_SESSION['log_03']);
    
    unset($_SESSION['usu_01']);
    unset($_SESSION['usu_02']);
    unset($_SESSION['usu_03']);
    unset($_SESSION['usu_04']);
    unset($_SESSION['usu_05']);
    unset($_SESSION['usu_06']);
    unset($_SESSION['usu_07']);
    unset($_SESSION['usu_08']);
    unset($_SESSION['usu_09']);
    unset($_SESSION['usu_10']);
    unset($_SESSION['usu_11']);
    unset($_SESSION['usu_12']);
    unset($_SESSION['usu_13']);
    unset($_SESSION['usu_14']);
    unset($_SESSION['usu_15']);
    unset($_SESSION['usu_16']);
    unset($_SESSION['usu_17']);
    unset($_SESSION['usu_18']);

    unset($_SESSION['expire']);

    session_unset();
    session_destroy();
    
    header('Location: ../../');

    exit();
?>