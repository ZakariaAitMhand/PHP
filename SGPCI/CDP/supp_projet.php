<?php
session_start();
if($_SESSION['grade'] != "CDP"){
	header("Location: ../index.php");
}
else{
	include "../library/php/bd.php";
	$np=$_GET['np'];
	$bd = new DB();
	$req = "SELECT * 
			FROM projet p,client c 
			WHERE numpjt = '".$np."'
			AND p.numclt = c.numclt"; 
	$bd->query($req);
	$l = $bd->fetch();
	$x = explode("-",$np);
	$nump = implode("",$x);
	$nump .= "/";
	//suppression de dossier client/numprojet
	echo $l['dossier'].$nump.$l['fichier_src'];
	unlink($l['dossier'].$nump.$l['fichier_src']);
	rmdir($l['dossier'].$nump."dev");
	rmdir($l['dossier'].$nump);
	
	// suppression de projet et tache depuis la base de données
	$req = "DELETE 
			FROM projet 
			WHERE numpjt = '".$np."'";
	$bd->query($req);
	$req = "DELETE 
			FROM usertacheprojet 
			WHERE projet_id = '".$np."'";
	$bd->query($req);
	$bd->close();
	header("Location: ../CDP/");
}