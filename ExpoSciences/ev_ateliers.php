<?php
	require_once("PHP/indexAct.php");
	
	$action = new IndexAction();
	$action->execute();

	require_once("PHP/header.php");
?>

<div class="square">
À remplir phase 3
</div>

<div class="square">
<a href="index.php">Retour</a>
</div>

<?php
	require_once("PHP/footer.php");
?>