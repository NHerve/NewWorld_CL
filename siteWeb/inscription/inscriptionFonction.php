<?php 
include '../connexionSql.php';

ini_set("display_errors",0);error_reporting(0);

$pseudo=$_POST['pseudo'];
 $mdp= rand(100000,1000000000);
 $nom=$_POST['nom'];
 $prenom=$_POST['prenom'];
 $tel_fixe=$_POST['tel_fixe'];
 $tel_port=$_POST['tel_portable'];
 $email=$_POST['email'];
 $adresse=$_POST['adresse'];
 $cp=$_POST['code_postal'];
 $ville=$_POST['ville'];
 $type_user=$_POST['type_user'];
 $question=$_POST['question'];
 $reponse=$_POST['reponse'];
 $iban=$_POST['iban'];
 $j1h1=$_POST['j1h1'];
 $j1m1=$_POST['j1m1'];
 $j1h2=$_POST['j1h2'];
 $j1m2=$_POST['j1m2'];
 $j2h1=$_POST['j2h1'];
 $j2m1=$_POST['j2m1'];
 $j2h2=$_POST['j2h2'];
 $j2m2=$_POST['j2m2'];
 $j3h1=$_POST['j3h1'];
 $j3m1=$_POST['j3m1'];
 $j3h2=$_POST['j3h2'];
 $j3m2=$_POST['j3m2'];
 $j4h1=$_POST['j4h1'];
 $j4m1=$_POST['j4m1'];
 $j4h2=$_POST['j4h2'];
 $j4m2=$_POST['j4m2'];
 $j5h1=$_POST['j5h1'];
 $j5m1=$_POST['j5m1'];
 $j5h2=$_POST['j5h2'];
 $j5m2=$_POST['j5m2'];
 $j6h1=$_POST['j6h1'];
 $j6m1=$_POST['j6m1'];
 $j6h2=$_POST['j6h2'];
 $j6m2=$_POST['j6m2'];
 $j7h1=$_POST['j7h1'];
 $j7m1=$_POST['j7m1'];
 $j7h2=$_POST['j7h2'];
 $j7m2=$_POST['j7m2'];
 $horaire=$j1h1.":".$j1m1.",".$j1h2.":".$j1m2.";".$j2h1.":".$j2m1.",".$j2h2.":".$j2m2.";".$j3h1.":".$j3m1.",".$j3h2.":".$j3m2.";".$j4h1.":".$j4m1.",".$j4h2.":".$j4m2.";".$j5h1.":".$j5m1.",".$j5h2.":".$j5m2.";".$j6h1.":".$j6m1.",".$j6h2.":".$j6m2.";".$j7h1.":".$j7m1.",".$j7h2.":".$j7m2.";";

	if($type_user=='consommateur')
	{
		// on crée la requete SQL
		$sql = "insert into `utilisateurs` (`login`,`mdp`,`nom`,`prenom`,`mail`,`adresse`,`code_postal`,`ville`,`type_utilisateur`,`question_secrete`,`reponse_question_secrete`) VALUES ('$pseudo','$mdp','$nom','$prenom','$email','$adresse','$cp','$ville','$type_user','$question','$reponse');"; 

		// on envoie la requête
		$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error()); 

	}

	if($type_user=='producteur')
	{
		// on crée la requete SQL
		$sql = "insert into `utilisateurs` (`login`,`mdp`,`nom`,`prenom`,`mail`,`adresse`,`code_postal`,`ville`,`type_utilisateur`,`question_secrete`,`reponse_question_secrete`,`iban`) VALUES ('$pseudo','$mdp','$nom','$prenom','$email','$adresse','$cp','$ville','$type_user','$question','$reponse','$iban');"; 

		// on envoie la requête
		$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error()); 

	}

	if($type_user=='point_de_vente')
	{
		// on crée la requete SQL
		$sql = "insert into `utilisateurs` (`login`,`mdp`,`nom`,`prenom`,`mail`,`adresse`,`code_postal`,`ville`,`type_utilisateur`,`question_secrete`,`reponse_question_secrete`,`iban`,`horraire_point_vente`) VALUES ('$pseudo','$mdp','$nom','$prenom','$email','$adresse','$cp','$ville','$type_user','$question','$reponse','$iban','$horaire');"; 

		// on envoie la requête
		$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error()); 
	}

$message="Merci pour votre inscription a New World \r\n vous pouvez retrouvez votre espace client a l'adresse suivante laPageDeConnexion en vous connectant avec \r\n votre login :'$pseudo' et votre mot de passe :'$mdp' ";

mail($email,'validation de votre inscription New World',$message);

header('Location: inscriptionReussi.php');

?>
