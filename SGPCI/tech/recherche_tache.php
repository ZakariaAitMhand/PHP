<?php
if(isset($_SESSION['member'])){
	$id = $_SESSION['member'];
	$cdp = true;
}
else{ 
	$id = $_SESSION['id'];
	$cdp = false;
}
$np = $_GET['np'];
$tech = new technicien(1);
	if(!empty($_GET['x']))
		$d=$_GET['x']*10;
	else 
		$d=0;
	if(!empty($_GET['x']))
		$d=$_GET['x']*10;
	else 
		$d=0;
	$bd = new DB();	
	$req = "SELECT tache_id  FROM usertacheprojet WHERE user_id = $id";
	$bd->query($req);
	$nb = $bd->nbre_lignes();
	$x = $tech->affiche_projet($d,$id,0,$cdp,$np);
	if($x==0){
			if($cdp){
				header("Location: index.php?l=mon_equipe&res=0&resp=".$id);
				exit;
			}
			else{
				header("Location: index.php?res=0");
				exit;
			}
	}
	else{
		$x=$x/10;
		echo "<br><p class='pag'><b>Page : </b>";
		for($i=0;$i<=$x;$i++){
			$j=$i+1;
			echo "<a href=../TECH/?np=$np&rechercher=Rechercher&x=$i class='pagination'>$j</a>  ";
			}
		echo "</p>";
	}