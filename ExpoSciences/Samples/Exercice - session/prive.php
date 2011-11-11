<?php
	session_start();
	
	if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] === true) {
		
	}
	else {
		header("Location:index.php?msg-erreur=10001");
		exit();
	}
?>

Ceci est privé: mon numéro d'assurance sociale est : 55555555


