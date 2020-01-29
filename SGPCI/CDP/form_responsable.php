<script type="text/javascript" type="text/javascript" src="../library/js/jquery.js"></script>
<script type="text/javascript">
<!--
$(document).ready(function()
{
	
	$("#grade").change(function(){
		grade = this.value;
		if(grade == "cdp"){
		style = 'none';
		}
		else{
			style = 'block';
		}
		$("#th").css({display:style});
		$("#tache").css({display:style});
		
	});
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
//-->
</script>
<?php 
if($_SESSION['grade'] != "CDP"){
	header("Location: ../index.php");
}
else{
	
	form_resp("ajout_resp.php","ajouter","  Ajouter  ");
	
}