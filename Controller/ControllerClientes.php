<?php
session_start();

include_once "C:\\xampp\htdocs\Controle_vendas\Model\DAO\ClientesDAO.php";
include_once "C:\\xampp\htdocs\Controle_vendas\Model\Modelo\Pessoa.php";
include_once "C:\\xampp\htdocs\Controle_vendas\Model\Modelo\Cliente.php";

date_default_timezone_set('America/Sao_Paulo');

//Faz o cadastro do cliente no banco de dados, vindo da tela de cadastroClientes.php
if(!empty($_POST['nomeCliente']) || !empty($_POST['cracha'])) {
	
	$nomePost     = $_POST['nomeCliente'];
	$crachaPost   = $_POST['cracha'];
	$telefonePost = $_POST['telefone'];
	$emailPost    = $_POST['email'];
	$enderecoPost = $_POST['enderecoCliente'];

	//Verificar se o cracha já foi cadastro
	$cliDAO = new ClientesDAO();
	$validaCracha = $cliDAO->validaCrachaCadastro($crachaPost);

	if (empty($validaCracha)) {
			
		if(empty($telefonePost)){ $telefonePost = 1; }
		if(empty($emailPost))   { $emailPost    = 1; }
		if(empty($enderecoPost)){ $enderecoPost = 1; }

		$foto     = 0;
		//Só vai cadastrar a foto se ela existe
		if (!empty($_FILES['foto'])) {
			$foto   = $_FILES['foto'];
			$upload = new UploadIMG();
			$foto = $upload->img($foto);
		}

		//Cadastro de pessoas pra depois cadastrar os clientes
		$pessoas = new Pessoa();
		$pessoas->nome_pessoa   = $nomePost;
		$pessoas->telefone      = $telefonePost;
		$pessoas->email         = $emailPost;
		$pessoas->endereco      = $enderecoPost;
		$pessoas->foto          = $foto;
		$pessoas->data_cadastro = date('Y-m-d H:i:s');
		
		$cliDAO = new ClientesDAO();
		$valida = $cliDAO->cadastrarPessoas($pessoas);

		if ($valida) {

			//Pegar o ultimo id
			$pes = new Pessoa();
			$id = $pes->ultimoIdPessoa();

			//Cadastro dos clientes com o ID da pessoa
			$clientes = new Cliente();
			$clientes->cracha   = $crachaPost;
			$clientes->idPessoa = $id;
			$clientes->status   = "Ativado";
			
			$cliDAO = new ClientesDAO();
			$validaCad = $cliDAO->cadastrarClientes($clientes);

			if ($validaCad) {

				$_SESSION['success'] = "sucesso";
				header("Location: ../cadastroClientes.php");

			} else {
				echo "Não foi possivel cadastrar o cliente";
			}
			
		} else {
			echo "Não foi possivel cadastrar a pessoa";
		}

	} else {
		$_SESSION['error'] = "erro";
		header("Location: ../cadastroClientes.php");
		echo "O crachá está cadastro";
	}

}

?>