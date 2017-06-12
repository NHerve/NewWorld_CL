<?php 
include 'connexionSql.php';

ini_set("display_errors",0);error_reporting(0);

 $Login=$_POST['Login'];
 $qte = $_POST['qte'];
 $dateRecolte = $_POST['DateRecolte'];
 $conservation = $_POST['dureeConservation'];
 $unite = $_POST['unite'];
 $modeProd = $_POST['modeProd'];
 $manuelle = $_POST['manuelle'];
 $pu = $_POST['pu'];
 $numero = $_POST['numero'];

 $sqlMaxId = "select max(id+1) from lot;";
 $reqMaxId = mysql_query($sqlMaxId) or die('Erreur SQL !<br>'.$sqlMaxId.'<br>'.mysql_error());
 $dataIdMax = mysql_fetch_assoc($reqMaxId);
 $id = $dataIdMax['max(id+1)'];

 if($manuelle == 0)
 {
     $manuelle = "oui";
 }else
 {
     $manuelle = "non";
 }

 // on crée la requete SQL
 $sql = "insert into `lot` (`id`,`qte`,`dateRecolte`,`nbJourConservation`,`uniteVente`,`modeProduction`,`ramassageManuelle`,`pu`,`login`,`numero`) VALUES ('$id','$qte','$dateRecolte','$conservation','$unite','$modeProd','$manuelle','$pu','$Login','$numero');"; 

 // on envoie la requête
 $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
 //var_dump($req); 
if($req)
{
 $_SESSION['addLot'] = 1;

 header('Location: ../proposer.php');
}


 ?>