<?php
	session_start();
	require_once("PHP/DAO/UserDAO.php");
	require_once("PHP/Constants.php");
	require_once("PHP/DAO/Connection.php");

	abstract class DefaultAct {
		public static $VISIBILITY_PUBLIC = 0;
		public static $VISIBILITY_MEMBER = 1;
		public static $VISIBILITY_MODERATOR = 2;
		public static $VISIBILITY_ADMINISTRATOR = 3;
	
		private $pageVisibility;
	
		public function __construct($pageVisibility) {
			$this->pageVisibility = $pageVisibility;
		}
		
		public function execute() {
		
			if (isset($_GET["action"]) && $_GET["action"] === "logout") {
				session_unset();
				session_destroy();
			}
			
			if (!isset($_SESSION["user_visibility"])) {
				$_SESSION["user_visibility"] = DefaultAct::$VISIBILITY_PUBLIC;
			}
		
			if ($this->pageVisibility > $_SESSION["user_visibility"]) {
				header("location:index.php");
				exit;
			}
			
			$this->executeAction();
		}
		
		abstract protected function executeAction();
	
		protected function setUserCredentials($username, $visibility) {
			$_SESSION["username"] = $username;
			$_SESSION["user_visibility"] = $visibility;
			
		}
		
		protected function setCourriel($courriel){
			$_SESSION["courriel"] = $courriel;
		}
	
		public function getUsername() {
			$name = null;
			
			if (isset($_SESSION["username"])) {
				$name = $_SESSION["username"];
			}
			
			return $name;
		}
		
		public function isLoggedIn() {
			$loggedIn = false;
			
			if ($_SESSION["user_visibility"] > DefaultAct::$VISIBILITY_PUBLIC) {
				$loggedIn = true;
			}
			
			return $loggedIn;
		}
		
		public function getCurrentPage() {
			return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
		}
	}

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	