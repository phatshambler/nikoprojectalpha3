<?php
	require_once("PHP/atel_adminAct.php");
	
	$action = new AtelAdminAction();
	$action->execute();

	require_once("PHP/header.php");
?>


<div class="clear"></div>

<?php if(isset($_SESSION["administrator"]) && $_SESSION["administrator"] === true){
			
?>
		<p class="bold">Choissisez un utilisateur à modifier:</p>
		<form action="atel_admin.php" method="post">
		<?php
			foreach($action->contentUsers as $keyone => $value){
			
			?> 
			<p class="bold">
			
				<input type="radio" name="usager" value="<?php echo $value["CODEAUDITEUR"]; ?>"> 
			
				<?php
				foreach($value as $key => $data){
				?>
				
						
				
					 <?php echo $key . ": " . $data . ". ";?>
				
				<?php
				
				}
				?>
			</p>
			<?php
			}
			?>
			<input class="niceButton" name="usurpate" type="submit" value="Choisir cet utilisateur" />
			</form>
		


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