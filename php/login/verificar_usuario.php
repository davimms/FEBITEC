<?php
    session_start();
    //Tira mensagens de erro do tipo (Notice)
    ini_set('display_errors', '0');
    //Confere se o usuário está logado
    if(!isset($_SESSION['usuario'])){
        header('location: ../login/login.php');
        session_destroy();
    }
?>