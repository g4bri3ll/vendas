<?php

include_once 'C:\\xampp\htdocs\Controle_vendas\Conexao\Conexao.php';

class FornecedorDAO {

	private $conn = null;
	
	public function cadastrarFornecedor(Fornecedor $fornecedor) {
	
		try {

			$sql = "INSERT INTO fornecedor (id_pessoa, status, cnpj) VALUES ('" . $fornecedor->setIdPessoa . "', '" . $fornecedor->setStatus . "', '" . $fornecedor->setCnpj . "')";
			
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

	//Cadastro de pessoas
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

	//alterar os dados do fornecedor
	public function alterar(Fornecedor $for) {
		
		try {
			
			$sql = "UPDATE fornecedor SET nome_usuario='" . $usu->nome . "', apelido='" . $usu->apelido . "', 
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

	public function ListaFornecedores(){
	
		$sql = "SELECT f.id_pessoa, p.nome_pessoa FROM fornecedor f INNER JOIN pessoa p ON(f.id_pessoa = p.id) WHERE f.status LIKE 'Ativado'";
		
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
