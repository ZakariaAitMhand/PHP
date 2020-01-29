<?php
if($_SESSION['grade'] != "tech"){
	header("Location: ../index.php");
}
else{
	include "tache_info.php";
	$f = new formulaire("form","valider_tache.php?np=$np&th=$th&id=$id","post","","width:40%");
	echo "Nombre d'heures de travail ";
	$f->input("text", "nbre_h","","width:40px;margin-right:5px;");
	$f->input("submit","","Valider","",false,"","bt");
	$f->close();
}