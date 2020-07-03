<?php
    //Fecha a sessão(conta) do usuário
    session_start();
    session_destroy();
    mysqli_close();
    header('location: login.php');
?>