<?php 
$s="";
$a=date('Y');
$j=0;
for($i=2006;$i<=$a;$i++)
{
 $t[$j]=$i;
$j++;
}
for($i=0;$i<count($t)-1;$i++)
$s[$i]=$t[$i]."/".$t[$i+1];


?>



