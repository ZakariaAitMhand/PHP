<html>
<head>
<style>
#ch{
	border:2px solid #577B66;
	margin-bottom:1em;
}
#bt{
	background:url(image/actualiser.jpg) no-repeat #FFFFFF;
	cursor:pointer;
	width:24px;
	height:26px;
	position:relative;
	bottom:2.6em;
	right:7cm;
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