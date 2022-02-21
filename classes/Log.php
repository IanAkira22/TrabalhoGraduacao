<?php

	class Login{
		
		public static function isLoggedIn(){
		
			if(isset($_COOKIE['SNID']) == true){
				
				if(DB::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID']))) == true){
					
					$userId = DB::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])))[0]['user_id'];
					
					if(isset($_COOKIE['SNID2']) == true){
						
						return($userId);
					}
					else{
						
						$cryptstrong = true;
						$token = bin2hex(openssl_random_pseudo_bytes(64, $cryptstrong));
						
						DB::query('INSERT INTO login_tokens VALUES (\'\', :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$userId));
						DB::query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])));
						
						setcookie("SNID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
						setcookie("SNID2", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
						
						return($userId);
					}
					
					return($userId);
					
				}
			}
			
			return false;
		}
		
	}

?>