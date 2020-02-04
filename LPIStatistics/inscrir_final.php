<?php
session_start();
?>
<?php

if($_SESSION['laureat']=="" ){
header('location: laureat.php');
}
else { ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en"><!-- InstanceBegin template="/Templates/index.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->

</head>

<body>
<?php
 include 'connections/Connexion.php';
 $cin = $_SESSION['cin'];
 $nom_laureat = $_SESSION['name'];
 $prenom = $_SESSION['prenom'];
 $num_GSM = $_SESSION['num_GSM'] ;
 $promo = $_SESSION['promo'];
 $pass = $_SESSION['pass'];
 


$var = $_GET['var'] ;

switch( $var)
{
	case 'travail' : 
	
	{
	$nom = $_POST['nom_e'] ;
	$specialite = $_POST['domain'] ;
	$ville = $_POST['c_city'] ;
	$salaire = $_POST['salary'] ;

	
	$sql1='INSERT INTO laureat values("'.$cin.'", "'.$nom_laureat.'", "'.$prenom.'", "'.$num_GSM.'","'.$promo.'" , "'.$pass.'", "'.$var.'")';
  	$sql1='INSERT INTO laureat values("'.$cin.'", "'.$nom_laureat.'", "'.$prenom.'", "'.$num_GSM.'","'.$nom.'" , "'.$specialite.'", "'.$ville.'","'.$salaire.'")';
	if(mysql_query("INSERT INTO laureat values('$cin','$nom_laureat', '$prenom', '$num_GSM','$promo', '$pass','$var')")) echo 'insertion réussi!';
	 if(mysql_query("INSERT INTO employee values('$cin','$nom','$specialite', '$ville', '$salaire')"))
{	 
	// $id_laureat = mysql_insert_id() ;
	//$sql2='INSERT INTO societe VALUES ("","'.$nom.'" , "'.$specialite.'", "'.$ville.'","'.$salaire.'", "'.$id_laureat.'")';
    //   mysql_query($sql2);                      
  
?>
<script language="javascript">
alert("inscription reussite !!!!");
window.location="index.php";
</script>
<?php
}
else {
?>
<script language="javascript">
alert("inscription echoué !!!!");
window.location="index.php";
</script>
<?php
}
}
break ;
case 'etude' : 
	
	{
	$type = $_POST['type_etude'] ;
	$specialite = $_POST['specialite'] ;
	$etablissement = $_POST['nom_etablissement'] ;
	$ville = $_POST['ville'] ;

	
	
	if(mysql_query("INSERT INTO laureat values('$cin','$nom_laureat', '$prenom', '$num_GSM','$promo', '$pass','$var')")) echo 'insertion réussi!';
	 if(mysql_query("INSERT INTO etude values('$cin','$type','$specialite', '$etablissement', '$ville')"))
{	 
	// $id_laureat = mysql_insert_id() ;
	//$sql2='INSERT INTO societe VALUES ("","'.$nom.'" , "'.$specialite.'", "'.$ville.'","'.$salaire.'", "'.$id_laureat.'")';
    //   mysql_query($sql2);                      
  
?>
<script language="javascript">
alert("inscription reussite !!!!");
window.location="index.php";
</script>
<?php
}
else {
?>
<script language="javascript">
alert("inscription echoué !!!!");
window.location="index.php";
</script>
<?php
}
}
break ;

case 'recherche' : 

{
	$master = $_POST['masterO'] ;
	
	if(mysql_query("INSERT INTO laureat values('$cin','$nom_laureat', '$prenom', '$num_GSM','$promo', '$pass','$var')")) echo 'insertion réussi!';
	 if(mysql_query("INSERT INTO cherche values('$cin','$master')"))
{	 
	// $id_laureat = mysql_insert_id() ;
	//$sql2='INSERT INTO societe VALUES ("","'.$nom.'" , "'.$specialite.'", "'.$ville.'","'.$salaire.'", "'.$id_laureat.'")';
    //   mysql_query($sql2);                      
  

?>
<script language="javascript">
alert("inscription reussite !!!!");
window.location="index.php";
</script>
<?php
}
else {
?>
<script language="javascript">
alert("inscription echoué !!!!");
window.location="index.php";
</script>
<?php
}
}
break ;

	
		default : echo "choix introuvable !!!";
}

?>

</body>
</html>
<?php
}
?>