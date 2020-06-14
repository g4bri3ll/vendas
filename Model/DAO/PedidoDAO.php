<?php

include_once 'C:\\xampp\htdocs\Controle_vendas\Conexao\Conexao.php';

class PedidoDAO {

	private $conn = null;
	
	public function cadastrar(Pedido $pedidos) {
	
		try {

			$sql = "INSERT INTO pedido (id_clientes, id_lanches, n_pedido, valor_comprado, data_comprado, status, id_forma_pgto) VALUES ('" . $pedidos->idCliente . "', '" . $pedidos->idLanche . "', '" . $pedidos->nPedido . "', '" . $pedidos->valorComprado . "', '" . $pedidos->dataComprado . "', '" . $pedidos->status . "', '" . $pedidos->idFormaPgto . "')";
			
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

	//Altera o status do pedido, vindo da tela de painelVendedor.php
	public function alteraStatus($status, $idPedido) {
	
		try {

			$sql = "UPDATE pedidos SET status = '".$status."' WHERE id = '" . $idPedido . "'";
			
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

	//Altera o status do pedido, vindo da tela de painelVendedor.php
	public function fechaPedido($status, $dataFechado, $idPedido) {
	
		try {

			$sql = "UPDATE pedidos SET status = '".$status."', data_entregue = '".$dataFechado."' WHERE id = '" . $idPedido . "'";
			
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

	//Altera o status da tabela temp_vendas, vindo da tela painelVendedor.php
	public function finalizaPedidoTemp($status, $idPedido) {
	
		try {

			$sql = "UPDATE temp_vendas SET status = '".$status."' WHERE id_pedido = '" . $idPedido . "'";
			
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

	//Lista todos os pedidos
	public function ListaPedido(){
	
		$sql = "SELECT * FROM pedido";
		
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
