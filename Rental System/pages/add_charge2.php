<?php
if(isset($_SESSION['MANAGER'])){
?>
<h1 id="container_title">Record Late Charge:</h1>
<?php
	include 'classes/user.php';
	include 'classes/rental.php';
	include 'classes/title.php';
	include 'classes/copy.php';
	include 'classes/bd.php';
	
	$custID = intval($_POST["custid"]);
	$nbre=0; $id=0;
	$_SESSION["custid"]=$_POST["custid"];
	if(!preg_match("/^[0-9]{5}$/", $_POST['custid']))
		$id=1;
	// if(!preg_match("/^[0-9]{2}$/", $_POST['nbre']) and !preg_match("/^[0-9]{1}$/", $_POST['nbre']))
		// $nbre=1;
		 // echo $nbre."--".$id;
	$user = new user();
	$rent = new rental();
	$x = $rent->rentals_number($custID);
	if(!$id and $user->customer_exist($custID) and $x>0){
		$cpy = new copy();
			$c 	= $cpy->get_allIDs($custID);
			$N	= sizeof($c);
			?>
			<fieldset id="authenticate">

				<form class="form" method="post" action="?page=add_charge3">
					<p>
						<?php if($id){?> <div style="color:red; font-size:11px; font-weight:lighter; text-align:left; margin-left: 47px; font-family:monospace;">
						<?php if(isset($_SESSION['title'])) echo 'Wrong Title Name !</div>';}?>
						
						
						<input type="text" id="name" placeholder="" list="searchresults" autocomplete="off" onclick="if(this.value=='Copy ID'){this.value='';} this.style.color='#014366'; $(this).toggleClass('click');" onblur="if(this.value==''){this.value='Copy ID'} this.style.color='#7BAECC';$(this).toggleClass('click');" <?php if(isset($_SESSION['title'])) {echo 'value="'.$_SESSION['title'].'"';} else {echo 'value="Copy ID"';}?> name="copy" <?php if($id==-1){echo "class='txt err'";} else echo "class='txt'";?>>
						<datalist id="searchresults">
							<?php
								$i=0;
								while($i<$N){
									$t=new title($c[$i]->get("t_id"));
									$t->search_me();
									echo"<option>".$t->get("name")."-".$c[$i]->get("t_id")."-".$c[$i]->get("id")."</option>";
									$i++;
								}
							?>
						</datalist>
					</p>
					
					<input type="text" onclick="if(this.value=='Amount'){this.value=''; this.style.color='#014366'; $(this).toggleClass('click');}" onblur="if(this.value==''){this.value='Amount';this.style.color='#7BAECC';$(this).toggleClass('click');}" <?php if (isset($_SESSION["rentals"])) echo"value='".$_SESSION["rentals"]."'"; else echo"value='Amount'";?> name="amount"  <?php if (isset($_SESSION["rentals"])) echo'class="txt err"'; else echo'class="txt"';?>>
					
					
					<input type="submit" value="Add Charge" class="bt">
					<input type="reset" value="Cancel" class="bt">
		
				</form>
				
			</fieldset>
			<?php
			
	}
	else{
		if($x==0){
			?>
			<fieldset id="authenticate">
			<div style="color:red; font-size:14px; font-weight:bold; text-align:left; font-family:monospace;text-align: center;">
						This custoemr Has no rentals !</div>
			<form class="form" method="post" action="?page=add_charge">
				<input type="submit" value="Back" class="bt">
			</form>
			</fieldset>
			<?php
		}else{
			$_SESSION["custerror"]=-1;
			header("Location: ?page=add_charge");
		}
	}
	// }
	// else{
			// if($custID==0){
				// $_SESSION["custerror"]=$_POST["custid"];
			// }
			// else 
				// $_SESSION["custerror"]=$custID;
			// if($nbre==0){
				// $_SESSION["nbreerror"]=$_POST["nbre"];
			// }
		// header("Location: ?page=rent_add");
	// }
}
else
	header("Location: ./");
?>