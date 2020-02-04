<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
<title>Untitled Document</title>
</head>

<body>
<?php
$num=$_POST['num'];
$x=$_POST['x'];
echo $x ;
echo"<br>".$num;
$b=false;
$t = array('HlmK5 dt','Ad56P hKP3','Oq3p wxdth','70Po NdFhZ','N7KR Klm1P','S13mZ 8uBD', 'Wkg2F wfZ','LOP45 Fvk');
for($i=0;$i<8;$i++){
if($t[$x]==$num)
$b=true;
}
if($b=true)
{
?>
<script language="javascript">
window.location="inscription3.php";
</script>
<?php
}
else
	{?>
<script language="javascript">
alert("inscription echoué !!!!");
window.location="inscription2.php";
</script>
<?php }
	
?>
</body>
</html>
