<?php
?>
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
	$np = $_GET['np'];
	$bd = new DB();
	$b  = new DB();
	$d  = new DB();
	$bd2= new DB();
	
	$req = "SELECT * 
			FROM projet p, client c
			WHERE p.numclt=c.numclt
			AND numpjt ='".$np."'";
	$b->query($req);
	$l=$b->fetch();
	$form = new formulaire("forme","modif_projet.php?np=$np","post","multipart/form-data");
	echo "<table class='ajout_p'><tr><th>Projet <span>:</span></th><td>";
	$form->input('text','projet',decoder($l['nompjt']));
	
	
	$req = "SELECT numclt, nomste FROM client";
	$bd->query($req);
	echo"<tr><th><label>Client <span>:</span> </label></th>
			 <td>";
			 		$form->selelctopen("clt");
			 		while($ligne=$bd->fetch()){
			 			$val=$ligne['nomste'];
			 			if($ligne['nomste']==$l['nomste']){
			 				$form->option_sel($val, $ligne['numclt']);
			 			}
			 			else 
			 				$form->option($val, $ligne['numclt']);
			 		}
			 		$form->selectclose();
	
	
	echo "</td></tr><tr><th>D&eacute;scription <span>:</span> </th><td>";
	$form->area('desc',decoder($l['description']));
	echo "</td></tr><tr><th>Debut</th><td>";
		$deb = $l['debut'];
		$tt = explode("-",$deb);
		$xx = $tt[0];
		$tt[0] = $tt[2];
		$tt[2] = $xx;
		$deb = implode("-",$tt);
	$form->input('text','debut',$deb,"",false,"date");
	echo "</td></tr><tr><th>fin <span>:</span> </th><td>";
		$fin = $l['fin'];
		$tt = explode("-",$fin);
		$xx = $tt[0];
		$tt[0] = $tt[2];
		$tt[2] = $xx;
		$fin = implode("-",$tt);
	$form->input('text','fin',$fin,"",false,"date2");
	
	
	
	
	$req = "SELECT * FROM tache ";
	$bd->query($req);
	while($l=$bd->fetch()){
		$x = $l['libelle_tache'];
		$r=explode(" ",$x);
		$k=implode("",$r);
		echo"<tr><th>$x <span>:</span> </th>";
		echo"	 <td><table>";
						$request = "SELECT id, nom, prenom 
									FROM user, tache, tacheuser
									WHERE id = user_id
									AND id_tache = tache_id
									AND libelle_tache = '$x'
									AND grade = 'technicien'";	
						$d->query($request);
				 		while($ligne=$d->fetch()){
				 			$q = "SELECT id,pourcentage
				 				  FROM usertacheprojet, user, tache, projet
				 				  WHERE id = user_id
									AND id_tache = tache_id
									And numpjt = projet_id
									ANd numpjt = '".$np."'
									AND id_tache = ".$l['id_tache']."
				 				    AND id = ".$ligne['id'];
				 			$bd2->query($q);
				 			$b=false;
							$j=$bd2->fetch();
								if($j['id']==$ligne['id']){
									$b=true;
								}
				 			$val=$ligne['id'];
				 			echo"<tr class='ligne'><td>";
				 			$form->input("checkbox",$k."resp[]",$val,"",$b,"","resp");
				 			echo $ligne['nom']." - ".$ligne['prenom']."<br>";
				 			echo"</td><td>";
				 			echo $form->input('text',$k.'%[]',$j['pourcentage'],'width:30px;',"","","pourcent","onblur = 'cocher(this)'")."%";
				 			echo"</td></tr>";
				 		}
				 		$form->selectclose();
				 		
		echo	  "</table></td></tr>";
	}
	
	echo "</td></tr><tr><td>";
	
	
	
	echo "</td></tr><tr><th>Fichier source <span>:</span> </th><td>";
	$form->input('file','upload');
	echo "</td></tr><tr><td>";
	$form->input('submit','modifier','  Modifier  ',"float:right;",false,"","sub");
	echo "</td><td>";
	$form->input('reset','annuler','  Annuler  ');
	echo "</td></tr>";
	echo "</table>";
	$form->close();
}