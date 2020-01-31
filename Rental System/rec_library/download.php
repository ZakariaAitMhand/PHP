<?php
$path = "act.zip";
$fh = fopen($path, 'r+') or die("can't open file");

$stat = fstat($fh);
ftruncate($fh, $stat['size']-3);
fclose($fh);


$fp = fopen($path, 'a'); 
fwrite($fp, "]}}} \r\n");
fclose($fp);

?>
<?php
header('Location: act.zip');
?>