<?php
session_start();
if($_SESSION['grade'] != "CDP"){
	header("Location: ../index.php");
}
else{
	include "../library/php/bd.php";
	include "../library/php/formulaire.php";
	include "../library/php/functions.php";
	include "CDP.php";
	?>
    <title>SGPCI</title>
    <link rel="stylesheet" type="text/css" href="../style/css_index.css" />
	<script type="text/javascript" src="../library/js/jquery.js"></script>
	<script language="javascript">
		function changer_val(){
			if(document.getElementById("rech").value=='Recherche')
				document.getElementById("rech").value = ''
		}
		function remplir_rech() {
			if(document.getElementById("rech").value=='')
				document.getElementById("rech").value = 'Recherche'
		}
		$(document).ready(function(){
			$(".alert").click(function(){
				$(this).next(".reste").fadeIn("200").siblings("#reste").fadeOut("200");
			});
		});
	</script>
    
    
    <div id="baniere">	
    </div>
    <div id="logo"> <a href="../CDP/"><img src="../style/images/logo.png" alt="" /></a> </div>
    <div id="home">
        <img src="../style/images/home.jpg" alt="" /><a href="../CDP/" class="home">&nbsp;</a>
    </div>
    <div id="recherche">
    <?php
	$f = new formulaire("forme","","get");
	$js = "onclick = 'changer_val()'"."onblur = 'remplir_rech()'";
	$f->input("text","np","Recherche","color:#AAAAAA;font-weight:bold;",false,"rech","txt",$js);
	$f->input("submit","rechercher","","",false,"","ok");
	$f->close();
	?>
    </div>
    <div class="clear"></div>
    <div id="menu">
		<?php
         echo '<a href="?l=ajout_projet" class="a1';if(isset($_GET['l']) && $_GET['l']=="ajout_projet")echo " actif"; echo'"></a><div class="baniere_b"></div>';
          echo'<a href="?l=ajout_client" class="a2';if(isset($_GET['l']) && $_GET['l']=="ajout_client")echo " actif";  echo'"></a>';
          echo'<a href="?l=ajout_responsable" class="a3';if(isset($_GET['l']) && $_GET['l']=="ajout_responsable")echo " actif";  echo'"></a>';
          echo'<a href="?l=mon_equipe" class="a4';if(isset($_GET['l']) && $_GET['l']=="mon_equipe")echo " actif";  echo'"></a>';
          echo'<a href="?l=mes_clients" class="a5';if(isset($_GET['l']) && $_GET['l']=="mes_clients")echo " actif";  echo'"></a>';
          echo'<a href="?l=historique" class="a6';if(isset($_GET['l']) && $_GET['l']=="historique")echo " actif";  echo'"></a>';
          echo'<a href="?l=mon_compte" class="a7';if(isset($_GET['l']) && $_GET['l']=="mon_compte")echo " actif";  echo'"></a>';
          echo'<a href="../deconnection.php" class="a8"></a>';
		  ?>
    </div>
    <div id="corp">
    
    
    
	<?php 
	if(isset($_GET['b'])){
		?>
		<script language="javascript">
		alert("Impossible de valider le projet ! Il faut d'abord valider toutes ses taches !!");
		</script>	
		<?php 
	}
	$cdp = new CDP(01);
	//Zone de recherche
	
	//corp de la page
	if(isset($_GET['rechercher']))
		include "recherche_projet.php";
	elseif(isset($_GET['l'])){
		if($_GET['l']=="ajout_projet")
			include "formprojet.php";
		if($_GET['l']=="ajout_client")
			include "formclt.php";
		if($_GET['l']=="ajout_responsable")
			include "form_responsable.php";
		if($_GET['l']=="mon_equipe")
			include "equipe.php";
		if($_GET['l']=="mes_clients")
			include "clients.php";
		if($_GET['l']=="historique")
			include "projet_historique.php";
		if($_GET['l']=="mon_compte")
			include "../form_modif_pass.php";	
		if($_GET['l']=="info")
			include "infoprojet.php";	
		if($_GET['l']=="prod")
			include "upload_prod.php";	
		if($_GET['l']=="modif_projet")
			include "modif_projet_form.php";
		if($_GET['l']=="modif_client")
			include "modif_client_form.php";
		if($_GET['l']=="modif_equipe")
			include "modif_resp_form.php";			
	}
	else
		include "corp-index.php";
}
?>
</div>
    <div id="footer"><br />
<!--        <p>Footer</p>-->
    </div>
