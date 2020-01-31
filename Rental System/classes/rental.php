<?php
class rental{
	protected $id		;
	protected $t_id		;
	protected $cp_id		;
	protected $ct_id		;
	protected $rent;
	protected $back;
	protected $r_date;
	
	
	function __construct($id=0,$t_id=0,$cp_id=0, $ct_id=0, $rent=0, $back=0,$ret=0){
		$this->id		=$id;
		$this->t_id		=$t_id;
		$this->cp_id	=$cp_id;
		$this->ct_id	=$ct_id;
		$this->rent		=$rent;
		$this->back		=$back;
		$this->r_date	=$ret;
		
	}
	function get($attr){
		return $this->$attr;
	}
	function set($attr, $val){
		$this->$attr=$val;
	}
	
	function add_me(){
		$bd = new DB();
		$req = "INSERT INTO `rentalsys`.`rental` (`id`,`title_id`,`copy_id`, `rental_date`, `due_back`,`customer_id`)
					VALUES ('','".$this->t_id."', '".$this->cp_id."', '".$this->rent."', '".$this->back."', '".$this->ct_id."')";
		// echo $req."<br>";
		$bd->query($req);
	}
	
	function return_me(){
		$bd = new DB();
		$req = "UPDATE `rentalsys`.`rental` SET `return_date`='".$this->r_date."' WHERE copy_id='".$this->cp_id."'";
		$bd->query($req);
		$req = "UPDATE `rentalsys`.`copy` SET `rented`='0' WHERE copy_id='".$this->cp_id."'";
		$bd->query($req);
	}
	
	function search_me(){
		$db = new DB();
		$req = "SELECT * FROM `rentalsys`.`rental` WHERE `rental`.`title_id` ='".$this->t_id."' AND `rental`.`copy_id` ='".$this->cp_id."'";
		// echo $req."<br>";
		$db->query($req);
		$l = $db->fetch();
		if(isset($l)){
			$this->id				= $l['id'];
			$this->rdate			= $l['rental_date'];
			$this->bdate			= $l['due_back'];
			$this->ct_id			= $l['customer_id'];
			$this->r_date			= $l['return_date'];
			return 1;
		}
		else{
			return 0;
		}
	}
	function rentals_number($c){
		$db = new DB();
		$req = "SELECT count(id) as count FROM `rentalsys`.`rental` WHERE `rental`.`customer_id` ='".$c."'";
		// echo $req."<br>";
		$db->query($req);
		$l = $db->fetch();
		return $l['count'];
	}
}