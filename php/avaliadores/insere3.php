<html>
<head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Agency - Start Bootstrap Theme</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../../css/styles.css" rel="stylesheet" />
    </head>
</html>
<?php
		// SE O FORMULÁRIO FOI SUBMETIDO
		if($_POST) {
			// ADICIONA O ARQUIVO DE CONEXÃO
			include_once("../conexao.php");
			
			$erros = array();

			// ATRIBUI OS VALORES DO FORM PARA AS VARIÁVEIS
			$nome	              = filter_input(INPUT_POST, 'form_nome', FILTER_SANITIZE_SPECIAL_CHARS);

			$email	  	          = filter_input(INPUT_POST, 'form_email', FILTER_SANITIZE_EMAIL);
									if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
										$erros[] = "Email inválido";
									}
			$senha	  	          = md5($_POST['form_pass']);

			$num_doc	          = filter_input(INPUT_POST, 'form_num', FILTER_SANITIZE_SPECIAL_CHARS);

			$instituicao	  	  = filter_input(INPUT_POST, 'form_inst', FILTER_SANITIZE_SPECIAL_CHARS);

			$graduacao	  	      = filter_input(INPUT_POST, 'form_grad', FILTER_SANITIZE_SPECIAL_CHARS);

			$pos_grad	  	      = filter_input(INPUT_POST, 'form_pos', FILTER_SANITIZE_SPECIAL_CHARS);

			$outras_form	  	  = filter_input(INPUT_POST, 'form_outra', FILTER_SANITIZE_SPECIAL_CHARS);

			$avaliador	  	  	  = $_POST['form_ava'];

			if(!empty($erros)){
				foreach($erros as $erro){
					echo "<div class='alert alert-danger'> <strong>Erro!</strong>".$erro."</div>";	
				}
			}else{
				// CRIA A CLÁUSULA SQL
				$sql = "INSERT INTO inscri_avaliadores
				(nome,email,senha,num_doc,avaliador,instituicao,graduacao,pos_grad,outras_form)
				VALUES
				('$nome', '$email', '$senha', '$num_doc', '$avaliador', '$instituicao', '$graduacao', '$pos_grad', '$outras_form');";

				if($_POST['form_area'] != "") 
				{
					if(is_array($_POST['form_area']))
					{
						while(list($key,$value) = each($_POST['form_area']))
						{
							$sql2 = mysqli_query($conecta,"INSERT INTO area_inter
							(nome_ava, area)
							VALUES
							('$nome', '$value')");
						}
					}
				}

				// EXECUTAR A CLÁUSULA SQL
				$executa = mysqli_query($conecta,$sql);

				$sql3 =  "SELECT idAvaliador FROM inscri_avaliadores WHERE email = '$email' and senha = '$senha' and num_doc = '$num_doc'";

				$executa2 = mysqli_query($conecta,$sql3);

				foreach($executa2 as $idUser)
				{
					$idU = $idUser['idAvaliador']; 
					$sql4 = "INSERT INTO usuario 
							(idUsuario, email, senha, tipo)
							VALUES
							('$idU', '$email','$senha',1);";
				}
				
				$executa3 = mysqli_query($conecta,$sql4);

				// TESTA SE A EXECUÇÃO FUNCIONA
				if($executa == TRUE and $sql2 == TRUE and $executa2 == TRUE and $executa3 == TRUE) {
					header('location: ../../sucesso.html');
				} else {
					echo "<p>Ocorreu um erro ao efetuar o registro.</p>";
					echo mysqli_error($conecta);
				}
			}
		}
