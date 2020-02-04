<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
$_SESSION['admin']=$_COOKIE['Admin_pass'];
if($_SESSION['admin']!="admin"){
?>
<script language="javascript">
window.location="index.php";
</script>
<?php
}
else { ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- TemplateBeginEditable name="doctitle" -->
<title></title>
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
<form action="Admin.php" method="POST">
Selectionner la promotion : <select name="choixpromo" >
<option value="statistiques">Statistiques</option>
<?php 
$s="";
$a=date('Y');
$j=0;
	for($i=2006;$i<=$a;$i++)
	{
		$t[$j]=$i;
		$j++;
	}
	for($i=0;$i<count($t)-1;$i++)
		{	$s[$i]=$t[$i]."/".$t[$i+1];
			echo '<option  value='.$s[$i].'>'.$s[$i].'';
			}
?>

</select>


 <input type="submit" value="   Afficher   " name="afficher">   
 </form>

 <?php
 
 $promo="";
 $promo=$_POST['choixpromo'];
 
 if($promo!="statistiques")
 {
 if($req=mysql_query("select * from laureat where laureat.promo='$promo'"))
   {
   echo '<br><b>les laureats de la promotion ', $promo ,': </b><br> ';
   echo '<table  border=1>';
   echo '<tr>';
   echo '<th bgcolor=#CCCCCC scope=col>CIN </th>';
   echo '<th width=200 bgcolor=#CCCCCC scope=col>Nom</th>';
   echo '<th bgcolor=#CCCCCC scope=col>Prénom</th>';
   echo '<th bgcolor=#CCCCCC scope=col>GSM</th>';
   echo '<th bgcolor=#CCCCCC scope=col>Promotion</th>';
   echo '<th bgcolor=#CCCCCC scope=col>Statut</th>';
   echo '<th bgcolor=#CCCCCC scope=col>Supprimer</th>';
   echo '<th bgcolor=#CCCCCC scope=col>Détails</th>';
   echo '</tr>'; 
   while($fetch=mysql_fetch_assoc($req))
   {
     echo '<tr>';
	 echo '<td>',$fetch['cin'];
	 echo '<td>',$fetch['nom'];
	 echo '<td>',$fetch['prenom'];
	 echo '<td>',$fetch['gsm'];
	 echo '<td>',$fetch['promo'];
	 echo '<td>',$fetch['statut'];
	 echo '<td><form action=supprimer.php method=POST><input type=hidden name=cinS value='.$fetch['cin'].'><input type=hidden name=statut value='.$fetch['statut'].'><input type="submit" name="supprimer" value="Supprimer"></form>';
	 echo '<td><form action=details.php method=POST><input type=hidden name=cinS value='.$fetch['cin'].'><input type=hidden name=statut value='.$fetch['statut'].'><input type="submit" name="details" value="Plus de details"></form>';
	 
   }
   echo '</table>';
   }
     $nbre_etudiant=0;
	 $nbre_employee=0;
	 $nbre_recherche=0;
   if($req1=mysql_query("select * from laureat where laureat.promo='$promo' and laureat.statut='travail'")){while($fetch=mysql_fetch_assoc($req1)) $nbre_employee+=1;}
   if($req2=mysql_query("select * from laureat where laureat.promo='$promo' and laureat.statut='etude'")){while($fetch=mysql_fetch_assoc($req2)) $nbre_etudiant+=1;}
   if($req3=mysql_query("select * from laureat where laureat.promo='$promo' and laureat.statut='recherche'")){ while($fetch=mysql_fetch_assoc($req3)) $nbre_recherche+=1;}
   
   echo '<br><b>les statistiques de la promotion ', $promo ,': </b><br> ';
   echo '<table  border=1>';
   echo '<tr>';
   echo '<th bgcolor=#CCCCCC scope=col>Promotion</th>';
   echo '<th width=200 bgcolor=#CCCCCC scope=col>Travail</th>';
   echo '<th bgcolor=#CCCCCC scope=col>Etude</th>';
   echo '<th bgcolor=#CCCCCC scope=col>Recherche</th>';
   echo '<th bgcolor=#CCCCCC scope=col>Total</th>';
   echo '</tr>';
   echo '<tr>';
   echo '<td>',$promo;
   echo '<td>',$nbre_employee;
   echo '<td>',$nbre_etudiant;
   echo '<td>',$nbre_recherche;
   echo '<td>',($nbre_employee+$nbre_etudiant+$nbre_recherche);
   echo'</tr>';
   echo '</table>';
   } else
   {
	 echo '<br><b> statistiques  </b><br> ';
   echo '<table  border=1>';
   echo '<tr>';
   echo '<th bgcolor=#CCCCCC scope=col>Promotion</th>';
   echo '<th width=200 bgcolor=#CCCCCC scope=col>Travail</th>';
   echo '<th bgcolor=#CCCCCC scope=col>Etude</th>';
   echo '<th bgcolor=#CCCCCC scope=col>Recherche</th>';
   echo '<th bgcolor=#CCCCCC scope=col>Total</th>';
   echo '</tr>';
       for ($i=0;$i<count($s);$i++)
	   {
	 $nbre_etudiant=0;
	 $nbre_employee=0;
	 $nbre_recherche=0;
   if($req1=mysql_query("select * from laureat where laureat.promo='$s[$i]' and laureat.statut='travail'")){while($fetch=mysql_fetch_assoc($req1)) $nbre_employee+=1;}
   if($req2=mysql_query("select * from laureat where laureat.promo='$s[$i]' and laureat.statut='etude'")){while($fetch=mysql_fetch_assoc($req2)) $nbre_etudiant+=1;}
   if($req3=mysql_query("select * from laureat where laureat.promo='$s[$i]' and laureat.statut='recherche'")){ while($fetch=mysql_fetch_assoc($req3)) $nbre_recherche+=1;}
   
  
   echo '<tr>';
   echo '<td>',$s[$i];
   echo '<td>',$nbre_employee;
   echo '<td>',$nbre_etudiant;
   echo '<td>',$nbre_recherche;
   echo '<td>',($nbre_employee+$nbre_etudiant+$nbre_recherche);
   echo'</tr>';
 
	   }
	     echo '</table>';
   
   }
?>
<br />
<div align="center">
<?php
include('histogram.php');   
?>
</div>
</body>
</html>
<?php
}
?>