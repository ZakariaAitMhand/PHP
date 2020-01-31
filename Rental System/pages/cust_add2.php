<?php
if(isset($_SESSION['MANAGER'])){

	include 'classes/bd.php';
	include'classes/customer.php';
	include'classes/user.php';

	$id 	= $_POST['custid'];
	$Fname 	= $_POST['Fname'];
	$Lname 	= $_POST['Lname'];
	$address= $_POST['address'];
	$phone 	= $_POST['phone'];

	$_SESSION['custid']		= $_POST['custid'];
	$_SESSION['custFname']  = $_POST['Fname'];
	$_SESSION['custLname']  = $_POST['Lname'];
	$_SESSION['address']	= $_POST['address'];
	$_SESSION['phone']  	= $_POST['phone'];
	$ph=1;
	if(!preg_match("/^[0-9]{10}$/", $phone))
		$ph=0;
	$identifier=1;
	if(!preg_match("/^[0-9]{5}$/", $id))
		$identifier=0;
	if($identifier==1 and strlen($id)==5 and $Fname!="First Name" and $Lname!="Last Name" and $address!="Address" and $phone!="Phone Number" and $ph==1){
		$user = new user();
		$bd = new DB();
		$cust = new customer($id, $Lname, $Fname, $address, $phone);
		if($cust->customer_exist($id)){
			$_SESSION['custid'] = -1;
			$_SESSION['custid2'] = $_POST['custid'];
			$_SESSION['custid3'] = "(Duplicated ID)";
			$destination = "?page=cust_add";
			header("Location: ".$destination);
			exit(0);
		}
		$user->add_customer($cust);
		$_SESSION["char"] = "customer";
		$destination = "?page=info";
	}	
	else{
		if(strlen($id)!=5 or $identifier==0){
			$_SESSION['custid'] = -1;
			$_SESSION['custid2'] = $_POST['custid'];
		}
		else
			$_SESSION['custid'] = $_POST['custid'];
		
		if($Fname=="First Name"){
			$_SESSION['custFname']  =-1;
			$_SESSION['custFname2']  = $_POST['Fname'];
		}
		else
			$_SESSION['custFname']  = $_POST['Fname'];
		
		if($Lname=="Last Name"){
			$_SESSION['custLname']  =-1;
			$_SESSION['custLname2'] = $_POST['Lname'];
		}
		else
			$_SESSION['custLname']  = $_POST['Lname'];
		
		if($address=="Address"){
			$_SESSION['address']=-1;
			$_SESSION['address2']=$_POST['address'];
		}
		else
			$_SESSION['address']= $_POST['address'];
		

		if($phone=="Phone Number" or $ph==0 or strlen($phone)!=10){
			$_SESSION['phone']  =-1;
			$_SESSION['phone2']  =$_POST['phone'];
		}
		else
			$_SESSION['phone']  = $_POST['phone'];
		
		$destination = "?page=cust_add";
	}
	header("Location: ".$destination);
}
else
	header("Location: ./");
?>