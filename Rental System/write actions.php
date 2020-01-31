<?php
// get all the action in the get method using ajax
// write down all the actions in the target file act.json
$act=$_GET['act'];
$fp = fopen('act.json', 'w'); // we are using the 'w' mode to erase the previously created file
fwrite($fp, "-clk ".$act."\r\n");
fclose($fp);
// redirection to the file so that it get downloaded by the user
header('Location: act.json');
?>