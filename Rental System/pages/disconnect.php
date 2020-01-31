<?php
// if(isset($_SESSION['MANAGER'])){
	session_unset();
	$destination="./";
	header("Location: ".$destination);
// }
?>