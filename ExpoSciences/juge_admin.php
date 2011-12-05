<?php
	require_once("PHP/juge_adminAct.php");
	
	$action = new JugeAdminAction();
	$action->execute();

	require_once("PHP/header.php");
?>


<div class="clear"></div>

<?php if(isset($_SESSION["administrator"]) && $_SESSION["administrator"] === true){
			
			?>
			<div class="square"><p class="bold">Modifiez le statut juge des utilisateurs:</p></div>
			<div class="clear"></div>
			<?php
			if ($action->errorCode != null && $action->errorCode === 101) {
			?>
				<div class="square" style="color:red">
					<p class="bold">Erreur!</p>
				</div>
			<?php
			}
			?>
			
			<?php
			if ($action->errorCode != null && $action->errorCode === 102) {
			?>
				<div class="square" style="color:green">
					<p class="bold" >Succès! </p>
				</div>
			<?php
			}
			?>
			<div class="clear"></div>
			<div class="square">
			<form action="juge_admin.php" method="post">
			<?php
			foreach ($action->content as $value){
			
			?>
			
			<?php
				foreach($value as $key => $data){
				
				if($key === "JUGE"){
					
				
				}
				else if($key === "CANDIDATJUGE"){
					echo "<p style='color:yellow'>" . $key . " : " . $data . " </p>";
				}
				else{
				
				echo $key . " : " . $data . ". ";
				}
			}
			
			?>
			
			
			
				<p class="bold">
			<?php
				
				if (array_key_exists("JUGE", $value)){
					echo "<p style='color:green'>Est juge</p>";
			?>
					<label for="<?php echo $value["CODEAUDITEUR"]; ?>">
					Changer : 
					</label>
					<input class="niceField" type="checkbox" name="check<?php echo $value["CODEAUDITEUR"]; ?>" id="<?php echo $value["CODEAUDITEUR"]; ?>" checked />
			<?php
				}
				else{
					echo "<p style='color:yellow'>N'est pas juge</p>";
					
			?>
					<label for="<?php echo $value["CODEAUDITEUR"]; ?>">
					Changer : 
					</label>
					<input class="niceField" type="checkbox" name="check<?php echo $value["CODEAUDITEUR"]; ?>" id="<?php echo $value["CODEAUDITEUR"]; ?>" />
			
			<?php
				}
			?>
			</p>
			
				</p>
				<p> --------------- </p>
				<div class="clear"></div>
			<?php
			}
			
			?>
			<input class="niceButton" style="color:yellow; font-size: 1.5em" type="submit" name="modjuge" value="Modifier les juges" />
			</form>
			</div>
			<?php
		}
?>
<div class="clear"></div>


<div class="square">
<a href="index.php">Annuler - Retour</a>
</div>	

<?php
	require_once("PHP/footer.php");
?>