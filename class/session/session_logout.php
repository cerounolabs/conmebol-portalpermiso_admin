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

    unset($_SESSION['expire']);

    session_unset();
    session_destroy();
    
    header('Location: ../../index.php');

    exit();
?>