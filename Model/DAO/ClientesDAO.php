<?php

include_once 'Conexao/Conexao.php';

class ClientesDAO {

	private $conn = null;
	
	public function cadastrarPessoas(Pessoa $pessoas) {
	
		try {
			
			$sql = "INSERT INTO pessoa (nome_pessoa, telefone, email, endereco, data_cadastro) VALUES ('" . $clientes->nome_pessoa . "', '" . $clientes->telefone . "', '" . $clientes->email . "', '" . $clientes->endereco . "', '" . $clientes->data_cadastro . "')";
			
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

	public function ListaClientes(){
	
		$sql = "SELECT * FROM clientes";
		
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

	//Lista ultimo cliente cadastrado
	public function ListaUltimoClientes(){
	
		$sql = "SELECT * FROM cliente ORDER BY id DESC LIMIT 1";
		
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
