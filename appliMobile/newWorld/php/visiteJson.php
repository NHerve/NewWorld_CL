<?php
include 'connexionSql.php';

$requete1="set names utf8;";
$res1=mysql_query($requete1);

$requete = "select concat(utilisateurs.ville,', France') as location, true as stopover
from visite inner join visiteProd on visite.id = visiteProd.id
inner join utilisateurs on visiteProd.login = utilisateurs.login
where visite.controlleur = ".$_GET["idControleur"].";";

// var_dump($requete);

$result = mysql_query($requete);

while($donnees = mysql_fetch_assoc($result))
{
	if($donnees["stopover"]==1)
	{
		$donnees["stopover"] = TRUE;
	}
	$res[] = $donnees;
}

echo json_encode($res);
?>