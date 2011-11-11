<?php
	require_once("action/LoginAction.php");
	
	$action = new LoginAction();
	$action->execute();
	
	require_once("partial/header.php");
?>

	<form action="login.php" method="post">
		
		<?php
			if ($action->errorCode != null && $action->errorCode === 101) {
				?>
				<div style="color:red">
					Erreur d'authentification
				</div>
				<?php
			}
		?>
		
		<div>
			<label for="username">
				Nom d'usager : 
			</label>
			<input type="text" name="username" id="username" />
		</div>

		<div>
			<label for="password">
				Mot de passe : 
			</label>
			<input type="password" name="pwd" id="password" />
		</div>
		
		<input type="submit" value="Connexion" />
	</form>
<?php
	require_once("partial/footer.php");
?>