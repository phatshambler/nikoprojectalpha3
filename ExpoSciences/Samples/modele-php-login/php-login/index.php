<?php
	require_once("partial/header.php");
?>

<form method="post" action="formulaire.php">
	<input type="text" name="username" />
	<input type="password" name="password" />
	<input type="submit" value="Connexion" />
</form>

<?php
	require_once("partial/footer.php");
?>