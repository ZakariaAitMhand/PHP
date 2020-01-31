<?php
if(isset($_SESSION['MANAGER'])){
?>
<h1 id="container_title">Process Late Charge:</h1>
<?php
	include 'classes/user.php';
	include 'classes/customer.php';
	include 'classes/bd.php';
	$cust = new customer();
	
	$bd = new DB();
	
	$custs =$cust->get_allIDs();
	
	
	$N		 = sizeof($custs);
	
	$id=0;
	if(isset($_SESSION['custerror']))
		$id= $_SESSION['custerror'];
		
	$c_id=0;
	if(isset($_SESSION['custid']))
		$c_id= $_SESSION['custid'];
		
?>

<fieldset id="authenticate">

	<form class="form" method="post" action="?page=proc_charge2">
		
		<p>
			<?php if($id){?> <div style="color:red; font-size:11px; font-weight:lighter; text-align:left; margin-left: 47px; font-family:monospace;">
			<?php if($id) echo 'Wrong Customer ID !</div>';}?>
			
			
			<input type="text" id="custid" placeholder="" list="searchresults" autocomplete="off" onclick="if(this.value=='Customer ID'){this.value='';} this.style.color='#014366'; $(this).toggleClass('click');" onblur="if(this.value==''){this.value='Customer ID';} this.style.color='#7BAECC';$(this).toggleClass('click');" <?php if($c_id){if($id==-1) echo 'value="'.$_SESSION['custid'].'"';else {echo 'value="Customer ID"';}} else {echo 'value="Customer ID"';}?> name="custid" <?php if($c_id){if($id==-1)echo "class='txt err'";else echo "class='txt'";} else echo "class='txt'";?>>
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
	
	if(isset($_SESSION["custid"]))
		unset($_SESSION["custid"]);
		
	if(isset($_SESSION["custerror"]))
		unset($_SESSION["custerror"]);
}
else
	header("Location: ./");
?>