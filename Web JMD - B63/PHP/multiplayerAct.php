<?php
	require_once("PHP/defaultAct.php");
	require_once("PHP/Magic/MagicDAO.php");
	require_once("PHP/Magic/Constants.php");
	require_once("PHP/Magic/Connection.php");

	class MultiplayerAction extends DefaultAct {
		public $errorCode;
		public $status;
		public $nom_jeu_choisi;
		public $no_jeu;
		public $no_partie;
		public $liste_users;
		public $timeout;
		public $finalScores;
		public $hiScores;
		public $conditions;
		public $isStarted;
		public $isExiting;
		
		public $user;
		
		public static $STATUS_OFF = 0;
		public static $STATUS_WAITING = 1;
		public static $STATUS_LOCKED = 2;
		public static $STATUS_RUNNING = 3;
		public static $STATUS_PAUSED = 4;
		public static $STATUS_ENDGAME = 5;
		public static $STATUS_EXIT = 6;
	
		public function __construct() {
			parent::__construct(DefaultAct::$VISIBILITY_PUBLIC);
		}
		
		protected function executeAction() {
			
			if (!isset($_SESSION["username"])) {
				header("location:index.php");
				exit;
			}
			
			if(!isset($_SESSION["userid"])){
				$_SESSION["userid"] = rand();
			}
			
			$this->liste_users = MagicDAO::getAllGamesStatus();

			$this->hiScores = MagicDAO::getHighScores();
			arsort($this->hiScores);
			
			if(isset($_SESSION["partie"])){
			
			$this->conditions = MagicDAO::getStartingConditions($_SESSION["partie"]);
			}
			else{
			$this->conditions = MagicDAO::getStartingConditions(1);
			}
			$isStarted = true;

			foreach ($this->conditions as $value){
					if ($value["STATUS"] != MultiplayerAction::$STATUS_RUNNING){
						$isStarted = false;
					}
			}
			
			if(!isset($_SESSION["status"])){
				$_SESSION["status"] = MultiplayerAction::$STATUS_OFF;
			}
			else{
				$arr = MagicDAO::getMyGamesStatus($_SESSION["username"]);
				
				if(isset($arr[0])){
					$_SESSION["status"] = $arr[0]["STATUS"];
				}
			}
			
			$this->isExiting = false;
			
			if(isset($_SESSION["status"])){
				if($_SESSION["status"] == MultiplayerAction::$STATUS_EXIT){
					$this->finalScores = MagicDAO::getEndingConditions(1);
					arsort($this->finalScores);
					$this->isExiting = true;
					MagicDAO::updateStatus($_SESSION["userid"], MultiplayerAction::$STATUS_WAITING);
					foreach ($this->finalScores as $key => $value){
						foreach($value as $key2 => $value2){
							if($key2 == "SCORE"){
								if($value["NOMJOUEUR"] == $_SESSION["username"]){
							
									//var_dump($_SESSION["username"]);
									//var_dump($value2);
									MagicDAO::updateScores(1, $_SESSION["username"], $value2);
							}
							}
						}
					}
					
					$_SESSION["status"] = MultiplayerAction::$STATUS_WAITING;
					$this->liste_users = MagicDAO::getAllGamesStatus();
					$this->hiScores = MagicDAO::getHighScores();
					arsort($this->hiScores);
				}
			}
			
			//pour les post...
			
			
			if(isset($_POST["newmulti"]) && $_POST["newmulti"] == "Awesome Shooter"){
				//echo "new game";
				$this->nom_jeu_choisi = $_POST["newmulti"];
				
				//$lol = MagicDAO::getAllGamesStatus();
				
				//var_dump($lol);
				
				
				$_SESSION["partie"] = 1;
				$_SESSION["status"] = MultiplayerAction::$STATUS_WAITING;
				
				MagicDAO::newGame($this->nom_jeu_choisi, 1 , 1, $_SESSION["userid"], $_SESSION["username"], MultiplayerAction::$STATUS_WAITING);
				
				$this->liste_users = MagicDAO::getAllGamesStatus();
			
			}
			
			if(isset($_POST["lock"])){
				MagicDAO::updateStatus($_SESSION["userid"], MultiplayerAction::$STATUS_LOCKED);
				$_SESSION["status"] = MultiplayerAction::$STATUS_LOCKED;
				$this->liste_users = MagicDAO::getAllGamesStatus();
				$this->timeout = 10;
			}
			
			if(isset($_POST["delete"])){
				MagicDAO::deleteRecords();
				$_SESSION["status"] = MultiplayerAction::$STATUS_OFF;
				$this->liste_users = MagicDAO::getAllGamesStatus();
			}
			
			if(isset($_POST["reload"])){
				
				$this->liste_users = MagicDAO::getAllGamesStatus();
			}
			
			if(isset($_POST["deleteme"])){
				MagicDAO::deleteMyRecords($_SESSION["username"]);
				$_SESSION["status"] = MultiplayerAction::$STATUS_OFF;
				$this->liste_users = MagicDAO::getAllGamesStatus();
			}
		
		}
		
		public function start(){
			try{
			$lol = false;
			while (!$lol){
				
				$lol = true;
				$arr = MagicDAO::getStartingConditions($_SESSION["partie"]);
				
				foreach ($arr as $value){
					if ($value["STATUS"] != MultiplayerAction::$STATUS_LOCKED){
						$lol = false;
					}
				}
				
			}
			sleep(1);
			$_SESSION["status"] = MultiplayerAction::$STATUS_RUNNING;

			MagicDAO::updateStatus($_SESSION["userid"], MultiplayerAction::$STATUS_RUNNING);

			echo '<script language="Javascript">
						<!--
						document.location.replace("as_multiplayer/nr_jeu.php");
						// -->
						</script>';
			}
			catch (Exception $e) {
    			return false;
			}
			
		
		}
		
		public function testInListe(){
			$arr = MagicDAO::getMyGamesStatus($_SESSION["username"]);
			
			if(isset($arr[0]) && $arr[0] != null){
				return true;
			}
			else{
				return false;
			}
		}
		
		public function testLocked($username){
			return MagicDAO::getLockedStatus($username);
		}
		
	}