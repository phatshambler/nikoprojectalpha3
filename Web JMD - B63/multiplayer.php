<?php
	require_once("PHP/multiplayerAct.php");
	
	$action = new MultiplayerAction();
	$action->execute();

	require_once("PHP/header.php");
?>
			
<?php if(isset($_SESSION["status"])){
	echo "<p class='bold'>" . $_SESSION["status"] . "</p>";
}
?>
<div class="square">

<p class="bold">Liste des jeux disponibles</p>

<?php if(!$action->testInListe()){ ?>

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
	$test = $action->testLocked($value["NOMJOUEUR"]);
	
	if($test){
		echo "<p class='bold' style='color:lime'>Joueur:"  . $value["NOMJOUEUR"];
		echo " --- JOUEUR EN ATTENTE</p>";
	}
	else{
		echo "<p class='bold' style='color:red'>Joueur:"  . $value["NOMJOUEUR"] . "</p>";
	}
?>

<?php
}
?>

<form action="multiplayer.php" method="post">
	<input name="delete" class="niceButton" style="font-size: 14px; color:lime" type="submit" value="Enlever tous les joueurs" />
</form>

<?php if($_SESSION["status"] >= MultiplayerAction::$STATUS_WAITING){ ?>

<div></div>

<form action="multiplayer.php" method="post">
	<input name="reload" class="niceButton" style="font-size: 14px; color:lime" type="submit" value="Rafraichir" />
</form>

<div></div>

<form action="multiplayer.php" method="post">
	<input name="deleteme" class="niceButton" style="font-size: 14px; color:lime" type="submit" value="M'enlever de la liste" />
</form>

<div></div>

<form action="multiplayer.php" method="post">
	<input name="lock" class="niceButton" style="font-size: 14px; color:lime" type="submit" value="Synchroniser et démarrer" />
</form>

<div></div>





<!--
<form action="as_multiplayer/nr_jeu.php" method="post">
	<input name="demarrer" class="niceButton" style="font-size: 14px; color:lime" type="submit" value="Démarrer la partie" />
</form>
-->



<?php }?>

</div>

<?php if($_SESSION["status"] == MultiplayerAction::$STATUS_LOCKED){ ?>

<div class="square">
<p class="bold">

<?php 
echo "En attente des autres utilisateurs";
$action->start();
?>

</p>
</div>

<?php } ?>

<?php if($action->isExiting){ ?>

<div class="square">
<p class="bold">
FIN DU JEU
</p>

<p>
<?php foreach ($action->finalScores as $value){

foreach ($value as $key => $x){

echo "<p style='color:orange; font-weight:bold'>" . $key . ":  " . $x . "</p>";

}
echo "<p style='color:orange; font-weight:bold'> --- </p>";
}
?>
</p>
</div>

<?php }

$action->finalScores = null; 
?>


<div class="square">
<p class="bold">
HI-SCORES
</p>
<?php 

$number = 1;

foreach ($action->hiScores as $value){

echo "<p style='color:orange; font-weight:bold'>";
echo $number . "-";

foreach ($value as $key => $x){

if($number < 11){
  echo $key . ":  " . $x . ":::";
}

}
echo "</p>";
$number++;
//echo "<p style='color:orange; font-weight:bold'> --- </p>";
}
?>
</div>



<div class="square"><p class="bold">NAVIGATION</p> <p><a href="index.php">Retour</a></p></div>
</div>
<?php
	require_once("PHP/footer.php");
?>