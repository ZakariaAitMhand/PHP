<?php
if(isset($_SESSION['MANAGER'])){
?>
	<h1 id="container_title">Add Rentals:</h1>
	<?php
		//include 'classes/user.php';
		include 'classes/customer.php';
		include 'classes/bd.php';
		$cust = new customer();
		$bd = new DB();
		$allids=$cust->get_allIDs();
		$N		 = sizeof($allids);
		
		$id		 =0;
		$Fname	 =0;
		$Lname	 =0;
		$address =0;
		$phone	 =0;
		
		
		if(isset($_SESSION['custid'])){
			if($_SESSION['custid']==-1)
				$id = $_SESSION['custid'];
		}
		if(isset($_SESSION['custFname'])){
			if($_SESSION['custFname']==-1)
				$Fname = $_SESSION['custFname'];
		}
		if(isset($_SESSION['custLname'])){
			if($_SESSION['custLname']==-1)
				$Lname = $_SESSION['custLname'];
		}
		
		if(isset($_SESSION['address'])){
			if($_SESSION['address']==-1)
				$address = $_SESSION['address'];
		}
		if(isset($_SESSION['phone'])){
			if($_SESSION['phone']==-1)
				$phone = $_SESSION['phone'];
		}
		
	?>


	<fieldset id="authenticate">

		<form class="form" method="post" action="?page=cust_add2">
			
			<p>
				<?php if($id or $Fname or $Lname or $address or $phone){?> <div style="color:red; font-size:11px; font-weight:lighter; text-align:left; margin-left: 47px; font-family:monospace;">
				<?php echo'Wrong credentials !'; if(isset($_SESSION['custid3'])) echo $_SESSION['custid3'].'</div>';}?>
				
				<div id="hidden1" style="display:none;">Should be 5 digits</div>
				<input type="text" name="custid" id="custid" placeholder="" list="searchresults" autocomplete="off" onclick="if(this.value=='Customer ID'){this.value='';} this.style.color='#014366'; $(this).toggleClass('click');" onblur="if(this.value==''){this.value='Customer ID';} this.style.color='#7BAECC';$(this).toggleClass('click');" <?php if(isset($_SESSION['custid']) and $id!=-1){echo "value='".$_SESSION['custid']."'";} elseif(isset($_SESSION['custid2'])) {echo 'value="'.$_SESSION['custid2'].'"';} else {echo 'value="Customer ID"';}?> name="cust" <?php if($id==-1){echo "class='txt err'";} else echo "class='txt'";?>>
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
			<input type="text" onclick="if(this.value=='First Name'){this.value=''; this.style.color='#014366'; $(this).toggleClass('click');}" onblur="if(this.value==''){this.value='First Name';this.style.color='#7BAECC';$(this).toggleClass('click');}" <?php if($Fname==-1){echo "class='txt err'";} else echo "class='txt'";?> <?php if(isset($_SESSION['custFname']) and $Fname!=-1){echo "value='".$_SESSION['custFname']."'";} elseif(isset($_SESSION['custFname2'])) {echo 'value="'.$_SESSION['custFname2'].'"';} else {echo 'value="First Name"';}?> name="Fname">
			
			<input type="text" onclick="if(this.value=='Last Name'){this.value=''; this.style.color='#014366'; $(this).toggleClass('click');}" onblur="if(this.value==''){this.value='Last Name';this.style.color='#7BAECC';$(this).toggleClass('click');}" <?php if($Lname==-1){echo "class='txt err'";} else echo "class='txt'";?> <?php if(isset($_SESSION['custLname']) and $Lname!=-1){echo "value='".$_SESSION['custLname']."'";} elseif(isset($_SESSION['custLname2'])) {echo 'value="'.$_SESSION['custLname2'].'"';} else {echo 'value="Last Name"';}?> name="Lname">
			
			<input type="text" onclick="if(this.value=='Address'){this.value=''; this.style.color='#014366'; $(this).toggleClass('click');}" onblur="if(this.value==''){this.value='Address';this.style.color='#7BAECC';$(this).toggleClass('click');}" <?php if($address==-1){echo "class='txt err'";} else echo "class='txt'";?> <?php if(isset($_SESSION['address']) and $address!=-1){echo "value='".$_SESSION['address']."'";} elseif(isset($_SESSION['address2'])) {echo 'value="'.$_SESSION['address2'].'"';} else {echo 'value="Address"';}?> name="address">
			
			
			<input id="phone" type="text" onclick="if(this.value=='Phone Number'){this.value=''; this.style.color='#014366'; $(this).toggleClass('click');}" onblur="if(this.value==''){this.value='Phone Number';this.style.color='#7BAECC';$(this).toggleClass('click');}" <?php if($phone==-1){echo "class='txt err'";} else echo "class='txt'";?> <?php if(isset($_SESSION['phone']) and $phone!=-1){echo "value='".$_SESSION['phone']."'";} elseif(isset($_SESSION['phone2'])) {echo 'value="'.$_SESSION['phone2'].'"';} else {echo 'value="Phone Number"';}?> name="phone" id="phone">
			<div id="hidden" style="display:none;">Should be 10 digits</div>
			
			<input type="submit" value="Validate" class="bt">
			<input type="reset" value="Cancel" class="bt">
		</form>
	</fieldset>

	<?php
		
		if(isset($_SESSION['custid']))
			unset($_SESSION["custid"]);
		if(isset($_SESSION['custFname']))
			unset($_SESSION["custFname"]);
		if(isset($_SESSION['custLname']))
			unset($_SESSION["custLname"]);
		if(isset($_SESSION['address']))
			unset($_SESSION["address"]);
		if(isset($_SESSION['phone']))
			unset($_SESSION["phone"]);
		
		if(isset($_SESSION['custid2']))
			unset($_SESSION["custid2"]);
		if(isset($_SESSION['custid3']))
			unset($_SESSION["custid3"]);
		if(isset($_SESSION['custFname2']))
			unset($_SESSION["custFname2"]);
		if(isset($_SESSION['custLname2']))
			unset($_SESSION["custLname2"]);
		if(isset($_SESSION['address2']))
			unset($_SESSION["address2"]);
		if(isset($_SESSION['phone2']))
			unset($_SESSION["phone2"]);
}
else
	header("Location: ./");		
?>