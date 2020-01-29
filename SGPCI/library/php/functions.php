<?php
// encoder et ajouter les slashe pour l'ajout dans la base de donnée
 function en_coder($x){
 	return utf8_encode(addslashes($x));
 }

 // decoder et enlever les slashe pour l'ajout dans la base de donnée
 function decoder($x){
 	return utf8_decode(stripslashes($x));
 }
 
// la diference entre deux date
function date_difference($debut,$fin){
	$x = explode("-",$debut);
	$an = (int)$x[0];
	$x2 = (int)$x[1];
 	$x3 = (int)$x[2];
 	$x = explode("-",$fin);
	$y2 = (int)$x[1];
 	$y3 = (int)$x[2];
 	if($x2==$y2){
 	$t = ($y3*8)-($x3*8);
	return $t;
 	}
	else{
		$t=0;
		for($i=$x2;$i<$y2;$i++){
			if($i<8){
				if($i%2==0){
					$t += 30;
					if($i==2){
						if($an%4==0)
							$t+=1;
						$t -= 2;
					}
				}
				else
					$t += 31;
			}
			else{
				if($i%2==0)
					$t += 31;
				else
					$t += 31;
			}
		}
		$t *=8;
		$t +=($y3*8)-($x3*8);
		return $t;
	}
}

//upload fichier src et prod
function upload_fichier($file,$chemin){
	
		$tmp_file = $file['tmp_name'];
					if( !is_uploaded_file($tmp_file) ){
						echo "Le fichier est introuvable <br>";
					}
					$src = $file['name'];
					if( !move_uploaded_file($tmp_file, $chemin .$src) ){
						echo "Impossible de copier le fichier dans $chemin <br>";
					}
		 return $src;
}

// Validation des tache technicien et CDP
function valider_tache($nbre_h,$t,$id,$np){
	if($nbre_h!=0){
		$bd = new DB();
		$date = date("Y-m-d");
		$req = "UPDATE usertacheprojet
				SET nbre_h = $nbre_h, validation = 1, date_validation = '".$date."'
				WHERE tache_id=$t
				AND user_id = $id
				AND projet_id = '".$np."'";
		$bd->query($req);
	}
}

// Envoie de mail
function envoie_mail($id,$msg){
	$bd		=	new DB();
	$req	=	"SELECT mail FROM `user` WHERE id =$id";
	$bd = new DB();
	$bd->query($req);
	$expediteur=$bd->fetch();
	
	$reponse = $expediteur;
	@mail($destinataire,
	     "Nouveau projet",
	     $msg,
	     "From: $expediteur\r\nReply-To: $reponse");
}

//insertion des taches, leurs responsables, pourcentage + envoie de msg
function insert($numpjt,$user,$t,$pourcentage,$msg){
	$bd		=	new DB();
	if(isset($user)){
		$tache=$t;
		$x=sizeof($pourcentage);
		$j=0;
		for($i=0;$i<$x;$i++){
			//$p=(int)$pourcentage[$i];
			if($pourcentage[$i]!=""){
				$p[$j] = (int)$pourcentage[$i];
				$j++;
			}
		}
		$x=sizeof($user);
		for($i=0;$i<$x;$i++){
			$req = "INSERT INTO usertacheprojet VALUES ('".$numpjt."',$tache,$user[$i],$p[$i],0,0,null,null)";
			$bd->query($req);
		}
		//envoie_mail($numpjt, $msg);
	}	
}

// Modification de projet
function modif_projet($numpjt,$user,$t,$pourcentage,$msg){
	$bd		=	new DB();
	if(isset($user)){
		$tache=$t;
		$x=sizeof($pourcentage);
		$j=0;
		for($i=0;$i<$x;$i++){
			if($pourcentage[$i]!=""){
				$p[$j] = (int)$pourcentage[$i];
				$j++;
			}
		}
		$x=sizeof($user);
		for($i=0;$i<$x;$i++){
			$req = "SELECT	*
					FROM 	usertacheprojet 
					WHERE 	user_id = $user[$i] 
					AND 	tache_id = $tache 
					AND 	projet_id = '".$numpjt."'";
			$bd->query($req);
			$l = $bd->fetch();
			$nbre = $bd->nbre_lignes();
			$b = true;
			if($nbre == 0){
				$req = "INSERT INTO usertacheprojet VALUES ('".$numpjt."',$tache,$user[$i],$p[$i],0,0,null,null)";
				$bd->query($req);
				//test pour la suppression
				$b = false;
			}
			else{
				$req = "UPDATE 	usertacheprojet 
						SET 	pourcentage = $p[$i]
						WHERE 	projet_id = '".$numpjt."'
						AND		tache_id = $tache
						AND		user_id = $user[$i]";
				$bd->query($req);
				//test pour la suppression
				$b = false;
			}
		}
	// selection des user décochés
		$req = "SELECT 	user_id 
				FROM 	usertacheprojet
				WHERE	tache_id = $tache
				AND		projet_id = '".$numpjt."'
				AND 	user_id not in(";
		$ch="";
		for($j=0;$j<$x-1;$j++)
			$ch .=  $user[$j].",";
		
		$ch .=  $user[$x-1];
		$req .= $ch.")";
		//////
		$bd->query($req);
		while($l=$bd->fetch()){
			$r = "DELETE 
				  FROM usertacheprojet 
				  WHERE user_id = ".$l['user_id']."
				  AND 	tache_id = $tache
				  AND 	projet_id = '".$numpjt."'";
			$bd->query($r);
		}
		//envoie_mail($numpjt, $msg);
	}	
}

// Client formulaire ajout/insertion 
function client_form($action,$btval,$btnom,$val=0){
	$form = new formulaire("forme",$action,"post");
		echo "<table>";
		echo "<tr><th>Nom de la societe</th>
				  <td>";
				  		$form->input("text","nomst",$val[1]);
		echo"	  </td></tr>";
		echo "<tr><th><label>Telephone</label></th>
				  <td>";
				  		$form->input("text","tel",$val[2]);
		echo"	  </td></tr>";
		echo"<tr><th><label>Adresse</label></th>
				 <td>";
				 		$form->input("text","ad",$val[3]);
		echo"	 </td></tr>";
		echo"<tr><th><label>Site-web</label></th>
				 <td>";
				 		$form->input("text","site",$val[4]);
		echo"	 </td></tr>";
		echo "<tr><td align=right>";
						$form->input("submit","$btnom","  $btval  ");
		echo "	  </td>";
		echo "<td>";
						$form->input("reset","annuler","  Annuler  ");
		echo "	  </td></tr>";
		echo "</table>";
	$form->close();
}

function form_resp($action,$btnom,$btval,$val=0,$modification = false){
	$form = new formulaire("f",$action,"post");
		$bd   = new DB();
		$d   = new DB();
		
		echo "<table>";
		echo "<tr><th>Nom </th>
				  <td>";
				  		$form->input("text","nom",$val[1]);
		echo"	  </td></tr>";
		echo "<tr><th>Prenom </th>
				  <td>";
				  		$form->input("text","prenom",$val[2]);
		echo"	  </td></tr>";
		echo "<tr><th>GSM </th>
				  <td>";
				  		$form->input("text","gsm",$val[3]);
		echo"	  </td></tr>";
		echo "<tr><th>Couriel </th>
				  <td>";
				  		$form->input("text","mail",$val[4]);
		echo"	  </td></tr>";
		if(!$modification){
			echo "<tr><th>Login</th>
					  <td>";
					  		$form->input("text","login");
			echo"	  </td></tr>";
			echo "<tr><th><label>Mot de pass</label></th>
					  <td>";
					  		$form->input("password","pass","","",false,"pass");
			echo"	  </td></tr>";
			echo "<tr><th><label>Confirmer mot de pass</label></th>
					  <td>";
					  		$form->input("password","pass2","","",false,"pass2");
			echo"	  </td></tr>";
			echo "<tr><th>Grade</th>
					  <td>";
					  		$form->selelctopen("grade","grade");
					  		$req = "SELECT grade FROM user GROUP BY (grade)";
					  		$bd->query($req);
					  		while($l=$bd->fetch())
					  			$form->option($l['grade'],$l['grade']);
					  		$form->selectclose();
			echo"	  </td></tr>";
			$style = 'display:none;';
			echo "<tr><th><div id='th' style=$style>Résponsabilité</div></th>
				  <td><div id='tache' style=$style>";
				  		$req = "SELECT id_tache, libelle_tache FROM tache";
				  		$bd->query($req);
				  		while($l=$bd->fetch()){
				  			$form->input("checkbox","resp[]",$l['id_tache']);
				  			echo $l['libelle_tache']."<br>";
				  		}
			echo"	  </div></td></tr>";
		}
		else{
			$style = 'display:block;';
			echo "<tr><th><div id='th' style=$style>Résponsabilité</div></th>
				  <td><div id='tache' style=$style>";
				  		$req = "SELECT id_tache, libelle_tache FROM tache";
				  		$bd->query($req);
				  		while($l=$bd->fetch()){
				  			$b = false;
				  			$req = "SELECT tache_id FROM tacheuser WHERE user_id = $val[0]";
				  			$d -> query($req);
				  			while($data = $d -> fetch()){
					  			if($data['tache_id'] == $l['id_tache'])
					  				$b = true;
				  			}
				  			$form->input("checkbox","resp[]",$l['id_tache'],"",$b);
				  			echo $l['libelle_tache']."<br>";
				  		}
		echo"	  </div></td></tr>";
		}
		echo "<tr><td>";
						$form->input("submit",$btnom, $btval,"float:right;",false,"sub");
		echo "	  </td>";
		echo "<td>";
						$form->input("reset","annuler","  Annuler  ");
		echo "	  </td></tr>";
		echo "</table>";
		$form->close();
}

function affiche_client($d){
	$bd = new DB();
	$req = "SELECT * FROM client ORDER BY (nomste) LIMIT $d , 10";
	$bd->query($req);
	echo "<table class='clt'><tr>
					 <th>Nom société</th>
					 <th>Télephone</th>
					 <th>Adresse</th>
					 <th>Site Web</th>
					 <th>Modifier</th>
				 </tr>";
	while($l=$bd->fetch()){
		echo "<tr><td>".$l['nomste']."</td>
				  <td>".$l['tel']."</td>
				  <td>".$l['adresse']."</td>
				  <td>".$l['siteweb']."</td>
				  <td><center><a href='../CDP/?l=modif_client&nc=".$l['numclt']."'><img src='../style/image/modifier.png' style='border:none;'/></a></td></center>
			  </tr>";
	}
	echo "</table>";
}

//Affiche projet 

function projet_affichage($valid,$x,$r=""){
		$bd = new DB();
		$d  = new DB();
		if($r!="")
			$req = $r;
		else
			$req = "SELECT * 
					FROM projet P,client C
					WHERE P.numclt=C.numclt
					AND valide = $valid
					limit $x, 10";
		$bd->query($req);
		echo "<table><tr>
						 <th>Numéro de dossier</th>
						 <th>Projet</th>
						 <th>Client</th>
						 <th>Téléphone</th>
						 <th>Information</th>";
			if($valid==0)
				echo"	 <th>Modifier</th>";
				echo"	 <th>Production</th>";
			if($valid==0)	
				echo"	 <th>Valider</th>
						 <th>Annuler</th>";
				echo"</tr>";
		while($ligne=$bd->fetch()){
			$x=explode("-",$ligne['numpjt']);
			$dossier=implode("",$x);
			echo "<tr border=1>
					  <td>".$dossier."</td>
					  <td>".$ligne['nompjt']."</td>
					  <td>".$ligne['nomste']."</td>
					  <td>".$ligne['tel']."</td>";
			if($r!="") $valid = $ligne['valide'];			 
				 echo"<td><a href='../CDP/?l=info&np=".$ligne['numpjt']."&v=$valid";
				 echo"'><center><img src='../style/image/info.png' style='border:none;' alt='info sur le projet'/></a></center></td>";				 
			if($valid==0)
				echo" <td><a href='../CDP/?l=modif_projet&np=".$ligne['numpjt']."'><center><img src='../style/image/modifier.png' style='border:none;' alt='info sur le projet'/></a></center></td>";
			if($valid==1 && $r!="")echo" <td></td>";
			echo"	 <td><a href='../CDP/?l=prod&np=".$ligne['numpjt']."'><center><img src='../style/image/prod.png' style='border:none;' alt='info sur le projet'/></a></center></td>";	
			if($valid==0){
				echo" <td><a href='valid_pjt.php?np=".$ligne['numpjt']."'><center><img src='../style/image/valid.png' style='border:none;' alt='info sur le projet'/></a></center></td>";
					  $req = "SELECT nbre_h from usertacheprojet where projet_id ='".$ligne['numpjt']."'";
					  $d->query($req);
					  $b=false;
					  while($e=$d->fetch()){
						  if($e['nbre_h']!=0){
						  $b=true;
						  }
					  }
					  if(!$b){
						  echo "<td><a href='supp_projet.php?np=".$ligne['numpjt']."'><center><img src='../style/image/supp.png' style='border:none;' alt='supprimer  projet'/></a></center></td>";
					  }
					  else
					  	echo "<td></td>";
					  
					  $req = "SELECT debut, fin FROM projet where numpjt = '".$ligne['numpjt']."'";
					  $d->query($req);
					  $k = $d->fetch();
					  $f = $k['fin'];
					  $deb = $k['debut'];
					  $diff1 = date_difference($deb,$f);
					  $diff1 *= 20; 
					  $diff1 /= 100; //20% de la durée predefine
					  $diff1 = ceil($diff1);
					  $date = date("Y-m-d");
					  $diff = date_difference($date,$f);
					  $diff ++;
					  if ($diff<=$diff1){	
					  		if(ceil($diff/8)<=0){
					  			echo "<td><img src='../style/image/alert_red.png' class='alert' title = '";
					  			echo "Durée dépassée";
					  			echo"'></td>";
					  		}
					  		else{
					  			echo "<td><img src='../style/image/alert.png' class='alert' title = '";
					  			echo ceil($diff/8)." jour";
					  			if($diff != 1)echo"s";
					  			echo"'></td>";
					  		}
					  		
					  }
			}  
			echo"	  </tr>";
		}
		echo "</table>";
		
		$bd->close();
}