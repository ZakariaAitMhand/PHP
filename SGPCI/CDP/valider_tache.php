<?php
session_start();
include '../projet.php';
include 'CDP.php';
include '../library/php/bd.php';
include '../library/php/functions.php';
$np = $_GET['np'];
$cdp =new CDP(1);
$t_u = $_POST['t_u'];
$l	 = explode("-",$t_u);
$t	 = $l[0];
$id	 = $l[1];
$nbre_h = (int)$_POST['nbre_h'];
$destination = $_SERVER["HTTP_REFERER"];
$_SESSION['destination'] = $destination;
$cdp->valider_tache($np,$id,$t,$nbre_h);

header("Location: $destination");