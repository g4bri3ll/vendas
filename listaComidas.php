<?php
session_start();

unset( $_SESSION['arrayLanches'] );

include "C:\\xampp\htdocs\Controle_vendas\Model\DAO\LancheDAO.php";
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Lista de Comidas</title>

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
$prdDAO = new LancheDAO();
$arrayComidas = $prdDAO->listaComidas();

if (!empty($_SESSION['cracha'])) {
?>

<div class="content" style="padding-top: 2%;">
	<div class="container-fluid">
			
		<?php
			$a = 1;
			for ($i = 0;$i < count($arrayComidas);$i++) {
		
			if ($a > $i) {
		?>
		<div class="row" align="center">		
		<?php } ?>
			
			<div class="col-md-4">
				<a href="Controller/ControllerPedidos.php?idProduto=<?php echo $arrayComidas[$i]['id']; ?> ">
					<div class="card">
						<div class="header">
							<h4 class="title"><?php echo $arrayComidas[$i]['nome']; ?></h4>
							<p><?php echo $arrayComidas[$i]['valor']; ?></p>
							<hr />
							<img class="" src="Fotos/Lanches/<?php echo $arrayComidas[$i]['foto']; ?>" alt="..." />
						</div>
					<br /><br />
					</div>
				</a>
			</div>

		<?php if ($a < $i) { ?>
			
		<?php } if ($i == 2) {
			$a = $a + 2;
		} ?>

		<?php } ?>

		</div>
	</div>
</div>

<?php 
} else {
	header('Location: senha.php');
} 
?>

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
