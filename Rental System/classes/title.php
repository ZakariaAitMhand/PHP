<?php
class title{
	protected $id;
	protected $name;
	protected $year;
	protected $description;
	protected $copies;
	protected $type;
	protected $price;
	protected $genre;
	
	function __construct($id=0,$name=null,$year=null,$description=NULL, $copies=NULL, $genre=NULL){
		$this->id			=$id;
		$this->name			=$name;
		$this->year			=$year;
		$this->description	=$description;
		$this->copies		=$copies;
		$this->genre		=$genre;
		
	}
	function get($attr){
		return $this->$attr;
	}
	function set($attr, $val){
		$this->$attr=$val;
	}
	
	function get_all(){
		$bd = new DB();
		$req = "SELECT *
				FROM title
				ORDER BY `year`";
		$bd->query($req);
		$i=0;
		while($l= $bd->fetch()){
			// echo $l["name"]."<br>";
			$title[$i]=new title($l['title_id'], $l['name'], $l['year'], $l['description'], $l['nb_copies'], $l['genre']);
			$i++;
		}
		return $title;
	}
	
	function add_me(){
		$bd = new DB();
		$req = "INSERT INTO `rentalsys`.`title` (`title_id`,`name`,`year`, `description`, `nb_copies`, `genre`, `price`, `type`)
				VALUES ('','".$this->name."', '".$this->year."', '".$this->description."', '".$this->copies."', '".$this->genre."', '".$this->price."', '".$this->type."')";
		$bd->query($req);
		
	}
	function get_allnames(){
		$bd = new DB();
		$req = "SELECT *
				FROM title
				ORDER BY name";
		$bd->query($req);
		$i=0;
		while($l= $bd->fetch()){
			$t[$i]=new title($l['title_id'],$l['name']);
			$i++;
		}
		return $t;
	}
	
	function search_me($id=0){
		$db = new DB();
		if($id)
			$req = "SELECT * FROM `rentalsys`.`title` WHERE `title`.`title_id` ='".$id."'";
		elseif($this->id)
			$req = "SELECT * FROM `rentalsys`.`title` WHERE `title`.`title_id` ='".$this->id."'";
		else
			$req = "SELECT * FROM `rentalsys`.`title` WHERE `title`.`name` ='".$this->name."'";
			
		// echo $req;
		$db->query($req);
		$l = $db->fetch();
		$this->id				= $l['title_id'];
		$this->name				= $l['name'];
		$this->year				= $l['year'];
		$this->description		= $l['description'];
		$this->copies			= $l['nb_copies'];
		$this->genre			= $l['genre'];
	}
	
	function title_exist(){
		$db = new DB();
		$req = "SELECT * FROM `rentalsys`.`title` WHERE `name`='".$this->name."' Limit 1";
		$db->query($req);
		$l = $db->fetch();
		if (isset($l["name"]))
			return 1;
		else
			return 0;
	}
	
	function delete_me(){
		$db = new DB();
		$req = "DELETE FROM `rentalsys`.`title` WHERE `title`.`name` ='".$this->name."'";
		$db->query($req);
	}
	
	function delete_copies($c){
		return $c->delete_me();
	}
	
	function available_copies($c){
		return $c->available();
	}
	function overdue($c){
		$db = new DB();
		$db2 = new DB();
		$d = Date("Y-m-d");
		$req = "SELECT title_id FROM `rentalsys`.`rental` WHERE due_back< '".$d."' AND customer_id='".$c."'";
		$db->query($req);
		$i=0;
		while($x = $db->fetch()){
			$r = "select name from title where title_id='".$x["title_id"]."'";
			$db2->query($r);
			$l = $db2->fetch();
				$t[$i]=$l["name"];
				$i++;
		}
		
		return $t;
	}
	
}