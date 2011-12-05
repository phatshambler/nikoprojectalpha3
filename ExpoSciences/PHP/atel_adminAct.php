<?php
	require_once("PHP/defaultAct.php");

	class AtelAdminAction extends DefaultAct {
		public $errorCode;
		public $contentUsers;


	
		public function __construct() {
			parent::__construct(DefaultAct::$VISIBILITY_PUBLIC);
		}
		
		protected function executeAction() {
		

		$this->contentUsers = UserDAO::getUsers();
		
		
		if(isset($_POST["usurpate"]) && isset($_POST["usager"])){
			//echo "hello!";
			//var_dump($_POST["usager"]);
			$_SESSION["usurpate"] = $_POST["usager"];
			
			header("location:ev_ateliers.php");
			exit;
			
		}
		
	}
	
	}