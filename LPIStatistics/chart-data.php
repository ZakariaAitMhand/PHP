<?php

include_once( 'ofc-library/open-flash-chart.php' );
include_once('histo_bd.php');
srand((double)microtime()*1000000);
// nombre de promotion
$x=4;

$bar_red = new bar_3d( 75, '#D54C78' );
$bar_red->key( 'recherche', 10 );

// add random height bars:
for( $i=0; $i<$x; $i++ )
  $bar_red->data[] = intval($st[0][$i]);

//
// create a 2nd set of bars:
//
$bar_blue = new bar_3d( 75, '#3334AD' );
$bar_blue->key( 'travail', 10 );

// add random height bars:
for( $i=0; $i<$x; $i++ )
  $bar_blue->data[] = intval($st[1][$i]);

//
// create a 3rd set of bars:
//

$bar_gr = new bar_3d( 75, '#93BB3E' );
$bar_gr->key( 'etudes', 10 );

// add random height bars:
for( $i=0; $i<$x; $i++ )
  $bar_gr->data[] = intval($st[2][$i]);


// create the graph object:
$g = new graph();
$g->title( 'Statistiques LPI Meknes', '{font-size:20px; color: #FFFFFF; margin: 5px; background-color: #336666; padding:5px; padding-left: 20px; padding-right: 20px;}' );

//$g->set_data( $data_1 );
//$g->bar_3D( 75, '#D54C78', '2006', 10 );

//$g->set_data( $data_2 );
//$g->bar_3D( 75, '#3334AD', '2007', 10 );

$g->data_sets[] = $bar_red;
$g->data_sets[] = $bar_blue;
$g->data_sets[] = $bar_gr;

$g->set_x_axis_3d( 12 );
$g->x_axis_colour( '#909090', '#ADB5C7' );
$g->y_axis_colour( '#909090', '#ADB5C7' );
$g->set_x_labels( $promotion );
$g->set_y_max( 30 );
$g->y_label_steps( 15 );
$g->set_y_legend( "Nombre d'etudiants", 12, '#736AFF' );
echo $g->render();
?>