<?php


	class UserDAO {
		
		
		public function __construct() {
			
		}
		
		public static function authenticate($username, $password) {
		
			$visibility = 0;
			
			if(isset($username) && isset($password) && $username != "" && $password != ""){
			
			$csv = UserDAO::loadJSON("users.txt");
			
			if($csv != null && $csv != ""){
			
			var_dump($csv);
				for($i = 0; $i < count($csv); $i++){
				if ($csv[$i][0] === $username && $csv[$i][1] === $password) {
					$visibility = 1;
					
					if($csv[$i][3] == true && $csv[$i][4] == false){
					$visibility = 2;
					}
					else if($csv[$i][3] == false && $csv[$i][4] == true){
					$visibility = 3;
					}
					else if($csv[$i][3] == true && $csv[$i][4] == true){
					$visibility = 4;
					}
				}
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
			
			$visibility = 0;
			
			if(UserDAO::getUser($nom) == ""){
				$visibility = 1;
				if($createur === "oui" $admin === "non"){
					$true_createur = true;
					$true_admin = false;
					$visibility = 2;
				}
				if($createur === "non" $admin === "oui"){
					$true_createur = false;
					$true_admin = true;
					$visibility = 3;
				}
				
				if($createur === "oui" $admin === "oui"){
					$true_createur = true;
					$true_admin = true;
					$visibility = 4;
				}
				
				$var = array($nom, $pwd, $courriel, $visibility, $createur, $admin);
				UserDAO::addJSON($var, "users.txt");
			}
			return $visibility;
		}
		
		private static function createNewHiScoreFile($nomjeu){
			$ourFileName = "PHP/InfoJeux/" . $nomjeu . ".txt";
			$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
			fclose($ourFileHandle);

		}
		
		public static function injectIntoFile($path, $position, $data, $phpdata){
			$ourFileName = $path . ".logged.html";
			$ourReciever = dirname($path) . "/rec.php";
			//var_dump($ourFileName);
			$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
			$ourFileHandle2 = fopen($ourReciever, 'w') or die("can't open file");
			
			$trimmed = file($path, FILE_USE_INCLUDE_PATH);
			//var_dump($trimmed);
			
			foreach($trimmed as $key => $value){
				if(strstr($value, "<body>")){
					$trimmed[$key] = $trimmed[$key] . $data;
				}
			}
			
			
			foreach($trimmed as $value){
				fwrite($ourFileHandle, $value);
			}
			fclose($ourFileHandle);
			
			fwrite($ourFileHandle2, $phpdata);
			fclose($ourFileHandle2);
			
			return $ourFileName;

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
				//var_dump($value);
				$key = $value["name"] . "(" . $k . ")";

				$asok[$key] = intval($value["score"]);
				$asoktime[$key] = $value["date"];
				
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
				arsort($asoktime);
				$asok = $asoktime;
				
			}
			else if($ordre === "Semaine"){
				arsort($asoktime);
				$lastWeek = time() - (7 * 24 * 60 * 60);
				
				foreach($asoktime as $key =>$value){
					if($value[0] < $lastWeek){
						unset($asoktime[$key]);
					}
				}
				$asok = $asoktime;
				//echo "winning";
				
			}
			else if($ordre === "Mois"){
				arsort($asoktime);
				$lastWeek = time() - (30 * 24 * 60 * 60);
				
				foreach($asoktime as $key =>$value){
					if($value[0] < $lastWeek){
						unset($asoktime[$key]);
					}
				}
				$asok = $asoktime;
				
			}
			else if($ordre === "Annee"){
				arsort($asoktime);
				$lastWeek = time() - (365 * 24 * 60 * 60);
				
				foreach($asoktime as $key =>$value){
					if($value[0] < $lastWeek){
						unset($asoktime[$key]);
					}
				}
				$asok = $asoktime;
				
			}

			return $asok;
			}
			else{
				return null;
			}

		}
/*
		private static function loadHiScoresCSV($nomjeu){
			
			$csv = array();
			
			$myFile = "PHP/InfoJeux/" . $nomjeu . ".txt";
			$fh = fopen($myFile, 'r');
			
			$csv = fgetcsv($fh, 0, ";");
			
			fclose($fh);
			
			return $csv;
		}
		*/
		
		public static function addJSON($object, $txtname){
		$myFile = "PHP/JSON/" . $txtname;
		
		#$array = "";
		
		if(!file_exists($myFile)){
		
			$array = array();
			array_push($array, $object);
		}
		else{
			$array = UserDAO::loadJSON($txtname);
		
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
				return json_decode($theData, true);
			}
			else{
				return "";
			}
		
		}
		
	public static function loadObjectJSON($txtname, $objectid){
		
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
				$array = json_decode($theData, true);
				$toReturn = "";
				
				foreach ($array as $value){
					//var_dump($value);
					foreach ($value as $item){
						//var_dump($item);
						if(isset($item) && $item == $objectid){
							$toReturn = $value;
						
						}
						else if(isset($item["0"]) && $item["0"] == $objectid)
							$toReturn = $value;
						}
				
				}
				return $toReturn;
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
				
				foreach ($array as $key => $value){
					if($value[0] === $id){
						$array[$key] = $object;
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




