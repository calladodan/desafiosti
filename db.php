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
			if($this->linha[1]=="$mat") {
				if ($this->linha[5]=='Ativo'){
					if($this->linha[4]==''){
						return new aluno($this->linha); //Caso de tudo dar certo
					}
					else{
						return 'Usuário já possui UFFmail associado. clique <a href="index.php">aqui</a> para voltar ao início.'; //Caso onde a matrícula é igual, o usuário está ativo, mas já possui UFFMail 
					}
				}
				else{
					return 'Usuário inativo, favor entrar em contato com a Coordenação do seu curso ou clique <a href="index.php">aqui</a> para voltar ao início.';
				}
			}
		}
		return 'Matrícula não encontrada. Clique <a href="index.php">aqui</a> para voltar ao início.';
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

}