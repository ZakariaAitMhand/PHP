<?php
include_once 'ofc-library/open_flash_chart_object.php';
$np = $_GET['np'];
open_flash_chart_object( 350, 300,'../library/php/graphe/histo-data.php?np='.$np );
?>