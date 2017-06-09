<?php
class aluno{
	public $nome;
	public $matricula;
	public $telefone;
	public $email;
	public $uffmail;
	private $status;

	//Construtores da classe
	public function __construct ($linha){
		$this->nome= "$linha[0]";
		$this->matricula= "$linha[1]";
		$this->telefone = "$linha[2]";
		$this->email = "$linha[3]";
		$this->uffmail = "$linha[4]";
		$this->status = "$linha[5]";
	}




}

?>