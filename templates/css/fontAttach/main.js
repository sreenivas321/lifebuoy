function reinit_image(){
	$(".galleryImgPhoto img").each(function(){
		screenImg = $(this);
		theImg = new Image();
		theImg.src = screenImg.attr('src');
		var imgH = theImg.height;
		var imgW = theImg.width;
	
		if(imgW < imgH){
			//portrait
			$(this).css({
				width: 'auto',
				height: $('.galleryImgPhoto').height()
			});
		}
		else{
			//landscape
			$(this).css({
				width: '100%',
				marginTop: (($('.galleryImgPhoto').height()-$(this).height())/2)+'px'
			});
		}
	});	
}

//upload steps
function displayBtnSet1(){
	$('#buttonStep2').fadeOut(function(){
		$('#buttonStep1').fadeIn();
	});
}
function displayBtnSet2(){
	$('#buttonStep1').fadeOut(function(){
		$('#buttonStep2').fadeIn();
	});
}
function gotoUploadStep2(){
	$('#uploadStep1').fadeOut(function(){
		$('#uploadStep2').fadeIn();
	});
	displayBtnSet1();
}
function gotoUploadStep3(){
	setTimeout(function(){
		$('#uploadStep2').fadeOut(function(){
			$('#uploadStep3').fadeIn();
			pubBtnDisabled = 0;
			$('.publishBtn').removeClass('disabled');
		});
		displayBtnSet1();
	}, 2000);
}
function gotoUploadStep4(){	
	$('#uploadStep3, #uploadStep5').fadeOut(function(){
		$('#uploadStep4').fadeIn();
		var description = $('#description_value').val();
		//alert(description);
		$.ajax({
			type: "POST",
			url: base_url+'photo/do_upload', 
			dataType:"JSON",
			data:{
			description:description
			},
			success: function(data){
				console.log(data);
			}
		});	
	});
	displayBtnSet2();
}
function gotoUploadStep5(){
	$('#uploadStep1').fadeOut(function(){
		$('#uploadStep5').fadeIn();
	});
	displayBtnSet1();
}

$(document).ready(function(){
	$("#login_fb2, #login_fb22").click(function(){
		facebookLogin2();	
	});
	
	$("#slides").slidesjs({
		width: 1030,
		height: 450,
		play: {
			auto: true,
			interval: 3000
		}
	});
	$("#slidesMobile").slidesjs({
		width: 640,
		height: 400,
		play: {
			auto: true,
			interval: 3000
		}
	});
	/*$('.filterByBtn').click(function(){
		$('.filterByCon').animate({right:0});
	});
	$('.tnc').click(function(){
		//$('.tncCon').toggle('slow',function(){
			//$("html, body").animate({ scrollTop: $('h3.tnc').offset().top }, 600);//console.log($('h3.tnc').offset().top);
		//});
		return false;
	});
	$('#tncShow').click(function(){
		$('#hiddenTerms').toggle('slow', function(){
			$("html, body").animate({ scrollTop: $('h3.tnc').offset().top }, 600);//console.log($('h3.tnc').offset().top);
		});
		$(this).hide();
		return false;
	});*/
	$('.filterBtn').click(function(){
		$('.filterBox').slideToggle();
	});

	$('select.selectForm').customSelect();
	$('select.styled').customSelect();
	//upload popup
	pubBtnDisabled = 1; // change this to 0 if photo is ready for publish
	$('#uploadBtn, .reUpload, #uploadBtn2').click(function(){
		$('#overlay').css('opacity', 0.8);
		$('#overlay').fadeIn();
		$('.uploadContainer').fadeIn();
		$('.uploadStep').hide();
		$('#uploadStep1').fadeIn();
		displayBtnSet1();
		return false;
	});
	$('.publishBtn').click(function(){
		if($(this).hasClass('disabled') || pubBtnDisabled == 1){
			pubBtnDisabled = 1;
			return false;
		}
		else{
			//publish photo
			gotoUploadStep4();
		}
		return false;
	});
	$('.cancelUploadBtn').click(function(){
		
		$('#uploadContainer, #overlay').fadeOut();
		return false;
	});
	$('#selectFromFBBtn').click(function(){
		gotoUploadStep5();
	});
	//not needed, can be changed with dropzone
	/*$("#selectFromPCBtn").click(function(){
		$("#browseFile").trigger('click');
		return false;
	});*/
});

$(window).bind('load resize', function(){
	$("#slides").slidesjs({
		width: 1030,
		height: 450
	});
	$("#slidesMobile").slidesjs({
		width: 640,
		height: 400
	});
	$(".galleryImgPhoto img").each(function(){
		screenImg = $(this);
		theImg = new Image();
		theImg.src = screenImg.attr('src');
		var imgH = theImg.height;
		var imgW = theImg.width;
	
		if(imgW < imgH){
			//portrait
			$(this).css({
				width: 'auto',
				height: $('.galleryImgPhoto').height()
			});
		}
		else{
			//landscape
			$(this).css({
				width: '100%',
				marginTop: (($('.galleryImgPhoto').height()-$(this).height())/2)+'px'
			});
		}
	});
	
	
	if($('.galleryDetailCon').length > 0){
		screenImgDet = $('.galleryDetailImgFile img');
		theImgDet = new Image();
		theImgDet.src = screenImgDet.attr('src');
		var imgH2 = theImgDet.height;
		var imgW2 = theImgDet.width;
		
		if(imgW2 < imgH2){
			//portrait
			$('.galleryDetailImgFile img').css({
				width: 'auto',
				height: $('.galleryDetailImgCon').height()
			});
			/*if($(window).width()>767){
				$('.galleryDetailImgFile img').css({
					width: 'auto',
					height: '100%'
				});
			}*/
		}
		else{
			//landscape
			$('.galleryDetailImgFile img').css({
				width: '100%',
				marginTop: (($('.galleryDetailImgCon').height()-$('.galleryDetailImgFile img').height())/2)+'px'
			});
		}
	}
});

$(window).load(function(){
	$('.bigLike, .bigUnlike').fadeIn().delay(2000).fadeOut();
});