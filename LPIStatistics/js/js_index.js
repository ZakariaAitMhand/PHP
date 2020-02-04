$(document).ready(function()
{
	//annimation
	
	$("a").click(function(){
		ad=$(this).attr("title");
		$.get(ad,function(data){alert("chargement avec succés \n"+data);$('#corp').html(data);});
	});

});
