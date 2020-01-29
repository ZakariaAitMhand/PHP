<?php
include "../library/php/bd.php";
include "../library/php/functions.php";
if(isset($_GET['u']))
	$u=$_GET['u'];
if(isset($_GET['t']))
	$t=$_GET['t'];
if(isset($_GET['np']))
	$np=$_GET['np'];
$bd = new DB();
$req = "UPDATE 	usertacheprojet
		set 	validation = 0
		WHERE 	user_id = $u
		AND 	tache_id = $t
		AND 	projet_id = '".$np."'";
$bd->query($req);
$req = "UPDATE projet
		set valide = 0
		WHERE 	numpjt = '".$np."'";
$bd->query($req);
//$msg = "Retour dans la tache.....";
//envoie_mail($u,$msg);
header("Location: ".$_SERVER["HTTP_REFERER"]);