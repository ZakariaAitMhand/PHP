<?php
class projet{
	protected $nump;
	protected $rep;
	protected $nomp;
	protected $src;
	protected $description;
	protected $debut;
	protected $fin;
	protected $clt;
	protected $chemin;
	
	function __construct($nom="",$desc="",$numc="",$deb="",$fin=""){
		$this->nomp	= $nom;
		$this->description = $desc;
		$this->clt = $numc;
		$this->debut = $deb;
		$this->fin = $fin;
	}	
	function getProjet($attr){
		return $this->$attr;
	}
	function setProjet($attr,$x){
		$this->$attr=$x;	
	}
	function ajoutProjet(){
		$bd = new DB();
		$this->nomp = en_coder($this->nomp);
		$this->description = en_coder($this->description);
		$req = "INSERT INTO `projet`
				VALUES ('".$this->getProjet("nump")."', '".$this->getProjet("nomp")."', '".$this->getProjet("src")."', '".$this->getProjet("description")."', '".$this->getProjet("debut")."', '".$this->getProjet("fin")."',0, '".$this->getProjet("clt")."')";
		$bd->query($req);
		$bd->close();
	}
	function creernump(){
		$date=date('ym');
		$req="SELECT * FROM `projet` P,`client` C WHERE C.numclt=P.numclt";
		$bd = new DB();
		$bd->query($req);
		$num=0;
		while ($ligne=$bd->fetch()){
			$x=explode("-",$ligne['numpjt']);
			if($x[0]==$date && $x[1]==$this->clt){
				if($num<=(int)$x[2]){
					$num=(int)$x[2];
					$num++;
				}
			}				
		}
		if ($num==0)
			$num=1;
		if($num<10)	
			$num="0".$num;
		$bd->close();
		if($this->clt<10)
				$this->clt="0".$this->clt;
		$this->nump="$date-$this->clt-$num";
		$this->rep=$date.$this->clt.$num;
	}
	function upload(){
		//recuperation de chemin
		$req="SELECT dossier FROM `client` WHERE numclt =$this->clt";
		$bd = new DB();
		$bd->query($req);
		$l=$bd->fetch();
		$rep=$l['dossier'];
		
		
		//creation de dossier et upload des fichier
		$nomrep = $rep.$this->rep."/"; // \\nasanfa\Public\ANFA
		$this->chemin = $nomrep;
		if( isset($_POST['ajouter']) ){
			if (!file_exists($nomrep)){
				mkdir($nomrep);
				$devrep=$nomrep."/dev/";
					mkdir($devrep);
			}
			$this->src = upload_fichier($_FILES['upload'],$nomrep);
		}
	}
	function prod_upload($file,$t,$id,$e=0,$r=0){
		$bd = new DB();
		$existe=false;
		
		$this->chemin .= $this->rep."/dev/";
		if (file_exists($this->chemin.$id."-".$file['name']) && $r!=1 && $e!=1){
			//$this->chemin = str_replace('../', '', $this->chemin);
			
			//renommer le fichier existant
			$extension = substr($id."-".$file['name'], -4);
			$name = str_replace($extension, '', $file['name']);
			$name .= "_old".$extension;
			rename($this->chemin.$id."-".$file['name'],$this->chemin.$id."-".$name);
			
			$old=$this->chemin.$id."-".$name;
			$new=$this->chemin.$id."-".$file['name'];
			$_SESSION['new']=$new;
			$_SESSION['old']=$old;
			$_SESSION['file']= $file['name'];
			
			$_SESSION['id']=$id;
			$_SESSION['t']=$t;
			$_SESSION['np']=$this->nump;
			
			$_SESSION['destination']=$_SERVER["HTTP_REFERER"];
			$existe = true;
		}
		if($file['size']!=0){
			
			//uploader le nouveau fichier
			$this->src = upload_fichier($file,$this->chemin);
			echo $this->src;
			$req = "UPDATE 	usertacheprojet
					SET		fichier_prod = '".$id."-".$this->src."'
					WHERE	tache_id = $t
					AND		user_id  = $id
					AND		projet_id = '".$this->nump."'";
			$bd->query($req);
			
			$req = "SELECT fichier_prod
					FROM usertacheprojet
					WHERE	tache_id = $t
					AND		user_id  = $id
					AND		projet_id = '".$this->nump."'";
			$bd->query($req);
			$l=$bd->fetch();
			rename($this->chemin.$this->src,$this->chemin.$l['fichier_prod']);
		}
		if($e == 1){
			$old_file = str_replace('../', '', $_SESSION['old']);
			unlink($old_file);
		}
		if($existe){
			header("Location:../popup_remplacer.php");
			exit;
		}	
		
	}
}