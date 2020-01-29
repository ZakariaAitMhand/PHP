<?php
//srand((double)microtime()*1000000);
include '../bd.php';
$y_lab="heures";
$bd = new DB();
$np=$_GET['np'];
$req = "SELECT sum( nbre_h )
		FROM usertacheprojet
		WHERE projet_id = '".$np."'
		GROUP BY (tache_id)";

$i=0;
$bd->query($req);
$m=0;
while($l = $bd->fetch()){
	$data_1[$i] = $l['sum( nbre_h )'];
	$i++;
	$m+=$l['sum( nbre_h )'];
}
$max = max($data_1);
if($max==0)
$max=10;
elseif(gettype($max/2) != "integer")
$max=max($data_1)+1;
else
$max=max($data_1);
if ($max >= 48){
	if (gettype($max/8) != 'integer'){
		$max /= 8;
		$max++;
		if(gettype($max/2) != "integer")
		$max++;
	}
	else
		$max /= 8;
	$y_lab = "jours";
	for( $i=0; $i<5; $i++ ){
		$data_1[$i] /= 8;
	}
}
//$data_1 = array();
/*for( $i=0; $i<5; $i++ ){
$data_1[$i]=rand(0,20);
}*/
include_once( 'ofc-library/open-flash-chart.php' );
$g = new graph();
if ($y_lab=="jours")
 $ch="de ";
else
 $ch="d'";
$g->title( "Nombre ".$ch.$y_lab." par tache",16,"0x736AFF");

$g->set_data( $data_1 );

$g->bar_filled( 50, '0xED8745', '0xCC6600', "Nembre ".$ch.$y_lab, 10 );

$g->set_x_labels( array("Dev","CSS","e-mail","Flash","Design"));
$g->set_x_label_style( 10, '0x000000', 0, 2 );

$g->set_y_max( $max );
$g->y_label_steps( $max/2 );
$g->set_y_legend( $y_lab.' de travail', 12, '0x736AFF' );
$g->set_x_legend( 'tache', 12, '0x736AFF' );
echo $g->render();

?>