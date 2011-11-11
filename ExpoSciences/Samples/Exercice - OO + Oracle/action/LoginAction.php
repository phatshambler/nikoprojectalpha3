<?php
	require_once("action/CommonAction.php");

	class LoginAction extends CommonAction {
		public $errorCode;
	
		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
		}
		
		protected function executeAction() {
			
			if (isset($_POST["username"])) {
				$info = UserDAO::authenticate($_POST["username"], $_POST["pwd"]);
				
				if (isset($info)) {
					
					parent::setUserCredentials($info["FIRST_NAME"], $info["VISIBILITY"]);
				
					header("location:home.php");
					exit;
				}
				else {
					$this->errorCode = 101;
				}
			}
		}
	}
	
	
	
	
	
	
	
	
	

