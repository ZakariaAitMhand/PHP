<?php
include '../projet.php';
include '../library/php/bd.php';
include '../library/php/functions.php';
include 'CDP.php';


if(isset($_POST['nompjt']))
	$nomp	=	$_POST['nompjt'];
if(isset($_POST['clt']))
	$nomclt	=	$_POST['clt'];
if(isset($_POST['desc']))
	$desc	=	$_POST['desc'];
if(isset($_POST['debut'])){
	$deb	=	$_POST['debut'];
	$tt = explode("-",$deb);
	$xx = $tt[0];
	$tt[0] = $tt[2];
	$tt[2] = $xx;
	$deb = implode("-",$tt);
}
if(isset($_POST['fin'])){
	$fin	=	$_POST['fin'];
	$tt = explode("-",$fin);
	$xx = $tt[0];
	$tt[0] = $tt[2];
	$tt[2] = $xx;
	$fin = implode("-",$tt);
}
$cdp = new CDP(1);
$cdp->ajout_projet($nomp, $nomclt, $desc, $deb, $fin);

//fonctions


header("Location: ../CDP/" );