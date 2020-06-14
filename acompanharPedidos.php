<?php
session_start();

include "C:\\xampp\htdocs\Controle_vendas\Model\DAO\FavoritosDAO.php";
include "C:\\xampp\htdocs\Controle_vendas\Model\DAO\LancheDAO.php";

date_default_timezone_set('America/Sao_Paulo');
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Acompanhamento de pedidos dos clientes</title>

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
//Valida o crachar pra verificar se e o próprio cliente que está solicitando a visualização
if (!empty($_SESSION['arrayPedidos'])) {

	$arrayLanches = $_SESSION['arrayPedidos'];

	$dataHoje = 0;
	foreach ($arrayLanches as $value) {
		$dataHoje = $value['data_comprado'];
	}
?>

<div class="wrapper">
	<div class="content" style="padding-top: 2%;">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
					<div class="header">
					<h4 class="title">Lista de pedidos abertos</h4>
					<p class="category">Pedidos feito no dia: <?php echo date("d/m/Y", strtotime($dataHoje));?></p>

					<button class="btn btn-info btn-fill pull-right" data-toggle="modal" data-target="#myModal1">Visualizar Favoritos</button>

					</div>
						<div class="content table-responsive table-full-width">
							<table class="table table-hover table-striped">
								<thead>
									<th>Nª Pedido</th>
									<th>Qtd</th>
									<th>Nome do pedidos</th>
									<th>Status</th>
								</thead>
								<tbody>
									<?php foreach ($arrayLanches as $value) { ?>
									<tr>
										<td><?php echo $value['n_pedido']; ?></td>
										<td><?php echo $value['qtd']; ?></td>
										<td><?php echo $value['nome']; ?></td>
										<td><?php echo $value['status']; ?></td>

									</tr>
									<?php } ?>
								</tbody>
							</table>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php
//Pegar os favoritos dos cliente logado com o cracha, para o painel
if (!empty($_SESSION['arrayFavorito'])) {
?>

<!-- The Modal -->
<div class="modal" id="myModal1">
	<div class="modal-dialog">
	  <div class="modal-content">
	  
	    <!-- Modal Header -->
	    <div class="modal-header">
	      <h4 class="modal-title">Favoritos</h4>
	    </div>
	    


	    <!-- Modal body -->
	    	<div class="col-md-12">
                <div class="card card-plain">
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover">
                            <thead>
                                <th>Código</th>
                            	<th>Nome do lanche</th>
                            	<th>Valor</th>
                            	<th>Ex</th>
                            </thead>
                            <tbody>

                            	<?php
							    	$arrayFavorito = $_SESSION['arrayFavorito'];
							    	foreach ($arrayFavorito as $value) {
								    	//Array de pedidos
	                                	$codigo = $value['codigo'];
	                                	$favDAO = new FavoritosDAO();
										$arrayFav = $favDAO->listaLanchesPeloFavoritos($codigo);
						    	?>
                                <tr>
	                                
	                                <td><?php echo $value['codigo']; ?></td>
	                                <td>
	                                	<?php 
	                                	foreach ($arrayFav as $favDAO => $vNome) { 
	                                		echo $vNome['nome'] . "<br />";
	                                	}
	                                	?>
									</td>
									<td>
	                                	<?php 
	                                	foreach ($arrayFav as $favDAO => $vQtd) { 
	                                		echo $vQtd['valor'] . "<br />";
	                                	}
	                                	?>
									</td>
									<td><a href="Controller/ControllerPedidos.php?excluirFavorito=<?php echo $value['id']; ?>"><i class="pe-7s-trash"></i></a></td>

                                </tr>
                            	<?php } ?>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>



	    <!-- Modal footer -->
	    <div class="modal-footer">
	      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	    </div>
	    
	  </div>
	</div>
</div>

<?php } ?>



<?php 
} else { 
session_destroy();
?>

<div class="wrapper">
	<div class="content" style="padding-top: 5%;">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						
						<?php if (!empty($_GET['erro'])) { ?>
							<div class="alert alert-danger">
	                            <button type="button" aria-hidden="true" class="close">×</button>
	                            <span><b> Não existe lanche, cadastrado para o dia de hoje !!!! </b></span>
	                        </div>
	                    <?php } ?>

						<div class="header">
							<h4 class="title">Informe seu crachá</h4>
						</div>
						<div class="content">
							<form action="Controller/ControllerPedidos.php" method="POST">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>CRACHÁ</label>
											<input type="text" class="form-control" placeholder="Home Crachá" name="crachaAcompanha">
										</div>
									</div>
								</div>
								<input type="submit" value="Enviar" class="btn btn-info btn-fill pull-right">
								<a href="senha.php" class="btn btn-info btn-fill pull-left">Retornar</a>
								<div class="clearfix"></div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php } ?>

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
