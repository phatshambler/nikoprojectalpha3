<?php
	require_once("PHP/defaultAct.php");

	class RegisterAction extends DefaultAct {
		public $errorCode;
		
	
		public function __construct() {
			parent::__construct(DefaultAct::$VISIBILITY_PUBLIC);
		}
		
		protected function executeAction() {
			
			if (isset($_POST["newusername"]) && isset($_POST["newpwd"]) && isset($_POST["courriel"]) ) {
				
				$visibility = 0;
				
				$visibility = UserDAO::addUser($_POST["newusername"], $_POST["newpwd"], $_POST["courriel"], $_POST["createur"], $_POST["admin"]);
				
				if($visibility == 0){
					$this->errorCode = 103;
				}
				else if ($visibility > DefaultAct::$VISIBILITY_PUBLIC) {
				
					parent::setUserCredentials($_POST["newusername"], $visibility);
				
					header("location:index.php");
					exit;
				}
				else {
					$this->errorCode = 102;
				}
			}
			else if(isset($_POST["newusername"])){
					$this->errorCode = 102;
			}
		}
	}