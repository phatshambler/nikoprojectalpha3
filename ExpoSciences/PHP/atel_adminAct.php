<?php
	require_once("PHP/defaultAct.php");

	class AtelAdminAction extends DefaultAct {
		public $errorCode;
<<<<<<< HEAD
		public $contentUsers;
=======
		public $content;
>>>>>>> d7d80d335103df9ade994bec2d53bba96f03005e
	
		public function __construct() {
			parent::__construct(DefaultAct::$VISIBILITY_PUBLIC);
		}
		
		protected function executeAction() {
		
<<<<<<< HEAD
		$this->contentUsers = UserDAO::getUsers();
		
		
		if(isset($_POST["usurpate"]) && $_POST["usurpate"] != ""){
=======
		$this->content = UserDAO::getTableAdminJuge();
		
		
		if(isset($_POST["modjuge"]) && $_POST["modjuge"] != ""){
>>>>>>> d7d80d335103df9ade994bec2d53bba96f03005e
		
		}
		
		}
		
	}