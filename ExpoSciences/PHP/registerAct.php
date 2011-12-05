<?php
	require_once("PHP/defaultAct.php");

	class RegisterAction extends DefaultAct {
		public $errorCode;
		public $oldval;
	
		public function __construct() {
			parent::__construct(DefaultAct::$VISIBILITY_PUBLIC);
		}
		
		protected function executeAction() {
			
			//valide code et mot de passe
			if (isset($_POST["CODEAUDITEUR"]) && $_POST["CODEAUDITEUR"] != "" && isset($_POST["MOTDEPASSE"]) && $_POST["MOTDEPASSE"] != "") {
				
				$resultC = true;
				$resultD = true;
				$resultE = true;
				
				$maxaudit = UserDAO::getTableMaxAuditeurs();
				$maxcoord = UserDAO::getTableMaxCoordonnees();
				
				
				$index = intval($maxaudit['MAXAUDIT']) + 1;
				$indexco = intval($maxcoord['MAXCOORD']) + 1;
				
				$lol = strval($_POST["NOREGION"]);
			
				$x = substr($lol, 0, strpos($lol, " "));
				
				if(isset($_POST["CODEPOSTAL"])){
				
				$resultC = $this->validateCanadaZip($_POST["CODEPOSTAL"]);
				}
				
				if(isset($_POST["TELEPHONE"])){
				
				$resultD = $this->validateTelephone($_POST["TELEPHONE"]);
				
				}
				
				if(isset($_POST["CELL"])){
				
				$resultE = $this->validateTelephone($_POST["CELL"]);
				
				}
				
				//echo $x;
				
				if(!$resultC){
					$this->errorCode = 109;
				}
				else if(!$resultD){
					$this->errorCode = 110;
				}
				else if(!$resultE){
					$this->errorCode = 111;
				}
				else if(UserDAO::getUser($_POST["CODEAUDITEUR"]) == null){
				
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
			
			$this->oldval = array();
			
			if(isset($_POST["CODEAUDITEUR"])){
				$this->oldval["CODEAUDITEUR"] = $_POST["CODEAUDITEUR"];
			}
			if(isset($_POST["MOTDEPASSE"])){
				$this->oldval["MOTDEPASSE"] = $_POST["MOTDEPASSE"];
			}
			if(isset($_POST["NOM"])){
				$this->oldval["NOM"] = $_POST["NOM"];
			}
			if(isset($_POST["PRENOM"])){
				$this->oldval["PRENOM"] = $_POST["PRENOM"];
			}
			if(isset($_POST["RUE"])){
				$this->oldval["RUE"] = $_POST["RUE"];
			}
			if(isset($_POST["VILLE"])){
				$this->oldval["VILLE"] = $_POST["VILLE"];
			}
			if(isset($_POST["CODE_POSTAL"])){
				$this->oldval["CODE_POSTAL"] = $_POST["CODE_POSTAL"];
			}
			if(isset($_POST["TELEPHONE"])){
				$this->oldval["TELEPHONE"] = $_POST["TELEPHONE"];
			}
			if(isset($_POST["CELL"])){
				$this->oldval["CELL"] = $_POST["CELL"];
			}
			if(isset($_POST["COURRIEL"])){
				$this->oldval["COURRIEL"] = $_POST["COURRIEL"];
			}
			
			//var_dump($oldval);
		}
		
		protected function validateCanadaZip($zip_code)
		{
		//function by Roshan Bhattara(http://roshanbh.com.np)
		if(preg_match("/^([a-ceghj-npr-tv-z]){1}[0-9]{1}[a-ceghj-npr-tv-z]{1}[0-9]{1}[a-ceghj-npr-tv-z]{1}[0-9]{1}$/i",$zip_code))
			return true;
		else
			return false;

		}
		
		protected function validateTelephone($phone)
		{
		//function by Roshan Bhattara(http://roshanbh.com.np)
		if(preg_match("^[01]?[- .]?\(?[2-9]\d{2}\)?[- .]?\d{3}[- .]?\d{4}$^", $phone))
			return true;
		else
			return false;

		}
		
		
		
	}