<?php
class reservation{
	protected $id;
	protected $t_id;
	protected $ct_id;
	protected $priority;
	
	function __construct($id=0,$t_id=0,$ct_id=0,$priority=0){
		$this->id		=$id;
		$this->t_id		=$t_id;
		$this->ct_id	=$ct_id;
		$this->priority	=$priority;
		
	}
	function get($attr){
		return $this->$attr;
	}
	function set($attr, $val){
		$this->$attr=$val;
	}
	
	function get_all($cust){
		$bd = new DB();
		$req = "SELECT *
				FROM reservation";
		$bd->query($req);
		$i=0;$flag=0;
		while($l= $bd->fetch()){
			$flag=1;
			$res[$i]=new reservation($l['id'],$l['copy_id'],$l['title_id'],$l['customer_id'],$l['priority']);
			$i++;
		}
		if($flag)
			return $res;
		else
			return 0;
	}
	function add_me(){
		$bd = new DB();
		$req = "INSERT INTO `rentalsys`.`reservation` (`id`,`title_id`,`customer_id`,`priority`)
					VALUES ('','".$this->t_id."','".$this->ct_id."', '".$this->priority."')";
		$bd->query($req);
	}
	function get_priority(){
		$bd = new DB();
		$req = "SELECT * FROM `reservation` where `title_id`='".$this->t_id."'";
		$bd->query($req);
		$i=0;
		while($l= $bd->fetch()){
			$i++;
		}
		return $i;
	}
	
	function delete_me(){
		$db = new DB();
		$req = "DELETE FROM `reservation` WHERE `id` ='".$this->id."'";
		$db->query($req);
	}
	function select_reservation(){
		$bd = new DB();
		$req = "SELECT * FROM `reservation` where `customer_id`='".$this->ct_id."'";
		$bd->query($req);
		$i=0;
		while($l= $bd->fetch()){
			$res[$i]=new reservation($l['id'],$l['Title_id'],$l['customer_id'],$l['priority']);
			$i++;
		}
		if($i>0)
			return $res;
		else
			return 0;
	}
}