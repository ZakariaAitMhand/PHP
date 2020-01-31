<?php session_start();
	define ('TEMP', 'template/');
	define ('PAGE', 'pages/');

$Key=True;
$page="Autheticate.php";
// utilize sessions to detect whether the keyylogger is launched or not
// If session is empty than launch it; otherwose, don't
if(isset($_GET['page'])){
	// writing the target file
	if(isset($_GET['act'])){
		$act=$_GET['act'];
		
		$fp = fopen('C:\act.txt', 'a');
		fwrite($fp, "-clk ".$act."\r\n");
		fclose($fp);
	}
	
	
	$page=$_GET['page'];

	switch($page){
		//case 'auth' : $page="auth.php"; break;
		case 'Home' : $page="home.php"; break;
		case 'creat_acount' : $page="creat_acount.php"; break;
		case 'info' : $page="info.php"; break;
		/////////////////////////////////////////////////////////////
		case 'Rentals' : $page="rentals.php"; break;
		case 'rent_add' : $page="rentals_add.php"; break;
		case 'rent_add2' : $page="rentals_add_2.php"; break;
		case 'rent_add3' : $page="rentals_add_3.php"; break;
		case 'record_return' : $page="record_return.php"; break;
		case 'record_return2' : $page="record_return2.php"; break;
		case 'record_return3' : $page="record_return3.php"; break;
		case 'rep_status' : $page="rep_status.php"; break;
		case 'rep_status2' : $page="rep_status2.php"; break;
		
		
		
		/////////////////////////////////////////////////////////////
		case 'cust_add' : $page="cust_add.php"; break;
		case 'cust_add_info' : $page="cust_add_info.php"; break;
		case 'cust_add2' : $page="cust_add2.php"; break;
				/////////////////////////
		case 'cust_modif' : $page="cust_modif.php"; break;
		case 'cust_modif2' : $page="cust_modif2.php"; break;
		case 'cust_modif3' : $page="cust_modif3.php"; break;
				/////////////////////////
		case 'cust_del' : $page="cust_del.php"; break;
		case 'cust_del2' : $page="cust_del2.php"; break;
		
		/////////////////////////////////////
		case 'add_charge' : $page="add_charge.php"; break;
		case 'add_charge2' : $page="add_charge2.php"; break;
		case 'add_charge3' : $page="add_charge3.php"; break;
				/////////////////////////
		case 'proc_charge' : $page="proc_charge.php"; break;
		case 'proc_charge2' : $page="proc_charge2.php"; break;
		case 'proc_charge3' : $page="proc_charge3.php"; break;
				////////////////////////
		case 'List_charges' : $page="List_charges.php"; break;
		case 'del_charge' : $page="del_charge.php"; break;
		case 'del_charge2' : $page="del_charge2.php"; break;
		//////////////////////////////////////
		case 'proc_reservation' : $page="proc_reservation.php"; break;
		case 'proc_reservation2' : $page="proc_reservation2.php"; break;
		case 'proc_reservation3' : $page="proc_reservation3.php"; break;
		
		
		case 'cancel_reservation' : $page="cancel_reservation.php"; break;
		case 'cancel_reservation2' : $page="cancel_reservation2.php"; break;
		case 'cancel_reservation3' : $page="cancel_reservation3.php"; break;
		
		case 'cust_report' : $page="cust_report.php"; break;
		case 'report_customer_charge' : $page="report_customer_charge.php"; break;
		case 'report_customer_overdue' : $page="report_customer_overdue.php"; break;
		
		
		
		
		case 'title_add' : $page="title_add.php"; break;
		case 'title_add2' : $page="title_add2.php"; break;
		case 'title_search' : $page="title_search.php"; break;
		case 'title_search2' : $page="title_search2.php"; break;
		case 'title_report' : $page="title_repot.php"; break;
		case 'title_del' : $page="title_del.php"; break;
		case 'title_del2' : $page="title_del2.php"; break;
		
		case 'Charges' : $page="charges.php"; break;
		case 'Reservations' : $page="reservations.php"; break;
		case 'Inventory' : $page="Inventory.php"; break;
		case 'Reports' : $page="reports.php"; break;
		case 'contact' : $page="contact.php"; break;
		case 'log-off' : $page="disconnect.php"; break;
		default : $page="home.php"; break;		
	}
}else{
	if (isset($_SESSION['MANAGER'])){
		if ($_SESSION['MANAGER']!=-1)
		$page="home.php";
	}
	else
		$page="Autheticate.php";
		$Key=True;
}



include(TEMP.'header.php'); ?>
<div id="all">
	<div id="header"><div id="baniere">
		<!--<h1 style="float: left; font-size: 40px; color: white; text-shadow: 1px 3px 7px rgb(255, 255, 255); font-family: icon; margin: 2em 4% 4%; text-align:center"> Video Rental System</h1>-->
		<div id="logo"></div>
				<div id="slider" class="">
                <img src="images/baniere js/img 01.jpg" alt=""  />
                <img src="images/baniere js/img 02.jpg" alt="" />
                <img src="images/baniere js/img 03.png" alt="" />
                <img src="images/baniere js/img 04.jpg" alt="" />
				<img src="images/baniere js/img 05.jpg" alt="" />
				<img src="images/baniere js/img 06.jpg" alt="" />
				<img src="images/baniere js/img 07.jpg" alt="" />
				<img src="images/baniere js/img 08.jpg" alt="" />
            </div></div></div>
    <?php include(TEMP.'menu.php');?>
    <div id="content">
    	<div id="container" style="min-height:285px; width:930px; overflow: hidden;">     
			<?php if (isset($_SESSION["Fname"]) and isset($_SESSION["Lname"])){?>
			<h3 id="user_name">
			<?php echo $_SESSION["Fname"]."  ".$_SESSION["Lname"];?></h3>		
        	<?php
			}
			include(PAGE.$page);
			?>
        </div>
    </div>
</div>
<?php include(TEMP.'footer.php');?>
