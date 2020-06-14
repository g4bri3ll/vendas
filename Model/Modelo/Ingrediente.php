<?php

class Ingrediente{
	
	private $id;
	private $nome;
	private $status;
	private $dataCadastro;
	private $idLanche;
	private $qtd;
	

	
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