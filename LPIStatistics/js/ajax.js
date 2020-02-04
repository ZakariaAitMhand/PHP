$(document).ready(function()
{
	
	$("#container_act").click(function(){
		ad='image.php';
		$.post(ad,function(data){$('#test_container').html(data);});
	});

});

