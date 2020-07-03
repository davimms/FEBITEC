<!-- INSERE.PHP -->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<title>Teste</title>
	</head>
	<body>
		<center>
		<a href="../index.php">
			<img src="../imgs/logo.png">
		</a>
		<br>
		<br>
<?php
		$nivel = $_POST['form_nivel'];

		include_once("funcao.php");
		include_once("../login/verificar_usuario.php");

		$id = $_SESSION['id'];
		
		$verifica = verifica($_POST['form_nivel']);
		
		// SE O FORMULÁRIO FOI SUBMETIDO
		if(isset( $_POST['form_nome'], $_POST['form_ori'], $_POST['form_mem'], $_POST['form_inst'], $_POST['form_tit'], $_POST['form_pal'],
				   $_POST['form_intro'], $_POST['form_ref'])) {
			// ADICIONA O ARQUIVO DE CONEXÃO
			include_once("../conexao.php");

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
			// CRIA A CLÁUSULA SQL

			if(!empty($erros)){
				foreach($erros as $erro){
					echo "$erro<br>";
				}
			}else{
				$sql = "INSERT INTO inscri_trabalhos
				(idUsuario,nivel,nome, orientadores, membros, instituicao, titulo, palavra_chave, intro, metodos_desen, conclusao, referencias, objetivos,
				 materiais_metod, resultados, consideracoes)
				VALUES
				('$id','$nivel','$nome', '$ori', '$mem', '$inst', '$tit', '$pal', '$intro', '$metod', '$conc', '$ref', '$obj', '$mat', '$res', '$cons');";

				if($_POST['form_area'] != "") 
				{
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

				// EXECUTAR A CLÁUSULA SQL
				$executa = mysqli_query($conecta,$sql);
				
				// TESTA SE A EXECUÇÃO FUNCIONA
				if($executa == TRUE and $sql2 == TRUE) {
					echo "<p>Registro efetuado com sucesso.</p>";
				} else {
					echo "<p>Ocorreu um erro ao efetuar o registro.</p>";
					echo mysqli_error($conecta);
				}
			}
		}
?>
		
		<form id="contact" method="post" action="insere2.php">

			<label for="form_nome">Nome do autor principal e apresentador:</label><br/>
			<input type="text" name="form_nome" id="form_nome" required><br/>

			<input type='hidden' name='form_nivel' value="<?=$nivel?>">

			<label for="form_ori">Nome dos orientadores (separados por virgula):</label><br/>
			<textarea name="form_ori" id="form_ori" placeholder="Ex.: Mariana, Rafael, ..." required></textarea><br/>

			<label for="form_mem">Demais membros do projeto (separados por virgula):</label><br/>
			<textarea name="form_mem" id="form_mem" placeholder="Ex.: José, Grabriele, ..." required></textarea><br/>

			<label for="form_inst">Instituição de ensino/escola:</label><br/>
			<input type="text" name="form_inst" id="form_inst" required><br/>

			<label for="form_tit">Título do trabalho:</label><br/>
			<input type="text" name="form_tit" id="form_tit" required><br/>

			<label for="form_pal">Palavras-chave (de 3 a 5, separados por virgula):</label><br/>
			<textarea name="form_pal" id="form_pal" placeholder="Ex.: Internet, Marketing, ..." required></textarea><br/>

			<?php
			if($verifica == 1)
			{
				echo "<label for='form_intro'>Introdução:</label><br/>
						<textarea name='form_intro' id='form_intro' placeholder='Máximo de 4000 caractéres.' maxlength='4000' required></textarea><br/>

						<label for='form_metod'>Métodos e/ou desenvolvimento:</label><br/>
						<textarea name='form_metod' id='form_metod' placeholder='Máximo de 4000 caractéres.' maxlength='4000' required></textarea><br/>

						<label for='form_conc'>Conclusão:</label><br/>
						<textarea name='form_conc' id='form_conc' placeholder='Máximo de 2000 caractéres.' maxlength='2000' required></textarea><br/>

						<label for='form_ref'>Referências ou nomes dos autores/obras consultadas:</label><br/>
						<textarea name='form_ref'id='form_ref' placeholder='Máximo de 1000 caractéres.' maxlength='1000' required></textarea><br/>";
			}
			if($verifica == 2)
			{
				echo "<label for='form_intro'>Introdução:</label><br/>
						<textarea name='form_intro' id='form_intro' placeholder='Máximo de 4000 caractéres.' maxlength='4000' required></textarea><br/>

						<label for='form_obj'>Objetivos:</label><br/>
						<textarea name='form_obj' id='form_obj' placeholder='Máximo de 2000 caractéres.' maxlength='2000' required></textarea><br/>

						<label for='form_mat'>Materiais e métodos:</label><br/>
						<textarea name='form_mat' id='form_mat' placeholder='Máximo de 4000 caractéres.' maxlength='4000' required></textarea><br/>

						<label for='form_res'>Resultados ou resultados esperados:</label><br/>
						<textarea name='form_res' id='form_res' placeholder='Máximo de 4000 caractéres.' maxlength='4000' required></textarea><br/>

						<label for='form_cons'>Considerações finais:</label><br/>
						<textarea name='form_cons' id='form_cons' placeholder='Máximo de 2000 caractéres.' maxlength='2000' required></textarea><br/>

						<label for='form_ref'>Referências no formato APA:</label><br/>
						<textarea name='form_ref'id='form_ref' placeholder='Máximo de 1000 caractéres.' maxlength='1000' required></textarea><br/>";
			}
				
			?>
			
			<label>Area: </label><br/>

			<label for="form_area">Linguagens, Códigos e suas Tecnologias</label><br/>
			<input type="checkbox" name="form_area[]" id="form_area" value="Linguagens, Códigos e suas Tecnologias" checked ><br/>

			<label for="form_area2">Matemática e suas Tecnologias</label><br/>
			<input type="checkbox" name="form_area[]" id="form_area2" value="Matemática e suas Tecnologias"><br/>

			<label for="form_area3">Ciências da Natureza e suas Tecnologias</label><br/>
			<input type="checkbox" name="form_area[]" id="form_area3" value="Ciências da Natureza e suas Tecnologias"><br/>

			<label for="form_area4">Ciências Humanas e suas Tecnologias</label><br/>
			<input type="checkbox" name="form_area[]" id="form_area4" value="Ciências Humanas e suas Tecnologias"><br/>

			<input type="submit">
			
		</form>
		</center>
	</body>
</html>