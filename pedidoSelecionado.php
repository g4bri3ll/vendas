<?php
session_start();

include "C:\\xampp\htdocs\Controle_vendas\Model\DAO\FormaPgtoDAO.php";

$arrayLanches = $_SESSION['arrayLanches'];
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Seleciona pedidos</title>

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
if (!empty($_SESSION['cracha'])) {
?>

<div class="wrapper"><br /><br />
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <div class="row">

                        <?php 
                            foreach ($arrayLanches as $value) { 
                            $valorPorcetagem = ($value['porcetagem'] / 100) * $value['valor'];
                            $valorTotal = $valorPorcetagem + $value['valor'];
                        ?>
                        <div class="col-md-4">
                            <div class="card">

                                <div class="header" align="center">
                                    <h4 class="title"><?php echo number_format($valorTotal, 2, '.', ''); ?></h4>
                                    <p class="category"><?php echo $value['nome']; ?></p>
                                </div>
                                <div class="content">
                                    <img class="" src="Fotos/Lanches/<?php echo $value['foto']; ?>" alt="..." width="100%" height="100%" /><br /><br />

                                    <div class="footer" align="center">
                                        <div class="legend">
                                            <form method="POST" action="Controller/ControllerPedidos.php">
                                                
                                                <input type="number" name="qtd" value="1"><br /><br />

                                                <input type="text" name="idFormaPgto" value="<?php echo $value['id']; ?>" readonly style="display: none !important;"/>

                                                <input type="text" name="valorTotal" value="<?php echo $valorTotal; ?>" readonly style="display: none !important;"/>

                                                <input type="text" name="idLanche" value="<?php echo $value['id_lanche']; ?>" readonly style="display: none !important;"/>

                                                <?php 
                                                //Verificar se o id da forma de pagamento está cadastro na tabela que, autorizar apenas alguns
                                                $idFormaPgto = $value['id'];
                                                $idCliente   = $_SESSION['id'];

                                                $forDAO = new FormaPgtoDAO();
                                                $arrayVerifica = $forDAO->validaClientePagamento($idFormaPgto);

                                                //Se o id forma de pagamento existe, ele faz a validação
                                                if (!empty($arrayVerifica)) {
                                                    
                                                    $val = 0;
                                                    foreach ($arrayVerifica as $forDAO => $v) {
                                                        if ($idCliente == $v['id_cliente']) {
                                                            $val = 1;
                                                        } 
                                                        
                                                    }
                                                    if ($val == 1) {
                                                            ?>
                                                                <input type="submit" class="btn btn-danger btn-block" value="<?php echo $value['forma_pgto']; ?>" />
                                                            <?php
                                                        } else {
                                                            ?>
                                                                <input type="submit" class="btn btn-danger btn-block" value="Sem permissão" disabled="disabled" />
                                                            <?php
                                                        }

                                                } else {
                                                ?>
                                                    <input type="submit" class="btn btn-danger btn-block" value="<?php echo $value['forma_pgto']; ?>" />
                                                <?php } ?>

                                            </form>
                                            
                                        </div>                                        
                                    </div>

                                </div>
                            </div>
                        </div>
                        
                        <?php } ?>

                    </div>

                </div>
                <div class="col-md-2">
                </div>
            </div>
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
