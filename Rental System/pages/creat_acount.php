<?php
if(isset($_SESSION['MANAGER'])){
?>
<h1 id="container_title">Create Account:</h1>

<fieldset id="authenticate">

	<form class="form" method="post" action="pages/cr_account.php">
		
		<input type="text" onclick="if(this.value=='First Name'){this.value=''; this.style.color='#014366'; $(this).toggleClass('click');}" onblur="if(this.value==''){this.value='First Name';this.style.color='#7BAECC';$(this).toggleClass('click');}" value="First Name" name="Fname" class="txt">
		<br />
		<input type="text" onclick="if(this.value=='Last Name'){this.value=''; this.style.color='#014366'; $(this).toggleClass('click');}" onblur="if(this.value==''){this.value='Last Name';this.style.color='#7BAECC';$(this).toggleClass('click');}" value="Last Name" name="Lname" class="txt">
		<br />
		<input type="text" onclick="if(this.value=='Login'){this.value=''; this.style.color='#014366'; $(this).toggleClass('click');}" onblur="if(this.value==''){this.value='Login';this.style.color='#7BAECC';$(this).toggleClass('click');}" value="Login" name="login" class="txt">
		<br />
		<input type="password" onclick="if(this.value=='password'){this.value=''; this.style.color='#014366'; $(this).toggleClass('click');}" onblur="if(this.value==''){this.value='password';this.style.color='#7BAECC';$(this).toggleClass('click');}" value="password" name="pass" class="txt">
		<br />
		 <select class="txt" id="sel" name="manager">
		  <option value="1">------Manager------</option>
		  <option value="0">-------Clerk-------</option>
		</select>
		<br />
		<input type="submit" value="validate" class="bt">
		<input type="reset" value="Cancel" class="bt">
	</form>


</fieldset>
<?php
}
else
	header("Location: ./");
?>