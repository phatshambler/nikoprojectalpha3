<?php
	require_once("action/IndexAction.php");
	
	$action = new IndexAction();
	$action->execute();

	require_once("partial/header.php");
?>

	<h3>Fortement recommand� avant les gros cours de programmation Web avanc�e</h3>
	
	<p>
		Depuis 1999 !
	</p>
	
	<p>
	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna.
	</p>
	
	<p>
		Nunc viverra imperdiet enim. Fusce est. Vivamus a tellus.
	</p>
	
	<p>
		Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin pharetra nonummy pede. Mauris et orci.
	</p>

<?php
	require_once("partial/footer.php");
?>