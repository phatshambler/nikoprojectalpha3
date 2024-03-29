<?php
	require_once("PHP/ev_ateliersAct.php");
	
	$action = new EvAteliersAction();
	$action->execute();

	require_once("PHP/header.php");
?>

<SCRIPT TYPE="text/javascript">
<!--
// copyright 1999 Idocs, Inc. http://www.idocs.com
// Distribute this script freely but keep this notice in place
function numbersonly(myfield, e, dec)
{
var key;
var keychar;

if (window.event)
   key = window.event.keyCode;
else if (e)
   key = e.which;
else
   return true;
keychar = String.fromCharCode(key);

// control keys
if ((key==null) || (key==0) || (key==8) || 
    (key==9) || (key==13) || (key==27) )
   return true;

// numbers
else if ((("012345").indexOf(keychar) > -1))
   return true;

// decimal point jump
else if (dec && (keychar == "."))
   {
   myfield.form.elements[dec].focus();
   return false;
   }
else
   return false;
}


function loadEv(){
	
}

//-->
</SCRIPT>


<div class="square">
<p class="xbold">�valuation des ateliers</p>

<?php if (isset($action->errorCode)){ ?>
	<p class="bold" style="color:yellow">Vous notez pour l'auditeur <?php echo $action->errorCode; ?> </p>
	<form action="ev_ateliers.php" method="post">
	<input class="niceButton" name="cancel" type="submit" value="Annuler l'usurpation d'identit�" />
	</form>	
	
<?php
}
?>

<p class="logged">Choisissez un atelier � �valuer:</p>
	<?php if(isset($action->juge) && $action->juge != null &&  $action->juge != ""){
		//echo "lol";
	?>
	
<div class="square">

<p class="bold">Ateliers auxquels vous �tes inscrit:</p>
	<form action="ev_ateliers.php" method="post">

	<?php 
	
	if($action->ateliersIns != null){
			for($i = 0; $i < count($action->ateliersIns); $i++){
					//echo " -- ";
						?>
						<label for="<?php $i; ?>">
						<?php echo $i; ?>
						</label>
						
						<input type="radio" name="atelier" value="<?php echo $i; ?>" onclick="loadEv()"/> <?php echo $action->ateliersIns[$i]["DATEINSCRIPTION"];?><br /> 
						<p>
						<span>D�tails: </span>
						<?php
					
					foreach($action->ateliersIns[$i] as $keyB => $valueB){
						
						if($keyB === "NOTES"){
						echo "<p class='bold'>(NOTES PR�C�DENTES: ";
							foreach($action->ateliersIns[$i]["NOTES"] as $value){
								if($value != null){
								foreach($value as $finalvalue){
									if(isset($finalvalue) && isset($finalvalue["COTE"]) && isset($finalvalue["NOCRITERE"])){
									echo $finalvalue["NOCRITERE"];
									echo ":";
									echo $finalvalue["COTE"];
									echo " ";
									}
								}
								}
							}
						echo ")</p>";
						}
						else{
							echo $keyB;
							echo ":";
							echo $valueB;
							echo " ";
						}
					}
					?></p><?php
				
			}
	}
	else{
	
	echo "<p class='xbold'>Vous n'�tes inscrit � aucun atelier! </p>";
	}
	?>
</div>
<div class="square">

	<?php 
	
	if($action->criteres != null && $action->ateliersIns != null){
			?> <p class="logged">Entrez des notes pour l'atelier s�lectionn�:</p> <?php
			for($i = 0; $i < count($action->criteres); $i++){
					 
					//echo " -- ";
						?>
						<label for="<?php $i; ?>">
						<?php echo $action->criteres[$i]["NOCRITERE"] . " - " . $action->criteres[$i]["NOMCRITERE"]; ?>
						</label>
						
						<input id="<?php $i; ?>" type="text" name="<?php echo $action->criteres[$i]["NOCRITERE"]; ?>" value="" size="2" maxlength="1" onKeyPress="return numbersonly(this, event)"/> (1-5)<br /> 
						
						<?php
				
			}
			?>
	
	
	<input class="niceButton" name="noter" type="submit" value="Noter l'atelier" />
</form>	
	<?php
	}
	?>
</div>
	
	
	<?php
	}
	else{
	
	echo "<br/>Vous n'�tes malheureusement pas juge!";
	}
	?>
</div>

<div class="square">
<a href="index.php">Retour</a>
</div>

<?php
	require_once("PHP/footer.php");
?>