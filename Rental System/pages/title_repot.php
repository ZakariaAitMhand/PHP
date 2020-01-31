<?php
if(isset($_SESSION['MANAGER'])){
?>
	<h1 id="container_title">Title Report:</h1>
	<?php
		include 'classes/user.php';
		include 'classes/copy.php';
		include 'classes/title.php';
		include 'classes/bd.php';
		$user = new user();

		$bd = new DB();
		$titles = $user->report_title();
		$N		 = sizeof($titles);
	?>

	<fieldset id="description">
		<table border=0 id ="tbl">
			<tr>
				<td class="tl">Title </td>
				<td class="tl">Year </td>
				<td class="tl">Description </td>
				<td class="tl">Copies </td>
				<td class="tl">Type </td>
				<td class="tl">Available</td>
			</tr>
			<?php
			for($i=0;$i<$N;$i++){
			?>
			<tr>
				<?php	$c =new copy(0,$titles[$i]->get("id"),0,0,1)?>
				<td><?php echo $titles[$i]->get("name"); ?></td>
				<td><?php echo $titles[$i]->get("year"); ?></td>
				<td><?php echo $titles[$i]->get("description"); ?></td>
				<td><?php echo $titles[$i]->get("copies"); ?></td>
				<td><?php echo $titles[$i]->get("genre"); ?></td>
				<td><?php echo $titles[$i]->available_copies($c); ?></td>
			</tr>
			<?php } ?>
		</table>
	</fieldset>
<?php
}
else
	header("Location: ./");
?>