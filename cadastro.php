<!DOCTYPE HTML>
<html>
	<head>
		<title>Login</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
    <link rel="stylesheet" href="css/personalizado.css" />
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,700,500,900' rel='stylesheet' type='text/css'>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
		<link rel="icon" href="images/iconSite.png">
		<noscript>
      	<link rel="stylesheet" href="css/personalizado.css" />
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>
	</head>
	<body>

	<!-- Header -->
		<div id="header">
			<div id="nav-wrapper">
				<!-- Nav -->
				<nav id="nav">
					<ul>
						<li class="active"><a href="index.html">Home</a></li>
						<li><a href="mapa.php">Vagas</a></li>
						<li><a href="controleAcesso.php">Controle</a></li>
						<li><a href="diarioBordo.html">Diário</a></li>
						<li><a href="login.php">Perfil</a></li>
					</ul>
				</nav>
			</div>
			<div class="container">

				<!-- Logo -->
				<div id="logo">

				</div>
			</div>
		</div>
	<!-- Header -->

	<!-- Main -->
		<div id="main">
      <div class="logincadastro">
        <h1>Cadastro</h1>
      <form action="php/realizarCadastro.php" method="post">
        <input name="nome" placeholder="Nome"><br>
        <input name = "email" placeholder="Email"><br>
        <input name="senha" type="password" placeholder="Senha"><br>
        <button type="submit" name="cadastrar" class="button button-style1">Cadastrar</button>
      </div>
			<?php
				if(isset($_GET['error']) ){
					echo "<p id = 'erro' style='text-align:center;font-size:20px'><strong>Erro: </strong>".$_GET['error']."</p>";
				}
			?>
		</div>



	</body>
</html>
