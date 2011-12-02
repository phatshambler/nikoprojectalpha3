<?php
header('Content-type: text/html; charset=iso-8859-1');

if(count($_POST) > 0) {
   echo "Données reçues en POST:";
   foreach($_POST as $v)
      echo utf8_decode($v).":::";
}
elseif(count($_GET) > 0) {
   echo "Données reçues en GET:";
   foreach($_GET as $v)
      echo $v.":";
}

if(count($_POST) == 0 && count($_GET) == 0)
	echo 'Aucune donnée n\'a été reçue par "'.basename($_SERVER["PHP_SELF"]).'"...';