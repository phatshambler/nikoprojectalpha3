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
		
		public $user;
		
		public static $STATUS_OFF = 0;
		public static $STATUS_WAITING = 1;
		public static $STATUS_STARTED = 2;
		public static $STATUS_ENDGAME = 3;
		
	
		public function __construct() {
			parent::__construct(DefaultAct::$VISIBILITY_PUBLIC);
		}
		
		protected function executeAction() {
			
			$this->liste_users = MagicDAO::getAllGamesStatus();
			
			if(!isset($_SESSION["status"])){
				$_SESSION["status"] = MultiplayerAction::$STATUS_OFF;
			}
			
			if(isset($_POST["newmulti"]) && $_POST["newmulti"] == "Awesome Shooter"){
				echo "new game";
				$this->nom_jeu_choisi = $_POST["newmulti"];
				
				//$lol = MagicDAO::getAllGamesStatus();
				
				//var_dump($lol);
				
				$_SESSION["userid"] = rand();
				$_SESSION["status"] = MultiplayerAction::$STATUS_WAITING;
				
				MagicDAO::newGame($this->nom_jeu_choisi, 1 , 1, $_SESSION["userid"], $_SESSION["username"]);
				
				$this->liste_users = MagicDAO::getAllGamesStatus();
			
			}
			
			if(isset($_POST["delete"])){
				MagicDAO::deleteRecords();
				$_SESSION["status"] = MultiplayerAction::$STATUS_OFF;
				$this->liste_users = MagicDAO::getAllGamesStatus();
			}
		
		}
		
	}