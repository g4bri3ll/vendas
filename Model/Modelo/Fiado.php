<?php

include 'C:\\xampp\htdocs\Controle_vendas\Model\Modelo\Pessoa.php';

class Fiado extends Pessoa{
	
	private $id;
	private $status;
	private $idCliente;
	private $dataCadastro;
	
	
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