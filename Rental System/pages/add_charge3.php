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
	
	$id    = $_SESSION["custid"];
	$amount= $_POST["amount"];
	
	$user= new user();
	$cust =new customer($id);
	list($name,$t_id,$c_id) = explode("-",$_POST["copy"]);
	$t= new title($t_id,0,0,0,0);
	$user->search_title($t);
	$cp= new copy($c_id);
	$c= new charge(0,$cp->get("id"),$t->get("id"),$cust->get("id"),$amount);
	$user->add_charge($c);
?>


<h1 id="container_title">Returned Items:</h1>
		<fieldset id="authenticate">
			<table border=0 id ="tbl">
				<tr>
					<td class="tl">Title Name: </td><td class="tl">Copy ID: </td><td class="tl">Charge Amount : </td> 
				</tr>
				<?php
					$title= new title($t_id);
					$title->search_me();
				?>
				<tr>
					<td><?php echo $title->get("name"); ?></td>
					<td><?php echo $t_id."-".$c_id; ?></td>
					<td><?php echo $amount; ?></td>
					
				</tr>
			</table>
		</fieldset>

<?php
}
else
	header("Location: ./");
?>