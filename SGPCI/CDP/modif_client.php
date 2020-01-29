<?php
session_start();
include "../library/php/bd.php";

$nc = $_GET['nc'];
$serv = $_SESSION['serv'];
$nomste = $_POST ['nomst'];
$dossier = $serv.$nomste."/";
$tel = $_POST ['tel'];
$ad = $_POST ['ad'];
$site = $_POST ['site'];
$bd = new DB();
$req = "SELECT dossier FROM client WHERE numclt = $nc";
$bd->query($req);
$l = $bd->fetch();
rename($l['dossier'],$dossier);
$req = "UPDATE `sgpci`.`client` 
		SET `nomste` =  '".$nomste."',
			`tel` =  '".$tel."',
			`adresse` = '".$ad."',
			`siteweb` = '".$site."', 
			`dossier` = '".$dossier."' 
		WHERE `client`.`numclt` =$nc";
$bd->query($req);
header("Location: ../CDP/?l=mes_clients");