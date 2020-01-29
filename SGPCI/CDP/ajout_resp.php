<?php
include '../library/php/bd.php';
include 'CDP.php';

$cdp = new CDP();
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$gsm = $_POST['gsm'];
$mail = $_POST['mail'];
$log = $_POST['login'];
$pass = $_POST['pass'];
$grade = $_POST['grade'];
$cdp->ajout_responsable($nom,$prenom,$gsm,$mail,$log,$pass,$grade);
header("Location: ../CDP/?l=mon_equipe");