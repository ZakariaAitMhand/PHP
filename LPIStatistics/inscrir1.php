<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

if($_SESSION['laureat']==""){
?>
<script language="javascript">
window.location="index.php";
</script>
<?php
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

<fieldset class="fields">
  <legend class="titre"> <b>Etape 1 </b>:</legend>
<form action="inscription2.php" method="POST" class="forme">
<table>
<tr>
<td>cin : 
<td><input name="cin">
</tr>
<tr>
<td>Nom :
<td><input name="name">
</td>
<tr>
<td>Prenom :
<td><input name="prenom">
</tr>
<tr>
<td>GSM :
<td><input name="gsm">
</tr>
<tr>
<td>Promotion :
<td><select name="promo" >
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
</tr>
<tr>
<td>Mot de passe :
<td><input type="password" name="password" type="text"><?php  ?>
</tr>
<tr>
<td> Mot de passe à nouveau:
<td><input type="password" name="passwordN" type="text">
</tr>
<tr><td><br></tr>
<tr>
<td><center><input type="submit" name="reset" value="annuler" id="bt" ></center>
<td><center><input type="submit" name="continuer" value="continuer "  id="bt"></center>
</tr>
</table>
 </fieldset>
</form>

</body>
</html>
<?php
}
?>