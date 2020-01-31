<?php
if(isset($_SESSION['MANAGER'])){
?>
	<h1 id="container_title">Cancel Reservation:</h1>
	<?php
		include 'classes/user.php';
		include 'classes/customer.php';
		include 'classes/bd.php';
		$cust = new customer();
		$bd = new DB();
		$custs =$cust->get_allIDs();
		$N		 = sizeof($custs);
		$id=0;
		if(isset($_SESSION['id']) and isset($_SESSION['custid'])){
			$id= $_SESSION['id'];
			$id2= $_SESSION['custid'];
		}
	?>

	<fieldset id="authenticate">

		<form class="form" method="post" action="?page=cancel_reservation2">
			
			<p>
				<?php if($id==-1){?> <div style="color:red; font-size:11px; font-weight:lighter; text-align:left; margin-left: 47px; font-family:monospace;">
				<?php if(isset($_SESSION['custid'])) echo 'Wrong Customer ID !</div>';}?>
				
				
				<input type="text" id="custid" placeholder="" list="searchresults" autocomplete="off" onclick="if(this.value=='Customer ID'){this.value='';} this.style.color='#014366'; $(this).toggleClass('click');" onblur="if(this.value==''){this.value='Customer ID';} this.style.color='#7BAECC';$(this).toggleClass('click');" <?php if($id==-1) {echo 'value="'.$id2.'"';} else {echo 'value="Customer ID"';}?> name="custid" <?php if($id==-1){echo "class='txt err'";} else echo "class='txt'";?>>
				<datalist id="searchresults">
					<?php
						$i=0;
						while($i<$N){
							echo"<option>".$custs[$i]->get("id")."</option>";
							$i++;
						}
					?>
				</datalist>
			</p>
			<input type="submit" value="Validate" class="bt">
			<input type="reset" value="Cancel" class="bt">
		</form>
	</fieldset>
	<?php
		unset($_SESSION["custid"]);
		unset($_SESSION["id"]);
}
else
	header("Location: ./");
?>