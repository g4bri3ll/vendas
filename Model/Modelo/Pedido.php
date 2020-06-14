<?php

include_once "C:\\xampp\htdocs\Controle_vendas\Model\DAO\LancheDAO.php";

class Pedido {
	
	private $id;
	private $idCliente;
	private $idLanche;
	private $nPedido;
	private $valorComprado;
	private $dataComprado;
	private $dataCancelado;
	private $idFormaPgto;
	private $token;
	private $cracha;
	private $status;
	
	
	//Atribuir o set a todos os atributos
	public function __set($atrib, $value){
		$this->$atrib = $value;
	}
	
	//Atribuir o get a todos os atributos
	public function __get($atrib){
		return $this->$atrib;
	}
	
	//Retorna o ultimo numero do pedido
	function retornaNumeroPedido($cracha, $statusPedido){

		$lanDAO = new LancheDAO();
		$arrayNPedido = $lanDAO->listaNumeroUltimoPedido();

		$nPedido = 0;

		//Verificar se o valor e 0
		if (empty($arrayNPedido)) {
			$nPedido = 1000;
		} else {

			foreach ($arrayNPedido as $lanDAO => $value) {
				$nPedido = $value['n_pedido'];
			}

			//Verificar o cliente se ele tem o numero do pedido cadastrado
			$lanDAO = new LancheDAO();
			$verificarNumPedido = $lanDAO->verificarNumeroPedido($cracha, $nPedido, $statusPedido);

			//Verificar se o numero do pedido existe
			if (empty($verificarNumPedido)) {
				$nPedido = $nPedido + 1;
			}
			
		}

		return $nPedido;

	}

	//Verificar se o numero do pedido do cliente foi cadastrado
	function verificarNumeroPedido($numeroPedido, $statusPedido, $cracha, $dataHoje){

		$lanDAO = new LancheDAO();
		$validaNumPedido = $lanDAO->validaPedidoCliente($statusPedido, $cracha, $dataHoje);

		$numeroPedidoBanco = 0;
		//Retorna verdadeiro se o cliente estiver o numero do pedido já cadastrado
		foreach ($validaNumPedido as $lanDAO => $value) {
			$numeroPedidoBanco = $value['n_pedido'];
		}

		if (empty($validaNumPedido)) {
			return 0;
		} else {
			return 1;
		}
		

	}
}

?>