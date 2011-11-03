<?php
	require_once("PHP/indexAct.php");
	
	$action = new IndexAction();
	$action->execute();

	require_once("PHP/header.php");
?>

		<div id="top" class="square"><p class="bold">AWESOME GAME PLATFORM</p>
        <p id="username">Bienvenue, 
		
		<?php if(isset($_SESSION["username"])){
			echo $_SESSION["username"];
		}
		else{
			echo "inconnu!";
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
		
		<input class="niceButton" type="submit" value="Connexion" />
		
	</form>
			
		<p><a href="register.php">S'enregistrer</a></p>
		
		
		<?php
		}else{
		?>
		
		<form action="index.php?action=logout" method="post">
			<input class="niceButton" type="submit" value="Déconnexion" />
		</form>
		
		<?php } ?>
		
		
        
		
        </div>
        
        <div id="middle" class="square"><p class="bold">JEUX</p> <p><a href="PROJET - PART1/nr_index.html">Awesome Shooter</a></p></div>

		<div id="bottom" class="square"><p class="bold">HI-SCORES/LEADERBOARD</p> <p>Awesome Shooter</p>
        </div>
<?php
	require_once("PHP/footer.php");
?>