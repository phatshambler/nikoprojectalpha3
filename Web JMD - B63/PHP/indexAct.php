<?php
	require_once("PHP/defaultAct.php");

	class IndexAction extends DefaultAct {
		public $errorCode;
		
	
		public function __construct() {
			parent::__construct(DefaultAct::$VISIBILITY_PUBLIC);
		}
		
		protected function executeAction() {
			
			if (isset($_GET["action"]) && $_GET["action"] === "succes") {
				$this->errorCode = 110;
			}
			
			if (isset($_POST["username"])) {
				$visibility = UserDAO::authenticate($_POST["username"], $_POST["pwd"]);
				
				if ($visibility > DefaultAct::$VISIBILITY_PUBLIC) {
				
					parent::setUserCredentials($_POST["username"], $visibility);
				
					header("location:index.php");
					exit;
				}
				else {
					$this->errorCode = 101;
				}
			}
			if(isset($_POST["currenthi"])){
				$_SESSION["menuopen"] = $_POST["currenthi"];
			}
			if(isset($_POST["order"])){
				$_SESSION["order"] = $_POST["order"];
			}
			
			if(isset($_POST["envoyerscore"])){
				var_dump($_POST["nom"]);
				var_dump($_POST["jeu"]);
				var_dump($_POST["score"]);
				
				$games = UserDAO::loadJSON("games.txt");
				
				$name = "Anonymous";
				$date = getdate();
				
				if(isset($_SESSION["username"])){
					$name = $_SESSION["username"];
				}
				
				if($games){
				
				foreach($games as $key => $value){
					if($_POST["jeu"] === $value[0]){
						//adds a hi score!
						
						$score = array();
						$score["name"] = $name;
						$score["score"] = strval(intval($_POST["score"]));
						$score["date"] = $date;
						
						array_push($games[$key]["hiscores"], $score);
						//var_dump($value);
						echo "score recu";
						//var_dump($games);
						UserDAO::crushJSON($games, "games.txt");
						//cheat code
						echo '<script language="Javascript">
						<!--
						document.location.replace("indx.php");
						// -->
						</script>';
					}
				}
				}
			}
		}
	}