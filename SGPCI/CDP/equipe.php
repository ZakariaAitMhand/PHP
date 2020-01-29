<?php
if($_SESSION['grade'] != "CDP"){
	header("Location: ../index.php");
}
else{
	$id = $_SESSION['id'];
	$bd = new DB();
	
	$req = "Select id FROM user WHERE grade = 'technicien'";
		$bd->query($req);
		$x=$bd->nbre_lignes();
		$x=$x/10;
		if(!empty($_GET['x']))
			$d=$_GET['x']*10;
		else 
			$d=0;
			
	$cdp = new CDP($id);
	$cdp -> mon_equipe($d);
	
	echo "<br><p class='pag'><b>Page : </b>";
		for($i=0;$i<$x;$i++){
			$j=$i+1;
			echo "<a href=index.php?l=mon_equipe&x=$i class='pagination'>$j</a>  ";
		}
		echo"</p>";
}