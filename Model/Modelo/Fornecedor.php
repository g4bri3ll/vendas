<?php

include 'C:\\xampp\htdocs\Controle_vendas\Model\Modelo\Pessoa.php';

class Fornecedor extends Pessoa{
	
	private $id;
	private $status;
	private $idPessoa;
	private $cnpj;
	
	
	//Atribuir o set a todos os atributos
	public function __set($atrib, $value){
		$this->$atrib = $value;
	}
	
	//Atribuir o get a todos os atributos
	public function __get($atrib){
		return $this->$atrib;
	}
	
}

?>