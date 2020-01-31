<?php
if(isset($_SESSION['MANAGER'])){
?>
<h1 id="container_title">Process Late Charge:</h1>
<?php
	include 'classes/user.php';
	include 'classes/title.php';
	include 'classes/charge.php';
	include 'classes/copy.php';
	include 'classes/bd.php';
	$nb   = 1;
	if(isset($_SESSION["custid"]))
		$custID = intval($_SESSION["custid"]);
	$nbre=0; $id=0;
	if(isset($_POST["custid"])){
		$_SESSION["custid"]=$_POST["custid"];
		$custID = intval($_POST["custid"]);
	}
	if(!preg_match("/^[0-9]{5}$/", $custID))
		$id=1;
	if(!$id){
		$user = new user();
		$charg = new charge(0,0,0,$custID);
		$N= $charg->count_charges();
		
		// echo $charg->get("ct_id")."----";
		// echo $charge->count_charges(); exit(0);
		
			?>
			<fieldset id="authenticate">
			<?php 
			if($N>0){
				$c = $charg->get_latecharges();
				$x=0;
				if(isset($_SESSION["unselected"]))
					$x=1;
				?>
					<form class="form" method="post" action="?page=proc_charge3">
					<?php if($x){?> <div style="color:red; font-size:11px; font-weight:lighter; text-align:left; margin-left: 47px; font-family:monospace;">
					<?php if($x) echo 'No copy is selected !</div>';}?>
					<center><table  border=1 style="font-size:14px" id="tbl"><tr><td class="tl"></td><td class="tl">Title</td><td class="tl">copy ID</td><td class="tl">amount</td></tr>
					<?php $i=0; while($i<$N){
							$t = new title($c[$i]->get("t_id"));
							$t->search_me();
					?><tr><td>
						<input class="check" type="checkbox" name="choice[]" value="<?php echo $c[$i]->get("id");?>"></td><td><?php echo "&nbsp&nbsp&nbsp".$t->get("name");?></td><td> <?php echo $c[$i]->get("t_id")."-".$c[$i]->get("cp_id");?></td> <td> <?php echo $c[$i]->get("amount");?></td>
					<?php $i++;}?>
					</table></center>
						<input type="submit" value="Process" class="bt">
						<input type="reset" value="Cancel" class="bt">
			
					</form>
	<?php }
					else{
					$us = new user($custID);
					$us-> search_me();
			?>
			<div style="color:red; font-size:14px; font-weight:bold; text-align:left; font-family:monospace;text-align: center;">
						<?php echo "\"".$us->get("Fname")."&nbsp".$us->get("Lname")."\"";?> does not have any late charges !</div>
			<form class="form" method="post" action="?page=proc_charge">
				<input type="submit" value="Back" class="bt">
			</form>
			<?php
				if(isset($_SESSION["custid"]))
					unset($_SESSION["custid"]);
				if(isset($_SESSION["custerror"]))
					unset($_SESSION["custerror"]);
					}
			?>
			</fieldset>
			<?php
			if(isset($_SESSION["unselected"]))
				unset($_SESSION["unselected"]);
			
	}
	else{
		$_SESSION["custerror"]=-1;
		
		header("Location: ?page=add_charge");
	}
}
else
	header("Location: ./");
?>