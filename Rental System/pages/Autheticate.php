<?php

	$auth=1;
	if(isset($_SESSION["MANAGER"])){
		if($_SESSION["MANAGER"]!=-1)
			$auth=1;
		else
			$auth=0;
	}

	?>

	<h1 id="container_title">Authenticate:</h1>
	<?php echo'<fieldset id="authenticate"'; if(!$auth) echo'class="not"';echo'>';?>
		<!--<legend>Authentication</legend>-->
			<form class="form" method="post" action="auth.php">
				<input type="text" onclick="if(this.value=='Login'){this.value=''; this.style.color='#014366';} $(this).toggleClass('click');" onblur="if(this.value==''){this.value='Login';this.style.color='#7BAECC';}$(this).toggleClass('click');" value="Login" name="login" class="txt">
				
				<input type="password" onclick="if(this.value=='password'){this.value=''; this.style.color='#014366';} $(this).toggleClass('click');" onblur="if(this.value==''){this.value='password';this.style.color='#7BAECC';}$(this).toggleClass('click');" value="password" name="pass" class="txt">
				
				<?php if(!$auth){?> <div style="color:red; font-size:11px; font-weight:lighter; text-align:left; margin-left: 47px; font-family:monospace;">
				<?php echo'Wrong Credentials !</div>';}?>

				<input type="submit" value="validate" class="bt">
				<input type="reset" value="Cancel" class="bt">
			</form>
	</fieldset>
<?php
?>