<?php
	require_once("PHP/registerAct.php");
	
	$action = new RegisterAction();
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
			if ($action->errorCode != null && $action->errorCode === 103) {
		?>
				<div style='color:lime'>
					SUCCÈS
				</div>
				<?php
			}
		?>
		
		<?php
			if ($action->errorCode != null && $action->errorCode === 104) {
		?>
				<div style='color:red'>
					Ce codeauditeur existe déja.
				</div>
				<?php
			}
		?>
		
		
		<?php if(!isset($_SESSION["username"])){
		
		
		$v = UserDAO::getTableDesc('p_auditeur');
		
		?>
        <p>Entrez les champs nécéssaires:</p>
		<form action="register.php" method="post">
		
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
			
			<input class="niceField" type="text" name="<?php echo $key?>" id="<?php echo $key?>" 
			
			<?php
			if($key === "NOCOORD" || $key === "NOAUDITEUR"){
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
				<select class="niceField" name="<?php echo $key?>" >
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
			
			
			<input class="niceField" type="text" name="<?php echo $key?>" id="<?php echo $key?>" 
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
		
		
		<input class="niceButton" style="color:yellow" type="submit" value="Enregistrer" />
		
	</form>

<div class="square">
<a href="register.php">Réinitialiser</a>
</div>	
	
<div class="square">
<a href="index.php">Annuler - Retour</a>
</div>	

<?php
	require_once("PHP/footer.php");
?>