<?php
	include('classes/DataBase.php');
	
	$username = "";
	$senha = "";
	$nome = "";
	$email = "";
	$estado = "";
	$cidade = "";
	$cpf = "";
	$telefone = "";
	$ddd = "";
	
	function inserirDados ($USERNAME, $SENHA, $NOME, $EMAIL, $ESTADO, $CIDADE, $CPF, $TELEFONE, $DDD){
			
			$username = $USERNAME;
			$senha = $SENHA;
			$nome = $NOME;
			$email = $EMAIL;
			$estado = $ESTADO;
			$cidade = $CIDADE;
			$cpf = $CPF;
			$telefone = $TELEFONE;
			$ddd = $DDD;
			
			
			if(DB::query('SELECT username FROM usuarios WHERE username=:username', array(':username'=>$username)) == false){
				
				if(strlen($username) >= 3 && strlen($username) <= 32 ){
					
					if (strlen($senha) >= 6 && strlen($senha) <= 60) {
								
						if(preg_match('/[a-zA-Z0-9_]+/', $username) == true){
							
							if (filter_var($email, FILTER_VALIDATE_EMAIL)){
								
								if(DB::query('SELECT email FROM usuarios WHERE email=:email', array(':email'=>$email)) == false){
							
									DB::query('INSERT INTO usuarios VALUES(\'\', :username, :senha, :nome, :email, :estado, :cidade, :cpf, :telefone, :ddd)', array(':username'=>$username, ':senha'=>password_hash($senha, PASSWORD_BCRYPT), ':nome'=>$nome, ':email'=>$email, ':estado'=>$estado, ':cidade'=>$cidade, ':cpf'=>$cpf, ':telefone'=>$telefone, ':ddd'=>$ddd));
									echo('<script>alert("Conta Criada com sucesso"); </script>');
								}
								else{
									
									echo('<script>alert("E-mail Invalido: E-mail já está em uso"); </script>');
								}
							}
							else{
								
								echo('<script>alert("E-mail Invalido: Formato de E-mail está incorreto"); </script>');
							}
						}
						else{
							
							echo('<script>alert("Username Invalido: Caracteres que fora do padrão de:   a-z A-Z 0-9 _   foram detectados"); </script>');
						}
						
					}
					else{
						
						echo('<script>alert("Senha Invalida: Numero de caracteres menor que 6, ou maior que 60"); </script>');
					}
				}				
				else{
					
					echo('<script>alert("Username invalido: Numero de caracteres menor que 3, ou maior que 32"); </script>');
				}

			}
			else{
				
				echo('<script>alert("Username Invalido: Usuario já registrado"); </script>');
			}
		
	}
		
	if(isset($_POST['createaccount']) == true){
		
		inserirDados($_POST['username'], $_POST['senha'], $_POST['nome'], $_POST['email'], $_POST['estado'], $_POST['cidade'], $_POST['cpf'],  $_POST['telefone'], $_POST['ddd']);
		
	}
	
?>

<!DOCTYPE html>

<html lang="en">

	<head>
	
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		
		<title>TG</title>
		
		<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
		<link rel="stylesheet" href="assets/css/styles.css">
		
	</head>

	<body>
	
		<section class="login-clean">
		
			<form action="criar-conta.php" method="post">
			
				<h2>&nbsp &nbsp &nbspCriar Conta</h2><br>
							
				<label>Username do Usuário</label><br>
				<input class="form-control" type="text" name="username" placeholder="Username"><br><br>
				
				<label>Senha</label><br>
				<input class="form-control" type="password" name="senha" placeholder="Senha"><br><br>
						
				<label>Nome completo do Usuário</label><br>
				<input class="form-control" type="text" name="nome" placeholder="Nome completo"><br><br>
						
				<label>E-mail</label><br>
				<input class="form-control" type="email" name="email" placeholder="exemplo@gmail.com"><br><br>
									
				<label>Estado de residência</label><br>
				<input class="form-control" type="text" name="estado" placeholder="Estado"><br><br>
								
				<label>Cidade de residência</label><br>
				<input class="form-control" type="text" name="cidade" placeholder="Cidade"><br><br>
								
				<label>CPF</label><br>
				<input class="form-control" type="text" name="cpf" placeholder="999-999-999-99"><br><br>
								
				<label>DDD</label><br>
				<input class="form-control" type="text" name="ddd" placeholder="99"><br><br>
				
				<label>Telefone ou Celular</label><br>
				<input class="form-control" type="text" name="telefone" placeholder="999999999"><br><br>

				<input type="submit" class="btn btn-default" type="button" name="createaccount" value="Criar Conta" style="background-image:url(&quot;none&quot;);background-color:#da052b;color:#fff;padding:16px 32px;margin:0px 0px 6px;border:none;box-shadow:none;text-shadow:none;opacity:0.9;text-transform:uppercase;font-weight:bold;font-size:13px;letter-spacing:0.4px;line-height:1;outline:none;"/><br><br>
				
				<a class="login" href="login.php">voltar a pagina de login</a>
			</form>
			
		</section>
		
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="assets/js/bs-init.js"></script>
		
	</body>

</html>