<?php

//Aqui vai ter uma funcão para gerar emails aleatórios 
//Ela recebe um objeto aluno e o ponteiro pro começo do banco,  busca no
// banco e se encontrar, gera um array de e-mails e retorna esse array
function geraEmail($aluno, $ponteiro){
	$auxiliar = $ponteiro;
	$nomes = explode(" ", $aluno->nome); 
	$ok = FALSE;
	$contador = 1;
	$lista = array();
    //Opção 1 Primeira letra (ou mais) do primeiro nome + ultimo nome
	while(!$ok){
		$novo = substr($nomes[0], 0, $contador).$nomes[2].'@id.uff.br';
		
		if($ponteiro->existeUffm($novo)){
			
			$contador++;
			$auxiliar = $ponteiro;
		}
		else{
			$contador = 1;
			$ok = true;
			$lista[] = $novo;
			$auxiliar = $ponteiro;
		}
	}
	$ok = FALSE;

	//Opção 2: primeiroNome-últimoNome
	while(!$ok){
		$novo = $nomes[0].'-'.$nomes[2];
		if($ponteiro->existeUffm($novo)){
			$novo = $novo.$contador;
			$contador++;
			$auxiliar = $ponteiro;
		}
		else{
			$novo = $novo.'@id.uff.br';
			$contador = 1;
			$ok = true;
			$lista[] = $novo;
			$auxiliar = $ponteiro;
		}
	}
	$ok= FALSE;
	//Opção3: Primeira letra do primeiro nome + '.' + ultimo nome

	while(!$ok){
		$novo = substr($nomes[0], 0, $contador).'.'.$nomes[2];
		if($ponteiro->existeUffm($novo)){
			$novo = $novo.$contador;
			$contador++;
		}
		else{
			$novo = $novo.'@id.uff.br';
			$ok = true;
			$lista[] = $novo;
		}
	}
	return $lista;
}

// teremos aqui uma fuñção que recebe um array de e-mail e gera o HTML com os radio buttons

function listaDinamica($lista){
	
	for($i=0; $i<count($lista); $i++){
		echo  '<input type="radio" id="opcao'.$i.'" name ="uffm" value="'.$lista[$i].'"><label for="opcao'.$i.'"><fieldset>'.$lista[$i].'</fieldset></label>';
	}
}