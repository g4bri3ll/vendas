<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Cadastro de fornecedor</title>

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

    <style type="text/css">
    	.subMenu{
    		padding-left: 10%;
    	}
    </style>
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    Sistema de lanches
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="index.php">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="#homeProduto" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="pe-7s-user"></i>
                        <p>Lanches</p>
                    </a>
	                <ul class="collapse list-unstyled" id="homeProduto">
	                    <li>
	                    	<a class="subMenu" href="criarLanches.php">Criar Lanches</a>
	                    </li>
	                    <li>
	                    	<a class="subMenu" href="listaLanches.php">Lista de Lanches</a>
	                    </li>
	                    <li>
	                    	<a class="subMenu" href="criarOpcaoAdicionais.php">Cadastrar Opções adicionais</a>
	                    </li>
                        <li>
                            <a class="subMenu" href="cadastrarIngredientes.php">Cadastrar ingredientes lanches</a>
                        </li>
	                </ul>
                </li>
                <li>
                    <a href="#homeClientes" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="pe-7s-user"></i>
                        <p>Clientes</p>
                    </a>
	                <ul class="collapse list-unstyled" id="homeClientes">
	                    <li>
	                    	<a class="subMenu" href="cadastroClientes.php">Cadastrar Clientes</a>
	                    </li>
	                    <li>
	                    	<a class="subMenu" href="listaClientes.php">Lista de Clientes</a>
	                    </li>
                        <li>
                            <a class="subMenu" href="#">Lista Clientes Fiados</a>
                        </li>
	                    <li>
	                    	<a class="subMenu" href="#">Home 4</a>
	                    </li>
	                </ul>
                </li>
                <li>
                    <a href="#homeFuncionarios" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="pe-7s-user"></i>
                        <p>Funcionarios</p>
                    </a>
	                <ul class="collapse list-unstyled" id="homeFuncionarios">
	                    <li>
	                    	<a class="subMenu" href="cadastroFuncionarios.php">Cadastrar Funcionarios</a>
	                    </li>
	                    <li>
	                    	<a class="subMenu" href="listaFuncionarios.php">Lista de Funcionarios</a>
	                    </li>
	                    <li>
	                    	<a class="subMenu" href="#">Home 3</a>
	                    </li>
	                </ul>
                </li>
                <li>
                    <a href="#homeFornecedor" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="pe-7s-user"></i>
                        <p>Fornecedor</p>
                    </a>
	                <ul class="collapse list-unstyled" id="homeFornecedor">
	                    <li>
	                    	<a class="subMenu" href="cadastrarFornecedor.php">Cadastro Fornecedor</a>
	                    </li>
	                    <li>
	                    	<a class="subMenu" href="listaFornecedor.php">Lista de Fornecedor</a>
	                    </li>
	                    <li>
	                    	<a class="subMenu" href="#">Home 3</a>
	                    </li>
	                </ul>
                </li>
                <li>
                    <a href="#homePgto" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="pe-7s-user"></i>
                        <p>Formas de Pgto</p>
                    </a>
                    <ul class="collapse list-unstyled" id="homePgto">
                        <li>
                            <a class="subMenu" href="cadastrarFormaPgto.php">Cadastrar a forma de pagamento</a>
                        </li>
                        <li>
                            <a class="subMenu" href="listaFormaPgto.php">Lista as formas de pagamento</a>
                        </li>
                        <li>
                            <a class="subMenu" href="#">Home 3</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#homeFiado" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="pe-7s-user"></i>
                        <p>Configurações</p>
                    </a>
                    <ul class="collapse list-unstyled" id="homeFiado">
                        <li>
                            <a class="subMenu" href="cadastrarClienteFiados.php">Cadastrar Clientes Fiado</a>
                        </li>
                        <li>
                            <a class="subMenu" href="configurarContaCliente.php">Clientes X Forma de pgto</a>
                        </li>
                        <li>
                            <a class="subMenu" href="configClientesXFavoritos.php">Clientes X Favoritos</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#homePainel" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="pe-7s-user"></i>
                        <p>Painel Administrativo</p>
                    </a>
                    <ul class="collapse list-unstyled" id="homePainel">
                        <li>
                            <a class="subMenu" href="#">Cadastrar Empresa</a>
                        </li>
                        <li>
                            <a class="subMenu" href="#">Conceder permisssão de acesso</a>
                        </li>
						<li>
                            <a class="subMenu" href="#">Lista de permissão de acessos</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#homerelatorio" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="pe-7s-user"></i>
                        <p>Relatorios</p>
                    </a>
                    <ul class="collapse list-unstyled" id="homerelatorio">
                        <li>
                            <a class="subMenu" href="#">Nomes funcionarios</a>
                        </li>
                        <li>
                            <a class="subMenu" href="#">Vendas por datas</a>
                        </li>
                        <li>
                            <a class="subMenu" href="#">Vendas X Forma de pgto</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#homeVendas" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="pe-7s-user"></i>
                        <p>Vendas</p>
                    </a>
	                <ul class="collapse list-unstyled" id="homeVendas">
	                    <li>
	                    	<a class="subMenu" href="cadastrarLanchesVendidos.php">Cadastro de lanches vendidos</a>
	                    </li>
	                    <li>
	                    	<a class="subMenu" href="listaVendas.php">Lista de Vendas</a>
	                    </li>
	                    <li>
	                    	<a class="subMenu" href="#">Home 3</a>
	                    </li>
	                </ul>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-panel">
		<nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">User</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-dashboard"></i>
								<p class="hidden-lg hidden-md">Dashboard</p>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-globe"></i>
                                    <b class="caret hidden-sm hidden-xs"></b>
                                    <span class="notification hidden-sm hidden-xs">5</span>
									<p class="hidden-lg hidden-md">
										5 Notifications
										<b class="caret"></b>
									</p>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Notification 1</a></li>
                                <li><a href="#">Notification 2</a></li>
                                <li><a href="#">Notification 3</a></li>
                                <li><a href="#">Notification 4</a></li>
                                <li><a href="#">Another notification</a></li>
                              </ul>
                        </li>
                        <li>
                           <a href="">
                                <i class="fa fa-search"></i>
								<p class="hidden-lg hidden-md">Search</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="">
                               <p>Account</p>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <p>
										Dropdown
										<b class="caret"></b>
									</p>

                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                              </ul>
                        </li>
                        <li>
                            <a href="#">
                                <p>Log out</p>
                            </a>
                        </li>
						<li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">

                            <?php if (!empty($_GET['cad'])) { ?>
                                <br /><div class="alert alert-success">
                                    <button type="button" aria-hidden="true" class="close">×</button>
                                    <span><b> Fornecedor cadastrado com sucesso !!!! </b></span>
                                </div>
                            <?php } ?>

                            <div class="header">
                                <h4 class="title">Cadastro de fornecedor</h4>
                            </div>
                            <div class="content">
                                <form action="Controller/ControllerFornecedor.php" method="POST">
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nome do fornecedor <b style="color: red;"> * </b> </label>
                                                <input type="text" class="form-control" placeholder="nome do fornecedor" name="forncedor"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>CNPJ <b style="color: red;"> * </b> </label>
                                                <input type="text" class="form-control" name="cnpj" placeholder="CNPJ">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Telefone de contato</label>
                                                <input type="text" class="form-control" placeholder="Telefone pra contato" name="telefone">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>E-mail do forncedor</label>
                                                <input type="email" class="form-control" placeholder="E-mail do forncedor" name="email"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Endereço do forncedor</label>
                                                <input type="text" class="form-control" placeholder="Endereço do fornecedor" name="endereco"/>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Criar fornecedor</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portfolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                               Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                </p>
            </div>
        </footer>

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
