<?php

include_once 'C:\\xampp\htdocs\Controle_vendas\Conexao\Conexao.php';

class FiadoDAO {

	private $conn = null;
	
	public function cadastrar(Fiado $f) {
	
		try {

			$sql = "INSERT INTO clientes_fiado (id_cliente, status, data_cadastro) VALUES ('" . $f->idCliente . "', '" . $f->status . "', '" . $f->dataCadastro . "')";
			
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

	public function ListaClientesFiados(){
	
		$sql = "SELECT * FROM fiados_cliente WHERE status LIKE 'Ativado'";
		
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
