<?php


	class UserDAO {
		
		private $arrUsers;
		private $arrPasswords;
		private $strIndex;
		private $strCourriel;
		
		public function __construct() {
			//$this.arrUsers = new array();
			//$this.arrPasswords = new array();
			//strIndex = "";
			//strCourriel = "";
			
			
		}
		
		public static function authenticate($username, $password) {
		
			$visibility = 0;
			
			if(isset($username) && isset($password) && $username != "" && $password != ""){
			
			$csv = UserDAO::loadDataCSV();
			
			
				for($i = 0; $i < count($csv); $i += 3){
			
			
				if ($csv[$i] === $username && $csv[$i + 1] === $password) {
					$visibility = 1;
				}
			
				}
			}
			
			UserDAO::createNewHiScoreFile("Awesome Shooter");
			UserDAO::addHiScores("Awesome Shooter", "niko", "30000");
			
			return $visibility;
		}
		
		
		private static function loadDataCSV (){
			
			$csv = array();
			
			echo "LOADING";
			$myFile = "PHP/users.txt";
			$fh = fopen($myFile, 'r');
			
			$csv = fgetcsv($fh, 0, ";");
			
			//$theData = fread($fh, filesize($myFile));
			fclose($fh);
			//var_dump($theData);
			var_dump($csv);
			
			return $csv;
			//parsing
			
		}
		
		public function getHiScores($username){
		
		
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




