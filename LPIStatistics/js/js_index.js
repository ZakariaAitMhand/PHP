$(document).ready(function()
{
	//annimation
	
	$("a").click(function(){
		ad=$(this).attr("title");
		$.get(ad,function(data){alert("chargement avec succ�s \n"+data);$('#corp').html(data);});
	});

});
