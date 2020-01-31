<?php
if(isset($_SESSION['MANAGER'])){
	?>
	<h1 id="container_title">Modify Customer Information:</h1>
	<?php
	include 'classes/bd.php';
	include'classes/customer.php';
	include'classes/user.php';
	$phone=0;
	$phone2=0;
	$phone1=0;
	$iderr	=0;
	if(isset($_POST['custid'])){
		$id 	= $_POST['custid'];	
		$_SESSION['custid']	= $id;
	}
	else
		$id 	= $_SESSION['custid'];

	if(!preg_match("/^[0-9]{5}$/", $id))
			$iderr=1;
			
	if(strlen($id)==5 or !$iderr){
		$user = new user();
		$bd = new DB();
		$cust = new customer($id);
		if(!$cust->customer_exist($id)){
			$_SESSION['custid'] = -1;
			$_SESSION['custid2'] = $_POST['custid'];
			$_SESSION['custid3'] = "Unexisting ID !";
			$destination = "?page=cust_del";
		}
		else{
			
			$user->search_customer($cust);
			$_SESSION["char"] = "customer_delete";
			$_SESSION["delfname"] 	= $cust->get("Fname");
			$_SESSION["dellname"] 	= $cust->get("Lname");
			$_SESSION["deladdress"] = $cust->get("address");
			$_SESSION["delphone"] 	= $cust->get("phone");
			$user->delete_customer($cust);
			$destination = "?page=info";
			
		}
	}
	else{
		$_SESSION['custid'] = -1;
		if(isset($_POST['custid']))
			$_SESSION['custid2'] = $_POST['custid'];
		$_SESSION['custid3'] = "(Invalid ID Length)";
		$destination = "?page=cust_del";
	}
	header("Location: ".$destination);
	}
else
	header("Location: ./");
?>