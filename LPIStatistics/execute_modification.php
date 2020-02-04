<?php
session_start();
			include('squelete/header.php');


if(empty($_COOKIE['cin'])){
header('location: utilisateur.php');
}
else { ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- TemplateBeginEditable name="doctitle" -->
<title></title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>
<?php
include 'connections/Connexion.php';
?>
<body>
<?php
$cin=$_COOKIE['cin'];
if(mysql_query("select * from laureat where laureat.cin='$cin'"))
{

$cin = $_POST['cin'];	
$nom_laureat = $_POST['name'];
$prenom = $_POST['prenom'];
$num_GSM = $_POST['gsm'];
$promo=$_POST['promo'];
$pass=$_POST['password'];
$statut1=$_POST['statut1'];
$statut=$_POST['statut'];


 

if(mysql_query("UPDATE laureat 	SET	cin='$cin'  , nom ='$nom_laureat' ,prenom='$prenom' , gsm='$num_GSM' , promo='$promo' , mdp='$pass' ,statut='$statut' where cin=$cin"))
echo '';
else echo 'failed'.mysql_error();
 }
 
 if($statut1!=$statut)
 {  
if($statut1=="travail") { $statut1="employee"; }
if($statut1=="etude")   { $statut1="etude";  }
if($statut1=="recherche") { $statut1="cherche";}
if(mysql_query("DELETE  from ".$statut1." where ".$statut1.".cin='$cin'"))
echo 'Suppression réussi';
else echo 'failed!'.mysql_error();
 echo 'Vous avez changé votre statut!';
     echo '<br>';
     echo '<form action=modifier_statut.php method=POST>';
	if($statut=="travail")
	{
	   
	    echo '<br>';
	   echo'Selectionner votre nouveau statut : ';
	   
	   echo' <select name=statut>';
	   echo' <option SELECTED value=etude>Etude';
	   echo' <option value=travail>Travail';
	   echo' <option value=recherche>Recherche';
	   echo' </select>';
	   echo '<input type=submit value=Continuer name=continuer>';
	   echo '</form>';
	}
	else if($statut=="etude")
	{
	   
	    echo '<br>';
	   echo'Selectionner votre nouveau statut : ';
	   
	   echo' <select name=statut>';
	   echo' <option SELECTED value=etude>Etude';
	   echo' <option value=travail>Travail';
	   echo' <option value=recherche>Recherche';
	   echo' </select>';
	   echo '<input type=submit value=Continuer name=continuer>';
	   echo '</form>';
	}
	else 
	{
	  
	    echo '<br>';
	   echo'Selectionner votre nouveau statut : ';
	   
	   echo' <select name=statut>';
	   echo' <option SELECTED value=etude>Etude';
	   echo' <option value=travail>Travail';
	   echo' <option value=recherche>Recherche';
	   echo' </select>';
	   echo '<input type=submit value=Continuer name=continuer>';
	   echo '</form>';
	}
 }
 
 
?>

</body>
</html>
<?php
}

			include('squelete/footer.php');
?>