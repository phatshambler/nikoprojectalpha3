<?php
	require_once("PHP/userAct.php");
	
	$action = new UserAction();
	$action->execute();

	require_once("PHP/header.php");
?>
<div class="square">
<p class="bold">OPTIONS</p>
</div>

		<?php
			if ($action->errorCode != null && $action->errorCode === 104) {
		?>
				<div class="square" style='color:lime'>
					Merci d'avoir envoy� votre jeu!
				</div>
				<?php
			}
		?>

<?php if($_SESSION["user_visibility"] == 2 || $_SESSION["user_visibility"] == 4){ ?>

<div class="square">
<p class="bold">AJOUTER UN JEU</p>
<p class="spaced logged">Remplir tous les champs pour ajouter un jeu:</p>
<p></p>
<p class="spaced oranged">Usager: <?php echo $_SESSION["username"]; ?></p>
<p class="spaced oranged">Courriel: 
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
					Erreur dans l'entr�e des donn�es/fichiers, veuillez reccomencer.
				</div>
				<?php
			}
		?>
		
		<?php
			if ($action->errorCode != null && $action->errorCode === 105) {
		?>
				<div style='color:red'>
					Le fichier image est introuvable.
				</div>
				<?php
			}
		?>
		
		<?php
			if ($action->errorCode != null && $action->errorCode === 106) {
		?>
				<div style='color:red'>
					Erreur avec le fichier image.
				</div>
				<?php
			}
		?>
		
		<?php
			if ($action->errorCode != null && $action->errorCode === 107) {
		?>
				<div style='color:red'>
					Le fichier zip est introuvable/invalide.
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
				Image de r�f�rence (jpg, gif, png):
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
				Fichiers (sous format zip):
			</label>
			<input class="niceField" type="file" name="fichier" id="fichiersid" />
		</div>
		
		<input class="niceButton" name="sender" style="color:yellow" type="submit" value="Envoyer votre jeu" />
		
	</form>


</div>

<?php }?>

<?php if($_SESSION["user_visibility"] == 3 || $_SESSION["user_visibility"] == 4){ ?>
<div class="square">
<p class="bold">JEUX PR�SENTS</p>
	
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
		<input class="niceButton" style="color:yellow" type="submit" name="removegame" value="Enlever le jeu s�lectionn�" />
	</form>

<?php 
	}
}
?>
</div>
<?php if($_SESSION["user_visibility"] == 3 || $_SESSION["user_visibility"] == 4){ ?>
<div class="square">
<p class="bold">LISTE DES UTILISATEURS</p>
	
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
		<input class="niceButton" style="color:yellow" type="submit" name="removeuser" value="Enlever l'utilisateur s�lectionn�" />
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