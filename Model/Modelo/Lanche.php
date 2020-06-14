<?php

class Lanche {
	
	private $id;
	private $nome;
	private $valor;
	private $codigoBarra;
	private $idFornecedor;
	private $token;
	private $status;
	private $tipo;
	private $foto;
	private $qtd;
	private $idCliente;
	private $dataCadastro;
	private $dataCancelado;
	private $idFormaPgto;
	
	
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