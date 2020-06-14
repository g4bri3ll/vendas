<?php

include "C:\\xampp\htdocs\Controle_vendas\Model\DAO\LancheDAO.php";
include "C:\\xampp\htdocs\Controle_vendas\Model\Modelo\Lanche.php";
include "C:\\xampp\htdocs\Controle_vendas\Uploads\UploadIMGLanche.php";

$postNome        = $_POST['nomeProduto'];
$postValor       = $_POST['valor'];
$postTipo        = $_POST['tipo'];
$postCodigoBarra = $_POST['codigoBarra'];
$postIdForncedor = $_POST['idForncedor'];
$postFoto        = $_FILES['foto'];

//Verificar se tem algum dado em branco pra não da erro na hora de cadastrar
if(empty($postNome) || empty($postValor) || empty($postTipo) || empty($postIdForncedor) || empty($postFoto)){
	
	echo "Valores inserido errado";

} else{

	$foto = $postFoto;

	$upload = new UploadIMGLanche();
	$foto = $upload->img($foto);

	if (!empty($foto)) {
		
		//Cadastro de pessoas pra depois cadastrar os clientes
		$lanche = new Lanche();
		$lanche->setNome          = $postNome;
		$lanche->setValor         = $postValor;
		$lanche->setCodigoBarra   = $postCodigoBarra;
		$lanche->setIdFornecedor  = $postIdForncedor;
		$lanche->setStatus        = "Ativado";
		$lanche->setTipo          = $postTipo;
		$lanche->setFoto          = $foto;
		$lanche->setDataCadastro  = date('Y-m-d H:i');

		$lanDAO = new LancheDAO();
		$valida = $lanDAO->cadastrar($lanche);

		if ($valida) {

			header('Location: ../criarLanches.php?cad=fat167');

		} else {
			echo "Erro no cadastramento dos dados do produto !!!";
		}

	} else {

		echo "Erro ao cadastrar a foto !!!!";

	}


}

?>