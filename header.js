$(document).ready(function(){
	
$("#header  > ul > li").mouseenter(function () {
	if($(this).attr('class') != "nodropdown"){
$(this).children().show(); 
	}
});
                  
$("#header > ul > li").mouseleave(function () {
	if($(this).attr('class') != "nodropdown"){
	$(this).children().hide();
}
	});
});