<?php
include "../clt.php";
include '../library/php/functions.php';
include "../library/php/bd.php";
$clt= new client($_POST['nomst'],$_POST['tel'],$_POST['ad'],$_POST['site']);
$clt->ajoutClient();
header('location: ../CDP/?l=mes_clients');