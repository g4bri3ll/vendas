<?php
session_start();

include "C:\\xampp\htdocs\Controle_vendas\Model\DAO\FavoritosDAO.php";

date_default_timezone_set('America/Sao_Paulo');

//Verificar se tem algum dado em branco pra não da erro na hora de cadastrar
if(!empty($_POST['idCliente']) || !empty($_POST['qtd'])){
	
	$idCliente = $_POST['idCliente'];
	$qtd       = $_POST['qtd'];
	$data          = date('Y-m-d H:i:s');
	$status        = "Ativado";
	
	//Verificar se o cliente já foi cadastro na tabela de favoritos
	$favDAO = new FavoritosDAO();
	$verifica = $favDAO->listaCadFavoritos($idCliente);

	//Verificar se o cliente já tem o cadastro de favoritos
	if (empty($verifica)) {
		
		$favDAO = new FavoritosDAO();
		$validaCad = $favDAO->cadastrar($idCliente, $status, $data, $qtd);
			
		if ($validaCad) {

			$_SESSION['cadastro'] = "cad";
			header('Location: ../configClientesXFavoritos.php');

		} else {
			echo "Erro ao cadastrar o favorito!!!!";
		}

	} else {
		$_SESSION['erroCadastro'] = "erro";
		header('Location: ../configClientesXFavoritos.php');
	}

}

?>