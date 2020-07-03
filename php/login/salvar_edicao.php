<?php
    //Salvar edições na sua própria conta
    //Tira mensagens de erro do tipo (Notice)
    include_once( "verificar_usuario.php");
    include_once("../conexao.php");

    $email = $_POST['form_email'];
    $senha = $_POST['form_pass'];
    $nova_senha = md5($_POST['new_pass']);
    $id = $_SESSION['id'];
    $tipo = $_SESSION['tipo_de_usuario'];

    $verifica = "SELECT senha FROM usuario WHERE idUsuario = '$id'";

    $consulta= mysqli_query($conecta, $verifica);

    foreach ($consulta as $pass)
    {
        $senha_atual = $pass['senha'];
    }

    if($senha_atual == md5($senha) and $tipo == 1)
    {
        $sql = "UPDATE inscri_avaliadores SET email = '$email', senha = '$nova_senha' WHERE idAvaliador = $id";
        $sql2 = "UPDATE usuario SET email = '$email', senha = '$nova_senha' WHERE idUsuario = $id";
        echo "Alterações realizadas com sucesso";
    }
    if($senha_atual == md5($senha) and $tipo == 2)
    {
        $sql = "UPDATE inscri_alunos SET email = '$nova_senha', senha = '$senha' WHERE idAluno = $id";
        $sql2 = "UPDATE usuario SET email = '$email', senha = '$nova_senha' WHERE idUsuario = $id";
        echo "Alterações realizadas com sucesso";
    }
    $consulta2= mysqli_query($conecta, $sql);
    $consulta3= mysqli_query($conecta, $sql2);

    mysqli_close($conecta);
?>
