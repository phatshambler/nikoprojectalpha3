<?php
	require_once("PHP/registerAct.php");
	
	$action = new RegisterAction();
	$action->execute();

	require_once("PHP/header.php");
?>

		<div id="top" class="square"><p class="bold">ENREGISTERMENT</p>
        <p class="bold">Bienvenue sur notre plateforme!</p>
		
        <p>Entrez vos informations personelles:</p>
		<form action="register.php" method="post">
		
		
		<?php
			if ($action->errorCode != null && $action->errorCode === 102) {
		?>
				<div style='color:red'>
					Erreur dans l'entr�e des donn�es, veuillez reccomencer...
				</div>
				<?php
			}
		?>
		
		<?php
			if ($action->errorCode != null && $action->errorCode === 103) {
		?>
				<div style='color:red'>
					Cet usager existe d�ja.
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
		
		<div class="spaced">
			<label for="createur">
				 Envoyer du contenu?
			</label>
			<input class="niceField" id="createur" type="radio" name="createur" value="oui" /> Oui
			<input class="niceField" id="createur" type="radio" name="createur" value="non" /> Non
			
		</div>
		
		<div class="spaced">
			<label for="admin">
				 Administrateur?
			</label>
			<input class="niceField" id="admin" type="radio" name="admin" value="oui" /> Oui
			<input class="niceField" id="admin" type="radio" name="admin" value="non" /> Non
			
		</div>
		
		<input class="niceButton" type="submit" value="Envoyer" />
		
	</form>
			
		
		
        
		
        </div>
        
        <div class="square"><p class="bold">NAVIGATION</p> <p><a href="index.php">Retour</a></p></div>

        </div>
<?php
	require_once("PHP/footer.php");
?>