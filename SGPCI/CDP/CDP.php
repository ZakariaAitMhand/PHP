<?php
include "../user.php";

class CDP extends user{
	function __construct($x){
		parent::__construct($x);
		$this->set('grade','CDP');
	}

	function afficher_client(){
		$bd = new DB();
		$req = "SELECT * FROM client";
		$bd->query($req);
		$x= $bd->nbre_lignes();
		$x=$x/10;
		if(!empty($_GET['x']))
			$d=$_GET['x']*10;
		else 
			$d=0;
		
		affiche_client($d);
		
		echo "<br><p class='pag'><b>Page : </b>";
			for($i=0;$i<$x;$i++){
				$j=$i+1;
				echo "<a href='index.php?l=mes_clients&x=".$i."' class='pagination'>$j</a>  ";
			}
			echo "</p>";
	}
	
	function affichProjet($x){
		projet_affichage(0,$x);
	}
	
	function historiqueProjet($x){
		projet_affichage(1,$x);
	}
	
	function mon_equipe($x){
			$bd = new DB();
			$d  = new DB();
			$req = "SELECT * 
					FROM user
					Where grade = 'technicien'
					LIMIT $x , 10";
			$bd->query($req);
			echo "<table><tr>
							 <th>Nom</th>
							 <th>Prenom</th>
							 <th>GSM</th>
							 <th>Couriel</th>
							 <th>Tache</th>
							 <th>Modifier</th>
							 <th>Supprimer</th>
						 </tr>";
			while($ligne=$bd->fetch()){
				$id = $ligne['id'];
				echo "<tr>
						  <td>".$ligne['nom']."</td>
						  <td>".$ligne['prenom']."</td>
						  <td>".$ligne['gsm']."</td>
						  <td>".$ligne['mail']."</td>
						  <td>";
						  $req = "SELECT libelle_tache 
						  		  FROM 	 tache, user ,tacheuser
						  		  WHERE	id_tache = tache_id
						  		  AND   id = user_id 
						  		  AND 	id = ".$ligne['id'];
						  $d->query($req);
						  while($l=$d->fetch()){
				echo	  		"-".$l['libelle_tache']."<br>";
						  }
				echo"	  </td><td><a href='../CDP/?l=modif_equipe&id=".$id."'><center><img src='../style/image/modifier.png' style='border:none;' alt='info sur le projet'/></a></center></td>";
						  	   
						  $req = "SELECT tache_id from usertacheprojet where user_id ='".$id."' AND validation =0";
						  $d->query($req);
						  $n = $d->nbre_lignes();
						  if($n==0){
						  		echo "<td><a href='supp_resp.php?id=".$id."' onclick='"."alert(tatatat)"."'><center><img src='../style/image/supp.png' style='border:none;' alt='info sur le projet'/></a></center></td>";
						  		echo "<td><img src='../style/image/free.png'></td>";
						  }
						  else{
						  		echo "<td></td><td><a href='../TECH/?resp=".$id."&l=mon_equipe'><img style='border:none;' src='../style/image/busy.png'></a></td>";
						  }
				echo"	  </tr>";
			}
			echo "</table>";
			
			$bd->close();
	}
	
	function valider_tache($np,$id,$t,$nbre_h){
		$x = explode("-",$np);
		$nump = implode('',$x);
		$pj = new projet();
		$bd = new DB(); 
		$req = "SELECT dossier FROM projet p, client c WHERE p.numclt=c.numclt AND numpjt= '".$np."'";
		$bd->query($req);
		$l=$bd->fetch();
		$pj->setProjet("chemin",$l['dossier']);
		$pj->setProjet("nump",$np);
		$pj->setProjet("rep",$nump);
		valider_tache($nbre_h,$t,$id,$np);
		$pj->prod_upload($_FILES['prod'],$t,$id);
	}

	function valider_projet($np){
		$bd = new DB();
		$req = "SELECT tache_id, validation from usertacheprojet WHERE projet_id = '".$np."'";
		$b = true;
		$bd->query($req);
		while ($l =$bd->fetch()){
			if($l["validation"]==0)
			$b = false;
		}
		if (!$b){
			if($_SERVER["HTTP_REFERER"]=="http://localhost/eclipse%20php/SGCPI/CDP/")
				$pre = "?";
			else 
				$pre = "&";
				$destination = $_SERVER["HTTP_REFERER"].$pre.'b=0';
				return $destination;
		}
		else{
			$req = "UPDATE projet
					SET valide = 1 
					WHERE numpjt ='".$np."'";
			$bd->query($req);
			$destination = $_SERVER["HTTP_REFERER"];
			return $destination;
		}
	}

	function ajout_responsable($nom,$prenom,$gsm,$mail,$log,$pass,$grade){
		$bd = new DB();
		$pass = md5($pass);
		$req = "INSERT INTO user VALUES (null,'".$nom."','".$prenom."','".$gsm."','".$mail."','".$log."','".$pass."','".$grade."')";
		$bd->query($req);
		$req = "SELECT id FROM user
				ORDER BY id DESC
				LIMIT 1";
		$bd->query($req);
		$l = $bd->fetch();
		$id = $l['id'];
		if($grade == "technicien"){
			if(isset($_POST['resp']))
				$resp = $_POST['resp'];
				$x=count($resp);
			for($i=0;$i<$x;$i++){
				$req = "INSERT INTO tacheuser VALUES (".$id.",".$resp[$i].")";
				$bd->query($req);
			}
		}
	}

	function ajout_projet($nomp, $nomclt, $desc, $deb, $fin){
		$message = "$nomp<br>$nomclt<br>$desc<br>";
		
		$bd		=	new DB();
		$req	=	"SELECT numclt FROM `client` WHERE nomste='".$nomclt."'";
		$bd->query($req);
		$l 		=	$bd->fetch();
		$pj 	=	new projet($nomp, $desc, $l['numclt'],$deb,$fin);
		$pj->creernump();
		$pj->upload();
		$pj->ajoutProjet();
		// reconnection à cause du query error
		$bd->reconnect();
		$bd->query($req);
		$l = $bd->fetch();
		// envoie de message // Ajout dans les table usertacheprojet et user tache
		
		insert($pj->getProjet('nump'),$_POST['Developpementresp'],1,$_POST['Developpement%'],$message);
		insert($pj->getProjet('nump'),$_POST['IntegrationCSS-XHTMLresp'],2,$_POST['IntegrationCSS-XHTML%'],$message);
		insert($pj->getProjet('nump'),$_POST['Integratione-mailresp'],3,$_POST['Integratione-mail%'],$message);
		insert($pj->getProjet('nump'),$_POST['Flashresp'],4,$_POST['Flash%'],$message);
		insert($pj->getProjet('nump'),$_POST['Webdesignresp'],5,$_POST['Webdesign%'],$message);
		$bd->close();
	}
}