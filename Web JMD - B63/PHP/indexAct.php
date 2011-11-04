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
				
					parent::setUserCredentials($_POST["username"], $visibility);
				
					header("location:index.php");
					exit;
				}
				else {
					$this->errorCode = 101;
				}
			}
			if(isset($_POST["currenthi"])){
				//echo $_POST["currenthi"];
			}
		}
	}