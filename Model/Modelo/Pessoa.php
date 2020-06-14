<?php

class Pessoa{

	function __construct() {

	}

	private $id;
	private $cpf;
	private $nome_pessoa;
	private $telefone;
	private $endereco;
	private $cidade;
	private $bairro;
	private $celular_1;
	private $celular_2;
	private $complemento;
	private $rg;
	private $senha;
	private $data_cadastro;
	private $token;
	private $status;
	private $email;
	private $foto;

	
	//Atribuir o set a todos os atributos
	public function __set($atrib, $value){
		$this->$atrib = $value;
	}
	
	//Atribuir o get a todos os atributos
	public function __get($atrib){
		return $this->$atrib;
	}

	//Retorna o ultimo id Cadastro na base de dados
	function ultimoIdPessoa(){

		//Retorna o ultimo ID do usuário
		$cliDAO = new clientesDAO();
		$arrayUltimoId = $cliDAO->ListaUltimaPessoa();

		$id = 0;
		foreach ($arrayUltimoId as $array => $value) {
			$id = $value['id'];
		}

		return $id;
	}
}

?>