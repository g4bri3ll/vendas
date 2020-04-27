<?php

class Produto {
	
	private $id;
	private $nome_produtos;
	private $valor_produtos;
	private $codigo_barra;
	private $id_fornecedor;
	private $token;
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