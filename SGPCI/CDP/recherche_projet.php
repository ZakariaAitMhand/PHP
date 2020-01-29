<?php
//include "../library/php/bd.php";
//include "../library/php/functions.php";
$bd = new DB();
$np = $_GET['np'];
$valid = 0;
$req = "SELECT 	* 
		FROM 	projet P, client C
		WHERE 	P.numclt=C.numclt
		AND		(numpjt 		like '%".$np."%'
		OR		description like '%".$np."%'
		OR		nomste	 	like '%".$np."%'
		OR		nompjt 		like '%".$np."%')
		GROUP BY (numpjt)
		ORDER BY  (debut) desc";
$bd->query($req);
$nb = $bd->nbre_lignes();
if($nb==0){
		?>
		<script language="javascript">
		alert("Aucun resultat n'est trouvé !!");
		window.location = "index.php";
		</script>	
		<?php 
}
projet_affichage($valid,0,$req);

