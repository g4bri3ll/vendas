<?php

class Favorito {
	
	private $id;
	private $status;
	private $idCliente;
	private $dataCadastro;
	private $codigo;
	private $idPedido;
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