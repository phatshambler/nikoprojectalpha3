<?php


	class Connection {
		private static $connection;
		
	
		public static function getConnection() {
			if (Connection::$connection == null) {
				Connection::$connection = oci_new_connect(DB_USER, DB_PASS, DB_ALIAS);
			}
		
			return Connection::$connection;
		}
	
		public static function closeConnection() {
			if (Connection::$connection != null) {
				oci_close(Connection::$connection);
				Connection::$connection = null;
			}
		}
	}


	
	
	
	
	
	
	
	
	





