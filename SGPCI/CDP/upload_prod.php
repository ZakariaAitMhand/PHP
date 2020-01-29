<?php
if($_SESSION['grade'] != "CDP"){
	header("Location: ../index.php");
}
else{
	$np = $_GET['np'];
	
	$x = explode("-",$np);
	$nump = implode("",$x);
	$nump .= "/dev/";
	
	$bd = new DB();
	$d  = new DB();
	
	$req = "SELECT dossier FROM projet p, client c WHERE p.numclt = c.numclt AND numpjt='".$np."'";
	$bd->query($req);
	$l = $bd->fetch();
	$dev = $l['dossier'];
	$dev .= $nump;
	$req = "SELECT id_tache, libelle_tache
			FROM tache";
	$bd->query($req);
	echo "<table>";
	while($l = $bd->fetch()){
		$req = "SELECT fichier_prod, nom, prenom
				FROM usertacheprojet, user
				WHERE user_id = id
				AND tache_id = ".$l['id_tache']."
				AND projet_id = '".$np."'";
		$d->query($req);
		$nbre = $d->nbre_lignes();
		if($nbre != 0)
			echo "<tr><th>".$l['libelle_tache']."</th>";
		echo "<td>";
		while($data = $d->fetch()){
				echo $data['nom']."-".$data['prenom']." : <a href='".$dev.$data['fichier_prod']."'> ".$data['fichier_prod']."</a><br>";
		}	
		echo "</td></tr>";
	}
	echo "</table>";
}