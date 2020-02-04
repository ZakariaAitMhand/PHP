<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

if($_SESSION['admin']!="admin"){
?>
<script language="javascript">
alert("Suppression acvec succes !!");
window.location="index.php";
</script>
<?php
}
else { ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>Suppression</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>
<?php
include 'connections/Connexion.php';
?>
<body>
<?php
$cin=$_POST['cinS'];
$statut=$_POST['statut'];
if(mysql_query("DELETE  from laureat where laureat.cin='$cin'"))
{
if($statut=="recherche")
$statut="cherche";
if($statut=="travail")
$statut="employee";
if(mysql_query("DELETE  from ".$statut." where ".$statut.".cin='$cin'"))
	{
	?>
	<script language="javascript">
	alert("Suppression acvec succes !!");
	window.location="Admin.php";
	</script>
	<?php
}
else{
	?>
	<script language="javascript">
	alert("Echec de suppression !!");
	window.location="Admin.php";
	</script>
	<?php
}
}
?>
</body>
</html>
<?php
}
?>