<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

if($_SESSION['laureat']=="" ){
header('location: laureat.php');
}
else { ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>Inscription</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
<link rel="stylesheet" type="text/css" href="style/style_php.css" />
<style>
#container_act{
	background:url(image/actualiser.jpg) no-repeat #FFFFFF;
	cursor:pointer;
	width:24px;
	height:26px;
	position:relative;
	bottom:2.6em;
	right:5cm;
}
#num{
	position:relative;
	bottom:2em;
}

</style>
</head>

<body>
<?php

$cin = $_POST['cin'];
$nom_laureat = $_POST['name'];
$prenom = $_POST['prenom'];
$num_GSM = $_POST['gsm'];
$promo=$_POST['promo'];
$pass=$_POST['password'];
$pass1=$_POST['passwordN'];
if($pass!=$pass1)
{
?>
<script language="Javascript">
alert("Vérifier le mot de passe ");
javascript:history.back();
</script>
<?php
}
$_SESSION['cin'] = $cin;
$_SESSION['name'] = $nom_laureat ;
$_SESSION['prenom'] = $prenom ;
$_SESSION['num_GSM'] = $num_GSM ;
$_SESSION['promo']=$promo;
$_SESSION['pass']=$pass;
?>

<form  method='post' action='inscription3.php'>

  <fieldset class="fields">
  <legend class="titre"><b>Etape 2 :</b> </legend>
  <p>
    <label>
<input type="radio" name="choix" id="radio" value="travail" style="margin-left:0;" />
Vous travaillez</label>
  </p>
  <br />
  <p>

    <label>
<input type="radio" name="choix" id="radio2" value="etude" align="left" />    
Vous poursuivez vos etudes </label>
  </p>
  <br />
  <p>
    <label>
<input type="radio" name="choix" id="radio3" value="recherche" align="left" />    
Vous cherchez  </label>
  </p>
  <br />

  <?php
  //include ('validation.php');
  //echo'<input type="text" name="num" id="num"/>
  //<input type="hidden" name="x" value="'.$x.'"/>';
  ?>
  <br />
    <input type="button"  value="Etape precedente" onClick = "history.back()" id="bt"/> &nbsp;&nbsp;

    <input type="submit" name="button2" id="bt"  style="background-color:##CCCCCC" value="Continuer" />

  </fieldset>
</form>

</body>
</html>
<?php
}
?>