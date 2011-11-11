<?php


	class UserDAO {
		
		
		public function __construct() {
			
		}
		
		
		
		public static function authenticate($username, $password) {
		
			$visibility = 0;
			
			if(isset($username) && isset($password) && $username != "" && $password != ""){
			
			$csv = UserDAO::loadUsersCSV();
			
			
				for($i = 0; $i < count($csv); $i += 3){
			
			
				if ($csv[$i] === $username && $csv[$i + 1] === $password) {
					$visibility = 1;
				}
			
				}
			}
			
			
			return $visibility;
		}
		
		public function getAuth($username, $password){
		
		}
		
		public function getIndex(){
		
		}
		
		public function getCourriel(){
		
		}
		
		public function setIndex(){
		
		}
		
		public function setCourriel(){
		
		}
	
	
	}




