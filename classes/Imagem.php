<?php

	class Imagem{

		public static function uploadImagem($formname, $requestId){
			
			$image = base64_encode(file_get_contents($_FILES[$formname]['tmp_name']));
		 
			$options = array('http'=>array(
										'method'=>"POST",
										'header'=>"Authorization: Bearer b4bf402d41a3c132410e6db8cb4ea17a21428e10\n" . 'Content-Type: application/x-www-form-urlencoded',
										'content'=>$image								
									)
							);
			
			$context = stream_context_create($options);
			
			$imgurURL = "https://api.imgur.com/3/image";
			
			if($_FILES[$formname]['size'] > 10240000){
				
				echo('<script>alert("Imagem muito grande, a imagem tem que ser 10MB ou menos"); </script>');
			}
			
			$response = file_get_contents($imgurURL, false, $context);
			$response = json_decode($response);

			DB::query("UPDATE pedidos SET imagem=:imagem WHERE id=:requestid" , array(':imagem'=>$response->data->link ,':requestid'=>$requestId));
			echo('<script>alert("Pedido criado com sucesso"); </script>');
		}
	}



		//https://imgur.com/#access_token=b4bf402d41a3c132410e6db8cb4ea17a21428e10&expires_in=315360000&token_type=bearer&refresh_token=a9cc758eb3cfaf369614ee876339126b7742cec5&account_username=1an22022000&account_id=156452265
		//access token: b4bf402d41a3c132410e6db8cb4ea17a21428e10
		//refresh token:  a9cc758eb3cfaf369614ee876339126b7742
?>
