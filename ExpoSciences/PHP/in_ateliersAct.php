<?php
	require_once("PHP/defaultAct.php");

	class InateliersAction extends DefaultAct {
		public $errorCode;
		public $user;
		public $ateliers;
		public $ateliersIns;
		public $specialAdmin;
	
		public function __construct() {
			parent::__construct(DefaultAct::$VISIBILITY_PUBLIC);
		}
		
		protected function executeAction() {
			
			if (isset($_POST["cancel"])){
				$_SESSION["usurpate"] = null;
			
			}
			
			if (isset($_SESSION["username"])) {
			
			if(isset($_SESSION["usurpate"])){
				$this->user = UserDAO::getUser($_SESSION["usurpate"]);
				$this->specialAdmin = $_SESSION["usurpate"];
			}
			else{
				$this->user = UserDAO::getUser($_SESSION["username"]);
			}
			
			//var_dump($this->user);
			
			//$this->ateliers = UserDAO::getAteliersAll();
			
			$this->ateliersIns = UserDAO::getInscriptionsAll($this->user["NOAUDITEUR"]);
			
			}
			
			if(isset($_POST["recherche"])){
				$test = false;
				$this->ateliers = array();
				
			if(isset($_POST["titre"]) && $_POST["titre"] != ""){
				
				$temparr = UserDAO::getAteliersSortedTitre($_POST["titre"]);
				$this->ateliers = array_merge($this->ateliers, $temparr);
				$test = true;
				//echo "titre";
			}
			
			if(isset($_POST["date"]) && $_POST["date"] != "" && is_numeric($_POST["date"]) && strlen($_POST["date"]) === 6){
				$temparr = UserDAO::getAteliersSortedDate($_POST["date"]);
				$this->ateliers = array_merge($this->ateliers, $temparr);
			
				$test = true;
				//echo "date";
			}
			
			
			if(isset($_POST["langue"]) && $_POST["langue"] != ""){
				$temparr = UserDAO::getAteliersSortedlangue($_POST["langue"]);
				$this->ateliers = array_merge($this->ateliers, $temparr);
			
				$test = true;
				//echo "langue";
			}
			
			if($test){
				$temp = array();
				$count = 0;
				
				for ($i = 0; $i < count($this->ateliers); $i++){
					$val = $this->ateliers[$i];
					$toadd = true;
					
					for ($j = 0; $j < $count; $j++){
						if ($temp[$j]["NOATEL"] === $val["NOATEL"]){
							$toadd = false;
							
						}
						/*
						echo $temp[$j]["NOATEL"];
						echo ":";
						echo $temp[$j]["NOATEL"];
						echo "---";
						*/
					}
					
					if($toadd){
						array_push($temp, $val);
						$count++;
					}
					//var_dump($temp);
					//echo "loop";
				}
				//echo "kill";
				$this->ateliers = $temp;
			}
			
			if(!$test){
				$this->ateliers = UserDAO::getAteliersAll();
			}
			//var_dump($this->ateliers);
			
			}
			
			if(isset($_POST["enregistrer"])){
			
				$this->ateliers = UserDAO::getAteliersAll();
				
				if(isset($_POST["sex"]) && $_POST["sex"] != "" && $_POST["sex"] != null){
				echo "kill1";
				$test = true;
				
				$atel = $this->ateliers[intval($_POST["sex"])];
				
				$noatel = $atel["NOATEL"];
				
				for($i = 0; $i < count($this->ateliersIns); $i++){
					if($this->ateliersIns[$i]["NOATEL"] == $noatel){
						$test = false;
					}
				
				}
				
				$nouser = $this->user["NOAUDITEUR"];
				
				if($test){
					UserDAO::newInscription($nouser, $noatel);
					//echo "kill";
				
					$this->ateliersIns = UserDAO::getInscriptionsAll($this->user["NOAUDITEUR"]);
					
					$this->ateliers = null;
					
					$this->errorCode = "Succ�s";
				}
				else{
					$this->errorCode = "Vous �tes d�ja inscrit � cet atelier.";
				}
				}
				else{
					$this->errorCode = "Choisissez un atelier pour vous inscrire.";
				}
				
				
			}
			
			if(isset($_POST["enlever"])){
			
				$this->ateliers = UserDAO::getAteliersAll();
				
				if(isset($_POST["kkk"]) && $_POST["kkk"] != "" && $_POST["kkk"] != null){
				//echo $_POST["kkk"];
				
				$atel = $this->ateliersIns[intval($_POST["kkk"])];
				
				$noatel = $atel["NOATEL"];
				
				$nouser = $this->user["NOAUDITEUR"];
				
				UserDAO::deleteInscription($nouser, $noatel);
				
				$this->ateliersIns = UserDAO::getInscriptionsAll($this->user["NOAUDITEUR"]);
				
				$this->ateliers = null;
				
			}
			else{
				$this->errorCode = "Choisissez un atelier pour vous d�sinscrire.";
			}
			
				
			}
		}
	}