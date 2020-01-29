<?php
session_start();
if($_SESSION['grade'] != "tech" && !isset($_GET['resp']) && !isset($_GET['np'])){
	header("Location: ../index.php");
}
else{
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
	</script>
    <?php
		include "technicien.php";
		include "../library/php/bd.php";
		include "../library/php/functions.php";
		include "../library/php/formulaire.php";
	?>
    <div id="baniere">	
    </div>
    <div id="logo"> <a href="../TECH/"><img src="../style/images/logo.png" alt="" /></a> </div>
    <div id="home">
        <img src="../style/images/home.jpg" alt="" /><a href="../CDP/" class="home">&nbsp;</a>
    </div>

	<?php
	if(isset($_GET['res']) && $_GET['res']==0){
		?>
		<script language="javascript">
			alert("Aucun resultat n'est trouvé !!");
		</script>
		<?php
	}
	//Index cdp
	if(isset($_GET['resp'])){
	$id = $_GET['resp'];
		$_SESSION['member'] = $id;
		   echo'<div id="recherche">';
  
		$f = new formulaire("forme","","get");
		$f = new formulaire("forme","","get");
		$js = "onclick = 'changer_val()'"."onblur = 'remplir_rech()'";
		$f->input("text","np","Recherche","color:#AAAAAA;font-weight:bold;",false,"rech","txt",$js);
		$f->input("hidden","l","mon_equipe");
		$f->input("hidden","resp",$id);
		$f->input("submit","rechercher","Rechercher","",false,"","ok");
		$f->close();
	
    echo'</div>
    <div class="clear"></div>';
	
		echo'<div id="menu">';
		echo '<a href="../CDP/?l=ajout_projet" class="a1"></a><div class="baniere_b"></div>
				  <a href="../CDP/?l=ajout_client" class="a2"></a>
				  <a href="../CDP/?l=ajout_responsable" class="a3"></a>';
				  echo'<a href="../CDP/?l=mon_equipe" class="a4';if(isset($_GET['l']) && $_GET['l']=="mon_equipe")echo " actif";  echo'"></a>';
				  echo'<a href="../CDP/?l=mes_clients" class="a5"></a>
				  <a href="../CDP/?l=historique" class="a6"></a>
				  <a href="../CDP/?l=mon_compte" class="a7"></a>
				  <a href="../deconnection.php" class="a8"></a>';
		echo'</div>
		     <div id="corp">';
		if(isset($_GET['rechercher']))
			include "recherche_tache.php";
		else{
			$tech = new technicien(1);
			if(!empty($_GET['x']))
				$d=$_GET['x']*10;
			else 
				$d=0;
			if(!empty($_GET['x']))
				$d=$_GET['x']*10;
			else 
				$d=0;
			$x = $tech->affiche_projet($d,$id,0,true);
			$x=$x/10;
			echo "<br><p class='pag'><b>Page : </b>";
			for($i=0;$i<$x;$i++){
				$j=$i+1;
				echo "<a href=../TECH/?x=$i class='pagination'>$j</a>  ";
			}
		echo "</p>";
			
		}
	}
	//Index technicien
	else{
		 echo'<div id="recherche">';
  
		$f = new formulaire("forme","","get");
		$f = new formulaire("forme","","get");
		$js = "onclick = 'changer_val()'"."onblur = 'remplir_rech()'";
		$f->input("text","np","Recherche","color:#AAAAAA;font-weight:bold;",false,"rech","txt",$js);
		$f->input("submit","rechercher","Rechercher","",false,"","ok");
		$f->close();
	
    echo'</div>
    <div class="clear"></div>';
		echo'<div id="menu">';
		echo '	  <a href="?l=historique" class="at1';if(isset($_GET['l']) && $_GET['l']=="historique")echo " actif";  echo'"></a><div class="baniere_b ban_b"></div>
				  <a href="?l=mon_compte" class="at2';if(isset($_GET['l']) && $_GET['l']=="mon_compte")echo " actif";  echo'"></a>
				  <a href="../deconnection.php" class="at3"></a>
				  <p class="menu_footer"></p>';
		
		echo'</div>
		     <div id="corp">';
		
		if(isset($_GET['rechercher'])){
			include "recherche_tache.php";
		}
		else{
			if(isset($_GET['l'])){
				if($_GET['l']=="historique")
					include "historique.php";
				if($_GET['l']=="mon_compte")
					include "../form_modif_pass.php";	
				if($_GET['l']=="valider")
					include "form_valider_tache.php";
				if($_GET['l']=="prod")
					include "tech_prod_historique.php";
				if($_GET['l']=="prod_h")
					include "tech_upload.php";	
					
			}
			else
			include "corp-index.php";
		}
		
	}
}
echo"</div>";
?>
    <div id="footer"><br />
<!--        <p>Footer</p>-->
    </div>
