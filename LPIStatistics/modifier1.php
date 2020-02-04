<?php
if($_COOKIE['pass']==""){
?>
<script language="javascript">
window.location="utilisateur.php";
</script>
<?php
}
else { ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Modification</title>
<link rel="stylesheet" type="text/css" href="style/style_php.css" />
</head>
<?php
include 'connections/Connexion.php';
?>
<body>
<?php
$cin=$_COOKIE['cin'];
$choix=$_POST['modifier'];
if($choix=="personnelle")
{
//$choixmodifier=$_POST['modifier'];
 if($req=mysql_query("select * from laureat where laureat.cin='$cin'"))
{ if($fetch=mysql_fetch_assoc($req))
		
       echo '<form action=execute_modification.php method=POST class="forme">';
	   echo '<table>';
	   echo '<tr>';
	   echo '<td>';
	   echo 'CIN';
	   echo '</td>';
	   echo '<td>';
	   echo' <input value='.$fetch['cin'].' name=cin>';
	   echo '</td>';
	   echo '</tr>';
	   echo '<tr>';
	   echo '<td>';
	   echo 'Nom : ';
	   echo '</td>';
	   echo '<td>';
	   echo' <input value='.$fetch['nom'].' name=name>';
	   echo '</td>';
	   echo '</tr>';
	   echo '<tr>';
	   echo '<td>';
	   echo 'Prénom : ';
	   echo '</td>';
	   echo '<td>';
	   echo' <input value='.$fetch['prenom'].' name=prenom>';
	   echo '</td>';
	   echo '</tr>';
	   echo '<tr>';
	   echo '<td>';
	   echo 'GSM : ';
	   echo '</td>';
	   echo '<td>';
	   echo' <input value='.$fetch['gsm'].' name=gsm>';
	   echo '</td>';
	   echo '</tr>';
	   echo '<tr>';
	   echo '<td>';
	   echo 'promotion : ';
	   echo '</td>';
	   echo '<td>';
	   echo' <input value='.$fetch['promo'].' name=promo>';
	   echo '</td>';
	   echo '</tr>';
	   echo '<tr>';
	   echo '<td>';
	   echo 'Mot de passe: ';
	   echo '</td>';
	   echo '<td>';
	   echo' <input value='.$fetch['mdp'].' name=password>';
	   echo '</td>';
	   echo '</tr>';
	   echo '<tr>';
	   echo '<td>';
	   echo 'Statut: ';
	   echo '</td>';
	   echo '<td>';
	   echo '<select name=statut>';
	   if($fetch['statut']=="travail")
	   {
	   echo' <option SELECTED value=travail>Travail';
	   echo' <option value=etude>Etude';
	   echo' <option value=recherche>Recherche';
	   echo '</select>';
	   } else if($fetch['statut']=="etude")
	   {  echo' <option SELECTED value=etude>Etude';
	   echo' <option value=travail>Travail';
	   echo' <option value=recherche>Recherche';
	   echo '</select>';
	   }
	   else 
	   { echo'<option SELECTED value=recherche >Recherche</option>';
   	   echo' <option value=etude>Etude</option>';
	   echo' <option value=travail>Travail</option>';
	   echo '</select>';
	   }
	   
	   echo '</td>';
	   echo '</tr>';
	   echo '<tr>';
	   echo '<td>';
	   echo '<br><input type=hidden name=statut1 value='.$fetch['statut'].'>';
	   echo '</tr>';
	   echo '<tr>';
	   echo '<td>';
	   echo '<br><center><input type=submit value="Modifier" id="radio"></center>';
	   echo '</tr>';
	   echo '</table>';
	   echo '</form>';
        }
		else echo 'erreur';
		}else {
		
		echo '<form action=Modif_parcours.php method=POST >
		<fieldset class="fields">';
		echo '<legend class="titre">';
		echo 'Votre statut : ';
		echo '</legend>';
		echo '<input type="radio" name="choix" id="radio" value="travail" /> Vous travaillez';echo '<br> ';
		echo '<input type="radio" name="choix" id="radio" value="etude" /> Vous poursuivez vos etudes</br>';echo '<br> ';
		echo '<input type="radio" name="choix" id="radio" value="recherche" /> Vous cherchez</br> ';echo '<br><br> ';
		echo '<input type="submit" name="valider" id="radio" value="valider" /> ';
		echo '</fieldset> ';
		echo '</form>';
		
		}
		
		
?>

</body>
</html>
<?php
}
?>