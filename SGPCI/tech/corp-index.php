<?php
$id=$_SESSION['id'];
		$tech = new technicien(1);
		if(!empty($_GET['x']))
			$d=$_GET['x']*10;
		else 
			$d=0;
		$bd = new DB();	
		$req = "SELECT tache_id FROM usertacheprojet WHERE user_id = $id AND validation = 0";
		$bd->query($req);
		$nb = $bd->nbre_lignes();
		if($nb == 0)
			echo "<h2 style='color:green'>Vous êtes libre</h2>";
		else{
			$tech->affiche_projet($d,$id,0,false);
			echo "<br><p class='pag'><b>Page : </b>";
			$nb = $nb/10;
			for($i=0;$i<$nb;$i++){
				$j=$i+1;
				echo "<a href=../TECH/?x=$i class='pagination'>$j</a>  ";
			}
		echo "</p>";
		}