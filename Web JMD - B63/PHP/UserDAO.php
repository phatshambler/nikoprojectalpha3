<?php


	class UserDAO {
		
		
		public function __construct() {
			
		}
		
		public static function authenticate($username, $password) {
		
			$visibility = 0;
			
			if(isset($username) && isset($password) && $username != "" && $password != ""){
			
			$csv = UserDAO::loadJSON("users.txt");
			var_dump($csv);
				for($i = 0; $i < count($csv); $i++){
				if ($csv[$i][0] === $username && $csv[$i][1] === $password) {
					$visibility = $csv[$i][3];
				}
				}
			}
			
			return $visibility;
		}
		
		public static function getUser($username){
			$user = "";
			
			$users = UserDAO::loadJSON("users.txt");
			
			foreach ($users as $value){
				if($value[0] === $username){
				$user = $value;
				}
			}
			
			return $user;
		}
		
		public static function addUser($nom, $pwd, $courriel, $createur, $admin){
			
			$visibility = 1;
			if($createur === "oui"){
				$createur = true;
				$visibility = 2;
			}
			else{
				$createur = false;
			}
			
			if($admin === "oui"){
				$admin = true;
				$visibility = 3;
			}
			else{
				$admin = false;
			}
			
			$var = array($nom, $pwd, $courriel, $visibility, $createur, $admin);
			UserDAO::addJSON($var, "users.txt");
			
			return $visibility;
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
			
			$games = UserDAO::loadJSON("games.txt");
			
			$hiscores = "";
			
			foreach($games as $value){
				if($value[0] === $nomjeu){
				$hiscores = $value["hiscores"];
				}
			}
			
			$asok = array();
			$asoktime = array();

			$k = 1;
			
			if($hiscores != ""){
			
			foreach ($hiscores as $value){
				$key = $value->name . "(" . $k . ")";

				$asok[$key] = intval($value->score);
				$asoktime[$key] = $value->date;
				
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

			return $asok;
			}
			
			else{
			return null;
			}

		}

		private static function loadHiScoresCSV($nomjeu){
			
			$csv = array();
			
			$myFile = "PHP/InfoJeux/" . $nomjeu . ".txt";
			$fh = fopen($myFile, 'r');
			
			$csv = fgetcsv($fh, 0, ";");
			
			fclose($fh);
			
			return $csv;
		}
		
		
		public static function addJSON($object, $txtname){
		$myFile = "PHP/JSON/" . $txtname;
		
		$array = "";
		
		if(!file_exists($myFile)){
		
			$array = array();
			array_push($array, $object);
		}
		else{
			$olddata = UserDAO::loadJSON($txtname);
		
			$array = $olddata;
			array_push($array, $object);
		}
		
		$fh = fopen($myFile, 'w') or die("can't open file");
		
		$stringData = json_encode($array);
		
		fwrite($fh, $stringData);
		
		fclose($fh);
		}
		
		public static function loadJSON($txtname){
		
			$myFile = "PHP/JSON/" . $txtname;
			
			if(file_exists($myFile)){
			
			if(filesize($myFile) == 0){
				$theData = "";
			}
			else{
				$fh = fopen($myFile, 'r');
				$theData = fread($fh, filesize($myFile));
				fclose($fh);
			}
				return json_decode($theData);
			}
			else{
				return "";
			}
		
		}
		
		public static function crushJSON($array, $txtname){
		
			$worked = false;
			
			$myFile = "PHP/JSON/" . $txtname;
			
			if(file_exists($myFile)){
			
			$fh = fopen($myFile, 'w') or die("can't open file");
			
			$stringData = json_encode($array);
			
			fwrite($fh, $stringData);
			
			fclose($fh);
			
			$worked = true;
			}
			
			return $worked;
		}
		
		public static function crushobjectJSON($object, $txtname){
		
			$worked = false;
			
			$myFile = "PHP/JSON/" . $txtname;
			
			$array = "";
			
			$id = $object[0];
			
			if(file_exists($myFile)){
				
				$array = UserDAO::loadJSON($txtname);
				
				for($i = 0; $i < count($array); $i++){
					if($array[$i][0] === $id){
						$array[$i] = $object;
					}
				}
				
				$fh = fopen($myFile, 'w') or die("can't open file");
				
				$stringData = json_encode($array);
				
				fwrite($fh, $stringData);
				
				fclose($fh);
				
				$worked = true;
			}
				
				return $worked;
		}
		
		
		
	}
	
	
	class Score {
		
		public $name;
		public $score;
		public $date;
		
		public function __construct($name, $score, $date) {
			$this->name = $name;
			$this->score = $score;
			$this->date = $date;
		}
	
	}




