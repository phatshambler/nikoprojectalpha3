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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>
	<title>Exemple 3</title>
	<script type="text/javascript" src="strings.js"></script>
</head>
<body>

<div>
<FORM action="strings.php" method="post">
    <P>
    <LABEL for="firstname">First name: </LABEL>
              <INPUT type="text" id="firstname" name="prenom"><BR>
    <LABEL for="lastname">Last name: </LABEL>
              <INPUT type="text" id="lastname" name="nom"><BR>
    <LABEL for="email">email: </LABEL>
              <INPUT type="text" id="email" name="email"><BR>
    <INPUT type="radio" name="sex" value="Male"> Male<BR>
    <INPUT type="radio" name="sex" value="Female"> Female<BR>
    <INPUT type="button" value="Send" onclick="request04(this.form)"> <INPUT type="reset">
    </P>
 </FORM>
</div>

</body>
</html>