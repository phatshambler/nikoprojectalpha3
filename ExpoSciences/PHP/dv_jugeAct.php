<?php
	require_once("PHP/defaultAct.php");

	class DvjugeAction extends DefaultAct {
		public $errorCode;
		public $juge;
		public $candidatjuge;
		public $user;
	
		public function __construct() {
			parent::__construct(DefaultAct::$VISIBILITY_PUBLIC);
		}
		
		protected function executeAction() {
			
			if (isset($_SESSION["username"])) {
			
			$this->user = UserDAO::getUser($_SESSION["username"]);
			
			//var_dump($this->user);
			
			$this->juge = $this->user["JUGE"];
			$this->candidatjuge = $this->user["CANDIDATJUGE"];
			
			}
			
			if(isset($_POST["annulercandidature"])){
			
				//echo "candidature";
				
				$this->juge = null;
				
				UserDAO::updateJuge($_SESSION["username"], false);
				
				$this->user = UserDAO::getUser($_SESSION["username"]);
			
				$this->juge = $this->user["JUGE"];
			}
			if(isset($_POST["annulerdemande"])){
			
				//echo "demande";
				
				$this->candidatjuge = null;
				
				UserDAO::updateCandidatJuge($_SESSION["username"], false);
				
				$this->user = UserDAO::getUser($_SESSION["username"]);
				
				$this->candidatjuge = $this->user["CANDIDATJUGE"];
			}
			
			if(isset($_POST["candidature"])){
			
				//echo "candidature";
				
				UserDAO::updateJuge($_SESSION["username"], true);
				
				$this->user = UserDAO::getUser($_SESSION["username"]);
			
				
				$this->juge = $this->user["JUGE"];
				
			}
			if(isset($_POST["demande"])){
			
				//echo "demande";
				
				
				UserDAO::updateCandidatJuge($_SESSION["username"], true);
				
				$this->user = UserDAO::getUser($_SESSION["username"]);
				
				$this->candidatjuge = $this->user["CANDIDATJUGE"];
			}
			
		}
	}