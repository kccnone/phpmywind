
/*
**************************

update: 2014-5-31 00:09:35

**************************
*/

$(function(){
	$(".mainBody").css("height", $(window).height() - 210);
})

$(window).resize(function(){
	$(".mainBody").css("height", $(window).height() - 210);
});