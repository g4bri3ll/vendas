<?php
session_start();

include "C:\\xampp\htdocs\Controle_vendas\Model\DAO\IngredienteDAO.php";
include "C:\\xampp\htdocs\Controle_vendas\Model\Modelo\Ingrediente.php";

date_default_timezone_set('America/Sao_Paulo');

//Verificar se tem algum dado em branco pra não da erro na hora de cadastrar
if(!empty($_POST['nome']) || !empty($_POST['idLanche']) || !empty($_POST['qtd'])){

	//Cadastro de pessoas pra depois cadastrar os clientes
	$ingrediente = new Ingrediente();
	$ingrediente->status       = "Ativado";
	$ingrediente->dataCadastro = date('Y-m-d H:i:s');
	$ingrediente->idLanche     = $_POST['idLanche'];
	$ingrediente->nome         = $_POST['nome'];
	$ingrediente->qtd          = $_POST['qtd'];
		
	$ingDAO = new IngredienteDAO();
	$validaCad = $ingDAO->cadastrar($ingrediente);
		
	if ($validaCad) {

		$_SESSION['cad'] = "sucesso";
		header('Location: ../cadastrarIngredientes.php');

	} else {
		echo "Erro ao cadastrar o ingredinte !!!!";
	}

}

?>