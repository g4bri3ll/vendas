<?php

include_once 'C:\\xampp\htdocs\Controle_vendas\Conexao\Conexao.php';

class LancheDAO {

	private $conn = null;
	
	public function cadastrar(Lanche $lanche) {
	
		try {

			$sql = "INSERT INTO lanche (nome, valor, codigo_barra, id_fornecedor, tipo, data_cadastro, foto, status) VALUES ('" . $lanche->setNome . "', '" . $lanche->setValor . "', '" . $lanche->setCodigoBarra . "', '" . $lanche->setIdFornecedor . "', '" . $lanche->setTipo . "', '" . $lanche->setDataCadastro . "', '" . $lanche->setFoto . "', '" . $lanche->setStatus . "')";
			
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

	//Cadastrar os lanches temporarios selecionados pela tela pedidoSelecionado.php
	public function cadastrarLanchesTemp($qtd, $idPgto, $idlanche, $valor, $cracha, $dataCad, $idPedido) {
	
		try {

			$sql = "INSERT INTO temp_vendas (qtd, id_forma_pgto, id_lanche, cracha, valor, status, data_cadastro, id_pedido) VALUES ('" . $qtd . "', '" . $idPgto . "', '" . $idlanche . "', '" . $cracha . "', '" . $valor . "', 'Solicitado', '" . $dataCad . "', '" . $idPedido . "')";
			
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

	//Cadastrar o numero do pedido
	public function criarNumeroPedido($numeroPedido, $cracha, $date, $statusPedido, $idCliente) {
	
		try {

			$sql = "INSERT INTO pedidos (n_pedido, cracha, data_comprado, status) VALUES ('" . $numeroPedido . "', '" . $cracha . "', '" . $date . "', '" . $statusPedido . "')";
			
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

	//Cadastrar o lanche, caso o cliente não saiba usar a tela. Está vindo da tela cadastrarLanchesVendidos.php
	public function cadastraLanchesADM(Lanche $lanche) {
	
		try {

			$sql = "INSERT INTO temp_vendas (id_cliente, valor, qtd, id_lanche, data_cadastro, status, id_forma_pgto) VALUES ('" . $lanche->idCliente . "', '" . $lanche->valor . "', '" . $lanche->qtd . "', '" . $lanche->id . "', '" . $lanche->dataCadastro . "', '" . $lanche->status . "', '" . $lanche->idFormaPgto . "')";
			
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

	//cancelar o pedido via painel do vendedor
	public function cancelaPedidoPainel($status, $dataCancelado, $idPedido) {
	
		try {

			$sql = "UPDATE pedidos SET status = '" . $status . "', data_cancelamento = '".$dataCancelado."' WHERE id = '" . $idPedido . "'";
			
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

	//cancelar o pedido via painel do vendedor na tabela temp_vendas
	public function cancelaTempLanche($status, $dataCancelado, $idPedido) {
	
		try {

			$sql = "UPDATE temp_vendas SET status = '" . $status . "', data_cancelamento = '".$dataCancelado."' WHERE id_pedido = '" . $idPedido . "'";
			
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

	//Finalizar o pedido selecionado pelo cliente
	public function terminarPedido($status, $statusTempvendas, $idPedido) {
	
		try {

			$sql = "UPDATE temp_vendas SET status = '" . $status . "' WHERE status = '" . $statusTempvendas . "' AND id_pedido = '".$idPedido."'";
			
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

	//Abrir o pedido para o painel
	public function abrirPedido($statusPedido, $statusAtual, $idPedido) {
	
		try {

			$sql = "UPDATE pedidos SET status = '" . $statusPedido . "' WHERE status = '".$statusAtual."' AND id = '".$idPedido."'";
			
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

	//Coloca o pedido em andamento do cliente pela tela painel.php
	public function alteraStatusAndamento($status, $idPedido) {
	
		try {

			$sql = "UPDATE pedidos SET status = '" . $status . "' WHERE id = '" . $idPedido . "'";
			
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

	//Excluir item por item selecionado na tela de finalizarPedido.php
	public function excluirItem($id, $status){
	
		try {

			$sql = "UPDATE temp_vendas SET status = '".$status."' WHERE id = '".$id."'";
			
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

	//Finalizar todos os pedidos selecionado pelo cliente na tela de finalizarPedido.php
	public function excluirPedido($status, $cracha, $idPedido){
	
		try {

			$sql = "UPDATE temp_vendas SET status = '" . $status . "' WHERE cracha = '".$cracha."' AND id_pedido = '".$idPedido."'";
			
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

	public function listaLanches(){
	
		$sql = "SELECT * FROM lanche WHERE status = 'Ativado'";
		
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

	public function listaLanchesSelecionado($data, $cracha){
	
		$sql = "SELECT tv.status, l.nome, p.n_pedido, p.data_comprado, p.status, tv.qtd, tv.valor FROM temp_vendas tv INNER JOIN pedidos p ON(tv.id_pedido = p.id) INNER JOIN lanche l ON(tv.id_lanche = l.id) WHERE (p.status = 'Aberto' OR p.status = 'Em andamento') AND date(tv.data_cadastro) = '".$data."' AND p.cracha = '".$cracha."' AND tv.status = 'Aguardando'";
		
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

	//Lista de todos os lanches do dia para painel.php
	public function listaLanchesPainel($idPedido){
	
		$sql = "SELECT fp.forma_pgto, tv.qtd, l.nome FROM temp_vendas tv INNER JOIN pedidos p ON(tv.id_pedido = p.id) INNER JOIN lanche l ON(tv.id_lanche = l.id) INNER JOIN forma_pgto fp ON(tv.id_forma_pgto = fp.id) WHERE tv.id_pedido = '".$idPedido."' AND tv.status = 'Aguardando' ORDER BY tv.id ASC";
		
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

	//Lista os pedidos de hoje para painel.php
	public function listaPedidosPainel($dataHoje){
	
		$sql = "SELECT p.*, pe.nome_pessoa FROM pedidos p INNER JOIN cliente c ON(p.cracha = c.cracha) INNER JOIN pessoa pe ON(c.id_pessoa = pe.id) WHERE date(p.data_comprado) = '".$dataHoje."' AND (p.status = 'Aberto' OR p.status = 'Em andamento' )ORDER BY p.data_comprado ASC";
		
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

	//Lista o pedido aberto ou em andamento na data de hoje painel.php
	public function listaPedidoHoje($dataHoje){
	
		$sql = "SELECT n_pedido FROM pedidos WHERE date(data_comprado) = '".$dataHoje."' AND (status = 'Aberto' OR status = 'Em andamento') ORDER BY n_pedido ASC";
		
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

	//Pegar o id do ultimo pedido selecionado
	public function listaUltimoIdPedido($cracha){
	
		$sql = "SELECT id FROM pedidos WHERE cracha = '".$cracha."' ORDER BY id DESC LIMIT 1";
		
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

	//Verificar se o numero do pedido e o cracha já está cadastrado
	public function verificarNumeroPedido($cracha, $nPedido, $statusPedido){
	
		$sql = "SELECT n_pedido FROM pedidos WHERE cracha = '".$cracha."' AND n_pedido = '".$nPedido."' AND status = '".$statusPedido."' ORDER BY id DESC LIMIT 1";
		
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

	//Lista o numero do ultimo pedido
	public function listaNumeroUltimoPedido(){
	
		$sql = "SELECT n_pedido FROM pedidos ORDER BY id DESC LIMIT 1";
		
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

	//Verificar se o numero do pedido já foi cadastrado
	public function validaPedidoCliente($statusPedido, $cracha, $dataHoje){
	
		$sql = "SELECT n_pedido FROM pedidos WHERE status = '".$statusPedido."' AND cracha = '".$cracha."' AND date(data_comprado) = '".$dataHoje."'";
		
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

	public function listaBebidas(){
	
		$sql = "SELECT * FROM lanche WHERE tipo = '1'";
		
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

	public function listaComidas(){
	
		$sql = "SELECT * FROM lanche WHERE tipo = '2'";
		
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

	public function listaPedidoTemp($cracha, $data){
	
		$sql = "SELECT l.id as id_lanche, p.n_pedido, tv.id, l.nome, tv.valor, tv.status, fp.forma_pgto, p.id as id_pedido FROM temp_vendas tv INNER JOIN lanche l ON(tv.id_lanche = l.id) INNER JOIN forma_pgto fp ON(tv.id_forma_pgto = fp.id) INNER JOIN pedidos p ON(tv.id_pedido = p.id) WHERE tv.cracha = '".$cracha."' AND date(tv.data_cadastro) = '".$data."' AND tv.status = 'Solicitado' ORDER BY tv.id DESC";
		
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

	//Lista todos os lanches cadastro para a tela CriarOpçaoAdicionais.php
	public function listaLanchesAdd(){
	
		$sql = "SELECT * FROM lanche WHERE status = 'Ativado' ORDER BY id DESC";
		
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

	//Lista de produto pelo id Selecionado
	public function listaLanchePraCompra($idLanches){
	
		$sql = "SELECT fp.*, p.nome, p.valor, p.foto, p.id as id_lanche FROM lanche p, forma_pgto fp WHERE p.id = '".$idLanches."'";
		
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

	//Lista itens adicionais se o lanche estiver item cadastrado
	public function verificarItensAdd($idLanches){
	
		$sql = "SELECT * FROM itens_adicionais WHERE id_lanche = '".$idLanches."'";
		
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

	//Lista todos os lanches para cadastrarLanchesVendidos.php
	public function listaTodosLanches(){
	
		$sql = "SELECT * FROM lanche WHERE status = 'Ativado'";
		
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

	//Lista todos os lanches para a tela cadastrarLanchesVendidos.php
	public function listaLanchesCriados(){
	
		$sql = "SELECT tv.*, l.nome, pe.nome_pessoa, fp.forma_pgto FROM temp_vendas tv INNER JOIN lanche l ON(tv.id_lanche = l.id) INNER JOIN cliente c ON(tv.id_cliente = c.id) INNER JOIN pessoa pe ON(c.id_pessoa = pe.id) INNER JOIN forma_pgto fp ON(tv.id_forma_pgto = fp.id) WHERE tv.status = 'Criado'";
		
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
	//Lista o lanche selecionado para lista na tela de adicionarItensLanches.php
	public function listaLanchePorID($itemAdd){
	
		$sql = "SELECT l.id, l.nome FROM lanche l INNER JOIN temp_vendas tv ON(l.id = tv.id_lanche) WHERE tv.id = '".$itemAdd."'";
		
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
	
}

?>
