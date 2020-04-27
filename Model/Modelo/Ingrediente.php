<?php

class Ingrediente {
	
	private $id;
	private $nome_ingredientes;
	private $valor_ingredientes;
	private $id_produtos;
	private $status;
	
	
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