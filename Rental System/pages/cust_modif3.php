<?php
if(isset($_SESSION['MANAGER'])){

	include 'classes/bd.php';
	include'classes/customer.php';
	include'classes/user.php';

	$id 	= $_SESSION['custid'];
	$Fname	=$_POST['Fname'];	
	$Lname	=$_POST['Lname'];
	$address=$_POST['address'];
	$phone	=$_POST['phone'];
	$ph=1;
	if(!preg_match("/^[0-9]{10}$/", $phone))
		$ph=0;
		
	if($ph==1){
		$user = new user();
		$bd = new DB();
		$cust = new customer($id, $Lname, $Fname, $address, $phone);
		$user->modify_customer($cust);

		$_SESSION["char"] = "customer_modif";
		$destination = "?page=info";
	}	
	else{
		$_SESSION['phone']    = -1;
		$_SESSION['phone2']   = $_POST['phone'];
		$_SESSION['Fname2']   = $_POST['Fname'];
		$_SESSION['Lname2']   = $_POST['Lname'];
		$_SESSION['address2'] = $_POST['address'];
		$destination = "?page=cust_modif2";
	}
	if(isset($_SESSION['Fname2']))
		unset($_SESSION['Fname2']);
	if(isset($_SESSION['Lname2']))
		unset($_SESSION['Lname2']);
	if(isset($_SESSION['address2']))
		unset($_SESSION['address2']);
	if(isset($_SESSION['phone2']))
		unset($_SESSION['phone2']);
	if(isset($_SESSION['phone']))
		unset($_SESSION['phone']);
				
	header("Location: ".$destination);
}
else
	header("Location: ./");
?>