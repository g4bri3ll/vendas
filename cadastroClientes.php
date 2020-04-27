<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Cadastro de clientes</title>

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
                <a href="http://www.creative-tim.com" class="simple-text">
                    Creative Tim
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
                        <p>Produtos</p>
                    </a>
	                <ul class="collapse list-unstyled" id="homeProduto">
	                    <li>
	                    	<a class="subMenu" href="criarProdutos.php">Criar Produtos</a>
	                    </li>
	                    <li>
	                    	<a class="subMenu" href="listaProdutos.php">Lista de Produtos</a>
	                    </li>
	                    <li>
	                    	<a class="subMenu" href="cadastroIngredientes.php">Cadastrar Ingredientes</a>
	                    </li>
	                </ul>
                </li>
                <li class="active">
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
	                    	<a class="subMenu" href="#">Home 3</a>
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
                            <div class="header">
                                <h4 class="title">Cadastro de clientes</h4>
                            </div>
                            <div class="content">
                                <form action="Controller/ControllerClientes.php" method="POST">
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nome do cliente <b style="color: red;"> * </b> </label>
                                                <input type="text" class="form-control" placeholder="nome do cliente" name="nomeCliente"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nª do crachá <b style="color: red;"> * </b> </label>
                                                <input type="text" class="form-control" name="cracha">
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
                                                <label>E-mail do cliente</label>
                                                <input type="email" class="form-control" placeholder="E-mail do cliente" name="email"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Endereço do cliente</label>
                                                <input type="text" class="form-control" placeholder="Endereço do cliente" name="enderecoCliente"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Foto do cliente</label>
                                                <input type="file" class="form-control" name="foto"/>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Criar cliente</button>
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