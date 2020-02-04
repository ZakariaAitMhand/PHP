<?php 
session_start(); 

?>
<?php
include 'connections/Connexion.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
</head>

<body>
 <script language="javascript">
function redirection(){
window.location="<?php echo $_SERVER["HTTP_REFERER"] ?>";
}
</script>
 <script language="javascript">
function redirectionindex(){
window.location="modifier.php";
}
</script>
<?php
$cin =$_POST['cin'];
$pass=$_POST['password'];
$req=mysql_query("SELECT cin,mdp,nom FROM `laureat` WHERE cin='$cin' AND mdp='$pass'");
	   if($fetch=mysql_fetch_assoc($req))
	{
	  $_SESSION['cin']=$cin;
	  $_SESSION['pass']=$pass;
	  ?>
	  <div align="center" class="Style4"  >
  <p align="center" class="Style5">Bienvenue chére Utilisateur : <?php echo $fetch['nom']; ?> </p>
</div>
	  <span class="Style4">
<script language="javascript">
	  setTimeout("redirectionindex()",2000) ;
      </script>
<?php
	  }
	  else {
	  	 ?>
	  </span>
	  <div align="center" class="Style4"  >
  <p align="center" class="Style2 ">Votre CIN ou bien votre Mot de passe est incorrécte </p>
</div>
	  <span class="Style4">
	  <script language="javascript">
	  setTimeout("redirection()",2000) ;
      </script>
	  <?php
	  }
	  ?>
      </span>
</body>
</html>
