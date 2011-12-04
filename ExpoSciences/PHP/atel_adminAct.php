<?php
	require_once("PHP/defaultAct.php");

	class AtelAdminAction extends DefaultAct {
		public $errorCode;
		public $content;
	
		public function __construct() {
			parent::__construct(DefaultAct::$VISIBILITY_PUBLIC);
		}
		
		protected function executeAction() {
		
		$this->content = UserDAO::getTableAdminJuge();
		
		
		if(isset($_POST["modjuge"]) && $_POST["modjuge"] != ""){
		
		}
		
		}
		
	}