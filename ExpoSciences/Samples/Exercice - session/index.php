<?php
	session_start();
	
	$formError = null;
	
	if (isset($_GET["msg-erreur"]) && $_GET["msg-erreur"] == "10001") {
		$formError = "Veuillez vous connecter";
	}
	
	if (isset($_POST["action"]) && $_POST["action"] === "deconnexion") {
		session_unset();
		session_destroy();	
	}
	
	if (isset($_POST["username"]) && $_POST["username"] === "fred" &&
		isset($_POST["pwd"]) && $_POST["pwd"] === "test") {
		
		$_SESSION["loggedIn"] = true;
		$_SESSION["username"] = "Frédéric Thériault";
		
		
	}
	else if (isset($_POST["username"]) && $_POST["username"] !== "fred" ||
		isset($_POST["pwd"]) && $_POST["pwd"] !== "test") {
		
		$formError = "You're just wrong";
		session_unset();
		session_destroy();
	}
?>

<html>
	<head>
	</head>
	<body>
		
		<?php
			if ($formError != null) {
				?>
				<div style="color:red"><?php echo $formError; ?></div>
				<?php
			}
		?>
		
		<?php
			if (isset($_SESSION["username"])) {
				?>
				<form action="index.php" method="post" id="monFormulaire">
					<input type="hidden" name="action" value="deconnexion" />
				</form>
				Bonjour, <?php echo $_SESSION["username"]; ?>
				 [<a href="javascript:void(0)" onclick="document.getElementById('monFormulaire').submit()">Déconnexion</a>]
				 [<a href="prive.php">Solde du compte</a>]
				<?php
			}
			else {
				?>
				<form method="post" action="index.php">
					<input type="text" name="username" />
					<input type="password" name="pwd" />
					<input type="submit" />
				</form>
				<?php
			}
		?>
	</body>
</html>









