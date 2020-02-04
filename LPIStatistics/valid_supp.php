<?php
session_start();
?>
<link rel="stylesheet" type="text/css" href="style/style.css" />
<link rel="stylesheet" type="text/css" href="style/redmond/jquery-ui-1.8.custom.css" />
<link rel="SHORTCUT ICON" href="style/image/icone.png" />
<title>Statistuques</title>
<script language="javascript" type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery-ui-1.8.custom.min.js"></script>
<script language="javascript" type="text/javascript" src="js/supp.js"></script>
<?php
$cin=$_POST['cinS'];
$statut=$_POST['statut'];
$_SESSION['cin']=$cin;
$_SESSION['stat']=$statut;
echo "CIN = ".$_SESSION['cin']."  stat = ".$_SESSION['stat']; 
?>


<div id="dialog-inscription-form" title="Inscription">
	<p class="validateTips" >Saisir le mot de pass</p>

	<form id="form" style="position:relative; top:2em;" action="">
	<fieldset>
		<label for="password" id="lab">Mot de pass</label>
		<input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" />
	</fieldset>
	</form>
</div>