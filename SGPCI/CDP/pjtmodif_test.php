<?php
session_start();
include '../library/php/formulaire.php';
include '../library/php/bd.php';
$np = $_GET['np'];
$np = "1005-04-02";
$bd = new DB();
$base = new DB();
$bd2 = new DB();
$d = new DB();
$form = new formulaire("forme","modifprojet.php","post","multipart/form-data");
$req = "SELECT * 
		FROM projet,tache,user,usertacheprojet,client 
		WHERE numpjt=projet_id
		AND tache_id=id_tache
		AND user_id=id
		AND projet.numclt=client.numclt
		AND numpjt ='".$np."'";
$base->query($req);
$t=$base->fetch();
echo "<table>";
echo "<tr><th>Nom du projet</th>
		  <td>";
		  		echo $t['nompjt'];
echo"	  </td></tr>";
$req = "SELECT nomste FROM client";
$bd->query($req);
echo"<tr><th><label>Client</label></th>
		 <td>";
		 		$form->selelctopen("clt");
		 		while($ligne=$bd->fetch()){
		 			$val=$ligne['nomste'];
		 			$s=false;
		 			if($val==$t['nomste']){
		 				$s=true;
		 			}
		 			$form->option($val,$s);
		 		}
		 		$form->selectclose();
echo"	 </td></tr>";

echo "<tr><th><label>Description</label></th>
		  <td>";
		  		$form->area("desc",$t['description']);
echo"	  </td></tr>";
$req = "SELECT libelle_tache FROM tache ";
$bd->query($req);
while($l=$bd->fetch()){
	$x = $l['libelle_tache'];
	$r=explode(" ",$x);
	$k=implode("",$r);
	echo"<tr><th><label>$x</label></th>";
	echo"	 <td>";
					$request = "SELECT id, nom, prenom ,id_tache
								FROM user, tache, tacheuser
								WHERE id = user_id
								AND id_tache = tache_id
								AND libelle_tache = '$x'
								AND grade = 'technicien'";	
					$d->query($request);
			 		while($ligne=$d->fetch()){
			 			$chek=false;
			 			$r="SELECT projet_id 
			 				FROM usertacheprojet
			 				WHERE user_id=".$ligne['id']."
			 				AND tache_id= ".$ligne['id_tache']."
			 				AND projet_id = $np";
			 			echo $r.'gggg';
			 			$bd2->query($r);
			 			if($q=$bd2->fetch())
			 				$chek=true;
			 			$val=$ligne['id'];
			 			$form->input("checkbox",$k."resp[]",$val,$chek);
			 			//echo $ligne['nom']." - ".$ligne['prenom']."<br>";
			 		}
			 		$form->selectclose();
	echo	  $form->input('text',$k.'%',$t['pourcentage'],'width:30px;')."%</td></tr>";
}
			 			////////////////////
echo"<tr><th><label>fichiers sources</label></th>
		 <td>";
		 		$form->input("file","upload");
echo"	 </td></tr>";
echo"<tr><th><label>Date-début</label></th>
		 <td>";
		 		$form->input("text","debut",date('Y-m-d'));
echo"	 </td></tr>";
echo"<tr><th><label>Date-fin</label></th>
		 <td>";
		 		$form->input("text","fin",date('Y-m-d'));
echo"	 </td></tr>";
echo "<tr><td align=right>";
				$form->input("submit","ajouter","  Ajouter  ");
echo "	  </td>";
echo "<td>";
				$form->input("reset","annuler","  Annuler  ");
echo "	  </td></tr>";
echo "</table>";
$form->close();