<?php
if($_SESSION['grade'] != "CDP"){
	header("Location: ../index.php");
}
else{
	$bd = new DB();
	$req = "Select numpjt FROM projet P,client C WHERE P.numclt=C.numclt AND valide = 1";
	$bd->query($req);
	$x=$bd->nbre_lignes();
	if($x==0){
		?>
		<script type="text/javascript" >
			alert("L'historique est vide !!");
			window.location = "../CDP/";
		</script>
		<?php 
	}
	else{	
		$cdp = new CDP(01);
		
		$x=$x/10;
		if(!empty($_GET['x']))
			$d=$_GET['x']*10;
		else 
			$d=0;
		$cdp->historiqueProjet($d);
		echo "<br><p class='pag'><b>Page : </b>";
		for($i=0;$i<$x;$i++){
			$j=$i+1;
			echo "<a href=index.php?l=historique&x=$i class='pagination'>$j</a>  ";
		}
		echo "</p>";
	}
}