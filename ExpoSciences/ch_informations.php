<?php
	require_once("PHP/ch_informationsAct.php");
	
	$action = new InformationsAction();
	$action->execute();

	require_once("PHP/header.php");
?>

		<div id="top" class="square">
		
		<?php
			if ($action->errorCode != null && $action->errorCode === 102) {
		?>
				<div style='color:red'>
					Erreur dans l'entrée des données
				</div>
				<?php
			}
		?>
		
		<?php
			if ($action->errorCode != null && $action->errorCode == 103) {
		?>
				<div style='color:lime'>
					Succès! Vos informations ont été modifiées.
				</div>
				<?php
			}
		?>
		
		<?php
			if ($action->errorCode != null && $action->errorCode === 104) {
		?>
				<div style='color:red'>
					Erreur.
				</div>
				<?php
			}
		?>
		
		<div class="spaced">
		<p class="bold"> Vos informations présentement: </p>
		<?php if(isset($_SESSION["username"])){
		foreach ($action->userInfos as $key => $value){
			echo "<p class='float' style='color:grey'> " . "(" . $key . " : " . $value . ")</p>";
		
		}
		foreach ($action->userCoords as $key => $value){
			echo "<p class='float' style='color:grey'> ". "(" . $key . " : " . $value . ")</p>";
		
		}
		?>
		
		</div>
		<div class="clear"></div>
		<p class="float">///////</p>
		<div class="clear"></div>
		<?php
		$v = UserDAO::getTableDesc('p_auditeur');
		
		?>
        <p class="bold">Changez vos informations personnelles(tous les champs seront modifiés):</p>
		<form action="ch_informations.php" method="post">
		
		<?php foreach($v as $key => $value){
			//echo $key; echo " - ";
		?>
			<div class="spaced">
			<label for="<?php echo $key?>">
				<?php echo $key?>
				<?php
				if($key === "JUGE" || $key === "CANDIDATJUGE"){
					echo '(Format: Oui ou Non) ';
				}
				if($key === "STATUT"){
					echo '(Format: E pour étudiant, R pour régulier) ';
				}
				
			
				?>
				
			</label>
			
			<?php
			if($key === "STATUT"){
				?>
				<select class="niceField" name="<?php echo $key?>" >
					
					<option>E</option>
					<option>R</option>
				
				</select>
				<?php
			}else{
			
			?>
			
			<input class="niceField" type="text" name="<?php echo $key?>" id="<?php echo $key?>" value="<?php if(isset($action->userInfos[$key])){ echo $action->userInfos[$key]; } else{ echo "";}?>" 
			
			<?php
			if($key === "NOCOORD" || $key === "NOAUDITEUR" || $key === "JUGE" || $key === "MOTDEPASSE" || $key === "CODEAUDITEUR"){
			echo ' readonly="readonly" style="background-color: grey" ';
			}			
			if($key === "JUGE" || $key === "CANDIDATJUGE"){
			echo ' maxlength=3 ';
			}
			if($key === "STATUT"){
			echo ' maxlength=1 ';
			}
			if($key === "CODEAUDITEUR"){
			echo ' maxlength=7 ';
			}	
			?>
			
			/>
			</div>
			
		<?php
		}
		}
		
		$v = UserDAO::getTableDesc('p_coordonnees');
		
		
		
		foreach($v as $key => $value){
			
		?>
			<div class="spaced">
			<label for="<?php echo $key?>">
				<?php echo $key?>
				<?php
				if($key === "TELEPHONE" || $key === "CELL"){
					echo '(Format: seulement les chiffres) ';
				}
				if($key === "CODE_POSTAL"){
					echo '(Format: 6 lettres et chiffres) ';
				}
				
			
				?>
				
			</label>
			
			<?php
			if($key === "NOREGION"){
				
				$regions = UserDAO::getRegions();
				//var_dump($regions);
				?>  
				<select class="niceField" name="<?php echo $key?>">
					<?php
					for($l = 0; $l < count($regions); $l++){
					//foreach($regions as $key => $value){
					?>
					<option> <?php echo $regions[$l]["NOREGION"] . " - " . $regions[$l]["NOMREGION"]; ?></option>
					<?php
					}
					?>
				
				</select>
				<?php
			}else{
			
			?>
			
			
			<input class="niceField" type="text" name="<?php echo $key?>" id="<?php echo $key?>" value="<?php if(isset($action->userCoords[$key])){ echo $action->userCoords[$key]; } else{ echo "";}?>"" 
			<?php
			if($key === "NOCOORD" || $key === "NOREGION"){
			echo ' readonly="readonly" style="background-color: grey" ';
			}			
			else if($key === "TELEPHONE" || $key === "CELL"){
			echo ' maxlength=10 ';
			}
			else if($key === "CODE_POSTAL"){
			echo ' maxlength=6 ';
			}
			?>
			/>
			</div>
			
		<?php
		}
		
		}
		
		}
		?>
		
		
		<input class="niceButton" style="color:yellow" type="submit" name="update" value="Enregistrer" />
		
	</form>

<div class="square">
<a href="ch_informations.php">Réinitialiser</a>
</div>	
	
<div class="square">
<a href="index.php">Annuler - Retour</a>
</div>	

<?php
	require_once("PHP/footer.php");
?>