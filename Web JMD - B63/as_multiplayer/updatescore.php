<?php
session_start();
require_once("GameDAO.php");

$p = $_POST["var1"];
$q = $_POST["var2"];
$k = $_POST["var3"];

echo "<p>";
echo $_SESSION["username"];
echo $_SESSION["userid"];
echo "</p>";

$p = intval($p);

GameDAO::updateScore($_SESSION["userid"], $p, $q, $k);

$a = GameDAO::getScores();

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
}