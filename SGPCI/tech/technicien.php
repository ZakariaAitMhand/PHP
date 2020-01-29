<?php
include '../user.php';
class technicien extends user{
	function __construct($x){
		parent::__construct($x);
		$this->set("role","Technicien");
	}
	function affiche_projet($d,$id,$valid,$cdp=false,$np=""){
		$bd = new DB();
		$bd2 = new DB();
		
		$img = "prod.png";
		$destination = "tech_prod_historique.php";
		$req = "SELECT *
				FROM tache, projet p, user u, client c, usertacheprojet utp
				WHERE u.id = utp.user_id
				AND p.numclt = c.numclt
				AND tache_id = id_tache
				AND p.numpjt = utp.projet_id
				AND u.id = $id
				AND validation=$valid 
				ORDER BY debut DESC
				LIMIT $d , 10 ";
		if($np!=""){
		$req = "SELECT * 
				FROM tache, projet p, user u, client c, usertacheprojet utp
				WHERE u.id = utp.user_id
				AND p.numclt = c.numclt
				AND tache_id = id_tache
				AND p.numpjt = utp.projet_id
				AND u.id = $id
				AND validation=$valid 
				AND		(numpjt 	like '%".$np."%'
				OR		description like '%".$np."%'
				OR		libelle_tache like '%".$np."%'
				OR		nomste	 	like '%".$np."%'
				OR		nompjt 		like '%".$np."%')
				ORDER BY  (debut) desc
				LIMIT $d , 10 ";
		}
		$bd->query($req);
		$nbr = $bd->nbre_lignes();
		if($nbr!=0){
			echo "<table><tr>
						 <th>Numéro de dossier</th>
						 <th>Projet</th>
						 <th>Tache a faire</th>
						 <th>Client</th>
						 <th>date debut</th>
						 <th>date fin</th>";
			if($valid == 0 && !$cdp)
			echo"		<th>Vaider</th>";
			echo"		<th>Fichiers sources</th>";
			if(!$cdp)
			echo"		<th>Production</th></tr>";
		}
		while ($l = $bd->fetch()){
			$x=explode("-",$l['numpjt']);
			$dossier=implode("",$x);
			echo "<tr>
					  <td>".$dossier."</td>
					  <td>".$l['nompjt']."</td>
					  <td>".$l['libelle_tache']."</td>
					  <td>".$l['nomste']."</td>";
							$deb = $l['debut'];
							$tt = explode("-",$deb);
							$xx = $tt[0];
							$tt[0] = $tt[2];
							$tt[2] = $xx;
							$deb = implode("-",$tt);
				echo	  "<td>".$deb."</td>";
							$fin = $l['fin'];
							$tt = explode("-",$fin);
							$xx = $tt[0];
							$tt[0] = $tt[2];
							$tt[2] = $xx;
							$fin = implode("-",$tt);
							
				echo 	 "<td>".$fin."</td>";
			if($np!=""){
				$valid = $l['validation'];
			}
			if($valid == 1 && $np!="")
				echo"<td></td>";
			if($valid == 0 && !$cdp){
					  	$img = "upload.png";
					  	$destination = "../TECH/?l=prod_h&";
			echo"	  <td><center><a href='../TECH/?l=valider&np=".$l['numpjt']."&th=".$l['id_tache']."&us=".$l['id']."'><img src='../style/image/valid.png' style='border:none;'/></a></center></td>";
			}
			else {
				$img = "prod.png";
				$destination = "../TECH/?l=prod&";
			}
			echo"	  <td><center><a href='tech_download.php?np=".$l['numpjt']."&th=".$l['id_tache']."&us=".$l['id']."'><img src='../style/image/dowload(d).png' style='border:none;'/></a></td></center>";
			if(!$cdp)
			echo"	  <td><center><a href='".$destination."np=".$l['numpjt']."&th=".$l['id_tache']."&us=".$l['id']."'><img src='../style/image/$img' style='border:none;'/></a></td></center>";
			if($valid == 0 && !$cdp){		  
					  $req = "SELECT debut,fin FROM projet where numpjt = '".$l['numpjt']."'";
					  $bd2->query($req);
					  $k = $bd2->fetch();
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
			echo"</tr>";
		}
		echo "</table>";
		return $nbr;
	}
	function validation_tache($nbre_h,$t,$id,$np){
		valider_tache($nbre_h,$t,$id,$np);
	}
}
