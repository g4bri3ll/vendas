<?php

class Cliente extends Pessoa{
	
	private $id;
	private $cracha;
	private $status;
	private $idPessoa;
	
	
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