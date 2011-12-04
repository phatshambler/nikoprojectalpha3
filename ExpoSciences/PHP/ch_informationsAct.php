<?php
	require_once("PHP/defaultAct.php");

	class InformationsAction extends DefaultAct {
		public $errorCode;
		
	
		public function __construct() {
			parent::__construct(DefaultAct::$VISIBILITY_PUBLIC);
		}
		
		protected function executeAction() {
			
			//valide code et mot de passe
			if (isset($_POST["update"]) && $_POST["update"] == "Enregistrer") {
				
				$lol = strval($_POST["NOREGION"]);
			
				$x = substr($lol, 0, strpos($lol, " "));
			
				$user = UserDAO::getUser($_SESSION["username"]);
				//var_dump($user);
				
				if($user != null){
				
				$resultA = UserDAO::updateAuditeur($_SESSION["username"], $_POST["NOM"], $_POST["PRENOM"], $_POST["STATUT"], $_POST["CANDIDATJUGE"]);
				$resultB = UserDAO::updateCoord($user["NOCOORD"], $_POST["RUE"], $_POST["VILLE"], $_POST["CODE_POSTAL"], $x, $_POST["TELEPHONE"], $_POST["CELL"], $_POST["COURRIEL"]);
				
				if($resultA === true && $resultB === true){
					$this->errorCode = 103;
					
					
					//header("location:ch_informations.php");
					//exit;
				}
				else {
					$this->errorCode = 102;
				}
				}
				else{
					$this->errorCode = 104;
				}
			}
			
		}
	}