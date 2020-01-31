<?php
class charge{
	protected $id;
	protected $cp_id;
	protected $t_id;
	protected $ct_id;
	protected $amount;
	protected $paid;
	
	
	function __construct($id=0,$cp_id=0, $t_id=0, $ct_id=0, $amount=0, $paid=0){
		$this->id		=$id;
		$this->t_id		=$t_id;
		$this->cp_id	=$cp_id;
		$this->ct_id	=$ct_id;
		$this->amount	=$amount;
		$this->paid		=$paid;
		
	}
	function get($attr){
		return $this->$attr;
	}
	function set($attr, $val){
		$this->$attr=$val;
	}
	
	function add_me(){
		$bd = new DB();
		$req = "INSERT INTO `rentalsys`.`charge` (`id`,`title_id`,`copy_id`, `amount`,`customer_id`)
					VALUES ('','".$this->t_id."', '".$this->cp_id."', '".$this->amount."', '".$this->ct_id."')";
		// echo $req."<br>";
		$bd->query($req);
	}
	
	function pay_me(){
		$bd = new DB();
		$req = "UPDATE `rentalsys`.`charge` SET `paid`='1' WHERE id='".$this->id."'";
		// echo $req."<br>";exit(0);
		$bd->query($req);
	}
	
	function delete_me(){
		$bd = new DB();
		$req = "DELETE FROM `rentalsys`.`charge` WHERE id='".$this->id."'";
		// echo $req."<br>";exit(0);
		$bd->query($req);
	}
	
	function search_me(){
		$db = new DB();
		$req = "SELECT * FROM `rentalsys`.`charge` WHERE `title_id` ='".$this->t_id."' AND `copy_id` ='".$this->cp_id."'";
		// echo $req."<br>";
		$db->query($req);
		$l = $db->fetch();
		if(isset($l)){
			$this->id		= $l['id'];
			$this->amount	= $l['amount'];
			$this->ct_id	= $l['customer_id'];
			$this->paid		= $l['paid'];
			return 1;
		}
		else{
			return 0;
		}
	}
	
	function list_me(){
		$db = new DB();
		$req = "SELECT * FROM `rentalsys`.`charge` WHERE `paid`='0'";
		// echo $req."<br>";
		$db->query($req);
		$i=0;
		while($l = $db->fetch()){
			$charge[$i] = new charge($l['id'],$l['copy_id'],$l['title_id'],$l['customer_id'],$l['amount'],$l['paid']);
			// echo $charge[$i]->id."<br>";
			// echo $charge[$i]->cp_id."<br>";
			// echo $charge[$i]->t_id."<br>";
			// echo $charge[$i]->amount."<br>";	
			// echo $charge[$i]->ct_id."<br>";	
			// echo $charge[$i]->paid."<br><br>";
			$i++;
		}
		if($i>0)
			return $charge;
		else{
			return 0;
		}
	}
	
	function get_latecharges(){
		$db = new DB();
		$req = "SELECT * FROM `rentalsys`.`charge` WHERE `customer_id` ='".$this->ct_id."' AND paid='0'";
		// echo $req."<br>";exit(0);
		$db->query($req);
		$i=0;
		while($l = $db->fetch()){
			$char[$i]=new charge($l['id'],$l["copy_id"],$l['title_id'],$this->ct_id,$l['amount'],$l['paid']);
			// echo $char[$i]->get("id")."----";
			$i++;}
			 // exit(0);
			if($i)
				// echo "SET";
				return $char;
			else
				// echo "NOT SET";
				return 0;
			
	}
	
	function count_charges(){
		$db = new DB();
		$req = "SELECT count(id) as count FROM `rentalsys`.`charge` WHERE `customer_id` ='".$this->ct_id."' AND paid='0'";
		// echo $req."<br>";//exit(0);
		$db->query($req);
		$l = $db->fetch();
		return $l["count"];
	}
	
	function charge_amount($c){
		$db = new DB();
		$req = "SELECT SUM(amount) as total FROM `rentalsys`.`charge` WHERE `customer_id` ='".$c."'";
		// echo $req."<br>";
		$db->query($req);
		$l = $db->fetch();
		return $l['total'];
	}
	
}