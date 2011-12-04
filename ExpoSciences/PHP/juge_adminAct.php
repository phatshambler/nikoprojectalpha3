<?php
	require_once("PHP/defaultAct.php");

	class JugeAdminAction extends DefaultAct {
		public $errorCode;
		public $content;
	
		public function __construct() {
			parent::__construct(DefaultAct::$VISIBILITY_PUBLIC);
		}
		
		protected function executeAction() {
		
		$this->content = UserDAO::getTableAdminJuge();
		
		
		if(isset($_POST["modjuge"]) && $_POST["modjuge"] != ""){
			//echo "lol";
			
			foreach($this->content as $key => $value){
				//var_dump($value);
				if(isset($_POST["check" . $value["CODEAUDITEUR"]])){
					
					if($_POST["check" . $value["CODEAUDITEUR"]] == true){
						//echo "oui: ". $value["CODEAUDITEUR"] . "<br>";
						UserDAO::updateJuge($value["CODEAUDITEUR"], true);
					}
					
					
				}
				else{
						//echo "non: " . $value["CODEAUDITEUR"] . "<br>";
						UserDAO::updateJuge($value["CODEAUDITEUR"], false);
						UserDAO::removeEval($value["NOAUDITEUR"]);
				}
			
			}
			
			$this->content = UserDAO::getTableAdminJuge();
			$this->errorCode = 102;
		
		}
	}
		
	}