<?php
session_start();
if(isset($_SESSION['grade'])){
	if($_SESSION['grade'] == "tech")
		header("Location: TECH/");
	if($_SESSION['grade'] == "CDP")
		header("Location: CDP/");
}
else{
	include 'library/php/formulaire.php';
	?>
    <title>SGPCI</title>
    <link rel="stylesheet" type="text/css" href="style/css_index.css" />
    <div id="baniere">	
    </div>
    <div id="logo"> <a href="../CDP/"><img src="style/images/logo.png" alt="" /></a> </div>
    <div id="home">
        <img src="style/images/home_auth.png" alt="" /><a href="../CDP/" class="home">&nbsp;</a>
    </div>
    <div id="corp">
    
    
    
    <?php
	$_SESSION['serv'] = "../projets/";
	?>
	<div id="auth">
    <?php  
    	$form = new formulaire("forme","auth.php","post");  
    		$form->input("text","login","","",false,"","txt");
            $form->input("password","pass","","",false,"pass","txt");
            $form->input("submit","connect","Se connecter","",false,"","bt");
            $form->input("reset","annuler","Annuler","",false,"","bt");
            echo"<span class='label'>Login : </span>";
            echo"<span class='label' id='lab2'>Mot de pass : </span>";
		$form->close();
    ?>
    </div>
	
</div>
    <div id="footer"><br />
<!--        <p>Footer</p>-->
    </div>

<?php 
}
?>