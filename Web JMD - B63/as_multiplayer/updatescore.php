<?php
session_start();
require_once("GameDAO.php");

$p = $_POST["var1"];
$q = $_POST["var2"]; //x
$k = $_POST["var3"]; //y
/*
echo "<p>";
echo $_SESSION["username"];
echo $_SESSION["userid"];
echo "</p>";
*/
$p = intval($p);
$q = intval($q);
$k = intval($k);

GameDAO::updateScore($_SESSION["userid"], $p, $q, $k, $_SESSION["partie"]);

$a = GameDAO::getScores($_SESSION["partie"]);

$jsa = json_encode($a);
echo (string)$jsa;
/*
echo "<p>";
echo "Scores:::___";
foreach ($a as $value){
	echo $value["NOMJOUEUR"];
	echo ":";
	echo $value["SCORE"];
	echo " --- ";
	echo $value["X"];
	echo " -x- ";
	echo $value["Y"];
	echo " -y- ";
	
	*/
