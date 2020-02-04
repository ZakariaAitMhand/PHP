<?php
$x=rand(0,7);
$chaine="chiffre";
echo'<img src="image/chiffre/chiffre'.$x.'.jpg"  alt="Numero de validation d inscription" id="ch"/><br> ';
echo'<form id="form1" name="form1" method="post" action="verifi_num.php">';
echo'<label>
	  <input type="text" name="num" id="num"/>
	  </label>
<div class="clear"></div>
<label>
		<input type="submit" name="button" id="button" value="Valider" />
	  </label>
	 	<input type="hidden" name="x" value="'.$x.'"/>
	</form>';
?>