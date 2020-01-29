<?php
include_once 'ofc-library/open_flash_chart_object.php';
if(isset($_SESSION['size']))
	$size = $_SESSION['size'];
else
	$size = 10;
$s = 100;
if($size>5)
	$s = 50;
if($size>10)
	$s =22;
else if($size>30)
	$s =13;	
open_flash_chart_object( $size*$s, 300, '../library/php/graphe/graphe-data.php' );
?>