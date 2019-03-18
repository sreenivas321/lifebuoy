function show_login(){
	$('.popupWrapper, #popup-login').fadeIn();
}
function hide_popup(){
	$('.popupWrapper, .popupBox').fadeOut();
}
function show_thankyou(){
	$('.popupWrapper, #popup-thankyou').fadeIn();
}
function hide_funfact(){
	$('.funFact').fadeOut();
}
function reinit_image(){
	$(".galleryImg img").each(function(){
		screenImg = $(this);
		theImg = new Image();
		theImg.src = screenImg.attr('src');
		var imgH = theImg.height;
		var imgW = theImg.width;

		if(imgW < imgH){
			//portrait
			screenImg.css({
				width: 'auto',
				height: $('.galleryListBox ul li').height(),
				marginTop:0,
				marginLeft: 'auto',
				marginRight: 'auto'
			});
		}
		else{
			//landscape
			screenImg.css({
				height: '100%',
			});
		}
	});
}
$(document).ready(function(){
	$('.menuBtn').click(function(){
		$('.headerRight .overlay').fadeIn(500, function(){
			$('.headerRight').animate({right:0});
		});
	});
	$('.closeMenuBtn, .headerRight .overlay').click(function(){
		$('.headerRight .overlay').fadeOut(500, function(){
			$('.headerRight').animate({right:-1024});
		});
	});
	var els = {
		page: $('html, body'),
		navLink: $('nav a'),
	}
	els.navLink.click(function(){
		var $this = $(this);
		if ($this.hasClass('homeNav')) {
			els.page.animate({scrollTop:$('#banner').offset().top}, 500);
		}
		else if ($this.hasClass('howtojoinNav')) {
			els.page.animate({scrollTop:$('#howtojoin').offset().top}, 500);
		}
		else if ($this.hasClass('galleryNav')) {
			els.page.animate({scrollTop:$('#gallery').offset().top}, 500);
		}
	});
	if($('select').length > 0){
		$('select').selectOrDie();
	}
	reinit_image()
});
/*
$(window).scroll(function() {
	var windscroll = $(window).scrollTop();
	if (windscroll >= 100) {
		$('section .container').each(function(i) {
			if ($(this).position().top <= windscroll + 120) {
				$('nav ul li.selected').removeClass('selected');
				$('nav ul li').eq(i).addClass('selected');
			}
		});

	} else {
		$('nav ul li.selected').removeClass('selected');
		$('nav ul li:first').addClass('selected');
	}

}).scroll();*/