<?php

$string = "This is a test";
echo str_replace(" is", " was", $string); echo'<br>';
echo preg_replace("( )is", "\\1was", $string); echo'<br>';
echo preg_replace("(( )is)", "\\2was", $string); echo'<br>';

?>

<?php
/* Ceci ne fonctionne pas comme attendu */
$num = 4;
$string = "This string has four words.";
$string = preg_replace('four', $num, $string);
echo $string;   /* Affiche : 'This string has   words.' */

/* Ceci fonctionne comme attendu */
$num = '4';
$string = "This string has four words.";
$string = preg_replace('four', $num, $string);
echo $string;   /* Affiche : 'This string has 4 words.' */
?>
