<?php
session_start();
include '../library/php/bd.php';
$bd = new DB();
$x = explode('-',$_GET['np']);
$dossier=implode('',$x);
$req = "SELECT nomste, fichier_src FROM projet p, client c WHERE p.numclt=c.numclt AND numpjt='".$_GET['np']."'";
$bd->query($req);
$l=$bd->fetch();
header("location:".$_SESSION['serv'].$l['nomste']."/".$dossier."/".$l['fichier_src']);