<?php
	require_once("action/HomeAction.php");
	
	$action = new HomeAction();
	$action->execute();


	require_once("partial/header.php");
?>

	<h4>
		Ceci est une page priv�e
	</h4>
	
	<p>
		Bienvenue !
	</p>
	
	Il y a eu exactement <?php echo rand(5,5000) ?> visites depuis votre derni�re connexion.
	
<?php
	require_once("partial/footer.php");
?>