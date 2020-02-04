<style>
.t{
	-moz-border-radius:3px 3px 3px 3px;
	border:2px inset #CCCCCC;
	color:#666666;
	font:small-caps 16px bold;
	margin:3px 3px 3px 15px;
	padding-right:
}
#radio{
	-moz-border-radius:5px 5px 5px 5px;
	border:3px double #666666;
	font-variant:normal;
	margin-left:15px;
	padding:1px 10px;
}
#radio:hover{
	border-color:#CCCCCC;
	color:#FFFFFF;
	background-color:#336666;
}
</style>
<?php
if(empty($_COOKIE['cin'])){
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
$cin=$_COOKIE['cin'];
$table=$_POST['choix'];
if($table=="travail")
{
if($req=mysql_query("select * from employee where employee.cin='$cin'"))
{ if($fetch=mysql_fetch_assoc($req))
		
       echo '<form action="modification_parcours.php?table=travail" method="POST" class="forme">';
	   echo '<table>';
	   echo '<tr>';
	   echo '<td>';
	   echo 'Nom de la societé: ';
	   echo '</td>';
	   echo '<td>';
	   echo' <input value="'.$fetch['nom_societe'].'" name=nom_societe class="t">';
	   echo '</td>';
	   echo '</tr>';
	   echo '<tr>';
	   echo '<td>';
	   echo 'Spécialité : ';
	   echo '</td>';
	   echo '<td>';
	   echo' <input value="'.$fetch['specialite'].'" name=specialite class="t">';
	   echo '</td>';
	   echo '</tr>';
	   echo '<tr>';
	   echo '<td>';
	   echo 'Ville: ';
	   echo '</td>';
	   echo '<td>';
	   echo' <input value="'.$fetch['ville'].'" name=ville class="t">';
	   echo '</td>';
	   echo '</tr>';
	    echo '<tr>';
	   echo '<td>';
	   echo 'Salaire : ';
	   echo '</td>';
	   echo '<td>';
	   echo' <input value="'.$fetch['salaire'].'" name=salaire class="t">';
	   echo '</td>';
	   echo '</tr>';
	    echo '<tr>';
	   echo '<td>';
	   echo' <input type=submit value=modofier name=valider id="radio">';
	   echo '</td>';
	   echo '</tr>';
	   echo '</table>';
	   echo '</form>';
        }
		else echo 'erreur';
 }
 
if($table=="etude")
{
if($req=mysql_query("select * from etude where etude.cin='$cin'"))
{ if($fetch=mysql_fetch_assoc($req))
		
       echo '<form action="modification_parcours.php?table=etude" method="POST" class="forme">';
	   echo '<table>';
	   echo '<tr>';
	   echo '<td>';
	   echo 'type d etude: ';
	   echo '</td>';
	   echo '<td>';
	   echo' <input value="'.$fetch['type_etude'].'" name=type_etude class="t">';
	   echo '</td>';
	   echo '</tr>';
	   echo '<tr>';
	   echo '<td>';
	   echo 'Spécialité : ';
	   echo '</td>';
	   echo '<td>';
	   echo' <input value="'.$fetch['specialite'].'" name=specialite class="t">';
	   echo '</td>';
	   echo '</tr>';
	   echo '<tr>';
	   echo '<td>';
	   echo 'Nom de l ecole: ';
	   echo '</td>';
	   echo '<td>';
	   echo' <input value="'.$fetch['nom_ecole'].'" name=nom_ecole class="t">';
	   echo '</td>';
	   echo '</tr>';
	    echo '<tr>';
	   echo '<td>';
	   echo 'ville : ';
	   echo '</td>';
	   echo '<td>';
	   echo' <input value="'.$fetch['ville'].'" name=ville class="t">';
	   echo '</td>';
	   echo '</tr>';
	   echo '<tr>';
	   echo '<td>';
	   echo' <input type="submit" value="modofier"  id="radio" class="t">';
	   echo '</td>';
	   echo '</tr>';
	   echo '</table>';
	   echo '</form>';
        }
		else echo 'erreur';
 }

 if($table=="recherche")
{
if($req=mysql_query("select * from cherche where cherche.cin='$cin'"))
{ if($fetch=mysql_fetch_assoc($req))
		
       echo '<form action="modification_parcours.php?table=recherche" method="POST" class="forme">';
	   echo '<table>';
	   echo '<tr>';
	   echo '<td>';
	   echo 'avez vous obtenu un diplôme master  : ';
	   echo '</td>';
	   echo '<td>';
	   echo' <input value='.$fetch['master_obtenu'].' name=master_obtenu class="t">';
	   echo '</td>';
	   echo '</tr>';
	    echo '<tr>';
	   echo '<td>';
	   echo' <input type=submit value=modofier id="radio" class="t">';
	   echo '</td>';
	   echo '</tr>';
	   echo '</table>';
	   echo '</form>';
        }
		else echo 'erreur';
 }
?>

</body>
</html>
<?php
}
?>