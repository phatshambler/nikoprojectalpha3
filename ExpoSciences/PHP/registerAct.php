<?php
	require_once("PHP/defaultAct.php");

	class RegisterAction extends DefaultAct {
		public $errorCode;
		
	
		public function __construct() {
			parent::__construct(DefaultAct::$VISIBILITY_PUBLIC);
		}
		
		protected function executeAction() {
			
			//valide code et mot de passe
			if (isset($_POST["CODEAUDITEUR"]) && $_POST["CODEAUDITEUR"] != "" && isset($_POST["MOTDEPASSE"]) && $_POST["MOTDEPASSE"] != "") {
				
				
				$maxaudit = UserDAO::getTableMaxAuditeurs();
				$maxcoord = UserDAO::getTableMaxCoordonnees();
				
				
				$index = intval($maxaudit['MAXAUDIT']) + 1;
				$indexco = intval($maxcoord['MAXCOORD']) + 1;
				
				$lol = strval($_POST["NOREGION"]);
			
				$x = substr($lol, 0, strpos($lol, " "));
			
				//echo $x;
				
				if(UserDAO::getUser($_POST["CODEAUDITEUR"]) == null){
				
				$resultA = UserDAO::newAuditeur($index, $_POST["CODEAUDITEUR"], $_POST["MOTDEPASSE"], $_POST["NOM"], $_POST["PRENOM"], $indexco + 1, $_POST["JUGE"], $_POST["STATUT"], $_POST["CANDIDATJUGE"]);
				$resultB = UserDAO::newCoord($indexco, $_POST["RUE"], $_POST["VILLE"], $_POST["CODE_POSTAL"], $x, $_POST["TELEPHONE"], $_POST["CELL"], $_POST["COURRIEL"]);
				
				if($resultA === true && $resultB === true){
					$this->errorCode = 103;
					$_SESSION["username"] = $_POST["CODEAUDITEUR"];
					
					header("location:index.php");
					exit;
				}
				else {
					$this->errorCode = 102;
				}
				}
				else{
					$this->errorCode = 104;
				}
			}
			else if(isset($_POST["CODEAUDITEUR"])){
				$this->errorCode = 102;
			}
		}
	}