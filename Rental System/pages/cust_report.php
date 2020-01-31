<?php
if(isset($_SESSION['MANAGER'])){
?>
	<h1 id="container_title">All Customer Report:</h1>
	<?php
		include 'classes/user.php';
		include 'classes/copy.php';
		include 'classes/rental.php';
		include 'classes/title.php';
		include 'classes/customer.php';
		include 'classes/bd.php';
		$user = new user();

		$bd = new DB();
		$cust = $user->report_customers();
		$N		 = sizeof($cust);
		// echo $N."---------";
	?>

	<fieldset id="authenticate">
		<table border=0 id ="tbl3">
			<tr>
				<td class="tl">Customer ID </td>
				<td class="tl">First Name </td>
				<td class="tl">Last Name </td>
				<td class="tl">Address </td>
				<td class="tl">Phone </td>
				<td class="tl">Number of Rentals </td>
			</tr>
			<?php
			for($i=0;$i<$N;$i++){
			?>
			<tr>
				<td><?php echo $cust[$i]->get("id"); ?></td>
				<td><?php echo $cust[$i]->get("Fname"); ?></td>
				<td><?php echo $cust[$i]->get("Lname"); ?></td>
				<td><?php echo $cust[$i]->get("address"); ?></td>
				<td><?php echo $cust[$i]->get("phone"); ?></td>
				<?php $rent= new rental();?>
				<td><?php echo $rent->rentals_number($cust[$i]->get("id")); ?></td></td>
			</tr>
			<?php } ?>
		</table>
	</fieldset>
<?php
}
else
	header("Location: ./");
?>