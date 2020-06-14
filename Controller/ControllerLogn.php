<?php
session_start();

date_default_timezone_set('America/Sao_Paulo');

//Faz o cadastro de pedidos de vendas, se o cliente não consegui fazer na tela de senha
if (!empty($_POST['psw']) || !empty($_POST['cpf'])) {
	
	$postCpf   = $_POST['cpf'];
	$postSenha = $_POST['psw'];

	header("Location: ../paginaInicial.php");

	
}

?>