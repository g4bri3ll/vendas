<?php

class ItensAdicionais{
	
	private $id;
	private $valorItem;
	private $nomeItem;
	private $status;
	private $dataCadastro;
	private $idLanche;
	private $fotos;
	private $qtd;
	private $idTempVendas;
	private $idCliente;

	
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