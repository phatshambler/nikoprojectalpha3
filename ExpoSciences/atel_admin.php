<?php
	require_once("PHP/atel_adminAct.php");
	
	$action = new AtelAdminAction();
	$action->execute();

	require_once("PHP/header.php");
?>


<div class="clear"></div>

<?php if(isset($_SESSION["administrator"]) && $_SESSION["administrator"] === true){
			
?>
<<<<<<< HEAD
		<p class="bold">Choissisez un utilisateur � modifier:</p>
		
		<?php
			foreach($action->contentUsers as $value){
			
			?> 
			<div class="square"><p class="bold"> 
				<?php
				foreach($value as $key => $data){
				
				?>
					 <?php echo $key . ": " . $data . ". ";?>
				<?php
				
				}
				?>
			</p></div>
			<?php
			}
		
		?>
		
=======
		<p>hello</p>

>>>>>>> d7d80d335103df9ade994bec2d53bba96f03005e
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