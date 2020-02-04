<?php
$pass=$_POST['pass'];
setcookie('Admin_pass',$pass);
?>
 <script language="javascript">
window.location="admin_verif.php";
</script>