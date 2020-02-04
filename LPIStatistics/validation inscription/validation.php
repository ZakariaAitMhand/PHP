<html>
<head>
<script language="javascript" type="text/javascript" src="../js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="../js/ajax.js" ></script>
<noscript>jajajajaajajajajajajajjajajja</noscript>
<style>
#ch{
	border:2px solid #577B66;
	margin-bottom:1em;
}
#container_act{
	background:url(image/actualiser.jpg) no-repeat #FFFFFF;
	cursor:pointer;
	width:24px;
	height:26px;
	left:10em;
	position:relative;
	bottom:4em;
}
.clear{
	clear:both;
}
</style>
</head>
<body>
<div id="test_container">
<?php
include 'image.php';
?>
</div>
<div id="container_act" onClick="document.getElementById('num').value=''"></div>
</body>
</html>