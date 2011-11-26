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
		
		public $user;
		
		public static $STATUS_OFF = 0;
		public static $STATUS_WAITING = 1;
		public static $STATUS_STARTED = 2;
		public static $STATUS_ENDGAME = 3;
		
	
		public function __construct() {
			parent::__construct(DefaultAct::$VISIBILITY_PUBLIC);
		}
		
		protected function executeAction() {
			
			if(!isset($this->status)){
				$this->status = MultiplayerAction::$STATUS_OFF;
			}
			
			if(isset($_POST["newmulti"]) && $_POST["newmulti"] == "Awesome Shooter"){
				echo "new game";
				$this->nom_jeu_choisi = $_POST["newmulti"];
				
				$lol = MagicDAO::getAllGamesStatus();
				
				var_dump($lol);
				
				MagicDAO::newGame($this->nom_jeu_choisi, 1 , 4, 3, $_SESSION["username"]);
			
			}
		
		
		}
		
	}