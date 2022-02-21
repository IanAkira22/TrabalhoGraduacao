<?php
	class Postar{
		
		
		public static function criarPost($nome, $idade, $data, $estado, $cidade, $local, $sexo, $loggedInUserId, $profileUserId){
			
			if ($loggedInUserId == $profileUserId) {
					
					if($nome == ""){
				
						echo('<script>alert("Campo do Nome tem que estar preenchido "); </script>');
					}
					else{
						
						if($estado == ""){
							
							echo('<script>alert("Campo do Estado de residência tem que estar preenchido "); </script>');
						}
						else{
							
							if($cidade == ""){
								
								echo('<script>alert("Campo do Cidade de residência tem que estar preenchido "); </script>');
							}
							else{
								
								DB::query('INSERT INTO pedidos VALUES(\'\', :nome, :idade, :data, :estado, :cidade, :local, :sexo,\'\', :userid, NOW())', array(':nome'=>$nome, ':idade'=>$idade, ':data'=>$data, ':estado'=>$estado, ':cidade'=>$cidade, ':local'=>$local, ':sexo'=>$sexo, ':userid'=>$profileUserId));
								$pedidoId = DB::query('SELECT id FROM pedidos WHERE user_id=:userid ORDER BY id DESC LIMIT 1', array(':userid'=>$loggedInUserId))[0]['id'];
										  
								return($pedidoId);
							}
							
						}
						
					}
			} 
			else{
					
				echo('<script>alert("Usuário Incorreto"); </script>');
			}
		}
		
	}
?>