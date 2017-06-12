<?php session_start();
include 'connexionSql.php';

ini_set("display_errors",0);error_reporting(0);

 $Login=$_SESSION['Login'];

 $Adresse=$_POST['Adresse'];
 $CP=$_POST['CodePostal'];
 $Ville=$_POST['Ville'];


if(!empty($Adresse))
{
	// on crée la requete SQL
	$sql = "update utilisateurs set adresse = '$Adresse' where login = '$Login' ;"; 
	//var_dump($sql);
	// on envoie la requête
	$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	//var_dump($req); 
	if($req)
	{
		$_SESSION['erreurModification']=8;
	}
}

if(!empty($CP))
{
	// on crée la requete SQL
	$sql = "update utilisateurs set code_postal = '$CP' where login = '$Login' ;"; 
	//var_dump($sql);
	// on envoie la requête
	$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	//var_dump($req); 
	if($req)
	{
		$_SESSION['erreurModification']=8;
	}
}

if(!empty($Ville))
{
	// on crée la requete SQL
	$sql = "update utilisateurs set ville = '$Ville' where login = '$Login' ;"; 
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

