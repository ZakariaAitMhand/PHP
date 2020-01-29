<?php

$id = $_SESSION['id'];

$np = $_GET['np'];
$x = explode("-",$np);
$nump = implode("",$x);
$nump .= "/dev/";

$th = $_GET['th'];

$bd = new DB();


$req = "SELECT dossier FROM projet p, client c WHERE c.numclt = p.numclt AND numpjt = '".$np."'";
$bd->query($req);
$l = $bd->fetch();
$dossier = $l['dossier'].$nump;
$req = "SELECT fichier_prod
		FROM tache, projet , user , usertacheprojet
		WHERE id = user_id
		AND tache_id = id_tache
		AND numpjt = projet_id
		AND id = $id
		AND numpjt = '".$np."'
		AND id_tache=$th";
$bd->query($req);
$l = $bd->fetch();
if($l['fichier_prod']==""){
	header("Location: historique.php");
}
else{
	$dossier .= $l['fichier_prod'];
	header("Location: $dossier");
}