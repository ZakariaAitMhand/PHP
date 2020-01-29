<link rel="stylesheet" type="text/css" href="../style/css/dashboard.css" media="screen" />
<script type="text/javascript" src="../library/js/jquery.js"></script>

	<script type="text/javascript">
	$J=jQuery.noConflict() ;
		//calcule de somme des pourcentage
		$J(function(){	
	
			$J(".sub").click(function (){
				d=0
				a=$J(".pourcent").length
				for(i=0;i<a;i++){
					if($J(".pourcent").eq(i).val() != "")
						d = d + eval($J(".pourcent").eq(i).val())
				}
				if(d>100){
					alert("Vous avez dépassé 100% de "+eval(d-100));
					return false;
				}
				if(d<100){
					alert("Il vous reste "+eval(100-d)+" à 100% ");
					return false;
				}
			});
		});
	</script>
<script type="text/javascript" src="../library/js/mootools.js"></script>
	<script type="text/javascript" src="../library/js/calendar.rc4.js"></script>
	<script type="text/javascript">
		window.addEvent('domready', function() { 
			myCal2 = new Calendar({ date2: 'd-m-Y' }, { classes: ['dashboard'], direction: 1, tweak: {x: 3, y: -3} });
			myCal2 = new Calendar({ date: 'd-m-Y' }, { classes: ['dashboard'], direction: 1, tweak: {x: 3, y: -3} });
		});
	</script>
	<script type="text/javascript">
		function cocher(a){
			if($J(a).val() != ""){
				//$J(a).attr('value', "999")
				//$J("#resp").attr('checked', true)
				//$J(a).parent("td").parent(".ligne").css("color","red");
				$J(a).parent("td").parent(".ligne").children("td").children(".resp").attr('checked', true)
			}	
			else{
				$J(a).parent("td").parent(".ligne").children("td").children(".resp").attr('checked', false)
			}
		}
	</script>
<?php 
if($_SESSION['grade'] != "CDP"){
	header("Location: ../index.php");
}
else{
	$bd = new DB();
	$d = new DB();
	$form = new formulaire("forme","ajoutprojet.php","post","multipart/form-data");
	echo "<table class='ajout_p'>";
	echo "<tr><th>Nom du projet <span>:</span></th>
			  <td>";
			  		$form->input("text","nompjt");
	echo"	  </td></tr>";
	$req = "SELECT nomste FROM client";
	$bd->query($req);
	echo"<tr><th>Client <span>:</span></th>
			 <td>";
			 		$form->selelctopen("clt");
			 		while($ligne=$bd->fetch()){
			 			$val=$ligne['nomste'];
			 			$form->option($val,$val);
			 		}
			 		$form->selectclose();
	echo "		<a href='?l=ajout_client' class='a_clt'>Ajouter un client </a><br />";
	
	echo "<tr><th>Description <span>:</label></th>
			  <td>";
			  		$form->area("desc");
	echo"	  </td></tr>";
	$req = "SELECT id_tache, libelle_tache FROM tache ";
	$bd->query($req);
	while($l=$bd->fetch()){
		$x = $l['libelle_tache'];
		$t = explode(" ",$x);
		$y = implode("",$t);
		echo"<tr><th>$x <span>:</span></th>";
		echo"	 <td><table>";
						$request = "SELECT id, nom, prenom
									FROM user, tache, tacheuser
									WHERE id = user_id
									AND id_tache = tache_id
									AND libelle_tache = '$x'
									AND grade = 'technicien'";	
						$d->query($request);
				 		while($ligne=$d->fetch()){
				 			$val=$ligne['id'];
				 			echo"<tr class='ligne'><td>";
				 			$form->input("checkbox",$y."resp[]",$val,"",false,"","resp");
				 			echo $ligne['nom']." - ".$ligne['prenom'];
				 			echo"</td><td>";
				 			$form->input('text',$y.'%[]','','width:30px;',false,"","pourcent","onblur = 'cocher(this)'");
				 			echo "%</td></tr>";
				 		}
				 		$form->selectclose();
		echo "</table></td></tr>";
	}
	echo"<tr><th>fichiers sources <span>:</span></th>
			 <td>";
			 		$form->input("file","upload");
	echo"	 </td></tr>";
	echo"<tr><th>Date-début <span>:</span></th>
			 <td>";
			 		$form->input("text","debut",date('d-m-Y'),"",false,"date");
	echo"	 </td></tr>";
	echo"<tr><th>Date-fin <span>:</span></th>
			 <td>";
			 		$form->input("text","fin",date('d-m-Y'),"",false,"date2");
	echo"	 </td></tr>";
	echo "<tr><td align=right>";
					$form->input("submit","ajouter","  Ajouter  ","",false,"","sub");
	echo "	  </td>";
	echo "<td>";
					$form->input("reset","annuler","  Annuler  ");
	echo "	  </td></tr>";
	echo "</table>";
	$form->close();
}