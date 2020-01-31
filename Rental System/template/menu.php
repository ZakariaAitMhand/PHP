<?php
$manager =0;
if(isset($_SESSION["MANAGER"])){
	if($_SESSION["MANAGER"]==1)
		$manager=1;
}
?>


<div id="menu">
    <div id="ul">
        <?php
		if(isset($_SESSION["MANAGER"])){
			if($_SESSION["MANAGER"]!=-1){
		?>
		
		<a href="./">Home</a>
        
		<p class="menu" id ="p">Rentals</p>
		
		<div class="sub_menu" id="sub1">
			<a href="?page=rent_add&act=rent_item" class="a" id="a">Rent Item</a>
			<a href="?page=record_return" class="a" id="a">Record Return</a>
			<a href="?page=rep_status" class="a" id="a">Report Status</a>
		</div>
		
		
		<p class="menu" id ="p">Customers</p>
		<div class="sub_menu" id="sub2">
			 <a href="?page=cust_add" class="a" id="a">Add</a>
			 <a href="?page=cust_modif" class="a" id="a">Modify</a>
			 <?php
				if ($manager){
			 ?>
			 <a href="?page=cust_del" class="a" id="a">Delete</a>
			 <?php
				}
			 ?>
		</div>
		
		
        <p class="menu" id ="p">Titles</p>
		<div class="sub_menu" id="sub3">
			 <a href="?page=title_add" class="a" id="a">Add</a>
			 <a href="?page=title_search" class="a" id="a">Search</a>
			 <?php
				if ($manager){
			 ?>
			 <a href="?page=title_del" class="a" id="a">Delete</a>
			 <a href="?page=title_report" class="a" id="a">Report Titles</a>
			 <?php
				}
			 ?>
		</div>
		
		
        <p class="menu" id ="p">Late Charges</p>
		<div class="sub_menu" id="sub4">
			 <a href="?page=add_charge" class="a" id="a">Add</a>
			 <a href="?page=proc_charge" class="a" id="a">Process</a>
			 <a href="?page=List_charges" class="a" id="a">List</a>
			 <?php
				if ($manager){
			 ?>
			 <a href="?page=del_charge" class="a" id="a">Delete</a>
			 <?php
				}
			 ?>
		</div>
		
		
        <p class="menu" id ="p">Reservations</p>
        <div class="sub_menu" id="sub5">
			 <a href="?page=proc_reservation" class="a" id="a">Process Reservation</a>
			 <a href="?page=cancel_reservation" class="a" id="a">Cancel Reservation</a>
		</div>
		
		<?php
		if ($manager){
		?>
			<!--<p class="menu" id ="p">Inventory</p>
			<div class="sub_menu" id="sub6">
				 <a href="?page=rent_add" class="a" id="a">Add Item</a>
				 <a href="?page=rent_del" class="a" id="a">Remove Item</a>
			</div>-->
		<?php
		}
		?>
		<?php
		if ($manager){
		?>
			<p class="menu" id ="p">Reports</p>
			<div class="sub_menu" id="sub7">
				 <a href="?page=cust_report" class="a" id="a">All Customers</a>
				 <a href="?page=report_customer_charge" class="a" id="a">Customers with Late Charges</a>
				 <a href="?page=report_customer_overdue" class="a" id="a">Customers with overdue Items</a>
			</div>
		<?php
		}
		?>
		<a class = "last" href="?page=log-off">Log-off</a>
		<?php
			}
		}
		?>
    </div>
</div>
