<!--edita.PHP-->
<!DOCTYPE html>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
        <meta charset="UTF-8">
        <title>Zoo</title>
    </head>
    <body>
        <center>
        <a href="../index.php">
			<img src="../imgs/logo.png">
        </a>
        <?php
            include_once("../conexao.php");
            include_once("../login/verificar_usuario.php");
            if($_GET['id'])
            {
                $id = $_GET['id'];
                $sql = "SELECT * FROM inscri_trabalhos WHERE idTrabalho = '$id';";
                //CONSULTA PARA O REGISTRO A SER EDITADO
                $executa = mysqli_query($conecta,$sql);
                //SE A CONSULTA OCORRER NORMALMENTE
                if($executa == TRUE)
                {
                    //CRIA UM VETOR COM O RESULTADO DA SQL
                    $registro = mysqli_fetch_assoc($executa);
                }
                else
                {
                    echo"<p>Ocorreu um erro ao selecionar o registro</p>";
                    //INTERROMPE A EXECUÇÃO
                    exit;
                }
                $titulo = $registro['titulo'];
                $autor = $registro['nome'];
                $sql2 = "SELECT area FROM area_trab WHERE titulo_trab = '$titulo' and autor = '$autor';";
                $executa2 = mysqli_query($conecta,$sql2);
            }
            if($registro['nivel'] == 'Fundamental' or $registro['nivel'] == 'Médio')
            {
                echo "<p>Nome do autor principal e apresentador: ".$registro['nome'];
                echo "<p>Nome dos orientadores (separados por virgula): ".$registro['orientadores'];
                echo "<p>Demais membros do projeto (separados por virgula): ".$registro['membros'];
                echo "<p>Instituição de ensino/escola: ".$registro['instituicao'];
                echo "<p>Título do trabalho: ".$registro['titulo'];
                echo "<p>Palavras-chave (de 3 a 5, separados por virgula): ".$registro['palavra_chave'];
                echo "<p>Introdução: ".$registro['intro'];
                echo "<p>Métodos e/ou desenvolvimento: ".$registro['metodos_desen'];
                echo "<p>Conclusão: ".$registro['conclusao'];
                echo "<p>Referências ou nomes dos autores/obras consultadas: ".$registro['referencias'];
            }
            if($registro['nivel'] == 'Médio-técnico' or $registro['nivel'] == 'Técnico' or $registro['nivel'] == 'Graduação' or $registro['nivel'] == 'Pós-graduação')
            {
                echo "<p>Nome do autor principal e apresentador: ".$registro['nome'];
                echo "<p>Nome dos orientadores (separados por virgula): ".$registro['orientadores'];
                echo "<p>Demais membros do projeto (separados por virgula): ".$registro['membros'];
                echo "<p>Instituição de ensino/escola: ".$registro['instituicao'];
                echo "<p>Título do trabalho: ".$registro['titulo'];
                echo "<p>Palavras-chave (de 3 a 5, separados por virgula): ".$registro['palavra_chave'];
                echo "<p>Introdução: ".$registro['intro'];
                echo "<p>Objetivos: ".$registro['objetivos'];
                echo "<p>Materiais e métodos: ".$registro['materiais_metod'];
                echo "<p>Resultados ou resultados esperados: ".$registro['resultados'];
                echo "<p>Considerações finais: ".$registro['consideracoes'];
                echo "<p>Referências no formato APA: ".$registro['referencias'];
            }
            echo "<p>Área:";
            foreach ($executa2 as $reg)
            {
                echo "<p>".$reg['area'];
            }
            
        ?>
    </center>
    </body>
</html>