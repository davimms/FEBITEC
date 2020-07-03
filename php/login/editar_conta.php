<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Editar Conta</title>
    </head>
    <body>
        <h1>Editar Conta</h1>
        <form action='salvar_edicao.php' method='post'>
        <?php
            include_once("../conexao.php");
            include_once("verificar_usuario.php");

            $id = $_SESSION['id']; //Pega o id da sessão iniciada no Login
            $sql = "SELECT * FROM usuario WHERE idUsuario = '$id'";
            $consulta = mysqli_query($conecta, $sql);
            foreach ($consulta as $login){
                echo "<label for='form_email'>Email:</label>
                <input type='text' name='form_email' value='",$login['email'],"' required>";
            }
        ?> 
            <br>
            <label for='form_pass'>Senha Atual:</label>
            <input type='text' name='form_pass' required>
            <br>
            <label for='new_pass'>Nova Senha:</label>
            <input type='text' name='new_pass' required>
            <br>
            <input type='submit' value='Enviar'><br/>
        </form>
    </body>
</html>