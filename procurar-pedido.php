<?php
	include('./classes/DataBase.php');
	include('./classes/Log.php');
	
	
	
	if( Login::isLoggedIn() == true){
		
		$loggedId = Login::isLoggedIn();
		
		//echo("Logged in ID: " . $loggedId);
		//echo("<br>Profile ID: " . $_GET['userid']);
	}
	else{
		
		die('<script>alert("Usuario Não loggado"); </script>');
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
							<li role="presentation"><a href="#" id="criarpedido1">Criar Pedido de procura </a></li>
							<li role="presentation" class="active"><a href="#" id="pedidoprocura1">Pedidos de procura</a></li>
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
						
							<li role="presentation" class="active"><a href="#">Pedidos de procura</a></li>
							
							<li class="dropdown open"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" href="#">Usuário <span class="caret"></span></a>
								<ul class="dropdown-menu dropdown-menu-right" role="menu">
									<li role="presentation" ><a href="#" id="perfil2">Meu Perfil</a></li>
									<li class="divider" role="presentation"></li>
									<li role="presentation"><a href="#" id="timeline2">Timeline </a></li>
									<li role="presentation"><a href="#" id="criarpedido2">Criar Pedido de procura </a></li>
									<li role="presentation"><a href="#" id="pedidoprocura2">Pedidos de procura </a></li>
									<li role="presentation"><a href="#" id="cartazprocura2">Criar cartaz</a></li>
									<li role="presentation"><a href="#" id="logout2">Logout </a></li>
								</ul>
							</li>
							
						</ul>
						
						<ul class="nav navbar-nav hidden-xs hidden-sm navbar-right">
						
							<li role="presentation"><a href="#" id="timeline3">Timeline</a></li>
							<li role="presentation"><a href="#" id="criarpedido3">Criar Pedido de procura </a></li>
							<li role="presentation" class="active"><a href="#" id="pedidoprocura3">Pedidos de procura</a></li>
							<li role="presentation"><a href="#" id="cartazprocura3">Criar cartaz</a></li>
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
			<h1>Procurar pedidos de procura</h1>
		</div><br>
		
		<div>

			<div class="container">
			
				<div class="row">
				
					<div class="col-md-3">
					
						<ul class="list-group">
						
							<li class="list-group-item"><span><strong>Procurar pedidos de procura</strong></span><br>
								<br>
								<?php
									echo("Aqui você irá poder pesquisar por pedidos de busca cadastrados, feito por outros usuários" . "<br>");
								?>
							</li>
							
						</ul>
						
					</div>
				
				
					<div class='col-md-6'>
					
						<li class='list-group-item'>
						
							<div>
							
								<form action="procurar-pedido.php" method="post">

									<br>
									<h3 class="visually-hidden"> <strong> &nbsp &nbsp Insira os dados da pessoa desaparecida </strong></h3>
									<br><br>
										
									<label>Nome Completo</label>
									<input class="form-control" type="text" name="nome" placeholder="Nome Completo" style="width:300px; height:25px;">
									<br>
										
									<label>Local onde a pessoa foi vista pela ultima vez (Rua ou Bairro)</label>
									<input class="form-control" type="text" name="local" placeholder="Rua ou Bairro" style="width:300px; height:25px;">
									<br>
										
									<label>Idade</label><br>
									<select name="idade">
										<option value="">Idade da pessoa desaparecida:</option>
										<option value=10>Menos que 10 anos</option>
										<option value=20>Menos que 20 anos</option>
										<option value=30>Menos que 30 anos</option>
										<option value=40>Menos que 40 anos</option>
										<option value=50>Menos que 50 anos</option>
										<option value=60>Menos que 60 anos</option>
										<option value=70>Menos que 70 anos</option>
										<option value=80>Menos que 80 anos</option>
										<option value=90>Menos que 90 anos</option>
										<option value=91>Mais que 90 anos</option>
									</select><br><br>

									<label>Sexo da pessoa desaparecido(Masculino ou Feminino)</label><br>
									<select name="sexo">
										<option value="">Sexo:</option>
										<option value="M">Masculino</option>
										<option value="F">Feminino</option>
									</select><br><br>

									<input type="submit" class="btn btn-default" name="pesquisar" value="Pesquisar" style="background-image:url(&quot;none&quot;);background-color:#da052b;color:#fff;padding:16px 32px;margin:0px 0px 6px;border:none;box-shadow:none;text-shadow:none;opacity:0.9;text-transform:uppercase;font-weight:bold;font-size:13px;letter-spacing:0.4px;line-height:1;outline:none;" /><br><br><br>
										
									<?php
	
										if( isset($_POST['pesquisar']) == true){
											
											$nome = $_POST['nome'];
											$local = $_POST['local'];
											$sexo = $_POST['sexo'];
											$idade = $_POST['idade'];
												
											
											$dbSearch = 'SELECT pedidos.nome_desaparecido, pedidos.id , pedidos.user_id FROM usuarios, pedidos WHERE usuarios.id = pedidos.user_id AND pedidos.nome_desaparecido LIKE :nome ';
											
											$paramsArray = array(':nome'=>'%' . $nome . '%');
									
												if($local != ""){
													
													$dbSearch .= ' AND pedidos.local LIKE :local ';
													$paramsArray += [':local'=>'%' . $local . '%'];
												}
												
												if($sexo != ""){
													
													$dbSearch .= ' AND pedidos.sexo = :sexo ';
													$paramsArray += [':sexo'=> $sexo];
												}
												
												if($idade != ""){
													
													$dbSearch .= ' AND pedidos.idade < :idade ';
													$paramsArray += [':idade'=> $idade];
												}
												
												$results = DB::query($dbSearch, $paramsArray);
												
												echo("Resultado da pesquisa: ". "<br><br>");
												foreach($results as $r){
													echo("<ul class='list-group'>");
														echo("<li class='list-group-item'>");
															echo('<a href="perfil.php?userid=' . $r['user_id'] . '#' . $r['id'] . '">' . $r['nome_desaparecido'] . '</a>');
														echo("</li>");
													echo("</ul>");
												}
										}
									?>	
										
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
			
			var criarpedido1 = document.getElementById('criarpedido1');
			var criarpedido2 = document.getElementById('criarpedido2');
			var criarpedido3 = document.getElementById('criarpedido3');
			criarpedido1.addEventListener('click', function() { document.location.href = '<?php echo("criar-pedido.php?userid=" . $loggedId ) ?>'; });
			criarpedido2.addEventListener('click', function() { document.location.href = '<?php echo("criar-pedido.php?userid=" . $loggedId ) ?>'; });
			criarpedido3.addEventListener('click', function() { document.location.href = '<?php echo("criar-pedido.php?userid=" . $loggedId ) ?>'; });
			
			
			var perfil1 = document.getElementById('perfil1');
			var perfil2 = document.getElementById('perfil2');
			var perfil3 = document.getElementById('perfil3');
			perfil1.addEventListener('click', function() { document.location.href = '<?php echo("perfil.php?userid=" . $loggedId ) ?>'; });
			perfil2.addEventListener('click', function() { document.location.href = '<?php echo("perfil.php?userid=" . $loggedId ) ?>'; });
			perfil3.addEventListener('click', function() { document.location.href = '<?php echo("perfil.php?userid=" . $loggedId ) ?>'; });
			
			
			
			var timeline1 = document.getElementById('timeline1');
			var timeline2 = document.getElementById('timeline2');
			var timeline3 = document.getElementById('timeline3');
			timeline1.addEventListener('click', function() { document.location.href = '<?php echo("timeline.php?userid=" . $loggedId ) ?>'; });
			timeline2.addEventListener('click', function() { document.location.href = '<?php echo("timeline.php?userid=" . $loggedId ) ?>'; });
			timeline3.addEventListener('click', function() { document.location.href = '<?php echo("timeline.php?userid=" . $loggedId ) ?>'; });
			
			
			
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
