<?php
include 'classes/bd.php';
include 'classes/charge.php';
$N=0;
if(isset($_POST ["choice"])){
	$x=$_POST ["choice"];
	$N = sizeof($x);
}
if($N!=0){
	for($i=0;$i<$N;$i++){
		$charge=new charge($x[$i]);
		$charge->pay_me();
	}
}else{
	$_SESSION["unselected"]=1;
	// echo "?page=proc_charge2";	
}
header("Location: ?page=proc_charge2");
?>