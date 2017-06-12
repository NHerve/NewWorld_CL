<?php session_start();
include 'connexionSql.php';

ini_set("display_errors",0);error_reporting(0);

 $Login=$_SESSION['Login'];

 $Iban=$_POST['Iban'];


if(!empty($Iban))
{
	// on crée la requete SQL
	$sql = "update utilisateurs set iban = '$Iban' where login = '$Login' ;"; 
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

