<?php


	class UserDAO {
		
		private $arrUsers;
		private $arrPasswords;
		private $strIndex;
		private $strCourriel;
		
		public function __construct() {
			//$this.arrUsers = new array();
			//$this.arrPasswords = new array();
			//strIndex = "";
			//strCourriel = "";
			
			loadData();
		}
		
		public static function authenticate($username, $password) {
			$visibility = 0;
			
			if ($username === "niko" && $password === "666") {
				$visibility = 1;
			}
			
			return $visibility;
		}
		
		private function loadData (){
		
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




