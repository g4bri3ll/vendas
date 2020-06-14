<?php

include_once 'C:\\xampp\htdocs\Controle_vendas\Conexao\Conexao.php';

class ItensAdicionalDAO {

	private $conn = null;
	
	public function cadastrar(ItensAdicionais $itens) {
	
		try {

			$sql = "INSERT INTO itens_adicionais (nome_item, valor_item, status, data_cadastro, id_lanche, foto) VALUES ('" . $itens->nomeItem . "', '" . $itens->valorItem . "', '" . $itens->status . "', '" . $itens->dataCadastro . "', '" . $itens->idLanche . "', '" . $itens->foto . "')";
			
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

	//Adicionar item no lanche comprado vindo da tela de controllerPedido.php e adicionarItensLanches
	public function adicionarItensLanche(ItensAdicionais $itens) {
	
		try {

			$sql = "INSERT INTO adicionar_item_lanche (id_temp_vendas, id_itens_adicionais, status, data_cadastro, id_cliente, qtd) VALUES ('" . $itens->idTempVendas . "', '" . $itens->id . "', '" . $itens->status . "', '" . $itens->dataCadastro . "', '" . $itens->idCliente . "', '" . $itens->qtd . "')";
			
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

	public function excluirItemAdd($idItem){
	
		try {

			$sql = "DELETE FROM adicionar_item_lanche WHERE id = '".$idItem."'";
			
			$conn = new Conexao();
			$conn->openConnect();
			
			$mydb = mysqli_select_db($conn->getCon(), $conn->getBD());
			$resultado = mysqli_query($conn->getCon(), $sql);
			
			$conn->closeConnect ();
			
			return true;
			
		} catch ( PDOException $e ) {
			return false;
		}
		
	}

	public function listaItensAdicionais(){
	
		$sql = "SELECT * FROM itens_adicionais WHERE status = 'Ativado'";
		
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

	//Lista todos os item adicionais pelo id do lanche selecionado da tela adicionarItensLanches.php
	public function listaItensAdd($itemAdd){
	
		$sql = "SELECT l.nome, ia.*, tv.id as id_temp_vendas FROM itens_adicionais ia INNER JOIN temp_vendas tv ON(ia.id_lanche = tv.id_lanche) INNER JOIN lanche l ON(tv.id_lanche = l.id) WHERE tv.id = '".$itemAdd."'";
		
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

	//Lista os itens adicionado na compra, para a tela finalizarPedido
	public function listaItensComprados($idTempVendas){
	
		$sql = "SELECT ail.*, ia.nome_item, ia.valor_item, ail.qtd FROM itens_adicionais ia INNER JOIN adicionar_item_lanche ail ON(ia.id = ail.id_itens_adicionais) WHERE ail.id_temp_vendas = '" . $idTempVendas . "'";
		
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
