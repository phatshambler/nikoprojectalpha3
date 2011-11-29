<?php
	require_once("Connection.php");
	require_once("Constants.php");

	class GameDAO {
		
		
		public function __construct() {
			
		}
		
		public static function newGame($nomjeu, $nopartie, $nojeu, $nojoueur, $nomjoueur, $status) {
			$connection = Connection::getConnection();
			
			$query = "INSERT INTO current_game (ID, SCORE, X, Y, NOMJEU, NOPARTIE, NOJEU, NOJOUEUR, NOMJOUEUR, STATUS) VALUES(:id_bv, :score_bv, :x_bv, :y_bv, :nomjeu_bv, :nopartie_bv, :nojeu_bv, :nojoueur_bv, :nomjoueur_bv, :pStatus)";

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
			oci_bind_by_name($statement, ":pStatus", $status);
			
			if(oci_execute($statement)){
				$result = true;
			}
			else{
				$result = false;
			}
			
			Connection::closeConnection();
			
			return $result;
			
		}
		
		public static function getMyGamesStatus ($username){
			$connection = Connection::getConnection();
			
			$query = "SELECT * FROM current_game WHERE NOMJOUEUR = :pUsername";
			
			$statement = oci_parse($connection, $query);
			
			oci_bind_by_name($statement, ":pUsername", $username);
			
			oci_execute($statement);
			
			$result = array();
			
			while (($row = oci_fetch_array($statement, OCI_ASSOC))) {
				array_push($result, $row);
			}
			
			Connection::closeConnection();
			
			return $result;
		}
		
		public static function getScores(){
			$connection = Connection::getConnection();
			
			$query = "SELECT DISTINCT NOMJOUEUR, SCORE, X, Y FROM current_game ORDER BY NOMJOUEUR";
			
			$statement = oci_parse($connection, $query);
			
			oci_execute($statement);
			
			$result = array();
			
			while (($row = oci_fetch_array($statement, OCI_ASSOC))) {
				array_push($result, $row);
			}
			
			Connection::closeConnection();
			
			return $result;
		}
		
		public static function updateScore($id, $score, $x, $y){
		
			
			$connection = Connection::getConnection();
			
			$query = "UPDATE CURRENT_GAME SET SCORE = :pScore, X = :pX, Y = :pY WHERE NOJOUEUR = :pID";

			$statement = oci_parse($connection, $query);

			
			oci_bind_by_name($statement, ":pID", $id);
			oci_bind_by_name($statement, ":pScore", $score);
			oci_bind_by_name($statement, ":pX", $x);
			oci_bind_by_name($statement, ":pY", $y);
			
			if(oci_execute($statement)){
				$result = true;
			}
			else{
				$result = false;
			}
			
			Connection::closeConnection();
			
			return $result;
		}
		
		public static function updateStatus($id, $status){
		
			
			$connection = Connection::getConnection();
			
			$query = "UPDATE CURRENT_GAME SET STATUS = :pStatus WHERE NOJOUEUR = :pID";

			$statement = oci_parse($connection, $query);

			oci_bind_by_name($statement, ":pID", $id);
			oci_bind_by_name($statement, ":pStatus", $status);
			
			if(oci_execute($statement)){
				$result = true;
			}
			else{
				$result = false;
			}
			
			Connection::closeConnection();
			
			return $result;
		}
		
		
		
		
		public static function deleteMyScore ($id){
			$connection = Connection::getConnection();
			
			$query = "DELETE FROM current_game WHERE NOJOUEUR = :pID";
			
			$statement = oci_parse($connection, $query);
			
			oci_bind_by_name($statement, ":pID", $id);
			
			oci_execute($statement);
			
			Connection::closeConnection();
			
		}
		
		
	}