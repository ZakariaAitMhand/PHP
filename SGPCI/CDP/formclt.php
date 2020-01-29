<?php
if($_SESSION['grade'] != "CDP"){
	header("Location: ../index.php");
}
else{
	echo"<title>Ajout Client</title>";
	client_form("ajoutclt.php","Ajouter","ajouter");
}