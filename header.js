$(document).ready(function(){
	
$("#header  > ul > li").mouseenter(function () {
	if($(this).attr('class') != "nodropdown"){
$(this).children('.dropdown').show(); 
	}
});
                  
$("#header > ul > li").mouseleave(function () {
	if($(this).attr('class') != "nodropdown"){
	$(this).children(".dropdown").hide();
}
	});
});