<?php
if($_SESSION['grade'] != "tech"){
	header("Location: ../index.php");
}
else{
	$id=$_SESSION['id'];
	$tech = new technicien(1);
	$bd = new DB();
	$req = "SELECT tache_id FROM usertacheprojet WHERE user_id = $id AND validation = 1";
	$bd->query($req);
	$x=$bd->nbre_lignes();
	$x=$x/10;
	if(!empty($_GET['x']))
		$d=$_GET['x']*10;
	else 
		$d=0;
	if(!empty($_GET['x']))
		$d=$_GET['x']*10;
	else 
		$d=0;
	$tech->affiche_projet($d,$id,1);
	echo "<br><p class='pag'><b>Page : </b>";
	for($i=0;$i<$x;$i++){
		$j=$i+1;
		echo "<a href=index.php?l=historique&x=$i class='pagination'>$j</a>  ";
	}
		echo "</p>";
}