<?php

include_once 'C:\\xampp\htdocs\Controle_vendas\Conexao\Conexao.php';

class FormaPgtoDAO {

	private $conn = null;
	
	public function cadastrar(FormaPgto $fPgto) {
	
		try {

			$sql = "INSERT INTO forma_pgto (forma_pgto, status, porcetagem) VALUES ('" . $fPgto->setFormaPgto . "', '" . $fPgto->setStatus . "', '" . $fPgto->setPorcetagem . "')";
			
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

	//Cadastrar a forma de pagamento em um cliente especifico, vindo da tela de controllerFormaPgto.php
	public function cadastroEspecifico($idCliente, $idFormaPgto, $status, $data) {
	
		try {

			$sql = "INSERT INTO clientes_x_forma_pgto (id_cliente, id_forma_pgto, status, data_cadastro) VALUES ('" . $idCliente . "', '" . $idFormaPgto . "', '" . $status . "', '" . $data . "')";
			
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

	public function ListaFormaPgto(){
	
		$sql = "SELECT * FROM forma_pgto WHERE status LIKE 'Ativado'";
		
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

	//Verificar se existe alguém no metodo de pagamento
	/*
	public function verificarMetodoPgto(){
	
		$sql = "SELECT * FROM clientes_x_forma_pgto WHERE status LIKE 'Ativado'";
		
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
	*/

	public function verificaVinculo($idCliente, $idFormaPgto){
	
		$sql = "SELECT * FROM clientes_x_forma_pgto WHERE id_cliente = '".$idCliente."' AND id_forma_pgto = '".$idFormaPgto."' AND status LIKE 'Ativado'";
		
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

/*
	//Verificar a permissão de metodo de pagamentos
	public function validaMetodoPgto($idCliente){
	
		$sql = "SELECT * FROM clientes_x_forma_pgto WHERE id_cliente = '".$idCliente."' AND status LIKE 'Ativado'";
		
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
*/

	//Verificar se o cliente tem a permissão para compra com essa forma de pagamento, vindo da tela de pedidoSelecionado.php
	public function validaClientePagamento($idFormaPgto) {
	
		$sql = "SELECT * FROM clientes_x_forma_pgto WHERE id_forma_pgto = '".$idFormaPgto."' AND status LIKE 'Ativado'";
		
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
