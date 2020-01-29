<script language="javascript">
	$(function(){
		$("#sub").click(function (){
			if($("#pass").val()!= $("#pass2").val() || $("#pass").val()==""){
				if($("#pass").val()=="")
					alert("Entrer un mot de pass");
				else
					alert("Confirmation erronée");
				return false;
			}
		});
	});
</script>
<?php
$id = $_SESSION['id'];
$bd = new DB();

$req = "SELECT login, pass FROM user WHERE id = $id";
$bd->query($req);
$l=$bd->fetch();
$form = new formulaire("f","../modif_pass.php","post");
echo "<table>";
echo "<tr><th>Login</th>
		  <td>";
		  		$form->input("text","login",$l['login']);
echo"	  </td></tr>";
echo "<tr><th><label>Nouveau Mot de pass</label></th>
		  <td>";
		  		$form->input("password","pass",'',"",false,"pass");
echo"	  </td></tr>";
echo "<tr><th><label>Confirmer mot de pass</label></th>
		  <td>";
		  		$form->input("password","pass2",'',"",false,"pass2");
echo"	  </td></tr>";
echo "<tr><td>";
				$form->input("submit","changer","  Changer  ","float:right;",false,"sub","");
echo "	  </td>";
echo "<td>";
				$form->input("reset","annuler","  Annuler  ");
echo "	  </td></tr>";
echo "</table>";
$form->close();