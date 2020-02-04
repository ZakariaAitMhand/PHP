<link rel="stylesheet" type="text/css" href="style/style_php.css" />
<style>
#container_act{
	background:url(image/actualiser.jpg) no-repeat #FFFFFF;
	cursor:pointer;
	width:24px;
	height:26px;
	position:relative;
	bottom:2.6em;
	right:7cm;
}
</style>
<?php
$x=rand(0,7);
$chaine="chiffre";
echo'<img src="image/chiffre/chiffre'.$x.'.jpg"  alt="Numero de validation d inscription" id="ch"/><br> ';
?>