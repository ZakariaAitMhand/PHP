<?php
if(isset($_SESSION['MANAGER'])){

	include 'classes/customer.php';
	include 'classes/title.php';
	include 'classes/user.php';
	include 'classes/bd.php';
	$Lname = $_SESSION["Lname"];
	$Fname = $_SESSION["Fname"];
	$user = new user(0,$Lname,$Fname);
	$cust = new customer();
	$t = new title();
	$bd = new DB();


		if(isset($_SESSION["char"])){
			$car = $_SESSION["char"];
			if($car == "account"){
			$user->show_added_account();
			$Fname 	 = $_SESSION["addFN"];		
			$Lname 	 = $_SESSION["addLN"];
			$manager = $_SESSION["addmanager"];
			$pwd 	 = $_SESSION["addPWD"];
			$log 	 = $_SESSION["addLOG"];
			?>
			<fieldset id="authenticate">
				<table border=0 id ="tbl">
					<tr><td class="tl" colspan=2>
			<?php	
				echo" User Account was successfully Added !!";
				
			?>
			</tr>
			<tr>
				<td class="td">First name : </td>
				<td><?php echo $Fname ?></td>
			</tr>
			<tr>
				<td class="td">Last name : </td>
				<td><?php echo $Lname ?></td>
			</tr>
			<tr>
				<td class="td">Loggin : </td>
				<td><?php echo $log ?></td>
			</tr>
			<tr>
				<td class="td">Password : </td>
				<td><?php echo $pwd ?></td>
			</tr>
			<tr>
				<td class="td">Role : </td>
				<td><?php if($manager) echo "Manager"; else echo "Clerk"; ?></td>
			</tr>
			</table>
			</fieldset>
			<?php
		}
	////////////////////////////////////////////////////////////////////////////////////////////////////
		
		if($car == "customer"){
			$cust->show_added_account();
			$id 	 = $_SESSION["addcustid"];	
			$Fname 	 = $_SESSION["addFN"];
			$Lname	 = $_SESSION["addLN"];
			$address = $_SESSION["addaddress"];
			$phone 	 = $_SESSION["addphone"];
			?>
			<fieldset id="authenticate">
				<table border=0 id ="tbl">
					<tr><td class="tl" colspan=2>
			<?php	
				echo" Customer was successfully Added !!";
				
			?>
			</tr>
			<tr>
				<td class="td">Customer ID : </td>
				<td><?php echo $id ?></td>
			</tr>
			
			<tr>
				<td class="td">First name : </td>
				<td><?php echo $Fname ?></td>
			</tr>
			<tr>
				<td class="td">Last name : </td>
				<td><?php echo $Lname ?></td>
			</tr>
			<tr>
				<td class="td">Address		: </td>
				<td><?php echo $address ?></td>
			</tr>
			<tr>
				<td class="td">Phone : </td>
				<td><?php echo $phone?></td>
			</tr>
			</table>
			</fieldset>
			
			<?php
		}
		
		
		
		
		if($car == "customer_modif"){
			$cust->set("id",$_SESSION["custid"]);	
			$user->search_customer($cust);
			$id 	= $cust->get("id");
			$Fname 	= $cust->get("Fname");
			$Lname 	= $cust->get("Lname");
			$address= $cust->get("address");
			$phone 	= $cust->get("phone");
			?>
			<fieldset id="authenticate">
				<table border=0 id ="tbl">
					<tr><td class="tl" colspan=2>
			<?php	
				echo" Customer is Successfully Modified !!";
				
			?>
			</tr>
			<tr>
				<td class="td">Customer ID : </td>
				<td><?php echo $id ?></td>
			</tr>
			
			<tr>
				<td class="td">First name : </td>
				<td><?php echo $Fname ?></td>
			</tr>
			<tr>
				<td class="td">Last name : </td>
				<td><?php echo $Lname ?></td>
			</tr>
			<tr>
				<td class="td">Address		: </td>
				<td><?php echo $address ?></td>
			</tr>
			<tr>
				<td class="td">Phone : </td>
				<td><?php echo $phone?></td>
			</tr>
			</table>
			</fieldset>
			
			<?php
		}
		
		if($car == "customer_delete"){
			$cust->set("id",		$_SESSION["custid"]);
			$cust->set("Fname",		$_SESSION["delfname"]);
			$cust->set("Lname", 	$_SESSION["dellname"]);
			$cust->set("address", 	$_SESSION["deladdress"]);
			$cust->Set("phone", 	$_SESSION["delphone"]);
			
			?>
			<fieldset id="authenticate">
				<table border=0 id ="tbl">
					<tr><td class="tl" colspan=2>
			<?php	
				echo" Customer was successfully Deleted !!";
				
			?>
			</tr>
			<tr>
				<td class="td">Customer ID : </td>
				<td><?php echo $cust->get("id"); ?></td>
			</tr>
			
			<tr>
				<td class="td">First name : </td>
				<td><?php echo $cust->get("Fname"); ?></td>
			</tr>
			<tr>
				<td class="td">Last name : </td>
				<td><?php echo $cust->get("Lname"); ?></td>
			</tr>
			<tr>
				<td class="td">Address		: </td>
				<td><?php echo $cust->get("address") ?></td>
			</tr>
			<tr>
				<td class="td">Phone : </td>
				<td><?php echo $cust->get("phone")?></td>
			</tr>
			</table>
			</fieldset>
			
			<?php
		}
		
		
		
		if($car == "title_add"){
			$t->set("name",			$_SESSION["name2"]);
			$t->set("year",			$_SESSION["year2"]);
			$t->set("description", 	$_SESSION["desc2"]);
			$t->set("copies", 		$_SESSION["copies2"]);
			$t->Set("genre", 		$_SESSION["genre2"]);
			
			?>
			<fieldset id="authenticate">
				<table border=0 id ="tbl">
					<tr><td class="tl" colspan=2>
			<?php	
				echo" Title was successfully Added !!";
				
			?>
			</tr>
			<tr>
				<td class="td">Title Name: </td>
				<td><?php echo $t->get("name"); ?></td>
			</tr>
			
			<tr>
				<td class="td">Year : </td>
				<td><?php echo $t->get("year"); ?></td>
			</tr>
			<tr>
				<td class="td">Description : </td>
				<td><?php echo $t->get("description"); ?></td>
			</tr>
			<tr>
				<td class="td">Number of copies : </td>
				<td><?php echo $t->get("copies") ?></td>
			</tr>
			<tr>
				<td class="td">Genre : </td>
				<td><?php echo $t->get("genre")?></td>
			</tr>
			</table>
			</fieldset>
			
			<?php
		}
		
		
		if($car == "rent_add"){
			$N= $_SESSION["j"];
			// echo $_SESSION["names"];exit(0);
			$names=$_SESSION["names"];
			?>
			<fieldset id="authenticate">
				<table border=0 id ="tbl2">
			<tr>
				<td class="tl">Title Name: </td><td class="tl">Year : </td><td class="tl">Description : </td><td class="tl">Genre : </td>
			</tr>
			<?php
			for($i=1;$i<=$N;$i++){
				$title= new title(0,$names[$i]);
				$title->search_me();
			?>
			<tr>
				<td><?php echo $title->get("name"); ?></td>
				<td><?php echo $title->get("year"); ?></td>
				<td><?php echo $title->get("description"); ?></td>
				<td><?php echo $title->get("genre")?></td>
			</tr>
			
			<?php
			}
			?>
			<tr>
				<td class="td" colspan=2>From : &nbsp&nbsp <?php echo $_SESSION["rdate"];?></td>
				<td class="td" colspan=2>To&nbsp&nbsp : &nbsp&nbsp <?php echo $_SESSION["bdate"];?></td>
			</tr><tr>
				<td style="border:0"></td>
			</tr>
			</table>
			</fieldset>
			<?php
		}
		
		if($car == "rec_return"){
			$N= $_SESSION["j"];
			// echo $_SESSION["names"];exit(0);
			$ids=$_SESSION["cps"];
			$ts=$_SESSION["ts"];
			?>
			<h1 id="container_title">Returned Items:</h1>
			<fieldset id="authenticate">
				<table border=0 id ="tbl2">
			<tr>
				<td class="tl">Title Name: </td><td class="tl">Copy ID: </td><td class="tl">Return Date : </td> <td class="tl">Year : </td><td class="tl">Description : </td><td class="tl">Genre : </td>
			</tr>
			<?php
			for($i=1;$i<=$N;$i++){
				$title= new title(0,$ids[$i]);
				$title->search_me($ts[$i]);
			?>
			<tr>
				<td><?php echo $title->get("name"); ?></td>
				<td><?php echo $ts[$i]."-".$ids[$i]; ?></td>
				<td><?php echo $_SESSION["rdate"]; ?></td>
				<td><?php echo $title->get("year"); ?></td>
				<td><?php echo $title->get("description"); ?></td>
				<td><?php echo $title->get("genre")?></td>
			</tr>
			
			<?php
			}
			?>
			
			</table>
			</fieldset>
			<?php
		}
		

		if(isset($_SESSION["bdate"]))
			unset($_SESSION["bdate"]);
		
		if(isset($_SESSION["rdate"]))
			unset($_SESSION["rdate"]);
		
		if(isset($_SESSION["name2"]))
			unset($_SESSION["name2"]);
		
		if(isset($_SESSION["year2"]))
			unset($_SESSION["year2"]);
		
		if(isset($_SESSION["desc2"]))
			unset($_SESSION["desc2"]);
		
		if(isset($_SESSION["copies2"]))
			unset($_SESSION["copies2"]);
		
		if(isset($_SESSION["genre2"]))
			unset($_SESSION["genre2"]);
		
		if(isset($_SESSION["custid"]))
			unset($_SESSION["custid"]);
		
		if(isset($_SESSION["delfname"]))
			unset($_SESSION["delfname"]);
		
		if(isset($_SESSION["addcustid"]))
			unset($_SESSION["addcustid"]);
			
		if(isset($_SESSION["dellname"]))
			unset($_SESSION["dellname"]);
			
		if(isset($_SESSION["addaddress"]))
			unset($_SESSION["addaddress"]);
		
		if(isset($_SESSION["address"]))
			unset($_SESSION["address"]);
		
		if(isset($_SESSION["addphone"]))
			unset($_SESSION["addphone"]);
		
		if(isset($_SESSION["phone"]))
			unset($_SESSION["phone"]);
		
		if(isset($_SESSION['char']))
			unset($_SESSION['char']);
		
		if(isset($_SESSION["addFN"]))	
			unset($_SESSION["addFN"]);		
		
		if(isset($_SESSION["addLN"]))
			unset($_SESSION["addLN"]);
		
		if(isset($_SESSION["addmanager"]))
			unset($_SESSION["addmanager"]);
		
		if(isset($_SESSION["addPWD"]))
			unset($_SESSION["addPWD"]);
		
		if(isset($_SESSION["addLOG"]))
			unset($_SESSION["addLOG"]);
		
	}
	else{
		header("Location: ./");
	}
}
else
	header("Location: ./");
?>