<?php session_start();
include 'connexionSql.php';

ini_set("display_errors",0);error_reporting(0);

 $Login=$_POST['Login'];
 $Password=$_POST['Password'];


 // on crée la requete SQL
 $sql = "select etat_validation, type_utilisateur from utilisateurs where login = '$Login' and mdp = '$Password';"; 
 //var_dump($sql);
 // on envoie la requête
 $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
 //var_dump($req); 
if($req)
{
	//var_dump($req);
	$data = mysql_fetch_assoc($req);
	//var_dump($data[etat_validation]);
	if($data['etat_validation']=='valide')
	{
		//var_dump($data[etat_validation]);
		$_SESSION['Login']=$Login;
		$_SESSION['type_utilisateur']=$data['type_utilisateur'];
		$_SESSION['erreurConnexion']=0;
		$_SESSION['Password']=$Password;
		header('Location: ../connexionReussi.php');
	}
	else
	{
		$_SESSION['erreurConnexion']=1;
		header('Location: ../connexion.php');
	}

 
}

?>

