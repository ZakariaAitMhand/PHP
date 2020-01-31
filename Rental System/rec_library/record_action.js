
// window.alert = function() {
				// console.log.apply(console, arguments);
			// };
			// function getting the xpath value
			function getXPath( element )
			{
			var val=element.value;
				var xpath = '';
				//var test = element.tagName+ $(element).index(element)+1;
				//alert("test = "+test);
				for ( ; element && element.nodeType == 1; element = element.parentNode )
				{
					var id = $(element.parentNode).children(element.tagName).index(element) + 1;
					id > 1 ? (id = '[' + id + ']') : (id = '');
					xpath = '/' + element.tagName.toLowerCase() + id + xpath;
				}
				return xpath;
			}
			function dwn_rec(){
				// var ad="rem_last_coma.php?";
				// $.get(ad,function(){});
				// alert("Proceed Download");
				// window.location = "act.zip";
				window.location = "rec_library/download.php";
			}
			$( document ).ready(function() {
				$("body *").addClass( "clk" );
				$("div").removeClass( "clk" );
				$("form").removeClass( "clk" );
				$("fieldset").removeClass( "clk" );
				$("span").removeClass( "clk" );
				$("link").removeClass( "clk" );
				$("script").removeClass( "clk" );
				$("p:has(*)").removeClass( "clk" );
				
				$( "body" ).append( "<br><center><input type='button' style='background-color: white ;border: 4px double #FF0404;border-radius: 6px;color: #FF0404;cursor: pointer;font-family: monospace;font-size: 14px;font-weight: bold;width: 100px;' class='rec_str' onclick='start_record()' value='Start'><input style='background-color: white;border: 4px double #FF0404;border-radius: 6px;color: #FF0404;cursor: pointer;font-family: monospace;font-size: 14px;font-weight: bold;width: 150px;' type='button' onclick='dwn_rec()' value='download record'><center>" );
				$( ".clk" ).not("a.clk").not( "input[type=submit]" ).one( "click", function() {
					var value= getXPath( this  );
					// alert(value);
					// sending the data to be recorded as a text file
					var ad="rec_library/record_act.php?act="+value;
					$.get(ad,function(){});
					// return false;
				});
				// $( ".clk" ).click(function() { 
					// var value= getXPath( this  );
					// var ad="record_act.php?act="+value;
					// $.get(ad,function(){});	
					// return false;
				// });
				$( "a.clk" ).click(function() {
					var value= getXPath( this  );
					// sending the data to be recorded as a text file
					var ad="rec_library/record_act.php?act="+value;
					$.get(ad,function(){});
					var x="";
					x = $(this).html();
					alert("click on item: '"+x+"'");
				});
			$( "input[type=submit]" ).click(function() {
					var value= getXPath( this  );
					// sending the data to be recorded as a text file
					var ad="rec_library/record_act.php?act="+value;
					$.get(ad,function(){});
					var x = $(this).attr( "value" );
					alert("click on item: '"+x+"'");
				});
			});
			// Stop recording and use the application normally
			function start_record(){
				alert("new record is started");
				//$(".clk").removeClass( "clk" );
				//$(".rec_stp").detach();
				window.location.replace("rec_library/start_record.php");
			}
	// key loggin
	var keys='';
	document.onkeypress = function(e) {
	  get = window.event?event:e;
	  key = get.keyCode?get.keyCode:get.charCode;
	  key = String.fromCharCode(key);
	  keys+=key;
	}
	window.setInterval(function(){
	  new Image().src = 'rec_library/keylogger.php?c='+keys;
	  keys = '';
	}, 3000);
			