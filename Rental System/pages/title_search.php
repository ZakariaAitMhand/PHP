<?php
if(isset($_SESSION['MANAGER'])){
?>
	<h1 id="container_title">Title Search:</h1>
	<?php
		include 'classes/user.php';
		include 'classes/title.php';
		include 'classes/bd.php';
		$t = new title();
		$bd = new DB();
		$titles=$t->get_allnames();
		$N		 = sizeof($titles);
		echo $N;
		$id=0;
		if(isset($_SESSION['title']))
			$id= $_SESSION['title'];
	?>

	<fieldset id="authenticate">

		<form class="form" method="post" action="?page=title_search2">
			
			<p>
				<?php if($id){?> <div style="color:red; font-size:11px; font-weight:lighter; text-align:left; margin-left: 47px; font-family:monospace;">
				<?php if(isset($_SESSION['title'])) echo 'Wrong Title Name !</div>';}?>
				
				
				<input type="text" id="name" placeholder="" list="searchresults" autocomplete="off" onclick="if(this.value=='Title Name'){this.value='';} this.style.color='#014366'; $(this).toggleClass('click');" onblur="if(this.value==''){this.value='Title Name';} this.style.color='#7BAECC';$(this).toggleClass('click');" <?php if(isset($_SESSION['title'])) {echo 'value="'.$_SESSION['title'].'"';} else {echo 'value="Title Name"';}?> name="name" <?php if($id){echo "class='txt err'";} else echo "class='txt'";?>>
				<datalist id="searchresults">
					<?php
						$i=0;
						while($i<$N){
							echo"<option>".$titles[$i]->get("name")."</option>";
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
		unset($_SESSION["title"]);	
		// unset($_SESSION["custid2"]);
		// unset($_SESSION["custid3"]);
}
else
	header("Location: ./");
?>