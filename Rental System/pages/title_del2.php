<?php
if(isset($_SESSION['MANAGER'])){
?>
	<h1 id="container_title">Title Delete:</h1>
	<?php
		include 'classes/title.php';
		include 'classes/copy.php';
		include 'classes/user.php';
		include 'classes/bd.php';
		$user = new user();
		$t = new title();
		$bd = new DB();
		$t->set("name",	$_POST["name"]);
		$exist = $t->title_exist();

		
		if($t->get("name") != "Title Name" and $exist){
				$user->search_title($t);
				$c= new copy(0,$t->get("id"),0,0,0);
				$t->delete_copies($c);
				$user->delete_title($t);
			?>
			<fieldset id="authenticate">
				<table border=0 id ="tbl">
					<tr><td class="tl" colspan=2>
			<?php	
				echo" Title was seccessfully Deleted !!";
				
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
		}else{
			$_SESSION['title']=$t->get("name");
			$destination = "./?page=title_del";
			header("Location: ".$destination);
		}
}
else
	header("Location: ./");
?>
	