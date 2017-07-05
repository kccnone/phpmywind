// JavaScript Document
$(function(){
	$(".closebtn").click(function(){
		closeguide();
	});	
	$(".stopbtn").click(function(){
		stopguide();	
	});	
	$(".prevbtn").click(function(){
		prevguide()
	});
	$(".nextbtn").click(function(){
		nextguide()
	});
	$('.navbtn span').click(function(){
		guideindex = $(this).index();
		aniguide();
	});		
})
guideindex=0;
function closeguide(){
	$("#guide").hide();	
}
function stopguide(){
	$.ajax({
		type:"post",
		url:"guideclose_do.php",
		data:"action=stop",
		success:function(data){
			$("#guide").hide();		
		}
	});	
}
function prevguide(){
	if(guideindex>=1){
		guideindex--;
		aniguide();
	}	
}
function nextguide(){
	guideindex++;
	if(guideindex<=5){
		aniguide();
	}
	else if(guideindex>5){
		$("#guide").hide();
	}
}
function aniguide(){
	$('.navbtn').find('span.on').removeClass('on');
	$('.navbtn').find('span').eq(guideindex).addClass('on');
	$('#guide-step').find('li').hide();
	$('#guide-step').find('li').eq(guideindex).show();	
}
function showguide(){
	guideindex=0;
	$("#guide").show();
	aniguide();
}