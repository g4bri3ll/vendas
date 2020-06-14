<?php
session_start();
session_destroy();
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Seleção de pedidos</title>

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

<div class="wrapper">
	<div class="content" style="padding-top: 2%;">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						
						<?php if (!empty($_GET['erro'])) { ?>
							<div class="alert alert-danger">
	                            <span><b> Crachá não encontrado !!!! </b></span>
	                        </div>
	                    <?php } ?>

	                    <?php if (!empty($_GET['error'])) { ?>
							<div class="alert alert-danger">
	                            <span><b> Código do favorito não existe, verifique e tente novamente !!!! </b></span>
	                        </div>
	                    <?php } ?>

						<div class="header">
							<h4 class="title">Informe seu crachá / favorito</h4>
						</div>
						<div class="content">
							<form action="Controller/ControllerPedidos.php" method="POST">
								<div class="row">
									<div class="col-md-10">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Informe seu crachá ou o código do favorito" name="cracha">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<select class="form-control" name="opcao">
												<option value="1">Cracha</option>
												<option value="2">Favorito</option>
											</select>
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
