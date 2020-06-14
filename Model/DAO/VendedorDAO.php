<?php

include 'C:\\xampp\htdocs\Controle_vendas\Conexao\Conexao.php';

class ClientesDAO {

	private $conn = null;
	
	public function cadastrarPessoas(Pessoa $pessoas) {
	
		try {

			$sql = "INSERT INTO pessoa (nome_pessoa, telefone, email, endereco, data_cadastro) VALUES ('" . $pessoas->setNome_pessoa . "', '" . $pessoas->setTelefone . "', '" . $pessoas->setEmail . "', '" . $pessoas->setEndereco . "', '" . $pessoas->setData_cadastro . "')";
			
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
			
			$sql = "INSERT INTO cliente (cracha, status, id_pessoa) VALUES ('" . $clientes->setCracha . "', '" . $clientes->setStatus . "', '" . $clientes->setIdPessoa . "')";
			
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
	
}

?>
