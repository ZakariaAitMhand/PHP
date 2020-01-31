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
			$reservation=new reservation(0,$x[$i],$custid);
			// echo $reservation->get("t_id").$reservation->get("ct_id").$custid;
			$priority = $reservation->get_priority();
			$reservation->set("priority",$priority);
			$reservation->add_me();
				
?>


<h1 id="container_title">Process Reservation:</h1>
		<fieldset id="authenticate"><legend>&nbsp&nbspTitle Reserved&nbsp&nbsp</legend>
			<table border=0 id ="tbl3">
				<tr>
					<td class="tl">Title Name: </td><td class="tl">Year: </td><td class="tl">Description : </td> <td class="tl">Genre : </td>
				</tr>
				<?php
					for($i=0;$i<$N;$i++){
						$title= new title($x[$i]);
						$title->search_me();
					?>
					<tr>
						<td><?php echo $title->get("name"); ?></td>
						<td><?php echo $title->get("year"); ?></td>
						<td><?php echo $title->get("description"); ?></td>
						<td><?php echo $title->get("genre"); ?></td>
						
						
					</tr>
				<?php } ?>
			</table>
		</fieldset>
<?php
		}
	}else{
		$_SESSION["unselected"]=1;
		// echo "?page=proc_charge2";	
		header("Location: ?page=proc_reservation2");
	}

	// unset($_SESSION["custid"]);
}
else
	header("Location: ./");
?>