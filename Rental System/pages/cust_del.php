<?php
if(isset($_SESSION['MANAGER'])){
?>
	<h1 id="container_title">Delete Customer:</h1>
	<?php
		// include 'classes/user.php';
		include 'classes/customer.php';
		include 'classes/bd.php';
		$cust = new customer();
		$bd = new DB();
		$allids=$cust->get_allIDs();
		$N		 = sizeof($allids);
		$id=0;
		if(isset($_SESSION['custid']))
			$id= $_SESSION['custid'];
	?>

	<fieldset id="authenticate">

		<form class="form" method="post" action="?page=cust_del2">
			
			<p>
				<?php if($id){?> <div style="color:red; font-size:11px; font-weight:lighter; text-align:left; margin-left: 47px; font-family:monospace;">
				<?php ; if(isset($_SESSION['custid3'])) echo $_SESSION['custid3'].'</div>';}?>
				
				
				<input type="text" name="custid" id="custid" placeholder="" list="searchresults" autocomplete="off" onclick="if(this.value=='Customer ID'){this.value='';} this.style.color='#014366'; $(this).toggleClass('click');" onblur="if(this.value==''){this.value='Customer ID';} this.style.color='#7BAECC';$(this).toggleClass('click');" <?php if(isset($_SESSION['custid2'])) {echo 'value="'.$_SESSION['custid2'].'"';} else {echo 'value="Customer ID"';}?> name="cust" <?php if($id==-1){echo "class='txt err'";} else echo "class='txt'";?>>
				<datalist id="searchresults">
					<?php
						$i=0;
						while($i<$N){
							echo"<option>".$allids[$i]->get("id")."</option>";
							$i++;
						}
					?>
				</datalist>
			</p>
					
			<input type="submit" value="Validate" class="bt">
			<input type="reset" value="Cancel" class="bt">
		</form>
	</fieldset>
	<div id="hidden1" style="display:none;">Should be 5 digits</div>
	<?php
		unset($_SESSION["custid"]);	
		unset($_SESSION["custid2"]);
		unset($_SESSION["custid3"]);
}
else
	header("Location: ./");
?>