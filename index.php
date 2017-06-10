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


	$ponteiro = new db("alunos.csv"); //Ponteiro pro banco de dados


	if (isset($_GET['matricula'])){ //Quando chega na página por alguma matrícula válida

		//Aqui eu quero pesquisar qual aluno tem matricula igual e colocar as opções de email para o usuario na tela.

		if($alu = $ponteiro->DBRead($_GET['matricula'])){
		?>
		<form action="index.php" method="post">
		Escolha alguma das opções abaixo para ser seu e-mail: <br>
		<?php 
		listaDinamica(geraEmail($alu, $ponteiro));

		?>
		<input type="hidden" name="matricula" value="<?=$alu->matricula?>">
		<input type="hidden" name="telefone" value="<?=$alu->telefone?>">
		<input type="submit" value="Submit">
		</form>

<?php
	}
	else{
		echo 'Matrícula não encontrada. Clique <a href="index.php">aqui</a> para voltar ao início.';
	}
	}
	else if(isset($_POST['uffm']) && isset($_POST['matricula'])){
		//Aqui eu escrevo a mensagem de confirmação e faço a alteração no arquivo CSV
		//Aqui falta fazer o controle se já  existe ou não uffmail

		if($ponteiro->DBUpdate($_POST['matricula'], $_POST['uffm'])){
		
			echo 'A criação do seu e-mail '.$_POST['uffm'].' será feita nos próximos minutos. Um sms foi enviado para '.$_POST['telefone'].' com a sua senha de acesso.';
		}
		else{
			echo 'Não foi possível criar um e-mail. O aluno já possui uffmail cadastrado.';
		}
	}
	else{
?>
<form action="index.php" method="get">
	Digite sua matrícula: <br>
	<input type="text" name="matricula" required> <br>
	<input type="submit" value="Submit">

</form>
<?php
}
?>
</body>
</html>