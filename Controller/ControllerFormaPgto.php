<?php
session_start();

include "C:\\xampp\htdocs\Controle_vendas\Model\DAO\FormaPgtoDAO.php";
include "C:\\xampp\htdocs\Controle_vendas\Model\Modelo\FormaPgto.php";

date_default_timezone_set('America/Sao_Paulo');

//Verificar se tem algum dado em branco pra não da erro na hora de cadastrar
if(!empty($_POST['pgto']) || !empty($_POST['porcetagem'])){

	$postPgto = $_POST['pgto'];
	$postPorcetagem = $_POST['porcetagem'];

	$fPgto = new FormaPgto();
	$fPgto->setFormaPgto  = $postPgto;
	$fPgto->setPorcetagem = $postPorcetagem;
	$fPgto->setStatus     = "Ativado";

	$fPgtoDAO = new FormaPgtoDAO();
	$valida = $fPgtoDAO->cadastrar($fPgto);

	if ($valida) {

		header('Location: ../cadastrarFormaPgto.php?cad=fat8174');

	} else {
		echo "Erro ao cadastrar a forma de pagamento !!!!";
	}

} 

//Confirgura uma conta de pagamento a um cliente especifico pela tela configurarContaCliente.php
if (!empty($_POST['idCliente']) || !empty($_POST['idFormaPgto'])) {

	$idCliente   = $_POST['idCliente'];
	$idFormaPgto = $_POST['idFormaPgto'];
	$status      = "Ativado";
	$data        = date('Y-m-d H:i:s');


	//Verificar se já possui o cadastro na forma de pagamento
	$forDAO = new FormaPgtoDAO();
	$verifica = $forDAO->verificaVinculo($idCliente, $idFormaPgto);

	if (empty($verifica)) {
		
		$forDAO = new FormaPgtoDAO();
		$valida = $forDAO->cadastroEspecifico($idCliente, $idFormaPgto, $status, $data);

		if ($valida) {

			$_SESSION['cadastro'] = "cadastrado";
			header('Location: ../configurarContaCliente.php');

		} else {
			echo "Erro ao cadastrar a forma de pagamento no cliente especifico";
		}

	} else {
		//Se o cliente já estiver cadastrado ele retornar a mensagem
		$_SESSION['erroCadastro'] = "erro";
		header('Location: ../configurarContaCliente.php');
	}

}

?>