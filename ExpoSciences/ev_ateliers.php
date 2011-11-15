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
else if ((("0123456789").indexOf(keychar) > -1))
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
<p class="xbold">Évaluation des ateliers</p>
<p class="logged">Choisissez un atelier à évaluer:</p>
	<?php if(isset($action->juge) && $action->juge != null &&  $action->juge != ""){
		//echo "lol";
	?>
	
<div class="square">

<p class="bold">Ateliers auxquels vous êtes inscrit:</p>
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
</div>
<div class="square">
<p class="logged">Entrez des notes pour l'atelier sélectionné:</p>
	<?php 
	
	if($action->criteres != null){
			for($i = 0; $i < count($action->criteres); $i++){
					//echo " -- ";
						?>
						<label for="<?php $i; ?>">
						<?php echo $action->criteres[$i]["NOCRITERE"] . " - " . $action->criteres[$i]["NOMCRITERE"]; ?>
						</label>
						
						<input id="<?php $i; ?>" type="text" name="<?php echo $action->criteres[$i]["NOCRITERE"]; ?>" value="" size="2" maxlength="1" onKeyPress="return numbersonly(this, event)"/> (1-5)<br /> 
						
						<?php
				
			}
	}
	?>
	
	<input class="niceButton" name="noter" type="submit" value="Noter l'atelier" />
</form>	

</div>
		
		
		
		
		
		
		
		
		
		
		
	
	
	<?php
	}
	?>
</div>

<div class="square">
<a href="index.php">Retour</a>
</div>

<?php
	require_once("PHP/footer.php");
?>