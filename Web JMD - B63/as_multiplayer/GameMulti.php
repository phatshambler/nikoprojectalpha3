<?php


	class GameMulti {
		
		
		public function __construct() {
			
		}
		
		public function run() {
			
			if(isset($_SESSION["userid"]) && isset($_SESSION["status"]) && isset($_SESSION["username"])){
				echo "<p>" . $_SESSION["username"] . "-" . $_SESSION["userid"] . " Status:" . $_SESSION["status"] . "</p>";
				echo "<p id='txtHint'>lala</p>";
			
			
			
			}
		
		}
		
	}