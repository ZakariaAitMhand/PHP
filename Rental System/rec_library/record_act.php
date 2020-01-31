<?php
// get all the action in the get method using ajax
// write down all the actions in the target file act.json
// insert the header of a Json file 
// {"Record": {
  // "action": [


$act=$_GET['act'];
$fp = fopen('act.zip', 'a'); // we are using the 'w' mode to erase the previously created file
$a='{"type":"click", "value":"';

fwrite($fp, $a . $act . '" },'."\r\n");
fclose($fp);
?>