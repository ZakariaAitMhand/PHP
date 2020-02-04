
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8">
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
<script language="javascript" type="text/javascript" src="js/inscription.js"></script>
<script language="javascript" type="text/javascript" src="js/ajax.js" ></script>


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