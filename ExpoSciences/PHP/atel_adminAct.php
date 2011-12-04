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
		
		
		if(isset($_POST["usurpate"]) && $_POST["usurpate"] != ""){
		
		}
		
	}