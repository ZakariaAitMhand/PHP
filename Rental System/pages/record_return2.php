<?php
if(isset($_SESSION['MANAGER'])){
?>
	<h1 id="container_title">Record Return:</h1>
	<?php
		include 'classes/user.php';
		include 'classes/title.php';
		include 'classes/copy.php';
		include 'classes/bd.php';
		
		$custID = intval($_POST["custid"]);
		$nb   = intval($_POST["nbre"]);
		$nbre=0; $id=0;
		if(!preg_match("/^[0-9]{5}$/", $_POST['custid']))
			$id=1;
		if(!preg_match("/^[0-9]{2}$/", $_POST['nbre']) and !preg_match("/^[0-9]{1}$/", $_POST['nbre']))
			$nbre=1;
			 // echo $nbre."--".$id;
		if(!$id and !$nbre){
			$user = new user();
			$cpy = new copy();
			if($user->customer_exist($custID)){
				$c = $cpy->get_allIDs($custID);
				$N		 = sizeof($c);
				?>
				<fieldset id="authenticate">

					<form class="form" method="post" action="?page=record_return3">
						<?php
						// echo $nbre;
							$j=0;
							$_SESSION["j"]=$nb;
									while($j<$nb){$j++;
									echo"<script> var j = $j;</script>";
						?>
						<p>
							<?php if($id){?> <div style="color:red; font-size:11px; font-weight:lighter; text-align:left; margin-left: 47px; font-family:monospace;">
							<?php if(isset($_SESSION['title'])) echo 'Wrong Title Name !</div>';}?>
							
							
							<input type="text" id="name<?php echo"$j";?>" placeholder="" list="searchresults" autocomplete="off" onclick="if(this.value=='Copy ID <?php echo"$j";?>'){this.value='';} this.style.color='#014366'; $(this).toggleClass('click');" onblur="if(this.value==''){this.value='Copy ID <?php echo"$j";?>'} this.style.color='#7BAECC';$(this).toggleClass('click');" <?php if(isset($_SESSION['title'])) {echo 'value="'.$_SESSION['title'].'"';} else {echo 'value="Copy ID '.$j.'"';}?> name="copy<?php echo $j?>" <?php if($id==-1){echo "class='txt err'";} else echo "class='txt'";?>>
							<datalist id="searchresults">
								<?php
									$i=0;
									while($i<$N){
										echo"<option>".$c[$i]->get("t_id")."-".$c[$i]->get("id")."</option>";
										$i++;
									}
								?>
							</datalist>
						</p>
						<?php
							}
						?>
						<input style="color:#014366;"  type="text" name="rent" class="txt" value="<?php echo Date("Y-m-d");?>" disabled>
						<?php $_SESSION["rdate"]= Date("Y-m-d");?>
						<input type="submit" value="Validate" class="bt">
						<input type="reset" value="Cancel" class="bt">
			
					</form>
					
				</fieldset>
				<?php
				$_SESSION["custid"]=$_POST["custid"];
			}
			else{
				$_SESSION["custerror"]=-1;
				
				header("Location: ?page=rent_add");
			}
		}
		else{
				if($custID==0){
					$_SESSION["custerror"]=$_POST["custid"];
				}
				else 
					$_SESSION["custerror"]=$custID;
				if($nbre==0){
					$_SESSION["nbreerror"]=$_POST["nbre"];
				}
				else
					$_SESSION["nbreerror"]=$nbre;
			// header("Location: ?page=rent_add");
		}
}
else
	header("Location: ./");
?>