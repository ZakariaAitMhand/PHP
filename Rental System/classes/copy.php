<?php
class copy{
	protected $id		;
	protected $t_id		;
	protected $damaged		;
	protected $reserved		;
	protected $rented		;
	
	function __construct($id=0,$t_id=0,$damaged=0,$reserved=0, $rented=0){
		$this->id		=$id;
		$this->t_id	=$t_id;
		$this->damaged	=$damaged;
		$this->reserved=$reserved;
		$this->rented	=$rented;
		
	}
	function get($attr){
		return $this->$attr;
	}
	function set($attr, $val){
		$this->$attr=$val;
	}
	
	function get_allIDs($cust){
		$bd = new DB();
		$req = "SELECT *
				FROM rental
				WHERE customer_id ='".$cust."'
				ORDER BY copy_id";
		$bd->query($req);
		$i=0;
		while($l= $bd->fetch()){
			$cp[$i]=new copy($l['copy_id'],$l['title_id']);
			$i++;
		}
		return $cp;
	}
	
	function get_all(){
		$bd = new DB();
		$req = "SELECT *
				FROM copy WHERE title_id ='".$this->t_id."'
				ORDER BY `copy_id`";
		$bd->query($req);
		$i=0;
		while($l= $bd->fetch()){
			$cp[$i]=new copy($l['copy_id'], $l['title_id'], $l['damaged'], $l['reserved'], $l['rented']);
			$i++;
		}
		return $cp;
	}
	
	function add_me($nb){
		$bd = new DB();
		for($i=0;$i<$nb;$i++){
			$req = "INSERT INTO `rentalsys`.`copy` (`copy_id`,`title_id`,`damaged`, `reserved`, `rented`)
					VALUES ('','".$this->t_id."', '".$this->damaged."', '".$this->reserved."', '".$this->rented."')";
			$bd->query($req);
		}
	}
	
	function amodify_me(){
		$db = new DB();
		$req = "UPDATE `copy` SET `damaged` = '".$this->damaged."',`reserved` = '".$this->reserved."', `rented` = '".$this->rented."' WHERE `copy_id` =".$this->id;
		$db->query($req);
	}
	
	function delete_me(){
		$db = new DB();
		$req = "DELETE FROM `copy` WHERE `title_id` ='".$this->t_id."'";
		$db->query($req);
	}
	function available(){
		$db = new DB();
		$req = "SELECT count(copy_id) as available FROM `copy` WHERE `title_id` ='".$this->t_id."' AND `rented`=0";
		$db->query($req);
		$l= $db->fetch();
		// echo "available = ".$l["available"];
		return $l["available"];
	}
	function get_ID(){
		$db = new DB();
		$req = "SELECT copy_id FROM `copy` WHERE `title_id` ='".$this->t_id."' AND `rented`=0 Limit 1";
		// echo $req."<br>";
		$db->query($req);
		$l= $db->fetch();
		$this->id=$l["copy_id"];
	}
	function rent(){
		$db = new DB();
		$req = "UPDATE `copy` SET `rented` = '1' WHERE `copy_id` =".$this->id;
		// echo $req."<br>";
		$db->query($req);
	}
	
	function search_me(){
		$db = new DB();
		$req = "SELECT * FROM `rentalsys`.`copy` WHERE `copy`.`title_id` ='".$this->t_id."'";
		
		$db->query($req);
		$i=0;
		while($l = $db->fetch()){
			$this->id				= $l['copy_id'];
			$this->damaged			= $l['damaged'];
			$this->reserved			= $l['reserved'];
			$this->rented			= $l['rented'];
			$c[$i]= new copy($this->id,$this->t_id,$this->damaged,$this->reserved,$this->rented); 
			$i++;
		}
		return $c;
	}
	
	
	
	
	// function get_allnames(){
		// $bd = new DB();
		// $req = "SELECT *
				// FROM title
				// ORDER BY `name`";
		// $bd->query($req);
		// $i=0;
		// while($l= $bd->fetch()){
			// $t[$i]=new title($l['title_id'],$l['name']);
			// $i++;
		// }
		// return $t;
	// }
	
	
	
	
	// function title_exist(){
		// $db = new DB();
		// $req = "SELECT * FROM `rentalsys`.`title` WHERE `name`='".$this->name."' Limit 1";
		// $db->query($req);
		// $l = $db->fetch();
		// if (isset($l["name"]))
			// return 1;
		// else
			// return 0;
	// }
	
	
	
	
	/*
	function show_added_account(){
		$db = new DB();
		$req = "SELECT * FROM `rentalsys`.`customer` ORDER BY `order` DESC LIMIT 1;";
		$db->query($req);
		$l = $db->fetch();
		
		$_SESSION["addcustid"]		= $l['customer_id'];
		$_SESSION["addFN"]			= $l['firstname'];
		$_SESSION["addLN"]			= $l['Lastname'];
		$_SESSION["addaddress"]		= $l['address'];
		$_SESSION["addphone"]		= $l['phone'];
	}
	*/
}