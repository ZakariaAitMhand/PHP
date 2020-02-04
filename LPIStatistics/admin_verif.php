<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>Administration</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>

<body>

<?php

$admin=$_COOKIE['Admin_pass'];

if($admin=="admin")
{
$_SESSION['admin']=$admin;
?>
<script language="javascript">
window.location="Admin.php";
</script>
<?php
}
else 
{
   ?>
   <script language="javascript">
   alert("Mot de passe incorrect");
   window.location="index.php";
   </script>
   <?php
}
?>





</body>
</html>