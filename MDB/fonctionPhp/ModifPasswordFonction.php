<?php session_start();
include 'connexionSql.php';

ini_set("display_errors",0);error_reporting(0);

 $Login=$_SESSION['Login'];

 $Password=$_POST['NewMdp'];
 $PasswordConf=$_POST['NewMdp2'];
 $oldPassword=$_POST['Mdp'];

 //var_dump($_SESSION['Password']);
 //var_dump($oldPassword);

if($oldPassword == $_SESSION['Password'])
{
	if($Password == $PasswordConf)
	{
		 // on crée la requete SQL
 		 $sql = "update utilisateurs set mdp = '$Password' where login = '$Login' ;"; 
 		 //var_dump($sql);
 		 // on envoie la requête
 		 $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		 //var_dump($req); 
		 if($req)
		 {
		 	 $_SESSION['Password'] = $Password;
		 	 $_SESSION['erreurModification']=0;
			 header('Location: ../profil.php');
		 }
		 else
		 {
		 	 $_SESSION['erreurModification']=1;
	 	 	 header('Location: ../profil.php');
		 }
	}
	else
	{
		$_SESSION['erreurModification']=2;
		header('Location: ../profil.php');
	}
}
else
{
	$_SESSION['erreurModification']=3;
	header('Location: ../profil.php');
}


?>

