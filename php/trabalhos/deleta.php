<!-- DELETA.PHP -->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<title>IFZOO</title>
	</head>
	<body>
		<center>
		<a href="../index.php">
			<img src="../imgs/logo.png">
		</a>
<?php
		// SE EXISTE UM ID NO LINK
		if($_GET['id']) {
			
			$id = $_GET['id'];
			
			// ADICIONA O ARQUIVO DE CONEXÃO
			include_once("../conexao.php");
			
			// CRIA A CLÁUSULA SQL
			$sql = "DELETE FROM inscri_trabalhos WHERE idTrabalho = '$id';";
					
			// EXECUTAR A CLÁUSULA SQL
			$executa = mysqli_query($conecta,$sql);
			
			// TESTA SE A EXECUÇÃO FUNCIONA
			if($executa == TRUE) {
				echo "<p>Registro deletado com sucesso.</p>";
				header('Location:consulta.php');
			} else {
				echo "<p>Ocorreu um erro ao deletar o registro.</p>";
				/*echo "<p>".mysqli_error($conecta)."</p>";*/
			}
		}
?>
	</center>
	</body>
</html>