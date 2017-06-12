<?php session_start();
include 'connexionSql.php';

ini_set("display_errors",0);error_reporting(0);

 $Login=$_SESSION['Login'];

 $TelFixe=$_POST['TelFixe'];
 $TelPort=$_POST['TelPort'];


if(!empty($TelFixe))
{
	// on crée la requete SQL
	$sql = "update utilisateurs set tel_fixe = '$TelFixe' where login = '$Login' ;"; 
	//var_dump($sql);
	// on envoie la requête
	$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	//var_dump($req); 
	if($req)
	{
		$_SESSION['erreurModification']=8;
	}
}

if(!empty($TelPort))
{
	// on crée la requete SQL
	$sql = "update utilisateurs set tel_portable = '$TelPort' where login = '$Login' ;"; 
	//var_dump($sql);
	// on envoie la requête
	$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	//var_dump($req); 
	if($req)
	{
		$_SESSION['erreurModification']=8;
	}
}

header('Location: ../profil.php');
?>

