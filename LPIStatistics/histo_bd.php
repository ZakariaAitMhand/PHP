<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
<title>Untitled Document</title>
</head>

<body>
<?php
$status = array('recherche','travail','etude');
include "Connections/Connexion.php";
include "liste_promo.php";
$promotion = $s;
$nbre="";
for($i=0;$i<3;$i++){
	for($j=0;$j<count($promotion);$j++){
		$req="SELECT count(cin) FROM laureat where promo='".$promotion[$j]."' and statut='".$status[$i]."'";
		$r=mysql_query($req);
		while($line=mysql_fetch_row($r)){
			$nbre.="$line[0]";
			if($j<count($promotion)-1)
				$nbre.=":";
		}
	}
	if($i<2)
	$nbre.=" ";
}
$p=explode(" ",$nbre);
for($i=0;$i<3;$i++)
	$st[$i]=explode(":",$p[$i]);

?>
</body>
</html>


