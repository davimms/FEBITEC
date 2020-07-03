<!-- EDITA.PHP -->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<title>Zoo</title>
	</head>
	<body>
		<center>
		<a href="../index.php">
			<img src="../imgs/logo.png">
		</a>
<?php
		// CONECTA COM O BANCO DE DADOS
		include_once("../conexao.php");
		
		if($_GET['id']) {
			
			$id = $_GET['id'];
			// SE O FORMULÁRIO FOR SUBMETIDO
			if($_POST) {
				if(isset( $_POST['form_nome'], $_POST['form_ori'], $_POST['form_mem'], $_POST['form_inst'], $_POST['form_tit'], $_POST['form_pal'],
				   $_POST['form_intro'], $_POST['form_ref'])) {
					// ADICIONA O ARQUIVO DE CONEXÃO

					$erros = array();
					
					// ATRIBUI OS VALORES DO FORM PARA AS VARIÁVEIS
					$nome	              = filter_input(INPUT_POST, 'form_nome', FILTER_SANITIZE_SPECIAL_CHARS);

					$ori	  	          = filter_input(INPUT_POST, 'form_ori', FILTER_SANITIZE_SPECIAL_CHARS);

					$mem	  	          = filter_input(INPUT_POST, 'form_mem', FILTER_SANITIZE_SPECIAL_CHARS);

					$inst	              = filter_input(INPUT_POST, 'form_inst', FILTER_SANITIZE_SPECIAL_CHARS);

					$tit	  	  	  	  = filter_input(INPUT_POST, 'form_tit', FILTER_SANITIZE_SPECIAL_CHARS);

					$pal	  	  		  = filter_input(INPUT_POST, 'form_pal', FILTER_SANITIZE_SPECIAL_CHARS);

					$intro	  	  		  = filter_input(INPUT_POST, 'form_intro', FILTER_SANITIZE_SPECIAL_CHARS);
											if(strlen($intro) > 4000)
											{
												$erros[] = "Limite de caracteres na Introdução ultrapassado";
											}

					$metod	  	  		  = filter_input(INPUT_POST, 'form_metod', FILTER_SANITIZE_SPECIAL_CHARS);
											if(strlen($metod) > 4000)
											{
												$erros[] = "Limite de caracteres em Métodos e/ou desenvolvimento ultrapassado";
											}

					$conc	  	  		  = filter_input(INPUT_POST, 'form_conc', FILTER_SANITIZE_SPECIAL_CHARS);
											if(strlen($conc) > 2000)
											{
												$erros[] = "Limite de caracteres na Conclusão ultrapassado";
											}

					$ref	  	  		  = filter_input(INPUT_POST, 'form_ref', FILTER_SANITIZE_SPECIAL_CHARS);
											if(strlen($ref) > 1000)
											{
												$erros[] = "Limite de caracteres em Referências ultrapassado";
											}

					$obj	  	  		  = filter_input(INPUT_POST, 'form_obj', FILTER_SANITIZE_SPECIAL_CHARS);
											if(strlen($obj) > 2000)
											{
												$erros[] = "Limite de caracteres em Objetivos ultrapassado";
											}

					$mat	  	  		  = filter_input(INPUT_POST, 'form_mat', FILTER_SANITIZE_SPECIAL_CHARS);
											if(strlen($mat) > 4000)
											{
												$erros[] = "Limite de caracteres em Materias e Métodos ultrapassado";
											}
					
					$res	  	  		  = filter_input(INPUT_POST, 'form_res', FILTER_SANITIZE_SPECIAL_CHARS);
											if(strlen($res) > 4000)
											{
												$erros[] = "Limite de caracteres em Resultados ultrapassado";
											}
					
					$cons	  	  		  = filter_input(INPUT_POST, 'form_cons', FILTER_SANITIZE_SPECIAL_CHARS);
											if(strlen($cons) > 2000)
											{
												$erros[] = "Limite de caracteres em Considerações finais ultrapassado";
										}
					if(!empty($erros)){
						foreach($erros as $erro){
							echo "$erro<br>";
						}
					}else{
						$sql2 = "UPDATE inscri_trabalhos SET
								nome 	= '$nome',
								orientadores 	= '$ori',
								membros = '$mem',
								instituicao 	= '$inst',
								titulo   = '$tit',
								palavra_chave = '$pal',
								intro = '$intro',
								metodos_desen = '$metod',
								conclusao = '$conc',
								referencias = '$ref',
								objetivos = '$obj',
								materiais_metod = '$mat',
								resultados = '$res',
								consideracoes = '$cons'
								WHERE idTrabalho = '$id';";
						// EXECUTA A EDIÇÃO		
						$executa2 = mysqli_query($conecta,$sql2);
						// VERIFICA SE A EXECUÇÃO OCORREU SEM ERROS
						if($executa2 == TRUE) {
							echo "<p>Registro alterado com sucesso.</p>";
						} else {
							echo "<p>Ocorreu um erro ao alterar o registro</p>";
							echo "<p>".mysqli_error($conecta)."</p>";
						}
					}
				}
			}
				
			// CONSULTA PARA O REGISTRO A SER EDITADO
			$sql = "SELECT * FROM inscri_trabalhos WHERE idTrabalho = '$id';";
			// EXECUTA A CONSULTA
			$executa = mysqli_query($conecta,$sql);
			// SE A CONSULTA OCORRER NORMALMENTE
			if($executa == TRUE) {
				// CRIA UM VETOR COM O RESULTADO DA SQL
				$registro = mysqli_fetch_assoc($executa);
				//print_r($registro);
			} else {
				echo "<p>Ocorreu um erro ao selecionar o registro</p>";
				// INTERROMPE A EXECUÇÃO
				exit;
			}
			$trab = $registro['titulo'];
			$aut =$registro['nome'];
			// CONSULTA PARA O REGISTRO A SER EDITADO
			$sql3 = "SELECT area FROM area_trab WHERE titulo_trab = '$trab' and autor = '$aut';";
			$sql5 = mysqli_query($conecta,"SELECT area FROM area_trab WHERE titulo_trab = '$trab' and autor = '$aut'");
			// EXECUTA A CONSULTA
			$executa3 = mysqli_query($conecta,$sql3);
			// SE A CONSULTA OCORRER NORMALMENTE
			if($executa3 == TRUE) {
				// CRIA UM VETOR COM O RESULTADO DA SQL
				$registro2 = mysqli_fetch_assoc($executa3);
				//print_r($registro);
			} else {
				echo "<p>Ocorreu um erro ao selecionar o registro</p>";
				// INTERROMPE A EXECUÇÃO
				exit;
			}
			if($_POST)
			{
				if($_POST['form_area'] != "") 
				{
					$sql4 = mysqli_query($conecta, "DELETE FROM area_trab WHERE titulo_trab = '$trab' and autor ='$aut'");
					if(is_array($_POST['form_area']))
					{
						while(list($key,$value) = each($_POST['form_area']))
						{
							$sql2 = mysqli_query($conecta,"INSERT INTO area_trab
							(titulo_trab, autor, area)
							VALUES
							('$tit', '$nome', '$value')");
						}
					}
				}
			}
			
		}	
		
?>
		<h2>Editar Trabalhos</h2>
		
		<form id="contact" method="post" action="edita.php?id=<?=$registro['idTrabalho'];?>">

			<label for="form_nome">Nome do autor principal e apresentador:</label><br/>
			<input type="text" name="form_nome" id="form_nome" value="<?=$registro['nome'];?>" required><br/>

			<label for="form_ori">Nome dos orientadores (separados por virgula):</label><br/>
			<textarea name="form_ori" id="form_ori" required><?=$registro['orientadores'];?></textarea><br/>

			<label for="form_mem">Demais membros do projeto (separados por virgula):</label><br/>
			<textarea name="form_mem" id="form_mem"  required><?=$registro['membros'];?></textarea><br/>

			<label for="form_inst">Instituição de ensino/escola:</label><br/>
			<input type="text" name="form_inst" id="form_inst" value="<?=$registro['instituicao'];?>" required><br/>

			<label for="form_tit">Título do trabalho:</label><br/>
			<input type="text" name="form_tit" id="form_tit" value="<?=$registro['titulo'];?>" required><br/>

			<label for="form_pal">Palavras-chave (de 3 a 5, separados por virgula):</label><br/>
			<textarea name="form_pal" id="form_pal" required><?=$registro['palavra_chave'];?></textarea><br/>
			
			<?php
			if($registro['nivel'] == 'Fundamental' or $registro['nivel'] == 'Médio')
            {
				echo "<label for='form_intro'>Introdução:</label><br/>
					<textarea name='form_intro' id='form_intro' placeholder='Máximo de 4000 caractéres.' maxlength='4000' required>".$registro['intro']."</textarea><br/>";

				echo "<label for='form_metod'>Métodos e/ou desenvolvimento:</label><br/>
					<textarea name='form_metod' id='form_metod' placeholder='Máximo de 4000 caractéres.' maxlength='4000' required>".$registro['metodos_desen']."</textarea><br/>";

				echo "<label for='form_conc'>Conclusão:</label><br/>
					<textarea name='form_conc' id='form_conc' placeholder='Máximo de 2000 caractéres.' maxlength='2000' required>".$registro['conclusao']."</textarea><br/>";

				echo "<label for='form_ref'>Referências ou nomes dos autores/obras consultadas:</label><br/>
					<textarea name='form_ref'id='form_ref' placeholder='Máximo de 1000 caractéres.' maxlength='1000' required>".$registro['referencias']."</textarea><br/>";
            }
            if($registro['nivel'] == 'Médio-técnico' or $registro['nivel'] == 'Técnico' or $registro['nivel'] == 'Graduação' or $registro['nivel'] == 'Pós-graduação')
            {
				echo "<label for='form_intro'>Introdução:</label><br/>
					<textarea name='form_intro' id='form_intro' placeholder='Máximo de 4000 caractéres.' maxlength='4000' required>".$registro['intro']."</textarea><br/>";

				echo "<label for='form_obj'>Objetivos:</label><br/>
					<textarea name='form_obj' id='form_obj' placeholder='Máximo de 2000 caractéres.' maxlength='2000' required>".$registro['objetivos']."</textarea><br/>";

				echo "<label for='form_mat'>Materiais e métodos:</label><br/>
					<textarea name='form_mat' id='form_mat' placeholder='Máximo de 4000 caractéres.' maxlength='4000' required>".$registro['materiais_metod']."</textarea><br/>";

				echo"<label for='form_res'>Resultados ou resultados esperados:</label><br/>
					<textarea name='form_res' id='form_res' placeholder='Máximo de 4000 caractéres.' maxlength='4000' required>".$registro['resultados']."</textarea><br/>";

				echo"<label for='form_cons'>Considerações finais:</label><br/>
					<textarea name='form_cons' id='form_cons' placeholder='Máximo de 2000 caractéres.' maxlength='2000' required>".$registro['consideracoes']."</textarea><br/>";

				echo"<label for='form_ref'>Referências no formato APA:</label><br/>
					<textarea name='form_ref'id='form_ref' placeholder='Máximo de 1000 caractéres.' maxlength='1000' required>".$registro['referencias']."</textarea><br/>";
            }
			?>
			<label>Area: </label><br/>

			<label for="form_area">Linguagens, Códigos e suas Tecnologias</label><br/>
			<input type="checkbox" name="form_area[]" id="form_area" value="Linguagens, Códigos e suas Tecnologias" 
			
			<?php
				foreach ($sql5 as $check)
				{
					if($check['area'] == "Linguagens, Códigos e suas Tecnologias")
					{
						echo "checked";
					}
				}
			?>

			><br/>

			<label for="form_area2">Matemática e suas Tecnologias</label><br/>
			<input type="checkbox" name="form_area[]" id="form_area2" value="Matemática e suas Tecnologias" 
			
			<?php
				foreach ($sql5 as $check)
				{
					if($check['area'] == "Matemática e suas Tecnologias")
					{
						echo "checked";
					}
				}
			?>
			
			><br/>

			<label for="form_area3">Ciências da Natureza e suas Tecnologias</label><br/>
			<input type="checkbox" name="form_area[]" id="form_area3" value="Ciências da Natureza e suas Tecnologias"
			
			<?php
				foreach ($sql5 as $check)
				{
					if($check['area'] == "Ciências da Natureza e suas Tecnologias")
					{
						echo "checked";
					}
				}
			?>

			><br/>

			<label for="form_area4">Ciências Humanas e suas Tecnologias</label><br/>
			<input type="checkbox" name="form_area[]" id="form_area4" value="Ciências Humanas e suas Tecnologias"
			
			<?php
				foreach ($sql5 as $check)
				{
					if($check['area'] == "Ciências Humanas e suas Tecnologias")
					{
						echo "checked";
					}
				}
			?>
			
			 ><br/>

			<input type="submit">
			
		</form>
	</center>
	</body>
</html>
</html>