<?php
	require_once("PHP/defaultAct.php");
	require_once("PHP/unzip.php");

	class UserAction extends DefaultAct {
		public $errorCode;
		
	
		public function __construct() {
			parent::__construct(DefaultAct::$VISIBILITY_MEMBER);
		}
		
		protected function executeAction() {
			
			if (isset($_SESSION["username"])) {
				
				if(isset($_POST["sender"]) && isset($_POST["site"]) && isset($_FILES["image"]) && isset($_POST["chemin"]) && isset($_FILES["fichier"])) {
				
				//echo "lovely";
				
				$content_dir = 'PHP/upload/'; // dossier où sera déplacé le fichier

				$tmp_file = $_FILES['image']['tmp_name'];

				if( !is_uploaded_file($tmp_file) )
				{
					exit("Le fichier est introuvable");
				}

				// on vérifie maintenant l'extension
				$type_file = $_FILES['image']['type'];

				if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') && !strstr($type_file, 'png') )
				{
					exit("Le fichier n'est pas une image");
				}

				// on copie le fichier dans le dossier de destination
				$name_file = $_FILES['image']['name'];
				$imagepath = $content_dir . $_POST["gamename"] . str_replace("image/", ".", $type_file);

				if( !copy($tmp_file, $imagepath ) )
				{
					exit("Impossible de copier le fichier dans $content_dir");
				}
				
				unzip($_FILES['fichier']['tmp_name'], "PHP/upload/" . $_POST["gamename"] . "/", true, false);
				
				$dir = $content_dir . $_POST["gamename"] . "/" . $_POST["chemin"];
				
				$date = getdate();
				
				$newgame = array($_POST["gamename"], $_POST["site"], $imagepath, $_POST["chemin"], $dir, $date, $_SESSION["username"]);
				$newgame["hiscores"] = array(new Score("niko", "1", getdate()));
				array_push($newgame["hiscores"], new Score("niko", "10", getdate()));
				array_push($newgame["hiscores"], new Score("paul", "100", getdate()));
				array_push($newgame["hiscores"], new Score("niko", "10", getdate()));
				array_push($newgame["hiscores"], new Score("jean", "5", getdate()));
				array_push($newgame["hiscores"], new Score("niko", "300", getdate()));
				array_push($newgame["hiscores"], new Score("niko", "1", getdate()));
				array_push($newgame["hiscores"], new Score("niko", "900", getdate()));
				#var_dump($newgame);
				
				UserDAO::addJSON($newgame, "games.txt");
				
				$this->errorCode = 104;
				
				#header("location:index.php?action=succes");
				#exit;
				
				}
				
				
				
				if(isset($_POST["removegame"])){
				
					if(isset($_POST["love"])){
					$games = UserDAO::loadJSON("games.txt");
					$test = false;
					
					foreach ($games as $key => $value){
						if($value[0] == $_POST["love"]){
							unset($games[$key]);
							$test = true;
						}
					}
					
					if($test){
						UserDAO::crushJSON($games, "games.txt");
					}
					}
				}
				
				if(isset($_POST["removeuser"])){
					if(isset($_POST["love"])){
					
					$users = UserDAO::loadJSON("users.txt");
					$test = false;
					
					foreach ($users as $key => $value){
						if($value[0] == $_POST["love"]){
							unset($users[$key]);
							$test = true;
						}
					}
					
					if($test){
						UserDAO::crushJSON($users, "users.txt");
					}
					}
				}
				
			
			}
			
		}
		
		
		
	}