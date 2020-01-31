<?php
if(isset($_SESSION['MANAGER'])){

	include 'classes/user.php';
	include 'classes/copy.php';
	include 'classes/rental.php';
	include 'classes/title.php';
	include 'classes/bd.php';
	

	$name    = $_POST["name"];
	
	$user= new user();
	$title= new title(0,$name);
	$user->search_title($title);
	$copy= new copy(0,$title->get("id"));
	$c=$copy->search_me();
	$N= sizeof($c);
	
	
		?>
		<h1 id="container_title">Item Status:</h1>
		<fieldset id="authenticate">
		<h2 style="color: #501C0F;font-size: 14px;padding-bottom: 13px;text-decoration: underline;"><?php echo $title->get("name");?></h2>
			<table border=0 id ="tbl3">
		<tr>
			<td class="tl">Copy ID </td> <td class="tl">Year </td><td class="tl">Description </td><td class="tl">Genre: </td><td class="tl">Customer </td><td class="tl">Rent Date </td><td class="tl">Due Date </td><td class="tl">Return Date </td>
		</tr>
		
			<?php
				for($i=0;$i<$N;$i++){
						$r= new rental(0,$title->get("id"),$c[$i]->get("id"));
						$user->search_rental($r);
			?>
					<tr>
						<td style="text-align:center"><?php echo $title->get("id")."-".$c[$i]->get("id"); ?></td>
						<td style="text-align:center"><?php echo $title->get("year"); ?></td>
						<td style="text-align:center"><?php echo $title->get("description"); ?></td>
						<td style="text-align:center"><?php echo $title->get("genre"); ?></td>
						<td style="text-align:center"><?php  if($c[$i]->get("rented") or $r->get("ct_id")!=0) echo $r->get("ct_id"); else echo "____";?></td>
						<td style="text-align:center"><?php  if($c[$i]->get("rented") or $r->get("rdate")!=0) echo $r->get("rdate"); else echo "____";?></td>
						<td style="text-align:center"><?php  if($c[$i]->get("rented") or $r->get("bdate")!=0) echo $r->get("bdate"); else echo "____";?></td>
						<td style="text-align:center"><?php  if($c[$i]->get("rented") or $r->get("r_date")!=0){ if($r->get("r_date")!="0000-00-00") echo $r->get("r_date");else echo "____";}else echo "____";?></td>
					</tr>
		
				<?php
				}
				?>
		
		</table>
		</fieldset>
		<?php
	
}
else
	header("Location: ./");	
?>