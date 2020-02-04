<?php
$cin=$_POST['cin'];
$pass=$_POST['pass'];
setcookie(cin,$cin);
setcookie(pass,$pass);
?>
 <script language="javascript">
window.location="utilisateur.php";
</script>