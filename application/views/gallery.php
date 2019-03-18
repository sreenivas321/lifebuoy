<section>
    <div class="galleryWrapper">
        <div class="weeksBox">
            <ul>
                <li><a href="<?php echo site_url('gallery')?>" <?php if($category_id=='a'){?>class="selected"<?php }?>>Semua</a></li>
                <?php if($category)foreach($category as $row){?>
                <li><a href="<?php echo site_url('gallery/category').'/'.$row['id']?>" <?php if($category_id==$row['id']){?>class="selected"<?php }?>>Periode <?php echo $row['precedence']?></a></li>
                <?php }?>
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
            <input type="hidden" id="offset" value="10" />
            <?php if($total>10){?>
            <div class="buttonWrapper" id="loadmore_btn">
                <a href="#" class="defBtn" id="load_more_btn"><span class="arrowBottom">Load More</span></a>
            </div>
            <?php }?>
        </div>
    </div>
</section>

<script>
function show_image(id){
	$.ajax({           
		type: "POST",  
		beforeSend: function(){
			$("#status").val(1);	
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
			
		}
	});
return false;

}
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
				data:"offset="+offset+'&category_id=<?php echo $category_id?>',
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