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
 
 


$var = $_GET['var'] ;

switch( $var)
{
	case 'travail' : 
	
	{
	$nom = $_POST['nom_e'] ;
	$specialite = $_POST['domain'] ;
	$ville = $_POST['c_city'] ;
	$salaire = $_POST['salary'] ;
	 if(mysql_query("INSERT INTO employee values('$cin','$nom','$specialite', '$ville', '$salaire')"))
{
?>
<script language="javascript">
window.location="index.php";
</script>
<?php
}
else{
?>
<script language="javascript">
alert("echoué");
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

	
	
	 if(mysql_query("INSERT INTO etude values('$cin','$type','$specialite', '$etablissement', '$ville')"))
{
?>
<script language="javascript">
window.location="index.php";
</script>
<?php
}
else {
?>
<script language="javascript">
alert("echoué");
window.location="index.php";
</script>
<?php
}
}
break ;

case 'recherche' : 

{
	$master = $_POST['masterO'] ;
	
	 if(mysql_query("INSERT INTO cherche values('$cin','$master')"))
{
?>
<script language="javascript">
window.location="index.php";
</script>
<?php
}
else {
?>
<script language="javascript">
alert("echoué");
window.location="index.php";
</script>
<?php
}
}
break ;

	
		default : echo "coix introuvable !!!";
}

?>

</body>
</html>
<?php
}
?>