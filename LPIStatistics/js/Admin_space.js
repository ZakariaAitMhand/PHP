$(function() {
		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		$("#dialog").dialog("destroy");
		
		var password = $("#dialog-Admin-form #password"),
			allFields = $([]).add(password),
			tips = $(".validateTips");

		function updateTips(t) {
			tips
				.text(t)
				.addClass('ui-state-highlight');
			setTimeout(function() {
				tips.removeClass('ui-state-highlight', 1500);
			}, 500);
		}

		function checkLength(o,n,min,max) {

			if ( o.val().length > max || o.val().length < min ) {
				o.addClass('ui-state-error');
				updateTips("la langueur de " + n + " doit etre entre "+min+" et "+max+".");
				return false;
			} else {
				return true;
			}

		}

		function checkRegexp(o,regexp,n) {

			if ( !( regexp.test( o.val() ) ) ) {
				o.addClass('ui-state-error');
				updateTips(n);
				return false;
			} else {
				return true;
			}

		}
		
		$("#dialog-Admin-form").dialog({
			autoOpen: false,
			height: 200,
			width: 350,
			modal: true,
			resizable: false,
			buttons: {
				"Valider": function() {
					var bValid = true;
					allFields.removeClass('ui-state-error');
					
					bValid = bValid && checkLength(password,"mot de pass",4,20);
					
					if (bValid) {
						var y= password.val();
						$(this).dialog('close');
						Set_Cookie( 'Admin_pass', y );
						window.location="Admin.php";
					}
				},
				Annuler: function() {
					$(this).dialog('close');
					//document.getElementById('txt').value="";
				}
			},
			close: function() {
				allFields.val('').removeClass('ui-state-error');
			}
		});
		
		
		
		$('#Admin-space')
			.button()
			.click(function() {
				$('#dialog-Admin-form').dialog('open');
			});

	});