<?php
	require_once("GameDAO.php");

	class GameMulti {
		
		
		public function __construct() {
			
		}
		
		public function run() {
			
			if(isset($_SESSION["userid"]) && isset($_SESSION["status"]) && isset($_SESSION["username"])){
				//echo "<p>" . $_SESSION["username"] . "-" . $_SESSION["userid"] . " Status:" . $_SESSION["status"] . "</p>";
				echo "<p id='txtHint'>Attendez...</p>";
				echo '<form action="nr_jeu.php" method="post">
				<input name="unlock" class="niceButton" style="font-size: 14px; color:lime; background-color:black" type="submit" value="Quitter" />
				</form>';
			
			
			}
			
			if(isset($_POST["unlock"])){
			
				GameDAO::updateStatus($_SESSION["userid"], 6, $_SESSION["partie"]);
				$_SESSION["status"] = 6;
				echo '<script language="Javascript">
						<!--
						document.location.replace("../multiplayer.php");
						// -->
						</script>';
			}
		
		}
		
	}