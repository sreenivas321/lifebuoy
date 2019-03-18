<script>
$(document).ready(function(){

	$('#close_button').click(function(){
	window.location='<?php echo site_url('gallery')?>';
	});
	
});

function detail_category(id){
var category_id=$("#category_id").val();
window.location='<?php echo site_url('gallery/detail');?>/'+category_id+'/'+id;
}
</script>

    
    
    <div class="rowWrapper">
        <div class="navCon">
            <a href="<?php echo base_url();?>" class="homeBtn">Home</a>
            <span>Galeri</span>
            <div class="searchCon">
            <form id="search_gallery" name="search_gallery" method="get" action="<?php echo site_url('gallery/index');?>">
				<input type="hidden" name="category_id" id="category_id" value="<?php echo $category_id; ?>" />
            	<input type="text" placeholder="Cari Disini.." id="keyword" name="keyword" value="<?php if($keyword)echo urldecode($keyword);?>" />
            </form>
            </div>
        </div>
    </div>
    <div class="rowWrapper">
        <ul class="hashtag">
        	<li><a href="<?php echo site_url('gallery');?>" <?php if($category_id=='' or $category_id=='a')echo ' class="selected"';?>>Show All</a></li>
			<?php if($category_list) foreach($category_list as $list){?>
            <li><a href="<?php echo site_url('gallery/index?category_id='.$list['id'].'&keyword='.$keyword)?>" <?php if($category_id==$list['id'])echo ' class="selected"';?>><?php echo $list['name']?></a></li>
            <?php } ?>
        </ul>
    </div>
    <?php if($category_detail){?>
    <div class="rowWrapper">
    	<div class="filterDesc">
    	<p style="color:#FFF;"><?php echo nl2br($category_detail['description']);?></p>
        </div>
    </div>
    <?php }?>
        <?php /*?><div class="sortbyCon">
            <span>Galeri</span> | Sort By
        </div>
        
            <div class="selectCon">
        <select class="selectForm" id="category_id" onchange="do_filter(0)">
           <option value="a" label="All">All</option>
        <?php if($category_list) foreach ($category_list as $list){?>
            <option value="<?php echo $list['id'] ?>" label="<?php echo $list['name'];?>" <?php if($list['id']==$selected_select)echo "selected=\"selected\"";?>><?php echo $list['name'];?></option>
         <?php } ?>   
        </select>
        </div><?php */?>
<div class="galleryCon">
    <ul>
    <?php $nilai_category=$this->uri->segment(3);?>
        <?php 
		$no=1;$rand=rand(1,20);$rand2=rand(1,3);
		if($gallery_list) foreach($gallery_list as $list){if($no<21){?> 
        
        
        <?php if($category_id==9 and $offset==32 and $no==$rand){//jokotarub?>
        <li>
            <div class="galleryBox">
                <div class="galleryImg">
                    <div class="galleryImgPhoto">
                        <a href="<?php echo site_url('gallery/details').'/'.$category_id;?>"><img src="<?php echo base_url().'templates/images/new_thumbnail_omesh.png'?>" /></a>
                    </div>
                </div>
            </div>
        </li>
       <?php }else if($category_id==4 and $offset==1584 and $no==$rand){//nice try?>
        <li>
            <div class="galleryBox">
                <div class="galleryImg">
                    <div class="galleryImgPhoto">
                        <a href="<?php echo site_url('gallery/details').'/'.$category_id;?>"><img src="<?php echo base_url().'templates/images/new_thumbnail_omesh.png'?>" /></a>
                    </div>
                </div>
            </div>
        </li>
       <?php }else if($category_id==5 and $offset==48 and $no==$rand){//xlove?>
        <li>
            <div class="galleryBox">
                <div class="galleryImg">
                    <div class="galleryImgPhoto">
                        <a href="<?php echo site_url('gallery/details').'/'.$category_id;?>"><img src="<?php echo base_url().'templates/images/new_thumbnail_omesh.png'?>" /></a>
                    </div>
                </div>
            </div>
        </li>
       <?php }else if($category_id==6 and $offset==16 and $no==$rand2){//xtreme?>
        <li>
            <div class="galleryBox">
                <div class="galleryImg">
                    <div class="galleryImgPhoto">
                        <a href="<?php echo site_url('gallery/details').'/'.$category_id;?>"><img src="<?php echo base_url().'templates/images/new_thumbnail_omesh.png'?>" /></a>
                    </div>
                </div>
            </div>
        </li>
       <?php }else if($category_id==10 and $offset==304 and $no==$rand){//duckface?>
        <li>
            <div class="galleryBox">
                <div class="galleryImg">
                    <div class="galleryImgPhoto">
                        <a href="<?php echo site_url('gallery/details').'/'.$category_id;?>"><img src="<?php echo base_url().'templates/images/new_thumbnail_omesh.png'?>" /></a>
                    </div>
                </div>
            </div>
        </li>
       <?php }else if($category_id==7 and $offset==112 and $no==$rand){//Pura-Pura gak Selfie?>
        <li>
            <div class="galleryBox">
                <div class="galleryImg">
                    <div class="galleryImgPhoto">
                        <a href="<?php echo site_url('gallery/details').'/'.$category_id;?>"><img src="<?php echo base_url().'templates/images/new_thumbnail_omesh.png'?>" /></a>
                    </div>
                </div>
            </div>
        </li>
       <?php }else if($category_id==11 and $offset==80 and $no==$rand){//groupSelfie?>
        <li>
            <div class="galleryBox">
                <div class="galleryImg">
                    <div class="galleryImgPhoto">
                        <a href="<?php echo site_url('gallery/details').'/'.$category_id;?>"><img src="<?php echo base_url().'templates/images/new_thumbnail_omesh.png'?>" /></a>
                    </div>
                </div>
            </div>
        </li>
       <?php }else if($category_id==8 and $offset==96 and $no==$rand){//mirror Selfie?>
        <li>
            <div class="galleryBox">
                <div class="galleryImg">
                    <div class="galleryImgPhoto">
                        <a href="<?php echo site_url('gallery/details').'/'.$category_id;?>"><img src="<?php echo base_url().'templates/images/new_thumbnail_omesh.png'?>" /></a>
                    </div>
                </div>
            </div>
        </li>
       <?php }else if($category_id==12 and $offset==784 and $no==$rand){//roadshow?>
        <li>
            <div class="galleryBox">
                <div class="galleryImg">
                    <div class="galleryImgPhoto">
                        <a href="<?php echo site_url('gallery/details').'/'.$category_id;?>"><img src="<?php echo base_url().'templates/images/new_thumbnail_omesh.png'?>" /></a>
                    </div>
                </div>
            </div>
        </li>
       <?php }else{ ?>
        <li>
            <div class="galleryBox">
                <div class="galleryImg">
                    <div class="galleryImgPhoto">
                        <a href="<?php echo site_url('gallery/detail').'/'.$category_id.'/'.$list['id'];?>"><img src="<?php echo $list['image']?>"></a>
                    </div>
                </div>
                <a href="<?php echo site_url('gallery/detail').'/'.$category_id.'/'.$list['id'];?>" class="userName"><?php if($list['post_via']==0)echo "@".$list['username']; else if($list['post_via']==1)echo $list['username'];else echo $list['fullname'];?></a>
                <div class="info">
                    <div class="favorite">
                        <div class="like">like:<?php echo $list['like_count'];?></div>
                        <div class="unlike">dislike: <?php echo $list['dislike_count'];?></div>
                    </div>
                    <?php if($list['post_via']==1){?>
                    <div class="source instagram"></div>
                    <?php }else if($list['post_via']==0){?>
                    <div class="source twitter"></div>
                    <?php }else{ ?>
                    <div class="source facebook"></div>
                    <?php }?>
                </div>
            </div>
        </li>
       <?php } 
		}?>
       <?php $no++;} ?>
    </ul>
</div>
<div class="paging">
<?php if($pagination) echo $pagination; ?>
</div>