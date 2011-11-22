<?php
	require_once("PHP/indexAct.php");
	
	$action = new IndexAction();
	$action->execute();

	require_once("PHP/header.php");
?>

		<div id="top" class="square">
        <p id="username" class="logged">Bienvenue, 
		
		<?php if(isset($_SESSION["username"])){
			echo $_SESSION["username"];
		}
		else{
			echo "inconnu!";
		}
		
		
		?>
		
		</p>
		
		<p id="administrator" class="logged">
		<?php if(isset($_SESSION["administrator"]) && $_SESSION["administrator"] === true){
			echo "(Statut: Administrateur)";
		}
		else{
			echo "(Statut: Usager Régulier)";
		}
		
		
		?>
		
		</p>
		
		<?php if(!isset($_SESSION["username"])){
		?>
        <p>Connectez-vous:</p>
		<form action="index.php" method="post">
		
		
		<?php
			if ($action->errorCode != null && $action->errorCode === 101) {
		?>
				<div style='color:red'>
					Erreur d'authentification
					<script type="text/javascript">
					alert("Erreur d'authentification: codeauditeur et/ou motdepasse incorrect(s).");
					</script>
				</div>
				<?php
			}
		?>
		
		<div class="spaced">
			<label for="username">
				Nom d'usager : 
			</label>
			<input class="niceField" type="text" name="username" id="username" />
		</div>

		<div class="spaced">
			<label for="password">
				Mot de passe : 
			</label>
			<input class="niceField" type="password" name="pwd" id="password" />
		</div>
		
		<input class="niceButton" style="color:yellow" type="submit" value="Connexion" />
		
	</form>
			
		<p><a href="register.php">S'enregistrer</a></p>
		
		
		<?php
		}else{
		?>
		

		<form action="index.php?action=logout" method="post">
			<input class="niceButton" style="color:yellow" type="submit" value="Déconnexion" />
		</form>
		
		<?php } ?>
		
		
		<?php if(isset($_SESSION["username"])){
		
		?>
		<div class="square">
			<p><a href="ch_motdepasse.php">Changer mot de passe</a></p>
			<p><a href="ch_informations.php">Changer informations nominales</a></p>
			<p><a href="in_ateliers.php">Inscription aux ateliers</a></p>
			<p><a href="ev_ateliers.php">Évaluation des ateliers</a></p>
			<p><a href="dv_juge.php">Devenir juge</a></p>
			<?php
		}
		?>
        </div>
        <?php if(isset($_SESSION["administrator"]) && $_SESSION["administrator"] === true){
        ?>
        <div class="square">
        <p class="bold">Options Administrateur</p>
        	<p><a href="atel_admin.php">Modifier les évaluations des auditeurs</a></p>
        	<p><a href="juge_admin.php">Modifier le statut juge des auditeurs</a></p>
        	<p><a href="notes_admin.php">Statistiques des notes</a></p>
        </div>
        <?php }?>
<?php
	require_once("PHP/footer.php");
?>