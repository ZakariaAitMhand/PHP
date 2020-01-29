<?php
class client{
	protected $nomste;
	protected $tel;
	protected $adresse;
	protected $siteweb;
	protected $dossier;
	function __construct($nom,$gsm,$ad,$site){
		$this->nomste=$nom;
		$this->tel=$gsm;
		$this->adresse=$ad;
		$this->siteweb=$site;
	}
	function getClient($attr){
		return $this->$attr;
	}
	function setClient($attr,$x){
		$this->$attr=$x;	
	}
	function ajoutClient(){
		$nomrep="../projets/".$this->nomste."/";
			if (!file_exists($nomrep)){
					mkdir($nomrep);
			}
		$nomrep = addslashes($nomrep);
		$this->dossier = utf8_encode($nomrep);
		$bd = new DB();
		$req = "INSERT INTO `client` (`nomste` ,`tel` ,`adresse` ,`siteweb`,`dossier`)
				VALUES ('".en_coder($this->getClient("nomste"))."', '".en_coder($this->getClient("tel"))."', '".en_coder($this->getClient("adresse"))."', '".en_coder($this->getClient("siteweb"))."', '".en_coder($this->getClient("dossier"))."')";
		$bd->query($req);
		$bd->close();
		
	}
	
}