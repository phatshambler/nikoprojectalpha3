<?php

	class UserDAO {
	
		
		public static function authenticate($username, $password) {
			$connection = Connection::getConnection();
			
			$query = "SELECT FIRST_NAME, VISIBILITY FROM USERS WHERE USERNAME = :pUsername AND PASSWORD = :pPassword";

			$statement = oci_parse($connection, $query);

			$password = sha1($password);
			
			oci_bind_by_name($statement, ":pUsername", $username);
			oci_bind_by_name($statement, ":pPassword", $password);
			
			oci_execute($statement);
			
			$result = null;
			
			if ($row = oci_fetch_array($statement)) {
				$result = $row;
			}
			
			return $result;
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	




