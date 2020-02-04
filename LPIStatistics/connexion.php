<script language="javascript" type="text/javascript" src="js/javascript_cookies.js"></script>
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
window.location="utilisateur.php";
}
</script>
<?php
$cin =$_COOKIE['cin'];
$pass=$_COOKIE['pass'];

$req=mysql_query("SELECT cin,mdp,nom FROM `laureat` WHERE cin='$cin' AND mdp='$pass'");
	   if($fetch=mysql_fetch_assoc($req))
	{
	  $_SESSION['cin']=$cin;
	  $_SESSION['pass']=$pass;
	  ?>
	  <span class="Style4">
<script language="javascript">
	  setTimeout("redirectionindex()") ;
      </script>
<?php
	  }
	  else {
	  	 ?>
	  <span class="Style4">
	  <script language="javascript">
	  Delete_Cookie( 'pass');
	  Delete_Cookie( 'cin');
	  alert("Votre CIN ou bien votre Mot de passe est incorrect");
	  setTimeout("redirection()",2000) ;
      </script>
	  <?php
	  }
	  ?>
      </span>
</body>
</html>
