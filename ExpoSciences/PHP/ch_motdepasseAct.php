<?php
	require_once("PHP/defaultAct.php");

	class ChmotdepasseAction extends DefaultAct {
		public $errorCode;
		public $password;
	
		public function __construct() {
			parent::__construct(DefaultAct::$VISIBILITY_PUBLIC);
		}
		
		protected function executeAction() {
			
			if (isset($_SESSION["username"])) {
			
			$password = UserDAO::getPassword($_SESSION["username"]);
			
			$this->password = $password["MOTDEPASSE"];
			
			}
			
			if(isset($_POST["pwd1"]) && $_POST["pwd1"] != "" && isset($_POST["pwd2"]) && $_POST["pwd2"] != ""){
				
				$x = false;
				
				if($_POST["pwd1"] === $_POST["pwd2"]){
					$x = UserDAO::changePassword($_SESSION["username"], $_POST["pwd1"]);
					
					if($x === true){
					  $this->errorCode = "Succès";
					  $this->password = $_POST["pwd1"];
					  //header("location:ch_motdepasse.php");
					  //exit;
					}
					else{
					  $this->errorCode = "Erreur";
					}
					
				}
				else{
					$this->errorCode = "Vos mots de passe ne concordent pas";
				}
			
			}
			else{
					$this->errorCode = "Entrez de nouveaux mots de passe valides...";
			}
			
		}
	}