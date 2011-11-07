<?php


	class UserDAO {
		
		
		public function __construct() {
			
		}
		
		public static function authenticate($username, $password) {
		
			$visibility = 0;
			
			if(isset($username) && isset($password) && $username != "" && $password != ""){
			
			$csv = UserDAO::loadUsersCSV();
			
			
				for($i = 0; $i < count($csv); $i += 3){
			
			
				if ($csv[$i] === $username && $csv[$i + 1] === $password) {
					$visibility = 1;
				}
			
				}
			}
			
			//UserDAO::createNewHiScoreFile("Awesome Shooter");
			//UserDAO::addHiScores("Awesome Shooter", "niko", "30000");
			
			//UserDAO::getGames();
			
			return $visibility;
		}
		
		
		private static function loadUsersCSV (){
			
			$csv = array();
			
			//echo "LOADING";
			$myFile = "PHP/InfoUsers/users.txt";
			$fh = fopen($myFile, 'r');
			
			$csv = fgetcsv($fh, 0, ";");
			
			//$theData = fread($fh, filesize($myFile));
			fclose($fh);
			//var_dump($theData);
			//var_dump($csv);
			
			return $csv;
			//parsing
			
		}
		
		public static function addUser($nom, $pwd, $courriel){
			
			$visibility = 0;

			$valid = true;

			$users = UserDAO::LoadUsersCSV();

			if($nom != "" && $pwd != "" && $courriel != ""){
				$k = 0;

				while($k + 2 < count($users)){

					if($nom == $users[$k] || $courriel == $users[$k + 2]){
						$valid = false;
					}
					$k += 3;
				}
				if($valid){
					$visibility = 1;
					UserDAO::writeNewUser($nom, $pwd, $courriel);
				}
			}
			
			return $visibility;
		}
		
		private static function writeNewUser($nom, $pwd, $crl){
		$myFile = "PHP/InfoUsers/users.txt";
		
		$olddata = UserDAO::loadUsersRaw();
		
		$fh = fopen($myFile, 'w') or die("can't open file");
		
		$stringData = $olddata;
		fwrite($fh, $stringData);
		
		$stringData = $nom . ";";
		fwrite($fh, $stringData);
		
		$stringData = $pwd . ";";
		fwrite($fh, $stringData);
		
		$stringData = $crl . ";";
		fwrite($fh, $stringData);
		
		fclose($fh);
		}
		
		
		public static function getGames(){
			$liste = array();
			
			if ($handle = opendir('PHP/InfoJeux')) {
				

			/* This is the correct way to loop over the directory. */
			while (false !== ($file = readdir($handle))) {
				if ($file != "." && $file != "..") {
				array_push($liste, basename($file, ".txt"));
				}
			}

			closedir($handle);
			}
			//var_dump($liste);
			return $liste;
		}
		
		private static function createNewHiScoreFile($nomjeu){
			$ourFileName = "PHP/InfoJeux/" . $nomjeu . ".txt";
			$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
			fclose($ourFileHandle);

		}
		
		private static function addHiScores($nomjeu, $stringAnom, $stringBscore){
		$myFile = "PHP/InfoJeux/" . $nomjeu . ".txt";
		
		$olddata = UserDAO::loadHiScoresRaw($nomjeu);
		
		$fh = fopen($myFile, 'w') or die("can't open file");
		
		$stringData = $olddata;
		fwrite($fh, $stringData);
		
		$stringData = $stringAnom . ";";
		fwrite($fh, $stringData);
		
		$stringData = $stringBscore . ";";
		fwrite($fh, $stringData);
		fclose($fh);
		}
		
		private static function loadHiScoresRaw($nomjeu){
		
			$myFile = "PHP/InfoJeux/" . $nomjeu . ".txt";
		
		if(filesize($myFile) == 0){
			$theData = "";
		}
		else{
			$fh = fopen($myFile, 'r');
			$theData = fread($fh, filesize($myFile));
			fclose($fh);
		}
			return $theData;
		
		}

		public static function loadHiScoresOrdered($nomjeu, $ordre, $nomuser){
			
			$csv = UserDAO::loadHiScoresCSV($nomjeu);

			$noms = array();
			$scores = array();

			$asok = array();

			$k = 1;

			for ($i = 0; $i + 1 < count($csv) ; $i+= 2){
				//array_push($noms, $csv[$i]);
				//array_push($scores, intval($csv[$i + 1]));
				$key = $csv[$i] . "(" . $k . ")";

				$asok[$key] = intval($csv[$i + 1]);
				$k++;
			}
			//var_dump($asok);
			if($ordre === "Top Scores"){
				arsort($asok);
			}
			else if($ordre === "Mes Scores"){
				
				foreach ($asok as $key => $value) {
					if(!strstr($key, $nomuser)){
						unset($asok[$key]);
					}
				}
				arsort($asok);
			}
			else if($ordre === "Derniers"){

				
			}
			else if($ordre === "7 jours"){

				
			}
			else if($ordre === "Mois"){

				
			}
			else if($ordre === "Annee"){

				
			}



			//var_dump($asok);

			return $asok;

		}

		private static function loadHiScoresCSV($nomjeu){
			
			$csv = array();
			
			$myFile = "PHP/InfoJeux/" . $nomjeu . ".txt";
			$fh = fopen($myFile, 'r');
			
			$csv = fgetcsv($fh, 0, ";");
			
			//$theData = fread($fh, filesize($myFile));
			fclose($fh);
			//var_dump($theData);
			//var_dump($csv);
			
			return $csv;
		}
		
		private static function loadUsersRaw(){
		
			$myFile = "PHP/InfoUsers/users.txt";
		
		if(filesize($myFile) == 0){
			$theData = "";
		}
		else{
			$fh = fopen($myFile, 'r');
			$theData = fread($fh, filesize($myFile));
			fclose($fh);
		}
			return $theData;
		
		}
		
		public static function addJSON($object){
		$myFile = "PHP/InfoJeux/" . "json.txt";
		
		$olddata = UserDAO::loadJSON();
		
		$fh = fopen($myFile, 'w') or die("can't open file");
		
		$stringData = $olddata;
		fwrite($fh, $stringData);
		
		$stringData = json_encode($object);
		
		fwrite($fh, $stringData);
		
		fclose($fh);
		}
		
		public static function loadJSON(){
		
			$myFile = "PHP/InfoJeux/" . "json.txt";
		
		if(filesize($myFile) == 0){
			$theData = "";
		}
		else{
			$fh = fopen($myFile, 'r');
			$theData = fread($fh, filesize($myFile));
			fclose($fh);
		}
			return $theData;
		}
		
		public function getAuth($username, $password){
		
		}
		
		public function getIndex(){
		
		}
		
		public function getCourriel(){
		
		}
		
		public function setIndex(){
		
		}
		
		public function setCourriel(){
		
		}
	
	
	}




