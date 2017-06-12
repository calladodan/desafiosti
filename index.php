<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Cadastro UFFMail</title>
</head>
<header>Cadastro UFFMail</header>
<body>

<?php
	require 'db.php';
	require 'aluno.php';
	require 'functions.php';


	$ponteiro = new db("alunos.csv"); //Ponteiro pro banco de dados


	if (isset($_GET['matricula'])){ //Quando chega na página por alguma matrícula.

		$alu = $ponteiro->DBRead($_GET['matricula']);

		if(is_object($alu)){
		?>
		<form id="form" action="index.php" method="post" class="topBefore">
		Escolha alguma das opções abaixo para ser seu e-mail: <br>
		<?php 
		listaDinamica(geraEmail($alu, $ponteiro));

		?>
		<input type="hidden" name="matricula" value="<?=$alu->matricula?>">
		<input type="hidden" name="telefone" value="<?=$alu->telefone?>">

		<input id="submit" type="submit" value="Submit">
		</form>

<?php
		}
		else{

			echo '<p><H3>'.$alu.'</H3></p>';
		}
	}
	else if(isset($_POST['uffm']) && isset($_POST['matricula'])){
		//Aqui eu escrevo a mensagem de confirmação.
		
			echo '<p><h3> A criação do seu e-mail '.$_POST['uffm'].' será feita nos próximos minutos. <br> Um sms foi enviado para '.$_POST['telefone'].' com a sua senha de acesso.</h3></p>';
		
	}
	else{
?>
<form id="form" action="index.php" method="get" class="topBefore">
	Digite sua matrícula: <br>
	<input id="name" type="text" name="matricula" placeholder="Matrícula" required> <br>
	<input id="submit" type="submit" value="Submit">

</form>
<?php
}

?>
</body>
</html>
