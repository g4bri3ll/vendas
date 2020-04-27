<?php

$nomePost     = $_POST['nomeCliente'];
$crachaPost   = $_POST['cracha'];
$telefonePost = $_POST['telefone'];
$emailPost    = $_POST['email'];
$enderecoPost = $_POST['enderecoCliente'];
$fotoPost     = 0;
//Valida a foto
if (!empty($_FILES['foto'])) {
	$fotoPost = $_FILES['foto'];
}

class ControllerClientes{

	function validaCadastro($nomePost, $crachaPost, $telefonePost, $emailPost, $enderecoPost, $fotoPost){

		//Verificar se tem algum dado em branco pra não da erro na hora de cadastrar
		if(empty($nomePost) || empty($crachaPost)){
			
			echo "Valores inserido errado";

		} else{

			if(empty($telefonePost)){ $telefonePost = 0; }
			if(empty($emailPost))   { $emailPost    = 0; }
			if(empty($enderecoPost)){ $enderecoPost = 0; }

			$foto = $fotoPost;

			//Só vai cadastrar a foto se ela existe
			if (!empty($fotoPost)) {
				$upload = new UploadIMG();
				$foto = $upload->img($foto);
			}

			//Cadastro de pessoas pra depois cadastrar os clientes
			$pessoas = new Pessoa();
			$pessoas->setNome_pessoa   = $nomePost;
			$pessoas->setTelefone      = $telefonePost;
			$pessoas->setEmail         = $emailPost;
			$pessoas->setEndereco      = $enderecoPost;
			$pessoas->setFoto          = $foto;
			$pessoas->setData_cadastro = $date('Y-m-d H-i');
			
			$cliDAO = new clienteDAO();
			$valida = $cliDAO->cadastrarPessoas($pessoas);

			if ($valida) {

				//Retorna o ultimo ID do usuário
				$cliDAO = new clienteDAO();
				$arrayUltimoId = $cliDAO->ListaUltimoClientes();

				$id = 0;
				foreach ($arrayUltimoId as $array => $value) {
					$id = $value['id'];
				}

				//Cadastro dos clientes com o ID da pessoa
				$clientes = new clientes();
				$clientes->setCracha   = $crachaPost;
				$clientes->setIdPessoa = $id;
				$clientes->setStatus   = "Ativado";
				
				$cliDAO = new clienteDAO();
				$validaCad = $cliDAO->cadastrarClientes($clientes);

				if ($validaCad) {
					return header("../cadastroClientes.php");
				}
				
			}

		}

	}

}

?>