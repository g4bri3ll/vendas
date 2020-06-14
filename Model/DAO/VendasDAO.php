<?php

include 'C:\\xampp\htdocs\Controle_vendas\Conexao\Conexao.php';

class VendasDAO {

	private $conn = null;
	
	//altera o status da tabela temp_vendas vindo da tela ControllerVendas.php
	public function finalizaVenda($status, $idTempVendas) {
		
		try {
			
			$sql = "UPDATE temp_vendas SET status='" . $status . "' WHERE id = '" . $idTempVendas . "'";
			
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

	//Excluir o lanche da tabela temp_vendas vindo da tela ControllerVendas.php
	public function excluirVenda($idTempVendas) {
		
		try {
			
			$sql = "DELETE FROM temp_vendas WHERE id = '" . $idTempVendas . "'";
			
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

}

?>
