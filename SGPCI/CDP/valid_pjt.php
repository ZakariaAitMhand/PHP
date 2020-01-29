<?php
include '../library/php/functions.php';
include '../library/php/bd.php';
include 'CDP.php';

$np = $_GET['np'];
$cdp = new CDP(1);
$destination = $cdp->valider_projet($np);
header('Location: '.$destination);