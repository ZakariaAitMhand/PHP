<?php

/*session_start();
include "../functions.php";
include "../bd.php";*/
$np = $_SESSION['np'];
$bd = new DB();
$req = "SELECT debut, fin
	FROM	projet
	WHERE	numpjt = '".$np."'";
$bd->query($req);
$ligne = $bd->fetch();
$debut = $ligne['debut'];
$fin   = $ligne['fin'];
$duree = date_difference($debut,$fin)/8;

$req = "SELECT 	pourcentage, debut, fin, date_validation
		FROM	usertacheprojet, projet
		WHERE	projet_id = '".$np."'
		AND 	numpjt = projet_id
		AND 	validation = 1
		ORDER BY (date_validation)";
$bd->query($req);
$i=0;
if($bd->nbre_lignes()!=0){
	while($l = $bd->fetch()){
		$pourcentage[$i] = $l['pourcentage'];
		$jour_tache[$i] = date_difference($l['debut'],$l['date_validation'])/8;
		$jour_projet = date_difference($l['debut'],$l['fin'])/8;
		$date_v = $l['date_validation'];
		$i++;
	}
	//////// addition du porurcentage d'une date a une autre
			for($i=0;$i<$duree;$i++){
				$jour[$i]= $i+1;
			}
			$x = count($pourcentage);
			for($i=$x-1;$i>=1;$i--){
				for($j=$i-1;$j>=0;$j--){
				}	
			}
	////////
	$max=max($jour_tache);
	$montest=0;
	for($i=0;$i<=$max;$i++)
		$montab[$i]=0;
	for($i=0;$i<$x;$i++){
			for($j=$i;$j<$x;$j++){	
				if( isset($jour_tache[$i]) && ($jour_tache[$i]==$jour_tache[$j])){
					$var=$jour_tache[$i];
					$montab[$var] +=$pourcentage[$j];
					$jour_tache[$j]=0;
				}
			}
	
	}
	for($i=1;$i<$max;$i++) {
		$montab[$i+1]=$montab[$i]+$montab[$i+1];
	}
	for($i=0;$i<$max;$i++) {
		$montab[$i]=$montab[$i+1];
	}
	unset($montab[$max]);
	$dff = date_difference($date_v,date('Y-m-d'))/8;
	//echo $dff;
	for($i=$max;$i<($max+$dff);$i++) {
		if($montab[$max-1] != 100)
			$montab[$i]=$montab[$i-1];
	}
}
else{
	$x = date_difference($debut,date("Y-m-d"))/8;
	for($i=0;$i<$x;$i++)
	$montab[$i]=0;
	$max = 1;
}