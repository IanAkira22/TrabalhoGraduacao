<?php
	include('classes/DataBase.php');
	include('classes/Log.php');

	if(Login::isLoggedIn() == false){
		die('<script>alert("Usuario não loggado"); </script>');
	}

	if(isset($_POST['logout'])){
		
		if(isset($_POST['alldevices'])){
			
			DB::query('DELETE FROM login_tokens WHERE user_id=:userid', array(':userid'=>Login::isLoggedIn()));
		}
		else{
			if(isset($_COOKIE['SNID'])){
				
				DB::query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])));
			}
			
			setcookie('SNID', '1', time()-3600);
			setcookie('SNID2', '1', time()-3600);
			
			echo('<script>alert("Logout realizado com sucesso"); </script>');
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
			
				<h2 class="visually-hidden"> Página de Logout</h2><br>
				<h5 class="visually-hidden"> deseja realizar Logout da sua conta ?</h5><br>
				<div class="mb-3">
					
					<input type="checkbox" name="alldevices" value="alldevices"> Logout of all devices ? <br><br> 
					<input type="submit" class="btn btn-default" type="button" name="logout" value="Confirmar"  style="background-image:url(&quot;none&quot;);background-color:#da052b;color:#fff;padding:16px 32px;margin:0px 0px 6px;border:none;box-shadow:none;text-shadow:none;opacity:0.9;text-transform:uppercase;font-weight:bold;font-size:13px;letter-spacing:0.4px;line-height:1;outline:none;"/><br>
					
					<br><a class="login" href="login.php">gostaria de voltar a pagina de login?</a>
				</div>
			</form>
		</section>
		
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="assets/js/bs-init.js"></script>
		
		<script type="text/javascript">
			
			var login = document.getElementById('login');
			login.addEventListener('click', function() { document.location.href = '<?php echo("login.php") ?>'; });
		
		</script>
		
	</body>

</html>