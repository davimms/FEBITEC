<?php
    session_start();
    ini_set('display_errors', '0');
    //Conferir se o usuário está logado

    if(isset($_SESSION['usuario'] )){
        header('Location: ../../index2.php');
    die();
    }

    include_once("../conexao.php");

    if(isset($_POST['form_email'], $_POST['form_pass']) && $_POST['form_email'] != "" && $_POST['form_pass'] !=""){
        $email = $_POST['form_email'];
        $senha = md5($_POST['form_pass']);
        
        $sql = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
      
        $consulta = mysqli_query($conecta, $sql);

        $verificar = mysqli_num_rows($consulta); // retorna um número de registros do comando sql 
        if($verificar>0){
            foreach ($consulta as $id)
            {
                $_SESSION['id'] = $id['idUsuario']; //guarda o id do usuário que está realizando o login 
                $_SESSION['tipo_de_usuario'] = $id['tipo']; //Conferir se o usuário é Avaliador ou Aluno  
            }
            $_SESSION['usuario'] = true;
            mysqli_free_result($verificar); //Limpar variavel $verificar
            header('Location: ../../user/aluno-inicio.php');
        }
        else{
            echo "<p>O seu login ou senha estão incorretos</p>";
        }      
        mysqli_close($conecta);
        }
?>