<?php
	require_once("PHP/defaultAct.php");

	class EvAteliersAction extends DefaultAct {
		public $errorCode;
		public $juge;
		public $user;
		public $ateliersIns;
		public $criteres;
		public $pastNotes;
	
		public function __construct() {
			parent::__construct(DefaultAct::$VISIBILITY_PUBLIC);
		}
		
		protected function executeAction() {
			
			if (isset($_SESSION["username"])) {
			
			$this->user = UserDAO::getUser($_SESSION["username"]);
			
			$this->juge = $this->user["JUGE"];
			
			$this->ateliersIns = UserDAO::getInscriptionsAll($this->user["NOAUDITEUR"]);
			
			
			
			$this->criteres = UserDAO::getCriteres();
			
			foreach($this->ateliersIns as $key => $value){
				$data = array();
				foreach ($this->criteres as $key2 => $critere){
					
					array_push($data, UserDAO::getCritereSpecific($value["NOAUDITEUR"], $value["NOATEL"], intval($critere["NOCRITERE"])));
					//var_dump($data);
				}
				$this->ateliersIns[$key]["NOTES"] = $data;
			}
			
			//var_dump($this->ateliersIns);
			
			//$this->pastNotes = UserDAO::getOldNotes();
			}
			
			if (isset($_POST["noter"])) {
				
				if(isset($_POST["atelier"])){
					$auditeur = $this->ateliersIns[$_POST["atelier"]]["NOAUDITEUR"];
					$atelier = $this->ateliersIns[$_POST["atelier"]]["NOATEL"];
					//echo $auditeur . " " . $atelier;
					
					foreach ($this->criteres as $value){
						//echo "note: " . $_POST[$value["NOCRITERE"]] . " critère: " . $value["NOCRITERE"] . " - ";
						$eval = null;
						$eval = UserDAO::getCritereSpecific($auditeur, $atelier, intval($value["NOCRITERE"]));
						//var_dump($eval);
						if($eval != null){
			
							//echo "blue";
							UserDAO::updateEvaluation($auditeur, $atelier, $value["NOCRITERE"], $_POST[$value["NOCRITERE"]]);
						}
						else{
							//echo "red";
							//echo UserDAO::getCritereSpecific($auditeur, $atelier, intval($value["NOCRITERE"]));
							UserDAO::newEvaluation($auditeur, $atelier, $value["NOCRITERE"], $_POST[$value["NOCRITERE"]]);
						}
					}
					
					//reload
					foreach($this->ateliersIns as $key => $value){
					$data = array();
					foreach ($this->criteres as $key2 => $critere){
					
					array_push($data, UserDAO::getCritereSpecific($value["NOAUDITEUR"], $value["NOATEL"], intval($critere["NOCRITERE"])));
					//var_dump($data);
					}
					$this->ateliersIns[$key]["NOTES"] = $data;
			}
					
				}
			}
		}
	}