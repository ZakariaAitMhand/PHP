<?php
$bd = new DB();
	$req = "Select numpjt FROM projet P,client C WHERE P.numclt=C.numclt AND valide = 0";
	$bd->query($req);
	$x=$bd->nbre_lignes();
	$x=$x/10;
	if(!empty($_GET['x']))
		$d=$_GET['x']*10;
	else 
		$d=0;
	$cdp->affichProjet($d);
	echo "<p class='pag'><br><b>Page : </b>";
	for($i=0;$i<$x;$i++){
		$j=$i+1;
		echo "<a href=../cdp/?x=$i class='pagination'>$j</a>  ";
	}
	echo "</p>";