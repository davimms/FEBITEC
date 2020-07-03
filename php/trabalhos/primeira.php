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

        <form id="contact" method="post" action="insere2.php">
        <label for="form_nivel">Grau de escolaridade:</label><br/>
        <br>
        <input 	type="radio" 
                id="form_nivel_1" 
                name="form_nivel"
                value="Fundamental" checked>
        <label for="form_nivel_1">Fundamental</label><br/>
        <br>		
        <input 	type="radio" 
                id="form_nivel_2" 
                name="form_nivel"
                value="Médio">
        <label for="form_nivel_2">Médio</label><br/>
        <br>
        <input 	type="radio" 
                id="form_nivel_3" 
                name="form_nivel"
                value="Médio-técnico">
        <label for="form_nivel_3">Médio-técnico</label><br/>
        <br>
        <input 	type="radio" 
                id="form_nivel_4" 
                name="form_nivel"
                value="Técnico">
        <label for="form_nivel_4">Técnico</label><br/>
        <br>
        <input 	type="radio" 
                id="form_nivel_5" 
                name="form_nivel"
                value="Graduação">
        <label for="form_nivel_5">Graduação</label><br/>
        <br>
        <input 	type="radio" 
                id="form_nivel_6" 
                name="form_nivel"
                value="Pós-graduação">
        <label for="form_nivel_6">Pós-graduação</label><br/>
        <br>

        <input type="submit" value="Próximo">
        </form>
</html>
