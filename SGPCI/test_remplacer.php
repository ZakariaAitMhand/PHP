<?php
session_start();
include 'projet.php';
include 'library/php/bd.php';
include 'library/php/functions.php';

$id = $_SESSION['id'];

$np = $_SESSION['np'];
$x = explode("-",$np);
$nump = implode('',$x);

$t = $_SESSION['t'];
$destination = $_SESSION['destination'];
if(isset($_GET['e']))
	$e = $_GET['e'];//ecraser
else
	$e = 0;
if(isset($_GET['r']))//renommer
	$r = $_GET['r'];
else
	$r = 0;
	
$pj = new projet();
$bd = new DB();

$req = "SELECT dossier FROM projet p, client c WHERE p.numclt=c.numclt AND numpjt= '".$np."'";
$bd->query($req);
$l=$bd->fetch();
$pj->setProjet("nump",$np);
$pj->setProjet("rep",$nump);
$pj->setProjet("chemin",$l['dossier']);
$pj->prod_upload(0,$t,$id,$e,$r);
header("Location: $destination");
