<?php
class user{
	protected $id;
	protected $Fname;
	protected $Lname;
	protected $login;
	protected $pwd; //password
	function __construct($x=0,$lname=null,$fname=null){
		$this->id=$x;
		$this->Lname=$lname;
		$this->Fname=$fname;
		
	}
	function get($attr){
		return $this->$attr;
	}
	function set($attr, $val){
		$this->$attr=$val;
	}
	function authenticate($log, $pass){
		$bd = new DB();
		$pass = $pass;
		$req = "SELECT id, firstname, lastname, manager
				FROM user
				WHERE username='".$log."'
				AND   password='".$pass."'";
		$bd->query($req);
		$l 			= $bd->fetch();
		$manager 	= -1;
		if (isset($l['id'])){
			$id 		= $l['id'];
			$Fname 		= $l['firstname'];
			$Lname 		= $l['lastname'];
			$manager 	= $l['manager'];
		}
		$_SESSION['id']=$id;
		$_SESSION['Fname']=$Fname;
		$_SESSION['Lname']=$Lname;
		if($manager == 1){
			$_SESSION['MANAGER'] = 1;
			$destination = "./";
		}
		elseif($manager == 0){
			$_SESSION['MANAGER'] = 0;
			$destination = "./";
		}
		else{
			$_SESSION['MANAGER'] = -1;
			$destination = "./";
		}
		return $destination;
	}
	function add_account($log,$pass,$manager){
		$bd = new DB();
		$pass = $pass;
		
		
		$req = "INSERT INTO `rentalsys`.`user` (`id` ,`username` ,`password`,
				`firstname` ,`Lastname` ,`manager`) 
				VALUES ( NULL , '".$log."', '".$pass."', '".$this->Fname."', '".$this->Lname."', '".$manager."');";
		$bd->query($req);
		
	}
	function search_me(){
		$db = new DB();
		$req = "SELECT * FROM `rentalsys`.`customer` WHERE `customer_id` ='".$this->id."'";
		// echo $req."<br>";
		$db->query($req);
		$l = $db->fetch();
		$this->Fname	= $l['firstname'];
		$this->Lname	= $l['Lastname'];
	}
	function show_added_account(){
		$db = new DB();
		$req = "SELECT * FROM `rentalsys`.`user` ORDER BY id DESC LIMIT 1;";
		$db->query($req);
		$l = $db->fetch();
		$_SESSION["addFN"]		= $l['firstname'];
		$_SESSION["addLN"]		= $l['Lastname'];
		$_SESSION["addmanager"]	= $l['manager'];
		$_SESSION["addPWD"]		= $l['password'];
		$_SESSION["addLOG"]		= $l['username'];
	}
	
	function customer_exist($custID){
		$db = new DB();
		$req = "SELECT count( customer_id ) as count FROM `customer` WHERE `customer_id` ='".$custID."'";
		$db->query($req);
		$l = $db->fetch();
		if ($l["count"]!=0)
			return 1;
		else
			return 0;
	}
	
/////////Customer
	
	function add_customer($cust){
		$cust->add_me();
	}
	function modify_customer($cust){
		$cust->amodify_me();
	}
	function search_customer($cust){
		$cust->search_me();
	}
	function delete_customer($cust){
		$cust->delete_me();
	}
	function report_customers(){
		$c=new customer();
		$cust=$c->get_all();
		// echo sizeof($cust)."---------";
		return $cust;
	}
	function report_customers_with_charges(){
		$c=new customer();
		$cust=$c->get_all_with_late_charges();
		// echo sizeof($cust)."---------";
		return $cust;
	}
/////////Title
	
	function report_title(){
		$title = new title();
		$t=$title->get_all();
		$N		 = sizeof($t);
		// echo $N."tatata";
		// for($i=0;$i<$N;$i++)
			// echo $t[$i]->get("name")."<br>";
		return $t;
	}
	function add_title($t){
		$t->add_me();
	}
	function modify_title($t){
		$t->amodify_me();
	}
	function search_title($t){
		$t->search_me();
	}
	function delete_title($t){
		$t->delete_me();
	}	
	function available_copies($c){
		$this->available_copies($c);
	}
	

/////////Rentals
	function add_rental($r){
		$r->add_me();
	}
	function record_return($r){
		$r->return_me();
	}
	function search_rental($r){
		$r->search_me();
	}
	
///////////	Charges
	function add_charge($c){
		$c->add_me();
	}
	function pay_charge($c){
		$c->pay_me();
	}
	function search_charge($c){
		$c->search_me();
	}
	function list_charge($c){
		return $c->list_me();
	}
	
	
///////////Copy
	function get_copies_number(){
		$db = new DB();
		$req = "SELECT count( customer_id ) as count FROM `rental` WHERE `customer_id` ='".$this->id."'";
		$db->query($req);
		$l = $db->fetch();
		return $l["count"];
	}
}