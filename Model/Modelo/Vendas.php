<?php

class Vendas {
	
	private $id;
	private $id_vendedor;
	private $id_cliente;
	private $id_produto;
	private $valor_comprado;
	private $data_comprado;
	private $id_forma_pgto;
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