<?php session_start();
include 'connexionSql.php';

ini_set("display_errors",0);error_reporting(0);

 $Login=$_SESSION['Login'];
 $questionSecrete=$_POST['questionSecrete'];
 $Reponse=$_POST['ReponseSecrete'];
 $newMail=$_POST['NewMail'];
 
 //var_dump($questionSecrete);
 //var_dump($Reponse);
 
if($questionSecrete == $_SESSION['question_secrete'])
{
	if($Reponse == $_SESSION['reponse_question_secrete'])
	{
		 // on crée la requete SQL
 		 $sql = "update utilisateurs set mail = '$newMail' where login = '$Login' ;"; 
 		 //var_dump($sql);
 		 // on envoie la requête
 		 $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		 //var_dump($req); 
		 if($req)
		 {
		 	 $_SESSION['mail'] = $newMail;
		 	 $_SESSION['erreurModification']=4;
			 header('Location: ../profil.php');
		 }
		 else
		 {
		 	 $_SESSION['erreurModification']=5;
	 	 	 header('Location: ../profil.php');
		 }
	}
	else
	{
		$_SESSION['erreurModification']=6;
		header('Location: ../profil.php');
	}
}
else
{
	$_SESSION['erreurModification']=7;
	header('Location: ../profil.php');
}


?>

