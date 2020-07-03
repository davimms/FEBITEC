<!-- CONEXAO.PHP -->
<?php

	// CREDENCIAIS DE ACESSO AO BANCO DE DADOS
	$local 	= "localhost"; 
	$user	= "root";
	$pass	= "";
	$base	= "febitec";

	// EXECUTA CONEXÃO COM O BANCO DE DADOS
	$conecta = mysqli_connect($local,$user,$pass,$base);
	
	// VERIFICA SE A CONEXÃO POSSUI ALGUM ERRO
	if(mysqli_connect_errno()) {
		// IMPRIME EM TELA O NÚMERO DO ERRO
		echo mysqli_connect_errno();
		echo "Ocorreu um erro ao conectar com o banco de dados";
		// INTERROMPE A EXECUÇÃO
		exit;
	// SE NÃO HOUVER QUALQUER ERRO
	} else {
		// echo "Tudo certo...";
		
		// CORRIGE A ACENTUAÇÃO DO BANCO DE DADOS
		mysqli_query($conecta,"SET NAMES 'utf8'");
	}
 
?>


