<?php session_start();
include 'connexionSql.php';

ini_set("display_errors",0);error_reporting(0);

$noCat=$_POST['noCat'];
                    
$sql = "select libelle, numero from produit where etat_produit ='valide' and noCat = '$noCat';"; 
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$maVar = "";

if($req)
{
	while($data = mysql_fetch_assoc($req))
	{
		$maVar .= "<button type='button' onclick='loadLot(".$data['numero'].")' class='btn btn-primary wow fadeInDown' data-wow-delay='0.2s' type='submit' value='Connexion'>".$data['libelle']."</button>";
	}
}
	echo (json_encode($maVar, JSON_UNESCAPED_UNICODE));
        
?>

