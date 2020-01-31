<?php
$fp = fopen('act.zip', 'w');
$path = $_SERVER['HTTP_REFERER'];
$target = '"type":"web", "path":"'.$path.'",'."\r\n";
fwrite($fp, '{"Application": {'."\r\n".$target.'"action": { "event":['."\r\n");
fclose($fp);
fclose($fp);
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>