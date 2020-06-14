<?php

include_once "C:\\xampp\htdocs\Controle_vendas\Model\DAO\ItensAdicionalDAO.php";
include_once "C:\\xampp\htdocs\Controle_vendas\Model\Modelo\ItensAdicionais.php";

date_default_timezone_set('America/Sao_Paulo');

//Verificar se tem algum dado em branco pra não da erro na hora de cadastrar
if(empty($_POST['nome']) || empty($_POST['idLanche']) || empty($_POST['valor'])){
	
	echo "Valores inserido vazio";

} else{

	$postNome     = $_POST['nome'];
	$postidLanche = $_POST['idLanche'];
	$postValor    = $_POST['valor'];
	
	$foto = 0;
	//Só vai cadastrar a foto se ela existe
	if (!empty($_FILES['foto'])) {
		$foto     = $_FILES['foto'];

		$upload = new UploadIMGLanche();
		$foto = $upload->img($foto);
	}

	//Cadastro de pessoas pra depois cadastrar os clientes
	$itens = new ItensAdicionais();
	$itens->valorItem    = $postValor;
	$itens->nomeItem     = $postNome;
	$itens->status       = "Ativado";
	$itens->dataCadastro = date('Y-m-d H:i:s');
	$itens->idLanche     = $postidLanche;
	$itens->foto         = $foto;
	
	$iteDAO = new ItensAdicionalDAO();
	$valida = $iteDAO->cadastrar($itens);

	if ($valida) {
		
		header("Location: ../criarOpcaoAdicionais.php?salva=sucess");
		echo "Cadastro com sucesso";

	} else {
		echo "Erro ao cadastrar a opção adicional";
	}

}

?>