<?php
	require_once("PHP/indexAct.php");
	
	$action = new IndexAction();
	$action->execute();

	require_once("PHP/header.php");
?>

		<div id="top" class="square"><p class="bold">AWESOME GAME PLATFORM</p>
        
		<?php
			if ($action->errorCode != null && $action->errorCode === 110) {
		?>
				<div style='color:lime'>
					Votre jeu à été ajouté avec succès!
				</div>
				<?php
			}
		?>
		
		
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
        <div class="clear"></div>
        
		<?php if(isset($_SESSION["username"])){ ?>
		<div class="square">
		<p class="bold"><a href="multiplayer.php">MULTIJOUEUR: Awesome Shooter</a></p>
		
		</div>
		
		<?php } ?>
		
		<div class="clear"></div>
		
		<div id="modegames" class="container">
		<p class="bold">JEUX DES UTILISATEURS</p>
		<?php 
		
		$games = UserDAO::loadJSON("games.txt");
		#var_dump($games);
		if($games != ""){
		
		
		
		foreach($games as $value){
		
		?>
			<div class="squareNoClear">
			<form class="center" action="index.php" method="post">
				<input name="startgame" class="niceButton" style="font-size: 16px" type="submit" value="<?php echo $value[0]; ?>" />
			</form>
			
			<p class="exlink center"><a href="http://<?php echo $value[1];?>" alt="<?php echo $value[1];?>"> http://<?php echo $value[1];?></a></p>
			
			
			<form action="index.php" method="post">
				<input border=0 src="<?php echo $value[2];?>" type=image name="startgame" class="img center" value="<?php echo $value[0]; ?>" />
			</form>
				  
			</div>
		<?php
		
		}
		?>
		
		</div>
		
		<div class="clear"></div>
		
		<div id="bottom" class="square">
		<p class="bold">HI-SCORES/LEADERBOARD</p> 
		
		<?php
			if(isset($_SESSION["username"])){
			$liste = UserDAO::loadJSON("games.txt");
			
			foreach ($liste as $value){ 
		?>
			<div class="scores">

			
			<form action="index.php" method="post">
				<input class="niceButton" type="submit" name="currenthi" value="<?php echo $value[0]; ?>" />
			</form>
			
			</div>
			<?php if(isset($_SESSION["menuopen"]) && $_SESSION["menuopen"] === $value[0] ){
				
				?> 

				<div class="scores">

			
				<form class="menuscores" action="index.php" method="post">
					<input class="niceButtonTwo" type="submit" name="order" value="Top Scores" />
				</form>

				<form class="menuscores" action="index.php" method="post">
					<input class="niceButtonTwo" type="submit" name="order" value="Mes Scores(top)" />
				</form>
				
				<p></p>
				
				<form class="menuscores" action="index.php" method="post">
					<input class="niceButtonTwo" type="submit" name="order" value="Mes Scores(date)" />
				</form>

				<form class="menuscores" action="index.php" method="post">
					<input class="niceButtonTwo" type="submit" name="order" value="Derniers" />
				</form>

				<form class="menuscores" action="index.php" method="post">
					<input class="niceButtonTwo" type="submit" name="order" value="Semaine" />
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
				$max = 0;
				//reset($scores);
				
				foreach ($scores as $key => $value) {
					if(is_array($value)){
						//$value = $value["mday"] . " - " . $value["month"] . " - " . $value["year"];
					}
					$max++;
					if($max > 12){
					break;
					}
				 ?>
				 	<p class="oranged"><?php echo $key;?> : <?php echo $value;?></p>
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
			
		}
		?>
		
		

        </div>
<?php
	require_once("PHP/footer.php");
?>