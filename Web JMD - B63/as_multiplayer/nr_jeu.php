<?php
session_start();
require_once("GameMulti.php");
$master = new GameMulti();


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
	<head>
		<title>SHMUP - AWESOME SHOOTER</title>
		<script type="text/javascript" src="nr_cookie.js"></script>
		<script type="text/javascript" src="nr_constants.js"></script>
		<script type="text/javascript" src="nr_simpleserial.js"></script>
		<script type="text/javascript" src="nr_options.js"></script>
		<script type="text/javascript" src="JSON/json2.js"></script>
		<script type="text/javascript" src="JSON/cycle.js"></script>
		<script type="text/javascript" src="nr_controleur.js"></script>
		<script type="text/javascript" src="nr_modelview.js"></script>
		<script type="text/javascript" src="nr_metaobject.js"></script>
		<script type="text/javascript" src="nr_ship.js"></script>
		<script type="text/javascript" src="nr_enemis.js"></script>
		<script type="text/javascript" src="nr_missiles.js"></script>
		<script type="text/javascript" src="nr_star.js"></script>
		<script type="text/javascript" src="nr_powerup.js"></script>
		<script type="text/javascript" src="ajax.js"></script>
		<script type="text/javascript" src="ajaxuser.js"></script>
		
		<link href="nr_style.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
	<?php
	$master->run();
	?>
		<canvas id="canvas" style="border:1px solid black;">
		
		</canvas>
	
		<script type="text/javascript">
		//loadGame();
		</script>
	
	
	
	</body>
</html>