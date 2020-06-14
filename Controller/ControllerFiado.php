<?php

include "C:\\xampp\htdocs\Controle_vendas\Model\DAO\FiadoDAO.php";
include "C:\\xampp\htdocs\Controle_vendas\Model\Modelo\Fiado.php";

date_default_timezone_set('America/Sao_Paulo');

$postIdCliente = $_POST['idCliente'];

//Verificar se tem algum dado em branco pra não da erro na hora de cadastrar
if(!empty($postIdCliente)){

	//Cadastro de pessoas pra depois cadastrar os clientes
	$f = new Fiado();
	$f->idCliente    = $postIdCliente;
	$f->status       = "Ativado";
	$f->dataCadastro = date('Y-m-d H:i:s');
		
	$fDAO = new FiadoDAO();
	$validaCad = $fDAO->cadastrar($f);
		
	if ($validaCad) {

		header('Location: ../cadastrarClienteFiados.php?cad=fat8574');

	} else {
		echo "Erro ao cadastrar o fiado !!!!";
	}

}

?>