<section>
    <div class="uploadWrapper">
        <div class="boxLeft">
            <div class="boxImg">
                <img src="<?php echo base_url()?>userdata/category/<?php echo $current['banner3']?>">
            </div>
            <div class="boxDesc">
                <span>Tema Periode <?php echo $current['precedence']?></span>
                <h2><?php echo $current['name']?></h2>
                <div class="boxInfo">
                    <p><?php echo $current['description']?></p>
                </div>
            </div>
        </div>
        <div class="boxRight">
            <div class="uploadBox">
                <h2><img src="<?php echo base_url()?>templates/images/photo_submission.png"></h2>
                <p>
                Pastikan Moms mengupload
                foto terbaik, dan
                menangkan hadiahnya!</p>
                <div class="browse-wrap">
                    
                <span class="upload-path"></span>
                    <a href="#" class="defBtn">Pilih Foto</a>
                    <input id="take-picture" type="file" accept="image/*" name="upload" class="upload" title="Pilih Foto">
                </div>
                <p id="error"></p>
                <div class="photoPreview">
                    <img src="about:blank" id="capturedPhoto">
                </div>
                <div class="commentBox">
                    <input type="hidden" name="image" id="image_src"  />
                    <textarea name="image_description" id="image_description" placeholder="Tulis deskripsi foto"></textarea>
                
                </div>
                <div class="buttonWrapper">
                    <a href="#" class="defBtn blueBtn GTM-Upload" id="upload_btn"><span class="arrow">Upload</span></a>
                </div>
            </div>
            <div class="loadingWrapper" style="display:none">
                <div class="loadingBox">
                    <div class="funFact"<?php /*?> onClick="hide_funfact()"<?php */?>>
                        <span class="funfact">Fun Fact #<?php echo $fun_fact['precedence']?></span>
                        <p><?php echo $fun_fact['description']?></p>
                        <?php /*?><a href="#" class="closeBtn">Close</a><?php */?>
                    </div>
                    <div class="loaderBox">
                        <span>Loading</span>
                        <input class="knob" data-thickness=".4" readonly value="100">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
       
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?php echo base_url()?>templates/js/jquery.ui.widget.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo base_url()?>templates/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo base_url()?>templates/js/jquery.fileupload.js"></script> 
<script>
var fblink='';
var twlink='';
/*jslint unparam: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = '<?php echo site_url('upload/do_upload')?>';
    $('#take-picture').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
		start: function (e){
			$(".loadingWrapper").fadeIn();
		},
		add: function (e, data) {            
			$("#upload_btn").on('click', function () {
				if(confirm('Upload foto ini?'))
				data.submit();
				//else alert('Upload batal');
			});
		},
		change: function (e, data) {//console.log(data);
			//$("#capturedPhoto").attr('src',data.result.image);
		},
        done: function (e, data) {
			if(data.result.status==1){
				$("#capturedPhoto").attr('src',data.result.image);
				$("#image_src").val(data.result.image);
				//console.log(data.result.fblink);
				//console.log(data.result.twlink);
				//$("#fb_linksss").text(data.result.fblink);
				//$("#tw_linksss").text(data.result.twlink);
				
				fblink=data.result.fblink;
				twlink=data.result.twlink;
				
				if(data.result.imid!=0){
					$.ajax({           
						type: "POST",  
						url: '<?php echo site_url('upload/save_description')?>',
						data:"description="+$("#image_description").val()+'&imid='+data.result.imid,
						dataType: "json",
						success: function(resultx){
							if(resultx.status==1){
								$(".loaderBox span").text('Please Wait');
								dataLayer.push({
								  'event':'VirtualPageview',
								  'virtualPageURL':'/nyamanberhijab.lifebuoy.co.id/thankyou',
								  'virtualPageTitle' : 'Thank You'
								});

								setTimeout(function(){
									$(".loadingWrapper").fadeOut(function(){
										$(".overlay").removeAttr('onclick').css('cursor','default');
										$(".popupWrapper, #popup-thankyou").fadeIn();	
									});	
								}, 4000);
								
								
							}
							else alert('failed to load image');
							
						}
					});
				}
			}
			else alert('failed upload image');

        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
			$(".knob").val(progress);
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
		
});


</script>




    <script>
	$(function() {
        $(".knob").knob({
			width : 80,
			height: 80
		});
    });
	(function () {
    var takePicture = document.querySelector("#take-picture"),
		spanx = document.getElementsByClassName('upload-path'),
    	showPicture = document.querySelector("#capturedPhoto");

    if (takePicture && showPicture) {
        // Set events
        takePicture.onchange = function (event) {
            // Get a reference to the taken picture or chosen file
            var files = event.target.files,
                file;
            if (files && files.length > 0) {
                file = files[0];
                try {
                    // Get window.URL object
                    var URL = window.URL || window.webkitURL;

                    // Create ObjectURL
                    var imgURL = URL.createObjectURL(file);

                    // Set img src to ObjectURL
                    showPicture.src = imgURL;

			spanx[0].innerHTML = this.files[0].name;
                    // Revoke ObjectURL after imagehas loaded
                    showPicture.onload = function() {
                        URL.revokeObjectURL(imgURL);  
                    };
                }
                catch (e) {
                    try {
                        // Fallback if createObjectURL is not supported
                        var fileReader = new FileReader();
                        fileReader.onload = function (event) {
                            showPicture.src = event.target.result;
                        };
                        fileReader.readAsDataURL(file);
                    }
                    catch (e) {
                        // Display error message
                        var error = document.querySelector("#error");
                        if (error) {
                            error.innerHTML = "Neither createObjectURL or FileReader are supported";
                        }
                    }
                }
            }
        };
    }
})();
	</script>
    
    
    <script>
	$(document).ready(function(){
		$("#fb_share").click(function(){		
			//var url_to_open=$("#fb_linksss").val();	
			var url_to_open=fblink;
			var width = 1000; 	
			var height = 550;
			var left = parseInt((screen.availWidth/2) - (width/2));
			var top = parseInt((screen.availHeight/2) - (height/2));
			window.open(url_to_open, "Facebook", 'height=350,width=700,left=' + left + ',top=' + top + ',screenX=' + left + ',screenY=' + top);
			return false;
		});
		
		$("#tw_share").click(function(){	
			//var txt=$("#tw_linksss").val();		
			var txt=twlink;
			var url_to_open='http://twitter.com/intent/tweet?text='+txt;
			
			
			var width = 1000; 	
			var height = 550;
			var left = parseInt((screen.availWidth/2) - (width/2));
			var top = parseInt((screen.availHeight/2) - (height/2));
			window.open(url_to_open, "Tweet", 'height=350,width=700,left=' + left + ',top=' + top + ',screenX=' + left + ',screenY=' + top);
			return false;
		});
	});
	</script>