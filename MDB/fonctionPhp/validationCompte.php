<?php session_start();
include 'connexionSql.php';

ini_set("display_errors",0);error_reporting(0);

 $Login=$_GET['Login'];
 //var_dump($_GET['Login']);

	// on crée la requete SQL
	$sql = "update utilisateurs set etat_validation = 'valide' where login = '$Login' ;"; 
	//var_dump($sql);
	// on envoie la requête
	$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	//var_dump($req); 
	if($req)
	{
		$_SESSION['erreurConnexion']=2;
		//var_dump($sql);
		//var_dump($Login);
		header('Location: ../connexion.php');
	}
	else
	{
	echo "Erreur";
	}
?>

