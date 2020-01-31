<?php
if(isset($_SESSION['MANAGER'])){
?>
	<h1 id="container_title">Modify Customer Information:</h1>
	<?php
	include 'classes/bd.php';
	include'classes/customer.php';
	include'classes/user.php';
	$phone=0;
	$phone2=0;
	$phone1=0;
	$iderr	=0;
	if(isset($_POST['custid'])){
		$id 	= $_POST['custid'];	
		$_SESSION['custid']	= $id;
	}
	else
		$id 	= $_SESSION['custid'];

	if(!preg_match("/^[0-9]{5}$/", $id))
			$iderr=1;
			
	if(strlen($id)==5 or !$iderr){
		$user = new user();
		$bd = new DB();
		$cust = new customer($id);
		if(!$cust->customer_exist($id)){
			$_SESSION['custid'] = -1;
			$_SESSION['custid2'] = $_POST['custid'];
			$_SESSION['custid3'] = "Unexisting ID !";
			$destination = "?page=cust_modif";
			header("Location: ".$destination);
			exit(0);
		}
		else{
			$user->search_customer($cust);
			$Fname 	= $cust->get("Fname");
			$Lname 	= $cust->get("Lname");
			$address= $cust->get("address");
			$phone 	= $cust->get("phone");
			
			if(isset($_SESSION['phone']))
				$phone1 = $_SESSION['phone'];

			if($phone1==-1){
				if(isset($_SESSION['phone2']))
					$phone2 = $_SESSION['phone2'];
			}
			else{
				$_SESSION['Fname2']  	=$Fname;	
				$_SESSION['Lname2']  	=$Lname;
				$_SESSION['address2']	=$address;
				$_SESSION['phone2']  	=$phone;
			}
			?>
			
			<fieldset id="authenticate">
				<?php if($phone1==-1){?> <div style="color:red; font-size:11px; font-weight:lighter; text-align:left; margin-left: 47px; font-family:monospace;">
				<?php echo'Wrong credentials !'; if(isset($_SESSION['custid3'])) echo $_SESSION['custid3'].'</div>';}?>
				<form class="form" method="post" action="?page=cust_modif3">
					<input type="text" onclick="this.style.color='#014366'; $(this).toggleClass('click');" onblur="this.style.color='#7BAECC';$(this).toggleClass('click');" class='txt' <?php echo 'value="'.$Fname.'"';?> name="Fname">
					
					<input type="text" onclick="this.style.color='#014366'; $(this).toggleClass('click');" onblur="this.style.color='#7BAECC';$(this).toggleClass('click');" class='txt' <?php echo'value="'.$Lname.'"';?> name="Lname">
					
					<input type="text" onclick="this.style.color='#014366'; $(this).toggleClass('click');" onblur="this.style.color='#7BAECC';$(this).toggleClass('click');" class='txt' <?php echo 'value="'.$address.'"'?> name="address">
					<br>
					
					<input id="phone" type="text" onclick="this.style.color='#014366'; $(this).toggleClass('click')" onblur="this.style.color='#7BAECC';$(this).toggleClass('click');" <?php if($phone1==-1){echo "class='txt err'";} else echo "class='txt'";?> <?php if($phone1==-1){echo "value='".$phone2."'";} else {echo 'value="'.$phone.'"';}?> name="phone" id="phone">
					<div id="hidden" style="display:none;">Should be 10 digits</div>
					<input type="submit" value="Validate" class="bt">
					<input type="reset" value="Cancel" class="bt">
				</form>
			</fieldset>	
			
			<?php
			
			
		}
	}
	else{
		$_SESSION['custid'] = -1;
		if(isset($_POST['custid']))
			$_SESSION['custid2'] = $_POST['custid'];
		$_SESSION['custid3'] = "(Invalid ID Length)";
		$destination = "?page=cust_modif";
		header("Location: ".$destination);
	}
}
else
	header("Location: ./");
?>