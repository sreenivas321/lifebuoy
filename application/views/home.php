<section>
    <div class="homeBannerWrapper container">
        <div class="homeBoxMain">
            <img class="desktop" src="<?php echo base_url()?>userdata/category/<?php echo $current['banner']?>">
            <img class="mobile" src="<?php echo base_url()?>userdata/category/<?php echo $current['banner4']?>">
            <div class="infoMain">
				<div id="logo_hijab"></div>
                <div class="infoBox">
                    <span>Tantangan</span>
                    <span>Periode <?php echo $current['precedence']?></span>
                </div>
                <h2><?php echo $current['name']?></h2>
                <p>Ayo kirim foto kekompakan Moms bersama Si
Kecil dan menangkan hadiah voucher Zoya
senilai Rp. 300.000 setiap periodenya dan
voucher Zoya senilai Rp. 1.000.000 untuk
pemenang utama diakhir periode!</p>

				<?php /*if(strtotime(date("Y-m-d"))>strtotime("2015-07-31")){
					?>
                <div class="defBtn" style="opacity:0;"><span class="arrow"></span></div>
				<?php }else{*/?>
				<?php if($this->session->userdata('user_logged_in')){?>
                <a href="<?php echo site_url('upload')?>" class="defBtn"><span class="arrow">Ikuti Tantangan</span></a>
                <?php }else{?>
                <a href="#" class="defBtn GTM-Join" onClick="show_login();return false;"><span class="arrow">Ikuti Tantangan</span></a>
                <?php }?>
                <?php //}?>
            </div>
        </div>
        
        <div class="homeBoxNext">
        
            <img src="<?php echo base_url()?>userdata/category/<?php echo $next['banner2']?>">&nbsp;<?php /*?>
            <div class="infoNext">
                <div class="infoTop">Periode <?php echo $next['precedence']?></div>
                <div class="infoBot">
                    Tunggu Tantangan selanjutnya <span><?php echo time_elapsed_string2(strtotime($next['start_date']))?></span> ya, Moms!
                </div>
            </div><?php */?>
        </div>
    </div>
	<div class="HowToJoinWrapper container" id="howtojoin">
        <div class="howToJoinBox">
            <h2><img src="<?php echo base_url()?>templates/images/how_to_join_text.png"></h2>
            <div class="htjList">
                <ul>
                    <li>
                        <img src="<?php echo base_url()?>templates/images/how_to_join_1.png">
                        <span>Login</span> dengan akun <br />Facebook atau Twitter
                    </li>
                    <li>
                        <img src="<?php echo base_url()?>templates/images/how_to_join_2.png">
                        <span>Upload foto</span> terbaik<br>Moms &amp; Si Kecil <br />sesuai tema
                    </li>
                    <li>
                        <img src="<?php echo base_url()?>templates/images/how_to_join_3.png">
                        <span>Share foto</span> di Social Media
                    </li>
                    <li>
                        <img src="<?php echo base_url()?>templates/images/how_to_join_4.png">
                        Tunggu <span>pengumuman pemenang</span> di setiap akhir periode
                    </li>
                </ul>
            </div>
        </div>
    </div>
	<div class="galleryWrapper container" id="gallery">
        <div class="galleryBox">
            <h2><img src="<?php echo base_url()?>templates/images/galleri_submision.png"></h2>
            <div class="weeksBox">
                
                <ul>
                    <li><a href="<?php echo site_url('gallery')?>" <?php if($category_id=='a'){?>class="selected"<?php }?>>Semua</a></li>
                    <?php if($category)foreach($category as $row){
						if( $row['id']!=9999 and $row['hashtag']!=''){?>
                    <li><a href="<?php echo site_url('gallery/category').'/'.$row['id']?>" <?php if($category_id==$row['id']){?>class="selected"<?php }?>>Periode <?php echo $row['precedence']?></a></li>
                    <?php }}?>
                </ul>
                <select onchange="goto_url(this.value);">
                    <option value="<?php echo site_url('gallery')?>" <?php if($category_id=='a'){?>selected="selected"<?php }?>>Semua</option>
                    <?php if($category)foreach($category as $row){?>
                    <option value="<?php echo site_url('gallery/category').'/'.$row['id']?>" <?php if($category_id==$row['id']){?>selected="selected"<?php }?>>Periode <?php echo $row['precedence']?></option>
                    <?php }?>
                </select>
                
                
            </div>
            <div class="galleryListBox">
                <ul>
                <?php $this->load->view('gallery_load_ajax');?>
                </ul>
                <input type="hidden" id="status" value="0" />
                <input type="hidden" id="status2" value="0" />
                <input type="hidden" id="offset" value="10" />
                <?php if($total>10){?>
                <div class="buttonWrapper" id="loadmore_btn">
                    <a href="#" class="defBtn" id="load_more_btn"><span class="arrowBottom">Load More</span></a>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</section>

<script>
function show_image(id){
	var status2=$("#status2").val();
	if(status==0){
	$.ajax({           
		type: "POST",  
		beforeSend: function(){
			$("#status2").val(1);	
		},               
		url: '<?php echo site_url('gallery/gallery_detail_ajax')?>/'+id,
		data:"offset="+offset,
		dataType: "json",
		success: function(result){
			
			if(result.status==1){
				
				$("#popup-gallery img").attr('src',result.image);
				$("#popup-gallery #post_username").text(result.username);
				$("#popup-gallery #post_description").text(result.description);
				$("#popup-gallery #post_timeago").text(result.post_date);
				
				$('.popupWrapper, #popup-gallery').fadeIn();
				
			}
			else alert('failed to load image');
			
			$("#status2").val(0);
		}
	});
	return false;
	}
}

<?php if($curr_page=='gallery'){?>

		$("html, body").animate({ scrollTop: $('#gallery').offset().top }, 500);
<?php }?>


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

}).scroll();
</script>

<?php if($total>10){?>
<script>
$(document).ready(function(e) {
    $("#load_more_btn").click(function(){
		var offset=$("#offset").val();
		var status=$("#status").val();
		if(status==0){
			$.ajax({           
				type: "POST",  
				beforeSend: function(){
					$("#status").val(1);	
				},               
				url: '<?php echo site_url('gallery/load_more')?>',
				data:"offset="+offset+'&category_id=a',
				dataType: "json",
				success: function(result){
					if(result.status==1){
						$(".galleryListBox ul").append(result.content);
						
						if(result.offset!=0)
						$("#offset").val(result.offset);
						else
						$("#loadmore_btn").hide();
						
						
					}
					else{
						$("#loadmore_btn").hide();
					}
					$("#status").val(0);	
				}
			});
		}
		return false;
	});
});



</script>
<?php }?>