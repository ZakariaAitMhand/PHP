<?php
if(isset($_SESSION['MANAGER'])){
?>
<?php
	include 'classes/bd.php';
	include 'classes/title.php';
	include 'classes/reservation.php';
	$N=0;
	$custid=$_SESSION["custid"];
	// echo $custid; exit(0);
	if(isset($_POST ["choice"])){
		$x = $_POST ["choice"];
		$N = sizeof($x);
	}
	if($N!=0){
		for($i=0;$i<$N;$i++){
			$reservation=new reservation($x[$i]);
			$reservation->delete_me();
		}
	}else{
		$_SESSION["unselected"]=1;
		// echo "?page=proc_charge2";	
		
	}
header("Location: ?page=cancel_reservation2");

	// unset($_SESSION["custid"]);
}
else
	header("Location: ./");
?>