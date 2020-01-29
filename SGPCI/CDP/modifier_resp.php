<?php
include '../library/php/bd.php';
$id = $_GET['id'];
$bd = new DB();
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$gsm = $_POST['gsm'];
$mail = $_POST['mail'];
$resp = $_POST['resp'];
$x=count($resp);


$req = "UPDATE user 
		SET nom ='".$nom."',
			prenom ='".$prenom."',
			gsm ='".$gsm."',
			mail ='".$mail."'
		WHERE id = $id";
$bd->query($req);

$req = "DELETE FROM tacheuser WHERE user_id = $id";
$bd->query($req);

for($i=0;$i<$x;$i++){
		$req = "INSERT INTO tacheuser VALUES (".$id.",".$resp[$i].")";
		$bd->query($req);
}
header("Location: ../CDP/?l=mon_equipe");