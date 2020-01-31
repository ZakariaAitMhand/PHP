<?php
if(isset($_SESSION['MANAGER'])){
?>
	<h1 id="container_title">Cancel Reservation:</h1>
	<?php
		include 'classes/user.php';
		include 'classes/reservation.php';
		include 'classes/customer.php';
		include 'classes/title.php';
		include 'classes/bd.php';
		$user = new user();
		$bd = new DB();
		
		$_SESSION["custid"]=$_POST["custid"];
		$custid = $_SESSION["custid"];
		$cust = new customer();
		echo $cust->customer_exist($custid);
		if($cust->customer_exist($custid)){
			$reservation = new reservation(0,0,$custid);
			// echo $reservation->get("ct_id");
			// echo "<br>-------".$custid;
			$res = $reservation->select_reservation();
			$N		 = sizeof($res);
			if($res!=0){
		?>

		<fieldset id="authenticate">
			<form class="form" method="post" action="?page=cancel_reservation3">
				<table border=0 id ="tbl3">
					<tr>
						<td class="tl"></td>
						<td class="tl">Title </td>
						<td class="tl">Year </td>
						<td class="tl">Description </td>
						<td class="tl">Genre </td>
					</tr>
					<?php for($i=0; $i<$N;$i++){
							$t =new title($res[$i]->get("t_id"));
							$t->search_me();
					?>
					<tr>
						<td><center><input class="check" style="width:auto;" type="checkbox" name="choice[]" value="<?php echo $res[$i]->get("id");?>"></center></td>
						<td><?php echo $t->get("name"); ?></td>
						<td><?php echo $t->get("year"); ?></td>
						<td><?php echo $t->get("description"); ?></td>
						<td><?php echo $t->get("genre"); ?></td>
					</tr>
					<?php }?>
				</table>
				<input type="submit" value="Delete" class="bt">
				<input type="reset" value="Cancel" class="bt">
			</form>
	</fieldset>
	<?php
		}else{
			?><fieldset id="authenticate">
			<div style="color:red; font-size:14px; font-weight:bold; text-align:left; font-family:monospace;text-align: center;">
						Operation is denied: This Customer has no reservations !</div>
			<form class="form" method="post" action="?page=cancel_reservation">
				<input type="submit" value="Back" class="bt">
			</form>
			</div>
			</fieldset>
			<?php
		}
	}else{
		$_SESSION["id"]=-1;
		header("Location: ?page=cancel_reservation");
	}
}
else
	header("Location: ./");
?>