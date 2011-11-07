<?php
	require_once("PHP/userAct.php");
	
	$action = new UserAction();
	$action->execute();

	require_once("PHP/header.php");
?>
<div class="square">
<p class="bold">OPTIONS DE CHARGEMENT</p>
</div>

<div class="square">
<p class="logged">Remplir tous les champs pour ajouter un jeu:</p>
<p></p>
<p>Usager: <?php echo $_SESSION["username"] ?></p>
<p>Courriel: <?php echo $_SESSION["username"] ?></p>
		<form enctype="multipart/form-data" action="user.php" method="post">
		<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
		<?php
			if ($action->errorCode != null && $action->errorCode === 103) {
		?>
				<div style='color:red'>
					Erreur dans l'entrée des données/fichiers, veuillez reccomencer.
				</div>
				<?php
			}
		?>
		
		<div class="spaced">
			<label for="gamenameid">
				Nom du Jeu : 
			</label>
			<input class="niceField" type="text" name="gamename" id="gamenameid" />
		</div>

		<div class="spaced">
			<label for="siteid">
				Site du jeu : 
			</label>
			<input class="niceField" type="text" name="site" id="password" />
		</div>
		
		<div class="spaced">
			<label for="imageid">
				Image de référence (jpg, gif, png):
			</label>
			<input class="niceField" type="file" name="image" id="imageid" />
		</div>
		
		<div class="spaced">
			<label for="cheminid">
				Chemin vers le fichier de base (i.e. index.html): 
			</label>
			<input class="niceField" type="text" name="chemin" id="cheminid" />
		</div>
		
		<div class="spaced">
			<label for="fichiersid">
				Fichiers (sous format zip, fichiers à la racine du dossier):
			</label>
			<input class="niceField" type="file" name="fichier" id="fichiersid" />
		</div>
		
		<input class="niceButton" style="color:yellow" type="submit" value="Envoyer votre jeu" />
		
	</form>


</div>

<div class="square"><p class="bold">NAVIGATION</p> <p><a href="index.php">Retour</a></p></div>
</div>
<?php
	require_once("PHP/footer.php");