<?php
	require_once("action/ProfileAction.php");
	
	$action = new ProfileAction();
	$action->execute();


	require_once("partial/header.php");
?>
	<h4>
		Ceci est une page privée
	</h4>
	<p>
		Sur cette page, vous pourrez modifier votre profil (mot de passe, etc)
	</p>
	
	
<?php
	require_once("partial/footer.php");
?>