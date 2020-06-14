<?php
session_start();

include_once "C:\\xampp\htdocs\Controle_vendas\Model\DAO\ItensAdicionalDAO.php";
include_once "C:\\xampp\htdocs\Controle_vendas\Model\DAO\LancheDAO.php";
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Cadastro de Opções Adicionais</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

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

    $itemAdd = $_GET['idItem'];

    $iteDAO = new ItensAdicionalDAO();
    $arrayItemAdd = $iteDAO->listaItensAdd($itemAdd);

    $nomeLanche = 0;
    foreach ($arrayItemAdd as $iteDAO => $value) {
        $nomeLanche = $value['nome'];
    }

?>

<div class="wrapper" style="padding-top: 2%;">
	<div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        
                        <div class="alert alert-danger" align="center">
                            <span><b> Atenção !!!</b><br/> O item adicionado, só vale pra um item</span>
                        </div>

                        <div class="header">
                            <h4 class="title">Adicionar itens adicionais - <?php echo $nomeLanche; ?></h4>
                        </div>
                        <div class="content">
                            <form action="Controller/ControllerPedidos.php?idItem=2200" method="POST">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="table-full-width">
                                            <table class="table">
                                                <tbody>
                                                    <?php foreach ($arrayItemAdd as $iteDAO => $value) { ?>
                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <input id="checkbox<?php echo $value['id'] ?>" value="<?php echo $value['id'] ?>" name="checkbox[]" type="checkbox" checked >
                                                                <label for="checkbox<?php echo $value['id'] ?>"></label>
                                                            </div>
                                                        </td>
                                                        <td><?php echo $value['nome_item']; ?></td>
                                                        <td><?php echo $value['valor_item']; ?></td>
                                                        <input type="text" name="idTempVendas[]" value="<?php echo $value['id_temp_vendas']; ?>" readonly style="display: none !important;"/>
                                                        <td class="td-actions text-right">        
                                                        <div class="form-group">
                                                            <input type="number" class="form-control" placeholder="Quantidade do item" name="qtd[]" />
                                                        </div>
                                                        </td>
                                                    </tr>

                                                    <?php } ?>

                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr />
                                <input type="submit" value="Adiciona opção adicional" class="btn btn-info btn-fill pull-right" />
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
} else {
    echo "Cracha não achado na session";
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
