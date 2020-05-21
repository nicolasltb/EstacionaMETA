<?php
session_start();
include_once 'php/conexao.php';
 ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Login</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="stylesheet" href="css/fadeIn.css">
        <link rel="stylesheet" href="css/personalizado.css"/>
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
				<h1><a>Estaciona<span id="metaTitulo">META</span></a></h1>
			</div>
		</div>
		</div>
	<!-- Header -->

	<!-- Main -->

		<div id="main">

			<?php
				if(!isset($_SESSION['usuarioID']) ){
      		echo '<div class="logincadastro">';
      		echo  '<h1>Login</h1>';
      		echo'<form action="php/realizarLogin.php" method="post">';
      		echo'  <input name = "usuario" placeholder="Usuario ou Email"><br>';
      		echo'  <input name="senha" type="password" placeholder="Senha"><br>';
      		echo  '<button type="submit" name="logar" class="button button-style1">Login</button>';
      		echo '  <button type="button" class="button button-style1"><a href="cadastro.php">Cadastro</a></button></form>';
      		echo '</div>';
				} else {
					echo '<div id="perfil">';
					echo '<h1 id="bemvindo">Bem vindo, '.$_SESSION['usuarioNome']."</h1>";
					echo '<div class="estacionamentos">';
					echo '<h1>Seus Estacionamentos:</h1>';
					//checa se conexão foi feita com sucesso
					if($conexao){
						$sql = "SELECT * FROM estacionamentos WHERE dono=?";
	          $stmt = mysqli_stmt_init($conexao);
	          //checa se é possivel executar declaracao
	          if(mysqli_stmt_prepare($stmt,$sql)){
	            mysqli_stmt_bind_param($stmt,"s",$_SESSION['usuarioNome']);
	            mysqli_stmt_execute($stmt);
	            mysqli_stmt_store_result($stmt);
	            //checa se estacionamento ja havia sido cadastrado
	            if(mysqli_stmt_num_rows($stmt) > 0){
								echo "<ul>";
								 $stmt = mysqli_stmt_init($conexao);
								  if(mysqli_stmt_prepare($stmt,$sql)){
										mysqli_stmt_bind_param($stmt,"s",$_SESSION['usuarioNome']);
									 	mysqli_stmt_execute($stmt);
										$resultado = mysqli_stmt_get_result($stmt);
									 while($linha = mysqli_fetch_assoc($resultado)){
										 echo "<li>".$linha['lugar']."</li>";
									}
									echo "</ul>";
								}
							} else {
								echo "Você não tem nenhum estacionamento cadastrado.Cadastre abaixo!";
						}
					}
					echo '</div>';
					echo '<div class="estacionamentos">';
					echo '<h1>Cadastrar Estacionamento:</h1>';
					echo '<form action="php/cadastrarEstacionamento.php" method="post">';
					echo'  <input id="inptLogin" name="lugar" placeholder="Nome do Estabelecimento"><br>';
				  echo  '<button type="submit" name="cadastrarEstacionamento" class="button button-style1">Cadastrar</button></form>';
					echo '</div>';
					echo '<form method="post">';
					echo  '<button id="sair" type="submit" name="sair" class="button button-style1">Sair</button>';
					echo '</form>';
					echo '</div>';
				}
			}
			?>
      <?php
        if(isset($_GET['error']) ){
          echo "<p id = 'erro' style='text-align:center;font-size:20px'><strong>Erro: </strong>".$_GET['error']."</p>";
        }
        if(isset($_POST['sair']) ){
            session_destroy();
        }
      ?>
		</div>
        


	</body>
</html>
