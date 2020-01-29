<?php
if($_SESSION['grade'] != "CDP"){
	header("Location: ../index.php");
}
else{
	
	$id = $_GET['id'];
	$bd = new DB();
	
	$req = "SELECT * FROM user WHERE id = $id";
	$bd -> query($req);
	$l=$bd->fetch();
	form_resp("modifier_resp.php?id=$id","modifier","  Modifier  ",$l,true);
	
}