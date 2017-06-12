<?php
include 'connexionSql.php';

$requete1="set names utf8;";
$res1=mysql_query($requete1);

$login = $_GET['username'];
$mdp = $_GET['password'];

$requete = "select login from employer where login = '$login' and mdp = '$mdp';";
//var_dump($requete);
// var_dump($requete);

$result = mysql_query($requete);

if($donnees = mysql_fetch_assoc($result))
{
	$res[] = $donnees;
}

echo json_encode($res);
?>