<?php
	include('classes/DataBase.php');

	if (isset($_POST['login']) == true) {
		
			$username = $_POST['username'];
			$senha = $_POST['senha'];

			if (DB::query('SELECT username FROM usuarios WHERE username=:username', array(':username'=>$username)) == true){

					if(password_verify($senha, DB::query('SELECT senha FROM usuarios WHERE username=:username', array(':username'=>$username))[0]['senha']) == true ){
						
						echo('<script>alert("Logged in com sucesso"); </script>');
						
						$cryptstrong = true;
						$token = bin2hex(openssl_random_pseudo_bytes(64, $cryptstrong));
						
						$userId = DB::query('SELECT id FROM usuarios WHERE username=:username', array(':username'=>$username))[0]['id'];
						
						DB::query('INSERT INTO login_tokens VALUES (\'\', :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$userId));
						
						setcookie("SNID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, true);
						setcookie("SNID2", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
						
						header('Location: timeline.php?userid=' . $userId );
						
					} 
					else{
						
						echo('<script>alert("Senha Incorreta"); </script>');
					}

			} 
			else{
				
				echo('<script>alert("Usuário não registrado"); </script>');
			}

}

?>

<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		
		<title>TG</title>
		
		<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/fonts/ionicons.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
		<link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
		<link rel="stylesheet" href="assets/css/styles.css">
	</head>

	<body>
		<section class="login-clean">
			<form method="post">
			
				<h2 class="visually-hidden"> Página de Login</h2><br>
				
				<div class="mb-3">
					<label>Nome do Usuário</label>
					<input class="form-control" type="text" name="username" placeholder="Username"><br><br>
				</div>
				
				<div class="mb-3">
					<label>Senha</label>
					<input class="form-control" type="password" name="senha" placeholder="Password"><br><br>
				</div>
				
				<div class="mb-3">			
					<input type="submit" class="btn btn-default" type="button" name="login" value="Login"  style="background-image:url(&quot;none&quot;);background-color:#da052b;color:#fff;padding:16px 32px;margin:0px 0px 6px;border:none;box-shadow:none;text-shadow:none;opacity:0.9;text-transform:uppercase;font-weight:bold;font-size:13px;letter-spacing:0.4px;line-height:1;outline:none;"/>
				</div><br>
					
				<a class="criarconta" href="criar-conta.php">gostaria de criar uma conta?</a>
			</form>
		</section>
		
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="assets/js/bs-init.js"></script>
		
	</body>

</html>