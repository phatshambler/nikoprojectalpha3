<?php
	require_once("PHP/registerAct.php");
	
	$action = new RegisterAction();
	$action->execute();

	require_once("PHP/header.php");
?>

		<div id="top" class="square"><p class="bold">ENREGISTERMENT</p>
        <p class="xBold">Bienvenue sur notre plateforme!</p>
		
        <p>Entrez vos informations personelles:</p>
		<form action="register.php" method="post">
		
		
		<?php
			if ($action->errorCode != null && $action->errorCode === 101) {
		?>
				<div style='color:red'>
					Erreur dans l'entrée des données, veuillez reccomencer...
				</div>
				<?php
			}
		?>
		
		<div class="spaced">
			<label for="username">
				Nom d'usager : 
			</label>
			<input class="niceField" type="text" name="newusername" id="username" />
		</div>

		<div class="spaced">
			<label for="password">
				Mot de passe : 
			</label>
			<input class="niceField" type="password" name="newpwd" id="password" />
		</div>
		
		<div class="spaced">
			<label for="courriel">
				Courriel : 
			</label>
			<input class="niceField" type="text" name="courriel" id="courriel" />
		</div>
		
		<input class="niceButton" type="submit" value="Envoyer" />
		
	</form>
			
		
		
        
		
        </div>
        
        <div class="square"><p class="bold">NAVIGATION</p> <p><a href="index.php">Retour</a></p></div>

        </div>
<?php
	require_once("PHP/footer.php");
?>