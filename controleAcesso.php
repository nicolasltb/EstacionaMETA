<?php
session_start();
include_once 'php/conexao.php';
 ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Controle de Acesso</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="stylesheet" href="css/fadeIn.css">
		<link rel="stylesheet" href="css/personalizado.css" />
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,700,500,900' rel='stylesheet' type='text/css'>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
		<link rel="icon" href="images/iconSite.png">
		<noscript>
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
					<h1><a href="#">Controle de Acesso</a></h1>
				</div>
			</div>
		</div>
	<!-- Header -->

	<!-- Main -->
		<div id="main">
			<div id="controleacesso">
				<form action="#" method="post">
					<select name="estacionamentos">
				<?php
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
							 $stmt = mysqli_stmt_init($conexao);
								if(mysqli_stmt_prepare($stmt,$sql)){
									mysqli_stmt_bind_param($stmt,"s",$_SESSION['usuarioNome']);
									mysqli_stmt_execute($stmt);
									$resultado = mysqli_stmt_get_result($stmt);
								 while($linha = mysqli_fetch_assoc($resultado)){
									 echo "<option value='".$linha['lugar']."'>".$linha['lugar']."</option>";
								}
							}
						} else {
							echo "<option>Você não tem nenhum estacionamento cadastrado</option>";
					}
				}
			}

				 ?>
			 </select>
			 <input type="submit" id="buscar" name="buscarEstacionamento" value="🔍">
		 </form>
			</div>
			<div id="tabela">
				<table>
					<tr>
						<th>Nome:</th>
						<th>Entrada:</th>
						<th>Saida:</th>
				<?php
				if(isset($_POST['buscarEstacionamento'])){
					if($conexao){
						$sql = "SELECT * FROM ctrlestacionamento WHERE lugar=?";
						$stmt = mysqli_stmt_init($conexao);
						//checa se é possivel executar declaracao
						if(mysqli_stmt_prepare($stmt,$sql)){
							mysqli_stmt_bind_param($stmt,"s",$_POST['estacionamentos']);
							mysqli_stmt_execute($stmt);
							mysqli_stmt_store_result($stmt);
							//checa se estacionamento ja havia sido cadastrado
							if(mysqli_stmt_num_rows($stmt) > 0){
								echo "<ul>";
								 $stmt = mysqli_stmt_init($conexao);
									if(mysqli_stmt_prepare($stmt,$sql)){
										mysqli_stmt_bind_param($stmt,"s",$_POST['estacionamentos']);
										mysqli_stmt_execute($stmt);
										$resultado = mysqli_stmt_get_result($stmt);
									 while($linha = mysqli_fetch_assoc($resultado)){
										 echo "<tr><td>".$linha['nome']."</td><td>".$linha['entrada']."</td><td>";
										 if($linha['saida']!=null){
										   echo $linha['saida']."</td></tr>";
										 } else {
										   echo "Não houve saída</td></tr>";
										 }
									}

								}
							} else {
								echo "<p style='text-align:center'>Ainda não há dados para esse Estacionamento.</p>";
						}
					}
					}
				}
				 ?>
				 	</table>
			</div>

		</div>


	</body>
</html>
