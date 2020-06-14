<?php

include_once 'C:\\xampp\htdocs\Controle_vendas\Conexao\Conexao.php';

class ClientesDAO {

	private $conn = null;
	
	public function cadastrarPessoas(Pessoa $pessoas) {
	
		try {

			$sql = "INSERT INTO pessoa (nome_pessoa, telefone, email, endereco, data_cadastro) VALUES ('" . $pessoas->nome_pessoa . "', '" . $pessoas->telefone . "', '" . $pessoas->email . "', '" . $pessoas->endereco . "', '" . $pessoas->data_cadastro . "')";
			
			$conn = new Conexao ();
			$conn->openConnect ();
			
			$mydb = mysqli_select_db ( $conn->getCon (), $conn->getBD());
			$resultado = mysqli_query ( $conn->getCon (), $sql );
			
			$conn->closeConnect ();
			
			return true;
			
		} catch ( PDOException $e ) {
			return false;
		}
		
	}

	public function cadastrarClientes(Cliente $clientes) {
	
		try {
			
			$sql = "INSERT INTO cliente (cracha, status, id_pessoa) VALUES ('" . $clientes->cracha . "', '" . $clientes->status . "', '" . $clientes->idPessoa . "')";
			
			$conn = new Conexao ();
			$conn->openConnect ();
			
			$mydb = mysqli_select_db ( $conn->getCon (), $conn->getBD());
			$resultado = mysqli_query ( $conn->getCon (), $sql );
			
			$conn->closeConnect ();
			
			return true;
			
		} catch ( PDOException $e ) {
			return false;
		}
		
	}

	//alterar os dados do usuario
	public function alterar(Usuario $usu) {
		
		try {
			
			$sql = "UPDATE usuario SET nome_usuario='" . $usu->nome . "', apelido='" . $usu->apelido . "', 
			email='" . $usu->email . "' WHERE id = '" . $usu->id . "'";
			
			$conn = new Conexao ();
			$conn->openConnect ();
			
			mysqli_select_db ( $conn->getCon (), $conn->getBD());
			$resultado = mysqli_query ( $conn->getCon (), $sql );
			
			$conn->closeConnect ();
			
			return true;
			
		} catch (PDOException $e) {
			
			return false;
			
		}
		
	}

	//Lista para configurarContaCliente.php
	public function ListaClientes(){
	
		$sql = "SELECT c.*, p.nome_pessoa FROM cliente c INNER JOIN pessoa p ON(c.id_pessoa = p.id) WHERE c.status LIKE 'Ativado'";
		
		$conn = new Conexao();
		$conn->openConnect();
		
		$mydb = mysqli_select_db($conn->getCon(), $conn->getBD());
		$resultado = mysqli_query($conn->getCon(), $sql);
		
		$conn->closeConnect ();
		
		$array = array();
		while ($row = mysqli_fetch_assoc($resultado)) {
			$array[]=$row;
		}
			
		return $array;
		
	}

	//Lista todos os clientes Ativos
	public function ListaClientesAtivos(){
	
		$sql = "SELECT c.*, p.nome_pessoa FROM pessoa p INNER JOIN cliente c ON(p.id = c.id_pessoa)";
		
		$conn = new Conexao();
		$conn->openConnect();
		
		$mydb = mysqli_select_db($conn->getCon(), $conn->getBD());
		$resultado = mysqli_query($conn->getCon(), $sql);
		
		$conn->closeConnect ();
		
		$array = array();
		while ($row = mysqli_fetch_assoc($resultado)) {
			$array[]=$row;
		}
			
		return $array;
		
	}

	//Lista ultima pessoa cadastrada
	public function ListaUltimaPessoa(){
	
		$sql = "SELECT * FROM pessoa ORDER BY id DESC LIMIT 1";
		
		$conn = new Conexao();
		$conn->openConnect();
		
		$mydb = mysqli_select_db($conn->getCon(), $conn->getBD());
		$resultado = mysqli_query($conn->getCon(), $sql);
		
		$conn->closeConnect ();
		
		$array = array();
		while ($row = mysqli_fetch_assoc($resultado)) {
			$array[]=$row;
		}
			
		return $array;
		
	}

	//Verificar se o cracha existe para o controller
	public function VerificarCracha($cracha){
	
		$sql = "SELECT * FROM cliente WHERE cracha LIKE '".$cracha."'";
		
		$conn = new Conexao();
		$conn->openConnect();
		
		$mydb = mysqli_select_db($conn->getCon(), $conn->getBD());
		$resultado = mysqli_query($conn->getCon(), $sql);
		
		$conn->closeConnect ();
		
		$array = array();
		while ($row = mysqli_fetch_assoc($resultado)) {
			$array[]=$row;
		}
			
		return $array;
		
	}

	//Lista os clientes para cadastrar os fiados cadastrarClienteFiados.php
	public function ListaClientesParaFiados(){
	
		$sql = "SELECT c.id as id_cliente, p.id, p.nome_pessoa FROM cliente c INNER JOIN pessoa p ON(c.id_pessoa = p.id) WHERE c.status LIKE 'Ativado'";
		
		$conn = new Conexao();
		$conn->openConnect();
		
		$mydb = mysqli_select_db($conn->getCon(), $conn->getBD());
		$resultado = mysqli_query($conn->getCon(), $sql);
		
		$conn->closeConnect ();
		
		$array = array();
		while ($row = mysqli_fetch_assoc($resultado)) {
			$array[]=$row;
		}
			
		return $array;
		
	}

	//Verificar se o cracha já foi cadastro na tabela de cliente, vindo da tela ControllerClientes.php
	public function validaCrachaCadastro($crachaPost) {
	
		$sql = "SELECT * FROM cliente WHERE cracha = '".$crachaPost."' AND status LIKE 'Ativado'";
		
		$conn = new Conexao();
		$conn->openConnect();
		
		$mydb = mysqli_select_db($conn->getCon(), $conn->getBD());
		$resultado = mysqli_query($conn->getCon(), $sql);
		
		$conn->closeConnect ();
		
		$array = array();
		while ($row = mysqli_fetch_assoc($resultado)) {
			$array[]=$row;
		}
			
		return $array;
		
	}

	//Lista todos os clientes Ativos para listaClientes.php
	public function ListaDeClientes(){
	
		$sql = "SELECT p.*, c.id as idd_cliente, c.cracha FROM pessoa p INNER JOIN cliente c ON(p.id = c.id_pessoa) WHERE c.status = 'Ativado'";
		
		$conn = new Conexao();
		$conn->openConnect();
		
		$mydb = mysqli_select_db($conn->getCon(), $conn->getBD());
		$resultado = mysqli_query($conn->getCon(), $sql);
		
		$conn->closeConnect ();
		
		$array = array();
		while ($row = mysqli_fetch_assoc($resultado)) {
			$array[]=$row;
		}
			
		return $array;
		
	}

}

?>
