<?php
session_start();
?>
<?php

if($_SESSION['laureat']=="" ){
header('location: laureat.php');
}
else { ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>Inscription</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
<link rel="stylesheet" type="text/css" href="style/style_php.css" />
</head>

<body>

<?php 
require_once('Connections/Connexion.php');
$choix_laur = $_POST['choix'] ;
switch($choix_laur)
{
  case 'travail': echo "<fieldset class='fields'>";
  echo "<legend class='titre'> <b>Etape finale </b>:</legend>";
  echo "<form action='inscrir_final.php?var=travail' method='POST'>";
?>

<table>
<table >
          <tr>
            <td>Entreprise</td>

            <td><input type='text' name='nom_e' id="t"/></td>
          </tr>
          <tr>
            <td>Sp&eacute;cialit&eacute;</td>
            <td><input type='text' name='domain' id="t"/></td>
          </tr>
          <tr>
            <td>Ville</td>

            <td><input type='text' name='c_city' id="t"/></td>
          </tr>
          <tr>
            <td>Salaire</td>
            <td><input type='text' name='salary' id="t"/></td>
			</tr>
			<tr>
			 
			
			 <td><input type="submit" value="Terminer" id="bt"/></td>
          </tr>
        </table>

 </fieldset>
</form>
<?php
	break ;
	case 'etude': echo "<fieldset class='fields'>";
  echo "<legend class='titre'> <b>Etape finale </b>:</legend>";?>
	<form method="post"  action='inscrir_final.php?var=etude'>
    


  <table>
    <tr valign="baseline">
      <td align="right">Type d'etude:</td>
      <td><input name="type_etude" type="text" id="t"/></td>
    </tr>
    <tr valign="baseline">
      <td align="right">Specialite:</td>
      <td><input type="text" name="specialite" id="t"/></td>
    </tr>
    <tr valign="baseline">
      <td align="right">Nom etablissement:</td>
      <td><input type="text" name="nom_etablissement" id="t"/></td>
    </tr>
    <tr valign="baseline">
      <td align="right">Ville:</td>
      <td><input type="text" name="ville" id="t"/></td>
    </tr>
    <tr valign="baseline">
      <td align="right">&nbsp;</td>
      <td><input type="submit" value="Terminer"  id="bt"/></td>
    </tr>
  </table>
  <input type="hidden" name="id_etude" value="" />
  <input type="hidden" name="id_laureat" value="" />
  <input type="hidden" name="MM_insert" value="form1" />
  </form>
  

<?php
	break ;
	case 'recherche': 	?>
  <form  name="form1" method="post" action='inscrir_final.php?var=recherche'>
	
	      <fieldset>
      <legend>Etape finale</legend>
	<?php
	
	 echo "Vous avez obtenu un master <input type=radio name=masterO value=oui>Oui <input type=radio name=masterO value=non >Non" ;
	echo '<input type="submit" id="bt" value="Terminer" />';
	break ;
	?>
	</fieldset>
	</form>
	<?php
	
	default : ?>
<script language="javascript">
alert("Vous n'avez fait aucun choix");
window.location="inscription2.php";
</script>
<?php
}

}
?>