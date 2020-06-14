<?php

include_once 'C:\\xampp\htdocs\Controle_vendas\Conexao\Conexao.php';

class IngredienteDAO {

	private $conn = null;
	
	public function cadastrar(Ingrediente $ingrediente) {
	
		try {

			$sql = "INSERT INTO ingredientes (nome_ingredientes, data_cadastro, status, id_lanche, qtd) VALUES ('" . $ingrediente->nome . "', '" . $ingrediente->dataCadastro . "', '" . $ingrediente->status . "', '" . $ingrediente->idLanche . "', '" . $ingrediente->qtd . "')";
			
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

	//Lista de ingredientes por lanches
	public function listaIngredientesPorLanche($idlanche) {
	
		$sql = "SELECT * FROM ingredientes WHERE id_lanche = '".$idlanche."' AND status LIKE 'Ativado'";
		
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
