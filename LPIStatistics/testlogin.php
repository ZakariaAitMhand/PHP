<?php
	$hostname_Connexion = "localhost";
	$database_Connexion = "statistiques";
	$username_Connexion = "root";
	$password_Connexion = "";
	mysql_connect($hostname_Connexion,$username_Connexion,$password_Connexion);
	mysql_select_db($database_Connexion);
	$login="abdelali";
	$pass="iferden";
	$requet=mysql_query("select login,mot_de_passe,type_user from user where login='$login' and mot_de_passe='$pass'");
	if(mysql_num_rows($requet)==0)
	{
		header("Location:login.php");
	}
	else
	{
		$row=mysql_fetch_array($requet);
		$type=$row['type_user'];
		if($type==0)
		{
			header("Location:inscrir2.php");
		}
		else if($type==1)
		{
			header("Location:inscrir1.php");
		}
	}
?>