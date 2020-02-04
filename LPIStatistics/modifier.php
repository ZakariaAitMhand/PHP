<style>
.modif{
	background-color:#336666;
	border:1px solid #CCCCCC;
	color:#FFFFFF;
	font-size:15px;
	font-variant:small-caps;
	font-weight:bold;
	padding:0 5px;
}
#bt{
	-moz-border-radius:5px 5px 5px 5px;
	border:3px double #666666;
	font-variant:normal;
	margin-left:15px;
	padding:1px 10px;
}
#bt:hover{
	border-color:#CCCCCC;
	color:#FFFFFF;
	background-color:#336666;
}
.titre{
	font-size:20px;
	font-variant:small-caps;
	font-weight:bold;
	color:#666666;
}
.fields{
border:3px double #666666;
margin-top:2cm;
}
</style>


<?php
$_SESSION['pass']=$_COOKIE['pass'];
$_SESSION['cin']=$_COOKIE['cin'];
if(empty($_SESSION['pass'])){
?>
<script language="javascript">
	alert("Vous devez d'abord vous inscrir !!");
	window.location="index.php";
</script>
<?php
}
else { 
?>
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

<body>

<fieldset class="fields">
  <legend class="titre"> <b>Modification </b>:</legend>
<form action="modif1.php" method="POST">
<table>
<tr>
<td class="modif">Vous voulez modifier :
<td>
<input type="radio" value="parcour" name="modifier" checked="checked">  mon parcours  <br />
<input type="radio" value="personnelle" name="modifier"> mes informations personnelles 



</tr><tr><td><br></tr>
<tr>
<td><center><input type="submit" id="bt" name="continuer" value="continuer" onClick="suiv()"></center>
</tr>
</table>
 </fieldset>
</form>


</body>
</html>
<?php
}
?>