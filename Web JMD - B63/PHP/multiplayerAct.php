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
			
			$this->liste_users = MagicDAO::getAllGamesStatus();
			
			if(!isset($_SESSION["status"])){
				$_SESSION["status"] = MultiplayerAction::$STATUS_OFF;
			}
			else{
				$arr = MagicDAO::getMyGamesStatus($_SESSION["username"]);
				//var_dump($_SESSION["username"]);
				//var_dump($arr);
				if(isset($arr[0])){
					$_SESSION["status"] = $arr[0]["STATUS"];
				}
			}
			
			if(isset($_SESSION["status"])){
				if($_SESSION["status"] == MultiplayerAction::$STATUS_EXIT){
					$this->finalScores = MagicDAO::getEndingConditions(1);
					arsort($this->finalScores);
				}
			}
			
			//pour les post...
			
			
			if(isset($_POST["newmulti"]) && $_POST["newmulti"] == "Awesome Shooter"){
				//echo "new game";
				$this->nom_jeu_choisi = $_POST["newmulti"];
				
				//$lol = MagicDAO::getAllGamesStatus();
				
				//var_dump($lol);
				
				$_SESSION["userid"] = rand();
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
			echo '<script language="Javascript">
						<!--
						document.location.replace("as_multiplayer/nr_jeu.php");
						// -->
						</script>';
			
		
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