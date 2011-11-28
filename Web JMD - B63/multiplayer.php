<?php
	require_once("PHP/multiplayerAct.php");
	
	$action = new MultiplayerAction();
	$action->execute();

	require_once("PHP/header.php");
?>
			


<div class="square">

<p class="bold">Liste des jeux disponibles</p>

<?php if($_SESSION["status"] == MultiplayerAction::$STATUS_OFF){ ?>

<p class="logged">Enregistrez-vous</p>

<form action="multiplayer.php" method="post">
	<input name="newmulti" class="niceButton" style="font-size: 16px" type="submit" value="Awesome Shooter" />
	<p> version 2, multiplayer </p>
</form>
<?php
}
?>

</div>

<div class="clear"></div>

<div class="square">

<p class="bold">Liste des Joueurs</p>
<p class="logged">Joueurs inscrits: Awesome Shooter</p>
<p></p>
<?php
foreach($action->liste_users as $value){
	echo "<p class='bold' style='color:green'>Joueur:"  . $value["NOMJOUEUR"] . "</p>";

?>

<?php
}
?>


<?php if($_SESSION["status"] == MultiplayerAction::$STATUS_WAITING){ ?>

<form action="multiplayer.php" method="post">
	<input name="delete" class="niceButton" style="font-size: 14px" type="submit" value="Enlever tous les joueurs" />
</form>

<form action="multiplayer.php" method="post">
	<input name="demarrer" class="niceButton" style="font-size: 14px" type="submit" value="Démarrer la partie" />
</form>




<?php }?>

</div>
<?php
	require_once("PHP/footer.php");
?>