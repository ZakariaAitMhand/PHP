<?php
class customer{
	protected $id;
	protected $Fname;
	protected $Lname;
	protected $address;
	protected $phone;
	function __construct($id=0,$lname=null,$fname=null,$address=NULL, $phone=NULL){
		$this->id		=$id;
		$this->Lname	=$lname;
		$this->Fname	=$fname;
		$this->address	=$address;
		$this->phone	=$phone;
		
	}
	function get($attr){
		return $this->$attr;
	}
	function set($attr, $val){
		$this->$attr=$val;
	}
	function get_allIDs(){
		$bd = new DB();
		$req = "SELECT *
				FROM customer
				ORDER BY `customer_id`";
		$bd->query($req);
		$i=0;
		while($l= $bd->fetch()){
			$cust[$i]=new customer($l['customer_id']);
			$i++;
		}
		return $cust;
	}
	function add_me(){
		$bd = new DB();
		$req = "INSERT INTO `rentalsys`.`customer` (`order`,`customer_id`, `firstname`, `Lastname`, `address`, `phone`, `no_of_rentals`, `no_of_latefees`)
				VALUES ('','".$this->id."','".$this->Fname."', '".$this->Lname."', '".$this->address."', '".$this->phone."','','')";
		$bd->query($req);
	}
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
	function customer_exist($custID){
		$db = new DB();
		$req = "SELECT * FROM `rentalsys`.`customer` WHERE `customer_id`='".$custID."' Limit 1";
		$db->query($req);
		$l = $db->fetch();
		if (isset($l["customer_id"]))
			return 1;
		else
			return 0;
	}
	function amodify_me(){
		$db = new DB();
		$req = "UPDATE `rentalsys`.`customer` SET `firstname` = '".$this->Fname."',`Lastname` = '".$this->Lname."', `address` = '".$this->address."',`phone` = '".$this->phone."' WHERE `customer_id` =".$this->id;
		$db->query($req);
	}
	function search_me(){
		$db = new DB();
		$req = "SELECT * FROM `rentalsys`.`customer` WHERE `customer`.`customer_id` =".$this->id;
		$db->query($req);
		$l = $db->fetch();
		$this->Fname		= $l['firstname'];
		$this->Lname		= $l['Lastname'];
		$this->address		= $l['address'];
		$this->phone		= $l['phone'];
		// return $cust;
	}
	function delete_me(){
		$db = new DB();
		$req = "DELETE FROM `rentalsys`.`customer` WHERE `customer`.`customer_id` =".$this->id;
		$db->query($req);
	}
	
	function get_all(){
		$db = new DB();
		
		$req = "Select * FROM `rentalsys`.`customer`";
		$db->query($req);
		$i=0;
		while($l= $db->fetch()){
			$cust[$i]=new customer($l['customer_id'],$l['firstname'],$l['Lastname'],$l['address'],$l['phone']);
			// echo $cust[$i]->get("id")."<br>";
			$i++;
		}
		return $cust;
	}
	function get_all_with_late_charges(){
		$db = new DB();
		$db2 = new DB();
		
		$req = "SELECT DISTINCT customer_id FROM `charge`";
		$db->query($req);
		$i=0;
		while($x= $db->fetch()){
		$req2 = "Select * FROM `customer` WHERE customer_id='".$x["customer_id"]."'";
			$db2->query($req2);
			$l= $db2->fetch();
			$cust[$i]=new customer($l['customer_id'],$l['firstname'],$l['Lastname'],$l['address'],$l['phone']);
			$i++;
			
		}
		return $cust;
	}
	
}