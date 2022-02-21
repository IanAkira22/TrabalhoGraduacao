<?php
	include('./classes/DataBase.php');
	include('./classes/Log.php');
	include('./classes/Comment.php');
	
	
	if( Login::isLoggedIn() == true){
		
		$loggedId = Login::isLoggedIn();
		
		//echo("Logged in ID: " . $loggedId);
		//echo("<br>Profile ID: " . $_GET['userid']);
	}
	else{
		
		die('<script>alert("Usuario Não loggado"); </script>');
	}

		
	if(DB::query('SELECT id FROM usuarios WHERE id=:userid', array(':userid'=>$loggedId)) == true){
	
		$username = DB::query('SELECT username FROM usuarios WHERE id=:userid', array(':userid'=>$loggedId))[0]['username'];
		$estado = DB::query('SELECT estado FROM usuarios WHERE id=:userid', array(':userid'=>$loggedId))[0]['estado'];
		$cidade = DB::query('SELECT cidade FROM usuarios WHERE id=:userid', array(':userid'=>$loggedId))[0]['cidade'];
		$cpf = DB::query('SELECT cpf FROM usuarios WHERE id=:userid', array(':userid'=>$loggedId))[0]['cpf'];
		$telefone = DB::query('SELECT telefone FROM usuarios WHERE id=:userid', array(':userid'=>$loggedId))[0]['telefone'];
			
	}
	else{
			
		die('<script>alert("Usuario Não registrado"); </script>');
	}

	
	if(isset($_POST['comentar']) == true){
		
		Comment::createComment($_POST['comentario'], $_GET['requestid'], $loggedId );
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
							<li role="presentation" class="active"><a href="#">Timeline </a></li>
							<li role="presentation"><a href="#" id="criarpedido1">Criar Pedido de procura </a></li>
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
						
							<li role="presentation" class="active"><a href="#">Timeline</a></li>
							
							<li class="dropdown open"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" href="#">Usuário <span class="caret"></span></a>
								<ul class="dropdown-menu dropdown-menu-right" role="menu">
									<li role="presentation" ><a href="#" id="perfil2">Meu Perfil</a></li>
									<li class="divider" role="presentation"></li>
									<li role="presentation"><a href="#">Timeline </a></li>
									<li role="presentation"><a href="#" id="criarpedido2">Criar Pedido de procura </a></li>
									<li role="presentation"><a href="#" id="pedidoprocura2">Pedidos de procura </a></li>
									<li role="presentation"><a href="#" id="cartazprocura2">Criar cartaz</a></li>
									<li role="presentation"><a href="#" id="logout2">Logout </a></li>
								</ul>
							</li>
							
						</ul>
						
						<ul class="nav navbar-nav hidden-xs hidden-sm navbar-right">
						
							<li role="presentation" class="active"><a href="#">Timeline</a></li>
							<li role="presentation"><a href="#" id="criarpedido3">Criar Pedido de procura </a></li>
							<li role="presentation"><a href="#" id="pedidoprocura3">Pedidos de procura</a></li>
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
			<h1>Timeline</h1>
		</div><br>
		
		<div>

			<div class="container">
			
				<div class="row">
				
					<div class="col-md-3">
					
						<ul class="list-group">
						
							<li class="list-group-item"><span><strong>Timeline</strong></span><br>
								<br>
								<?php
									echo("Aqui sera mostrado pedidos de procura na mesma cidade que você mora feito por outros usuários" . "<br>");
								?>
							</li>
							
						</ul>
						
					</div>
				
				
					<div class='col-md-6'>
					
					<?php 
						
						$userCidade = DB::query('SELECT cidade FROM usuarios WHERE id=:userid', array(':userid'=>$loggedId) ) [0]['cidade'];
						$dbPedidos = DB::query('SELECT pedidos.id, pedidos.nome_desaparecido, pedidos.idade, pedidos.data, pedidos.estado, pedidos.cidade, pedidos.local, pedidos.sexo, pedidos.imagem, pedidos.user_id, pedidos.posted_at, usuarios.username, usuarios.nome_completo FROM pedidos, usuarios WHERE usuarios.id=pedidos.user_id ORDER BY pedidos.posted_at DESC');
								
						foreach($dbPedidos as $r){
							
							if($userCidade == $r['cidade'] && $loggedId != $r['user_id']){
								
								echo("<ul class='list-group'>");
							
									echo("<li class='list-group-item'>");
																	
										echo("<blockquote>");
																	
											echo("<div class='timelineposts'>");
																		
												echo('&nbsp' . '&nbsp' . '&nbsp'. '&nbsp' . '&nbsp' . '&nbsp' . '&nbsp' . '&nbsp' . '&nbsp' . '&nbsp' . '&nbsp' . '&nbsp' . '&nbsp' . '&nbsp' . '&nbsp' . '<strong>' . "PROCURA-SE PESSOA DESAPARECIDA" . '</strong>' . '<br><br>');
																			
												echo('<strong>' . "Nome Completo: " . '</strong>' . $r['nome_desaparecido'] . '<br>');
												echo('<strong>' . "Idade: " . '</strong>' . $r['idade'] . " Anos" . '<br>'); 
												echo('<strong>' . "Sexo: " . '</strong>' . $r['sexo'] . '<br>');
												echo('<strong>' . "Data de desaparecimento: " . '</strong>' . date('d-m-Y', strtotime($r['data'])) . '<br>');
												echo('<strong>' . "Estado de residência: " . '</strong>' . $r['estado'] . '<br>');
												echo('<strong>' . "Cidade de residência: " . '</strong>' . $r['cidade'] . '<br>');
												echo('<strong>' . "Local de desaparecimento: " . '</strong>' . $r['local'] . '<br><br>');
												echo('<strong>' . "Foto da Pessoa desaparecida:<br> " . '</strong>' . '<img src=' . $r['imagem'] . 'alt="Image" height="250" width="250"' .'>' . '<br><br>');
												
												echo("<footer>");
												
													echo("Postado por " . $r['nome_completo'] . " no dia " . date('d-m-Y H:i:s', strtotime($r['posted_at'])) );
													echo("<br><br>");
												
													echo("<form action='timeline.php?requestid=" . $r['id'] . "' method='post' >
															<textarea name='comentario' rows='4' cols='50'></textarea><br>
															
															<br><button class='btn btn-default comment' name='comentar' type='submit' style='box-shadow: 1px 1px 2px 0.5px grey; color:#eb3b60;background-image:url(&quot;none&quot;);background-color:transparent;'>
																<span style='color:#FF6347;'>Comentar</span>
															</button>
														</form>");
														
														$pedidoId = $r['id'];
														$displaycomments = DB::query('SELECT comentarios.comentario, comentarios.posted_at, usuarios.nome_completo FROM comentarios, usuarios WHERE comentarios.request_id=:requestid AND comentarios.user_id=usuarios.id ORDER BY comentarios.posted_at', array(':requestid'=>$pedidoId));
													
														echo("<br><br>");
														
														foreach($displaycomments as $dc){
														
															echo("<ul class='list-group'>");
															
																echo("<li class='list-group-item'>");
															
																	echo("<blockquote>");
																	
																		echo("<div class='timelineposts'>");
																		
																			echo( $dc['comentario'] . '<br>');
																				
																			echo("<footer>");
																			
																				echo("Postado por " . $dc['nome_completo'] . " no dia " . date('d-m-Y H:i:s', strtotime($dc['posted_at'])) );
																				
																			echo("</footer>");
																		
																		echo("</div>");
																	
																	echo("</blockquote>");
																	
																echo("</li>");
																
															echo("</ul>");
														}
													
												echo("</footer>");
																			
											echo("</div>");
																		
										echo("</blockquote>");
																
									echo("</li>");
								
								echo("</ul>");
								echo("<br><br>");
							}	
						}
													
						?>
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
