<?php
session_start();
if($_SESSION['grade'] != "CDP"){
	header("Location: ../index.php");
}
else{
	include '../library/php/bd.php';
	include '../library/php/functions.php';
	$bd = new DB();
	$np=$_GET['np'];
	$x = explode("-",$np);
	$nump = implode("",$x);
	$nump .= "/";
	$nom = $_POST['projet'];
	$clt = $_POST['clt'];
	$desc = $_POST['desc'];
if(isset($_POST['debut'])){
	$debut	=	$_POST['debut'];
	$tt = explode("-",$debut);
	$xx = $tt[0];
	$tt[0] = $tt[2];
	$tt[2] = $xx;
	$debut = implode("-",$tt);
}
if(isset($_POST['fin'])){
	$fin	=	$_POST['fin'];
	$tt = explode("-",$fin);
	$xx = $tt[0];
	$tt[0] = $tt[2];
	$tt[2] = $xx;
	$fin = implode("-",$tt);
}
	$bd = new DB();
	$req = "SELECT dossier, fichier_src FROM client c, projet p WHERE c.numclt=p.numclt AND numpjt='".$np."'";
	$bd->query($req);
	$l = $bd->fetch();
	$nomrep =  $l['dossier']."/".$nump;
	if($_FILES['upload']['size']!=0){
		unlink($l['dossier'].$nump.$l['fichier_src']);
		$src = upload_fichier($_FILES['upload'],$nomrep);
		$req = "UPDATE projet
				SET fichier_src = '".$src."'
				WHERE numpjt='".$np."'";
		$bd->query($req);
	}
	$req = "UPDATE 	projet
			SET 	nompjt = '".$nom."',
					description = '".en_coder($desc)."',
					debut = '".$debut."',
					fin = '".$fin."'
			WHERE 	numpjt='".$np."'";
	$bd->query($req);
	$message = "$nom<br>$clt<br>$desc<br>";
	modif_projet($np,$_POST['Developpementresp'],1,$_POST['Developpement%'],$message);
	modif_projet($np,$_POST['IntegrationCSS-XHTMLresp'],2,$_POST['IntegrationCSS-XHTML%'],$message);
	modif_projet($np,$_POST['Integratione-mailresp'],3,$_POST['Integratione-mail%'],$message);
	modif_projet($np,$_POST['Flashresp'],4,$_POST['Flash%'],$message);
	modif_projet($np,$_POST['Webdesignresp'],5,$_POST['Webdesign%'],$message);
	
	header("Location: ../CDP/");
}