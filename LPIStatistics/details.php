<?php
session_start();
?>
<?php
session_start();
			include('squelete/header.php');
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

if($_SESSION['admin']!="admin"){
header('location: administration.php');
}
else { ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>Informations supplimentaires</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
<link rel="stylesheet" type="text/css" href="style/style_php.css" />
<style>
table, td, th{
	border:2px ridge #336666;
	text-align:center;
}
th{
	background-color:#336666;
	color:#EEE;
	width:120px;
}
td input{
	background:none;
	border:none;
	font-weight:bold;
	color:#336666;
	cursor:pointer;
}
td input:hover{
	border:none;
}
.forme {
	margin-left:6cm;
}
</style>

</head>
<?php
include 'connections/Connexion.php';
?>
<body>
<?php
$cin=$_POST['cinS'];
$table=$_POST['statut'];
if($table=="travail")
{
if($req1=mysql_query("select * from laureat  where laureat.cin='$cin'") )
if ($req2=mysql_query("select * from employee where employee.cin='$cin'"))
   {
   
   echo '<table  border=1>';
   echo '<tr>';
   echo '<th scope=col>CIN </th>';
   echo '<th scope=col>Nom</th>';
   echo '<th scope=col>Prénom</th>';
   echo '<th scope=col>GSM</th>';
   echo '<th scope=col>Promotion</th>';
   echo '<th scope=col>nom de la societe</th>';
   echo '<th scope=col>Spécialité</th>';
   echo '<th scope=col>Ville</th>';
     echo '<th scope=col>Salaire</th>';
   echo '</tr>'; 
   while($fetch=mysql_fetch_assoc($req1)  )
   {
     echo '<tr>';
	 echo '<td>',$fetch['cin'];
	 echo '<td>',$fetch['nom'];
	 echo '<td>',$fetch['prenom'];
	 echo '<td>',$fetch['gsm'];
	 echo '<td>',$fetch['promo'];
	 
	 
	 
   }
   while ($fetch1=mysql_fetch_assoc($req2))
   {
     echo '<td>',$fetch1['nom_societe'];
     echo '<td>',$fetch1['specialite'];
	 echo '<td>',$fetch1['ville'];
	 echo '<td>',$fetch1['salaire'];
   }
   echo '</table>';
   }
 }
 else if($table=="etude")
{
if($req1=mysql_query("select * from laureat  where laureat.cin='$cin'") )
if ($req2=mysql_query("select * from etude where etude.cin='$cin'"))
   {
   
   echo '<table  border=1>';
   echo '<tr>';
   echo '<th bgcolor=#CCCCCC scope=col>CIN </th>';
   echo '<th width=200 bgcolor=#CCCCCC scope=col>Nom</th>';
   echo '<th bgcolor=#CCCCCC scope=col>Prénom</th>';
   echo '<th bgcolor=#CCCCCC scope=col>GSM</th>';
   echo '<th bgcolor=#CCCCCC scope=col>Promotion</th>';
   echo '<th bgcolor=#CCCCCC scope=col>Type d'."'".'etude</th>';
   echo '<th bgcolor=#CCCCCC scope=col>Spécialité</th>';
   echo '<th bgcolor=#CCCCCC scope=col>nom de l'."'établissement".'</th>';
     echo '<th bgcolor=#CCCCCC scope=col>Ville</th>';
   echo '</tr>'; 
   while($fetch=mysql_fetch_assoc($req1)  )
   {
     echo '<tr>';
	 echo '<td>',$fetch['cin'];
	 echo '<td>',$fetch['nom'];
	 echo '<td>',$fetch['prenom'];
	 echo '<td>',$fetch['gsm'];
	 echo '<td>',$fetch['promo'];
	 
	 
	 
   }
   while ($fetch1=mysql_fetch_assoc($req2))
   {
     echo '<td>',$fetch1['type_etude'];
     echo '<td>',$fetch1['specialite'];
	 echo '<td>',$fetch1['nom_ecole'];
	 echo '<td>',$fetch1['ville'];
   }
   echo '</table>';
   }
 }
 else 
{
if($req1=mysql_query("select * from laureat  where laureat.cin='$cin'") )
if ($req2=mysql_query("select * from cherche where cherche.cin='$cin'"))
   {
   
   echo '<table  border=1>';
   echo '<tr>';
   echo '<th bgcolor=#CCCCCC scope=col>CIN </th>';
   echo '<th width=200 bgcolor=#CCCCCC scope=col>Nom</th>';
   echo '<th bgcolor=#CCCCCC scope=col>Prénom</th>';
   echo '<th bgcolor=#CCCCCC scope=col>GSM</th>';
   echo '<th bgcolor=#CCCCCC scope=col>Promotion</th>';
   echo '<th bgcolor=#CCCCCC scope=col>Master Obtenu</th>';
   
   echo '</tr>'; 
   while($fetch=mysql_fetch_assoc($req1)  )
   {
     echo '<tr>';
	 echo '<td>',$fetch['cin'];
	 echo '<td>',$fetch['nom'];
	 echo '<td>',$fetch['prenom'];
	 echo '<td>',$fetch['gsm'];
	 echo '<td>',$fetch['promo'];
	 
	 
	 
   }
   while ($fetch1=mysql_fetch_assoc($req2))
   {
     echo '<td>',$fetch1['master_obtenu'];
  
   }
   echo '</table>';
   }
 }
 
?>

</body>
</html>
<?php
}
			include('squelete/footer.php');

?>