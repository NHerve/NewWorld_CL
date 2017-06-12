<?php session_start();
include 'connexionSql.php';

ini_set("display_errors",0);error_reporting(0);

$noProd=$_POST['noProd'];

$sql = "select lot.id, produit.libelle, lot.qte, lot.dateRecolte, lot.pu, lot.uniteVente, utilisateurs.nom from utilisateurs inner join lot on utilisateurs.login=lot.login inner join produit on lot.numero=produit.numero where lot.numero='$noProd';"; 
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$maVar = "<table class='Profile'><tr> <th>Nom</th> <th>Producteur</th> <th>Date de recolte</th> <th>Prix/Unité</th> <th>Quantite</th> <th>Ajouter au panier</th> </tr>";

if($req)
{
	while($data = mysql_fetch_assoc($req))
	{
		$maVar .= "<tr>";
		$maVar .= "<td>".$data['libelle']."</td><td>".$data['nom']."</td><td>".$data['dateRecolte']."</td><td>".$data['pu']."€/".$data['uniteVente']."</td><td>".$data['qte']."</td><td>";
		$maVar .= "<a href='panier.php?idLot=".$data['id']."' class='nav-link'><button type='button' class='btn btn-primary wow'><i class='fa fa-cart-plus' aria-hidden='true'></i></button></a></td>";
		$maVar .= "</tr>";
	}
}

$maVar .= "</table>";
	
	echo (json_encode($maVar, JSON_UNESCAPED_UNICODE));
        
?>

