<?php
session_start();

include "C:\\xampp\htdocs\Controle_vendas\Model\DAO\LancheDAO.php";
include "C:\\xampp\htdocs\Controle_vendas\Model\DAO\FormaPgtoDAO.php";
include "C:\\xampp\htdocs\Controle_vendas\Model\DAO\ItensAdicionalDAO.php";
include_once "C:\\xampp\htdocs\Controle_vendas\Model\DAO\FavoritosDAO.php";
include_once "C:\\xampp\htdocs\Controle_vendas\Model\DAO\IngredienteDAO.php";

date_default_timezone_set('America/Sao_Paulo');

$idPedido = 0;
$valorTotalPago = 0;

//Destroy todo o array que estiver na session 
unset($_SESSION['arrayLanches']);
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Finalizar o pedido selecionado</title>

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
						<div class="col-md-12">
							<div class="card">

                                <?php if (!empty($_SESSION['addItem'])) { ?>
                                <br /><div class="alert alert-success">
                                    <button type="button" aria-hidden="true" class="close">×</button>
                                    <span><b> Item adicionar ao lanche com sucesso !!!! </b></span>
                                </div>
                                <?php } ?>

                                <?php
                                $cracha = $_SESSION['cracha'];
                                $data   = date('Y-m-d');
                                //Lista todos os pedidos selecionados pelo cliente
                                $lanDAO = new LancheDAO();
                                $arrayPedidos = $lanDAO->ListaPedidoTemp($cracha, $data);

                                //Se não existe mais lanche para lista ele redirecionar para a pagina inicial senha.php
                                if (empty($arrayPedidos)) {
                                    header("Location: senha.php");
                                }
                                ?>
								<div class="header">
									<h4 class="title">Lista de pedidos para compras</h4>
								</div>
								<div class="content table-responsive table-full-width">
									<table class="table table-hover table-striped">
										<thead>
											<th>Nª Pedido</th>
											<th>Nome do pedido</th>
                                            <th>Valor do pedido</th>
											<th>Forma de Pgto</th>
                                            <th>Adicionar Itens</th>
                                            <th>Itens</th>
                                            <th>Status</th>
                                            <th>Excluir</th>
										</thead>
										<tbody>
                                            <?php 
                                                foreach ($arrayPedidos as $lanDAO => $value) { 

                                                    //Pegar o numero do pedido
                                                    $idPedido = $value['id_pedido'];

                                                    /*Pegar o itens adicionais para os clientes
                                                    */
                                                    $valida = false;
                                                    $idlanche = $value['id_lanche'];
                                                    $lanDAO = new LancheDAO();
                                                    $arrayItensAdd = $lanDAO->verificarItensAdd($idlanche);
                                                    if (!empty($arrayItensAdd)) {
                                                        $valida = true;
                                                    }


                                                    /*Verificar se o lanche possui algum item adicionado
                                                    */
                                                    $idTempVendas = $value['id'];
                                                    //Lista itens adicionais comprados
                                                    $iteDAO = new ItensAdicionalDAO();
                                                    $arrayItemComprado = $iteDAO->listaItensComprados($idTempVendas);

                                                    $valorTotal = $value['valor'];
                                                    //Só faz o foreach se estiver o item
                                                    if (!empty($arrayItemComprado)) {
                                                        
                                                        //Pegar o valor do lanche e soma com os valores do itens adicionado
                                                        $valorLote = 0;
                                                        foreach ($arrayItemComprado as $iteDAO => $itemm) {

                                                            $valorItem = $itemm['valor_item'] * $itemm['qtd'];
                                                            
                                                            $valorLote = $valorLote + $valorItem;
                                                            
                                                        }

                                                        $valorTotal = $valorTotal + $valorLote;

                                                    }


                                                    $ingDAO = new IngredienteDAO();
                                                    $arrayIngredientes = $ingDAO->listaIngredientesPorLanche($idlanche);

                                                    //Pegar o nome do tipo de pagamento
                                                    //$idPgto = $value['id_forma_pgto'];
                                                    //Soma o valor total de cada produto comprado
                                                    
                                            ?>
											<tr>
												<td><?php echo $value['n_pedido']; ?></td>
                                                <td><?php echo $value['nome']; ?></td>
                                                <td><?php echo $valorTotal; ?></td>
                                                <td><?php echo $value['forma_pgto']; ?></td>

                                                <?php if ($valida) { ?>
                                                <td><a href="Controller/ControllerPedidos.php?addItem=muito&idItemPedido=<?php echo $value['id']; ?>" type="submit" class="btn btn-info btn-fill pull-center">Add itens</a></td>    
                                                <?php } else { ?>
                                                <td><a href="#" type="submit" class="btn btn-fill pull-center">Add itens</a></td>
                                                <?php } ?>

                                                
                                                <td align="center"><a href="#" data-toggle="modal" data-target="#myModal<?php echo $value['id']; ?>"><i class="pe-7s-search"></i></a></td>

                                                
                                                <!-- The Modal -->
                                                  <div class="modal" id="myModal<?php echo $value['id']; ?>">
                                                    <div class="modal-dialog">
                                                      <div class="modal-content">
                                                      
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                          <h4 class="modal-title"><?php echo $value['nome']; ?></h4>
                                                        </div>
                                                        
                                                        <!-- Modal body -->
                                                        <div class="modal-body">

                                                        INGREDIENTES
                                                        <?php 
                                                        foreach ($arrayIngredientes as $ingDAO => $value) {

                                                            echo "<br />" . $value['qtd'] . " - "; 

                                                            echo $value['nome_ingredientes']; 

                                                        ?>
                                                        <?php } ?>
                                                        <hr style="color: #9400D3; background-color: #9400D3; height: 2px;" />

                                                        
                                                        ITENS ADICIONAIS
                                                        <br />

                                                        <?php 
                                                        foreach ($arrayItemComprado as $iteDAO => $valueItem) {

                                                            echo $valueItem['qtd'] . " - "; 

                                                            echo $valueItem['nome_item']; 

                                                        ?>
                                                        <a href="Controller/ControllerPedidos.php?excluirItem=<?php echo $valueItem['id']; ?>"><i class="pe-7s-close pull-right"></i></a>
                                                        <br />
                                                        <?php } ?>

                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        </div>
                                                        
                                                      </div>
                                                    </div>
                                                  </div>


                                                <td><?php echo $value['status']; ?></td>

                                                <td align="center"><a href="Controller/ControllerPedidos.php?excluirPedido=<?php echo $value['id']; ?>"><i class="pe-7s-trash"></i></a></td>

											</tr>
                                            <?php 
                                                //Soma o valor total a pagar de todo o lanche
                                                $valorTotalPago = $valorTotalPago + $valorTotal;
                                            } 
                                            ?>
										</tbody>
									</table>

								</div>
							</div>
						</div>
					</div>

                    <div class="header">
                        <h6 class="title">Total a pagar: <label> <?php echo number_format($valorTotalPago, 2, ',', '.' ); ?> </label> </h6>
                    </div>

                    <?php
                    //Lista os valores comprados
                    $forDAO = new FormaPgtoDAO();
                    $arrayPgto = $forDAO->ListaFormaPgto();
                    ?>
                    <div class="content">
                        <div id="chartHours" class="ct-chart"></div>
                        <div class="footer">
                            <div class="legend">
                                <?php foreach ($arrayPgto as $forDAO => $value) { ?>
                                    <i class="fa fa-circle text-danger"></i><?php echo $value['forma_pgto'];?> <i class="pe-7s-shuffle"></i> R$  <br />
                                <?php } ?>
                            </div>
                        </div>
                    </div>


                    <hr style="color: #696969; background-color: #696969; height: 2px;" />
                    <?php 
                    //verificar se o cliente pode salvar como favorito ainda
                    ?>

                    <form action="Controller/ControllerPedidos.php?finalizar=<?php echo $idPedido; ?>" method="POST">

                        <?php
                        $idCliente = $_SESSION['id'];
                        //Verifica se o cliente tem cadastro de quantidade de favoritos
                        $favDAO = new FavoritosDAO();
                        $arrayFavor = $favDAO->verificaQtdFav($idCliente);

                        $qtd = 0;
                        $qtdCliente = 0;
                        foreach ($arrayFavor as $favDAO => $value) {
                            $qtd        = $value['qtd'];
                            $qtdCliente = $value['qtd_cliente'];
                        }
                        if ($qtd > $qtdCliente) {
                        ?>

                        <div class="checkbox">
                            <input id="checkbox1" type="checkbox" name="checkbox">
                            <label for="checkbox1"><p style="color: blue;">Colocar este pedido como favorito?</p></label>
                        </div>

                        <?php } ?>

                        <div class="row">
                            <div class="col-md-4" align="center" style="padding-top: 2%;">
                                <a href="selecionarPedidos.php" class="btn btn-fill btn-warning">Fazer Outro Pedido</a>
                            </div>
                            <div class="col-md-4" align="center" style="padding-top: 2%;">
                                <a href="Controller/ControllerPedidos.php?cancelarPedido=<?php echo $idPedido; ?>" class="btn btn-fill btn-warning">Cancelar Todo o Pedido</a>
                            </div>
                            <div class="col-md-4" align="center" style="padding-top: 2%;"> 
                                <input type="submit" class="btn btn-fill btn-warning" value="Terminar Pedido" />
                            </div>
                        </div>

                    </form>

                </div>
                <div class="col-md-2">
                </div>

            </div>
        </div>
    </div>
</div><br /><br />

<?php 
} else {
	header('Location: senha.php');
} 
//Matar a session da mensagem: ao item adicional cadastro com sucesso
unset($_SESSION['addItem']);
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
