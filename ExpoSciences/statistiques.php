<?php
	require_once("PHP/stats_adminAct.php");
	
	$action = new StatsAdminAction();
	$action->execute();
	
	require_once("PHP/header.php");
?>
<div class="clear"></div>

<div class="square">
<p class="xbold">Statistiques</p>

<?php foreach($action->content as $key => $value){ 
	foreach($value as $key2 => $value2){
	?>
<p class="bold">Moyenne des cotes du critère <?php echo $action->criteres[$key]["NOMCRITERE"] . " : " . $value2["AVG(COTE)"];?></p>

<?php } 
	}?>

</div>

<div class="clear"></div>

<div class="square">
<p class="xbold">Statistiques par atelier</p>

<?php foreach($action->contentAtel as $key => $value){ 
	foreach($value as $key2 => $value2){
	?>
<p class="bold">Moyenne des cotes de l'atelier <?php echo $action->ateliers[$key]["TITRE"] . " : " . $value2["AVG(COTE)"];?></p>

<?php } 
	}?>
	
</div>

<div class="clear"></div>

<div class="square">
<a href="index.php">Retour</a>
</div>

<?php
	require_once("PHP/footer.php");
?>