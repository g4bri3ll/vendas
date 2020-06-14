<?php
session_start();

include_once "C:\\xampp\htdocs\Controle_vendas\Model\DAO\VendasDAO.php";
include_once "C:\\xampp\htdocs\Controle_vendas\Model\DAO\LancheDAO.php";
include_once "C:\\xampp\htdocs\Controle_vendas\Model\Modelo\Lanche.php";

date_default_timezone_set('America/Sao_Paulo');


//Faz o cadastro de pedidos de vendas, se o cliente não consegui fazer na tela de senha
if (!empty($_POST['idCliente']) || !empty($_POST['idLanche'])) {
	
	$idCliente    = $_POST['idCliente'];
	$valor        = $_POST['valor'];
	$qtd          = $_POST['qtd'];
	$idLanche     = $_POST['idLanche'];
	$idFormaPgto  = $_POST['idFormaPgto'];

	if (!empty($valor)) {
		
		$lanche = new Lanche();
		$lanche->qtd          = $qtd;
		$lanche->idCliente    = $idCliente;
		$lanche->id           = $idLanche;
		$lanche->valor        = $valor;
		$lanche->dataCadastro = date('Y-m-d H:i:s');
		$lanche->idFormaPgto  = $idFormaPgto;
		$lanche->status       = "Criado";

		$lanDAO = new LancheDAO();
		$valida = $lanDAO->cadastraLanchesADM($lanche);

		if ($valida) {

			$_SESSION['valor'] = "sucesso";
			header("Location: ../cadastrarLanchesVendidos.php");

		} else {
			echo "Erro ao cadastrar o lanche do cliente, verifique e tente novamente";
		}

	} else {
		echo "O valor do lanche não pode ser vazio";
	}
	
}

//Finalizar a compra pela tela de cadastrarLanchesVendidos.php
if (!empty($_GET['concluirPedido'])) {
	
	$status       = "Fechado";
	$idTempVendas = $_GET['concluirPedido']; 

	$venDAO = new VendasDAO();
	$valida = $venDAO->finalizaVenda($status, $idTempVendas);

	if ($valida) {

		$_SESSION['finalizar'] = "sucesso";
		header("Location: ../cadastrarLanchesVendidos.php");

	} else {
		echo "Erro ao fechar o lanche do cliente, verifique e tente novamente";
	}

}


//Excluir o item escolhido vindo da tela cadastrarLanchesVendidos.php
if (!empty($_GET['excluirPedido'])) {

	$idTempVendas = $_GET['excluirPedido'];

	$venDAO = new VendasDAO();
	$valida = $venDAO->excluirVenda($idTempVendas);

	if ($valida) {

		$_SESSION['excluir'] = "sucesso";
		header("Location: ../cadastrarLanchesVendidos.php");

	} else {
		echo "Erro ao fechar o lanche do cliente, verifique e tente novamente";
	}

}

?>