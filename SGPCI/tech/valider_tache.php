<?php
session_start();
include '../library/php/bd.php';
include '../library/php/functions.php';
include 'technicien.php';

$th = new technicien(01);
$t = (int)$_GET['th'];
$id = (int)$_GET['id'];
$np = $_GET['np'];
$nbre_h = (int)$_POST['nbre_h'];

$destination = "../TECH/";
$th->validation_tache($nbre_h,$t,$id,$np);
header("Location: $destination");