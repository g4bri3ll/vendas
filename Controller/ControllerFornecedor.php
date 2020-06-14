<?php

include "C:\\xampp\htdocs\Controle_vendas\Model\DAO\FornecedorDAO.php";
include "C:\\xampp\htdocs\Controle_vendas\Model\Modelo\Fornecedor.php";

$postNome     = $_POST['forncedor'];
$postCnpj     = $_POST['cnpj'];
$postTelefone = $_POST['telefone'];
$postEmail    = $_POST['email'];
$postEndereco = $_POST['endereco'];

//Verificar se tem algum dado em branco pra não da erro na hora de cadastrar
if(empty($postNome) || empty($postCnpj) || empty($postTelefone) || empty($postEmail) || empty($postEndereco)){

	echo "Valores inserido errado";

} else {

	//Cadastro de pessoas pra depois cadastrar os clientes
	$pessoas = new Pessoa();
	$pessoas->setNome_pessoa   = $postNome;
	$pessoas->setTelefone      = $postTelefone;
	$pessoas->setEmail         = $postEmail;
	$pessoas->setEndereco      = $postEndereco;
	$pessoas->setData_cadastro = date('Y-m-d H:i');
	
	$forDAO = new FornecedorDAO();
	$valida = $forDAO->cadastrarPessoas($pessoas);
	
	if ($valida) {

		//Pegar o ultimo id
		$pes = new Pessoa();
		$id = $pes->ultimoIdPessoa();

		//Cadastro de pessoas pra depois cadastrar os clientes
		$forncedor = new Fornecedor();
		$forncedor->setIdPessoa = $id;
		$forncedor->setCnpj     = $postCnpj;
		$forncedor->setStatus   = "Ativado";
		
		$forDAO = new FornecedorDAO();
		$validaCad = $forDAO->cadastrarFornecedor($forncedor);
		
		if ($validaCad) {

			header('Location: ../cadastrarFornecedor.php?cad=fat8574');

		} else {
			echo "Erro ao cadastrar o fornecedor !!!!";
		}

	} else {
		echo "Erro no cadastro da tabela pessoa";
	}

}

?>