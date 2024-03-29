<?php


	class MagicDAO {
		
		
		public function __construct() {
			
		}
		
		public static function joinGame($username, $game) {
		
		
		
		}
		
		public static function newGame($nomjeu, $nopartie, $nojeu, $nojoueur, $nomjoueur, $status) {
			$connection = Connection::getConnection();
			
			$query = "INSERT INTO current_game (ID, SCORE, X, Y, NOMJEU, NOPARTIE, NOJEU, NOJOUEUR, NOMJOUEUR, STATUS) VALUES(:id_bv, :score_bv, :x_bv, :y_bv, :nomjeu_bv, :nopartie_bv, :nojeu_bv, :nojoueur_bv, :nomjoueur_bv, :status_bv)";

			$statement = oci_parse($connection, $query);
			
			$zero = 0;
			
			oci_bind_by_name($statement, ":id_bv", $noaudit);
			oci_bind_by_name($statement, ":score_bv", $zero);
			oci_bind_by_name($statement, ":x_bv", $zero);
			oci_bind_by_name($statement, ":y_bv", $zero);
			oci_bind_by_name($statement, ":nomjeu_bv", $nomjeu);
			oci_bind_by_name($statement, ":nopartie_bv", $nopartie);
			oci_bind_by_name($statement, ":nojeu_bv", $nojeu);
			oci_bind_by_name($statement, ":nojoueur_bv", $nojoueur);
			oci_bind_by_name($statement, ":nomjoueur_bv", $nomjoueur);
			oci_bind_by_name($statement, ":status_bv", $status);
			
			if(oci_execute($statement)){
				$result = true;
			}
			else{
				$result = false;
			}
			
			Connection::closeConnection();
			
			return $result;
			
		}
		
		public static function getMyGamesStatus ($username, $partie){
			$connection = Connection::getConnection();
			
			$query = "SELECT * FROM current_game WHERE NOMJOUEUR = :pUsername AND NOPARTIE = :partie";
			
			$statement = oci_parse($connection, $query);
			
			oci_bind_by_name($statement, ":pUsername", $username);
			oci_bind_by_name($statement, ":partie", $partie);
			
			oci_execute($statement);
			
			$result = array();
			
			while (($row = oci_fetch_array($statement, OCI_ASSOC))) {
				array_push($result, $row);
			}
			
			Connection::closeConnection();
			
			return $result;
		}
		
		public static function getAllGamesStatus($partie){
			$connection = Connection::getConnection();
			
			$query = "SELECT DISTINCT NOMJOUEUR FROM current_game WHERE NOPARTIE = :partie";
			
			$statement = oci_parse($connection, $query);
			
			oci_bind_by_name($statement, ":partie", $partie);
			
			oci_execute($statement);
			
			$result = array();
			
			while (($row = oci_fetch_array($statement, OCI_ASSOC))) {
				array_push($result, $row);
			}
			
			Connection::closeConnection();
			
			return $result;
		}
		
		public static function getLockedStatus($username, $partie){
			$connection = Connection::getConnection();
			
			$query = "SELECT STATUS FROM current_game WHERE NOMJOUEUR = :pUsername AND NOPARTIE = :partie";
			
			$statement = oci_parse($connection, $query);
			
			oci_bind_by_name($statement, ":pUsername", $username);
			oci_bind_by_name($statement, ":partie", $partie);
			
			oci_execute($statement);
			
			$result = array();
			
			while (($row = oci_fetch_array($statement, OCI_ASSOC))) {
				array_push($result, $row);
			}
			
			
			Connection::closeConnection();
			
			if($result[0]["STATUS"] == 2){ ///2 == MultiplayerAction::$STATUS_LOCKED
				return true;
			}
			else{
				return false;
			}
			
		}
		
		public static function getRunningStatus($username, $partie){
			$connection = Connection::getConnection();
			
			$query = "SELECT STATUS FROM current_game WHERE NOMJOUEUR = :pUsername AND NOPARTIE = :partie";
			
			$statement = oci_parse($connection, $query);
			
			oci_bind_by_name($statement, ":pUsername", $username);
			oci_bind_by_name($statement, ":partie", $partie);
			
			oci_execute($statement);
			
			$result = array();
			
			while (($row = oci_fetch_array($statement, OCI_ASSOC))) {
				array_push($result, $row);
			}
			
			
			Connection::closeConnection();
			
			if($result[0]["STATUS"] > 2){ ///2 == MultiplayerAction::$STATUS_LOCKED
				return true;
			}
			else{
				return false;
			}
			
		}
		
		public static function getStartingConditions($game){
			$connection = Connection::getConnection();
			
			$query = "SELECT DISTINCT NOMJOUEUR, STATUS FROM current_game WHERE NOPARTIE = :pGame";
			
			$statement = oci_parse($connection, $query);
			
			oci_bind_by_name($statement, ":pGame", $game);
			
			oci_execute($statement);
			
			$result = array();
			
			while (($row = oci_fetch_array($statement, OCI_ASSOC))) {
				array_push($result, $row);
			}
			
			Connection::closeConnection();
			
			return $result;
		}
		
		public static function getEndingConditions($game){
			$connection = Connection::getConnection();
			
			$query = "SELECT DISTINCT NOMJOUEUR, SCORE FROM current_game WHERE NOPARTIE = :pGame";
			
			$statement = oci_parse($connection, $query);
			
			oci_bind_by_name($statement, ":pGame", $game);
			
			oci_execute($statement);
			
			$result = array();
			
			while (($row = oci_fetch_array($statement, OCI_ASSOC))) {
				array_push($result, $row);
			}
			
			Connection::closeConnection();
			
			return $result;
		}
		
		public static function deleteRecords ($partie){
			$connection = Connection::getConnection();
			
			$query = "DELETE FROM current_game WHERE NOPARTIE = :partie";
			
			$statement = oci_parse($connection, $query);
			
			oci_bind_by_name($statement, ":partie", $partie);
			
			oci_execute($statement);
			
			Connection::closeConnection();
			
		}
		
		public static function deleteMyRecords ($user, $partie){
			$connection = Connection::getConnection();
			
			$query = "DELETE FROM current_game WHERE NOMJOUEUR = :pJoueur AND NOPARTIE = :partie";
			
			$statement = oci_parse($connection, $query);
			
			oci_bind_by_name($statement, ":pJoueur", $user);
			oci_bind_by_name($statement, ":partie", $partie);
			
			oci_execute($statement);
			
			Connection::closeConnection();
			
		}
		
		public static function updateStatus($id, $status, $partie){
		
			
			$connection = Connection::getConnection();
			
			$query = "UPDATE CURRENT_GAME SET STATUS = :pStatus WHERE NOJOUEUR = :pID AND NOPARTIE = :partie";

			$statement = oci_parse($connection, $query);

			oci_bind_by_name($statement, ":pID", $id);
			oci_bind_by_name($statement, ":pStatus", $status);
			oci_bind_by_name($statement, ":partie", $partie);
			
			if(oci_execute($statement)){
				$result = true;
			}
			else{
				$result = false;
			}
			
			Connection::closeConnection();
			
			return $result;
		}

		public static function updateScores($game, $name, $score){
		
			
			$connection = Connection::getConnection();
			
			$query = "INSERT INTO game_scores (NAME, GAME, SCORE) VALUES (:pname, :pgame, :pscore)";
			
			//$score = intval($score);
			
			$statement = oci_parse($connection, $query);

			oci_bind_by_name($statement, ":pname", $name);
			oci_bind_by_name($statement, ":pgame", $game);
			oci_bind_by_name($statement, ":pscore", $score);

			if(oci_execute($statement)){
				$result = true;
			}
			else{
				$result = false;
			}
			
			Connection::closeConnection();
			
			return $result;
		}

		public static function getHighScores(){
			$connection = Connection::getConnection();
			
			$query = "SELECT NAME, SCORE FROM game_scores ORDER BY SCORE DESC";
			
			$statement = oci_parse($connection, $query);
			
			oci_execute($statement);
			
			$result = array();
			
			while (($row = oci_fetch_array($statement, OCI_ASSOC))) {
				array_push($result, $row);
			}
			
			Connection::closeConnection();
			
			return $result;
		}
		
		
	}