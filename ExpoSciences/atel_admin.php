<?php
	require_once("PHP/atel_adminAct.php");
	
	$action = new AtelAdminAction();
	$action->execute();

	require_once("PHP/header.php");
?>


<div class="clear"></div>

<?php if(isset($_SESSION["administrator"]) && $_SESSION["administrator"] === true){
			
?>
		<p>hello</p>

			<?php
		}
?>


<div class="clear"></div>

<div class="square">
<a href="index.php">Annuler - Retour</a>
</div>	

<?php
	require_once("PHP/footer.php");
?>