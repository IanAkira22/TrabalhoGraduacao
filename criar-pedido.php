<?php

	include('classes/DataBase.php');
	include('classes/Log.php');
	include('classes/Imagem.php');
	include('classes/Post.php');
	
	
	if( Login::isLoggedIn() == true){
		
		$loggedId = Login::isLoggedIn();
		
		//echo("Logged in ID: " .$loggedId);
	}
	else{
		
		die('<script>alert("Usuario Não loggado"); </script>');
	}


	if (isset($_GET['userid']) == true){
		
		if(DB::query('SELECT id FROM usuarios WHERE id=:userid', array(':userid'=>$loggedId)) == true){
			
			$userId = $_GET['userid'];
			
			
			if(isset($_POST['createrequest']) == true){
				
				if($_POST['nome'] == "" || $_POST['estado'] == "" || $_POST['cidade'] == "" || $_POST['idade'] == "" || $_FILES['postimg']['size'] == 0){
					
					echo('<script>alert("Campos em branco tem que ser preenchidos"); </script>');
				}
				else{
					
					$requestId = Postar::criarPost($_POST['nome'], $_POST['idade'], $_POST['data'], $_POST['estado'], $_POST['cidade'], $_POST['local'], $_POST['sexo'], $loggedId, $userId);
					Imagem::uploadImagem('postimg', $requestId);
				}
			}
		}
	}
	
?>

<!DOCTYPE html>

<html>

	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<title>TG</title>
		
		<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/fonts/ionicons.min.css">
		<link rel="stylesheet" href="assets/css/Footer-Dark.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css">
		<link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
		<link rel="stylesheet" href="assets/css/Navigation-Clean1.css">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/untitled.css">
		
	</head>

	<body>



		<header class="hidden-sm hidden-md hidden-lg">
			<div class="searchbox">
				<form>
					
					<h1 class="text-left">TG</h1>
					
					
					<div class="dropdown">
					
						<button class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" type="button">MENU <span class="caret"></span></button>
						
						<ul class="dropdown-menu dropdown-menu-right" role="menu">
							<li role="presentation" ><a href="#" id="perfil1">Meu Perfil</a></li>
							<li class="divider" role="presentation"></li>
							<li role="presentation"><a href="#" id="timeline1">Timeline </a></li>
							<li role="presentation" class="active"><a href="#" id="criarpedido1">Criar Pedido de procura </a></li>
							<li role="presentation"><a href="#" id="pedidoprocura1">Pedidos de procura</a></li>
							<li role="presentation"><a href="#" id="cartazprocura1">Criar cartaz </a></li>
							<li role="presentation"><a href="#" id="logout1">Logout </a></li>
						</ul>
						
					</div>
					
				</form>
				
			</div>
			<hr>
		</header>
		
		
		
		<div>
		
			<nav class="navbar navbar-default hidden-xs navigation-clean">
			
				<div class="container">
				
					<div class="collapse navbar-collapse" id="navcol-1">
						
						<ul class="nav navbar-nav hidden-md hidden-lg navbar-right">
						
							<li role="presentation" class="active"><a href="#">Criar pedido de procura</a></li>
							<li class="dropdown open"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" href="#">Usuário <span class="caret"></span></a>
								<ul class="dropdown-menu dropdown-menu-right" role="menu">
									<li role="presentation" ><a href="#" id="perfil2">Meu Perfil</a></li>
									<li class="divider" role="presentation"></li>
									<li role="presentation"><a href="#" id="timeline2">Timeline </a></li>
									<li role="presentation"><a href="#" id="criarpedido2">Criar Pedido de procura </a></li>
									<li role="presentation"><a href="#" id="pedidoprocura2">Pedidos de procura </a></li>
									<li role="presentation"><a href="#" id="cartazprocura2">Criar Cartaz</a></li>
									<li role="presentation"><a href="#" id="logout2">Logout </a></li>
								</ul>
							</li>
						</ul>
						
						<ul class="nav navbar-nav hidden-xs hidden-sm navbar-right">
						
							<li role="presentation"><a href="#" id="timeline3">Timeline</a></li>
							<li role="presentation" class="active"><a href="#" id="criarpedido3">Criar Pedido de procura </a></li>
							<li role="presentation"><a href="#" id="pedidoprocura3">Pedidos de procura</a></li>
							<li role="presentation"><a href="#" id="cartazprocura3">Criar Cartaz</a></li>
							<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">Usuário <span class="caret"></span></a>
								
								<ul class="dropdown-menu dropdown-menu-right" role="menu">
									<li role="presentation" ><a href="#" id="perfil3">Meu Perfil</a></li>
									<li class="divider" role="presentation"></li>
									<li role="presentation"><a href="#" id="logout3">Logout </a></li>
								</ul>
								
							</li>
							
						</ul>
						
					</div>
					
				</div>
				
			</nav>
			
		</div>
		
		
		
		<div class="container">
			<h1> Crie o seu pedido de procura  </h1><br><br>
		</div>
		
		
		
		
		<div>

			<div class="container">
			
				<div class="row">
				
					<div class="col-md-3">
					
						<ul class="list-group">
						
							<li class="list-group-item"><span><strong>Criar Pedido de Procura</strong></span><br>
								<br>
								<?php
									echo("Aqui você irá poderá inserir os dados de uma pessoa desaparecida para criar um pedido de procura que será exibido a outros usuários" . "<br>");
								?>
							</li>
							
						</ul>
						
					</div>
				
				
					<div class='col-md-6'>
					
						<li class='list-group-item'>
						
							<div>
							
								<form action="criar-pedido.php?userid=<?php echo($loggedId);?>" method="post" enctype="multipart/form-data">

									<br>
									<h3 class="visually-hidden"> <strong> Insira os dados da pessoa desaparecida para a criação do pedido de procura</strong></h3>
									<br>
									<br>
									
									<label>Nome Completo</label>
									<input class="form-control" type="text" name="nome" placeholder="Nome Completo (Campo Obrigatório)" style="width:400px; height:25px;">
									<br>
									
									<label>Idade</label>
									<input class="form-control" type="text" name="idade" placeholder="Idade" style="width:100px; height:25px;">
									<br>
									
									<label>dia/mês/ano que a pessoa voi vista pela ultima vez</label>
									<input class="form-control" type="date" name="data" placeholder="dd/mm/aaaa" style="width:160px; height:25px;">
									<br>
									
									<label>Estado de residência</label>
									<input class="form-control" type="text" name="estado" placeholder="Estado (Campo Obrigatório)" style="width:400px; height:25px;">
									<br>
									
									<label>Cidade de Residência</label>
									<input class="form-control" type="text" name="cidade" placeholder="Cidade (Campo Obrigatório)" style="width:400px; height:25px;">
									<br>
									
									<label>Local onde a pessoa foi vista pela ultima vez (Rua ou Bairro)</label>
									<input class="form-control" type="text" name="local" placeholder="Rua ou Bairro" style="width:500px; height:25px;">
									<br>
									
									<label>Sexo da pessoa desaparecido(Masculino ou Feminino)</label><br>
									<select name="sexo">
										<option value="M">M</option>
										<option value="F">F</option>
									</select>
									<br><br>
									
									<input type="file" name="postimg">
									<br><br>
									
									<input type="submit" class="btn btn-default" type="button" name="createrequest" value="Criar Pedido" style="background-image:url(&quot;none&quot;);background-color:#da052b;color:#fff;padding:16px 32px;margin:0px 0px 6px;border:none;box-shadow:none;text-shadow:none;opacity:0.9;text-transform:uppercase;font-weight:bold;font-size:13px;letter-spacing:0.4px;line-height:1;outline:none;" />
									
									<br>
									<br>
									<br>
						
								</form>
								
							</div>
							
						</li>
						
					</div>
		
				</div>
				
			</div>
			
		</div>
		
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="assets/js/bs-animation.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
		
		<script type="text/javascript">
			
			var timeline1 = document.getElementById('timeline1');
			var timeline2 = document.getElementById('timeline2');
			var timeline3 = document.getElementById('timeline3');
			timeline1.addEventListener('click', function() { document.location.href = '<?php echo("timeline.php?userid=" . $loggedId ) ?>'; });
			timeline2.addEventListener('click', function() { document.location.href = '<?php echo("timeline.php?userid=" . $loggedId ) ?>'; });
			timeline3.addEventListener('click', function() { document.location.href = '<?php echo("timeline.php?userid=" . $loggedId ) ?>'; });
			
			
			var perfil1 = document.getElementById('perfil1');
			var perfil2 = document.getElementById('perfil2');
			var perfil3 = document.getElementById('perfil3');
			perfil1.addEventListener('click', function() { document.location.href = '<?php echo("perfil.php?userid=" . $loggedId ) ?>'; });
			perfil2.addEventListener('click', function() { document.location.href = '<?php echo("perfil.php?userid=" . $loggedId ) ?>'; });
			perfil3.addEventListener('click', function() { document.location.href = '<?php echo("perfil.php?userid=" . $loggedId ) ?>'; });
			
			
			
			var pedidoprocura1 = document.getElementById('pedidoprocura1');
			var pedidoprocura2 = document.getElementById('pedidoprocura2');
			var pedidoprocura3 = document.getElementById('pedidoprocura3');
			pedidoprocura1.addEventListener('click', function() { document.location.href = '<?php echo("procurar-pedido.php?userid=" . $loggedId ) ?>'; });
			pedidoprocura2.addEventListener('click', function() { document.location.href = '<?php echo("procurar-pedido.php?userid=" . $loggedId ) ?>'; });
			pedidoprocura3.addEventListener('click', function() { document.location.href = '<?php echo("procurar-pedido.php?userid=" . $loggedId ) ?>'; });
			
			
			
			var cartazprocura1 = document.getElementById('cartazprocura1');
			var cartazprocura2 = document.getElementById('cartazprocura2');
			var cartazprocura3 = document.getElementById('cartazprocura3');
			cartazprocura1.addEventListener('click', function() { document.location.href = '<?php echo("criar-pdf.php?userid=" . $loggedId ) ?>'; });
			cartazprocura2.addEventListener('click', function() { document.location.href = '<?php echo("criar-pdf.php?userid=" . $loggedId ) ?>'; });
			cartazprocura3.addEventListener('click', function() { document.location.href = '<?php echo("criar-pdf.php?userid=" . $loggedId ) ?>'; });
			
			
			
			var logout1 = document.getElementById('logout1');
			var logout2 = document.getElementById('logout2');
			var logout3 = document.getElementById('logout3');
			logout1.addEventListener('click', function() { document.location.href = '<?php echo("logout.php" ) ?>'; });
			logout2.addEventListener('click', function() { document.location.href = '<?php echo("logout.php" ) ?>'; });
			logout3.addEventListener('click', function() { document.location.href = '<?php echo("logout.php" ) ?>'; });
		</script>
		
	</body>

</html>
