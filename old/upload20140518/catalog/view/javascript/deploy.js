 $(document).ready(function() {
 
	// Menu Effect
	
	$('#menu > ul > li').hover(function() {
		$("#menu li div").css("display", "none");
	});
	
	$("#menu > ul > li").hover(function () {
		$(this).children('div').stop(true, true).fadeIn('medium', function() {
		// Animation complete.
		});
	},
	function () {
		$(this).children('div').stop(true, true).fadeOut('fast', function() {
		// Animation complete.
		});   
	});
	
	$(".box .box-content ul li a").hover(function() {
		$(this).stop().animate({"background-color":"#e8e8e8"}, 800);
	},function() {
		$(this).stop().animate({"background-color":"#f1f1f1"}, 800);
	});
	
 });