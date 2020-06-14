<?php
include "C:\\xampp\htdocs\Controle_vendas\Model\DAO\LancheDAO.php";

date_default_timezone_set('America/Sao_Paulo');
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Painel adiministrativo de acompanhamento de lanches solicitado</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
</head>
<body>

<?php
$dataHoje = date('Y-m-d');

//Lista todos os pedidos de hoje
$lanDAO = new LancheDAO();
$arrayPedidos = $lanDAO->listaPedidosPainel($dataHoje);
?>

<div class="wrapper">
	<div class="content" style="padding-top: 2%;">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
					<div class="header">
					<h4 class="title">Painel adiministrativo de acompanhamento de lanches solicitado no dia <b style="color: lime;"><?php echo date('d/m/Y', strtotime($dataHoje)); ?></b></h4>
					</div>
						<div class="content table-responsive table-full-width">
							<table class="table table-hover table-striped">
								<thead>
									<th>Nª Pedido</th>
									<th>Nome do cliente</th>
									<th>Nome do pedido</th>
									<th>Forma de Pgto</th>
									<th>Quantidade</th>
									<th>Data</th>
									<th>Status</th>
								</thead>
								<tbody>

									<?php 
									foreach ($arrayPedidos as $lanDAO => $value) { 
									
										$idPedido = $value['id']; 
										//Pegar os nomes do lanches pelo id do pedido
										$lanDAO = new LancheDAO();
										$arrayLanches = $lanDAO->listaLanchesPainel($idPedido);
									?>
									<tr style="background-color: <?php echo $cor; ?>">
										<td><?php echo $value['n_pedido']; ?></td>
										<td><?php echo $value['nome_pessoa']; ?></td>
										<td>
											<?php 
											foreach ($arrayLanches as $lanDAO => $valor) { 
												echo $valor['nome'] . "<br />";
											} 
											?>
										</td>
										<td>
											<?php 
											foreach ($arrayLanches as $lanDAO => $valor) {
												echo $valor['forma_pgto'] . "<br />";
											} 
											?>
										</td>
										<td>
											<?php 
											foreach ($arrayLanches as $lanDAO => $valor) {
												echo $valor['qtd'] . "<br />";
											} 
											?>
										</td>
										<td><?php echo date("d/m/Y H:i:s", strtotime($value['data_comprado'])); ?></td>

										<?php 
										//Verificar se o pedido esta aberto ou em andamento
										if ($value['status'] == "Aberto") {
										?>
										<td><a href="Controller/ControllerPedidos.php?mudarStatusPedido=<?php echo $value['id']; ?>" class="btn btn-info btn-fill"><?php echo $value['status']; ?></a> | 
											<a href="Controller/ControllerPedidos.php?cancelaPedido=<?php echo $value['id']; ?>" class="btn btn-danger btn-fill">Cancelar</a>
										</td>
										<?php } else { ?>
										<td><a href="Controller/ControllerPedidos.php?entregaPedido=<?php echo $value['id']; ?>" class="btn btn-info btn-fill"><?php echo $value['status']; ?></a></td>
										<?php } ?>

									</tr>
									<?php }//Fechar o foreach da listagem
									?>

								</tbody>
							</table>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>


</html>
