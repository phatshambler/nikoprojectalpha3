<?php
	require_once("PHP/ch_motdepasseAct.php");
	
	$action = new ChmotdepasseAction();
	$action->execute();

	require_once("PHP/header.php");
?>

<div class="square">
	<form action="ch_motdepasse.php" method="post">
		
		<?php
			if ($action->errorCode != null) {
				?>
				<div style="color:orange">
					<?php echo $action->errorCode ?>
				</div>
				<?php
			}
		?>
		
		<div>
			<label for="ancienpass">
				Ancien Mot de passe : 
			</label>
			<input type="text" name="ancienpass" value='<?php echo $action->password; ?>' id="ancienpass" readonly='readonly' />
		</div>

		<div>
			<label for="password1">
				Nouveau mot de passe : 
			</label>
			<input type="password" name="pwd1" id="password1" />
		</div>
		
		<div>
			<label for="password2">
				Répéter le mot de passe : 
			</label>
			<input type="password" name="pwd2" id="password2" />
		</div>
		
		<input class="niceButton" type="submit" value="Sauvegarder" />
	</form>
</div>

<div class="square">
<a href="index.php">Retour</a>
</div>

<?php
	require_once("PHP/footer.php");
?>