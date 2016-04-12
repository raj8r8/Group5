$(document).ready(function(){
$("#header-items li").mouseenter(function () {
$(this).children().show();
});
$("#header-items li").mouseleave(function () {
	$(this).children().hide();
	});
});