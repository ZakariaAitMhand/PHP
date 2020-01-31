<?php
session_start();
include'classes/user.php';
include 'classes/bd.php';

$user = new user();
$bd = new DB();
$pass = $_POST['pass'];
$log = $_POST['login'];
$destination = $user->authenticate($log,$pass);
header("Location: ".$destination);
?>