<?php
if($_SESSION['grade'] != "CDP"){
	header("Location: ../index.php");
}
else{
	$cdp = new CDP(01);
	$cdp->afficher_Client();
}