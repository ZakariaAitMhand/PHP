<?php
if(isset($_SESSION['MANAGER'])){
?>
	<h1 id="container_title">Process Reservation:</h1>
	<?php
		include 'classes/user.php';
		include 'classes/copy.php';
		include 'classes/title.php';
		include 'classes/bd.php';
		$user = new user();
		$_SESSION["custid"]=$_POST["custid"];
		$bd = new DB();
		$titles = $user->report_title();
		$N		 = sizeof($titles);
		$flag=0;
		for($i=0;$i<$N;$i++){
			$c =new copy(0,$titles[$i]->get("id"),0,0,1);
			if($titles[$i]->available_copies($c)==0)
				$flag=1;
		}
		if($flag){
		// echo $flag;
	?>

	<fieldset id="authenticate">
		<form class="form" method="post" action="?page=proc_reservation3">
			<table border=0 id ="tbl3">
				<tr>
					<td class="tl"></td>
					<td class="tl">Title </td>
					<td class="tl">Year </td>
					<td class="tl">Description </td>
					<td class="tl">Type </td>
				</tr>
				<?php
				for($i=0;$i<$N;$i++){
				?><?php	$c =new copy(0,$titles[$i]->get("id"),0,0,1);
					
					if($titles[$i]->available_copies($c)==0){?>
				<tr>
					<td><center><input class="check" style="width:auto;" type="checkbox" name="choice[]" value="<?php echo $titles[$i]->get("id");?>"></center></td>
					<td><?php echo $titles[$i]->get("name"); ?></td>
					<td><?php echo $titles[$i]->get("year"); ?></td>
					<td><?php echo $titles[$i]->get("description"); ?></td>
					<td><?php echo $titles[$i]->get("genre"); ?></td>
				</tr>
				<?php }}?>
			</table>
			<input type="submit" value="Process" class="bt">
			<input type="reset" value="Cancel" class="bt">
		</form>
</fieldset>
<?php
	}else{
		?><fieldset id="authenticate">
		<div style="color:red; font-size:14px; font-weight:bold; text-align:left; font-family:monospace;text-align: center;">
					Operation is denied: All titles have at least one available copy !</div>
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