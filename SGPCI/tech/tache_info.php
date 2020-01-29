<?php
if($_SESSION['grade'] != "tech"){
	header("Location: ../index.php");
}
else{
	$id = $_GET['us'];
	$np = $_GET['np'];
	$th = $_GET['th'];
	$bd = new DB();
	$req = "SELECT *
			FROM tache, projet p, user u, client c, usertacheprojet utp
			WHERE u.id = utp.user_id
			AND p.numclt = c.numclt
			AND tache_id = id_tache
			AND p.numpjt = utp.projet_id
			AND u.id = $id
			AND p.numpjt = '".$np."'
			AND id_tache=$th";
	$bd->query($req);
	echo "<table border=1>
			<tr>
				 <th>Numéro de dossier</th>
				 <th>Projet</th>
				 <th>Chemin</th>
				 <th>Tache à faire</th>
				 <th>Client</th>
				 <th>date debut</th>
				 <th>date fin</th>
			</tr>";
	while ($l = $bd->fetch()){
		$x=explode("-",$l['numpjt']);
		$dossier=implode("",$x);
		$chemin=$l['dossier']."$dossier";
		echo "<tr>
				  <td>".$dossier."</td>
				  <td>".$l['nompjt']."</td>
				  <td>".$chemin."</td>
				  <td>".$l['libelle_tache']."</td>
				  <td>".$l['nomste']."</td>
				  <td>".$l['debut']."</td>
				  <td>".$l['fin']."</td>
			  </tr>";
	}
	echo "</table><br>";
}