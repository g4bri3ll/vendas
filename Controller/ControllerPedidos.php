<?php
session_start();

include_once "C:\\xampp\htdocs\Controle_vendas\Model\DAO\FavoritosDAO.php";
include_once "C:\\xampp\htdocs\Controle_vendas\Model\DAO\ClientesDAO.php";
include_once "C:\\xampp\htdocs\Controle_vendas\Model\DAO\PedidoDAO.php";
include_once "C:\\xampp\htdocs\Controle_vendas\Model\DAO\FormaPgtoDAO.php";
include_once "C:\\xampp\htdocs\Controle_vendas\Model\DAO\LancheDAO.php";
include_once "C:\\xampp\htdocs\Controle_vendas\Model\DAO\ItensAdicionalDAO.php";
include_once "C:\\xampp\htdocs\Controle_vendas\Model\Modelo\Pedido.php";
include_once "C:\\xampp\htdocs\Controle_vendas\Model\Modelo\ItensAdicionais.php";
include_once "C:\\xampp\htdocs\Controle_vendas\Extras\GeradorCodigo.php";
include_once "C:\\xampp\htdocs\Controle_vendas\Model\DAO\FavoritosDAO.php";
include_once "C:\\xampp\htdocs\Controle_vendas\Model\Modelo\Favorito.php";

date_default_timezone_set('America/Sao_Paulo');

/* Este if faz a verificação do crachar para fazer o pedido. Vindo da view informeCracha.php
*/
if(!empty($_POST['cracha'])){

	$cracha = $_POST['cracha'];
	//Opção se e cracha ou favorito
	$opcao  = $_POST['opcao'];

	if ($opcao == "1") {
		
		//Verificar se o cracha existe
		$cliDAO = new ClientesDAO();
		$arrayCliente = $cliDAO->VerificarCracha($cracha);

		if (!empty($arrayCliente)) {
			
			foreach ($arrayCliente as $cliDAO => $value) {
				$_SESSION['id']     = $value['id'];
				$_SESSION['cracha'] = $value['cracha'];
			}

			header('Location: ../selecionarPedidos.php');

		} else {

			header('Location: ../informeCracha.php?erro=fab_erro');

		}

	} else {
		/*A opção escolhida foi o favorito, então ele faz o else
		*/

		//O cracha está com o codigo do favorito, verifica se existe e traz o array
		$codigo = $cracha;

		$favDAO = new FavoritosDAO();
		$arrayFavorito = $favDAO->validaFavorito($codigo);

		if (!empty($arrayFavorito)) {

			print_r($arrayFavorito);
			echo "Existe o codigo";

		} else {

			header('Location: ../informeCracha.php?error=codigo_erro');
			
		}

	}
	
}


/* Este if faz a verificação do pedido selecionado vindo do listaComidas.php 
*/
if (!empty($_GET['idProduto'])) {
	
	$idLanches = $_GET['idProduto'];
	$idCliente = $_SESSION['id'];

	$lanDAO = new LancheDAO(); 
	$arrayLanches = $lanDAO->listaLanchePraCompra($idLanches);

	//Verificar se o produto existe na tabela
	if (!empty($arrayLanches)) {
		
		$id = 0;
		foreach ($arrayLanches as $lanDAO => $value) {
			$tipoComida = $value['tipo'];
			$id         = $value['id'];
		}

		//Armazenar todo o array do produto
		$_SESSION['arrayLanches']  = $arrayLanches;
		
		header("Location: ../pedidoSelecionado.php?id_produto=".$id);
		//echo "Não redirecionor para pedidoSelecionado.php";

	} else {
		echo "Produto não encontrado !!!!";
	}

}

//Faz o cadastro do pedido selecionado pelo usuário da tela de PedidoSelecionado.php
if (!empty($_POST['idFormaPgto'])) {
	
	//Valida se a quantidade e zero
	if (!empty($_POST['qtd'])) {
		
		$idPgto       = $_POST['idFormaPgto'];
		$idlanche     = $_POST['idLanche'];
		$postValor    = $_POST['valorTotal'];
		$qtd          = $_POST['qtd'];
		$cracha       = $_SESSION['cracha'];
		$dataCad      = date('Y-m-d H:i:s', time());
		$date         = date('Y-m-d H:i:s');
		$dataHoje     = date('Y-m-d');
		$statusPedido = "Em andamento";
		$idCliente    = $_SESSION['id'];

		//Soma o valor total do pedido selecionado
		$valor = $postValor * $qtd;

		//Essa variavel $numeroPedido está com o ultimo numero do chamado. "Não mecha"
		$pedido = new Pedido();
		$numeroPedido = $pedido->retornaNumeroPedido($cracha, $statusPedido);
		
		//Verificar se o numero do pedido e o mesmo do cliente solicitando o pedido
		$pedido = new Pedido();
		$validaNumero = $pedido->verificarNumeroPedido($numeroPedido, $statusPedido, $cracha, $dataHoje);
		
		//Verificar se o cliente que está solicitando o pedido tem o numero já cadastrado
		if ($validaNumero == 0) {
			//Cadastrar ou criar o numero do pedido
			$lanDAO = new LancheDAO();
			$verifica = $lanDAO->criarNumeroPedido($numeroPedido, $cracha, $date, $statusPedido, $idCliente);
		}

		//Pegar o id do pedido criado e salvar na tabela temp_vendas
		$lanDAO = new LancheDAO();
		$arrayIdPedido = $lanDAO->listaUltimoIdPedido($cracha);

		$idPedido = 0;
		foreach ($arrayIdPedido as $lanDAO => $value) {
			$idPedido = $value['id'];
		}


		//Cadastrar os lanches selecionados
		$lanDAO = new LancheDAO();
		$verifica = $lanDAO->cadastrarLanchesTemp($qtd, $idPgto, $idlanche, $valor, $cracha, $dataCad, $idPedido);

		//Verificar se o lanche foi cadatrar na tabela temp_vendas
		if ($verifica) {
			header("Location: ../finalizarPedido.php");
		} else {
			echo "Ocorreu um erro ao cadastrar o lanche";
		}

	}//Fecha o if que verificar se a quantidade e zero
	else {
		header("Location: ../senha.php");
	}
	
}

//excluir o pedido selecionado
if (!empty($_GET['excluirPedido'])) {
	
	$id     = $_GET['excluirPedido'];
	$status = "Excluido";

	//Excluir o item do pedido selecionado
	$lanDAO = new LancheDAO();
	$verifica = $lanDAO->excluirItem($id, $status);

	//Verificar se o lanche foi cadatrar na tabela temp_vendas
	if ($verifica) {
		header("Location: ../finalizarPedido.php");
	} else {
		echo "Ocorreu um erro ao excluir o lanche";
	}
	
}

//Finalizar o pedido do cliente 
if (!empty($_GET['finalizar'])) {
	
	$cracha           = $_SESSION['cracha'];
	$status           = "Aguardando";
	$data             = date('Y-m-d');
	$statusAtual      = "Em andamento";
	$statusPedido     = "Aberto";
	$statusTempvendas = "Solicitado";
	$idPedido         = $_GET['finalizar'];

	//Abrir o pedido para o painel
	$lanDAO = new LancheDAO();
	$lanDAO->abrirPedido($statusPedido, $statusAtual, $idPedido) ;

	$lanDAO = new LancheDAO();
	$verifica = $lanDAO->terminarPedido($status, $statusTempvendas, $idPedido);

	if ($verifica) {

		//Se a checkbox do favoritos estiver marcado ele faz
		if (!empty($_POST['checkbox'])) {

			$gera = new GeradorCodigo();
			$codigo = $gera->geraSenha(5, false, true);

			//Verificar se o codigo gerado, está na base de dados

			$favorito = new Favorito();
			$favorito->idCliente    = $_SESSION['id'];
			$favorito->idPedido     = $idPedido;
			$favorito->status       = "Ativado";
			$favorito->dataCadastro = $data;
			$favorito->codigo       = $codigo;

			//Salvando o pedido como favorito
			$favDAO = new FavoritosDAO();
			$favDAO->salvaFavoritos($favorito);

		}

		session_destroy();
		header("Location: ../senha.php");

	} else {
		echo "Erro ao finalizar o pedido";
	}

}

//Cancela todo o pedido do cliente
if (!empty($_GET['cancelarPedido'])) {
	
	$idPedido = $_GET['cancelarPedido'];
	$cracha   = $_SESSION['cracha'];
	$status   = "Cancelado";

	$lanDAO = new LancheDAO();
	$verifica = $lanDAO->excluirPedido($status, $cracha, $idPedido);

	if ($verifica) {
		header("Location: ../senha.php");
	} else {
		echo "Erro ao excluir todo o pedido";
	}

}


/*Verificar o crachá do cliente chamado pela tela acompanharPedidos.php, pra visualizar os pedidos selecionado por ele
*/
if (!empty($_POST['crachaAcompanha'])) {

	$cracha = $_POST['crachaAcompanha'];
	$data = date('Y-m-d');

	$lanDAO = new LancheDAO();
	$arrayLanches = $lanDAO->listaLanchesSelecionado($data, $cracha);
	
	if (!empty($arrayLanches)) {

		//Buscar o array de favorito para a tela de acompanhamentoPedidos.php
		$favDAO = new FavoritosDAO();
		$arrayFavorito = $favDAO->listaFavoritosPeloCracha($cracha);

		//Colocar na session os favoritos selecionado por ele
		$_SESSION['arrayFavorito'] = $arrayFavorito;

		//Colocar o array com todos os dados do lanche na session
		$_SESSION['arrayPedidos'] = $arrayLanches;
		header("Location: ../acompanharPedidos.php");

	} else {
		header("Location: ../acompanharPedidos.php?erro=vazio");
		echo "Não existe lanche no dia de hoje";
	}

}

/*Coloca o lanche do cliente em andamento
*/
if (!empty($_GET['idPedido'])) {
	
	$idPedido = $_GET['idPedido'];
	$status   = "Em andamento";

	$lanDAO = new LancheDAO();
	$verifica = $lanDAO->alteraStatusAndamento($status, $idPedido);

	if (!empty($verifica)) {

		header("Location: ../painel.php");

	} else {
		echo "Erro ao colocar o lanche do cliente em andamento";
	}

}

/*Adicionar item no lanche selecionado. Faz o redirecionamento para adicionar o item ao lanche
*/
if (!empty($_GET['addItem'])) {

	$idItem = $_GET['idItemPedido'];
	
	header("Location: ../adicionarItensLanches.php?idItem=".$idItem);
}

/*Cadastrar o item adicional no lanche vindo da tela adicionarItensLanches.php
*/
if (!empty($_POST['checkbox'])) {
	
	//Verificar se a quantidade foi digitada
	if (!empty($_POST['qtd'])) {
		
		//Id do item adicional
		$idItem       = $_POST['checkbox'];
		$qtd          = $_POST['qtd'];
		$idTempVendas = $_POST['idTempVendas'];
		$status       = "Ativado";
		$data         = date('Y-m-d H:i:s');
		$valida       = false;

		$cont = 0;
		//Faz o cadastro do pedido
		for ($i = 0; $i < count($qtd); $i++) {

			$cont = $cont;
			if (!empty($qtd[$i])) {

				$itens = new ItensAdicionais();
				$itens->qtd          = $qtd[$i];
				$itens->status       = $status;
				$itens->dataCadastro = $data;
				$itens->idTempVendas = $idTempVendas[$i];
				$itens->idCliente    = $_SESSION['id'];
				$itens->id           = $idItem[$cont];

				$iteDAO = new ItensAdicionalDAO();
				$valida = $iteDAO->adicionarItensLanche($itens);

				$cont = $cont + 1;

			}

		}

		if ($valida) {

			$_SESSION['addItem'] = "verdadeiro";

			header("Location: ../finalizarPedido.php");

		} else {
			echo "Erro ao adicionar o item ao lanche selecionado";
		}
		
	} else {
		echo "Quantidade selecionada vazia, favor informar um quantidade";
	}

}

/*Excluir o item do lanche solicitado
*/
if (!empty($_GET['excluirItem'])) {

	$idItem = $_GET['excluirItem'];

	$iteDAO = new ItensAdicionalDAO();
	$valida = $iteDAO->excluirItemAdd($idItem);

	if ($valida) {

		header("Location: ../finalizarPedido.php");

	} else {
		echo "Erro ao excluir o item do lanche";
	}

}

//Mudar o status do pedido
if (!empty($_GET['mudarStatusPedido'])) {
	
	$idPedido = $_GET['mudarStatusPedido'];
	$status   = "Em andamento";

	$pedDAO = new PedidoDAO();
	$valida = $pedDAO->alteraStatus($status, $idPedido);

	if ($valida) {

		header("Location: ../painelVendedor.php");

	} else {
		echo "Erro ao atualizar os dados do pedido";
	}

}

//Entrega o pedido do cliente vindo da tela painelVendedor.php
if (!empty($_GET['entregaPedido'])) {
	
	$idPedido    = $_GET['entregaPedido'];
	$status      = "Fechado";
	$dataFechado = date('Y-m-d H:i:s');
	
	$pedDAO = new PedidoDAO();
	$valida = $pedDAO->fechaPedido($status, $dataFechado, $idPedido);

	if ($valida) {

		//Alterar o status na tabela temp_vendas, vindo do painelVendedo.php
		$pedDAO = new PedidoDAO();
		$verifica = $pedDAO->finalizaPedidoTemp($status, $idPedido);

		if ($verifica) {
			header("Location: ../painelVendedor.php");
		} else {
			echo "Erro ao atualizar os status da tabela temp_vendas";
		}

	} else {
		echo "Erro ao atualizar os dados do pedido";
	}

}

//Cancelar o pedido via painel vendedor
if (!empty($_GET['cancelaPedido'])) {

	$idPedido      = $_GET['cancelaPedido'];
	$status        = "Cancelado via painel";
	$dataCancelado = date('Y-m-d H:i:s');

	$lanDAO = new LancheDAO();
	$valida = $lanDAO->cancelaPedidoPainel($status, $dataCancelado, $idPedido);

	if ($valida) {

		//Excluir também na tabela temp_venda vindo da tela painelVendedor.php
		$lanDAO = new LancheDAO();
		$verificar = $lanDAO->cancelaTempLanche($status, $dataCancelado, $idPedido);

		if ($valida) {
			header("Location: ../painelVendedor.php");
		} else {
			echo "Erro ao excluir da tabela temp_vendas";
		}

	} else {
		echo "Erro ao excluir o pedido do cliente";
	}

}

//Excluir os favoritos pelo próprio cliente, vindo da tela acompanharPedidos.php
if (!empty($_GET['excluirFavorito'])) {

	//Pegar o id do favorito para excluir
	$idFavorito = $_GET['excluirFavorito'];

	$favDAO = new FavoritosDAO();
	$valida = $favDAO->excluirFavorito($idFavorito);

	if ($valida) {
		header("Location: ../acompanharPedidos.php");
	} else {
		echo "Erro ao excluir o favorito";
	}
}

?>