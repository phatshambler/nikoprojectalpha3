<?php
	require_once("PHP/multiplayerAct.php");
	
	$action = new MultiplayerAction();
	$action->execute();

	require_once("PHP/header.php");
?>
			


<div class="square">

<p class="bold">Liste des Jeux</p>

<form action="multiplayer.php" method="post">
	<input name="newmulti" class="niceButton" style="font-size: 16px" type="submit" value="Awesome Shooter" />
	<p> version 2, multiplayer </p>
</form>

</div>

<div class="clear"></div>

<div class="square">

<p class="bold">Liste des Joueurs</p>

</div>


<?php
	require_once("PHP/footer.php");
?>