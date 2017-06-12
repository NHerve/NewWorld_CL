<?php
include 'connexionSql.php';

$requete1="set names utf8;";
$res1=mysql_query($requete1);

$requete = "select distinct utilisateurs.login, nom, prenom, ville, adresse, code_postal, visite.dateVisite, visite.commentaire from utilisateurs inner join visiteProd on utilisateurs.login = visiteProd.login inner join visite on visiteProd.id = visite.id;";

// var_dump($requete);

$result = mysql_query($requete);


$i=0;
while($donnees = mysql_fetch_assoc($result))
{
    $res[] = $donnees;
	$res[$i]["id"]=$i;
	$i++;
}

echo json_encode($res);
?>

