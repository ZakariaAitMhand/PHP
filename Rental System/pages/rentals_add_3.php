<?php
if(isset($_SESSION['MANAGER'])){

	include 'classes/user.php';
	include 'classes/customer.php';
	include 'classes/title.php';
	include 'classes/copy.php';
	include 'classes/rental.php';
	include 'classes/bd.php';
	
	$id    = $_SESSION["custid"];
	$rdate = $_SESSION["rdate"];
	$bdate = $_POST["back"];
	$nb	   = $_SESSION["j"];
	
	$user= new user();
	$cust =new customer($id);
	$i=0;
	while($i<$nb){
		$i++;
		$name[$i] = $_POST["name$i"];
		$t= new title(0,$name[$i],0,0,0);
		$user->search_title($t);
		// echo $t->get("id")."<br>";
		$c= new copy(0,$t->get("id"));
		$c->get_ID();
		// echo $c->get("id")."<br>";
		$c->rent();
		$r= new rental(0,$t->get("id"),$c->get("id"),$cust->get("id"),$rdate,$bdate);
		$user->add_rental($r);
	}
	
	$_SESSION["names"]=$name;
	$_SESSION["rdate"]=$rdate;
	// echo $rdate;exit(0);
	$_SESSION["bdate"]=$bdate;
	$_SESSION["char"]="rent_add";
	
	$destination = "./?page=info";
	header("Location: ".$destination);
}
else
	header("Location: ./");
?>