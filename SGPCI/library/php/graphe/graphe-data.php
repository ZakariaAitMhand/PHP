<?php
session_start();

include "../bd.php";
include "../functions.php";
include 'graph-bd.php';

$data_1 = array();
$data_2 = array();
$max_y = 100;
for( $i=0; $i<$duree; $i++ ){
	$data_x[$i] = $i+1;
	$data_1[$i]=($max_y/$duree)*$data_x[$i];
}
if($montab[0]=="" && $montab[0]!=0 ){
	$req = "SELECT 	pourcentage
		FROM	usertacheprojet
		WHERE	projet_id = '".$np."'
		AND 	validation = 1
		ORDER BY (date_validation)";
	$montab[0]=0;
	$bd->query($req);
	while($k =$bd->fetch())
	$montab[0]+= $k['pourcentage'];
}
$data_2 = $montab;
$_SESSION['size'] = $duree;
include_once( 'ofc-library/open-flash-chart.php' );
$g = new graph();
$g->title( '  Courbe de progression du projet', 16,'0x736AFF' );


$g->set_data( $data_1 );
$g->set_data( $data_2 );


$g->line_dot( 3, 5, '0xED8745', 'Progression normale', 10);
$g->line_hollow( 2, 4, '0x799191', 'Progression reelle', 10 );

$g->set_x_labels( $data_x);
$g->set_x_label_style( 10, '0x000000', 0, 2 );


$g->set_y_max( $max_y );
$g->y_label_steps( 5 );
$g->set_y_legend( 'Purcentage', 12, '0x736AFF' );
$g->set_x_legend( 'temps par jours', 12, '0x736AFF' );
echo $g->render();
?>