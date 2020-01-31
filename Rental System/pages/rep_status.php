<?php
if(isset($_SESSION['MANAGER'])){
?>
<h1 id="container_title">Report Status:</h1>
<?php
	include 'classes/user.php';
	include 'classes/copy.php';
	include 'classes/title.php';
	include 'classes/bd.php';

	$user = new user();
	$t = new title();
	$titles=$t->get_allnames();
	$N		 = sizeof($titles);
		?>
		<fieldset id="authenticate">

			<form class="form" method="post" action="?page=rep_status2">
				
				<p>
					<input type="text" id="name" placeholder="" list="searchresults" autocomplete="off" onclick="if(this.value=='Title Name'){this.value='';} this.style.color='#014366'; $(this).toggleClass('click');" onblur="if(this.value==''){this.value='Title Name'} this.style.color='#7BAECC';$(this).toggleClass('click');" <?php if(isset($_SESSION['title'])) {echo 'value="'.$_SESSION['title'].'"';} else {echo 'value="Title Name"';}?> name="name" class='txt'>
					<datalist id="searchresults">
						<?php
							$i=0;
							while($i<$N){
								$c = new copy(0,$titles[$i]->get("id"));
								if($titles[$i]->available_copies($c)>0)
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
<?php
}
else
	header("Location: ./");
?>