<?php
if($_SESSION['grade'] != "CDP"){
	header("Location: ../index.php");
}
else{
	$np = $_GET['np'];
	$valid = $_GET['v'];
	$_SESSION['np'] = $np;
	$bd = new DB();
			$req = "SELECT * 
					FROM projet P,client C
					WHERE P.numclt=C.numclt
					AND   numpjt='".$np."'";
			$bd->query($req);
			echo "<table border=1><tr>
						 <th>Numero de dossier</th>
						 <th>Projet</th>
						 <th>Description</th>
						 <th>Répertoire</th>
						 <th>Date de début</th>
						 <th>Date de fin</th>					 
						 <th>Client</th>
						 <th>Téléphone</th>";
			$i=0;
			$ligne=$bd->fetch();
				$x=explode("-",$ligne['numpjt']);
				$dossier=implode("",$x);
				echo "<tr>
						  <td>".$dossier."</td>
						  <td>".decoder($ligne['nompjt'])."</td>
						  <td>".decoder($ligne['description'])."</td>
						  <td><a href='".$ligne['dossier'].$dossier."'>".$ligne['dossier'].$dossier."</a></td>";
						  	$deb = $ligne['debut'];
							$tt = explode("-",$deb);
							$xx = $tt[0];
							$tt[0] = $tt[2];
							$tt[2] = $xx;
							$deb = implode("-",$tt);
				echo	  "<td>".$deb."</td>";
							$fin = $ligne['fin'];
							$tt = explode("-",$fin);
							$xx = $tt[0];
							$tt[0] = $tt[2];
							$tt[2] = $xx;
							$fin = implode("-",$tt);
							
				echo 	 "<td>".$fin."</td>
						  <td>".$ligne['nomste']."</td>
						  <td>".$ligne['tel']."</td>
					  </tr>";
				$i++;
			
			echo "</table>";
			echo "<h2>Responsables</h2>";
			$req="SELECT * from tache";
			$b = new DB();
			$bd->query($req);echo "<table border=1>";
			while($l=$bd->fetch()){
				$t=$l['id_tache'];
				$req="SELECT count(user_id) id
					  FROM	 usertacheprojet
					  WHERE  projet_id = '".$np."'
					  And    tache_id = '".$l['id_tache']."'";
				$b->query($req);
				$nbr = $b->fetch();
				$nbre = $nbr['id'];
				if($nbre != 0){
					echo "<tr><th>".$l['libelle_tache']."</th>
							  <td>";
							$req="SELECT id,nom,prenom,nbre_h,validation,valide
								  FROM	 user, tache, usertacheprojet , projet
								  WHERE  id = user_id
								  AND    id_tache = tache_id
								  AND    numpjt = projet_id
								  And    numpjt = '".$np."'
								  And    libelle_tache = '".$l['libelle_tache']."'";
							$b->query($req);
							$nbre = $bd->nbre_lignes();
							while($d=$b->fetch()){	
								if($valid==0)
									$f = new formulaire("forme","valider_tache.php?np=$np","post","multipart/form-data","overfow:hidden");
								echo "<p>-".$d['nom']."-".$d['prenom']."  :  ";
								$u=$d['id'];
								if($d['validation']!=0)
										echo "<a href='retour.php?np=$np&t=$t&u=$u' style='margin-left:5px; float:right;color:white;background-color:DarkCyan;border:1px solid #222;padding:1px 3px;text-decoration:none'> Retour </a>";
								if($valid==0){
									$f->input("submit","valider","Valider tache","float:right;");
									$f->input('file','prod',"","float:right;");
									$f->input("text","nbre_h",$d['nbre_h'],"width:30px;float:right;color:DarkCyan;");
								}
								else{
									echo "<span  style='float:right;color:DarkCyan;'> Heures de travail = ".$d['nbre_h']."</span>";
								}
								if($valid==0){
									echo " <span  style='float:right;color:DarkCyan;'>nombre d'heures </span>";
									$f->input("hidden","t_u",$l['id_tache']."-".$d['id']);
								}	
								echo "</p><div class='clear'></div>";
								if($valid==0)
									$f->close();
							}
					echo "</td></tr>";
				}
			}
			echo "</table>";
			include '../library/php/graphe/graphe.php';
			include'../library/php/graphe/histogramme.php';
			$bd->close();
}