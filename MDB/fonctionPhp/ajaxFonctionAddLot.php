<?php session_start();
include 'connexionSql.php';

ini_set("display_errors",0);error_reporting(0);

$noProd=$_POST['noProd'];

$maVar = "<form method='post' action='fonctionPhp/AddLot.php'>";
$maVar .= "<table class='Profile'><tr><th>Date de recolte</th> <th>Prix/Unité</th> <th>Quantite</th><th>durée de conservation</th><th>Mode de production</th><th>Ramassage manuelle</th></tr>";

$maVar .= "<tr>";
$maVar .= "<td><input type='text' name='DateRecolte' class='form-control blackText' placeholder='yyyy-mm-dd' ></td>";
$maVar .= "<td><input type='number' name='pu' class='form-control blackText' min='0' step='0.01' placeholder='1'>€/<input type='text' name='unite' class='form-control blackText' placeholder='pieces kg barquette...'></td>";
$maVar .= "<td><input type='number' name='qte' class='form-control blackText' min='0' step='1' placeholder='1'></td>";
$maVar .= "<td><input type='number' name='dureeConservation' class='form-control blackText' min='0' step='1' placeholder='1'></td>";
$maVar .= "<td><input type='text' name='modeProd' class='form-control blackText' placeholder='Mode de production' ></td>";
$maVar .= "<td><input type='checkbox' name='manuelle' class='form-control blackText'></td>";
$maVar .= "</tr>";

$maVar .= "</table>";

$maVar .= "<input type='hidden' name='numero' value ='".$noProd."' class='form-control blackText' placeholder=".$noProd.">";
$maVar .= "<input type='hidden' name='Login' value='".$_SESSION['Login']."' class='form-control blackText' placeholder=".$_SESSION['Login'].">";

$maVar.= "<input class='btn btn-primary' type='submit' value='Ajouter'>";
$maVar .= "</form>";
	
	echo (json_encode($maVar, JSON_UNESCAPED_UNICODE));
        
?>

