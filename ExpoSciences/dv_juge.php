<?php
	require_once("PHP/dv_jugeAct.php");
	
	$action = new DvjugeAction();
	$action->execute();

	require_once("PHP/header.php");
?>

<div class="square">
	<?php if(isset($action->juge) && $action->juge != null &&  $action->juge != ""){
	
	?>
	<form action="dv_juge.php" method="post">
	<p>Assignation en tant que juge en date du: <?php echo $action->juge ;?> </p>
		<input class="niceButton" name="annulercandidature" type="submit" value="Annuler ma candidature" />
	</form>
	
	<?php
	}else{
	?>
	<form action="dv_juge.php" method="post">
	<p>M'assigner comme juge à partir de maintenant: </p>
		<input class="niceButton" name="candidature" type="submit" value="Nouvelle candidature" />
	</form>
	
	
	
	<?php
	}
	?>
	
	<?php if(isset($action->candidatjuge) && $action->candidatjuge != null &&  $action->candidatjuge != ""){
	
	?>
	<form action="dv_juge.php" method="post">
	<p>Votre demande en traitement en date du: <?php echo $action->candidatjuge ;?> </p>
		<input class="niceButton" name="annulerdemande" type="submit" value="Annuler ma demande" />
	</form>
	
	<?php
	}else{
	?>
	<form action="dv_juge.php" method="post">
	<p>Envoyer une demande de candidature pour traitement </p>
		<input class="niceButton" name="demande" type="submit" value="Envoyer ma demande" />
	</form>
	
	<?php
	}
	?>
	
</div>


<div class="square">
<a href="index.php">Retour</a>
</div>
<?php
	require_once("PHP/footer.php");
?>