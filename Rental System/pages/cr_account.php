<?php
session_start();
if(isset($_SESSION['MANAGER'])){
	include '../classes/user.php';
	include '../classes/bd.php';
	$Lname = $_POST["Lname"];
	$Fname = $_POST["Fname"];
	$pass = $_POST['pass'];
	$log = $_POST['login'];
	$manager = $_POST['manager'];
	$user = new user(0,$Lname,$Fname);
	$bd = new DB();
	$user->add_account($log,$pass,$manager);
	$_SESSION["char"]="account";
	header("Location: ../?page=info");
}
?>