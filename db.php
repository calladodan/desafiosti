<?php 

class db{

	private $linha;
	private $handle;

	public function __construct ($arquivo){

		if(($this->handle = fopen("$arquivo", "r")) !== FALSE){
			$this->linha = fgetcsv($this->handle,500, ",");
		}
	}

	public function DBReadMat($mat){ //Optei por não fazer escalável. Estarei supondo que a matrícula sempre estará na posição 1 do array 
	//Recebe a matrícula deseja e retorna um objeto aluno
		while (($this->linha = fgetcsv($this->handle,500, ","))){
			if($this->linha[1]=="$mat" && $this->linha[5]=='Ativo'){
				return new aluno($this->linha);
			}
		}
		return FALSE;
	}

	public function existeUffm($uffm){ //Diz se já existe o uffmail no banco

		while (($this->linha = fgetcsv($this->handle,500, ","))){
			if($this->linha[4]=="$uffm"){
				return TRUE;
			}
		}
		return FALSE;

	}


	public function DBUpdate($mat, $uffm){
		while (($this->linha = fgetcsv($this->handle,500, ","))){
			if($this->linha[1]=="$mat"){
				$this->linha[4] = "$uffm";
				return TRUE;
			}
		}
		return FALSE;
	}
}