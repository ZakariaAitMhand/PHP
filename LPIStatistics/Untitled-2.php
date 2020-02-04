<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
<link rel="stylesheet" type="text/css" href="style/style.css" />
<link rel="stylesheet" type="text/css" href="style/redmond/jquery-ui-1.8.custom.css" />
<link rel="SHORTCUT ICON" href="style/image/icone.png" />
<title>Statistuques</title>
<script language="javascript" type="text/javascript" src="js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="js/js_index.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery-ui-1.8.custom.min.js"></script>
<script language="javascript" type="text/javascript" src="js/javascript_cookies.js"></script>
<script language="javascript" type="text/javascript" src="js/espace_membre.js"></script>
<script language="javascript" type="text/javascript" src="js/Admin_space.js"></script>
</head>

<body>
    <div id="header">
    	<a class="title shadow" href="http://maths.fs-umi.ac.ma/lpi/index.php" target="_blank">Licence Professionnelle d'informatique<br /><span>facult&eacute; des sciences M&eacute;sknes</span></a>
        <div id="menu">
            <a href="index.php" class="menu">Accueil</a>
            <p class="menu" id="Admin-space">Espace Administration</p>
            <p class="menu" id="member-space">Esapce etudiant</p>
            <?php
			if(!empty($_COOKIE['Admin_pass']) || !empty($_COOKIE['cin']) || !empty($_COOKIE['pass']))
			echo'<a href="deconnexion.php" class="menu">Déconnexion</a>';
			?>
        </div>
    </div>
    <div class="clear"></div>
    <div id="corp">
    	<div class="container">
        	<?php
				require ('execute_modification_parcours.php');
            ?>
        </div>
        <div class="s-menu">
            <fieldset class="member">
            	<legend >Espace Administration</legend>
                    <form action="admin_verif2.php" method="post" class="form">
                        <input class="txt" type="password" name="pass" value="password" onblur="if(this.value=='') this.value='password';" onclick="if(this.value=='password') this.value='';" />
                     	<input class="bt" type="submit" value="valider" />
                        <input class="bt" type="reset" value="Annuler" />
                    </form>
	        </fieldset>
        	<fieldset class="member">
            	<legend >Espace membre</legend>
                    <form action="connexion2.php" method="post" class="form">
                        <input class="txt" type="text" name="cin" value="Login" onblur="if(this.value=='') this.value='Login';" onclick="if(this.value=='Login') this.value='';" />
                        <input class="txt" type="password" name="pass" value="password" onblur="if(this.value=='') this.value='password';" onclick="if(this.value=='password') this.value='';" />
                     	<input class="bt" type="submit" value="valider" />
                        <input class="bt" type="reset" value="Annuler" />
                    </form>
	        </fieldset>
            <a href="laureat.php" class="right-menu">Inscription</a>
            <a href="#" class="right-menu">Faculté de Méknes</a>
        </div>
    </div>
    <div class="clear"></div>
    <div id="pied">
    	<span>Statistiques de la Licence Professionnelle de Meknes</span>
    </div>
    
	<noscript>Vous avez désactivé javascript. Si vous voulez quand meme voir le menu, cliquez ici. Si vous ne voulez pas, cliquez ici. Si vous voulez voir le menu en Javascript (chargement plus rapide), réactivez JavaScript</noscript>



<div id="dialog-form" title="Espace membre">
	<p class="validateTips">Rmeplir les champs</p>

	<form id="form" style="position:relative; top:2em;" action="">
	<fieldset>
		<label for="cin">CIN</label>
		<input type="text" name="cin" id="cin" class="text ui-widget-content ui-corner-all" />
		<label for="password">Password</label>
		<input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" />
	</fieldset>
	</form>
</div>
<div id="dialog-Admin-form" title="Espace Administration">
	<p class="validateTips">Rmeplir le champs</p>

	<form id="form" style="position:relative; top:2em;" action="">
	<fieldset>
		<label for="password">Password</label>
		<input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" />
	</fieldset>
	</form>
</div>
 
</body>
</html>
