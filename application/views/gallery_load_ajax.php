<?php 
if($gallery)foreach($gallery as $row){?>
    <li onclick="show_image(<?php echo $row['id']?>);return false;">
        <div class="glWrapper">
            <div class="galleryImg">
        		<img src="<?php echo $row['image']?>">
            </div>
            <?php if($row['post_via']==0){?>
            <div class="sosmedBox">
                <div class="sosmedContent twitterBox">
                    @ <?php echo $row['username']?>
                </div>
            </div>
            <?php }else if($row['post_via']==1){?>
            <div class="sosmedBox">
                <div class="sosmedContent instagramBox">
                    @ <?php echo $row['username']?>
                </div>
            </div>
            <?php }else{?>
            <div class="sosmedBox">
                <div class="sosmedContent">
                    <?php echo $row['fullname']?>
                </div>
            </div>
            <?php }?>
            <?php if($row['winner']==1){
				$category_id=$row['category_id'];
				
				$category_detail='';
				if($category)foreach($category as $list){
					if($list['id']==$category_id)
					$category_detail=$list;
				}
				
				if($category_detail){
				?>
            <div class="galleryHover">
                <div class="title">Pemenang Periode <?php echo $category_detail['precedence']?></div>
                <h3><?php echo $category_detail['name']?></h3>
            </div>
            <?php }}?>
        </div>
        <?php if($row['winner']==1){?>
		<div class="ribbon"></div>
        <?php }?>
    </li>
<?php }?> 

