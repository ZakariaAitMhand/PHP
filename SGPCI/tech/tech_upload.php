<?php
if($_SESSION['grade'] != "tech"){
	header("Location: ../index.php");
}
else{
include "tache_info.php";
$f = new formulaire("form","upload.php?np=$np&th=$th&id=$id","post","multipart/form-data","width:60%");
echo "Selectioner le production";
$f->input("file","prod");
$f->input("submit","valider","Valider","",false,"","bt");
$f->close();
}