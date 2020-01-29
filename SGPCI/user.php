<?php
class user{
	protected $id;
	protected $nom;
	protected $prenom;
	protected $gsm;
	protected $login;
	protected $pass;
	protected $grade;
	function __construct($x,$lname=null,$fname=null){
		$this->id=$x;
		$this->nom=$lname;
		$this->prenom=$fname;
		
	}
	function get($attr){
		return $this->$attr;
	}
	function set($attr, $val){
		$this->$attr=$val;
	}
	function authentifier($log, $pass){
		$bd = new DB();
		$pass = md5($pass);
		$req = "SELECT id, nom, prenom, grade 
				FROM user
				WHERE login='".$log."'
				AND   pass='".$pass."'";
		$bd->query($req);
		$l = $bd->fetch();
		$id 	= $l['id'];
		$nom 	= $l['nom'];
		$prenom = $l['prenom'];
		$grade 	= $l['grade'];
		if($grade == "cdp"){
			$_SESSION['id']=$id;
			$_SESSION['nom']=$nom;
			$_SESSION['prenom']=$prenom;
			$_SESSION['grade'] = "CDP";
			$destination = "CDP/";
			return $destination;
		}
		else if($grade == "technicien"){
			$_SESSION['id']=$id;
			$_SESSION['nom']=$nom;
			$_SESSION['prenom']=$prenom;
			$_SESSION['grade']="tech";
			$destination = "TECH/";
			return $destination;
		}
		else{
			$destination = "../SGCPI/";
			return $destination;
		}
	}
	function modifier_compte($id, $log, $pass){
		$bd = new DB();
		$pass = md5($pass);
		$req = "UPDATE user
				SET login ='".$log."', pass ='".$pass."'
				WHERE id = $id";
		$bd->query($req);
	}
}