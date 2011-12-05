<?php

	class UserDAO {
	
		
		public static function authenticate($username, $password) {
			$connection = Connection::getConnection();
			
			$query = "SELECT CODEAUDITEUR, MOTDEPASSE FROM P_AUDITEUR WHERE CODEAUDITEUR = :pUsername AND MOTDEPASSE = :pPassword";

			$statement = oci_parse($connection, $query);

			
			oci_bind_by_name($statement, ":pUsername", $username);
			oci_bind_by_name($statement, ":pPassword", $password);
			
			oci_execute($statement);
			
			$result = null;
			
			if ($row = oci_fetch_array($statement)) {
				$result = $row;
			}
			
			//var_dump($result);
			
			Connection::closeConnection();
			
			return $result;
		}
		
	public static function authenticateAdmin($noauditeur) {
			$connection = Connection::getConnection();
			
			$query = "SELECT * FROM P_ADMIN WHERE NOAUDITEUR = :pUsername";

			$statement = oci_parse($connection, $query);

			oci_bind_by_name($statement, ":pUsername", $noauditeur);
						
			oci_execute($statement);
			
			$result = null;
			
			if ($row = oci_fetch_array($statement)) {
				$result = $row;
			}
			
			Connection::closeConnection();
			
			if(count($result) > 0){
				return true;
			}
			else{
				return false;
			}
		}
		
		public static function getTableDesc($table){
		
			$connection = Connection::getConnection();
			
			$query = "SELECT * FROM " . $table; // WHERE table_name = :pTable";

			$statement = oci_parse($connection, $query);
			
			//echo $table;
			//oci_bind_by_name($statement, ":table", $table);
			
			oci_execute($statement);
			
			$result = null;
			
			if ($row = oci_fetch_array($statement)) {
				$result = $row;
			}
			
			//var_dump($result);
			
			foreach($result as $key => $value){
				if(is_int($key)){
					unset($result[$key]);
				}
			}
			
			Connection::closeConnection();
			
			return $result;
		
		
		}
		
		public static function getTableMaxCoordonnees(){
		
			$connection = Connection::getConnection();
			
			$query = "SELECT MAX(NOCOORD) as maxcoord FROM p_coordonnees";

			$statement = oci_parse($connection, $query);
			
			//echo $table;
			
			oci_execute($statement);
			
			$result = null;
			
			if ($row = oci_fetch_array($statement)) {
				$result = $row;
			}
			
			foreach($result as $key => $value){
				if(is_int($key)){
					unset($result[$key]);
				}
			}
			
			Connection::closeConnection();
			
			//var_dump($result);
			
			return $result;
		
		
		}
		
		public static function getTableMaxAuditeurs(){
		
			$connection = Connection::getConnection();
			
			$query = "SELECT MAX(NOAUDITEUR) as maxaudit FROM p_auditeur";

			$statement = oci_parse($connection, $query);
			
			//echo $table;
			
			oci_execute($statement);
			
			$result = null;
			
			if ($row = oci_fetch_array($statement, OCI_ASSOC)) {
				$result = $row;
			}
			/*
			foreach($result as $key => $value){
				if(is_int($key)){
					unset($result[$key]);
				}
			}
			*/
			Connection::closeConnection();
			
			//var_dump($result);
			
			return $result;
		
		
		}
		
		public static function newAuditeur($noaudit, $codeaudit, $motdepasse, $nom, $prenom, $nocoord, $juge, $statut, $candidatjuge) {
			$connection = Connection::getConnection();
			
			$query = "INSERT INTO p_auditeur (NOAUDITEUR, CODEAUDITEUR, MOTDEPASSE, NOM, PRENOM, NOCOORD, JUGE, STATUT, CANDIDATJUGE) VALUES(:id_bv, :text_bv, :pass_bv, :nom_bv, :prenom_bv, :nocoord_bv, TO_DATE(:juge_bv, 'DDMMYYYY'), :statut_bv, TO_DATE(:candidatjuge_bv, 'DDMMYYYY'))";

			$statement = oci_parse($connection, $query);
			
			
			if($juge === "Oui"){
			$juge = date("dmY");
			}
			else{
			$juge = null;
			}
			if($candidatjuge == "Oui"){
			$candidatjuge = date("dmY");
			}
			else{
			$candidatjuge = null;
			}
			
			oci_bind_by_name($statement, ":id_bv", $noaudit);
			oci_bind_by_name($statement, ":text_bv", $codeaudit);
			oci_bind_by_name($statement, ":pass_bv", $motdepasse);
			oci_bind_by_name($statement, ":nom_bv", $nom);
			oci_bind_by_name($statement, ":prenom_bv", $prenom);
			oci_bind_by_name($statement, ":nocoord_bv", $nocoord);
			oci_bind_by_name($statement, ":juge_bv", $juge);
			oci_bind_by_name($statement, ":statut_bv", $statut);
			oci_bind_by_name($statement, ":candidatjuge_bv", $candidatjuge);
			
			if(oci_execute($statement)){
				$result = true;
			}
			else{
				$result = false;
			}
			
			
			Connection::closeConnection();
			
			return $result;
			
		}
		
		public static function updateAuditeur($codeaudit, $nom, $prenom, $statut, $candidatjuge) {
			$connection = Connection::getConnection();
			
			$query = "UPDATE p_auditeur SET NOM = :nom_bv, PRENOM = :prenom_bv, STATUT = :statut_bv, CANDIDATJUGE = TO_DATE(:candidatjuge_bv, 'DDMMYYYY') WHERE CODEAUDITEUR = :code_bv";

			$statement = oci_parse($connection, $query);
			
			if($candidatjuge == "Oui"){
			$candidatjuge = date("dmY");
			}
			else{
			$candidatjuge = null;
			}
			
			
			oci_bind_by_name($statement, ":code_bv", $codeaudit);
			oci_bind_by_name($statement, ":nom_bv", $nom);
			oci_bind_by_name($statement, ":prenom_bv", $prenom);
			oci_bind_by_name($statement, ":statut_bv", $statut);
			oci_bind_by_name($statement, ":candidatjuge_bv", $candidatjuge);
			
			if(oci_execute($statement)){
				$result = true;
			}
			else{
				$result = false;
			}
			
			
			Connection::closeConnection();
			
			return $result;
			
		}
		
		public static function newCoord($nocoord, $rue, $ville, $code_postal, $noregion, $telephone, $cell, $courriel) {
			$connection = Connection::getConnection();
			
			$query = "INSERT INTO p_coordonnees (NOCOORD, RUE, VILLE, CODE_POSTAL, NOREGION, TELEPHONE, CELL, COURRIEL) VALUES(:one_bv, :two_bv, :three_bv, :four_bv, :five_bv, :six_bv, :seven_bv, :eight_bv)";

			$statement = oci_parse($connection, $query);
			
			$telephone = ereg_replace("[^A-Za-z0-9]", "", $telephone);
			$cell = ereg_replace("[^A-Za-z0-9]", "", $cell);
			
			//var_dump($telephone);
			
			oci_bind_by_name($statement, ":one_bv", $nocoord);
			oci_bind_by_name($statement, ":two_bv", $rue);
			oci_bind_by_name($statement, ":three_bv", $ville);
			oci_bind_by_name($statement, ":four_bv", $code_postal);
			oci_bind_by_name($statement, ":five_bv", $noregion);
			oci_bind_by_name($statement, ":six_bv", $telephone);
			oci_bind_by_name($statement, ":seven_bv", $cell);
			oci_bind_by_name($statement, ":eight_bv", $courriel);
			
			if(oci_execute($statement)){
				$result = true;
			}
			else{
				$result = false;
			}
			
			
			Connection::closeConnection();
			
			return $result;
		}
		
		public static function updateCoord($nocoord, $rue, $ville, $code_postal, $noregion, $telephone, $cell, $courriel) {
			$connection = Connection::getConnection();
			
			$query = "UPDATE p_coordonnees SET RUE = :two_bv, VILLE = :three_bv, CODE_POSTAL = :four_bv, NOREGION = :five_bv, TELEPHONE = :six_bv, CELL = :seven_bv, COURRIEL = :eight_bv WHERE NOCOORD = :one_bv";

			$statement = oci_parse($connection, $query);
			
			oci_bind_by_name($statement, ":one_bv", $nocoord);
			oci_bind_by_name($statement, ":two_bv", $rue);
			oci_bind_by_name($statement, ":three_bv", $ville);
			oci_bind_by_name($statement, ":four_bv", $code_postal);
			oci_bind_by_name($statement, ":five_bv", $noregion);
			oci_bind_by_name($statement, ":six_bv", $telephone);
			oci_bind_by_name($statement, ":seven_bv", $cell);
			oci_bind_by_name($statement, ":eight_bv", $courriel);
			
			if(oci_execute($statement)){
				$result = true;
			}
			else{
				$result = false;
			}
			
			
			Connection::closeConnection();
			
			return $result;
		}
		
		public static function getPassword($username){
		
			$connection = Connection::getConnection();
			
			$query = "SELECT CODEAUDITEUR, MOTDEPASSE FROM P_AUDITEUR WHERE CODEAUDITEUR = :pUsername";

			$statement = oci_parse($connection, $query);

			
			oci_bind_by_name($statement, ":pUsername", $username);
			
			oci_execute($statement);
			
			$result = null;
			
			if ($row = oci_fetch_array($statement)) {
				$result = $row;
			}
			
			foreach($result as $key => $value){
				if(is_int($key)){
					unset($result[$key]);
				}
			}
			
			Connection::closeConnection();
			
			//var_dump($result);
			
			return $result;
		
		
		}
		
		public static function changePassword($username, $password) {
			$connection = Connection::getConnection();
			
			$query = "UPDATE P_AUDITEUR SET MOTDEPASSE = :pPassword WHERE CODEAUDITEUR = :pUsername";

			$statement = oci_parse($connection, $query);

			
			oci_bind_by_name($statement, ":pUsername", $username);
			oci_bind_by_name($statement, ":pPassword", $password);
			
			if(oci_execute($statement)){
				$result = true;
			}
			else{
				$result = false;
			}
			
			
			Connection::closeConnection();
			
			return $result;
		}
		
		public static function getUser($username){
			$connection = Connection::getConnection();
			
			$query = "SELECT * FROM P_AUDITEUR WHERE CODEAUDITEUR = :pUsername";

			$statement = oci_parse($connection, $query);

			oci_bind_by_name($statement, ":pUsername", $username);
			
			oci_execute($statement);
			
			$result = null;
			
			if ($row = oci_fetch_array($statement)) {
				$result = $row;
			}
			
			if($result != null){
			foreach($result as $key => $value){
				if(is_int($key)){
					unset($result[$key]);
				}
			}
			}
			Connection::closeConnection();
			
			return $result;
		}
		
		public static function getUserCoord($username){
			$connection = Connection::getConnection();
			
			$query = "SELECT * FROM P_COORDONNEES WHERE NOCOORD = :pUsername";

			$statement = oci_parse($connection, $query);

			oci_bind_by_name($statement, ":pUsername", $username);
			
			oci_execute($statement);
			
			$result = null;
			
			if ($row = oci_fetch_array($statement, OCI_ASSOC)) {
				$result = $row;
			}
			
			Connection::closeConnection();
			
			return $result;
		}
		
		public static function getUsers(){
			$connection = Connection::getConnection();
			
			$query = "SELECT NOAUDITEUR, CODEAUDITEUR, NOM, PRENOM FROM P_AUDITEUR ORDER BY NOAUDITEUR";

			$statement = oci_parse($connection, $query);
			
			oci_execute($statement);
			
			$result = array();
			
			while (($row = oci_fetch_array($statement, OCI_ASSOC))) {
				array_push($result, $row);
			}
			
			Connection::closeConnection();
			
			return $result;
		}
		
		public static function updateJuge($username, $judgement) {
			$connection = Connection::getConnection();
			
			$query = "UPDATE P_AUDITEUR SET JUGE = TO_DATE(:juge_bv, 'DDMMYYYY') WHERE CODEAUDITEUR = :pUsername";

			$statement = oci_parse($connection, $query);
			
			if($judgement){
				$juge = date("dmY");
			}
			else{
				$juge = null;
			}
			
			oci_bind_by_name($statement, ":pUsername", $username);
			oci_bind_by_name($statement, ":juge_bv", $juge);
			
			if(oci_execute($statement)){
				$result = true;
			}
			else{
				$result = false;
			}
			
			
			Connection::closeConnection();
			
			return $result;
		}
		
		public static function updateCandidatJuge($username, $judgement) {
			$connection = Connection::getConnection();
			
			$query = "UPDATE P_AUDITEUR SET CANDIDATJUGE = TO_DATE(:juge_bv, 'DDMMYYYY') WHERE CODEAUDITEUR = :pUsername";

			$statement = oci_parse($connection, $query);
			
			if($judgement){
				$juge = date("dmY");
			}
			else{
				$juge = null;
			}
			//var_dump($juge);
			
			oci_bind_by_name($statement, ":pUsername", $username);
			oci_bind_by_name($statement, ":juge_bv", $juge);
			
			if(oci_execute($statement)){
				$result = true;
			}
			else{
				$result = false;
			}
			
			
			Connection::closeConnection();
			
			return $result;
		}
		
		public static function getAteliersSortedTitre($username){
			$connection = Connection::getConnection();
			
			$query = "SELECT * FROM P_ATELIER WHERE TITRE LIKE :pUsername";
			
			$statement = oci_parse($connection, $query);
			
			$var = "%" . $username . "%";
			oci_bind_by_name($statement, ":pUsername", $var);
			
			oci_execute($statement);
			
			$result = array();
			
			while (($row = oci_fetch_array($statement, OCI_ASSOC))) {
				array_push($result, $row);
			}
			
			Connection::closeConnection();
			
			return $result;
		}
		
		public static function getAteliersSortedDate($date){
			$connection = Connection::getConnection();
			
			$query = "SELECT * FROM P_ATELIER WHERE DATEATEL = TO_DATE(:pDate , 'YYMMDD')";
			
			$statement = oci_parse($connection, $query);
			
			$var = $date;
			oci_bind_by_name($statement, ":pDate", $var);
			
			oci_execute($statement);
			
			$result = array();
			
			while (($row = oci_fetch_array($statement, OCI_ASSOC))) {
				array_push($result, $row);
			}
			
			Connection::closeConnection();
			
			return $result;
		}
		
		public static function getAteliersSortedLangue($langue){
			$connection = Connection::getConnection();
			
			$query = "SELECT * FROM P_ATELIER WHERE LANGUE = :pDate";
			
			$statement = oci_parse($connection, $query);
			
			$var = $langue;
			oci_bind_by_name($statement, ":pDate", $var);
			
			oci_execute($statement);
			
			$result = array();
			
			while (($row = oci_fetch_array($statement, OCI_ASSOC))) {
				array_push($result, $row);
			}
			
			Connection::closeConnection();
			
			return $result;
		}
		
		public static function getAteliersAll(){
			$connection = Connection::getConnection();
			
			$query = "SELECT * FROM P_ATELIER";

			$statement = oci_parse($connection, $query);
			
			oci_execute($statement);
			
			$result = array();
			
			while (($row = oci_fetch_array($statement, OCI_ASSOC))) {
				array_push($result, $row);
			}
			
			Connection::closeConnection();
			
			return $result;
		}
		
		
		public static function newInscription($noaudit, $noatel) {
			$connection = Connection::getConnection();
			
			$query = "INSERT INTO p_inscription (NOAUDITEUR, NOATEL, DATEINSCRIPTION) VALUES(:id_bv, :text_bv, TO_DATE(:candidatjuge_bv, 'DDMMYYYY'))";

			$statement = oci_parse($connection, $query);
			
			//$juge = date("dmY");
			//echo $juge;
			$candidatjuge = date("dmY");
			
			oci_bind_by_name($statement, ":id_bv", $noaudit);
			oci_bind_by_name($statement, ":text_bv", $noatel);
			//oci_bind_by_name($statement, ":pass_bv", $motdepasse);
			//oci_bind_by_name($statement, ":nom_bv", $nom);
			//oci_bind_by_name($statement, ":prenom_bv", $prenom);
			//oci_bind_by_name($statement, ":nocoord_bv", $nocoord);
			//oci_bind_by_name($statement, ":juge_bv", $juge);
			//oci_bind_by_name($statement, ":statut_bv", $statut);
			oci_bind_by_name($statement, ":candidatjuge_bv", $candidatjuge);
			
			if(oci_execute($statement)){
				$result = true;
			}
			else{
				$result = false;
			}
			
			
			Connection::closeConnection();
			
			return $result;
			
		}
		
		public static function getInscriptionsAll($username){
			$connection = Connection::getConnection();
			
			$query = "SELECT * FROM P_INSCRIPTION WHERE NOAUDITEUR = :pUsername";

			$statement = oci_parse($connection, $query);

			oci_bind_by_name($statement, ":pUsername", $username);
			
			oci_execute($statement);
			
			$result = array();
			
			while (($row = oci_fetch_array($statement, OCI_ASSOC))) {
				array_push($result, $row);
			}
			/*
			if($result != null){
			foreach($result as $key => $value){
				if(is_int($key)){
					unset($result[$key]);
				}
			}
			}
			*/
			Connection::closeConnection();
			
			return $result;
		}
		
		public static function deleteInscription($noauditeur, $noatel){
			$connection = Connection::getConnection();
			
			$query = "DELETE FROM P_INSCRIPTION WHERE NOAUDITEUR = :pUser AND NOATEL = :pAtel";

			$statement = oci_parse($connection, $query);

			oci_bind_by_name($statement, ":pUser", $noauditeur);
			oci_bind_by_name($statement, ":pAtel", $noatel);
			
			if(oci_execute($statement)){
				$result = true;
			}
			else{
				$result = false;
			}
			
			
			Connection::closeConnection();
			
			return $result;
		}
		
		public static function getRegions(){
		
			$connection = Connection::getConnection();
			
			$query = "SELECT * FROM p_region";

			$statement = oci_parse($connection, $query);
			
			oci_execute($statement);
			
			$result = array();
			
			while (($row = oci_fetch_array($statement, OCI_ASSOC))) {
				array_push($result, $row);
			}
			/*
			foreach($result as $key => $value){
				if(is_int($key)){
					unset($result[$key]);
				}
			}
			*/
			Connection::closeConnection();
			
			//var_dump($result);
			
			return $result;
		
		}
		
		public static function getCriteres(){
			$connection = Connection::getConnection();
			
			$query = "SELECT * FROM P_CRITERE";

			$statement = oci_parse($connection, $query);
			
			oci_execute($statement);
			
			$result = array();
			
			while (($row = oci_fetch_array($statement, OCI_ASSOC))) {
				array_push($result, $row);
			}
			
			Connection::closeConnection();
			
			return $result;
		}
		
			public static function newEvaluation($noauditeur, $noatel, $critere, $cote) {
			$connection = Connection::getConnection();
			
			$query = "INSERT INTO p_evaluation (NOAUDITEUR, NOATEL, NOCRITERE, COTE) VALUES(:id_bv, :text_bv, :critere_bv, :cote_bv)";

			$statement = oci_parse($connection, $query);
			
			oci_bind_by_name($statement, ":id_bv", $noauditeur);
			oci_bind_by_name($statement, ":text_bv", $noatel);
			oci_bind_by_name($statement, ":critere_bv", $critere);
			oci_bind_by_name($statement, ":cote_bv", $cote);
			
			
			if(oci_execute($statement)){
				$result = true;
			}
			else{
				$result = false;
			}
			
			
			Connection::closeConnection();
			
			return $result;
			
		}
		
	public static function updateEvaluation($noauditeur, $noatel, $critere, $cote) {
			$connection = Connection::getConnection();
			
			$query = "UPDATE p_evaluation SET COTE = :cote_bv WHERE NOAUDITEUR = :id_bv AND NOATEL = :text_bv AND NOCRITERE = :critere_bv";

			$statement = oci_parse($connection, $query);
			
			oci_bind_by_name($statement, ":id_bv", $noauditeur);
			oci_bind_by_name($statement, ":text_bv", $noatel);
			oci_bind_by_name($statement, ":critere_bv", $critere);
			oci_bind_by_name($statement, ":cote_bv", $cote);
			
			
			if(oci_execute($statement)){
				$result = true;
			}
			else{
				$result = false;
			}
			
			
			Connection::closeConnection();
			
			return $result;
			
		}
		
		public static function getCritereSpecific($auditeur, $atelier, $nocritere){
			$connection = Connection::getConnection();
			
			$query = "SELECT * FROM P_EVALUATION WHERE NOAUDITEUR = :pUsername AND NOATEL = :pAtel AND NOCRITERE = :pCritere";

			$statement = oci_parse($connection, $query);

			oci_bind_by_name($statement, ":pUsername", $auditeur);
			oci_bind_by_name($statement, ":pAtel", $atelier);
			oci_bind_by_name($statement, ":pCritere", $nocritere);
			oci_execute($statement);
			
			$result = array();
			
			while (($row = oci_fetch_array($statement, OCI_ASSOC))) {
				array_push($result, $row);
			}
			
			Connection::closeConnection();
			
			if(count($result) > 0){
				return $result;
			}
			else{
				return null;
			}
		}
		
	public static function getLastEval($auditeur, $atelier){
			$connection = Connection::getConnection();
			
			$query = "SELECT * FROM P_EVALUATION WHERE NOAUDITEUR = :pUsername AND NOATEL = :pAtel";

			$statement = oci_parse($connection, $query);

			oci_bind_by_name($statement, ":pUsername", $auditeur);
			oci_bind_by_name($statement, ":pAtel", $atelier);
			
			oci_execute($statement);
			
			$result = array();
			
			while (($row = oci_fetch_array($statement, OCI_ASSOC))) {
				array_push($result, $row);
			}
			
			Connection::closeConnection();
			
			return $result;
		}
		
	public static function getTableAdminJuge(){
			$connection = Connection::getConnection();
			
			$query = "SELECT NOAUDITEUR, CODEAUDITEUR, NOM, PRENOM, JUGE, CANDIDATJUGE FROM P_AUDITEUR ORDER BY NOAUDITEUR";

			$statement = oci_parse($connection, $query);
			
			oci_execute($statement);
			
			$result = array();
			
			while (($row = oci_fetch_array($statement, OCI_ASSOC))) {
				array_push($result, $row);
			}
			
			Connection::closeConnection();
			
			return $result;
		}
		
	public static function removeEval($auditeur){
			$connection = Connection::getConnection();
			
			$query = "DELETE FROM P_EVALUATION WHERE NOAUDITEUR = :pUsername";

			$statement = oci_parse($connection, $query);

			oci_bind_by_name($statement, ":pUsername", $auditeur);
			
			if(oci_execute($statement)){
				$result = true;
			}
			else{
				$result = false;
			}
			
			Connection::closeConnection();
			
			return $result;
			
		}
		
	public static function createEval($auditeur, $atelier, $nocritere){
			$connection = Connection::getConnection();
			
			$query = "SELECT * FROM P_EVALUATION WHERE NOAUDITEUR = :pUsername AND NOATEL = :pAtel AND NOCRITERE = :pCritere";

			$statement = oci_parse($connection, $query);

			oci_bind_by_name($statement, ":pUsername", $auditeur);
			oci_bind_by_name($statement, ":pAtel", $atelier);
			oci_bind_by_name($statement, ":pCritere", $nocritere);
			oci_execute($statement);
			
			$result = array();
			
			while (($row = oci_fetch_array($statement, OCI_ASSOC))) {
				array_push($result, $row);
			}
			
			Connection::closeConnection();
			
			if(count($result) > 0){
				return $result;
			}
			else{
				return null;
			}
		}
		
		public static function getStats($nocritere){
			$connection = Connection::getConnection();
			
			$query = "SELECT AVG(COTE) FROM P_EVALUATION WHERE NOCRITERE = :pCritere";

			$statement = oci_parse($connection, $query);

			oci_bind_by_name($statement, ":pCritere", $nocritere);
			oci_execute($statement);
			
			$result = array();
			
			while (($row = oci_fetch_array($statement, OCI_ASSOC))) {
				array_push($result, $row);
			}
			
			Connection::closeConnection();
			
			if(count($result) > 0){
				return $result;
			}
			else{
				return null;
			}
		}
		
		public static function getStatsAtel($noatel){
			$connection = Connection::getConnection();
			
			$query = "SELECT AVG(COTE) FROM P_EVALUATION WHERE NOATEL = :pAtel";

			$statement = oci_parse($connection, $query);

			oci_bind_by_name($statement, ":pAtel", $noatel);
			oci_execute($statement);
			
			$result = array();
			
			while (($row = oci_fetch_array($statement, OCI_ASSOC))) {
				array_push($result, $row);
			}
			
			Connection::closeConnection();
			
			if(count($result) > 0){
				return $result;
			}
			else{
				return null;
			}
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	




