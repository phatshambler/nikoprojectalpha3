<?php
header('Content-type: text/html; charset=iso-8859-1');

if(count($_POST) > 0) {
   echo "Donn�es re�ues en POST:";
   foreach($_POST as $v)
      echo utf8_decode($v).":::";
}
elseif(count($_GET) > 0) {
   echo "Donn�es re�ues en GET:";
   foreach($_GET as $v)
      echo $v.":";
}

if(count($_POST) == 0 && count($_GET) == 0)
	echo 'Aucune donn�e n\'a �t� re�ue par "'.basename($_SERVER["PHP_SELF"]).'"...';