<?php 
include 'connexionSql.php';

ini_set("display_errors",0);error_reporting(0);

 $Login=$_POST['Login'];
 $mdp= generateRandomString(10);
 $nom=$_POST['Nom'];
 $prenom=$_POST['Prenom'];
 $telephone=$_POST['Telephone'];
 $email=$_POST['Email'];
 $type_user=$_POST['type_user'];
 $date=date("Y-m-d");
 $etat_validation="enAttente";
 $questionSecrete=$_POST['questionSecrete'];
 $Reponse=$_POST['Reponse'];
 //var_dump($type_user);
 //var_dump($mdp);
 //var_dump($date);

 // on crée la requete SQL
 $sql = "insert into `utilisateurs` (`login`,`mdp`,`nom`,`prenom`,`mail`,`tel_portable`,`date_inscription`,`type_utilisateur`,`etat_validation`,`question_secrete`,`reponse_question_secrete`) VALUES ('$Login','$mdp','$nom','$prenom','$email','$telephone','$date','$type_user','$etat_validation','$questionSecrete','$Reponse');"; 

 // on envoie la requête
 $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
 //var_dump($req); 
if($req)
{
 $message="Merci pour votre inscription a New World \r\n vous pouvez retrouvez votre espace client en cliquant <a href='http://172.29.56.2/~haymes/NewWorld/MDBNewWorld/fonctionPhp/validationCompte.php?Login=$Login'> ici</a> en vous connectant avec \r\n votre login : $Login et votre mot de passe : $mdp ";

 $headers = "Content-type: text/html; charset=UTF-8";

 mail($email,'validation de votre inscription New World',$message,$headers);

 header('Location: ../inscriptionReussi.php');
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

 ?>