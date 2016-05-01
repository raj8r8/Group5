$(document).ready(function(){
	
$("#header  > ul > li").mouseenter(function () {
$(this).children().show(); 
});
                  
$("#header > ul > li").mouseleave(function () {
	$(this).children().hide();
	});
});