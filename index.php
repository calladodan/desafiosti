<!DOCTYPE html>
<html>
<head>
	<title>Cadastro UFFMail</title>
</head>
<body>

<?php
	require 'db.php';
	require 'aluno.php';
	require 'functions.php';


	$ponteiro = new db("alunos.csv");
	var_dump($ponteiro);

	if (isset($_GET['matricula'])){
		$valor = $_GET['matricula'];
		//Aqui eu quero pesquisar qual aluno tem matricula igual e colocar as opções de email para o usuario na tela.
		$alu = $ponteiro->DBReadMat($_GET['matricula']);
		var_dump($alu);
		?>
		<form action="index.php" method="post">
		Escolha alguma das opções abaixo para ser seu e-mail: <br>
		<?php 
		
		listaDinamica(geraEmail($alu, $ponteiro));

		?>
		<input type="submit" value="Submit">
		</form>

<?php
	}
	if(isset($_POST['uffm'])){
		
		
	}
?>
<form action="index.php" method="get">
	Digite sua matrícula: <br>
	<input type="text" name="matricula"> <br>
	<input type="submit" value="Submit">

</form>

</body>
</html>