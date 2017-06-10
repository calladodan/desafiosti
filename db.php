<?php 

class db{

	private $linha;
	private $handle; //Ponteiro fixo para o inicio do arquivo (NÃO ALTERAR)

	public function __construct ($arquivo){

		if(($this->handle = fopen("$arquivo", "r+")) !== FALSE){
			$this->linha = fgetcsv($this->handle,500, ",");
		}
	}

	public function DBRead($mat){ //Optei por não fazer escalável. Estarei supondo que a matrícula sempre estará na posição 1 do array 
	//Recebe a matrícula deseja e retorna um objeto aluno
		$atual = $this->handle;
		while (($this->linha = fgetcsv($atual,500, ","))){
			if($this->linha[1]=="$mat" && $this->linha[5]=='Ativo'){
				return new aluno($this->linha);
			}
		}
		return FALSE;
	}

	public function existeUffm($uffm){ //Diz se já existe o uffmail no banco
		$atual = $this->handle;
		while (($this->linha = fgetcsv($atual,500, ","))){
			if($this->linha[4]=="$uffm"){
				var_dump($this->linha);
				return TRUE;
			}
		}
		return FALSE;

	}

//Pesquisar no arquivo qual linha possui a matricula igual
//checa se já tem algum uffmail associado
//se NÃO tiver, atualiza e retorna TRUE
//se tiver, não atualiza e retorna FALSE
	public function DBUpdate($mat, $uffm){
		$atual = $this->handle;

		while(($this->linha = fgetcsv($atual,500, ","))){

			if($this->linha[1]== $mat && $this->linha[4]==''){
				return TRUE;
			}
		}
		return FALSE;
	}


		
	}
