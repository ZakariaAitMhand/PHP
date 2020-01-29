<?php
session_start();
include 'library/php/formulaire.php';
include 'library/php/bd.php';
include 'user.php';
$id  = $_SESSION['id'];
$log = $_POST['login'];
$pass= $_POST['pass'];

$user = new user(1);
$bd = new DB();
$user->modifier_compte($id, $log, $pass);
$req = "SELECT grade FROM user WHERE id = $id";
$bd->query($req);
$l = $bd->fetch();
if($l['grade']=='cdp')
header("Location: CDP/");
elseif($l['grade']=='technicien')
header("Location: TECH/");
