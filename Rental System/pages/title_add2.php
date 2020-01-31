<?php
if(isset($_SESSION['MANAGER'])){

	include 'classes/bd.php';
	include'classes/title.php';
	include'classes/copy.php';
	include'classes/user.php';

	$user= new user();

	$t 	 = new title();

	$t->set("name",$_POST['name']);
	$t->set("year",$_POST['year']);
	$t->set("description", $_POST['desc']);
	$t->set("copies", $_POST['copies']);
	$t->set("genre", $_POST['genre']);
	$t->set("type", $_POST['type']);
	$t->set("price", $_POST['price']);
	$exist=0;
	$exist = $t->title_exist();
	$cp=0;
	if(!preg_match("/^[0-9]{2}$/", $_POST['copies']) and !preg_match("/^[0-9]{1}$/", $_POST['copies']))
		$cp=1;
	$price=0;
	if(!preg_match("/^[0-9]+$/",$_POST['price']))
		$price=1;
	
	// echo $t->get("genre")."<br>".$cp;exit(0);
	$year=0;
	if(!preg_match("/^[0-9]{4}$/", $t->get("year")))
		$year=1;

	$_SESSION["name2"]=$t->get("name");
	$_SESSION["year2"]=$t->get("year");
	$_SESSION["desc2"]=$t->get("description");
	$_SESSION["copies2"]=$t->get("copies");
	$_SESSION["genre2"]=$t->get("genre");
	$_SESSION["price2"]=$t->get("price");
	$_SESSION["type"]=$t->get("type");
		
		
	if($price or $exist or $t->get("name")=="Title Name" or $t->get("year")=="Year" or $year or $t->get("description")=="Description" or $t->get("copies")=="Number of copies" or $cp or $t->get("genre")=="genre"){
		
		if($t->get("name")=="Title Name" or $exist){
			$_SESSION["name"]=-1;
		}
		if($t->get("year")=="Year" or $year){
			$_SESSION["year"]=-1;
		}
		if($t->get("description")=="Description"){
			$_SESSION["desc"]=-1;
		}
		if($t->get("copies")=="Number of copies" or $cp){
			$_SESSION["copies"]=-1;
		}
		if($t->get("genre")=="genre"){
			$_SESSION["genre"]=-1;
		}
		if($price){
			$price = -1;
			$_SESSION["price"]="Price";
		}
		if($t->get("type")=="Type"){
			$_SESSION["type"]="Type";
		}
		
		
		$destination="./?page=title_add";
		
		// echo $t->get("name")."<br>".$t->get("year")."<br>".$t->get("description")."<br>".$t->get("copies")."<br>".$t->get("genre")."<br>".$t->get("type")."<br>".$_SESSION["price2"]."<br><br>";
		
		// echo $_SESSION["name"]."<br>".$_SESSION["year"]."<br>".$_SESSION["desc"]."<br>".$_SESSION["copies"]."<br>".$_SESSION["genre"];
	}
	else{
		$user->add_title($t);
		$user->search_title($t);
		// echo $t->get("name")."<br>".$t->get("year")."<br>".$t->get("description")."<br>".$t->get("copies")."<br>".$t->get("genre")."<br>".$t->get("type")."<br>".$t->get("price")."<br><br>";
		$c 	 = new copy(0,$t->get("id"),0,0,0);
		$c->add_me($t->get("copies"));
		$_SESSION["char"]= "title_add";
		$destination="./?page=info";
	}

	header("Location: ".$destination);
}
else
	header("Location: ./");
?>