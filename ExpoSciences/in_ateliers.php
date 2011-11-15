<?php
	require_once("PHP/in_ateliersAct.php");
	
	$action = new InateliersAction();
	$action->execute();

	require_once("PHP/header.php");
?>

<div class="square">

<form action="in_ateliers.php" method="post">
		
		<?php
			if ($action->errorCode != null) {
				?>
				<div style="color:orange">
					<?php echo $action->errorCode ?>
				</div>
				<?php
			}
		?>
		<p class="bold">Critères de recherche</p>
		<div>
			<label for="titre">
				Titre de l'atelier : 
			</label>
			<input class="niceField" type="text" name="titre" id="titre" />
		</div>

		<div>
			<label for="date">
				Date(format: jj-MM-YY): 
			</label>
			<input class="niceField" type="text" name="date" id="date" maxlength="8" />
		</div>
		
		<div>
			<label for="langue">
				Langue (F ou A):
			</label>
			<input class="niceField" type="text" name="langue" id="langue" maxlength="1" />
		</div>
		
		<input class="niceButton" name="recherche" type="submit" value="Recherche" />
	</form>
</div>

<div class="square">
<p class="bold">Résultats</p>
<form action="in_ateliers.php" method="post">

	<?php 
	
	if($action->ateliers != null){
			for($i = 0; $i < count($action->ateliers); $i++){
					//echo " -- ";
						?>
						<label for="<?php $i; ?>">
						<?php echo $i; ?>
						</label>
						
						<input type="radio" name="index" value="<?php echo $i; ?>" /> <?php echo $action->ateliers[$i]["TITRE"]; ?><br /> 
						<p>
						<span>Détails: </span>
						<?php
					
					foreach($action->ateliers[$i] as $keyB => $valueB){
						echo $keyB;
						echo ":";
						echo $valueB;
						echo " ";
						
					}
					?></p><?php
				
			}
	}
	?>

	<input class="niceButton" name="enregistrer" type="submit" value="S'enregistrer à l'atelier" />
</form>

</div>

<div class="square">

<p class="bold">Ateliers auxquels je suis inscrit</p>
<form action="in_ateliers.php" method="post">

	<?php 
	
	if($action->ateliersIns != null){
			for($i = 0; $i < count($action->ateliersIns); $i++){
					//echo " -- ";
						?>
						<label for="<?php $i; ?>">
						<?php echo $i; ?>
						</label>
						
						<input type="radio" name="kkk" value="<?php echo $i; ?>" /> <?php echo $action->ateliersIns[$i]["DATEINSCRIPTION"]; ?><br /> 
						<p>
						<span>Détails: </span>
						<?php
					
					foreach($action->ateliersIns[$i] as $keyB => $valueB){
						echo $keyB;
						echo ":";
						echo $valueB;
						echo " ";
						
					}
					?></p><?php
				
			}
	}
	?>

	<input class="niceButton" name="enlever" type="submit" value="Se désinscrire de l'atelier" />
</form>	

	
	
</div>

<div class="square">
<a href="index.php">Retour</a>
</div>

<?php
	require_once("PHP/footer.php");
?>