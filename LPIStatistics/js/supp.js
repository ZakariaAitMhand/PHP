$(function() {
			$("#dialog-confirm").dialog({
				resizable: false,
				height:200,
				width:320,
				modal: false,
				buttons: {
					'Valider': function() {
						$(this).dialog('close');
						window.location.href="supprimer.php";
					},
					'Annuler': function() {
						$(this).dialog('close');
						window.location.href="Admin.php";
					}
				}
			});
		});