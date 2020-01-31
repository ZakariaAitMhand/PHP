<?php
if(isset($_SESSION['MANAGER'])){

	include 'classes/user.php';
	include 'classes/customer.php';
	include 'classes/rental.php';
	include 'classes/bd.php';
	

	$id    = $_SESSION["custid"];
	$rdate = $_SESSION["rdate"];
	$nb	   = $_SESSION["j"];
	
	$user= new user();
	$i=0;$t[0]=0;
	while($i<$nb){
		$i++;
		list($t[$i],$cp[$i]) = explode("-",$_POST["copy$i"]);
		$r= new rental(0,$t[$i],$cp[$i],0,0,0,$rdate);
		// echo $c->get("id")."<br>";
		$user->record_return($r);
	}
	
	$_SESSION["cps"]=$cp;
	$_SESSION["ts"]=$t;
	$_SESSION["char"]="rec_return";
	
	$destination = "./?page=info";
	header("Location: ".$destination);
}
else
	header("Location: ./");	
?>