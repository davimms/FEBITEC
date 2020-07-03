<!-- CONSULTA.PHP -->
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
	// ADICIONA O ARQUIVO DE CONEXÃO
	include_once("../conexao.php");
	include_once("../login/verificar_usuario.php");
	$id = $_SESSION['id'];
	
	// CRIA A CLÁUSULA DE CONSULTA EM SQL (seleciona)
	$sql = "SELECT idTrabalho,nome,titulo FROM inscri_trabalhos WHERE idUsuario = '$id';";
	// EXECUTA A CLÁUSULA
	$resultado = mysqli_query($conecta,$sql);
	// IMPRIME O VETOR DA CONSULTA EM TELA
	//print_r($resultado);
	
?>
		<h2>Trabalhos</h2>
		<table class= "greenTable">
			<thead>
				<tr>
					<th>Autor principal</th>
					<th>Título do trabalho</th>
				</tr>
			</thead>
			<tbody>
				<?php
				// PARA CADA LINHA DA CONSULTA USA COMO REGISTRO
				foreach($resultado as $registro) {
				?>
				<tr>
					<td><?= $registro['nome']; ?></td>
					<td><?= $registro['titulo']; ?></td>
					<td><a href="ver.php?id=<?= $registro['idTrabalho'];?>">Ver</a></td>
					<td>
						<a href="edita.php?id=<?=$registro['idTrabalho'];?>">Editar</a> / 
						<a href="deleta.php?id=<?=$registro['idTrabalho'];?>">Deletar</a> 
					</td>
				</tr>
				<?php
				}
				?>
			</tbody>
		</table>
		</center>
	</body>
</html>

