<?php
	require_once("PHP/defaultAct.php");

	class IndexAction extends DefaultAct {
		public $errorCode;
		
	
		public function __construct() {
			parent::__construct(DefaultAct::$VISIBILITY_PUBLIC);
		}
		
		protected function executeAction() {
			
			if (isset($_POST["username"])) {
				$visibility = UserDAO::authenticate($_POST["username"], $_POST["pwd"]);
				
				if ($visibility > DefaultAct::$VISIBILITY_PUBLIC) {
					
					$user = UserDAO::getUser($_POST["username"]);
					
					$admin = UserDAO::authenticateAdmin($user["NOAUDITEUR"]);
					
					if($admin){
						$_SESSION["administrator"] = true;
					}
					else{
						$_SESSION["administrator"] = false;
						
					}
					
					parent::setUserCredentials($_POST["username"], $visibility);
				
					header("location:index.php");
					exit;
				}
				else {
					$this->errorCode = 101;
				}
			}
			
			if (isset($_SESSION["user_visibility"])){
				//var_dump($_SESSION["user_visibility"]);
			}
		}
	}