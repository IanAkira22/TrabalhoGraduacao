<?php

	class Comment {
		
        public static function createComment($commentBody, $requestId, $userId) {

                if (strlen($commentBody) > 160) {
					
					die('<script>alert("Numero de caracteres de comentario incorreto Maximo=160"); </script>');
                }

                if (DB::query('SELECT id FROM pedidos WHERE id=:requestid', array(':requestid'=>$requestId)) == false) {
					
                    die('<script>alert("ID de usuário incorreto "); </script>');
                } 
				else {
					
					DB::query('INSERT INTO comentarios VALUES (\'\', :comment, :userid, :requestid, NOW())', array(':comment'=>$commentBody, ':userid'=>$userId, ':requestid'=>$requestId));
                }
        }
		
}
?>