<?php
session_start();
$cin=$_COOKIE['cin'];
$pass=$_COOKIE['pass'];
if($pass==""){
header('location: utilisateur.php');
}
else { ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>Modification</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>
<?php
include 'connections/Connexion.php';
?>
<body>
<?php

$table=$_GET['table'];
if($table=="travail")
{
if(mysql_query("select * from employee where employee.cin='$cin'"))
{
	
$nom_societe = $_POST['nom_societe'];
$specialite = $_POST['specialite'];
$ville = $_POST['ville'];
$salaire=$_POST['salaire'];
if(mysql_query("UPDATE employee SET	cin='$cin'  , nom_societe ='$nom_societe' ,specialite='$specialite' , ville='$ville' , salaire='$salaire'  where cin=$cin"))
{
?>
<script language="javascript">
alert(" Vos modifications sont enregistées ");
window.location="index.php";
</script>
<?php
}

else echo 'failed'.mysql_error();}
 
 }
 
 if($table=="etude")
{
if(mysql_query("select * from etude where etude.cin='$cin'"))
{
	
$type_etude = $_POST['type_etude'];
$specialite = $_POST['specialite'];
$ville = $_POST['ville'];
$nom_ecole=$_POST['nom_ecole'];
if(mysql_query("UPDATE etude SET	cin='$cin'  , type_etude ='$type_etude' ,specialite='$specialite', nom_ecole='$nom_ecole' , ville='$ville'   where cin=$cin"))
{
?>
<script language="javascript">
alert(" Vos modifications sont enregistées ");
window.location="index.php";
</script>
<?php
}

else echo 'failed'.mysql_error();}
 }
 
 if($table=="recherche")
{
if(mysql_query("select * from cherche where cherche.cin='$cin'"))
{
	
$master_obtenu = $_POST['master_obtenu'];
if(mysql_query("UPDATE cherche SET	 master_obtenu='$master_obtenu'   where cin=$cin"))
{
?>
<script language="javascript">
alert(" Vos modifications sont enregistées ");
window.location="index.php";
</script>
<?php
}
else echo 'failed'.mysql_error();}
 }
?>

</body>
</html>
<?php
}
?>