<?php
session_start();
include '../projet.php';
include '../library/php/bd.php';
include '../library/php/functions.php';
$np = $_GET['np'];
$id = $_GET['id'];
$t  = $_GET['th'];
$bd = new DB();
$pj = new projet();

$destination = "../TECH/";
$_SESSION['destination'] = $destination;
$x = explode("-",$np);
$nump = implode('',$x);

$req = "SELECT dossier FROM projet p, client c WHERE p.numclt=c.numclt AND numpjt= '".$np."'";
$bd->query($req);
$l=$bd->fetch();
$pj->setProjet("nump",$np);
$pj->setProjet("rep",$nump);
$pj->setProjet("chemin",$l['dossier']);

$pj->prod_upload($_FILES['prod'],$t,$id,0,0);
header("Location: $destination");