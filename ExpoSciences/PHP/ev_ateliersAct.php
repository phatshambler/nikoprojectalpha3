<?php
	require_once("PHP/defaultAct.php");

	class EvAteliersAction extends DefaultAct {
		public $errorCode;
		public $juge;
		public $user;
		public $ateliersIns;
		public $criteres;
	
		public function __construct() {
			parent::__construct(DefaultAct::$VISIBILITY_PUBLIC);
		}
		
		protected function executeAction() {
			
			if (isset($_SESSION["username"])) {
			
			$this->user = UserDAO::getUser($_SESSION["username"]);
			
			$this->juge = $this->user["JUGE"];
			
			$this->ateliersIns = UserDAO::getInscriptionsAll($this->user["NOAUDITEUR"]);
			
			$this->criteres = UserDAO::getCriteres();
			
			}
			
			if (isset($_POST["noter"])) {
				
				if(isset($_POST["atelier"])){
					$auditeur = $this->ateliersIns[$_POST["atelier"]]["NOAUDITEUR"];
					$atelier = $this->ateliersIns[$_POST["atelier"]]["NOATEL"];
					echo $auditeur . " " . $atelier;
					
					foreach ($this->criteres as $value){
						echo $_POST[$value["NOCRITERE"]];
						UserDAO::newEvaluation($auditeur, $atelier, $value["NOCRITERE"], $_POST[$value["NOCRITERE"]]);
					}
				}
			}
		}
	}