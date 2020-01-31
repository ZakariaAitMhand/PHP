<?php
if(isset($_SESSION['MANAGER'])){
?>
<?php
	include 'classes/user.php';
	include 'classes/customer.php';
	include 'classes/title.php';
	include 'classes/copy.php';
	include 'classes/charge.php';
	include 'classes/bd.php';
	
	$user= new user();
	$charge= new charge();
	$c=$user->list_charge($charge);
	$N=sizeof($c);
	// echo $N;
	if($c>0){
		?>


<h1 id="container_title">List Late Charges:</h1>
		<fieldset id="authenticate">
			<table border=0 id ="tbl3">
				<tr>
					<td class="tl">Title Name: </td><td class="tl">Copy ID: </td><td class="tl">Customer: </td><td class="tl">Charge Amount : </td> 
				</tr>
				<?php
				for($i=0;$i<$N;$i++){
					$t= new title($c[$i]->get("t_id"));
					$user->search_title($t);
					$cust= new customer($c[$i]->get("ct_id"));
					// echo $c[$i]->get("t_id")."----";
					$user-> search_customer($cust);
				?>
				<tr>
					<td><?php echo $t->get("name"); ?></td>
					<td><?php echo $t->get("id")."-".$c[$i]->get("id"); ?></td>
					<td><?php echo $cust->get("Fname")."&nbsp".$cust->get("Lname");?></td>
					<td><?php echo $c[$i]->get("amount"); ?></td>
					
				</tr>
				<?php } ?>
			</table>
		</fieldset>

<?php
	}
	else{
		?><fieldset id="authenticate">
		<div style="color:red; font-size:14px; font-weight:bold; text-align:left; font-family:monospace;text-align: center;">
					There is no late charges !</div>
		<form class="form" method="post" action="./">
			<input type="submit" value="Back" class="bt">
		</form>
		</div>
		</fieldset>
		<?php
	}
}
else
	header("Location: ./");
?>