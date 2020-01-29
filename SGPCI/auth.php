<?php
session_start();
include'user.php';
include 'library/php/bd.php';

$user = new user(1);
$bd = new DB();
$pass = $_POST['pass'];
$log = $_POST['login'];
$destination = $user->authentifier($log,$pass);
header("Location: ".$destination);