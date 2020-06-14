<?php

include_once 'C:\\xampp\htdocs\Controle_vendas\Conexao\Conexao.php';

class FavoritosDAO {

	private $conn = null;
	
	public function cadastrar($idCliente, $status, $data, $qtd) {
	
		try {

			$sql = "INSERT INTO favoritos (id_cliente, status, data_cadastro, qtd) VALUES ('" . $idCliente . "', '" . $status . "', '" . $data . "', '" . $qtd . "')";
			
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

	public function salvaFavoritos(Favorito $favorito) {
	
		try {

			$sql = "INSERT INTO clientes_x_favoritos (id_cliente, status, data_cadastro, id_pedido, codigo) VALUES ('" . $favorito->idCliente . "', '" . $favorito->status . "', '" . $favorito->dataCadastro . "', '" . $favorito->idPedido . "', '" . $favorito->codigo . "')";
			
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

	//Excluir o favorito do cliente, vindo da tela do controllerPedido.php
	public function excluirFavorito($idFavorito) {
		
		try {

			$sql = "DELETE FROM clientes_x_favoritos WHERE id = '".$idFavorito."'";
		
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

	//Verificar se o cliente já foi cadastro nos favoritos para tela configClientesXFavoritos.php
	public function listaCadFavoritos($idCliente){
	
		$sql = "SELECT * FROM favoritos WHERE id_cliente = '".$idCliente."' AND status = 'Ativado'";
		
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

	//Verificar se o cliente tem quantidade de favoritos para a tela finalizarPedido.php
	public function verificaQtdFav($idCliente) {
	
		$sql = "SELECT COUNT(cf.id_cliente) as qtd_cliente, cf.*, c.cracha, f.qtd, f.id_cliente, c.id FROM cliente c LEFT JOIN clientes_x_favoritos cf ON(c.id = cf.id_cliente) LEFT JOIN favoritos f ON(c.id = f.id_cliente) WHERE c.id = '".$idCliente."' AND c.status = 'Ativado'";
		
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

	//Verificar se o cliente tem quantidade de favoritos para a tela finalizarPedido.php
	public function verificaCodigo($codigo) {
	
		$sql = "SELECT * FROM clientes_x_favoritos WHERE codigo = '".$codigo."' AND status = 'Ativado'";
		
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

	//Verificar se o codigo do favorito existe e encaminhar para a tela de controllerPedidos.php
	public function validaFavorito($codigo) {
	
		$sql = "SELECT l.nome, tv.*, c.cracha, c.id as table_id_cliente FROM clientes_x_favoritos cf INNER JOIN pedidos p ON(cf.id_pedido = p.id) INNER JOIN temp_vendas tv ON(p.id = tv.id_pedido) INNER JOIN lanche l ON(tv.id_lanche = l.id) INNER JOIN cliente c ON(cf.id_cliente = c.id) WHERE cf.codigo = '".$codigo."' AND cf.status = 'Ativado'";
		
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

	//lista de favoritos pelo cracha do funcionario para a tela acompanharPedidos.php
	public function listaFavoritosPeloCracha($cracha) {
	
		$sql = "SELECT cf.* FROM clientes_x_favoritos cf INNER JOIN cliente c ON(cf.id_cliente = c.id) WHERE c.cracha = '".$cracha."' AND cf.status = 'Ativado' ORDER BY cf.id DESC";
		
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

	//lista de lanches pelo cracha do funcionario para a tela acompanharPedidos.php
	public function listaLanchesPeloFavoritos($codigo) {
	
		$sql = "SELECT cf.id, l.valor, cf.codigo, l.nome FROM clientes_x_favoritos cf INNER JOIN cliente c ON(cf.id_cliente = c.id) INNER JOIN pedidos p ON(cf.id_pedido = p.id) INNER JOIN temp_vendas tv ON(p.id = tv.id_pedido) INNER JOIN lanche l ON(tv.id_lanche = l.id) WHERE cf.codigo = '".$codigo."' AND cf.status = 'Ativado' ORDER BY cf.id DESC";
		
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
