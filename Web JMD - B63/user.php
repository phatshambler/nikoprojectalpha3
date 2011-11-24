<?php
	require_once("PHP/userAct.php");
	
	$action = new UserAction();
	$action->execute();

	require_once("PHP/header.php");
?>
<div class="square">
<p class="bold">OPTIONS</p>
</div>

<?php if($_SESSION["user_visibility"] == 2 || $_SESSION["user_visibility"] == 4){ ?>

<div class="square">
<p class="bold">AJOUTER UN JEU</p>
<p class="logged">Remplir tous les champs pour ajouter un jeu:</p>
<p></p>
<p>Usager: <?php echo $_SESSION["username"]; ?></p>
<p>Courriel: 
<?php 
	$u = UserDAO::getUser($_SESSION["username"]);
	echo $u[2];
?>
</p>
	<form enctype="multipart/form-data" action="user.php" method="post">
		<input type="hidden" name="MAX_FILE_SIZE" value="7097152" />
		<?php
			if ($action->errorCode != null && $action->errorCode === 103) {
		?>
				<div style='color:red'>
					Erreur dans l'entrée des données/fichiers, veuillez reccomencer.
				</div>
				<?php
			}
		?>
		
		<?php
			if ($action->errorCode != null && $action->errorCode === 104) {
		?>
				<div style='color:lime'>
					Merci d'avoir envoyé votre jeu!
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
				Site web du jeu (sans http://): 
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
		
		<input class="niceButton" name="sender" style="color:yellow" type="submit" value="Envoyer votre jeu" />
		
	</form>


</div>

<?php }?>

<?php if($_SESSION["user_visibility"] == 3 || $_SESSION["user_visibility"] == 4){ ?>
<div class="square">
<p class="bold">JEUX PRÉSENTS</p>
	
	<form action="user.php" method="post">
				
	
	<?php
		$liste = UserDAO::loadJSON("games.txt");
		if($liste != ""){
		foreach($liste as $value){
	
		?>
			<input class="niceField" id="createur" type="radio" name="love" value="<?php echo $value[0]; ?>" /> <?php echo $value[0]; ?>
		<?php
	
		}
		?>
		<input class="niceButton" type="submit" name="removegame" value="Enlever le jeu sélectionné" />
	</form>
</div>
<?php 
	}
}
?>

<?php if($_SESSION["user_visibility"] > 1){ ?>
<div class="square">
<p class="bold">Liste des utilisateurs</p>
	
	<form action="user.php" method="post">
				
	
	<?php
		$liste = UserDAO::loadJSON("users.txt");
		if($liste != ""){
		foreach($liste as $value){
	
		?>
			<input class="niceField" id="createur" type="radio" name="love" value="<?php echo $value[0]; ?>" /> <?php echo $value[0]; ?>
		<?php
	
		}
		?>
		<input class="niceButton" type="submit" name="removeuser" value="Enlever l'utilisateur sélectionné" />
	</form>
</div>
<?php 
	}
}
?>


<div class="square"><p class="bold">NAVIGATION</p> <p><a href="index.php">Retour</a></p></div>
</div>
<?php
	require_once("PHP/footer.php");