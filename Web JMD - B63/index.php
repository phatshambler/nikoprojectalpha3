<?php
	require_once("PHP/indexAct.php");
	
	$action = new IndexAction();
	$action->execute();

	require_once("PHP/header.php");
?>

		<div id="top" class="square"><p class="bold">AWESOME GAME PLATFORM</p>
        <p id="username" class="logged">Bienvenue, 
		
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
		
		<input class="niceButton" style="color:yellow" type="submit" value="Connexion" />
		
	</form>
			
		<p><a href="register.php">S'enregistrer</a></p>
		
		
		<?php
		}else{
		?>
		
		
		<form action="user.php" method="post">
			<input class="niceButton" style="color:yellow" type="submit" value="+++" />
		</form>

		<form action="index.php?action=logout" method="post">
			<input class="niceButton" style="color:yellow" type="submit" value="Déconnexion" />
		</form>
		
		<?php } ?>
		
		
        
		
        </div>
        
        <div id="middle" class="square"><p class="bold">JEUX</p> <p><a href="PROJET - PART1/nr_index.html">Awesome Shooter</a></p></div>

		<div id="bottom" class="square">
		<p class="bold">HI-SCORES/LEADERBOARD</p> 
		
		<?php
			if(isset($_SESSION["username"])){
			$liste = UserDAO::getGames();
			for ($i = 0; $i < count($liste); $i++){ 
		?>
			<div class="scores">

			
			<form action="index.php" method="post">
				<input class="niceButton" type="submit" name="currenthi" value="<?php echo $liste[$i]; ?>" />
			</form>
			
			</div>
			<?php if(isset($_SESSION["menuopen"]) && $_SESSION["menuopen"] === $liste[$i] ){
				
				?> 

				<div class="scores">

			
				<form class="menuscores" action="index.php" method="post">
					<input class="niceButtonTwo" type="submit" name="order" value="Top Scores" />
				</form>

				<form class="menuscores" action="index.php" method="post">
					<input class="niceButtonTwo" type="submit" name="order" value="Mes Scores" />
				</form>

				<form class="menuscores" action="index.php" method="post">
					<input class="niceButtonTwo" type="submit" name="order" value="Derniers" />
				</form>

				<form class="menuscores" action="index.php" method="post">
					<input class="niceButtonTwo" type="submit" name="order" value="7 Jours" />
				</form>

				<form class="menuscores" action="index.php" method="post">
					<input class="niceButtonTwo" type="submit" name="order" value="Mois" />
				</form>

				<form class="menuscores" action="index.php" method="post">
					<input class="niceButtonTwo" type="submit" name="order" value="Annee" />
				</form>
			
				</div>

				<div class="scores">

				<?php
				if(isset($_SESSION["order"])){
					$currentorder = $_SESSION["order"];
				}
				else{
					$currentorder = "Top Scores";
				}

				$scores = UserDAO::loadHiScoresOrdered($_SESSION["menuopen"], $currentorder, $_SESSION["username"]);

				//reset($scores);
				foreach ($scores as $key => $value) {
    			//echo "Key: $key; Value: $value<br />\n";
				

				//for ($j = 0; $j + 1 < count($scores); $j += 2){
				 ?>
				 	<p><?php echo $key;?> : <?php echo $value;?></p>
				 <?php
				}
			?>

			</div>
			<?php if(isset($_SESSION["menuopen"]) && $_SESSION["menuopen"] != "Fermer"){ ?>
			<div class="scores">

			<form action="index.php" method="post">
				<input class="niceButtonTwo" type="submit" name="currenthi" value="Fermer" />
			</form>
			
			</div>

			<?php
			}
		
			}
		}
		
			
		
			
		}
		?>
		
		

        </div>
<?php
	require_once("PHP/footer.php");
?>