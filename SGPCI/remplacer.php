<style>
	.a{
		left:1.5cm;
		position:relative;
		top:2em;
		font-weight:bold;
		font-size:14px;
		background-color: #999;
		padding: 3px 5px;
		text-decoration: none;
		-moz-border-radius : 3px;
	}
	.a:HOVER{
		background-color: #333;
	}
	.a2{
		left:3.5cm;
	}
</style>
<?php
session_start();
$file = $_SESSION['file'];
echo "<h4>Que voulez vous faire avec l'ancien fichier $file ?</h4>";
echo "<a href='test_remplacer.php?e=1' class='a' style='color : #FFF; !important'>Ecraser</a>";
echo "<a href='test_remplacer.php?r=1' class='a a2' style='color : #FFF; !important'>Renommer</a>";