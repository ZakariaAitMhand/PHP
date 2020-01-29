<?php
$nc = $_GET['nc'];
$bd = new DB();
$req = "SELECT * FROM client WHERE numclt = $nc";
$bd->query($req);
$l = $bd->fetch();
echo"<title>Ajout Client</title>";
echo "<h1>Ajout Client</h1>";
client_form("modif_client.php?nc=$nc","Modifier","modifier",$l);