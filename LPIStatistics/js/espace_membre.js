$(function() {
		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		$("#dialog").dialog("destroy");
		
		var cin=$("#cin");
			password = $("#dialog-form #password"),
			allFields = $([]).add(cin).add(password),
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
		
		$("#dialog-form").dialog({
			autoOpen: false,
			height: 250,
			width: 350,
			modal: true,
			resizable: false,
			buttons: {
				"Valider": function() {
					var bValid = true;
					allFields.removeClass('ui-state-error');

					bValid = bValid && checkLength(cin,"CIN",5,20);
					bValid = bValid && checkLength(password,"mot de pass",5,20);
					
					if (bValid) {
						var x= cin.val();
							y= password.val();
						$(this).dialog('close');
						Set_Cookie( 'cin', x );
						Set_Cookie( 'pass', y );
						window.location="connexion.php";
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
		
		
		
		$('#member-space')
			.button()
			.click(function() {
				$('#dialog-form').dialog('open');
			});

	});