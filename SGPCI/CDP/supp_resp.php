<?php
include '../library/php/bd.php';
$id = $_GET['id'];

$bd = new DB();
$req = "DELETE FROM user WHERE id = $id";
$bd->query($req);
header("Location: ../CDP/?l=mon_equipe");